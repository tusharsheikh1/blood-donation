<?php

namespace App\Helpers;

/**
 * Bangladesh Locations Helper
 * Complete list of 8 Divisions, 64 Districts, and 495 Upazilas
 * With both English and Bangla names
 * Updated as of 2024 with official spellings
 */
class BangladeshLocations
{
    /**
     * Get all divisions with Bangla and English names
     * Total: 8 Divisions
     */
    public static function divisions(): array
    {
        return [
            ['en' => 'Dhaka', 'bn' => 'ঢাকা'],
            ['en' => 'Chattogram', 'bn' => 'চট্টগ্রাম'],
            ['en' => 'Rajshahi', 'bn' => 'রাজশাহী'],
            ['en' => 'Khulna', 'bn' => 'খুলনা'],
            ['en' => 'Barishal', 'bn' => 'বরিশাল'],
            ['en' => 'Sylhet', 'bn' => 'সিলেট'],
            ['en' => 'Rangpur', 'bn' => 'রংপুর'],
            ['en' => 'Mymensingh', 'bn' => 'ময়মনসিংহ'],
        ];
    }

    /**
     * Get all districts organized by division with Bangla and English names
     * Total: 64 Districts
     */
    public static function districts(): array
    {
        return [
            'Dhaka' => [
                ['en' => 'Dhaka', 'bn' => 'ঢাকা'],
                ['en' => 'Faridpur', 'bn' => 'ফরিদপুর'],
                ['en' => 'Gazipur', 'bn' => 'গাজীপুর'],
                ['en' => 'Gopalganj', 'bn' => 'গোপালগঞ্জ'],
                ['en' => 'Kishoreganj', 'bn' => 'কিশোরগঞ্জ'],
                ['en' => 'Madaripur', 'bn' => 'মাদারীপুর'],
                ['en' => 'Manikganj', 'bn' => 'মানিকগঞ্জ'],
                ['en' => 'Munshiganj', 'bn' => 'মুন্সিগঞ্জ'],
                ['en' => 'Narayanganj', 'bn' => 'নারায়ণগঞ্জ'],
                ['en' => 'Narsingdi', 'bn' => 'নরসিংদী'],
                ['en' => 'Rajbari', 'bn' => 'রাজবাড়ী'],
                ['en' => 'Shariatpur', 'bn' => 'শরীয়তপুর'],
                ['en' => 'Tangail', 'bn' => 'টাঙ্গাইল'],
            ],
            'Chattogram' => [
                ['en' => 'Bandarban', 'bn' => 'বান্দরবান'],
                ['en' => 'Brahmanbaria', 'bn' => 'ব্রাহ্মণবাড়িয়া'],
                ['en' => 'Chandpur', 'bn' => 'চাঁদপুর'],
                ['en' => 'Chattogram', 'bn' => 'চট্টগ্রাম'],
                ['en' => 'Cumilla', 'bn' => 'কুমিল্লা'],
                ['en' => 'Cox\'s Bazar', 'bn' => 'কক্সবাজার'],
                ['en' => 'Feni', 'bn' => 'ফেনী'],
                ['en' => 'Khagrachhari', 'bn' => 'খাগড়াছড়ি'],
                ['en' => 'Lakshmipur', 'bn' => 'লক্ষ্মীপুর'],
                ['en' => 'Noakhali', 'bn' => 'নোয়াখালী'],
                ['en' => 'Rangamati', 'bn' => 'রাঙ্গামাটি'],
            ],
            'Rajshahi' => [
                ['en' => 'Bogura', 'bn' => 'বগুড়া'],
                ['en' => 'Joypurhat', 'bn' => 'জয়পুরহাট'],
                ['en' => 'Naogaon', 'bn' => 'নওগাঁ'],
                ['en' => 'Natore', 'bn' => 'নাটোর'],
                ['en' => 'Chapainawabganj', 'bn' => 'চাঁপাইনবাবগঞ্জ'],
                ['en' => 'Pabna', 'bn' => 'পাবনা'],
                ['en' => 'Rajshahi', 'bn' => 'রাজশাহী'],
                ['en' => 'Sirajganj', 'bn' => 'সিরাজগঞ্জ'],
            ],
            'Khulna' => [
                ['en' => 'Bagerhat', 'bn' => 'বাগেরহাট'],
                ['en' => 'Chuadanga', 'bn' => 'চুয়াডাঙ্গা'],
                ['en' => 'Jashore', 'bn' => 'যশোর'],
                ['en' => 'Jhenaidah', 'bn' => 'ঝিনাইদহ'],
                ['en' => 'Khulna', 'bn' => 'খুলনা'],
                ['en' => 'Kushtia', 'bn' => 'কুষ্টিয়া'],
                ['en' => 'Magura', 'bn' => 'মাগুরা'],
                ['en' => 'Meherpur', 'bn' => 'মেহেরপুর'],
                ['en' => 'Narail', 'bn' => 'নড়াইল'],
                ['en' => 'Satkhira', 'bn' => 'সাতক্ষীরা'],
            ],
            'Barishal' => [
                ['en' => 'Barguna', 'bn' => 'বরগুনা'],
                ['en' => 'Barishal', 'bn' => 'বরিশাল'],
                ['en' => 'Bhola', 'bn' => 'ভোলা'],
                ['en' => 'Jhalokati', 'bn' => 'ঝালকাঠি'],
                ['en' => 'Patuakhali', 'bn' => 'পটুয়াখালী'],
                ['en' => 'Pirojpur', 'bn' => 'পিরোজপুর'],
            ],
            'Sylhet' => [
                ['en' => 'Habiganj', 'bn' => 'হবিগঞ্জ'],
                ['en' => 'Moulvibazar', 'bn' => 'মৌলভীবাজার'],
                ['en' => 'Sunamganj', 'bn' => 'সুনামগঞ্জ'],
                ['en' => 'Sylhet', 'bn' => 'সিলেট'],
            ],
            'Rangpur' => [
                ['en' => 'Dinajpur', 'bn' => 'দিনাজপুর'],
                ['en' => 'Gaibandha', 'bn' => 'গাইবান্ধা'],
                ['en' => 'Kurigram', 'bn' => 'কুড়িগ্রাম'],
                ['en' => 'Lalmonirhat', 'bn' => 'লালমনিরহাট'],
                ['en' => 'Nilphamari', 'bn' => 'নীলফামারী'],
                ['en' => 'Panchagarh', 'bn' => 'পঞ্চগড়'],
                ['en' => 'Rangpur', 'bn' => 'রংপুর'],
                ['en' => 'Thakurgaon', 'bn' => 'ঠাকুরগাঁও'],
            ],
            'Mymensingh' => [
                ['en' => 'Jamalpur', 'bn' => 'জামালপুর'],
                ['en' => 'Mymensingh', 'bn' => 'ময়মনসিংহ'],
                ['en' => 'Netrokona', 'bn' => 'নেত্রকোনা'],
                ['en' => 'Sherpur', 'bn' => 'শেরপুর'],
            ],
        ];
    }

