-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2025 at 12:43 PM
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
(4, 1, NULL, NULL, NULL, '2025-09-18 06:05:08', '2025-09-18 06:05:08', 'Prof John Doe', 'Doc John Doe', 'Doc John Doe', 'Doc John Doe'),
(5, 10, NULL, NULL, NULL, '2025-09-18 15:49:52', '2025-09-18 15:49:52', 'Prof John Doe', 'Doc John Doe', 'Doc John Doe', 'Doc John Doe');

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
(30, '2025_09_17_230404_add_chapter_to_submissions_table', 12);

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
(10, 2, 'feedback', 'Your submission \'HAHAHAHA\' has been Approved. Feedback: Nice One', 0, '2025-09-18 15:48:39', '2025-09-18 15:48:39');

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
(4, 2, 'HAHAH', 'submissions/msxyPjaknOcLWfDDDyV51jBBuIYvUv2yIwHatVbg.docx', 'BSP', 3, 9, 'Approved', 'Unknown', 'Good', '2025-09-17 06:56:26', '2025-09-18 00:57:12', NULL, NULL),
(5, 2, 'Hotel And Restaurant Services System with Smart Booking', 'submissions/5xVnAXyZGjSovOzXsn0vCPCQ8IIH4O4Pi4RorAy2.docx', 'BSIT', 7, 10, 'Approved', 'Unknown', 'Nice', '2025-09-17 08:02:29', '2025-09-17 08:03:11', NULL, NULL),
(7, 2, 'Dark Psych', 'submissions/4v2KIQjwXw3WGj3ePBkF0qUtN11lMxzCr98Cc87p.docx', 'BSP', 1, 1, 'Approved', 'Juan DelaCruz', 'Ok', '2025-09-18 04:43:52', '2025-09-18 05:45:36', NULL, NULL),
(8, 2, 'HAHAHAH', 'submissions/74B3KuFvM8jJHeWxzDdegkj6J6y2TekxB7slPUSD.docx', 'ENTREP', 9, 8, 'Approved', 'Juan DelaCruz', 'Nice', '2025-09-18 04:56:31', '2025-09-18 05:38:43', NULL, NULL),
(9, 2, 'Stoic Philosophy', 'submissions/F5HLx3ECt1nTQaM5uP2WqtxMz6X8zOo6kH5vO1lY.docx', 'BSP', 10, 10, 'Approved', 'Juan DelaCruz', 'Good', '2025-09-18 06:08:17', '2025-09-18 06:08:49', NULL, NULL),
(10, 2, 'HAHAHAHA', 'submissions/jbCddJpvdZh7TL0FfQpv3CytWNIHjsdUxzttXeZb.docx', 'BSOA', 8, 7, 'Approved', 'Juan DelaCruz', 'Nice One', '2025-09-18 15:46:28', '2025-09-18 15:48:39', NULL, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `role`, `otp`, `otp_expires_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'bretbaa12@gmail.com', '2025-09-18 15:44:45', '$2y$12$oo2oGMnoPbW2eBRlh4NgY.OqPWJHmtpfbRxlsLixLwGHtF8iFCa.G', 1, 'admin', NULL, NULL, NULL, '2025-09-17 05:35:04', '2025-09-18 15:44:45'),
(2, 'Juan DelaCruz', 'juandelacruz@gmail.com', NULL, '$2y$12$YZ15IPHlvcfGhp5RA3etB.jSapoGVxvKyv1uC5toksWSHOy.qvw6K', 0, 'student', NULL, NULL, NULL, '2025-09-17 05:35:32', '2025-09-17 05:35:32');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
