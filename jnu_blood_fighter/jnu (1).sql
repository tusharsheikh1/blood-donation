-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2025 at 03:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jnu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'admin@blooddonor.com', '$2y$12$Dfpw6kgleblWa.ZuxHut8egkAXbbQ82UCETF704ikigpQ.oWiA9cu', NULL, '2025-10-04 18:58:14', '2025-10-04 19:06:39'),
(5, 'System Admin', 'admin@reddrop.com', '$2y$12$bp/u1zULkbB5QiMS557j1Om3ChO/QU25VRk9TlalDWj5rq521eyVW', NULL, '2025-10-04 19:07:35', '2025-10-04 19:07:35'),
(9, 'System Admin', 'admin@reddrop1.com', '$2y$12$tsWQV7rp0C2ntAxcrpyOPeLEjR9Ebk3EQ3R80bCcPdVA3s55uMAu6', NULL, '2025-10-04 19:16:48', '2025-10-04 19:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donor_id` bigint(20) UNSIGNED NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `disease` varchar(255) NOT NULL,
  `blood_type` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') NOT NULL,
  `blood_quantity` int(11) NOT NULL,
  `is_emergency` tinyint(1) NOT NULL DEFAULT 0,
  `needed_date` datetime DEFAULT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `hospital_location` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `upazila` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `additional_notes` text DEFAULT NULL,
  `status` enum('active','fulfilled','cancelled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `donor_id`, `patient_name`, `disease`, `blood_type`, `blood_quantity`, `is_emergency`, `needed_date`, `hospital_name`, `hospital_location`, `division`, `district`, `upazila`, `contact_number`, `additional_notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 51, 'Testing', 'Nothing Alhamdulillah', 'O+', 1, 0, '2025-10-31 07:21:00', 'gggggggggg', 'gggggggggggggggg', 'Barishal', 'Patuakhali', 'Mirzaganj', '01774405367', NULL, 'active', '2025-10-04 19:21:38', '2025-10-04 19:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` text NOT NULL,
  `division` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `upazila` varchar(255) NOT NULL,
  `blood_type` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `last_donation_date` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `name`, `email`, `phone`, `address`, `division`, `district`, `upazila`, `blood_type`, `is_available`, `last_donation_date`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arif Hasan', 'arif.hasan@example.com', '01711000001', 'House 12, Road 3, Dhanmondi', 'Dhaka', 'Dhaka', 'Dhanmondi', 'A+', 1, '2025-08-12', '$2y$12$YaFtboRcKCDyPLkD8BoV6Os4kB/emezto5VcXyhrhICAbf1A8WxpO', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(2, 'Mehnaz Rahman', 'mehnaz.rahman@example.com', '01711000002', 'North Kattoli', 'Chattogram', 'Chattogram', 'Pahartali', 'B+', 1, '2025-06-20', '$2y$12$7cBKADMkBkBKS/ZRVI/I0.8lx3WlH0g6V2hsr2kOzi1khBwSGfHD.', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(3, 'Tariq Islam', 'tariq.islam@example.com', '01711000003', 'Amberkhana', 'Sylhet', 'Sylhet', 'Sylhet Sadar', 'O+', 1, '2025-04-10', '$2y$12$.Nr01K75xEti6.ouWi35rujsLmDCO4qD6Tn7lwJ9mOvbM0dV1nU9y', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(4, 'Farzana Akter', 'farzana.akter@example.com', '01711000004', 'Shaheb Bazar', 'Rajshahi', 'Rajshahi', 'Rajshahi Sadar', 'AB+', 1, '2025-07-15', '$2y$12$UZwiiE9EupvBtuFfGeudfuERJvxwtp7fICKWOPyheQv.CecgS43EO', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(5, 'Nayeem Chowdhury', 'nayeem.chowdhury@example.com', '01711000005', 'Sonadanga', 'Khulna', 'Khulna', 'Khulna Sadar', 'A-', 1, '2025-05-28', '$2y$12$vRj8iYAm4ntXfKwzNMPFT.B/wmct/JOgX4IFZfWD6ukzCrNzLUfJy', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(6, 'Lamia Karim', 'lamia.karim@example.com', '01711000006', 'Nabab Road', 'Barishal', 'Barishal', 'Barishal Sadar', 'B-', 1, '2025-09-01', '$2y$12$MJDoNTO8e3cJZQWhKRMeL.S4kWhpWJMwTtLCW/WplfcHX9h/m6Ic.', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(7, 'Rafiul Alam', 'rafiul.alam@example.com', '01711000007', 'Kandirpar', 'Chattogram', 'Cumilla', 'Cumilla Adarsha Sadar', 'O-', 1, '2025-07-29', '$2y$12$LA6gkPe11Xg4a7ZlNOTYhO.oh3OXkY4bzPLPjpBdVNd/yOj6I420K', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(8, 'Shakila Binte Noor', 'shakila.noor@example.com', '01711000008', 'College Road', 'Rangpur', 'Rangpur', 'Rangpur Sadar', 'AB-', 1, '2025-03-18', '$2y$12$/onHItOKYdhLuYZ.HBaL0.k23lDZO1Fbqjyz3r9HQ2XLQ/9iNTfnG', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(9, 'Mahmudul Hasan', 'mahmudul.hasan@example.com', '01711000009', 'Ganginar Par', 'Mymensingh', 'Mymensingh', 'Mymensingh Sadar', 'A+', 1, '2025-06-02', '$2y$12$0aZa9alDR.MZAMTCcw5vUurMjewY2y4FyJpacmAJwug5tpb1S23Vq', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(10, 'Sadia Khatun', 'sadia.khatun@example.com', '01711000010', 'Fatullah', 'Dhaka', 'Narayanganj', 'Narayanganj Sadar', 'O+', 1, '2025-08-20', '$2y$12$.A/q5P/PxUIho2AyYqSGGOrBbmRofUDUXugYxgu3os6Iw/RGbF7IS', NULL, '2025-10-04 19:15:50', '2025-10-04 19:18:11'),
(21, 'Imran Hossain', 'imran.hossain@example.com', '01711000011', 'Banani', 'Dhaka', 'Dhaka', 'Banani', 'B+', 1, '2025-05-10', '$2y$12$GXyAz3wpUOalxLgmVjBt7eK.7e3/DMqi4YoOTR.0CbnwyGEYK/ZJy', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(22, 'Sumaiya Yasmin', 'sumaiya.yasmin@example.com', '01711000012', 'Kotwali', 'Chattogram', 'Chattogram', 'Kotwali', 'A-', 1, '2025-02-20', '$2y$12$YIYIUDGBjFfVdbNOqp1Lg.coq0a2TpXNmsI8A6WsmrCg1pAbOblAe', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(23, 'Shahidul Islam', 'shahidul.islam@example.com', '01711000013', 'Kazir Dewri', 'Chattogram', 'Chattogram', 'Chawkbazar', 'O+', 0, '2024-12-25', '$2y$12$uU1Ir0rLTvb5lhVVJGAXR.KolCJ1jdVi8SpAvLgVH28LekwYUqTYi', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(24, 'Afsana Begum', 'afsana.begum@example.com', '01711000014', 'Kushtia Sadar', 'Khulna', 'Kushtia', 'Kushtia Sadar', 'AB-', 1, '2025-03-10', '$2y$12$AXjPUA1h0p.SyNqBvVCqFuTsXxI/ouc83o4Gy9XJm/4mWjx/t8da6', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(25, 'Tanvir Ahmed', 'tanvir.ahmed@example.com', '01711000015', 'Boalia', 'Rajshahi', 'Rajshahi', 'Boalia', 'O-', 1, '2025-09-10', '$2y$12$JUxj.9eK7ZvD/.B8F4DfZOz6Rz6KbFB7Ti9YK1F8oWR0Md7fnZBou', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(26, 'Rumana Islam', 'rumana.islam@example.com', '01711000016', 'Narsingdi Sadar', 'Dhaka', 'Narsingdi', 'Narsingdi Sadar', 'B+', 1, '2025-06-15', '$2y$12$F.e5zTLec63Q/zkdyxuK..GQ.dnu/BrbNq8XJ7Tto0/leBAmDpRJ2', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(27, 'Ashraful Karim', 'ashraful.karim@example.com', '01711000017', 'Chandgaon', 'Chattogram', 'Chattogram', 'Chandgaon', 'A+', 1, '2025-07-05', '$2y$12$waOnhmTo33h2j8VEnZh/t.bdgxk0pFem73BKCZ./ir5LLeWH0azry', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(28, 'Jannatul Ferdous', 'jannatul.ferdous@example.com', '01711000018', 'Zindabazar', 'Sylhet', 'Sylhet', 'Sylhet Sadar', 'O-', 1, '2025-04-15', '$2y$12$42vWtjuj9pqVDew2aFUq1O.cxM4D7aJQmTL.vGna7doEFQtJuj9VO', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(29, 'Muntasir Rahman', 'muntasir.rahman@example.com', '01711000019', 'Jashore Sadar', 'Khulna', 'Jashore', 'Jashore Sadar', 'B-', 0, '2025-01-25', '$2y$12$wpgDdPA4.BfaAM/UPY/gk.TQ6p/XGywRUja/5H/y/BWkk1MqpycK2', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(30, 'Khadija Akter', 'khadija.akter@example.com', '01711000020', 'Sadarghat', 'Chattogram', 'Chattogram', 'Sadarghat', 'A+', 1, '2025-08-01', '$2y$12$G.qN5sEQGGKfOQAJNiIss.y/.VwMRbvLyEHAs668Cep4AtdKglTwe', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(31, 'Faisal Rahim', 'faisal.rahim@example.com', '01711000021', 'Mirpur', 'Dhaka', 'Dhaka', 'Mirpur', 'O+', 1, '2025-09-15', '$2y$12$wTAdAkPFDuFDhOYZUVdtlO2CWRPvLX9AT4/bEIGJWe4J0udxtTvz6', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(32, 'Nasrin Jahan', 'nasrin.jahan@example.com', '01711000022', 'Kazihata', 'Rajshahi', 'Rajshahi', 'Rajpara', 'AB+', 1, '2025-05-25', '$2y$12$VHuBaGcRvvk2CMQGqY/YdOHVJZX4g42GmD9BVs5JrMc2ORYMBn3WC', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(33, 'Rashidul Islam', 'rashidul.islam@example.com', '01711000023', 'Gulshan', 'Dhaka', 'Dhaka', 'Gulshan', 'B+', 1, '2025-06-18', '$2y$12$jj1jvk/qjQCFSrrmK0crUOhlXK2pBMUvRWi5uLZR6vbkemf.nmBQC', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(34, 'Munira Chowdhury', 'munira.chowdhury@example.com', '01711000024', 'Halishahar', 'Chattogram', 'Chattogram', 'Halishahar', 'A-', 1, '2025-07-22', '$2y$12$vldO8RSzg3X.a77XEgsFT.FdylEN9d2/yErOvEey1NX2JBfQYG3iq', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(35, 'Samiul Haque', 'samiul.haque@example.com', '01711000025', 'Mymensingh Town', 'Mymensingh', 'Mymensingh', 'Mymensingh Sadar', 'O-', 1, '2025-02-28', '$2y$12$CyhfPVYW7Ri7rXHOhbUW1.uY782lyGNfvV6MhG3J4MzsMTQnkLjji', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(36, 'Tania Parvin', 'tania.parvin@example.com', '01711000026', 'Patenga', 'Chattogram', 'Chattogram', 'Patenga', 'AB-', 1, '2025-09-02', '$2y$12$923Cd/NbhLR1pL2T8S//TeoYjEXFqWuMednBGSDEUvlZEoTcJRLzq', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(37, 'Nafis Ahmed', 'nafis.ahmed@example.com', '01711000027', 'Savar', 'Dhaka', 'Dhaka', 'Savar', 'A+', 1, '2025-03-19', '$2y$12$jvmosXmWlfi.DbzFEkRPnuho2hEkhS/LK1Ib2IaM1sn7/Aem.yASW', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(38, 'Lutfun Nahar', 'lutfun.nahar@example.com', '01711000028', 'Kurigram Sadar', 'Rangpur', 'Kurigram', 'Kurigram Sadar', 'B+', 1, '2025-04-05', '$2y$12$iHV8gNGGd5NHhdCxQmOm.e4bvnuEv/e0QTCFH6Qf7DUgJ8jvx/AFu', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(39, 'Ishrat Jahan', 'ishrat.jahan@example.com', '01711000029', 'Shibganj', 'Rajshahi', 'Chapainawabganj', 'Shibganj', 'O+', 1, '2025-08-15', '$2y$12$puFH7mvnF3HD6VyVKiAmxeRzqZDVcTVpZ4pbLHt/rbQ14iDn/gWmS', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(40, 'Zahidul Haque', 'zahidul.haque@example.com', '01711000030', 'Panchagarh Sadar', 'Rangpur', 'Panchagarh', 'Panchagarh Sadar', 'A-', 1, '2025-05-30', '$2y$12$jgFoY5.vJvYNvf0dDrduleSnZc1OZqlDw9hN/sfPpPKrUJ7rgxrYm', NULL, '2025-10-04 19:18:11', '2025-10-04 19:18:11'),
(51, 'Tushar Sheikh', 'tushar.mkt15@gmail.com', '01774405367', 'Not interested to share', 'Dhaka', 'Dhaka', 'Sutrapur', 'O+', 1, '2025-08-05', '$2y$12$UTBpBjzaY9pTTLg5Geg.FO6jSbTRNK5QMFL52xBldCaFYh9q7HIKa', NULL, '2025-10-04 19:20:09', '2025-10-04 19:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_03_211253_create_donors_table', 1),
(5, '2025_10_03_230155_create_admins_table', 1),
(6, '2025_10_04_083316_create_blood_requests_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('XdfZJPdXRrvEcU5NTzlJoMnAWvN9Gnhj0e4SUCvn', 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU0xFeGNIdUFWbXBxdDJ0MGdHNmtxdk1xUlJ5d2EwVWV4S1l4bXhuWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjUxO30=', 1759627314);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_requests_donor_id_foreign` (`donor_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donors_email_unique` (`email`),
  ADD UNIQUE KEY `donors_phone_unique` (`phone`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `blood_requests_donor_id_foreign` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