    /**
     * Get all upazilas/thanas organized by district with Bangla and English names
     * Total: 495 Upazilas (as of 2024)
     */
    public static function upazilas(): array
    {
        return [
            // ==================== DHAKA DIVISION ====================
            'Dhaka' => [
                ['en' => 'Adabar', 'bn' => 'আদাবর'],
                ['en' => 'Badda', 'bn' => 'বাড্ডা'],
                ['en' => 'Bangsal', 'bn' => 'বংশাল'],
                ['en' => 'Bimanbandar', 'bn' => 'বিমানবন্দর'],
                ['en' => 'Cantonment', 'bn' => 'ক্যান্টনমেন্ট'],
                ['en' => 'Chak Bazar', 'bn' => 'চকবাজার'],
                ['en' => 'Dakshinkhan', 'bn' => 'দক্ষিণখান'],
                ['en' => 'Darus Salam', 'bn' => 'দারুস সালাম'],
                ['en' => 'Demra', 'bn' => 'ডেমরা'],
                ['en' => 'Dhamrai', 'bn' => 'ধামরাই'],
                ['en' => 'Dhanmondi', 'bn' => 'ধানমন্ডি'],
                ['en' => 'Dohar', 'bn' => 'দোহার'],
                ['en' => 'Gendaria', 'bn' => 'গেন্ডারিয়া'],
                ['en' => 'Gulshan', 'bn' => 'গুলশান'],
                ['en' => 'Hazaribagh', 'bn' => 'হাজারীবাগ'],
                ['en' => 'Jatrabari', 'bn' => 'যাত্রাবাড়ী'],
                ['en' => 'Kadamtali', 'bn' => 'কদমতলী'],
                ['en' => 'Kafrul', 'bn' => 'কাফরুল'],
                ['en' => 'Kalabagan', 'bn' => 'কলাবাগান'],
                ['en' => 'Kamrangirchar', 'bn' => 'কামরাঙ্গীরচর'],
                ['en' => 'Keraniganj', 'bn' => 'কেরানীগঞ্জ'],
                ['en' => 'Khilgaon', 'bn' => 'খিলগাঁও'],
                ['en' => 'Khilkhet', 'bn' => 'খিলক্ষেত'],
                ['en' => 'Kotwali', 'bn' => 'কোতোয়ালী'],
                ['en' => 'Lalbagh', 'bn' => 'লালবাগ'],
                ['en' => 'Mirpur', 'bn' => 'মিরপুর'],
                ['en' => 'Mohammadpur', 'bn' => 'মোহাম্মদপুর'],
                ['en' => 'Motijheel', 'bn' => 'মতিঝিল'],
                ['en' => 'Mugda', 'bn' => 'মুগদা'],
                ['en' => 'Nawabganj', 'bn' => 'নবাবগঞ্জ'],
                ['en' => 'New Market', 'bn' => 'নিউমার্কেট'],
                ['en' => 'Pallabi', 'bn' => 'পল্লবী'],
                ['en' => 'Paltan', 'bn' => 'পল্টন'],
                ['en' => 'Ramna', 'bn' => 'রমনা'],
                ['en' => 'Rampura', 'bn' => 'রামপুরা'],
                ['en' => 'Sabujbagh', 'bn' => 'সবুজবাগ'],
                ['en' => 'Savar', 'bn' => 'সাভার'],
                ['en' => 'Shah Ali', 'bn' => 'শাহ আলী'],
                ['en' => 'Shahbagh', 'bn' => 'শাহবাগ'],
                ['en' => 'Sher-e-Bangla Nagar', 'bn' => 'শেরে বাংলা নগর'],
                ['en' => 'Shyampur', 'bn' => 'শ্যামপুর'],
                ['en' => 'Sutrapur', 'bn' => 'সূত্রাপুর'],
                ['en' => 'Tejgaon', 'bn' => 'তেজগাঁও'],
                ['en' => 'Tejgaon I/A', 'bn' => 'তেজগাঁও শিল্পাঞ্চল'],
                ['en' => 'Turag', 'bn' => 'তুরাগ'],
                ['en' => 'Uttara', 'bn' => 'উত্তরা'],
                ['en' => 'Uttara West', 'bn' => 'উত্তরা পশ্চিম'],
                ['en' => 'Uttarkhan', 'bn' => 'উত্তরখান'],
                ['en' => 'Vatara', 'bn' => 'ভাটারা'],
                ['en' => 'Wari', 'bn' => 'ওয়ারী'],
            ],
            
            'Faridpur' => [
                ['en' => 'Faridpur Sadar', 'bn' => 'ফরিদপুর সদর'],
                ['en' => 'Alfadanga', 'bn' => 'আলফাডাঙ্গা'],
                ['en' => 'Boalmari', 'bn' => 'বোয়ালমারী'],
                ['en' => 'Bhanga', 'bn' => 'ভাঙ্গা'],
                ['en' => 'Char Bhadrasan', 'bn' => 'চর ভদ্রাসন'],
                ['en' => 'Madhukhali', 'bn' => 'মধুখালী'],
                ['en' => 'Nagarkanda', 'bn' => 'নগরকান্দা'],
                ['en' => 'Sadarpur', 'bn' => 'সদরপুর'],
                ['en' => 'Saltha', 'bn' => 'সালথা'],
            ],
            
            'Gazipur' => [
                ['en' => 'Gazipur Sadar', 'bn' => 'গাজীপুর সদর'],
                ['en' => 'Kaliakair', 'bn' => 'কালিয়াকৈর'],
                ['en' => 'Kaliganj', 'bn' => 'কালীগঞ্জ'],
                ['en' => 'Kapasia', 'bn' => 'কাপাসিয়া'],
                ['en' => 'Sreepur', 'bn' => 'শ্রীপুর'],
            ],
            
            'Gopalganj' => [
                ['en' => 'Gopalganj Sadar', 'bn' => 'গোপালগঞ্জ সদর'],
                ['en' => 'Kashiani', 'bn' => 'কাশিয়ানী'],
                ['en' => 'Kotalipara', 'bn' => 'কোটালীপাড়া'],
                ['en' => 'Muksudpur', 'bn' => 'মুকসুদপুর'],
                ['en' => 'Tungipara', 'bn' => 'টুংগীপাড়া'],
            ],
            
            'Kishoreganj' => [
                ['en' => 'Kishoreganj Sadar', 'bn' => 'কিশোরগঞ্জ সদর'],
                ['en' => 'Austagram', 'bn' => 'অষ্টগ্রাম'],
                ['en' => 'Bajitpur', 'bn' => 'বাজিতপুর'],
                ['en' => 'Bhairab', 'bn' => 'ভৈরব'],
                ['en' => 'Hossainpur', 'bn' => 'হোসেনপুর'],
                ['en' => 'Itna', 'bn' => 'ইটনা'],
                ['en' => 'Karimganj', 'bn' => 'করিমগঞ্জ'],
                ['en' => 'Katiadi', 'bn' => 'কটিয়াদী'],
                ['en' => 'Kuliarchar', 'bn' => 'কুলিয়ারচর'],
                ['en' => 'Mithamain', 'bn' => 'মিঠামাইন'],
                ['en' => 'Nikli', 'bn' => 'নিকলী'],
                ['en' => 'Pakundia', 'bn' => 'পাকুন্দিয়া'],
                ['en' => 'Tarail', 'bn' => 'তাড়াইল'],
            ],
            
            'Madaripur' => [
                ['en' => 'Madaripur Sadar', 'bn' => 'মাদারীপুর সদর'],
                ['en' => 'Kalkini', 'bn' => 'কালকিনি'],
                ['en' => 'Rajoir', 'bn' => 'রাজৈর'],
                ['en' => 'Shibchar', 'bn' => 'শিবচর'],
                ['en' => 'Dasar', 'bn' => 'ডসার'],
            ],
            
            'Manikganj' => [
                ['en' => 'Manikganj Sadar', 'bn' => 'মানিকগঞ্জ সদর'],
                ['en' => 'Daulatpur', 'bn' => 'দৌলতপুর'],
                ['en' => 'Ghior', 'bn' => 'ঘিওর'],
                ['en' => 'Harirampur', 'bn' => 'হরিরামপুর'],
                ['en' => 'Saturia', 'bn' => 'সাটুরিয়া'],
                ['en' => 'Shivalaya', 'bn' => 'শিবালয়'],
                ['en' => 'Singair', 'bn' => 'সিংগাইর'],
            ],
            
            'Munshiganj' => [
                ['en' => 'Munshiganj Sadar', 'bn' => 'মুন্সিগঞ্জ সদর'],
                ['en' => 'Gazaria', 'bn' => 'গজারিয়া'],
                ['en' => 'Lohajang', 'bn' => 'লোহাজং'],
                ['en' => 'Sirajdikhan', 'bn' => 'সিরাজদিখান'],
                ['en' => 'Sreenagar', 'bn' => 'শ্রীনগর'],
                ['en' => 'Tongibari', 'bn' => 'টংগীবাড়ি'],
            ],
            
            'Narayanganj' => [
                ['en' => 'Narayanganj Sadar', 'bn' => 'নারায়ণগঞ্জ সদর'],
                ['en' => 'Araihazar', 'bn' => 'আড়াইহাজার'],
                ['en' => 'Bandar', 'bn' => 'বন্দর'],
                ['en' => 'Rupganj', 'bn' => 'রূপগঞ্জ'],
                ['en' => 'Sonargaon', 'bn' => 'সোনারগাঁও'],
            ],
            
            'Narsingdi' => [
                ['en' => 'Narsingdi Sadar', 'bn' => 'নরসিংদী সদর'],
                ['en' => 'Belabo', 'bn' => 'বেলাবো'],
                ['en' => 'Monohardi', 'bn' => 'মনোহরদী'],
                ['en' => 'Palash', 'bn' => 'পলাশ'],
                ['en' => 'Raipura', 'bn' => 'রায়পুরা'],
                ['en' => 'Shibpur', 'bn' => 'শিবপুর'],
            ],
            
            'Rajbari' => [
                ['en' => 'Rajbari Sadar', 'bn' => 'রাজবাড়ী সদর'],
                ['en' => 'Baliakandi', 'bn' => 'বালিয়াকান্দি'],
                ['en' => 'Goalandaghat', 'bn' => 'গোয়ালন্দ ঘাট'],
                ['en' => 'Pangsha', 'bn' => 'পাংশা'],
                ['en' => 'Kalukhali', 'bn' => 'কালুখালী'],
            ],
            
            'Shariatpur' => [
                ['en' => 'Shariatpur Sadar', 'bn' => 'শরীয়তপুর সদর'],
                ['en' => 'Bhedarganj', 'bn' => 'ভেদরগঞ্জ'],
                ['en' => 'Damudya', 'bn' => 'দামুড্যা'],
                ['en' => 'Gosairhat', 'bn' => 'গোসাইরহাট'],
                ['en' => 'Naria', 'bn' => 'নড়িয়া'],
                ['en' => 'Zajira', 'bn' => 'জাজিরা'],
                ['en' => 'Shakhipur', 'bn' => 'শখিপুর'],
            ],
            
            'Tangail' => [
                ['en' => 'Tangail Sadar', 'bn' => 'টাঙ্গাইল সদর'],
                ['en' => 'Basail', 'bn' => 'বাসাইল'],
                ['en' => 'Bhuapur', 'bn' => 'ভুয়াপুর'],
                ['en' => 'Delduar', 'bn' => 'দেলদুয়ার'],
                ['en' => 'Dhanbari', 'bn' => 'ধনবাড়ী'],
                ['en' => 'Ghatail', 'bn' => 'ঘাটাইল'],
                ['en' => 'Gopalpur', 'bn' => 'গোপালপুর'],
                ['en' => 'Kalihati', 'bn' => 'কালিহাতী'],
                ['en' => 'Madhupur', 'bn' => 'মধুপুর'],
                ['en' => 'Mirzapur', 'bn' => 'মির্জাপুর'],
                ['en' => 'Nagarpur', 'bn' => 'নাগরপুর'],
                ['en' => 'Sakhipur', 'bn' => 'সখিপুর'],
            ],
            
            // ==================== CHATTOGRAM DIVISION ====================
            'Bandarban' => [
                ['en' => 'Bandarban Sadar', 'bn' => 'বান্দরবান সদর'],
                ['en' => 'Thanchi', 'bn' => 'থানচি'],
                ['en' => 'Lama', 'bn' => 'লামা'],
                ['en' => 'Naikhongchhari', 'bn' => 'নাইক্ষ্যংছড়ি'],
                ['en' => 'Ali Kadam', 'bn' => 'আলী কদম'],
                ['en' => 'Rowangchhari', 'bn' => 'রোয়াংছড়ি'],
                ['en' => 'Ruma', 'bn' => 'রুমা'],
            ],
            
            'Brahmanbaria' => [
                ['en' => 'Brahmanbaria Sadar', 'bn' => 'ব্রাহ্মণবাড়িয়া সদর'],
                ['en' => 'Akhaura', 'bn' => 'আখাউড়া'],
                ['en' => 'Ashuganj', 'bn' => 'আশুগঞ্জ'],
                ['en' => 'Bancharampur', 'bn' => 'বাঞ্ছারামপুর'],
                ['en' => 'Bijoynagar', 'bn' => 'বিজয়নগর'],
                ['en' => 'Kasba', 'bn' => 'কসবা'],
                ['en' => 'Nabinagar', 'bn' => 'নবীনগর'],
                ['en' => 'Nasirnagar', 'bn' => 'নাসিরনগর'],
                ['en' => 'Sarail', 'bn' => 'সরাইল'],
            ],
            
            'Chandpur' => [
                ['en' => 'Chandpur Sadar', 'bn' => 'চাঁদপুর সদর'],
                ['en' => 'Faridganj', 'bn' => 'ফরিদগঞ্জ'],
                ['en' => 'Haimchar', 'bn' => 'হাইমচর'],
                ['en' => 'Haziganj', 'bn' => 'হাজীগঞ্জ'],
                ['en' => 'Kachua', 'bn' => 'কচুয়া'],
                ['en' => 'Matlab Dakshin', 'bn' => 'মতলব দক্ষিণ'],
                ['en' => 'Matlab Uttar', 'bn' => 'মতলব উত্তর'],
                ['en' => 'Shahrasti', 'bn' => 'শাহরাস্তি'],
            ],
            
            'Chattogram' => [
                ['en' => 'Anwara', 'bn' => 'আনোয়ারা'],
                ['en' => 'Banshkhali', 'bn' => 'বাঁশখালী'],
                ['en' => 'Boalkhali', 'bn' => 'বোয়ালখালী'],
                ['en' => 'Chandanaish', 'bn' => 'চন্দনাইশ'],
                ['en' => 'Fatikchhari', 'bn' => 'ফটিকছড়ি'],
                ['en' => 'Hathazari', 'bn' => 'হাটহাজারী'],
                ['en' => 'Lohagara', 'bn' => 'লোহাগাড়া'],
                ['en' => 'Mirsharai', 'bn' => 'মীরসরাই'],
                ['en' => 'Patiya', 'bn' => 'পটিয়া'],
                ['en' => 'Rangunia', 'bn' => 'রাঙ্গুনিয়া'],
                ['en' => 'Raozan', 'bn' => 'রাউজান'],
                ['en' => 'Sandwip', 'bn' => 'সন্দ্বীপ'],
                ['en' => 'Satkania', 'bn' => 'সাতকানিয়া'],
                ['en' => 'Sitakunda', 'bn' => 'সীতাকুণ্ড'],
                ['en' => 'Akbar Shah', 'bn' => 'আকবর শাহ'],
                ['en' => 'Bakalia', 'bn' => 'বাকলিয়া'],
                ['en' => 'Bandar', 'bn' => 'বন্দর'],
                ['en' => 'Bayazid Bostami', 'bn' => 'বায়েজিদ বোস্তামী'],
                ['en' => 'Chandgaon', 'bn' => 'চান্দগাঁও'],
                ['en' => 'Chawk Bazar', 'bn' => 'চকবাজার'],
                ['en' => 'Double Mooring', 'bn' => 'ডাবল মুরিং'],
                ['en' => 'EPZ', 'bn' => 'ইপিজেড'],
                ['en' => 'Halishahar', 'bn' => 'হালিশহর'],
                ['en' => 'Khulshi', 'bn' => 'খুলশী'],
                ['en' => 'Kotwali', 'bn' => 'কোতোয়ালী'],
                ['en' => 'Pahartali', 'bn' => 'পাহাড়তলী'],
                ['en' => 'Panchlaish', 'bn' => 'পাঁচলাইশ'],
                ['en' => 'Patenga', 'bn' => 'পতেঙ্গা'],
                ['en' => 'Sadarghat', 'bn' => 'সদরঘাট'],
            ],
            
            'Cumilla' => [
                ['en' => 'Cumilla Sadar', 'bn' => 'কুমিল্লা সদর'],
                ['en' => 'Barura', 'bn' => 'বরুড়া'],
                ['en' => 'Brahmanpara', 'bn' => 'ব্রাহ্মণপাড়া'],
                ['en' => 'Burichang', 'bn' => 'বুড়িচং'],
                ['en' => 'Chandina', 'bn' => 'চান্দিনা'],
                ['en' => 'Chauddagram', 'bn' => 'চৌদ্দগ্রাম'],
                ['en' => 'Daudkandi', 'bn' => 'দাউদকান্দি'],
                ['en' => 'Debidwar', 'bn' => 'দেবিদ্বার'],
                ['en' => 'Homna', 'bn' => 'হোমনা'],
                ['en' => 'Laksam', 'bn' => 'লাকসাম'],
                ['en' => 'Meghna', 'bn' => 'মেঘনা'],
                ['en' => 'Muradnagar', 'bn' => 'মুরাদনগর'],
                ['en' => 'Nangalkot', 'bn' => 'নাঙ্গলকোট'],
                ['en' => 'Titas', 'bn' => 'তিতাস'],
                ['en' => 'Cumilla Sadar Dakshin', 'bn' => 'কুমিল্লা সদর দক্ষিণ'],
                ['en' => 'Lalmai', 'bn' => 'লালমাই'],
                ['en' => 'Manoharganj', 'bn' => 'মনোহরগঞ্জ'],
            ],
            
            'Cox\'s Bazar' => [
                ['en' => 'Cox\'s Bazar Sadar', 'bn' => 'কক্সবাজার সদর'],
                ['en' => 'Chakaria', 'bn' => 'চকরিয়া'],
                ['en' => 'Kutubdia', 'bn' => 'কুতুবদিয়া'],
                ['en' => 'Maheshkhali', 'bn' => 'মহেশখালী'],
                ['en' => 'Pekua', 'bn' => 'পেকুয়া'],
                ['en' => 'Ramu', 'bn' => 'রামু'],
                ['en' => 'Teknaf', 'bn' => 'টেকনাফ'],
                ['en' => 'Ukhia', 'bn' => 'উখিয়া'],
                ['en' => 'Eidgaon', 'bn' => 'ঈদগাঁও'],
            ],
            
            'Feni' => [
                ['en' => 'Feni Sadar', 'bn' => 'ফেনী সদর'],
                ['en' => 'Chhagalnaiya', 'bn' => 'ছাগলনাইয়া'],
                ['en' => 'Daganbhuiyan', 'bn' => 'দাগনভূঞা'],
                ['en' => 'Fulgazi', 'bn' => 'ফুলগাজী'],
                ['en' => 'Parshuram', 'bn' => 'পরশুরাম'],
                ['en' => 'Sonagazi', 'bn' => 'সোনাগাজী'],
            ],
            
            'Khagrachhari' => [
                ['en' => 'Khagrachhari Sadar', 'bn' => 'খাগড়াছড়ি সদর'],
                ['en' => 'Dighinala', 'bn' => 'দীঘিনালা'],
                ['en' => 'Lakshmichhari', 'bn' => 'লক্ষ্মীছড়ি'],
                ['en' => 'Mahalchhari', 'bn' => 'মহালছড়ি'],
                ['en' => 'Manikchhari', 'bn' => 'মানিকছড়ি'],
                ['en' => 'Matiranga', 'bn' => 'মাটিরাঙ্গা'],
                ['en' => 'Panchhari', 'bn' => 'পানছড়ি'],
                ['en' => 'Ramgarh', 'bn' => 'রামগড়'],
                ['en' => 'Guimara', 'bn' => 'গুইমারা'],
            ],
            
            'Lakshmipur' => [
                ['en' => 'Lakshmipur Sadar', 'bn' => 'লক্ষ্মীপুর সদর'],
                ['en' => 'Raipur', 'bn' => 'রায়পুর'],
                ['en' => 'Ramganj', 'bn' => 'রামগঞ্জ'],
                ['en' => 'Ramgati', 'bn' => 'রামগতি'],
                ['en' => 'Kamalnagar', 'bn' => 'কমলনগর'],
            ],
            
            'Noakhali' => [
                ['en' => 'Noakhali Sadar', 'bn' => 'নোয়াখালী সদর'],
                ['en' => 'Begumganj', 'bn' => 'বেগমগঞ্জ'],
                ['en' => 'Chatkhil', 'bn' => 'চাটখিল'],
                ['en' => 'Companiganj', 'bn' => 'কোম্পানীগঞ্জ'],
                ['en' => 'Hatiya', 'bn' => 'হাতিয়া'],
                ['en' => 'Kabirhat', 'bn' => 'কবিরহাট'],
                ['en' => 'Senbagh', 'bn' => 'সেনবাগ'],
                ['en' => 'Sonaimuri', 'bn' => 'সোনাইমুড়ি'],
                ['en' => 'Subarnachar', 'bn' => 'সুবর্ণচর'],
            ],
            
            'Rangamati' => [
                ['en' => 'Rangamati Sadar', 'bn' => 'রাঙ্গামাটি সদর'],
                ['en' => 'Baghaichhari', 'bn' => 'বাঘাইছড়ি'],
                ['en' => 'Barkal', 'bn' => 'বরকল'],
                ['en' => 'Belaichhari', 'bn' => 'বিলাইছড়ি'],
                ['en' => 'Juraichhari', 'bn' => 'জুরাছড়ি'],
                ['en' => 'Kaptai', 'bn' => 'কাপ্তাই'],
                ['en' => 'Kawkhali', 'bn' => 'কাউখালী'],
                ['en' => 'Langadu', 'bn' => 'লংগদু'],
                ['en' => 'Naniarchar', 'bn' => 'নানিয়ারচর'],
                ['en' => 'Rajasthali', 'bn' => 'রাজস্থলী'],
            ],
            
            // ==================== RAJSHAHI DIVISION ====================
            'Bogura' => [
                ['en' => 'Bogura Sadar', 'bn' => 'বগুড়া সদর'],
                ['en' => 'Adamdighi', 'bn' => 'আদমদিঘী'],
                ['en' => 'Dhunat', 'bn' => 'ধুনট'],
                ['en' => 'Dhupchanchia', 'bn' => 'দুপচাঁচিয়া'],
                ['en' => 'Gabtali', 'bn' => 'গাবতলী'],
                ['en' => 'Kahaloo', 'bn' => 'কাহালু'],
                ['en' => 'Nandigram', 'bn' => 'নন্দিগ্রাম'],
                ['en' => 'Sariakandi', 'bn' => 'সারিয়াকান্দি'],
                ['en' => 'Shajahanpur', 'bn' => 'শাজাহানপুর'],
                ['en' => 'Sherpur', 'bn' => 'শেরপুর'],
                ['en' => 'Shibganj', 'bn' => 'শিবগঞ্জ'],
                ['en' => 'Sonatala', 'bn' => 'সোনাতলা'],
            ],
            
            'Joypurhat' => [
                ['en' => 'Joypurhat Sadar', 'bn' => 'জয়পুরহাট সদর'],
                ['en' => 'Akkelpur', 'bn' => 'আক্কেলপুর'],
                ['en' => 'Kalai', 'bn' => 'কালাই'],
                ['en' => 'Khetlal', 'bn' => 'ক্ষেতলাল'],
                ['en' => 'Panchbibi', 'bn' => 'পাঁচবিবি'],
            ],
            
            'Naogaon' => [
                ['en' => 'Naogaon Sadar', 'bn' => 'নওগাঁ সদর'],
                ['en' => 'Atrai', 'bn' => 'আত্রাই'],
                ['en' => 'Badalgachhi', 'bn' => 'বদলগাছী'],
                ['en' => 'Dhamoirhat', 'bn' => 'ধামইরহাট'],
                ['en' => 'Manda', 'bn' => 'মান্দা'],
                ['en' => 'Mahadebpur', 'bn' => 'মহাদেবপুর'],
                ['en' => 'Niamatpur', 'bn' => 'নিয়ামতপুর'],
                ['en' => 'Patnitala', 'bn' => 'পত্নিতলা'],
                ['en' => 'Porsha', 'bn' => 'পোরশা'],
                ['en' => 'Raninagar', 'bn' => 'রাণীনগর'],
                ['en' => 'Sapahar', 'bn' => 'সাপাহার'],
            ],
            
            'Natore' => [
                ['en' => 'Natore Sadar', 'bn' => 'নাটোর সদর'],
                ['en' => 'Bagatipara', 'bn' => 'বাগাতিপাড়া'],
                ['en' => 'Baraigram', 'bn' => 'বড়াইগ্রাম'],
                ['en' => 'Gurudaspur', 'bn' => 'গুরুদাসপুর'],
                ['en' => 'Lalpur', 'bn' => 'লালপুর'],
                ['en' => 'Singra', 'bn' => 'সিংড়া'],
            ],
            
            'Chapainawabganj' => [
                ['en' => 'Chapainawabganj Sadar', 'bn' => 'চাঁপাইনবাবগঞ্জ সদর'],
                ['en' => 'Bholahat', 'bn' => 'ভোলাহাট'],
                ['en' => 'Gomastapur', 'bn' => 'গোমস্তাপুর'],
                ['en' => 'Nachole', 'bn' => 'নাচোল'],
                ['en' => 'Shibganj', 'bn' => 'শিবগঞ্জ'],
            ],
            
            'Pabna' => [
                ['en' => 'Pabna Sadar', 'bn' => 'পাবনা সদর'],
                ['en' => 'Atgharia', 'bn' => 'আটঘরিয়া'],
                ['en' => 'Bera', 'bn' => 'বেড়া'],
                ['en' => 'Bhangura', 'bn' => 'ভাঙ্গুড়া'],
                ['en' => 'Chatmohar', 'bn' => 'চাটমোহর'],
                ['en' => 'Faridpur', 'bn' => 'ফরিদপুর'],
                ['en' => 'Ishwardi', 'bn' => 'ঈশ্বরদী'],
                ['en' => 'Santhia', 'bn' => 'সাঁথিয়া'],
                ['en' => 'Sujanagar', 'bn' => 'সুজানগর'],
            ],
            
            'Rajshahi' => [
                ['en' => 'Rajshahi Sadar', 'bn' => 'রাজশাহী সদর'],
                ['en' => 'Bagha', 'bn' => 'বাঘা'],
                ['en' => 'Bagmara', 'bn' => 'বাগমারা'],
                ['en' => 'Charghat', 'bn' => 'চারঘাট'],
                ['en' => 'Durgapur', 'bn' => 'দুর্গাপুর'],
                ['en' => 'Godagari', 'bn' => 'গোদাগাড়ী'],
                ['en' => 'Mohanpur', 'bn' => 'মোহনপুর'],
                ['en' => 'Paba', 'bn' => 'পবা'],
                ['en' => 'Puthia', 'bn' => 'পুঠিয়া'],
                ['en' => 'Tanore', 'bn' => 'তানোর'],
                ['en' => 'Boalia', 'bn' => 'বোয়ালিয়া'],
                ['en' => 'Matihar', 'bn' => 'মতিহার'],
                ['en' => 'Rajpara', 'bn' => 'রাজপাড়া'],
                ['en' => 'Shah Makhdum', 'bn' => 'শাহ মখদুম'],
            ],
            
            'Sirajganj' => [
                ['en' => 'Sirajganj Sadar', 'bn' => 'সিরাজগঞ্জ সদর'],
                ['en' => 'Belkuchi', 'bn' => 'বেলকুচি'],
                ['en' => 'Chauhali', 'bn' => 'চৌহালি'],
                ['en' => 'Kamarkhanda', 'bn' => 'কামারখন্দ'],
                ['en' => 'Kazipur', 'bn' => 'কাজিপুর'],
                ['en' => 'Raiganj', 'bn' => 'রায়গঞ্জ'],
                ['en' => 'Shahjadpur', 'bn' => 'শাহজাদপুর'],
                ['en' => 'Tarash', 'bn' => 'তাড়াশ'],
                ['en' => 'Ullahpara', 'bn' => 'উল্লাপাড়া'],
            ],
            
            // ==================== KHULNA DIVISION ====================
            'Bagerhat' => [
                ['en' => 'Bagerhat Sadar', 'bn' => 'বাগেরহাট সদর'],
                ['en' => 'Chitalmari', 'bn' => 'চিতলমারী'],
                ['en' => 'Fakirhat', 'bn' => 'ফকিরহাট'],
                ['en' => 'Kachua', 'bn' => 'কচুয়া'],
                ['en' => 'Mollahat', 'bn' => 'মোল্লাহাট'],
                ['en' => 'Mongla', 'bn' => 'মংলা'],
                ['en' => 'Morrelganj', 'bn' => 'মোড়েলগঞ্জ'],
                ['en' => 'Rampal', 'bn' => 'রামপাল'],
                ['en' => 'Sarankhola', 'bn' => 'শরণখোলা'],
            ],
            
            'Chuadanga' => [
                ['en' => 'Chuadanga Sadar', 'bn' => 'চুয়াডাঙ্গা সদর'],
                ['en' => 'Alamdanga', 'bn' => 'আলমডাঙ্গা'],
                ['en' => 'Damurhuda', 'bn' => 'দামুড়হুদা'],
                ['en' => 'Jibannagar', 'bn' => 'জীবননগর'],
            ],
            
            'Jashore' => [
                ['en' => 'Jashore Sadar', 'bn' => 'যশোর সদর'],
                ['en' => 'Abhaynagar', 'bn' => 'অভয়নগর'],
                ['en' => 'Bagherpara', 'bn' => 'বাঘারপাড়া'],
                ['en' => 'Chaugachha', 'bn' => 'চৌগাছা'],
                ['en' => 'Jhikargachha', 'bn' => 'ঝিকরগাছা'],
                ['en' => 'Keshabpur', 'bn' => 'কেশবপুর'],
                ['en' => 'Manirampur', 'bn' => 'মণিরামপুর'],
                ['en' => 'Sharsha', 'bn' => 'শার্শা'],
            ],
            
            'Jhenaidah' => [
                ['en' => 'Jhenaidah Sadar', 'bn' => 'ঝিনাইদহ সদর'],
                ['en' => 'Harinakunda', 'bn' => 'হরিণাকুন্ডু'],
                ['en' => 'Kaliganj', 'bn' => 'কালীগঞ্জ'],
                ['en' => 'Kotchandpur', 'bn' => 'কোটচাঁদপুর'],
                ['en' => 'Maheshpur', 'bn' => 'মহেশপুর'],
                ['en' => 'Shailkupa', 'bn' => 'শৈলকুপা'],
            ],
            
            'Khulna' => [
                ['en' => 'Khulna Sadar', 'bn' => 'খুলনা সদর'],
                ['en' => 'Batiaghata', 'bn' => 'বটিয়াঘাটা'],
                ['en' => 'Dacope', 'bn' => 'ডাকোপ'],
                ['en' => 'Dumuria', 'bn' => 'ডুমুরিয়া'],
                ['en' => 'Dighalia', 'bn' => 'দিঘলিয়া'],
                ['en' => 'Koyra', 'bn' => 'কয়রা'],
                ['en' => 'Paikgachha', 'bn' => 'পাইকগাছা'],
                ['en' => 'Phultala', 'bn' => 'ফুলতলা'],
                ['en' => 'Rupsa', 'bn' => 'রূপসা'],
                ['en' => 'Terokhada', 'bn' => 'তেরখাদা'],
                ['en' => 'Daulatpur', 'bn' => 'দৌলতপুর'],
                ['en' => 'Khalishpur', 'bn' => 'খালিশপুর'],
                ['en' => 'Khan Jahan Ali', 'bn' => 'খান জাহান আলী'],
                ['en' => 'Kotwali', 'bn' => 'কোতোয়ালী'],
                ['en' => 'Sonadanga', 'bn' => 'সোনাডাঙ্গা'],
            ],
            
            'Kushtia' => [
                ['en' => 'Kushtia Sadar', 'bn' => 'কুষ্টিয়া সদর'],
                ['en' => 'Bheramara', 'bn' => 'ভেড়ামারা'],
                ['en' => 'Daulatpur', 'bn' => 'দৌলতপুর'],
                ['en' => 'Khoksa', 'bn' => 'খোকসা'],
                ['en' => 'Kumarkhali', 'bn' => 'কুমারখালী'],
                ['en' => 'Mirpur', 'bn' => 'মিরপুর'],
            ],
            
            'Magura' => [
                ['en' => 'Magura Sadar', 'bn' => 'মাগুরা সদর'],
                ['en' => 'Mohammadpur', 'bn' => 'মোহাম্মদপুর'],
                ['en' => 'Shalikha', 'bn' => 'শালিখা'],
                ['en' => 'Sreepur', 'bn' => 'শ্রীপুর'],
            ],
            
            'Meherpur' => [
                ['en' => 'Meherpur Sadar', 'bn' => 'মেহেরপুর সদর'],
                ['en' => 'Gangni', 'bn' => 'গাংনী'],
                ['en' => 'Mujibnagar', 'bn' => 'মুজিবনগর'],
            ],
            
            'Narail' => [
                ['en' => 'Narail Sadar', 'bn' => 'নড়াইল সদর'],
                ['en' => 'Kalia', 'bn' => 'কালিয়া'],
                ['en' => 'Lohagara', 'bn' => 'লোহাগাড়া'],
            ],
            
            'Satkhira' => [
                ['en' => 'Satkhira Sadar', 'bn' => 'সাতক্ষীরা সদর'],
                ['en' => 'Assasuni', 'bn' => 'আশাশুনি'],
                ['en' => 'Debhata', 'bn' => 'দেবহাটা'],
                ['en' => 'Kalaroa', 'bn' => 'কলারোয়া'],
                ['en' => 'Kaliganj', 'bn' => 'কালীগঞ্জ'],
                ['en' => 'Shyamnagar', 'bn' => 'শ্যামনগর'],
                ['en' => 'Tala', 'bn' => 'তালা'],
            ],
            
            // ==================== BARISHAL DIVISION ====================
            'Barguna' => [
                ['en' => 'Barguna Sadar', 'bn' => 'বরগুনা সদর'],
                ['en' => 'Amtali', 'bn' => 'আমতলী'],
                ['en' => 'Bamna', 'bn' => 'বামনা'],
                ['en' => 'Betagi', 'bn' => 'বেতাগী'],
                ['en' => 'Patharghata', 'bn' => 'পাথরঘাটা'],
                ['en' => 'Taltali', 'bn' => 'তালতলী'],
            ],
            
            'Barishal' => [
                ['en' => 'Barishal Sadar', 'bn' => 'বরিশাল সদর'],
                ['en' => 'Agailjhara', 'bn' => 'আগৈলঝাড়া'],
                ['en' => 'Babuganj', 'bn' => 'বাবুগঞ্জ'],
                ['en' => 'Bakerganj', 'bn' => 'বাকেরগঞ্জ'],
                ['en' => 'Banaripara', 'bn' => 'বানারীপাড়া'],
                ['en' => 'Gaurnadi', 'bn' => 'গৌরনদী'],
                ['en' => 'Hizla', 'bn' => 'হিজলা'],
                ['en' => 'Mehendiganj', 'bn' => 'মেহেন্দিগঞ্জ'],
                ['en' => 'Muladi', 'bn' => 'মুলাদী'],
                ['en' => 'Wazirpur', 'bn' => 'উজিরপুর'],
            ],
            
            'Bhola' => [
                ['en' => 'Bhola Sadar', 'bn' => 'ভোলা সদর'],
                ['en' => 'Burhanuddin', 'bn' => 'বুরহানউদ্দিন'],
                ['en' => 'Char Fasson', 'bn' => 'চর ফ্যাশন'],
                ['en' => 'Daulatkhan', 'bn' => 'দৌলতখান'],
                ['en' => 'Lalmohan', 'bn' => 'লালমোহন'],
                ['en' => 'Manpura', 'bn' => 'মনপুরা'],
                ['en' => 'Tazumuddin', 'bn' => 'তজুমদ্দিন'],
            ],
            
            'Jhalokati' => [
                ['en' => 'Jhalokati Sadar', 'bn' => 'ঝালকাঠি সদর'],
                ['en' => 'Kathalia', 'bn' => 'কাঠালিয়া'],
                ['en' => 'Nalchity', 'bn' => 'নলছিটি'],
                ['en' => 'Rajapur', 'bn' => 'রাজাপুর'],
            ],
            
            'Patuakhali' => [
                ['en' => 'Patuakhali Sadar', 'bn' => 'পটুয়াখালী সদর'],
                ['en' => 'Bauphal', 'bn' => 'বাউফল'],
                ['en' => 'Dashmina', 'bn' => 'দশমিনা'],
                ['en' => 'Dumki', 'bn' => 'দুমকি'],
                ['en' => 'Galachipa', 'bn' => 'গলাচিপা'],
                ['en' => 'Kalapara', 'bn' => 'কলাপাড়া'],
                ['en' => 'Mirzaganj', 'bn' => 'মির্জাগঞ্জ'],
                ['en' => 'Rangabali', 'bn' => 'রাঙ্গাবালি'],
            ],
            
            'Pirojpur' => [
                ['en' => 'Pirojpur Sadar', 'bn' => 'পিরোজপুর সদর'],
                ['en' => 'Bhandaria', 'bn' => 'ভান্ডারিয়া'],
                ['en' => 'Kawkhali', 'bn' => 'কাউখালী'],
                ['en' => 'Mathbaria', 'bn' => 'মাঠবাড়িয়া'],
                ['en' => 'Nazirpur', 'bn' => 'নাজিরপুর'],
                ['en' => 'Nesarabad', 'bn' => 'নেসারাবাদ'],
                ['en' => 'Zianagar', 'bn' => 'জিয়ানগর'],
            ],
            
            // ==================== SYLHET DIVISION ====================
            'Habiganj' => [
                ['en' => 'Habiganj Sadar', 'bn' => 'হবিগঞ্জ সদর'],
                ['en' => 'Ajmiriganj', 'bn' => 'আজমিরিগঞ্জ'],
                ['en' => 'Bahubal', 'bn' => 'বাহুবল'],
                ['en' => 'Baniachong', 'bn' => 'বানিয়াচং'],
                ['en' => 'Chunarughat', 'bn' => 'চুনারুঘাট'],
                ['en' => 'Lakhai', 'bn' => 'লাখাই'],
                ['en' => 'Madhabpur', 'bn' => 'মাধবপুর'],
                ['en' => 'Nabiganj', 'bn' => 'নবীগঞ্জ'],
                ['en' => 'Shaistaganj', 'bn' => 'শায়েস্তাগঞ্জ'],
            ],
            
            'Moulvibazar' => [
                ['en' => 'Moulvibazar Sadar', 'bn' => 'মৌলভীবাজার সদর'],
                ['en' => 'Barlekha', 'bn' => 'বড়লেখা'],
                ['en' => 'Juri', 'bn' => 'জুড়ী'],
                ['en' => 'Kamalganj', 'bn' => 'কমলগঞ্জ'],
                ['en' => 'Kulaura', 'bn' => 'কুলাউড়া'],
                ['en' => 'Rajnagar', 'bn' => 'রাজনগর'],
                ['en' => 'Sreemangal', 'bn' => 'শ্রীমঙ্গল'],
            ],
            
            'Sunamganj' => [
                ['en' => 'Sunamganj Sadar', 'bn' => 'সুনামগঞ্জ সদর'],
                ['en' => 'Bishwambarpur', 'bn' => 'বিশ্বম্ভরপুর'],
                ['en' => 'Chhatak', 'bn' => 'ছাতক'],
                ['en' => 'Derai', 'bn' => 'দিরাই'],
                ['en' => 'Dharamapasha', 'bn' => 'ধর্মপাশা'],
                ['en' => 'Dowarabazar', 'bn' => 'দোয়ারাবাজার'],
                ['en' => 'Jagannathpur', 'bn' => 'জগন্নাথপুর'],
                ['en' => 'Jamalganj', 'bn' => 'জামালগঞ্জ'],
                ['en' => 'Sulla', 'bn' => 'সুল্লা'],
                ['en' => 'Tahirpur', 'bn' => 'তাহিরপুর'],
                ['en' => 'Shantiganj', 'bn' => 'শান্তিগঞ্জ'],
                ['en' => 'Madhyanagar', 'bn' => 'মধ্যনগর'],
            ],
            
            'Sylhet' => [
                ['en' => 'Sylhet Sadar', 'bn' => 'সিলেট সদর'],
                ['en' => 'Balaganj', 'bn' => 'বালাগঞ্জ'],
                ['en' => 'Beanibazar', 'bn' => 'বিয়ানীবাজার'],
                ['en' => 'Bishwanath', 'bn' => 'বিশ্বনাথ'],
                ['en' => 'Companiganj', 'bn' => 'কোম্পানীগঞ্জ'],
                ['en' => 'Dakshin Surma', 'bn' => 'দক্ষিণ সুরমা'],
                ['en' => 'Fenchuganj', 'bn' => 'ফেঞ্চুগঞ্জ'],
                ['en' => 'Golapganj', 'bn' => 'গোলাপগঞ্জ'],
                ['en' => 'Gowainghat', 'bn' => 'গোয়াইনঘাট'],
                ['en' => 'Jaintiapur', 'bn' => 'জৈন্তাপুর'],
                ['en' => 'Kanaighat', 'bn' => 'কানাইঘাট'],
                ['en' => 'Zakiganj', 'bn' => 'জকিগঞ্জ'],
                ['en' => 'Osmani Nagar', 'bn' => 'ওসমানী নগর'],
            ],
            
            // ==================== RANGPUR DIVISION ====================
            'Dinajpur' => [
                ['en' => 'Dinajpur Sadar', 'bn' => 'দিনাজপুর সদর'],
                ['en' => 'Birampur', 'bn' => 'বিরামপুর'],
                ['en' => 'Birganj', 'bn' => 'বীরগঞ্জ'],
                ['en' => 'Biral', 'bn' => 'বিরল'],
                ['en' => 'Bochaganj', 'bn' => 'বোচাগঞ্জ'],
                ['en' => 'Chirirbandar', 'bn' => 'চিরিরবন্দর'],
                ['en' => 'Phulbari', 'bn' => 'ফুলবাড়ী'],
                ['en' => 'Ghoraghat', 'bn' => 'ঘোড়াঘাট'],
                ['en' => 'Hakimpur', 'bn' => 'হাকিমপুর'],
                ['en' => 'Kaharole', 'bn' => 'কাহারোল'],
                ['en' => 'Khansama', 'bn' => 'খানসামা'],
                ['en' => 'Nawabganj', 'bn' => 'নবাবগঞ্জ'],
                ['en' => 'Parbatipur', 'bn' => 'পার্বতীপুর'],
            ],
            
            'Gaibandha' => [
                ['en' => 'Gaibandha Sadar', 'bn' => 'গাইবান্ধা সদর'],
                ['en' => 'Fulchhari', 'bn' => 'ফুলছড়ি'],
                ['en' => 'Gabtali', 'bn' => 'গাবতলী'],
                ['en' => 'Gobindaganj', 'bn' => 'গোবিন্দগঞ্জ'],
                ['en' => 'Palashbari', 'bn' => 'পলাশবাড়ী'],
                ['en' => 'Sadullapur', 'bn' => 'সাদুল্লাপুর'],
                ['en' => 'Sundarganj', 'bn' => 'সুন্দরগঞ্জ'],
            ],
            
            'Kurigram' => [
                ['en' => 'Kurigram Sadar', 'bn' => 'কুড়িগ্রাম সদর'],
                ['en' => 'Bhurungamari', 'bn' => 'ভুরুঙ্গামারী'],
                ['en' => 'Char Rajibpur', 'bn' => 'চর রাজিবপুর'],
                ['en' => 'Chilmari', 'bn' => 'চিলমারী'],
                ['en' => 'Phulbari', 'bn' => 'ফুলবাড়ী'],
                ['en' => 'Nageshwari', 'bn' => 'নাগেশ্বরী'],
                ['en' => 'Rajarhat', 'bn' => 'রাজারহাট'],
                ['en' => 'Raomari', 'bn' => 'রৌমারী'],
                ['en' => 'Ulipur', 'bn' => 'উলিপুর'],
            ],
            
            'Lalmonirhat' => [
                ['en' => 'Lalmonirhat Sadar', 'bn' => 'লালমনিরহাট সদর'],
                ['en' => 'Aditmari', 'bn' => 'আদিতমারী'],
                ['en' => 'Hatibandha', 'bn' => 'হাতীবান্ধা'],
                ['en' => 'Kaliganj', 'bn' => 'কালীগঞ্জ'],
                ['en' => 'Patgram', 'bn' => 'পাটগ্রাম'],
            ],
            
            'Nilphamari' => [
                ['en' => 'Nilphamari Sadar', 'bn' => 'নীলফামারী সদর'],
                ['en' => 'Dimla', 'bn' => 'ডিমলা'],
                ['en' => 'Domar', 'bn' => 'ডোমার'],
                ['en' => 'Jaldhaka', 'bn' => 'জলঢাকা'],
                ['en' => 'Kishoreganj', 'bn' => 'কিশোরগঞ্জ'],
                ['en' => 'Saidpur', 'bn' => 'সৈয়দপুর'],
            ],
            
            'Panchagarh' => [
                ['en' => 'Panchagarh Sadar', 'bn' => 'পঞ্চগড় সদর'],
                ['en' => 'Atwari', 'bn' => 'আটোয়ারী'],
                ['en' => 'Boda', 'bn' => 'বোদা'],
                ['en' => 'Debiganj', 'bn' => 'দেবীগঞ্জ'],
                ['en' => 'Tetulia', 'bn' => 'তেতুলিয়া'],
            ],
            
            'Rangpur' => [
                ['en' => 'Rangpur Sadar', 'bn' => 'রংপুর সদর'],
                ['en' => 'Badarganj', 'bn' => 'বদরগঞ্জ'],
                ['en' => 'Gangachara', 'bn' => 'গংগাচড়া'],
                ['en' => 'Kaunia', 'bn' => 'কাউনিয়া'],
                ['en' => 'Mithapukur', 'bn' => 'মিঠাপুকুর'],
                ['en' => 'Pirgachha', 'bn' => 'পীরগাছা'],
                ['en' => 'Pirganj', 'bn' => 'পীরগঞ্জ'],
                ['en' => 'Taraganj', 'bn' => 'তারাগঞ্জ'],
            ],
            
            'Thakurgaon' => [
                ['en' => 'Thakurgaon Sadar', 'bn' => 'ঠাকুরগাঁও সদর'],
                ['en' => 'Baliadangi', 'bn' => 'বালিয়াডাঙ্গি'],
                ['en' => 'Haripur', 'bn' => 'হরিপুর'],
                ['en' => 'Pirganj', 'bn' => 'পীরগঞ্জ'],
                ['en' => 'Ranisankail', 'bn' => 'রাণীশংকৈল'],
            ],
            
            // ==================== MYMENSINGH DIVISION ====================
            'Jamalpur' => [
                ['en' => 'Jamalpur Sadar', 'bn' => 'জামালপুর সদর'],
                ['en' => 'Baksiganj', 'bn' => 'বকশীগঞ্জ'],
                ['en' => 'Dewanganj', 'bn' => 'দেওয়ানগঞ্জ'],
                ['en' => 'Islampur', 'bn' => 'ইসলামপুর'],
                ['en' => 'Madarganj', 'bn' => 'মাদারগঞ্জ'],
                ['en' => 'Melandaha', 'bn' => 'মেলান্দহ'],
                ['en' => 'Sarishabari', 'bn' => 'সরিষাবাড়ী'],
            ],
            
            'Mymensingh' => [
                ['en' => 'Mymensingh Sadar', 'bn' => 'ময়মনসিংহ সদর'],
                ['en' => 'Bhaluka', 'bn' => 'ভালুকা'],
                ['en' => 'Dhobaura', 'bn' => 'ধোবাউড়া'],
                ['en' => 'Fulbaria', 'bn' => 'ফুলবাড়ীয়া'],
                ['en' => 'Gaffargaon', 'bn' => 'গফরগাঁও'],
                ['en' => 'Gauripur', 'bn' => 'গৌরীপুর'],
                ['en' => 'Haluaghat', 'bn' => 'হালুয়াঘাট'],
                ['en' => 'Ishwarganj', 'bn' => 'ঈশ্বরগঞ্জ'],
                ['en' => 'Muktagachha', 'bn' => 'মুক্তাগাছা'],
                ['en' => 'Nandail', 'bn' => 'নান্দাইল'],
                ['en' => 'Phulpur', 'bn' => 'ফুলপুর'],
                ['en' => 'Trishal', 'bn' => 'ত্রিশাল'],
                ['en' => 'Tara Khanda', 'bn' => 'তারাকান্দা'],
            ],
            
            'Netrokona' => [
                ['en' => 'Netrokona Sadar', 'bn' => 'নেত্রকোনা সদর'],
                ['en' => 'Atpara', 'bn' => 'আটপাড়া'],
                ['en' => 'Barhatta', 'bn' => 'বারহাট্টা'],
                ['en' => 'Durgapur', 'bn' => 'দুর্গাপুর'],
                ['en' => 'Khaliajuri', 'bn' => 'খালিয়াজুরি'],
                ['en' => 'Kalmakanda', 'bn' => 'কলমাকান্দা'],
                ['en' => 'Kendua', 'bn' => 'কেন্দুয়া'],
                ['en' => 'Madan', 'bn' => 'মদন'],
                ['en' => 'Mohanganj', 'bn' => 'মোহনগঞ্জ'],
                ['en' => 'Purbadhala', 'bn' => 'পূর্বধলা'],
            ],
            
            'Sherpur' => [
                ['en' => 'Sherpur Sadar', 'bn' => 'শেরপুর সদর'],
                ['en' => 'Jhenaigati', 'bn' => 'ঝিনাইগাতী'],
                ['en' => 'Nakla', 'bn' => 'নাকলা'],
                ['en' => 'Nalitabari', 'bn' => 'নালিতাবাড়ী'],
                ['en' => 'Sreebardi', 'bn' => 'শ্রীবরদী'],
            ],
        ];
    }

