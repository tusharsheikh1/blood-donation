<?php

namespace Database\Seeders;

use App\Models\Donor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DonorSeeder extends Seeder
{
    public function run(): void
    {
        Donor::truncate();

        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        
        $locations = [
            ['division' => 'Dhaka', 'district' => 'Dhaka', 'thana' => 'Dhanmondi'],
            ['division' => 'Dhaka', 'district' => 'Dhaka', 'thana' => 'Gulshan'],
            ['division' => 'Dhaka', 'district' => 'Dhaka', 'thana' => 'Mirpur'],
            ['division' => 'Dhaka', 'district' => 'Dhaka', 'thana' => 'Uttara'],
            ['division' => 'Dhaka', 'district' => 'Gazipur', 'thana' => 'Gazipur Sadar'],
            ['division' => 'Dhaka', 'district' => 'Tangail', 'thana' => 'Tangail Sadar'],
            ['division' => 'Chittagong', 'district' => 'Chittagong', 'thana' => 'Panchlaish'],
            ['division' => 'Chittagong', 'district' => 'Chittagong', 'thana' => 'Agrabad'],
            ['division' => 'Chittagong', 'district' => 'Cox\'s Bazar', 'thana' => 'Cox\'s Bazar Sadar'],
            ['division' => 'Chittagong', 'district' => 'Comilla', 'thana' => 'Comilla Sadar'],
            ['division' => 'Rajshahi', 'district' => 'Rajshahi', 'thana' => 'Rajshahi Sadar'],
            ['division' => 'Rajshahi', 'district' => 'Bogra', 'thana' => 'Bogra Sadar'],
            ['division' => 'Khulna', 'district' => 'Khulna', 'thana' => 'Khulna Sadar'],
            ['division' => 'Khulna', 'district' => 'Jessore', 'thana' => 'Jessore Sadar'],
            ['division' => 'Sylhet', 'district' => 'Sylhet', 'thana' => 'Sylhet Sadar'],
            ['division' => 'Sylhet', 'district' => 'Moulvibazar', 'thana' => 'Sreemangal'],
            ['division' => 'Rangpur', 'district' => 'Rangpur', 'thana' => 'Rangpur Sadar'],
            ['division' => 'Rangpur', 'district' => 'Dinajpur', 'thana' => 'Dinajpur Sadar'],
            ['division' => 'Barisal', 'district' => 'Barisal', 'thana' => 'Barisal Sadar'],
            ['division' => 'Mymensingh', 'district' => 'Mymensingh', 'thana' => 'Mymensingh Sadar'],
        ];
        
        $names = [
            'Karim Rahman', 'Fatima Begum', 'Abdul Hasan', 'Sultana Akter', 'Mohammed Ali',
            'Nasrin Islam', 'Rafiq Ahmed', 'Ayesha Siddiqua', 'Jahangir Kabir', 'Roksana Parvin',
            'Shakil Mahmud', 'Nusrat Jahan', 'Imran Hossain', 'Sharmin Sultana', 'Kamrul Islam',
            'Taslima Akter', 'Habib Rahman', 'Sabina Yasmin', 'Mizanur Rahman', 'Rehana Khatun',
            'Faruk Ahmed', 'Nasima Begum', 'Rahim Mollah', 'Sumaiya Islam', 'Babul Miah',
            'Shamsun Nahar', 'Aziz Khan', 'Munira Sultana', 'Jalal Uddin', 'Parveen Akhter'
        ];

        for ($i = 0; $i < 30; $i++) {
            $location = $locations[array_rand($locations)];
            
            Donor::create([
                'name' => $names[$i] ?? 'Donor ' . ($i + 1),
                'email' => 'donor' . ($i + 1) . '@example.com',
                'phone' => '01' . str_pad(rand(700000000, 999999999), 9, '0', STR_PAD_LEFT),
                'address' => 'House ' . rand(1, 100) . ', Road ' . rand(1, 20) . ', ' . $location['thana'],
                'division' => $location['division'],
                'district' => $location['district'],
                'thana' => $location['thana'],
                'blood_type' => $bloodTypes[array_rand($bloodTypes)],
                'is_available' => (bool) rand(0, 1),
                'last_donation_date' => rand(0, 1) ? now()->subDays(rand(30, 365)) : null,
                'password' => Hash::make('password'),
            ]);
        }

        $this->command->info('30 donors created successfully with Bangladesh locations!');
        $this->command->info('Default password for all donors: password');
    }
}