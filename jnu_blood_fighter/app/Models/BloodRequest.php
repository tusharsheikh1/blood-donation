<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'patient_name',
        'disease',
        'blood_type',
        'blood_quantity',
        'is_emergency',
        'needed_date',
        'hospital_name',
        'hospital_location',
        'hospital_map_link', // <-- ADDED
        'division',
        'district',
        'upazila',
        'contact_number',
        'additional_notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_emergency' => 'boolean',
            'needed_date' => 'datetime',
        ];
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isUrgent(): bool
    {
        if ($this->is_emergency) {
            return true;
        }

        if ($this->needed_date) {
            return $this->needed_date->diffInHours(now()) <= 24;
        }

        return false;
    }
}