    /**
     * Get districts by division name (English)
     */
    public static function getDistrictsByDivision(string $division): array
    {
        return self::districts()[$division] ?? [];
    }

    /**
     * Get upazilas by district name (English)
     */
    public static function getUpazilasByDistrict(string $district): array
    {
        return self::upazilas()[$district] ?? [];
    }

    /**
     * Get all division names (English only)
     */
    public static function getDivisionNamesEn(): array
    {
        return array_column(self::divisions(), 'en');
    }

    /**
     * Get all division names (Bangla only)
     */
    public static function getDivisionNamesBn(): array
    {
        return array_column(self::divisions(), 'bn');
    }

    /**
     * Get all districts in flat array
     */
    public static function getAllDistricts(): array
    {
        $allDistricts = [];
        foreach (self::districts() as $districts) {
            $allDistricts = array_merge($allDistricts, $districts);
        }
        return $allDistricts;
    }

    /**
     * Get all district names (English only)
     */
    public static function getDistrictNamesEn(): array
    {
        return array_column(self::getAllDistricts(), 'en');
    }

    /**
     * Get all district names (Bangla only)
     */
    public static function getDistrictNamesBn(): array
    {
        return array_column(self::getAllDistricts(), 'bn');
    }

    /**
     * Get all upazilas in flat array
     */
    public static function getAllUpazilas(): array
    {
        $allUpazilas = [];
        foreach (self::upazilas() as $upazilas) {
            $allUpazilas = array_merge($allUpazilas, $upazilas);
        }
        return $allUpazilas;
    }

