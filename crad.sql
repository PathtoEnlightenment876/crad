-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost: 3306
-- Generation Time: Oct 09, 2025 at 05:12 PM
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
(1, 'BSIT', 'Dr. Elacion', 'Professor', '[4101,4102]', NULL, NULL, NULL),
(2, 'BSIT', 'Mr. Baa', 'Assistant Professor', '[4103]', NULL, NULL, NULL),
(3, 'BSIT', 'Mr. Jairo Indoso', 'Instructor', '[\"4104\"]', NULL, '2025-10-08 23:41:28', NULL),
(4, 'CRIM', 'Dr. Cruz', 'Professor', '[4101]', NULL, NULL, NULL),
(5, 'EDUC', 'Prof. Garcia', 'Associate Professor', '[4102]', NULL, '2025-10-09 07:03:02', '2025-10-09 07:03:02'),
(6, 'BSBA', 'Dr. Martinez', 'Professor', '[4103,4104]', NULL, NULL, NULL),
(8, 'CRIM', 'Prof. John', 'Instructor', '[\"4105\"]', '2025-10-08 02:27:54', '2025-10-09 04:58:25', NULL),
(9, 'Psychology', 'Prof. Marie', 'Professor', '[\"4110\"]', '2025-10-08 02:37:44', '2025-10-08 02:37:44', NULL),
(10, 'BSTM', 'Prof. Robin Williams', 'Instructor', '[\"4105\"]', '2025-10-07 22:03:13', '2025-10-07 22:03:13', NULL),
(12, 'Psychology', 'Prof. Carl Jung', 'Professor', '[\"4104\"]', '2025-10-07 23:11:31', '2025-10-09 07:06:15', '2025-10-09 07:06:15'),
(17, 'BSTM', 'Prof. Williams', 'Instructor', '[\"4105\"]', '2025-10-08 23:18:14', '2025-10-08 23:18:14', NULL),
(19, 'Psychology', 'Prof.  Carl Jung', 'Professor', '[\"4104\"]', '2025-10-09 04:39:01', '2025-10-09 04:39:01', NULL),
(20, 'Psychology', 'Prof. Jane', 'Professor', '[\"4110\"]', '2025-10-09 04:51:57', '2025-10-09 04:58:09', NULL);

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
(1, 'BSIT', '4102', 1, '2025-10-08 01:22:24', '2025-10-08 01:22:24'),
(2, 'BSIT', '4102', 1, '2025-10-08 01:23:31', '2025-10-08 01:23:31'),
(3, 'BSIT', '4101', 1, '2025-10-08 01:25:29', '2025-10-08 01:25:29'),
(4, 'BSIT', '4102', 1, '2025-10-08 01:29:58', '2025-10-08 01:29:58'),
(5, 'BSIT', '4102', 1, '2025-10-08 01:30:23', '2025-10-08 01:30:23'),
(6, 'BSIT', '4102', 1, '2025-10-08 01:35:12', '2025-10-08 01:35:12'),
(7, 'BSIT', '4102', 1, '2025-10-08 01:35:31', '2025-10-08 01:35:31'),
(8, 'BSIT', '4102', 1, '2025-10-08 01:39:10', '2025-10-08 01:39:10'),
(9, 'CRIM', '4101', 4, '2025-10-08 01:45:40', '2025-10-08 01:45:40'),
(10, 'Psychology', '4104', 7, '2025-10-08 01:51:33', '2025-10-08 01:51:33'),
(11, 'BSIT', '4103', 2, '2025-10-08 02:09:40', '2025-10-08 02:09:40'),
(12, 'EDUC', '4102', 5, '2025-10-08 02:23:22', '2025-10-08 02:23:22'),
(13, 'EDUC', '4102', 5, '2025-10-08 02:23:47', '2025-10-08 02:23:47'),
(14, 'BSIT', '4105', 3, '2025-10-08 02:29:35', '2025-10-08 02:29:35'),
(15, 'BSIT', '4101', 1, '2025-10-08 02:33:53', '2025-10-08 02:33:53'),
(16, 'Psychology', '4110', 9, '2025-10-08 02:39:34', '2025-10-08 02:39:34'),
(17, 'CRIM', '4101', 4, '2025-10-07 20:37:50', '2025-10-07 20:37:50'),
(18, 'BSTM', '4105', 10, '2025-10-07 22:04:56', '2025-10-07 22:04:56'),
(19, 'BSTM', '4105', 10, '2025-10-07 22:07:07', '2025-10-07 22:07:07'),
(20, 'CRIM', '4101', 4, '2025-10-07 22:51:39', '2025-10-07 22:51:39'),
(21, 'BSTM', '4105', 11, '2025-10-07 22:58:04', '2025-10-07 22:58:04'),
(22, 'BSTM', '4105', 11, '2025-10-07 23:00:45', '2025-10-07 23:00:45'),
(23, 'BSIT', '4101', 1, '2025-10-07 23:05:56', '2025-10-07 23:05:56'),
(24, 'BSIT', '4101', 1, '2025-10-07 23:22:19', '2025-10-07 23:22:19'),
(25, 'Psychology', '4104', 12, '2025-10-07 23:49:58', '2025-10-07 23:49:58'),
(26, 'Psychology', '4104', 12, '2025-10-07 23:52:36', '2025-10-07 23:52:36'),
(27, 'BSIT', '4101', 1, '2025-10-08 05:10:15', '2025-10-08 05:10:15'),
(28, 'Psychology', '4110', 9, '2025-10-08 05:14:43', '2025-10-08 05:14:43'),
(29, 'CRIM', '4101', 4, '2025-10-09 05:08:00', '2025-10-09 05:08:00'),
(30, 'Psychology', '4104', 12, '2025-10-09 05:10:20', '2025-10-09 05:10:20'),
(31, 'BSIT', '4102', 1, '2025-10-09 05:18:01', '2025-10-09 05:18:01'),
(32, 'CRIM', '4101', 4, '2025-10-09 05:23:24', '2025-10-09 05:23:24'),
(33, 'BSIT', '4102', 1, '2025-10-09 05:31:35', '2025-10-09 05:31:35'),
(34, 'BSIT', '4102', 1, '2025-10-09 05:34:22', '2025-10-09 05:34:22'),
(35, 'BSIT', '4102', 1, '2025-10-09 05:44:46', '2025-10-09 05:44:46'),
(36, 'BSIT', '4102', 1, '2025-10-09 05:45:15', '2025-10-09 05:45:15'),
(37, 'BSIT', '4101', 1, '2025-10-09 05:46:17', '2025-10-09 05:46:17'),
(38, 'BSIT', '4102', 1, '2025-10-09 05:46:46', '2025-10-09 05:46:46'),
(39, 'BSIT', '4101', 1, '2025-10-08 23:16:49', '2025-10-08 23:16:49'),
(40, 'BSIT', '4101', 1, '2025-10-08 23:18:32', '2025-10-08 23:18:32'),
(41, 'BSIT', '4101', 1, '2025-10-08 23:21:54', '2025-10-08 23:21:54'),
(42, 'BSIT', '4101', 1, '2025-10-08 23:43:00', '2025-10-08 23:43:00'),
(43, 'BSIT', '4101', 1, '2025-10-08 23:50:10', '2025-10-08 23:50:10'),
(44, 'BSIT', '4101', 1, '2025-10-08 23:53:27', '2025-10-08 23:53:27'),
(45, 'BSIT', '4102', 1, '2025-10-09 00:59:47', '2025-10-09 00:59:47'),
(46, 'BSIT', '4101', 1, '2025-10-09 04:03:43', '2025-10-09 04:03:43'),
(47, 'BSIT', '4101', 1, '2025-10-09 04:04:00', '2025-10-09 04:04:00'),
(48, 'Psychology', '4110', 20, '2025-10-09 04:58:54', '2025-10-09 04:58:54'),
(49, 'BSIT', '4101', 1, '2025-10-09 05:20:18', '2025-10-09 05:20:18');

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
(55, 'Adviser', 'Prof Jane Doe', 'Psychology', '4110', 'Associate Professor', '[{\"date\":\"2025-10-31\",\"time\":\"16:32 - 17:32\"}]', 28, 9, '2025-10-08 05:14:43', '2025-10-08 05:14:43'),
(56, 'Panel Member', 'Prof. Freud', 'Psychology', '4110', 'Professor', '[{\"date\":\"2025-10-05\",\"time\":\"22:00 - 23:00\"},{\"date\":\"2025-10-06\",\"time\":\"09:42 - 10:42\"}]', 28, 8, '2025-10-08 05:14:43', '2025-10-08 05:14:43'),
(57, 'Panel Member', 'Doc. Erik Erikson', 'Psychology', '4110', 'Doctoral', '[{\"date\":\"2025-10-07\",\"time\":\"12:38 - 13:38\"}]', 28, 15, '2025-10-08 05:14:43', '2025-10-08 05:14:43'),
(58, 'Panel Member', 'Doc. Napoleon', 'Psychology', '4110', 'Doctoral', '[{\"date\":\"2025-10-26\",\"time\":\"09:52 - 10:52\"}]', 28, 17, '2025-10-08 05:14:43', '2025-10-08 05:14:43'),
(59, 'Adviser', 'Dr. Cruz', 'CRIM', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 29, 4, '2025-10-09 05:08:00', '2025-10-09 05:08:00'),
(60, 'Panel Member', 'Dr. Cruz', 'CRIM', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 29, 4, '2025-10-09 05:08:00', '2025-10-09 05:08:00'),
(61, 'Adviser', 'Doc. Ramirez', 'Psychology', '4104', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"13:00 - 15:00\"}]', 30, 12, '2025-10-09 05:10:20', '2025-10-09 05:10:20'),
(62, 'Panel Member', 'Prof. Freud', 'Psychology', '4104', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"22:00 - 23:00\"},{\"date\":\"2025-10-06\",\"time\":\"09:42 - 10:42\"}]', 30, 8, '2025-10-09 05:10:20', '2025-10-09 05:10:20'),
(63, 'Panel Member', 'Doc. Erik Erikson', 'Psychology', '4104', NULL, '[{\"date\":\"2025-10-07\",\"time\":\"12:38 - 13:38\"}]', 30, 15, '2025-10-09 05:10:20', '2025-10-09 05:10:20'),
(64, 'Panel Member', 'Doc. Napoleon', 'Psychology', '4104', NULL, '[{\"date\":\"2025-10-26\",\"time\":\"09:52 - 10:52\"}]', 30, 17, '2025-10-09 05:10:20', '2025-10-09 05:10:20'),
(65, 'Adviser', 'Dr. Elacion', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 31, 1, '2025-10-09 05:18:01', '2025-10-09 05:18:01'),
(66, 'Panel Member', 'Mr. Baa', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 31, 2, '2025-10-09 05:18:01', '2025-10-09 05:18:01'),
(67, 'Panel Member', 'Ms. Indoso', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 31, 3, '2025-10-09 05:18:01', '2025-10-09 05:18:01'),
(68, 'Panel Member', 'Prof. Linus', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 31, 7, '2025-10-09 05:18:01', '2025-10-09 05:18:01'),
(69, 'Adviser', 'Dr. Cruz', 'CRIM', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 32, 4, '2025-10-09 05:23:24', '2025-10-09 05:23:24'),
(70, 'Panel Member', 'Dr. Cruz', 'CRIM', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 32, 4, '2025-10-09 05:23:24', '2025-10-09 05:23:24'),
(71, 'Adviser', 'Dr. Elacion', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 33, 1, '2025-10-09 05:31:36', '2025-10-09 05:31:36'),
(72, 'Panel Member', 'Mr. Baa', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 33, 2, '2025-10-09 05:31:36', '2025-10-09 05:31:36'),
(73, 'Panel Member', 'Ms. Indoso', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 33, 3, '2025-10-09 05:31:36', '2025-10-09 05:31:36'),
(74, 'Panel Member', 'Prof. Linus', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 33, 7, '2025-10-09 05:31:36', '2025-10-09 05:31:36'),
(75, 'Adviser', 'Dr. Elacion', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 34, 1, '2025-10-09 05:34:22', '2025-10-09 05:34:22'),
(76, 'Panel Member', 'Mr. Baa', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 34, 2, '2025-10-09 05:34:22', '2025-10-09 05:34:22'),
(77, 'Panel Member', 'Ms. Indoso', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 34, 3, '2025-10-09 05:34:22', '2025-10-09 05:34:22'),
(78, 'Panel Member', 'Prof. Linus', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 34, 7, '2025-10-09 05:34:22', '2025-10-09 05:34:22'),
(79, 'Adviser', 'Dr. Elacion', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 35, 1, '2025-10-09 05:44:46', '2025-10-09 05:44:46'),
(80, 'Panel Member', 'Mr. Baa', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 35, 2, '2025-10-09 05:44:47', '2025-10-09 05:44:47'),
(81, 'Panel Member', 'Ms. Indoso', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 35, 3, '2025-10-09 05:44:47', '2025-10-09 05:44:47'),
(82, 'Panel Member', 'Prof. Linus', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 35, 7, '2025-10-09 05:44:47', '2025-10-09 05:44:47'),
(83, 'Adviser', 'Dr. Elacion', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 36, 1, '2025-10-09 05:45:15', '2025-10-09 05:45:15'),
(84, 'Panel Member', 'Mr. Baa', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 36, 2, '2025-10-09 05:45:15', '2025-10-09 05:45:15'),
(85, 'Panel Member', 'Ms. Indoso', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 36, 3, '2025-10-09 05:45:15', '2025-10-09 05:45:15'),
(86, 'Panel Member', 'Prof. Linus', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 36, 7, '2025-10-09 05:45:15', '2025-10-09 05:45:15'),
(87, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 37, 1, '2025-10-09 05:46:17', '2025-10-09 05:46:17'),
(88, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 37, 2, '2025-10-09 05:46:17', '2025-10-09 05:46:17'),
(89, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 37, 3, '2025-10-09 05:46:17', '2025-10-09 05:46:17'),
(90, 'Panel Member', 'Prof. Linus', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 37, 7, '2025-10-09 05:46:17', '2025-10-09 05:46:17'),
(91, 'Adviser', 'Dr. Elacion', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 38, 1, '2025-10-09 05:46:46', '2025-10-09 05:46:46'),
(92, 'Panel Member', 'Mr. Baa', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 38, 2, '2025-10-09 05:46:46', '2025-10-09 05:46:46'),
(93, 'Panel Member', 'Ms. Indoso', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 38, 3, '2025-10-09 05:46:46', '2025-10-09 05:46:46'),
(94, 'Panel Member', 'Prof. Linus', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 38, 7, '2025-10-09 05:46:46', '2025-10-09 05:46:46'),
(95, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 39, 1, '2025-10-08 23:16:49', '2025-10-08 23:16:49'),
(96, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 39, 2, '2025-10-08 23:16:49', '2025-10-08 23:16:49'),
(97, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 39, 3, '2025-10-08 23:16:49', '2025-10-08 23:16:49'),
(98, 'Panel Member', 'Prof. Linus', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 39, 7, '2025-10-08 23:16:49', '2025-10-08 23:16:49'),
(99, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 40, 1, '2025-10-08 23:18:32', '2025-10-08 23:18:32'),
(100, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 40, 2, '2025-10-08 23:18:32', '2025-10-08 23:18:32'),
(101, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 40, 3, '2025-10-08 23:18:32', '2025-10-08 23:18:32'),
(102, 'Panel Member', 'Prof. Linus', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 40, 7, '2025-10-08 23:18:32', '2025-10-08 23:18:32'),
(103, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 41, 1, '2025-10-08 23:21:54', '2025-10-08 23:21:54'),
(104, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 41, 2, '2025-10-08 23:21:54', '2025-10-08 23:21:54'),
(105, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 41, 3, '2025-10-08 23:21:54', '2025-10-08 23:21:54'),
(106, 'Panel Member', 'Prof. Linus', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 41, 7, '2025-10-08 23:21:54', '2025-10-08 23:21:54'),
(107, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 42, 1, '2025-10-08 23:43:00', '2025-10-08 23:43:00'),
(108, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 42, 2, '2025-10-08 23:43:00', '2025-10-08 23:43:00'),
(109, 'Panel Member', 'Prof. Linus', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 42, 7, '2025-10-08 23:43:00', '2025-10-08 23:43:00'),
(110, 'Panel Member', 'Doc. Peter', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-23\",\"time\":\"12:33 - 13:33\"}]', 42, 10, '2025-10-08 23:43:00', '2025-10-08 23:43:00'),
(111, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 43, 1, '2025-10-08 23:50:10', '2025-10-08 23:50:10'),
(112, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 43, 2, '2025-10-08 23:50:10', '2025-10-08 23:50:10'),
(113, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 43, 3, '2025-10-08 23:50:10', '2025-10-08 23:50:10'),
(114, 'Panel Member', 'Prof. Linus', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 43, 7, '2025-10-08 23:50:10', '2025-10-08 23:50:10'),
(115, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 44, 1, '2025-10-08 23:53:27', '2025-10-08 23:53:27'),
(116, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 44, 3, '2025-10-08 23:53:27', '2025-10-08 23:53:27'),
(117, 'Panel Member', 'Prof. Linus', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 44, 7, '2025-10-08 23:53:27', '2025-10-08 23:53:27'),
(118, 'Panel Member', 'Prof Jane Doe', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-31\",\"time\":\"16:32 - 17:32\"}]', 44, 9, '2025-10-08 23:53:27', '2025-10-08 23:53:27'),
(119, 'Adviser', 'Dr. Elacion', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 45, 1, '2025-10-09 00:59:47', '2025-10-09 00:59:47'),
(120, 'Panel Member', 'Mr. Baa', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 45, 2, '2025-10-09 00:59:47', '2025-10-09 00:59:47'),
(121, 'Panel Member', 'Ms. Indoso', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 45, 3, '2025-10-09 00:59:47', '2025-10-09 00:59:47'),
(122, 'Panel Member', 'Prof. Linus', 'BSIT', '4102', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', 45, 7, '2025-10-09 00:59:47', '2025-10-09 00:59:47'),
(123, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 46, 1, '2025-10-09 04:03:43', '2025-10-09 04:03:43'),
(124, 'Panel Member', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 46, 1, '2025-10-09 04:03:43', '2025-10-09 04:03:43'),
(125, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 46, 2, '2025-10-09 04:03:44', '2025-10-09 04:03:44'),
(126, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 46, 3, '2025-10-09 04:03:44', '2025-10-09 04:03:44'),
(127, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 47, 1, '2025-10-09 04:04:01', '2025-10-09 04:04:01'),
(128, 'Panel Member', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 47, 1, '2025-10-09 04:04:01', '2025-10-09 04:04:01'),
(129, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 47, 2, '2025-10-09 04:04:01', '2025-10-09 04:04:01'),
(130, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 47, 3, '2025-10-09 04:04:01', '2025-10-09 04:04:01'),
(131, 'Panel Member', 'Prof. Freud', 'Psychology', '4110', NULL, '[{\"date\":\"2025-10-05\",\"time\":\"22:00 - 23:00\"},{\"date\":\"2025-10-06\",\"time\":\"09:42 - 10:42\"}]', 48, 8, '2025-10-09 04:58:54', '2025-10-09 04:58:54'),
(132, 'Panel Member', 'Doc. Erik Erikson', 'Psychology', '4110', NULL, '[{\"date\":\"2025-10-07\",\"time\":\"12:38 - 13:38\"}]', 48, 15, '2025-10-09 04:58:54', '2025-10-09 04:58:54'),
(133, 'Panel Member', 'Doc. Napoleon', 'Psychology', '4110', NULL, '[{\"date\":\"2025-10-26\",\"time\":\"09:52 - 10:52\"}]', 48, 17, '2025-10-09 04:58:54', '2025-10-09 04:58:54'),
(134, 'Adviser', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 49, 1, '2025-10-09 05:20:18', '2025-10-09 05:20:18'),
(135, 'Panel Member', 'Dr. Elacion', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', 49, 1, '2025-10-09 05:20:18', '2025-10-09 05:20:18'),
(136, 'Panel Member', 'Mr. Baa', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', 49, 2, '2025-10-09 05:20:18', '2025-10-09 05:20:18'),
(137, 'Panel Member', 'Ms. Indoso', 'BSIT', '4101', NULL, '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', 49, 3, '2025-10-09 05:20:18', '2025-10-09 05:20:18');

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
(9, '2025_10_09_145802_add_soft_deletes_to_panels_table', 4);

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
(72, 2, 'status', 'Your proposal \'Research Title Proposal\' has been approved.', 1, '2025-10-01 05:54:27', '2025-10-01 06:05:04');

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
  `availability` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`availability`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `panels`
--

INSERT INTO `panels` (`id`, `department`, `name`, `expertise`, `availability`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BSIT', 'Dr. Elacion', 'Professor', '[{\"date\":\"2025-10-15\",\"time\":\"08:00 - 12:00\"},{\"date\":\"2025-10-16\",\"time\":\"13:00 - 17:00\"}]', NULL, NULL, NULL),
(2, 'BSIT', 'Mr. Baa', 'Assistant Professor', '[{\"date\":\"2025-10-15\",\"time\":\"13:00 - 17:00\"}]', NULL, NULL, NULL),
(3, 'BSIT', 'Ms. Indoso', 'Instructor', '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', NULL, NULL, NULL),
(4, 'CRIM', 'Dr. Cruz', 'Professor', '[{\"date\":\"2025-10-16\",\"time\":\"08:00 - 12:00\"}]', NULL, NULL, NULL),
(5, 'EDUC', 'Prof. Garcia', 'Associate Professor', '[{\"date\":\"2025-10-17\",\"time\":\"09:00 - 13:00\"}]', NULL, '2025-10-09 07:06:32', '2025-10-09 07:06:32'),
(6, 'BSBA', 'Dr. Martinez', 'Professor', '[{\"date\":\"2025-10-18\",\"time\":\"10:00 - 14:00\"},{\"date\":\"2025-10-19\",\"time\":\"08:00 - 12:00\"}]', NULL, NULL, NULL),
(7, 'BSIT', 'Prof. Linus', 'Industry Expert', '[{\"date\":\"2025-10-05\",\"time\":\"01:51 - 02:51\"},{\"date\":\"2025-10-06\",\"time\":\"02:51 - 03:51\"}]', '2025-10-05 15:52:03', '2025-10-05 15:52:03', NULL),
(8, 'Psychology', 'Prof. Freud', 'Professor', '[{\"date\":\"2025-10-05\",\"time\":\"22:00 - 23:00\"},{\"date\":\"2025-10-06\",\"time\":\"09:42 - 10:42\"}]', '2025-10-05 23:42:39', '2025-10-05 23:42:39', NULL),
(9, 'BSIT', 'Prof Jane Doe', 'Associate Professor', '[{\"date\":\"2025-10-31\",\"time\":\"16:32 - 17:32\"}]', '2025-10-08 02:32:54', '2025-10-08 02:32:54', NULL),
(10, 'BSIT', 'Doc. Peter', 'Doctoral', '[{\"date\":\"2025-10-23\",\"time\":\"12:33 - 13:33\"}]', '2025-10-08 02:33:32', '2025-10-08 02:33:32', NULL),
(12, 'BSTM', 'Doc. Ramirez', 'Doctoral', '[{\"date\":\"2025-10-16\",\"time\":\"13:00 - 15:00\"}]', '2025-10-07 22:04:40', '2025-10-07 22:04:40', NULL),
(15, 'Psychology', 'Doc. Erik Erikson', 'Doctoral', '[{\"date\":\"2025-10-07\",\"time\":\"12:38 - 13:38\"}]', '2025-10-07 23:08:45', '2025-10-07 23:08:45', NULL),
(17, 'Psychology', 'Doc. Napoleon', 'Doctoral', '[{\"date\":\"2025-10-26\",\"time\":\"09:52 - 10:52\"}]', '2025-10-07 23:52:09', '2025-10-07 23:52:09', NULL),
(18, 'Psychology', 'Doc. Napoleon', 'Doctoral', '[{\"date\":\"2025-10-26\",\"time\":\"09:52 - 10:52\"},{\"date\":\"2025-10-08\",\"time\":\"13:50 - 14:50\"}]', '2025-10-09 03:50:33', '2025-10-09 03:50:33', NULL);

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
('oQlr7YtTHwDIyZ31sU4Txajt5tbfoZ1kvX3qUwMD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY0lENHRaaG5ZMWN5dEp5MHBCOEYxMXUwZ2d1UVlQV0dzM3ZzYjI2SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbHMvYXJjaGl2ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE0OiJvdHBfZXhwaXJlc19hdCI7aToxNzYwMTY4MzA5O3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1760022417);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `documents` varchar(255) DEFAULT NULL,
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
  `cluster` tinyint(4) DEFAULT NULL,
  `group_no` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`, `role`, `otp`, `otp_expires_at`, `department`, `cluster`, `group_no`) VALUES
(1, 'Admin', 'bretbaa12@gmail.com', '2025-10-08 23:15:58', '$2y$12$oo2oGMnoPbW2eBRlh4NgY.OqPWJHmtpfbRxlsLixLwGHtF8iFCa.G', NULL, '2025-10-04 02:47:25', '2025-10-08 23:15:58', 1, 'admin', '363115', '2025-10-10 23:38:29', NULL, NULL, NULL),
(2, 'Juan DelaCruz', 'juandelacruz@gmail.com', NULL, '$2y$12$vpRLFGeQf85iSMnVIw3SXezj/s0D2h4C7zRbzImDN/RxO6WL9jMSm', NULL, '2025-10-04 03:02:00', '2025-10-04 03:02:00', NULL, 'student', NULL, '2025-10-03 20:02:00', 'BSIT', 1, 4);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `assignment_panels`
--
ALTER TABLE `assignment_panels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `clusters`
--
ALTER TABLE `clusters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `panels`
--
ALTER TABLE `panels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
