<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DonorSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $donors = [
            // ---- Original 10 ----
            ['name' => 'Arif Hasan', 'email' => 'arif.hasan@example.com', 'phone' => '01711000001', 'address' => 'House 12, Road 3, Dhanmondi', 'division' => 'Dhaka', 'district' => 'Dhaka', 'upazila' => 'Dhanmondi', 'blood_type' => 'A+', 'is_available' => true, 'last_donation_date' => '2025-08-12'],
            ['name' => 'Mehnaz Rahman', 'email' => 'mehnaz.rahman@example.com', 'phone' => '01711000002', 'address' => 'North Kattoli', 'division' => 'Chattogram', 'district' => 'Chattogram', 'upazila' => 'Pahartali', 'blood_type' => 'B+', 'is_available' => true, 'last_donation_date' => '2025-06-20'],
            ['name' => 'Tariq Islam', 'email' => 'tariq.islam@example.com', 'phone' => '01711000003', 'address' => 'Amberkhana', 'division' => 'Sylhet', 'district' => 'Sylhet', 'upazila' => 'Sylhet Sadar', 'blood_type' => 'O+', 'is_available' => true, 'last_donation_date' => '2025-04-10'],
            ['name' => 'Farzana Akter', 'email' => 'farzana.akter@example.com', 'phone' => '01711000004', 'address' => 'Shaheb Bazar', 'division' => 'Rajshahi', 'district' => 'Rajshahi', 'upazila' => 'Rajshahi Sadar', 'blood_type' => 'AB+', 'is_available' => true, 'last_donation_date' => '2025-07-15'],
            ['name' => 'Nayeem Chowdhury', 'email' => 'nayeem.chowdhury@example.com', 'phone' => '01711000005', 'address' => 'Sonadanga', 'division' => 'Khulna', 'district' => 'Khulna', 'upazila' => 'Khulna Sadar', 'blood_type' => 'A-', 'is_available' => true, 'last_donation_date' => '2025-05-28'],
            ['name' => 'Lamia Karim', 'email' => 'lamia.karim@example.com', 'phone' => '01711000006', 'address' => 'Nabab Road', 'division' => 'Barishal', 'district' => 'Barishal', 'upazila' => 'Barishal Sadar', 'blood_type' => 'B-', 'is_available' => true, 'last_donation_date' => '2025-09-01'],
            ['name' => 'Rafiul Alam', 'email' => 'rafiul.alam@example.com', 'phone' => '01711000007', 'address' => 'Kandirpar', 'division' => 'Chattogram', 'district' => 'Cumilla', 'upazila' => 'Cumilla Adarsha Sadar', 'blood_type' => 'O-', 'is_available' => true, 'last_donation_date' => '2025-07-29'],
            ['name' => 'Shakila Binte Noor', 'email' => 'shakila.noor@example.com', 'phone' => '01711000008', 'address' => 'College Road', 'division' => 'Rangpur', 'district' => 'Rangpur', 'upazila' => 'Rangpur Sadar', 'blood_type' => 'AB-', 'is_available' => true, 'last_donation_date' => '2025-03-18'],
            ['name' => 'Mahmudul Hasan', 'email' => 'mahmudul.hasan@example.com', 'phone' => '01711000009', 'address' => 'Ganginar Par', 'division' => 'Mymensingh', 'district' => 'Mymensingh', 'upazila' => 'Mymensingh Sadar', 'blood_type' => 'A+', 'is_available' => true, 'last_donation_date' => '2025-06-02'],
            ['name' => 'Sadia Khatun', 'email' => 'sadia.khatun@example.com', 'phone' => '01711000010', 'address' => 'Fatullah', 'division' => 'Dhaka', 'district' => 'Narayanganj', 'upazila' => 'Narayanganj Sadar', 'blood_type' => 'O+', 'is_available' => true, 'last_donation_date' => '2025-08-20'],

            // ---- New 20 donors ----
            ['name' => 'Imran Hossain', 'email' => 'imran.hossain@example.com', 'phone' => '01711000011', 'address' => 'Banani', 'division' => 'Dhaka', 'district' => 'Dhaka', 'upazila' => 'Banani', 'blood_type' => 'B+', 'is_available' => true, 'last_donation_date' => '2025-05-10'],
            ['name' => 'Sumaiya Yasmin', 'email' => 'sumaiya.yasmin@example.com', 'phone' => '01711000012', 'address' => 'Kotwali', 'division' => 'Chattogram', 'district' => 'Chattogram', 'upazila' => 'Kotwali', 'blood_type' => 'A-', 'is_available' => true, 'last_donation_date' => '2025-02-20'],
            ['name' => 'Shahidul Islam', 'email' => 'shahidul.islam@example.com', 'phone' => '01711000013', 'address' => 'Kazir Dewri', 'division' => 'Chattogram', 'district' => 'Chattogram', 'upazila' => 'Chawkbazar', 'blood_type' => 'O+', 'is_available' => false, 'last_donation_date' => '2024-12-25'],
            ['name' => 'Afsana Begum', 'email' => 'afsana.begum@example.com', 'phone' => '01711000014', 'address' => 'Kushtia Sadar', 'division' => 'Khulna', 'district' => 'Kushtia', 'upazila' => 'Kushtia Sadar', 'blood_type' => 'AB-', 'is_available' => true, 'last_donation_date' => '2025-03-10'],
            ['name' => 'Tanvir Ahmed', 'email' => 'tanvir.ahmed@example.com', 'phone' => '01711000015', 'address' => 'Boalia', 'division' => 'Rajshahi', 'district' => 'Rajshahi', 'upazila' => 'Boalia', 'blood_type' => 'O-', 'is_available' => true, 'last_donation_date' => '2025-09-10'],
            ['name' => 'Rumana Islam', 'email' => 'rumana.islam@example.com', 'phone' => '01711000016', 'address' => 'Narsingdi Sadar', 'division' => 'Dhaka', 'district' => 'Narsingdi', 'upazila' => 'Narsingdi Sadar', 'blood_type' => 'B+', 'is_available' => true, 'last_donation_date' => '2025-06-15'],
            ['name' => 'Ashraful Karim', 'email' => 'ashraful.karim@example.com', 'phone' => '01711000017', 'address' => 'Chandgaon', 'division' => 'Chattogram', 'district' => 'Chattogram', 'upazila' => 'Chandgaon', 'blood_type' => 'A+', 'is_available' => true, 'last_donation_date' => '2025-07-05'],
            ['name' => 'Jannatul Ferdous', 'email' => 'jannatul.ferdous@example.com', 'phone' => '01711000018', 'address' => 'Zindabazar', 'division' => 'Sylhet', 'district' => 'Sylhet', 'upazila' => 'Sylhet Sadar', 'blood_type' => 'O-', 'is_available' => true, 'last_donation_date' => '2025-04-15'],
            ['name' => 'Muntasir Rahman', 'email' => 'muntasir.rahman@example.com', 'phone' => '01711000019', 'address' => 'Jashore Sadar', 'division' => 'Khulna', 'district' => 'Jashore', 'upazila' => 'Jashore Sadar', 'blood_type' => 'B-', 'is_available' => false, 'last_donation_date' => '2025-01-25'],
            ['name' => 'Khadija Akter', 'email' => 'khadija.akter@example.com', 'phone' => '01711000020', 'address' => 'Sadarghat', 'division' => 'Chattogram', 'district' => 'Chattogram', 'upazila' => 'Sadarghat', 'blood_type' => 'A+', 'is_available' => true, 'last_donation_date' => '2025-08-01'],
            ['name' => 'Faisal Rahim', 'email' => 'faisal.rahim@example.com', 'phone' => '01711000021', 'address' => 'Mirpur', 'division' => 'Dhaka', 'district' => 'Dhaka', 'upazila' => 'Mirpur', 'blood_type' => 'O+', 'is_available' => true, 'last_donation_date' => '2025-09-15'],
            ['name' => 'Nasrin Jahan', 'email' => 'nasrin.jahan@example.com', 'phone' => '01711000022', 'address' => 'Kazihata', 'division' => 'Rajshahi', 'district' => 'Rajshahi', 'upazila' => 'Rajpara', 'blood_type' => 'AB+', 'is_available' => true, 'last_donation_date' => '2025-05-25'],
            ['name' => 'Rashidul Islam', 'email' => 'rashidul.islam@example.com', 'phone' => '01711000023', 'address' => 'Gulshan', 'division' => 'Dhaka', 'district' => 'Dhaka', 'upazila' => 'Gulshan', 'blood_type' => 'B+', 'is_available' => true, 'last_donation_date' => '2025-06-18'],
            ['name' => 'Munira Chowdhury', 'email' => 'munira.chowdhury@example.com', 'phone' => '01711000024', 'address' => 'Halishahar', 'division' => 'Chattogram', 'district' => 'Chattogram', 'upazila' => 'Halishahar', 'blood_type' => 'A-', 'is_available' => true, 'last_donation_date' => '2025-07-22'],
            ['name' => 'Samiul Haque', 'email' => 'samiul.haque@example.com', 'phone' => '01711000025', 'address' => 'Mymensingh Town', 'division' => 'Mymensingh', 'district' => 'Mymensingh', 'upazila' => 'Mymensingh Sadar', 'blood_type' => 'O-', 'is_available' => true, 'last_donation_date' => '2025-02-28'],
            ['name' => 'Tania Parvin', 'email' => 'tania.parvin@example.com', 'phone' => '01711000026', 'address' => 'Patenga', 'division' => 'Chattogram', 'district' => 'Chattogram', 'upazila' => 'Patenga', 'blood_type' => 'AB-', 'is_available' => true, 'last_donation_date' => '2025-09-02'],
            ['name' => 'Nafis Ahmed', 'email' => 'nafis.ahmed@example.com', 'phone' => '01711000027', 'address' => 'Savar', 'division' => 'Dhaka', 'district' => 'Dhaka', 'upazila' => 'Savar', 'blood_type' => 'A+', 'is_available' => true, 'last_donation_date' => '2025-03-19'],
            ['name' => 'Lutfun Nahar', 'email' => 'lutfun.nahar@example.com', 'phone' => '01711000028', 'address' => 'Kurigram Sadar', 'division' => 'Rangpur', 'district' => 'Kurigram', 'upazila' => 'Kurigram Sadar', 'blood_type' => 'B+', 'is_available' => true, 'last_donation_date' => '2025-04-05'],
            ['name' => 'Ishrat Jahan', 'email' => 'ishrat.jahan@example.com', 'phone' => '01711000029', 'address' => 'Shibganj', 'division' => 'Rajshahi', 'district' => 'Chapainawabganj', 'upazila' => 'Shibganj', 'blood_type' => 'O+', 'is_available' => true, 'last_donation_date' => '2025-08-15'],
            ['name' => 'Zahidul Haque', 'email' => 'zahidul.haque@example.com', 'phone' => '01711000030', 'address' => 'Panchagarh Sadar', 'division' => 'Rangpur', 'district' => 'Panchagarh', 'upazila' => 'Panchagarh Sadar', 'blood_type' => 'A-', 'is_available' => true, 'last_donation_date' => '2025-05-30'],
        ];

        foreach ($donors as &$d) {
            $d['password'] = Hash::make('password123');
            $d['created_at'] = $now;
            $d['updated_at'] = $now;
        }

        DB::table('donors')->upsert(
            $donors,
            ['email'], // unique key
            [
                'name', 'phone', 'address', 'division', 'district', 'upazila',
                'blood_type', 'is_available', 'last_donation_date',
                'password', 'updated_at',
            ]
        );
    }
}