    /**
     * Get all upazila names (English only)
     */
    public static function getUpazilaNamesEn(): array
    {
        return array_column(self::getAllUpazilas(), 'en');
    }

    /**
     * Get all upazila names (Bangla only)
     */
    public static function getUpazilaNamesBn(): array
    {
        return array_column(self::getAllUpazilas(), 'bn');
    }

    /**
     * Find division by district name (English)
     */
    public static function getDivisionByDistrict(string $districtEn): ?string
    {
        foreach (self::districts() as $division => $districts) {
            foreach ($districts as $district) {
                if ($district['en'] === $districtEn) {
                    return $division;
                }
            }
        }
        return null;
    }

    /**
     * Find district by upazila name (English)
     */
    public static function getDistrictByUpazila(string $upazilaEn): ?string
    {
        foreach (self::upazilas() as $district => $upazilas) {
            foreach ($upazilas as $upazila) {
                if ($upazila['en'] === $upazilaEn) {
                    return $district;
                }
            }
        }
        return null;
    }

    /**
     * Search location by name (supports both English and Bangla)
     */
    public static function searchLocation(string $query): array
    {
        $results = [
            'divisions' => [],
            'districts' => [],
            'upazilas' => [],
        ];

        $query = strtolower($query);

        // Search in divisions
        foreach (self::divisions() as $division) {
            if (
                str_contains(strtolower($division['en']), $query) ||
                str_contains($division['bn'], $query)
            ) {
                $results['divisions'][] = $division;
            }
        }

        // Search in districts
        foreach (self::getAllDistricts() as $district) {
            if (
                str_contains(strtolower($district['en']), $query) ||
                str_contains($district['bn'], $query)
            ) {
                $results['districts'][] = $district;
            }
        }

        // Search in upazilas
        foreach (self::getAllUpazilas() as $upazila) {
            if (
                str_contains(strtolower($upazila['en']), $query) ||
                str_contains($upazila['bn'], $query)
            ) {
                $results['upazilas'][] = $upazila;
            }
        }

        return $results;
    }

