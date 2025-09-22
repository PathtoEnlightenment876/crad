-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 10:54 PM
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
-- Database: `crad`
--

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
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submission_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `adviser_name` varchar(255) DEFAULT NULL,
  `panel1` varchar(255) DEFAULT NULL,
  `panel2` varchar(255) DEFAULT NULL,
  `panel3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`id`, `submission_id`, `role`, `name`, `department`, `created_at`, `updated_at`, `adviser_name`, `panel1`, `panel2`, `panel3`) VALUES
(6, 1, NULL, NULL, NULL, '2025-09-20 02:58:53', '2025-09-20 02:58:53', 'Prof John Doe', 'Doc John Doe', 'Doc John Doe', 'Doc John Doe'),
(7, 10, NULL, NULL, NULL, '2025-09-22 14:33:46', '2025-09-22 14:33:46', 'Prof John Doe', 'Doc John Doe', 'Doc John Doe', 'Doc John Doe'),
(8, 13, NULL, NULL, NULL, '2025-09-22 14:46:29', '2025-09-22 14:46:29', 'Prof John Doe', 'Doc John Doe', 'Doc John Doe', 'Doc John Doe'),
(9, 14, NULL, NULL, NULL, '2025-09-23 02:48:32', '2025-09-23 02:48:32', 'Prof John Doe', 'Doc John Doe', 'Doc John Doe', 'Doc John Doe'),
(11, 17, NULL, NULL, NULL, '2025-09-23 03:10:51', '2025-09-23 03:10:51', 'bret', 'Doc John Doe', 'Doc. John Doe', 'Doc John Doe');

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
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `cluster` int(11) NOT NULL,
  `group_no` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `feedback` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(10, '0001_01_01_000000_create_users_table', 1),
(11, '0001_01_01_000001_create_cache_table', 1),
(12, '0001_01_01_000002_create_jobs_table', 1),
(13, '2025_08_31_212114_create_otps_table', 1),
(14, '2025_08_31_214022_add_otp_columns_to_users_table', 1),
(15, '2025_08_31_214712_add_role_to_users_table', 1),
(16, '2025_09_16_192701_create_submissions_table', 1),
(17, '2025_09_16_194145_create_files_table', 1),
(18, '2025_09_16_204650_add_user_id_to_submissions_table', 1),
(19, '2025_09_16_221838_add_cluster_group_department_to_submissions_table', 1),
(20, '2025_09_16_222633_add_is_admin_to_users_table', 2),
(21, '2025_09_17_182851_add_submission_id_to_committee_table', 3),
(22, '2025_09_17_193920_create_committees_table', 4),
(23, '2025_09_17_201728_add_committee_fields_to_committees_table', 5),
(24, '2025_09_17_202016_update_role_column_in_committees_table', 6),
(25, '2025_09_17_202225_make_name_nullable_in_committees_table', 7),
(26, '2025_09_17_203113_add_committee_fields_to_committees_table', 8),
(27, '2025_09_17_212419_create_resubmission_histories_table', 9),
(28, '2025_09_17_220633_create_notifications_table', 10),
(29, '2025_09_17_230035_add_due_date_to_submissions_table', 11),
(30, '2025_09_17_230404_add_chapter_to_submissions_table', 12),
(31, '2025_09_22_181526_add_department_cluster_group_to_users_table', 13),
(32, '2025_09_22_191852_create_submission_histories_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `message`, `read`, `created_at`, `updated_at`) VALUES
(1, 2, 'status', 'Your submission \'HAHAHAH\' has been Approved. ', 0, '2025-09-18 05:38:33', '2025-09-18 05:38:33'),
(2, 2, 'feedback', 'Your submission \'HAHAHAH\' has been Approved. Feedback: Nice', 0, '2025-09-18 05:38:44', '2025-09-18 05:38:44'),
(3, 2, 'feedback', 'Your submission \'Dark Psych\' has been Resubmitted. Feedback: Ok', 0, '2025-09-18 05:45:27', '2025-09-18 05:45:27'),
(4, 2, 'feedback', 'Your submission \'Dark Psych\' has been Resubmitted. Feedback: Ok', 0, '2025-09-18 05:45:28', '2025-09-18 05:45:28'),
(5, 2, 'status', 'Your submission \'Dark Psych\' has been Approved. ', 0, '2025-09-18 05:45:36', '2025-09-18 05:45:36'),
(6, 2, 'feedback', 'Your submission \'Stoic Philosophy\' has been Pending. Feedback: Good', 0, '2025-09-18 06:08:40', '2025-09-18 06:08:40'),
(7, 2, 'status', 'Your submission \'Stoic Philosophy\' has been Approved. ', 0, '2025-09-18 06:08:49', '2025-09-18 06:08:49'),
(8, 2, 'status', 'Your submission \'HAHAHAHA\' has been Rejected. ', 0, '2025-09-18 15:47:09', '2025-09-18 15:47:09'),
(9, 2, 'status', 'Your submission \'HAHAHAHA\' has been Approved. ', 0, '2025-09-18 15:48:18', '2025-09-18 15:48:18'),
(10, 2, 'feedback', 'Your submission \'HAHAHAHA\' has been Approved. Feedback: Nice One', 0, '2025-09-18 15:48:39', '2025-09-18 15:48:39'),
(11, 2, 'status', 'Your submission \'HAHAHAHA\' has been Rejected. ', 0, '2025-09-20 01:47:53', '2025-09-20 01:47:53'),
(12, 2, 'feedback', 'Your submission \'HAHAHAHA\' has been Rejected. Feedback: Change your Title', 0, '2025-09-20 01:49:51', '2025-09-20 01:49:51'),
(13, 1, 'status', 'Your submission \'Proposal 1\' has been Rejected. ', 0, '2025-09-20 02:03:08', '2025-09-20 02:03:08'),
(14, 1, 'status', 'Your submission \'Proposal 1\' has been Approved. ', 0, '2025-09-20 02:08:00', '2025-09-20 02:08:00'),
(15, 1, 'feedback', 'Your submission \'Proposal 1\' has been Approved. Feedback: Good', 0, '2025-09-20 02:08:14', '2025-09-20 02:08:14'),
(16, 2, 'feedback', 'Your submission \'Proposal 2\' has been Resubmitted. Feedback: Ok', 0, '2025-09-20 02:22:06', '2025-09-20 02:22:06'),
(17, 2, 'status', 'Your submission \'Proposal 2\' has been Approved. ', 0, '2025-09-20 02:22:26', '2025-09-20 02:22:26'),
(18, 2, 'status', 'Your submission \'Stoic Philosophy\' has been Rejected. ', 0, '2025-09-22 14:12:11', '2025-09-22 14:12:11'),
(19, 2, 'status', 'Your submission \'Stoic Philosophy\' has been Rejected. ', 0, '2025-09-22 14:12:15', '2025-09-22 14:12:15'),
(20, 2, 'feedback', 'Your submission \'Stoic Philosophy\' has been Rejected. Feedback: Change your Title', 0, '2025-09-22 14:12:31', '2025-09-22 14:12:31'),
(21, 2, 'status', 'Your submission \'HAHAHAH\' has been Rejected. ', 0, '2025-09-22 14:12:41', '2025-09-22 14:12:41'),
(22, 2, 'feedback', 'Your submission \'HAHAHAH\' has been Rejected. Feedback: Change your Title', 0, '2025-09-22 14:12:51', '2025-09-22 14:12:51'),
(23, 2, 'status', 'Your submission \'Dark Psych\' has been Rejected. ', 0, '2025-09-22 14:12:58', '2025-09-22 14:12:58'),
(24, 2, 'status', 'Your submission \'Dark Psych\' has been Rejected. ', 0, '2025-09-22 14:13:00', '2025-09-22 14:13:00'),
(25, 2, 'feedback', 'Your submission \'Dark Psych\' has been Rejected. Feedback: Change your Title', 0, '2025-09-22 14:13:09', '2025-09-22 14:13:09'),
(26, 2, 'status', 'Your submission \'HAHAH\' has been Rejected. ', 0, '2025-09-22 14:13:17', '2025-09-22 14:13:17'),
(27, 2, 'feedback', 'Your submission \'HAHAH\' has been Rejected. Feedback: Change your Title', 0, '2025-09-22 14:13:26', '2025-09-22 14:13:26'),
(28, 2, 'feedback', 'Your submission \'Proposal 1\' has been Resubmitted. Feedback: Good', 0, '2025-09-22 14:16:12', '2025-09-22 14:16:12'),
(29, 2, 'status', 'Your submission \'Proposal 1\' has been Approved. ', 0, '2025-09-22 14:16:34', '2025-09-22 14:16:34'),
(30, 2, 'status', 'Your submission \'Proposal 3\' has been Approved. ', 0, '2025-09-22 14:16:41', '2025-09-22 14:16:41'),
(31, 2, 'feedback', 'Your submission \'Proposal 3\' has been Approved. Feedback: Good', 0, '2025-09-22 14:16:51', '2025-09-22 14:16:51'),
(32, 2, 'status', 'Your submission \'Proposal 4\' has been Approved. ', 0, '2025-09-22 14:16:58', '2025-09-22 14:16:58'),
(33, 2, 'feedback', 'Your submission \'Proposal 4\' has been Approved. Feedback: Good', 0, '2025-09-22 14:17:15', '2025-09-22 14:17:15'),
(34, 2, 'status', 'Your submission \'Proposal 5\' has been Approved. ', 0, '2025-09-22 14:17:26', '2025-09-22 14:17:26'),
(35, 2, 'feedback', 'Your submission \'Proposal 5\' has been Approved. Feedback: Good', 0, '2025-09-22 14:17:39', '2025-09-22 14:17:39'),
(36, 2, 'feedback', 'Your submission \'Proposal 6\' has been Pending. Feedback: Ok', 0, '2025-09-22 14:35:43', '2025-09-22 14:35:43'),
(37, 2, 'status', 'Your submission \'Proposal 6\' has been Approved. ', 0, '2025-09-22 14:35:52', '2025-09-22 14:35:52'),
(38, 2, 'status', 'Your submission \'Proposal 6\' has been Rejected. ', 0, '2025-09-22 14:40:31', '2025-09-22 14:40:31'),
(39, 2, 'status', 'Your submission \'Proposal 7 -revised\' has been Approved. ', 0, '2025-09-22 14:41:47', '2025-09-22 14:41:47'),
(40, 2, 'feedback', 'Your submission \'Proposal 7 -revised\' has been Approved. Feedback: Good', 0, '2025-09-22 14:41:59', '2025-09-22 14:41:59'),
(41, 2, 'status', 'Your submission \'Proposal 8\' has been Approved. ', 0, '2025-09-22 14:45:42', '2025-09-22 14:45:42'),
(42, 2, 'feedback', 'Your submission \'Proposal 8\' has been Approved. Feedback: Good', 0, '2025-09-22 14:45:58', '2025-09-22 14:45:58'),
(43, 2, 'status', 'Your submission \'Proposal 2\' has been Pending. ', 0, '2025-09-22 15:14:43', '2025-09-22 15:14:43'),
(44, 2, 'status', 'Your submission \'Proposal 2\' has been Rejected. ', 0, '2025-09-22 21:20:22', '2025-09-22 21:20:22'),
(45, 2, 'status', 'Your submission \'Research Title Proposal\' has been Approved. ', 0, '2025-09-23 01:16:45', '2025-09-23 01:16:45'),
(46, 2, 'status', 'Your submission \'Research Title Proposal\' has been Approved. ', 0, '2025-09-23 01:16:46', '2025-09-23 01:16:46'),
(47, 2, 'status', 'Your submission \'Research Title Proposal\' has been Approved. ', 0, '2025-09-23 01:16:46', '2025-09-23 01:16:46'),
(48, 2, 'status', 'Your submission \'Research Title Proposal\' has been Approved. ', 0, '2025-09-23 01:16:47', '2025-09-23 01:16:47'),
(49, 2, 'status', 'Your submission \'Research Title Proposal\' has been Rejected. ', 0, '2025-09-23 01:16:56', '2025-09-23 01:16:56'),
(50, 2, 'feedback', 'Your submission \'Proposal 9\' has been Resubmitted. Feedback: Good', 0, '2025-09-23 01:22:30', '2025-09-23 01:22:30'),
(51, 2, 'status', 'Your submission \'Proposal 9\' has been Approved. ', 0, '2025-09-23 01:22:38', '2025-09-23 01:22:38'),
(52, 2, 'status', 'Your submission \'Proposal 9\' has been Approved. ', 0, '2025-09-23 01:22:39', '2025-09-23 01:22:39'),
(53, 2, 'status', 'Your proposal \'Research Forum\' has been rejected.', 0, '2025-09-23 02:46:07', '2025-09-23 02:46:07'),
(54, 2, 'feedback', 'New feedback received for \'Research Forum\': hhhghghgh', 0, '2025-09-23 02:46:08', '2025-09-23 02:46:08'),
(55, 2, 'status', 'Your proposal \'Clearance\' status has been updated to Pending.', 0, '2025-09-23 03:05:36', '2025-09-23 03:05:36'),
(56, 2, 'feedback', 'New feedback received for \'Clearance\': Nice', 0, '2025-09-23 03:05:36', '2025-09-23 03:05:36'),
(57, 2, 'status', 'Your proposal \'Clearance\' has been approved.', 0, '2025-09-23 03:05:52', '2025-09-23 03:05:52'),
(58, 2, 'status', 'Your proposal \'Research Forum\' has been approved.', 0, '2025-09-23 03:17:32', '2025-09-23 03:17:32'),
(59, 2, 'status', 'Your proposal \'Research Forum\' has been approved.', 0, '2025-09-23 03:19:14', '2025-09-23 03:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `resubmission_histories`
--

CREATE TABLE `resubmission_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submission_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `cluster` int(11) NOT NULL,
  `group_no` int(11) NOT NULL,
  `status` enum('Pending','Approved','Rejected','Resubmitted') NOT NULL,
  `submitted_by` varchar(255) NOT NULL DEFAULT 'Unknown',
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `chapter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `title`, `file_path`, `department`, `cluster`, `group_no`, `status`, `submitted_by`, `feedback`, `created_at`, `updated_at`, `due_date`, `chapter`) VALUES
(1, 2, 'SMS 3', 'submissions/gTKs7NNLynkdeeohn42v5IOKd6nGjSDyNPSK0W7L.docx', 'BLIS', 1, 9, 'Approved', 'Unknown', 'Good job', '2025-09-17 05:42:23', '2025-09-17 07:29:14', NULL, NULL),
(4, 2, 'Proposal 1', 'submissions/2LBTMB8W9nmqccuIN5Ib2jLG5b3NlWBWHOkMjCmO.docx', 'BSP', 3, 9, 'Approved', 'Unknown', 'Good', '2025-09-17 06:56:26', '2025-09-22 14:16:34', NULL, NULL),
(5, 2, 'Hotel And Restaurant Services System with Smart Booking', 'submissions/5xVnAXyZGjSovOzXsn0vCPCQ8IIH4O4Pi4RorAy2.docx', 'BSIT', 7, 10, 'Approved', 'Unknown', 'Nice', '2025-09-17 08:02:29', '2025-09-17 08:03:11', NULL, NULL),
(7, 2, 'Proposal 3', 'submissions/2zp4epWtcMUgX5PqLjiYtSHDWIg4lymg0z61G8MR.docx', 'BSP', 1, 1, 'Approved', 'Juan DelaCruz', 'Good', '2025-09-18 04:43:52', '2025-09-22 14:16:51', NULL, NULL),
(8, 2, 'Proposal 4', 'submissions/M9n6mxAOonfirRS7C6pXt4luYC7DV2WkRcZ2fR14.docx', 'ENTREP', 9, 8, 'Approved', 'Juan DelaCruz', 'Good', '2025-09-18 04:56:31', '2025-09-22 14:17:15', NULL, NULL),
(9, 2, 'Proposal 5', 'submissions/lwScsM649EZM5fhNGtxVcTVPrwtmgTnbJgp5E0bd.docx', 'BSP', 10, 10, 'Approved', 'Juan DelaCruz', 'Good', '2025-09-18 06:08:17', '2025-09-22 14:17:38', NULL, NULL),
(10, 2, 'Proposal 2-revised', 'submissions/b1pdmgXU7ef1FjHezbHe5hUd0UqHPgYWV6Ibrj7J.docx', 'BSOA', 8, 7, 'Resubmitted', 'Juan DelaCruz', 'Ok', '2025-09-18 15:46:28', '2025-09-22 21:21:14', NULL, NULL),
(12, 2, 'Proposal 7 -revised', 'submissions/YNOSpcb9Nz1xhl8tNuj0XQbFT1ay0Tc71hvyW6Ox.docx', 'BSCPE', 7, 6, 'Approved', 'Juan DelaCruz', 'Good', '2025-09-22 14:35:16', '2025-09-22 14:41:58', NULL, NULL),
(13, 2, 'Proposal 8', 'submissions/o7hNENHJJGU8TnXQgJ4w4f6N8z9DF10XCJR9m3fl.docx', 'BSIT', 1, 2, 'Approved', 'Juan DelaCruz', 'Good', '2025-09-22 14:45:22', '2025-09-22 14:45:58', NULL, NULL),
(14, 2, 'Proposal 9', 'submissions/TL5l4LUWKmGaAYI88fUnprYRMMg2bIMSWQ6TSP2m.docx', 'N/A', 0, 0, 'Approved', 'Unknown', 'Good', '2025-09-23 00:33:58', '2025-09-23 01:22:38', NULL, NULL),
(15, 2, 'Research Forum', 'submissions/zD4NTqAGwGLywx8q1IzyHAXQonLWc7Xuv7XzIaSe.docx', 'N/A', 0, 0, 'Approved', 'Unknown', 'Good', '2025-09-23 01:37:45', '2025-09-23 02:43:03', NULL, NULL),
(16, 2, 'Research Forum', 'submissions/MjNynkhwcfalAAlSXNhjUs9c3Jast2D9UlFnLZvi.docx', 'N/A', 0, 0, 'Approved', 'Unknown', 'hhhghghgh', '2025-09-23 02:45:00', '2025-09-23 03:19:14', NULL, NULL),
(17, 2, 'Clearance', 'submissions/4e3B20NWCtRZhr1u0i9L00HX0AT2cMYdgfg7cIUi.docx', 'BSIT', 1, 4, 'Approved', 'Unknown', 'Nice', '2025-09-23 02:51:21', '2025-09-23 03:05:52', NULL, NULL),
(18, 2, 'Research Forum', 'submissions/2bfF8zQyWey0Hzigi20fm09N60iYWQV3ErtaZA8z.docx', 'BSIT', 1, 4, 'Approved', 'Unknown', NULL, '2025-09-23 03:14:38', '2025-09-23 03:17:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `submission_histories`
--

CREATE TABLE `submission_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `cluster` varchar(255) DEFAULT NULL,
  `group_no` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `otp` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `cluster` int(11) DEFAULT NULL,
  `group_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `role`, `otp`, `otp_expires_at`, `remember_token`, `created_at`, `updated_at`, `department`, `cluster`, `group_no`) VALUES
(1, 'Admin', 'bretbaa12@gmail.com', '2025-09-23 01:16:11', '$2y$12$oo2oGMnoPbW2eBRlh4NgY.OqPWJHmtpfbRxlsLixLwGHtF8iFCa.G', 1, 'admin', NULL, NULL, NULL, '2025-09-17 05:35:04', '2025-09-23 01:16:11', NULL, NULL, NULL),
(2, 'Juan DelaCruz', 'juandelacruz@gmail.com', NULL, '$2y$12$YZ15IPHlvcfGhp5RA3etB.jSapoGVxvKyv1uC5toksWSHOy.qvw6K', 0, 'student', NULL, NULL, NULL, '2025-09-17 05:35:32', '2025-09-17 05:35:32', 'BSIT', 1, 4);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `committees_submission_id_foreign` (`submission_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_user_id_foreign` (`user_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `resubmission_histories`
--
ALTER TABLE `resubmission_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resubmission_histories_submission_id_foreign` (`submission_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `submission_histories`
--
ALTER TABLE `submission_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submission_histories_submission_id_foreign` (`submission_id`),
  ADD KEY `submission_histories_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resubmission_histories`
--
ALTER TABLE `resubmission_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `submission_histories`
--
ALTER TABLE `submission_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `committees`
--
ALTER TABLE `committees`
  ADD CONSTRAINT `committees_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `submissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resubmission_histories`
--
ALTER TABLE `resubmission_histories`
  ADD CONSTRAINT `resubmission_histories_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `submissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submission_histories`
--
ALTER TABLE `submission_histories`
  ADD CONSTRAINT `submission_histories_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `submissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submission_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
