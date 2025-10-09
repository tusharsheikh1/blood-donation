<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\DonorResetPasswordNotification;

class Donor extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass-assignable attributes.
     *
     * Keep existing intake; email/password remain present but can be null.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'blood_type',
        'division',
        'district',
        'upazila',
        'address',
        'is_available',
        'last_donation_date',
        'gender',
        'height_cm',
        'weight_kg',
        'age',
    ];

    /**
     * Default attribute values.
     * Ensures new donors default to not available unless explicitly set.
     */
    protected $attributes = [
        'is_available' => false,
    ];

    /**
     * Hidden attributes for arrays / JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     * - 'password' => 'hashed' automatically hashes on set (and allows null).
     */
    protected $casts = [
        'email_verified_at'  => 'datetime',
        'last_donation_date' => 'date',
        'is_available'       => 'boolean',
        'height_cm'          => 'integer',
        'weight_kg'          => 'integer',
        'age'                => 'integer',
        'password'           => 'hashed',   // <-- added
    ];

    /**
     * Send the password reset notification.
     * (Safe to keep even if most donors won't log in.)
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DonorResetPasswordNotification($token));
    }

    /**
     * Check if donor can donate (3 months since last donation)
     */
    public function canDonate(): bool
    {
        if (!$this->last_donation_date) {
            return true;
        }

        return $this->last_donation_date->copy()->addMonths(3)->isPast();
    }

    /**
     * Get height in feet and inches format
     */
    public function getHeightInFeetAndInches(): string
    {
        if (!$this->height_cm) {
            return 'N/A';
        }

        $totalInches = (int) round($this->height_cm / 2.54);
        $feet = (int) floor($totalInches / 12);
        $inches = $totalInches % 12;

        return "{$feet}' {$inches}\"";
    }

    /**
     * Calculate BMI (Body Mass Index)
     */
    public function getBMI(): ?float
    {
        if (!$this->weight_kg || !$this->height_cm) {
            return null;
        }

        $heightInMeters = $this->height_cm / 100;
        $bmi = $this->weight_kg / ($heightInMeters * $heightInMeters);

        return round($bmi, 1);
    }

    /**
     * Get BMI category based on WHO standards
     */
    public function getBMICategory(): string
    {
        $bmi = $this->getBMI();

        if ($bmi === null) {
            return 'Unknown';
        }

        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi < 25) {
            return 'Normal';
        } elseif ($bmi < 30) {
            return 'Overweight';
        }

        return 'Obese';
    }

    /**
     * Get BMI status color for UI (Bootstrap colors)
     */
    public function getBMIColor(): string
    {
        return match ($this->getBMICategory()) {
            'Underweight' => 'warning',
            'Normal'      => 'success',
            'Overweight'  => 'warning',
            'Obese'       => 'danger',
            default       => 'secondary',
        };
    }

    /**
     * Get BMI health recommendation
     */
    public function getBMIRecommendation(): string
    {
        return match ($this->getBMICategory()) {
            'Underweight' => 'Consider consulting a healthcare provider about healthy weight gain.',
            'Normal'      => 'Your BMI is in the healthy range! Keep up the good work.',
            'Overweight'  => 'Consider adopting a healthier lifestyle with balanced diet and exercise.',
            'Obese'       => 'Please consult a healthcare provider for personalized health guidance.',
            default       => 'Complete your profile to calculate your BMI.',
        };
    }

    /**
     * Check if donor has complete health profile
     */
    public function hasCompleteHealthProfile(): bool
    {
        return (bool) ($this->gender && $this->age && $this->height_cm && $this->weight_kg);
    }

    /**
     * Check if donor is eligible to donate based on age
     */
    public function isAgeEligible(): bool
    {
        if (!$this->age) {
            return false;
        }

        return $this->age >= 18 && $this->age <= 65;
    }

    /**
     * Check if donor meets weight requirement (minimum 45 kg)
     */
    public function meetsWeightRequirement(): bool
    {
        if (!$this->weight_kg) {
            return false;
        }

        return $this->weight_kg >= 45;
    }

    /**
     * Get comprehensive eligibility status
     */
    public function getEligibilityStatus(): array
    {
        $eligible = true;
        $reasons = [];

        if (!$this->hasCompleteHealthProfile()) {
            $eligible = false;
            $reasons[] = 'Complete your health profile (age, gender, height, weight)';
        }

        if (!$this->isAgeEligible()) {
            $eligible = false;
            if (!$this->age) {
                $reasons[] = 'Add your age to profile';
            } else {
                $reasons[] = 'Age must be between 18-65 years';
            }
        }

        if (!$this->meetsWeightRequirement()) {
            $eligible = false;
            if (!$this->weight_kg) {
                $reasons[] = 'Add your weight to profile';
            } else {
                $reasons[] = 'Weight must be at least 45 kg';
            }
        }

        if (!$this->canDonate()) {
            $eligible = false;
            $nextDate = $this->last_donation_date?->copy()->addMonths(3);
            $reasons[] = 'Must wait 3 months between donations (next eligible: ' .
                ($nextDate ? $nextDate->format('M d, Y') : 'N/A') . ')';
        }

        return [
            'eligible' => $eligible,
            'reasons'  => $reasons,
            'message'  => $eligible ? 'You are eligible to donate blood!' : 'Not currently eligible',
        ];
    }

    /**
     * Relationship: Blood Requests created by this donor
     */
    public function bloodRequests()
    {
        return $this->hasMany(BloodRequest::class);
    }
}