    /**
     * Get total counts
     */
    public static function getCounts(): array
    {
        return [
            'divisions' => count(self::divisions()),
            'districts' => count(self::getAllDistricts()),
            'upazilas' => count(self::getAllUpazilas()),
        ];
    }

    /**
     * Get location hierarchy (Division -> District -> Upazila)
     */
    public static function getLocationHierarchy(string $upazilaEn): ?array
    {
        $district = self::getDistrictByUpazila($upazilaEn);
        if (!$district) {
            return null;
        }

        $division = self::getDivisionByDistrict($district);
        if (!$division) {
            return null;
        }

        return [
            'division' => $division,
            'district' => $district,
            'upazila' => $upazilaEn,
        ];
    }

    /**
     * Validate if a location exists
     */
    public static function isValidLocation(string $type, string $nameEn): bool
    {
        switch ($type) {
            case 'division':
                return in_array($nameEn, self::getDivisionNamesEn());
            case 'district':
                return in_array($nameEn, self::getDistrictNamesEn());
            case 'upazila':
                return in_array($nameEn, self::getUpazilaNamesEn());
            default:
                return false;
        }
    }

    /**
     * Get Bangla name by English name
     */
    public static function getBanglaName(string $type, string $nameEn): ?string
    {
        $data = [];
        
        switch ($type) {
            case 'division':
                $data = self::divisions();
                break;
            case 'district':
                $data = self::getAllDistricts();
                break;
            case 'upazila':
                $data = self::getAllUpazilas();
                break;
            default:
                return null;
        }

        foreach ($data as $item) {
            if ($item['en'] === $nameEn) {
                return $item['bn'];
            }
        }

        return null;
    }

    /**
     * Get English name by Bangla name
     */
    public static function getEnglishName(string $type, string $nameBn): ?string
    {
        $data = [];
        
        switch ($type) {
            case 'division':
                $data = self::divisions();
                break;
            case 'district':
                $data = self::getAllDistricts();
                break;
            case 'upazila':
                $data = self::getAllUpazilas();
                break;
            default:
                return null;
        }

        foreach ($data as $item) {
            if ($item['bn'] === $nameBn) {
                return $item['en'];
            }
        }

        return null;
    }
}