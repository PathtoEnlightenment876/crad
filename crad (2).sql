-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost: 3306
-- Generation Time: Oct 12, 2025 at 12:15 AM
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
-- Table structure for table `advisers`
--

CREATE TABLE `advisers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`sections`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advisers`
--

INSERT INTO `advisers` (`id`, `department`, `name`, `expertise`, `sections`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BSIT', 'Dr. Elacion', 'Professor', '[\"4101\"]', NULL, '2025-10-11 13:21:28', NULL),
(2, 'BSIT', 'Mr. Baa', 'Assistant Professor', '[4103]', NULL, NULL, NULL),
(3, 'BSIT', 'Mr. Jairo Indoso', 'Instructor', '[\"4104\"]', NULL, '2025-10-08 23:41:28', NULL),
(4, 'CRIM', 'Dr. Cruz', 'Professor', '[4101]', NULL, '2025-10-11 12:06:36', '2025-10-11 12:06:36'),
(6, 'BSBA', 'Dr. Martinez', 'Professor', '[\"4103\"]', NULL, '2025-10-11 02:29:24', '2025-10-11 02:29:24'),
(8, 'CRIM', 'Prof. John', 'Instructor', '[\"4105\"]', '2025-10-08 02:27:54', '2025-10-09 04:58:25', NULL),
(10, 'BSTM', 'Prof. Robin Williams', 'Instructor', '[\"4105\"]', '2025-10-07 22:03:13', '2025-10-11 03:16:51', '2025-10-11 03:16:51'),
(12, 'Psychology', 'Prof. Carl Jung', 'Professor', '[\"4104\"]', '2025-10-07 23:11:31', '2025-10-09 07:15:29', NULL),
(17, 'BSTM', 'Prof. Williams', 'Instructor', '[\"4105\"]', '2025-10-08 23:18:14', '2025-10-08 23:18:14', NULL),
(19, 'Psychology', 'Prof.  Carl Jung', 'Professor', '[\"4104\"]', '2025-10-09 04:39:01', '2025-10-09 04:39:01', NULL),
(20, 'Psychology', 'Prof. Jane', 'Professor', '[\"4110\"]', '2025-10-09 04:51:57', '2025-10-09 04:58:09', NULL),
(35, 'BSIT', 'Mr. Carl Johnson', 'Instructor', '[\"4102\"]', '2025-10-09 10:35:38', '2025-10-11 09:20:38', '2025-10-11 09:20:38'),
(36, 'EDUC', 'Mrs. Joy', 'Professor', '[\"4101\"]', '2025-10-09 10:37:09', '2025-10-09 10:37:09', NULL),
(37, 'BSIT', 'Prof. Doe', 'Professor', '[\"4105\",\"4108\",\"4109\"]', '2025-10-10 22:57:43', '2025-10-11 12:07:20', '2025-10-11 12:07:20'),
(38, 'BSIT', 'Mr. Garcia', 'Industry Expert', '[\"4107\",\"4110\"]', '2025-10-11 00:59:17', '2025-10-11 00:59:17', NULL),
(39, 'BSIT', 'Prof. Joe', 'Instructor', '[\"4108\"]', '2025-10-11 11:53:44', '2025-10-11 11:56:54', NULL),
(40, 'BSIT', 'Mr. Adovas', 'Professor', '[\"4105\"]', '2025-10-11 13:34:56', '2025-10-11 13:34:56', NULL),
(41, 'BSIT', 'Ms. Adovas', 'Industry Expert', '[\"4105\"]', '2025-10-11 13:35:55', '2025-10-11 13:36:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `adviser_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `department`, `section`, `adviser_id`, `created_at`, `updated_at`) VALUES
(78, 'Psychology', '4110', 20, '2025-10-09 11:38:17', '2025-10-09 11:38:17'),
(86, 'BSIT', '4102', 35, '2025-10-09 12:58:14', '2025-10-09 12:58:14'),
(87, 'CRIM', '4105', 8, '2025-10-09 13:06:54', '2025-10-09 13:06:54'),
(88, 'BSIT', '4103', 2, '2025-10-09 15:31:03', '2025-10-09 15:31:03'),
(89, 'BSIT', '4104', 3, '2025-10-11 01:02:54', '2025-10-11 01:02:54'),
(91, 'BSIT', '4110', 38, '2025-10-11 13:44:24', '2025-10-11 13:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_panels`
--

CREATE TABLE `assignment_panels` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `availability` varchar(255) DEFAULT NULL,
  `assignment_id` int(10) UNSIGNED NOT NULL,
  `panel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment_panels`
--

INSERT INTO `assignment_panels` (`id`, `role`, `name`, `department`, `section`, `expertise`, `availability`, `assignment_id`, `panel_id`, `created_at`, `updated_at`) VALUES
(240, 'chairperson', 'Prof. Freud', 'Psychology', '4110', 'Professor', '[{\"date\":\"2025-10-05\",\"time\":\"22:00 - 23:00\"},{\"date\":\"2025-10-06\",\"time\":\"09:42 - 10:42\"}]', 78, 8, '2025-10-09 11:38:17', '2025-10-09 11:38:17'),
(241, 'chairperson', 'Doc. Erik Erikson', 'Psychology', '4110', 'Doctoral', '[{\"date\":\"2025-10-07\",\"time\":\"12:38 - 13:38\"}]', 78, 15, '2025-10-09 11:38:17', '2025-10-09 11:38:17'),
(242, 'chairperson', 'Doc. Napoleon', 'Psychology', '4110', 'Doctoral', '[{\"date\":\"2025-10-26\",\"time\":\"09:52 - 10:52\"}]', 78, 17, '2025-10-09 11:38:17', '2025-10-09 11:38:17'),
(260, 'Chairperson', 'Mr. Ackerman', 'BSIT', '4102', 'Instructor', '[{\"date\":\"2025-10-17\",\"time\":\"04:55 - 04:56\"}]', 86, 25, '2025-10-09 12:58:14', '2025-10-09 12:58:14'),
(261, 'Member', 'Mr. Baa', 'BSIT', '4102', 'Assistant Professor', '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 86, 2, '2025-10-09 12:58:14', '2025-10-09 12:58:14'),
(262, 'Member', 'Ms. Indoso', 'BSIT', '4102', 'Instructor', '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 86, 3, '2025-10-09 12:58:14', '2025-10-09 12:58:14'),
(263, 'Chairperson', 'Doc. Eren', 'CRIM', '4105', 'Doctoral', '[{\"date\":\"2025-10-16\",\"time\":\"16:00 - 18:02\"}]', 87, 20, '2025-10-09 13:06:54', '2025-10-09 13:06:54'),
(264, 'Member', 'Mr. Armin', 'CRIM', '4105', 'Doctoral', '[{\"date\":\"2025-10-10\",\"time\":\"17:25 - 18:25\"}]', 87, 22, '2025-10-09 13:06:54', '2025-10-09 13:06:54'),
(265, 'Member', 'Mr. Ben', 'CRIM', '4105', 'Doctoral', '[{\"date\":\"2025-10-18\",\"time\":\"17:28 - 18:27\"}]', 87, 24, '2025-10-09 13:06:54', '2025-10-09 13:06:54'),
(266, 'Chairperson', 'Mr. Ackerman', 'BSIT', '4103', 'Instructor', '[{\"date\":\"2025-10-17\",\"time\":\"04:55 - 04:56\"}]', 88, 25, '2025-10-09 15:31:03', '2025-10-09 15:31:03'),
(267, 'Member', 'Dr. Elacion', 'BSIT', '4103', 'Professor', '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 88, 1, '2025-10-09 15:31:03', '2025-10-09 15:31:03'),
(268, 'Member', 'Ms. Indoso', 'BSIT', '4103', 'Instructor', '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 88, 3, '2025-10-09 15:31:03', '2025-10-09 15:31:03'),
(269, 'Member', 'Prof Jane Doe', 'BSIT', '4103', 'Associate Professor', '[{\"date\":\"2025-10-31\",\"time\":\"16:32 - 17:32\"}]', 88, 9, '2025-10-09 15:31:03', '2025-10-09 15:31:03'),
(270, 'Chairperson', 'Mr. Lyndon', 'BSIT', '4104', 'Pilot', '[{\"date\":\"2025-10-11\",\"time\":\"17:01 - 19:01\"},{\"date\":\"2025-10-12\",\"time\":\"17:01 - 19:01\"}]', 89, 27, '2025-10-11 01:02:54', '2025-10-11 01:02:54'),
(271, 'Member', 'Ms. Indoso', 'BSIT', '4104', 'Instructor', '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 89, 3, '2025-10-11 01:02:54', '2025-10-11 01:02:54'),
(272, 'Member', 'Prof. Linus', 'BSIT', '4104', 'Industry Expert', '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 89, 7, '2025-10-11 01:02:54', '2025-10-11 01:02:54'),
(277, 'Chairperson', 'Mr. Ackerman', 'BSIT', '4110', 'Instructor', '[{\"date\":\"2025-10-17\",\"time\":\"04:55 - 04:56\"}]', 91, 25, '2025-10-11 13:44:24', '2025-10-11 13:44:24'),
(278, 'Member', 'Mr. Baa', 'BSIT', '4110', 'Assistant Professor', '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 91, 2, '2025-10-11 13:44:24', '2025-10-11 13:44:24'),
(279, 'Member', 'Ms. Indoso', 'BSIT', '4110', 'Instructor', '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 91, 3, '2025-10-11 13:44:24', '2025-10-11 13:44:24');

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
-- Table structure for table `clusters`
--

CREATE TABLE `clusters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `defense_evaluations`
--

CREATE TABLE `defense_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `cluster` varchar(255) NOT NULL,
  `group_id` varchar(255) NOT NULL,
  `defense_type` enum('PRE-ORAL','FINAL DEFENSE','REDEFENSE') NOT NULL,
  `redefense_type` varchar(255) DEFAULT NULL,
  `result` enum('Passed','Redefense','Failed') NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `defense_evaluations`
--

INSERT INTO `defense_evaluations` (`id`, `department`, `cluster`, `group_id`, `defense_type`, `redefense_type`, `result`, `feedback`, `created_at`, `updated_at`) VALUES
(1, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 09:42:50', '2025-10-11 09:42:50'),
(2, 'BSIT', '4102', 'A3', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 10:07:19', '2025-10-11 10:07:19'),
(3, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 10:14:52', '2025-10-11 10:14:52'),
(4, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 10:16:28', '2025-10-11 10:16:28'),
(5, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 10:18:02', '2025-10-11 10:18:02'),
(6, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 'Redefense', 'Redefense', '2025-10-11 10:18:43', '2025-10-11 10:18:58'),
(7, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 10:38:35', '2025-10-11 10:38:35'),
(8, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 10:52:11', '2025-10-11 10:52:11'),
(9, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 10:57:02', '2025-10-11 10:57:02'),
(10, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 11:06:25', '2025-10-11 11:06:25'),
(11, 'BSIT', '4104', 'A3', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 11:19:43', '2025-10-11 11:19:43'),
(12, 'BSIT', '4104', 'A4', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 11:36:09', '2025-10-11 11:36:09'),
(13, 'BSIT', '4102', 'A2', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 13:40:14', '2025-10-11 13:40:14'),
(14, 'BSIT', '4102', 'A3', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 13:41:22', '2025-10-11 13:41:22'),
(15, 'BSIT', '4102', 'A2', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 13:42:12', '2025-10-11 13:42:12'),
(16, 'BSIT', '4110', 'A1', 'PRE-ORAL', NULL, 'Passed', NULL, '2025-10-11 13:45:17', '2025-10-11 13:45:17'),
(17, 'BSIT', '4110', 'A2', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 13:47:23', '2025-10-11 13:47:23'),
(18, 'BSIT', '4110', 'A1', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 14:02:20', '2025-10-11 14:02:20'),
(19, 'BSIT', '4104', 'A5', 'PRE-ORAL', NULL, 'Redefense', NULL, '2025-10-11 14:04:45', '2025-10-11 14:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `defense_schedules`
--

CREATE TABLE `defense_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `group_id` varchar(255) NOT NULL,
  `defense_type` enum('PRE-ORAL','FINAL DEFENSE','REDEFENSE') NOT NULL,
  `original_defense_type` varchar(255) DEFAULT NULL,
  `assignment_id` bigint(20) UNSIGNED NOT NULL,
  `defense_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `set_letter` varchar(1) DEFAULT NULL,
  `status` enum('Pending','Scheduled','Passed','Failed','Re-defense') NOT NULL DEFAULT 'Pending',
  `panel_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`panel_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `defense_schedules`
--

INSERT INTO `defense_schedules` (`id`, `department`, `section`, `group_id`, `defense_type`, `original_defense_type`, `assignment_id`, `defense_date`, `start_time`, `end_time`, `set_letter`, `status`, `panel_data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BSIT', '4101', 'A1', 'PRE-ORAL', NULL, 1, '2025-10-11', '05:19:00', '05:19:00', 'A', 'Scheduled', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chairperson\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-11 13:19:54', NULL),
(2, 'BSIT', '4101', 'A2', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(3, 'BSIT', '4101', 'A3', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(4, 'BSIT', '4101', 'A4', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(5, 'BSIT', '4101', 'A5', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(6, 'BSIT', '4101', 'A6', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(7, 'BSIT', '4101', 'A7', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(8, 'BSIT', '4101', 'A8', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(9, 'BSIT', '4101', 'A9', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(10, 'BSIT', '4101', 'A10', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(11, 'Psychology', '4110', 'A1', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:30', '2025-10-09 15:36:30', NULL),
(12, 'Psychology', '4110', 'A2', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(13, 'Psychology', '4110', 'A3', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(14, 'Psychology', '4110', 'A4', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(15, 'Psychology', '4110', 'A5', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(16, 'Psychology', '4110', 'A6', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(17, 'Psychology', '4110', 'A7', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(18, 'Psychology', '4110', 'A8', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(19, 'Psychology', '4110', 'A9', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(20, 'Psychology', '4110', 'A10', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(21, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Passed', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:31', '2025-10-09 17:26:53', NULL),
(22, 'BSIT', '4102', 'A2', 'PRE-ORAL', NULL, 1, '2025-10-11', '05:38:00', '05:38:00', 'A', 'Scheduled', '{\"adviser\":\"No Adviser\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:31', '2025-10-11 13:38:51', NULL),
(23, 'BSIT', '4102', 'A3', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:31', '2025-10-09 15:36:31', NULL),
(24, 'BSIT', '4102', 'A4', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(25, 'BSIT', '4102', 'A5', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(26, 'BSIT', '4102', 'A6', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(27, 'BSIT', '4102', 'A7', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(28, 'BSIT', '4102', 'A8', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(29, 'BSIT', '4102', 'A9', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(30, 'BSIT', '4102', 'A10', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(31, 'CRIM', '4105', 'A1', 'PRE-ORAL', NULL, 1, '2025-10-11', '02:21:00', '02:21:00', 'A', 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-11 10:21:15', NULL),
(32, 'CRIM', '4105', 'A2', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(33, 'CRIM', '4105', 'A3', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(34, 'CRIM', '4105', 'A4', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(35, 'CRIM', '4105', 'A5', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(36, 'CRIM', '4105', 'A6', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(37, 'CRIM', '4105', 'A7', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(38, 'CRIM', '4105', 'A8', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(39, 'CRIM', '4105', 'A9', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:32', '2025-10-09 15:36:32', NULL),
(40, 'CRIM', '4105', 'A10', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(41, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 1, '2025-10-11', '02:21:00', '02:21:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-11 10:22:00', NULL),
(42, 'BSIT', '4103', 'A2', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(43, 'BSIT', '4103', 'A3', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(44, 'BSIT', '4103', 'A4', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(45, 'BSIT', '4103', 'A5', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(46, 'BSIT', '4103', 'A6', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(47, 'BSIT', '4103', 'A7', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(48, 'BSIT', '4103', 'A8', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(49, 'BSIT', '4103', 'A9', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(50, 'BSIT', '4103', 'A10', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 15:36:33', '2025-10-09 15:36:33', NULL),
(51, 'BSIT', '4101', 'A1', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(52, 'BSIT', '4101', 'A2', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(53, 'BSIT', '4101', 'A3', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(54, 'BSIT', '4101', 'A4', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(55, 'BSIT', '4101', 'A5', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(56, 'BSIT', '4101', 'A6', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(57, 'BSIT', '4101', 'A7', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(58, 'BSIT', '4101', 'A8', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(59, 'BSIT', '4101', 'A9', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:29', '2025-10-09 16:08:29', NULL),
(60, 'BSIT', '4101', 'A10', 'PRE-ORAL', NULL, 77, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Dr. Elacion\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Linus, Prof Jane Doe, Doc. Peter\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(61, 'Psychology', '4110', 'A1', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(62, 'Psychology', '4110', 'A2', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(63, 'Psychology', '4110', 'A3', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(64, 'Psychology', '4110', 'A4', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(65, 'Psychology', '4110', 'A5', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(66, 'Psychology', '4110', 'A6', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(67, 'Psychology', '4110', 'A7', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(68, 'Psychology', '4110', 'A8', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(69, 'Psychology', '4110', 'A9', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(70, 'Psychology', '4110', 'A10', 'PRE-ORAL', NULL, 78, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. Jane\",\"chairperson\":\"No Chair\",\"members\":\"Prof. Freud, Doc. Erik Erikson, Doc. Napoleon\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(71, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(72, 'BSIT', '4102', 'A2', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(73, 'BSIT', '4102', 'A3', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(74, 'BSIT', '4102', 'A4', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(75, 'BSIT', '4102', 'A5', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(76, 'BSIT', '4102', 'A6', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(77, 'BSIT', '4102', 'A7', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(78, 'BSIT', '4102', 'A8', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(79, 'BSIT', '4102', 'A9', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(80, 'BSIT', '4102', 'A10', 'PRE-ORAL', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:08:30', '2025-10-09 16:08:30', NULL),
(81, 'CRIM', '4105', 'A1', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(82, 'CRIM', '4105', 'A2', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(83, 'CRIM', '4105', 'A3', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(84, 'CRIM', '4105', 'A4', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(85, 'CRIM', '4105', 'A5', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(86, 'CRIM', '4105', 'A6', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(87, 'CRIM', '4105', 'A7', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(88, 'CRIM', '4105', 'A8', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(89, 'CRIM', '4105', 'A9', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(90, 'CRIM', '4105', 'A10', 'PRE-ORAL', NULL, 87, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Prof. John\",\"chairperson\":\"Doc. Eren\",\"members\":\"Mr. Armin, Mr. Ben\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(91, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(92, 'BSIT', '4103', 'A2', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(93, 'BSIT', '4103', 'A3', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(94, 'BSIT', '4103', 'A4', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(95, 'BSIT', '4103', 'A5', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(96, 'BSIT', '4103', 'A6', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(97, 'BSIT', '4103', 'A7', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(98, 'BSIT', '4103', 'A8', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(99, 'BSIT', '4103', 'A9', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(100, 'BSIT', '4103', 'A10', 'PRE-ORAL', NULL, 88, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 16:08:31', '2025-10-09 16:08:31', NULL),
(101, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, '2025-10-09', '08:09:00', '08:09:00', 'A', 'Scheduled', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:09:55', '2025-10-09 16:09:55', NULL),
(102, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, '2025-10-09', '08:09:00', '08:09:00', 'A', 'Scheduled', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:10:04', '2025-10-09 16:10:04', NULL),
(103, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, '2025-10-09', '08:09:00', '08:09:00', 'A', 'Scheduled', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:10:17', '2025-10-09 16:10:17', NULL),
(104, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, '2025-10-09', '08:11:00', '08:12:00', 'A', 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 16:12:08', '2025-10-09 16:12:08', NULL),
(105, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:06', '2025-10-09 17:11:06', NULL),
(106, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:07', '2025-10-09 17:11:07', NULL),
(107, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:07', '2025-10-09 17:11:07', NULL),
(108, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:08', '2025-10-09 17:11:08', NULL),
(109, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:09', '2025-10-09 17:11:09', NULL),
(110, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:10', '2025-10-09 17:11:10', NULL),
(111, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:11', '2025-10-09 17:11:11', NULL),
(112, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:15', '2025-10-09 17:11:15', NULL),
(113, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:16', '2025-10-09 17:11:16', NULL),
(114, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:10:00', '09:10:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:11:17', '2025-10-09 17:11:17', NULL),
(115, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, '2025-10-09', '09:13:00', '09:13:00', 'A', 'Re-defense', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 17:13:35', '2025-10-09 17:25:27', NULL),
(116, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:19:00', '09:19:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:19:07', '2025-10-09 17:19:07', NULL),
(117, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:22:00', '09:22:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:22:44', '2025-10-09 17:22:44', NULL),
(118, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, '2025-10-09', '09:25:00', '09:25:00', 'A', 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 17:25:16', '2025-10-09 17:25:16', NULL),
(119, 'BSIT', '4102', 'A1', 'REDEFENSE', 'PRE-ORAL', 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 17:25:27', '2025-10-09 17:25:27', NULL),
(120, 'BSIT', '4102', 'A1', 'FINAL DEFENSE', NULL, 86, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 17:26:53', '2025-10-09 17:26:53', NULL),
(121, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, '2025-10-09', '09:28:00', '09:28:00', 'A', 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 17:29:00', '2025-10-09 17:29:00', NULL),
(122, 'BSIT', '4102', 'A1', 'PRE-ORAL', NULL, 86, '2025-10-09', '09:28:00', '09:28:00', 'A', 'Pending', '{\"adviser\":\"Mr. Carl Johnson\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-09 17:29:01', '2025-10-09 17:29:01', NULL),
(123, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:36:00', '09:36:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:36:51', '2025-10-09 17:36:51', NULL),
(124, 'BSIT', '4103', 'A1', 'PRE-ORAL', NULL, 88, '2025-10-09', '09:36:00', '09:36:00', 'A', 'Pending', '{\"adviser\":\"Mr. Baa\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Dr. Elacion, Ms. Indoso, Prof Jane Doe\"}', '2025-10-09 17:36:52', '2025-10-09 17:36:52', NULL),
(125, 'BSIT', '4101', 'A1', 'PRE-ORAL', NULL, 1, '2024-01-15', '09:00:00', '10:00:00', 'A', 'Pending', '{\"adviser\":\"Test Adviser\"}', '2025-10-11 10:01:48', '2025-10-11 10:02:02', '2025-10-11 10:02:02'),
(126, 'BSIT', '4104', 'A1', 'PRE-ORAL', NULL, 1, '2025-10-11', '02:08:00', '02:08:00', 'A', 'Passed', '{\"adviser\":\"Mr. Jairo Indoso\",\"chairperson\":\"Mr. Lyndon\",\"members\":\"Ms. Indoso, Prof. Linus\"}', '2025-10-11 10:07:41', '2025-10-11 11:06:25', NULL),
(127, 'BSIT', '4104', 'A2', 'PRE-ORAL', NULL, 1, '2025-10-13', '02:33:00', '02:33:00', 'A', 'Pending', '{\"adviser\":\"Mr. Jairo Indoso\",\"chairperson\":\"Mr. Lyndon\",\"members\":\"Ms. Indoso, Prof. Linus\"}', '2025-10-11 10:33:16', '2025-10-11 10:33:16', NULL),
(128, 'BSIT', '4104', 'A3', 'PRE-ORAL', NULL, 1, '2025-10-11', '03:19:00', '03:19:00', 'A', 'Re-defense', '{\"adviser\":\"Mr. Jairo Indoso\",\"chairperson\":\"Mr. Lyndon\",\"members\":\"Ms. Indoso, Prof. Linus\"}', '2025-10-11 11:19:17', '2025-10-11 11:19:44', NULL),
(129, 'BSIT', '4104', 'A3', 'REDEFENSE', 'PRE-ORAL', 1, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"No Adviser\",\"chairperson\":\"No Chairperson\",\"members\":\"No Members\"}', '2025-10-11 11:19:44', '2025-10-11 11:19:44', NULL),
(130, 'BSIT', '4104', 'A4', 'PRE-ORAL', NULL, 1, '2025-10-11', '03:35:00', '03:35:00', 'A', 'Passed', '{\"adviser\":\"Mr. Jairo Indoso\",\"chairperson\":\"Mr. Lyndon\",\"members\":\"Ms. Indoso, Prof. Linus\"}', '2025-10-11 11:35:52', '2025-10-11 11:36:10', NULL),
(131, 'BSIT', '4104', 'A4', 'FINAL DEFENSE', NULL, 1, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"No Adviser\",\"chairperson\":\"No Chairperson\",\"members\":\"No Members\"}', '2025-10-11 11:36:10', '2025-10-11 11:36:10', NULL),
(132, 'BSIT', '4102', 'A2', 'FINAL DEFENSE', NULL, 1, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"No Adviser\",\"chairperson\":\"No Chairperson\",\"members\":\"No Members\"}', '2025-10-11 13:40:16', '2025-10-11 13:40:16', NULL),
(133, 'BSIT', '4102', 'A3', 'REDEFENSE', 'PRE-ORAL', 1, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"No Adviser\",\"chairperson\":\"No Chairperson\",\"members\":\"No Members\"}', '2025-10-11 13:41:23', '2025-10-11 13:41:23', NULL),
(134, 'BSIT', '4110', 'A1', 'PRE-ORAL', NULL, 1, '2025-10-11', '05:44:00', '05:44:00', 'A', 'Scheduled', '{\"adviser\":\"Mr. Garcia\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-11 13:44:53', '2025-10-11 13:44:53', NULL),
(135, 'BSIT', '4110', 'A1', 'FINAL DEFENSE', NULL, 1, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"No Adviser\",\"chairperson\":\"No Chairperson\",\"members\":\"No Members\"}', '2025-10-11 13:45:17', '2025-10-11 13:45:17', NULL),
(136, 'BSIT', '4110', 'A2', 'PRE-ORAL', NULL, 1, '2025-10-11', '05:46:00', '05:46:00', 'A', 'Scheduled', '{\"adviser\":\"Mr. Garcia\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-11 13:47:03', '2025-10-11 13:47:03', NULL),
(137, 'BSIT', '4110', 'A2', 'REDEFENSE', 'PRE-ORAL', 1, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"No Adviser\",\"chairperson\":\"No Chairperson\",\"members\":\"No Members\"}', '2025-10-11 13:47:23', '2025-10-11 13:47:23', NULL),
(138, 'BSIT', '4110', 'A1', 'REDEFENSE', 'PRE-ORAL', 91, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Garcia\",\"chairperson\":\"Mr. Ackerman\",\"members\":\"Mr. Baa, Ms. Indoso\"}', '2025-10-11 14:02:21', '2025-10-11 14:02:21', NULL),
(139, 'BSIT', '4104', 'A5', 'PRE-ORAL', NULL, 1, '2025-10-11', '06:04:00', '06:04:00', 'A', 'Scheduled', '{\"adviser\":\"Mr. Jairo Indoso\",\"chairperson\":\"Mr. Lyndon\",\"members\":\"Ms. Indoso, Prof. Linus\"}', '2025-10-11 14:04:31', '2025-10-11 14:04:31', NULL),
(140, 'BSIT', '4104', 'A5', 'REDEFENSE', 'PRE-ORAL', 89, NULL, NULL, NULL, NULL, 'Pending', '{\"adviser\":\"Mr. Jairo Indoso\",\"chairperson\":\"Mr. Lyndon\",\"members\":\"Ms. Indoso, Prof. Linus\"}', '2025-10-11 14:04:46', '2025-10-11 14:04:46', NULL);

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
(4, '2024_01_01_000001_create_advisers_table', 1),
(5, '2024_01_01_000002_create_panels_table', 1),
(6, '2024_01_01_000003_create_assignments_table', 1),
(7, '2025_08_31_212114_create_otps_table', 2),
(8, '2025_10_09_145742_add_soft_deletes_to_advisers_table', 3),
(9, '2025_10_09_145802_add_soft_deletes_to_panels_table', 4),
(10, '2025_10_11_053114_add_documents_column_to_submissions_table', 5),
(11, '2025_10_11_054653_add_defense_type_to_submissions_table', 6),
(12, '2025_10_11_055516_update_defense_type_enum_values', 7),
(13, '2025_10_11_173612_create_defense_evaluations_table', 8),
(14, '2025_01_15_000001_add_contact_number_to_panels_table', 9);

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
(1, 2, 'status', 'Your submission \'HAHAHAH\' has been Approved. ', 1, '2025-09-18 12:38:33', '2025-10-01 05:39:04'),
(2, 2, 'feedback', 'Your submission \'HAHAHAH\' has been Approved. Feedback: Nice', 1, '2025-09-18 12:38:44', '2025-10-01 05:39:04'),
(3, 2, 'feedback', 'Your submission \'Dark Psych\' has been Resubmitted. Feedback: Ok', 1, '2025-09-18 12:45:27', '2025-10-01 05:39:04'),
(4, 2, 'feedback', 'Your submission \'Dark Psych\' has been Resubmitted. Feedback: Ok', 1, '2025-09-18 12:45:28', '2025-10-01 05:39:04'),
(5, 2, 'status', 'Your submission \'Dark Psych\' has been Approved. ', 1, '2025-09-18 12:45:36', '2025-10-01 05:39:04'),
(6, 2, 'feedback', 'Your submission \'Stoic Philosophy\' has been Pending. Feedback: Good', 1, '2025-09-18 13:08:40', '2025-10-01 05:39:04'),
(7, 2, 'status', 'Your submission \'Stoic Philosophy\' has been Approved. ', 1, '2025-09-18 13:08:49', '2025-10-01 05:39:04'),
(8, 2, 'status', 'Your submission \'HAHAHAHA\' has been Rejected. ', 1, '2025-09-18 22:47:09', '2025-10-01 05:39:04'),
(9, 2, 'status', 'Your submission \'HAHAHAHA\' has been Approved. ', 1, '2025-09-18 22:48:18', '2025-10-01 05:39:04'),
(10, 2, 'feedback', 'Your submission \'HAHAHAHA\' has been Approved. Feedback: Nice One', 1, '2025-09-18 22:48:39', '2025-10-01 05:39:04'),
(11, 2, 'status', 'Your submission \'HAHAHAHA\' has been Rejected. ', 1, '2025-09-20 08:47:53', '2025-10-01 05:39:04'),
(12, 2, 'feedback', 'Your submission \'HAHAHAHA\' has been Rejected. Feedback: Change your Title', 1, '2025-09-20 08:49:51', '2025-10-01 05:39:04'),
(13, 1, 'status', 'Your submission \'Proposal 1\' has been Rejected. ', 0, '2025-09-20 09:03:08', '2025-09-20 09:03:08'),
(14, 1, 'status', 'Your submission \'Proposal 1\' has been Approved. ', 0, '2025-09-20 09:08:00', '2025-09-20 09:08:00'),
(15, 1, 'feedback', 'Your submission \'Proposal 1\' has been Approved. Feedback: Good', 0, '2025-09-20 09:08:14', '2025-09-20 09:08:14'),
(16, 2, 'feedback', 'Your submission \'Proposal 2\' has been Resubmitted. Feedback: Ok', 1, '2025-09-20 09:22:06', '2025-10-01 05:39:04'),
(17, 2, 'status', 'Your submission \'Proposal 2\' has been Approved. ', 1, '2025-09-20 09:22:26', '2025-10-01 05:39:04'),
(18, 2, 'status', 'Your submission \'Stoic Philosophy\' has been Rejected. ', 1, '2025-09-22 21:12:11', '2025-10-01 05:39:04'),
(19, 2, 'status', 'Your submission \'Stoic Philosophy\' has been Rejected. ', 1, '2025-09-22 21:12:15', '2025-10-01 05:39:04'),
(20, 2, 'feedback', 'Your submission \'Stoic Philosophy\' has been Rejected. Feedback: Change your Title', 1, '2025-09-22 21:12:31', '2025-10-01 05:39:04'),
(21, 2, 'status', 'Your submission \'HAHAHAH\' has been Rejected. ', 1, '2025-09-22 21:12:41', '2025-10-01 05:39:04'),
(22, 2, 'feedback', 'Your submission \'HAHAHAH\' has been Rejected. Feedback: Change your Title', 1, '2025-09-22 21:12:51', '2025-10-01 05:39:04'),
(23, 2, 'status', 'Your submission \'Dark Psych\' has been Rejected. ', 1, '2025-09-22 21:12:58', '2025-10-01 05:39:04'),
(24, 2, 'status', 'Your submission \'Dark Psych\' has been Rejected. ', 1, '2025-09-22 21:13:00', '2025-10-01 05:39:04'),
(25, 2, 'feedback', 'Your submission \'Dark Psych\' has been Rejected. Feedback: Change your Title', 1, '2025-09-22 21:13:09', '2025-10-01 05:39:04'),
(26, 2, 'status', 'Your submission \'HAHAH\' has been Rejected. ', 1, '2025-09-22 21:13:17', '2025-10-01 05:39:04'),
(27, 2, 'feedback', 'Your submission \'HAHAH\' has been Rejected. Feedback: Change your Title', 1, '2025-09-22 21:13:26', '2025-10-01 05:39:04'),
(28, 2, 'feedback', 'Your submission \'Proposal 1\' has been Resubmitted. Feedback: Good', 1, '2025-09-22 21:16:12', '2025-10-01 05:39:04'),
(29, 2, 'status', 'Your submission \'Proposal 1\' has been Approved. ', 1, '2025-09-22 21:16:34', '2025-10-01 05:39:04'),
(30, 2, 'status', 'Your submission \'Proposal 3\' has been Approved. ', 1, '2025-09-22 21:16:41', '2025-10-01 05:39:04'),
(31, 2, 'feedback', 'Your submission \'Proposal 3\' has been Approved. Feedback: Good', 1, '2025-09-22 21:16:51', '2025-10-01 05:39:04'),
(32, 2, 'status', 'Your submission \'Proposal 4\' has been Approved. ', 1, '2025-09-22 21:16:58', '2025-10-01 05:39:04'),
(33, 2, 'feedback', 'Your submission \'Proposal 4\' has been Approved. Feedback: Good', 1, '2025-09-22 21:17:15', '2025-10-01 05:39:04'),
(34, 2, 'status', 'Your submission \'Proposal 5\' has been Approved. ', 1, '2025-09-22 21:17:26', '2025-10-01 05:39:04'),
(35, 2, 'feedback', 'Your submission \'Proposal 5\' has been Approved. Feedback: Good', 1, '2025-09-22 21:17:39', '2025-10-01 05:39:04'),
(36, 2, 'feedback', 'Your submission \'Proposal 6\' has been Pending. Feedback: Ok', 1, '2025-09-22 21:35:43', '2025-10-01 05:39:04'),
(37, 2, 'status', 'Your submission \'Proposal 6\' has been Approved. ', 1, '2025-09-22 21:35:52', '2025-10-01 05:39:04'),
(38, 2, 'status', 'Your submission \'Proposal 6\' has been Rejected. ', 1, '2025-09-22 21:40:31', '2025-10-01 05:39:04'),
(39, 2, 'status', 'Your submission \'Proposal 7 -revised\' has been Approved. ', 1, '2025-09-22 21:41:47', '2025-10-01 05:39:04'),
(40, 2, 'feedback', 'Your submission \'Proposal 7 -revised\' has been Approved. Feedback: Good', 1, '2025-09-22 21:41:59', '2025-10-01 05:39:04'),
(41, 2, 'status', 'Your submission \'Proposal 8\' has been Approved. ', 1, '2025-09-22 21:45:42', '2025-10-01 05:39:04'),
(42, 2, 'feedback', 'Your submission \'Proposal 8\' has been Approved. Feedback: Good', 1, '2025-09-22 21:45:58', '2025-10-01 05:39:04'),
(43, 2, 'status', 'Your submission \'Proposal 2\' has been Pending. ', 1, '2025-09-22 22:14:43', '2025-10-01 05:39:04'),
(44, 2, 'status', 'Your submission \'Proposal 2\' has been Rejected. ', 1, '2025-09-23 04:20:22', '2025-10-01 05:39:04'),
(45, 2, 'status', 'Your submission \'Research Title Proposal\' has been Approved. ', 1, '2025-09-23 08:16:45', '2025-10-01 05:39:04'),
(46, 2, 'status', 'Your submission \'Research Title Proposal\' has been Approved. ', 1, '2025-09-23 08:16:46', '2025-10-01 05:39:04'),
(47, 2, 'status', 'Your submission \'Research Title Proposal\' has been Approved. ', 1, '2025-09-23 08:16:46', '2025-10-01 05:39:04'),
(48, 2, 'status', 'Your submission \'Research Title Proposal\' has been Approved. ', 1, '2025-09-23 08:16:47', '2025-10-01 05:39:04'),
(49, 2, 'status', 'Your submission \'Research Title Proposal\' has been Rejected. ', 1, '2025-09-23 08:16:56', '2025-10-01 05:39:04'),
(50, 2, 'feedback', 'Your submission \'Proposal 9\' has been Resubmitted. Feedback: Good', 1, '2025-09-23 08:22:30', '2025-10-01 05:39:04'),
(51, 2, 'status', 'Your submission \'Proposal 9\' has been Approved. ', 1, '2025-09-23 08:22:38', '2025-10-01 05:39:04'),
(52, 2, 'status', 'Your submission \'Proposal 9\' has been Approved. ', 1, '2025-09-23 08:22:39', '2025-10-01 05:39:04'),
(53, 2, 'status', 'Your proposal \'Research Forum\' has been rejected.', 1, '2025-09-23 09:46:07', '2025-10-01 05:39:04'),
(54, 2, 'feedback', 'New feedback received for \'Research Forum\': hhhghghgh', 1, '2025-09-23 09:46:08', '2025-10-01 05:39:04'),
(55, 2, 'status', 'Your proposal \'Clearance\' status has been updated to Pending.', 1, '2025-09-23 10:05:36', '2025-10-01 05:39:04'),
(56, 2, 'feedback', 'New feedback received for \'Clearance\': Nice', 1, '2025-09-23 10:05:36', '2025-10-01 05:39:04'),
(57, 2, 'status', 'Your proposal \'Clearance\' has been approved.', 1, '2025-09-23 10:05:52', '2025-10-01 05:39:04'),
(58, 2, 'status', 'Your proposal \'Research Forum\' has been approved.', 1, '2025-09-23 10:17:32', '2025-10-01 05:39:04'),
(59, 2, 'status', 'Your proposal \'Research Forum\' has been approved.', 1, '2025-09-23 10:19:14', '2025-10-01 05:39:04'),
(60, 2, 'status', 'Your proposal \'Clearance\' has been approved.', 1, '2025-10-01 04:42:22', '2025-10-01 05:39:04'),
(61, 2, 'status', 'Your proposal \'Clearance\' has been approved.', 1, '2025-10-01 04:42:32', '2025-10-01 05:39:04'),
(62, 2, 'feedback', 'New feedback received for \'Clearance\': Good', 1, '2025-10-01 04:42:32', '2025-10-01 05:39:04'),
(63, 2, 'status', 'Your proposal \'Clearance\' has been approved.', 1, '2025-10-01 04:42:38', '2025-10-01 05:39:04'),
(64, 2, 'status', 'Your proposal \'Clearance\' has been approved.', 1, '2025-10-01 04:42:46', '2025-10-01 05:39:04'),
(65, 2, 'feedback', 'New feedback received for \'Clearance\': Good', 1, '2025-10-01 04:42:46', '2025-10-01 05:39:04'),
(66, 2, 'status', 'Your proposal \'Clearance\' has been approved.', 1, '2025-10-01 04:42:50', '2025-10-01 05:39:04'),
(67, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-01 04:42:54', '2025-10-01 05:39:04'),
(68, 2, 'status', 'Your proposal \'Research Title Proposal\' has been rejected.', 1, '2025-10-01 05:52:13', '2025-10-01 05:52:54'),
(69, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': Revise it', 1, '2025-10-01 05:52:13', '2025-10-01 05:52:54'),
(70, 2, 'status', 'Your proposal \'Research Title Proposal\' status has been updated to Resubmitted.', 1, '2025-10-01 05:54:22', '2025-10-01 06:05:04'),
(71, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': Good', 1, '2025-10-01 05:54:22', '2025-10-01 06:05:04'),
(72, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-01 05:54:27', '2025-10-01 06:05:04'),
(73, 2, 'status', 'Your proposal \'Research Forum\' has been approved.', 1, '2025-10-10 21:58:42', '2025-10-11 03:32:22'),
(74, 2, 'status', 'Your proposal \'Research Title Proposal\' has been rejected.', 1, '2025-10-10 21:58:52', '2025-10-11 03:32:22'),
(75, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': gfgfgfgrgryhd', 1, '2025-10-10 21:58:52', '2025-10-11 03:32:22'),
(76, 2, 'status', 'Your proposal \'Clearance\' has been rejected.', 1, '2025-10-11 00:55:51', '2025-10-11 03:32:22'),
(77, 2, 'feedback', 'New feedback received for \'Clearance\': mali', 1, '2025-10-11 00:55:51', '2025-10-11 03:32:22'),
(78, 2, 'status', 'Your proposal \'Clearance\' has been rejected.', 1, '2025-10-11 00:56:07', '2025-10-11 03:32:22'),
(79, 2, 'feedback', 'New feedback received for \'Clearance\': mali', 1, '2025-10-11 00:56:07', '2025-10-11 03:32:22'),
(80, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-11 03:01:06', '2025-10-11 03:32:22'),
(81, 2, 'status', 'Your proposal \'Research Title Proposal\' has been rejected.', 1, '2025-10-11 03:01:31', '2025-10-11 03:32:22'),
(82, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': mali', 1, '2025-10-11 03:01:31', '2025-10-11 03:32:22'),
(83, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-11 03:04:14', '2025-10-11 03:32:22'),
(84, 2, 'status', 'Your proposal \'Research Title Proposal\' has been rejected.', 1, '2025-10-11 03:07:28', '2025-10-11 03:32:22'),
(85, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': mali', 1, '2025-10-11 03:07:28', '2025-10-11 03:32:22'),
(86, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-11 03:21:39', '2025-10-11 03:32:22'),
(87, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-11 03:21:53', '2025-10-11 03:32:22'),
(88, 2, 'status', 'Your proposal \'Research Title Proposal\' has been rejected.', 1, '2025-10-11 03:24:32', '2025-10-11 03:32:22'),
(89, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': mali', 1, '2025-10-11 03:24:32', '2025-10-11 03:32:22'),
(90, 2, 'status', 'Your proposal \'Research Title Proposal\' has been rejected.', 1, '2025-10-11 03:24:39', '2025-10-11 03:32:22'),
(91, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': mali', 1, '2025-10-11 03:24:39', '2025-10-11 03:32:22'),
(92, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-11 03:26:32', '2025-10-11 03:32:22'),
(93, 2, 'status', 'Your proposal \'Research Title Proposal\' has been rejected.', 1, '2025-10-11 03:27:02', '2025-10-11 03:32:22'),
(94, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': mali', 1, '2025-10-11 03:27:02', '2025-10-11 03:32:22'),
(95, 2, 'status', 'Your proposal \'Research Title Proposal\' has been rejected.', 1, '2025-10-11 03:30:22', '2025-10-11 03:32:22'),
(96, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': mali', 1, '2025-10-11 03:30:22', '2025-10-11 03:32:22'),
(97, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-11 03:31:37', '2025-10-11 03:32:22'),
(98, 2, 'feedback', 'New feedback received for \'Research Title Proposal\': Good', 1, '2025-10-11 03:32:06', '2025-10-11 03:32:22');

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
-- Table structure for table `panels`
--

CREATE TABLE `panels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `availability` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`availability`)),
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `panels`
--

INSERT INTO `panels` (`id`, `department`, `name`, `expertise`, `contact_number`, `availability`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BSIT', 'Dr. Elacion', 'Professor', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', NULL, NULL, NULL, NULL),
(2, 'BSIT', 'Mr. Baa', 'Assistant Professor', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', NULL, NULL, NULL, NULL),
(3, 'BSIT', 'Ms. Indoso', 'Instructor', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', NULL, NULL, NULL, NULL),
(4, 'CRIM', 'Dr. Cruz', 'Professor', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', NULL, NULL, NULL, NULL),
(6, 'BSBA', 'Dr. Martinez', 'Professor', NULL, '[{\"date\":\"2025-10-18\",\"time\":\"10:00 - 14:00\"},{\"date\":\"2025-10-19\",\"time\":\"08:00 - 12:00\"}]', NULL, NULL, NULL, NULL),
(7, 'BSIT', 'Prof. Linus', 'Industry Expert', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', NULL, '2025-10-05 15:52:03', '2025-10-05 15:52:03', NULL),
(8, 'Psychology', 'Prof. Freud', 'Professor', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"22:00 - 23:00\"},{\"date\":\"2025-10-06\",\"time\":\"09:42 - 10:42\"}]', NULL, '2025-10-05 23:42:39', '2025-10-05 23:42:39', NULL),
(9, 'BSIT', 'Prof Jane Doe', 'Associate Professor', NULL, '[{\"date\":\"2025-10-31\",\"time\":\"16:32 - 17:32\"}]', NULL, '2025-10-08 02:32:54', '2025-10-08 02:32:54', NULL),
(10, 'BSIT', 'Doc. Peter', 'Doctoral', NULL, '[{\"date\":\"2025-10-23\",\"time\":\"12:33 - 13:33\"}]', NULL, '2025-10-08 02:33:32', '2025-10-08 02:33:32', NULL),
(12, 'BSTM', 'Doc. Ramirez', 'Doctoral', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"13:00 - 15:00\"}]', NULL, '2025-10-07 22:04:40', '2025-10-07 22:04:40', NULL),
(15, 'Psychology', 'Doc. Erik Erikson', 'Doctoral', NULL, '[{\"date\":\"2025-10-07\",\"time\":\"12:38 - 13:38\"}]', NULL, '2025-10-07 23:08:45', '2025-10-07 23:08:45', NULL),
(17, 'Psychology', 'Doc. Napoleon', 'Doctoral', NULL, '[{\"date\":\"2025-10-26\",\"time\":\"09:52 - 10:52\"}]', NULL, '2025-10-07 23:52:09', '2025-10-07 23:52:09', NULL),
(18, 'Psychology', 'Doc. Napoleon', 'Doctoral', NULL, '[{\"date\":\"2025-10-26\",\"time\":\"09:52 - 10:52\"},{\"date\":\"2025-10-08\",\"time\":\"13:50 - 14:50\"}]', NULL, '2025-10-09 03:50:33', '2025-10-09 03:50:33', NULL),
(19, 'BSIT', 'Doc. Ignacio', 'Doctoral', NULL, '[{\"date\":\"2025-10-14\",\"time\":\"16:53 - 17:53\"}]', NULL, '2025-10-09 11:53:01', '2025-10-09 11:53:01', NULL),
(20, 'CRIM', 'Doc. Eren', 'Doctoral', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"16:00 - 18:02\"}]', 'Chairperson', '2025-10-09 12:03:21', '2025-10-09 12:03:21', NULL),
(21, 'CRIM', 'Doc. Mikasa', 'Doctoral', NULL, '[{\"date\":\"2025-10-11\",\"time\":\"17:13 - 18:13\"}]', 'Member', '2025-10-09 12:12:30', '2025-10-09 12:12:30', NULL),
(22, 'CRIM', 'Mr. Armin', 'Doctoral', NULL, '[{\"date\":\"2025-10-10\",\"time\":\"17:25 - 18:25\"}]', 'Chairperson', '2025-10-09 12:24:11', '2025-10-09 12:24:11', NULL),
(24, 'CRIM', 'Mr. Ben', 'Doctoral', NULL, '[{\"date\":\"2025-10-18\",\"time\":\"17:28 - 18:27\"}]', 'Member', '2025-10-09 12:27:22', '2025-10-09 12:27:22', NULL),
(25, 'BSIT', 'Mr. Ackerman', 'Instructor', NULL, '[{\"date\":\"2025-10-17\",\"time\":\"04:55 - 04:56\"}]', 'Chairperson', '2025-10-09 12:55:38', '2025-10-09 12:55:38', NULL),
(26, 'BSIT', 'Mr. Raymon Loria', 'Instructor', NULL, '[{\"date\":\"2025-10-11\",\"time\":\"15:04 - 15:05\"},{\"date\":\"2025-10-14\",\"time\":\"17:19 - 18:19\"}]', 'Chairperson', '2025-10-10 23:04:45', '2025-10-11 01:19:54', NULL),
(27, 'BSIT', 'Mr. Lyndon', 'Pilot', NULL, '[{\"date\":\"2025-10-11\",\"time\":\"17:01 - 19:01\"},{\"date\":\"2025-10-12\",\"time\":\"17:01 - 19:01\"}]', 'Chairperson', '2025-10-11 01:01:51', '2025-10-11 01:01:51', NULL),
(28, 'BSIT', 'Dr. James', 'Doctoral', '09532147987', '[{\"date\":\"2025-10-12\",\"time\":\"04:11 - 05:11\"}]', 'Chairperson', '2025-10-11 12:11:39', '2025-10-11 12:21:16', NULL);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('41Dw1NR4QxuuGuFHbavHo7UeONdHvK4z0tlQmix9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRmVPQWJBdEhmQVBCWEQ1WUQyV1JQOTNMdE9YOWVkRzh5ejhwRkNZTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZWZlbnNlLXNjaGVkdWxlcy9ieS10eXBlP2RlZmVuc2VfdHlwZT1QUkUtT1JBTCZkZXBhcnRtZW50PUJTSVQmc2VjdGlvbj00MTA0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNDoib3RwX2V4cGlyZXNfYXQiO2k6MTc2MDQ5MTg1MztzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1760220808),
('xX02SYlsD7ZoM4NNgEnTVX5iti3LnSoR491fRbcM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUhNWDBMaUhvZDFhUUE3YTN4cnFYMUdNRlVaU283TmhOTWFtRndzViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1760220835);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `documents` varchar(255) DEFAULT NULL,
  `defense_type` enum('Pre-Oral','Final Defense','Pre-Oral Re-Defense','Final Defense Re-Defense') NOT NULL,
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

INSERT INTO `submissions` (`id`, `user_id`, `documents`, `defense_type`, `file_path`, `department`, `cluster`, `group_no`, `status`, `submitted_by`, `feedback`, `created_at`, `updated_at`, `due_date`, `chapter`) VALUES
(10, 2, 'Research Title Proposal', 'Pre-Oral', 'submissions/Z58uxITMZ8CHbiCg8yAhJ6rogNhsJ0PkZb0SPzun.docx', 'BSIT', 4101, 1, 'Rejected', 'Unknown', 'mali', '2025-10-11 02:38:35', '2025-10-11 03:27:02', NULL, NULL),
(11, 2, 'Research Title Proposal', 'Pre-Oral', 'submissions/7Se2fiSbuxUVjLTVuugA9mIgo9rGXYsKBZPOMTY7.pdf', 'BSIT', 4101, 1, 'Approved', 'Unknown', 'Good', '2025-10-11 02:48:24', '2025-10-11 03:32:06', NULL, NULL),
(12, 2, 'Research Forum', 'Pre-Oral', 'submissions/Szg0n2Cb6qRjbhlcjt8Rn5Vc1aNOOBaNqrWK0XiJ.pdf', 'BSIT', 4101, 1, 'Pending', 'Unknown', NULL, '2025-10-11 03:33:17', '2025-10-11 03:33:17', NULL, NULL),
(13, 2, 'Clearance', 'Pre-Oral', 'submissions/SNnOpUJ1R5eUBogOf5QZAcJ9nJxmlgCXMPktc5aO.pdf', 'BSIT', 4101, 1, 'Pending', 'Unknown', NULL, '2025-10-11 03:33:33', '2025-10-11 03:33:33', NULL, NULL),
(14, 2, 'Manuscript Chapter 1-3', 'Pre-Oral', 'submissions/7dRwxTpqWkvhz2kaZevoBzXQbFLf1s3g7Pb8h3Jb.pdf', 'BSIT', 4101, 1, 'Pending', 'Unknown', NULL, '2025-10-11 03:33:43', '2025-10-11 03:33:43', NULL, NULL);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `otp_expires_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department` varchar(50) DEFAULT NULL,
  `section_cluster` int(11) DEFAULT NULL,
  `group_no` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `role`, `otp`, `otp_expires_at`, `department`, `section_cluster`, `group_no`) VALUES
(1, 'Admin', 'bretbaa12@gmail.com', '2025-10-11 08:28:37', '$2y$12$oo2oGMnoPbW2eBRlh4NgY.OqPWJHmtpfbRxlsLixLwGHtF8iFCa.G', NULL, '2025-10-04 02:47:25', '2025-10-11 08:28:37', 1, 'admin', '345301', '2025-10-14 17:30:53', NULL, NULL, NULL),
(2, 'Juan DelaCruz', 'juandelacruz@gmail.com', NULL, '$2y$12$yRv/bAuntULudSXCDZwP5.4FicKH7IU16jACl6bvYqOykwLUU0eIa', NULL, '2025-10-04 03:02:00', '2025-10-09 11:34:20', NULL, 'student', NULL, '2025-10-03 20:02:00', 'BSIT', 4101, 1),
(4, 'Maria Santos', 'mariasantos@gmail.com', NULL, '$2y$12$TwEpE/bLk.b3ujC1wtFmnOEG9M42bM1Y5KLm/nmCAaNtteqSgL8e.', NULL, '2025-10-09 11:34:20', '2025-10-09 11:34:20', NULL, 'student', NULL, '2025-10-09 19:34:20', 'CRIM', 4102, 2),
(5, 'Pedro Cruz', 'pedrocruz@gmail.com', NULL, '$2y$12$qHgLYDa8I5w53RofZ8wUGeDzoMJzvqL9orOW8wNN91p5YGXqzUzA2', NULL, '2025-10-09 11:34:20', '2025-10-09 11:34:20', NULL, 'student', NULL, '2025-10-09 19:34:20', 'EDUC', 4103, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advisers`
--
ALTER TABLE `advisers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_panels`
--
ALTER TABLE `assignment_panels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assignment` (`assignment_id`),
  ADD KEY `fk_panel` (`panel_id`);

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
-- Indexes for table `clusters`
--
ALTER TABLE `clusters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defense_evaluations`
--
ALTER TABLE `defense_evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `defense_evaluations_department_cluster_group_id_index` (`department`,`cluster`,`group_id`);

--
-- Indexes for table `defense_schedules`
--
ALTER TABLE `defense_schedules`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panels`
--
ALTER TABLE `panels`
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
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `advisers`
--
ALTER TABLE `advisers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `assignment_panels`
--
ALTER TABLE `assignment_panels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `clusters`
--
ALTER TABLE `clusters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defense_evaluations`
--
ALTER TABLE `defense_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `defense_schedules`
--
ALTER TABLE `defense_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `panels`
--
ALTER TABLE `panels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_panels`
--
ALTER TABLE `assignment_panels`
  ADD CONSTRAINT `fk_assignment` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_panel` FOREIGN KEY (`panel_id`) REFERENCES `panels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
