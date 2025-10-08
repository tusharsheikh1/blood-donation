<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Donor extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
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
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_donation_date' => 'date',
        'is_available' => 'boolean',
        'height_cm' => 'integer',
        'weight_kg' => 'integer',
        'age' => 'integer',
    ];

    /**
     * Check if donor can donate (3 months since last donation)
     *
     * @return bool
     */
    public function canDonate(): bool
    {
        if (!$this->last_donation_date) {
            return true;
        }
        
        return $this->last_donation_date->addMonths(3)->isPast();
    }

    /**
     * Get height in feet and inches format
     *
     * @return string
     */
    public function getHeightInFeetAndInches(): string
    {
        if (!$this->height_cm) {
            return 'N/A';
        }
        
        // Convert cm to total inches (1 inch = 2.54 cm)
        $totalInches = round($this->height_cm / 2.54);
        
        // Calculate feet and remaining inches
        $feet = floor($totalInches / 12);
        $inches = $totalInches % 12;
        
        return "{$feet}' {$inches}\"";
    }

    /**
     * Calculate BMI (Body Mass Index)
     * Formula: BMI = weight (kg) / (height (m))^2
     *
     * @return float|null
     */
    public function getBMI(): ?float
    {
        if (!$this->weight_kg || !$this->height_cm) {
            return null;
        }
        
        // Convert height from cm to meters
        $heightInMeters = $this->height_cm / 100;
        
        // Calculate BMI
        $bmi = $this->weight_kg / ($heightInMeters * $heightInMeters);
        
        // Round to 1 decimal place
        return round($bmi, 1);
    }

    /**
     * Get BMI category based on WHO standards
     *
     * @return string
     */
    public function getBMICategory(): string
    {
        $bmi = $this->getBMI();
        
        if ($bmi === null) {
            return 'Unknown';
        }
        
        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            return 'Normal';
        } elseif ($bmi >= 25 && $bmi < 30) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }

    /**
     * Get BMI status color for UI (Bootstrap colors)
     *
     * @return string
     */
    public function getBMIColor(): string
    {
        $category = $this->getBMICategory();
        
        return match($category) {
            'Underweight' => 'warning',
            'Normal' => 'success',
            'Overweight' => 'warning',
            'Obese' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get BMI health recommendation
     *
     * @return string
     */
    public function getBMIRecommendation(): string
    {
        $category = $this->getBMICategory();
        
        return match($category) {
            'Underweight' => 'Consider consulting a healthcare provider about healthy weight gain.',
            'Normal' => 'Your BMI is in the healthy range! Keep up the good work.',
            'Overweight' => 'Consider adopting a healthier lifestyle with balanced diet and exercise.',
            'Obese' => 'Please consult a healthcare provider for personalized health guidance.',
            default => 'Complete your profile to calculate your BMI.',
        };
    }

    /**
     * Check if donor has complete health profile
     *
     * @return bool
     */
    public function hasCompleteHealthProfile(): bool
    {
        return $this->gender 
            && $this->age 
            && $this->height_cm 
            && $this->weight_kg;
    }

    /**
     * Check if donor is eligible to donate based on age
     *
     * @return bool
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
     *
     * @return bool
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
     *
     * @return array
     */
    public function getEligibilityStatus(): array
    {
        $eligible = true;
        $reasons = [];

        // Check profile completion
        if (!$this->hasCompleteHealthProfile()) {
            $eligible = false;
            $reasons[] = 'Complete your health profile (age, gender, height, weight)';
        }

        // Check age eligibility
        if (!$this->isAgeEligible()) {
            $eligible = false;
            if (!$this->age) {
                $reasons[] = 'Add your age to profile';
            } else {
                $reasons[] = 'Age must be between 18-65 years';
            }
        }

        // Check weight requirement
        if (!$this->meetsWeightRequirement()) {
            $eligible = false;
            if (!$this->weight_kg) {
                $reasons[] = 'Add your weight to profile';
            } else {
                $reasons[] = 'Weight must be at least 45 kg';
            }
        }

        // Check donation interval
        if (!$this->canDonate()) {
            $eligible = false;
            $nextDate = $this->last_donation_date?->copy()->addMonths(3);
            $reasons[] = 'Must wait 3 months between donations (next eligible: ' . 
                        ($nextDate ? $nextDate->format('M d, Y') : 'N/A') . ')';
        }

        return [
            'eligible' => $eligible,
            'reasons' => $reasons,
            'message' => $eligible ? 'You are eligible to donate blood!' : 'Not currently eligible',
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