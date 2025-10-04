<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Donor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'division',
        'district',
        'upazila',
        'blood_type',
        'is_available',
        'last_donation_date',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'last_donation_date' => 'date',
            'password' => 'hashed',
        ];
    }

    public function canDonate(): bool
    {
        if (!$this->last_donation_date) {
            return true;
        }
        
        return $this->last_donation_date->addMonths(3)->isPast();
    }
}