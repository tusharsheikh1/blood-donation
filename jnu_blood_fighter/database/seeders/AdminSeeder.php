<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'System Admin',
            'email' => 'admin@blooddonor.com',
            'password' => Hash::make('password'),
        ]);

        $this->command->info('Admin created successfully!');
        $this->command->info('Email: admin@blooddonor.com');
        $this->command->info('Password: password');
    }
}