-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 05:29 AM
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
-- Database: `invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_accountant` bigint(20) DEFAULT NULL,
  `soft_delete` timestamp NULL DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `phone`, `address`, `status`, `is_accountant`, `soft_delete`, `created_at`, `updated_at`) VALUES
(3, 'Vishal Goswami', 'admin', 'admin@gmail.com', '$2y$10$E61iUTtsbiN.AX2OYkD2h./M/DIYDkfB4nJmgrt5D63fLzJqGdYTC', NULL, NULL, 'active', 0, NULL, NULL, '2023-04-09 00:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `document_number` varchar(255) DEFAULT NULL,
  `revision_table` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `toc_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`toc_items`)),
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `title`, `subtitle`, `document_number`, `revision_table`, `toc_items`, `sections`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'd56g464g', 'dfgdfgdfg', 'dfgdfgdfg', '\"{\\\"created_by\\\":[\\\"dgdfgdfgf\\\",\\\"fggg\\\",\\\"ggggngn\\\"],\\\"created_by_date\\\":[\\\"2025-03-04\\\",\\\"2025-02-28\\\",\\\"2025-03-04\\\"],\\\"reviewed_by\\\":[\\\"dfgdfgdg\\\",\\\"4g4g\\\",\\\"fghfgh\\\"],\\\"reviewed_by_date\\\":[\\\"2025-03-04\\\",\\\"2025-03-06\\\",\\\"2025-03-28\\\"],\\\"approved_by\\\":[\\\"dfgdfg\\\",\\\"45g4g4g4\\\",\\\"fghfh\\\"],\\\"approved_by_date\\\":[\\\"2025-03-04\\\",\\\"2025-03-03\\\",\\\"2025-03-27\\\"],\\\"reason_of_revision\\\":[\\\"dfgdfg\\\",\\\"4g4g4gg\\\",\\\"fghfgh\\\"]}\"', NULL, '\"{\\\"section_titles\\\":[\\\"First tiel\\\",\\\"secnd title\\\",\\\"third Title\\\",\\\"Fourth Titl\\\"],\\\"subtitle_titles\\\":{\\\"1\\\":[\\\"First Sub title\\\",\\\"first 2nd tile\\\"],\\\"2\\\":[\\\"second subtitle\\\"],\\\"4\\\":[\\\"Ensure the file path is correct and the file is being saved and downloaded as expected.Ensure the file path is correct and the file is being saved and downloaded as expected.Ensure the file path is correct and the file is being saved and downloaded as expected.Ensure the file path is correct and the file is being saved and downloaded as expected.Ensure the file path is correct and the file is being saved and downloaded as expected.Ensure the file path is correct and the file is being saved and downloaded as expected.Ensure the file path is correct and the file is being saved and downloaded as expected.\\\"]},\\\"subtitle_contents\\\":[]}\"', '2025-03-04 07:11:22', '2025-03-13 07:02:02', '2025-03-13 07:02:02'),
(4, 'Annual Report 2024', 'Year in Review', 'AR-2024-001', '\"{\\\"created_by\\\":[\\\"John Doe\\\",\\\"Jane Smith\\\"],\\\"created_by_date\\\":[\\\"2024-01-01\\\",\\\"2024-01-02\\\"],\\\"reviewed_by\\\":[\\\"Mark Taylor\\\",\\\"Sarah Lee\\\"],\\\"reviewed_by_date\\\":[\\\"2024-01-05\\\",\\\"2024-01-06\\\"],\\\"approved_by\\\":[\\\"David Wilson\\\",\\\"Emily Brown\\\"],\\\"approved_by_date\\\":[\\\"2024-01-10\\\",\\\"2024-01-11\\\"],\\\"reason_of_revision\\\":[\\\"Initial Draft\\\",\\\"Minor Edits\\\"]}\"', NULL, '\"{\\\"section_titles\\\":[\\\"Introduction\\\",\\\"Financial Overview\\\",\\\"Operations Review\\\",\\\"Conclusion\\\"],\\\"subtitle_titles\\\":[[\\\"Overview\\\",\\\"Key Metrics\\\"],[\\\"Revenue\\\",\\\"Expenses\\\"],[\\\"Production\\\",\\\"Sales\\\"],[\\\"Summary\\\"]],\\\"subtitle_contents\\\":[\\\"This section introduces the overall report and its purpose.\\\",\\\"In this section, we cover the key revenue and expense data for the year.\\\",\\\"This section details the operations of our company throughout the year.\\\",\\\"A brief summary of the overall performance and future outlook.\\\"]}\"', '2025-03-04 07:14:24', '2025-03-13 07:01:59', '2025-03-13 07:01:59'),
(6, 'Need to Fetch ALl Points and Columns', 'Its a testing Doc and and this field is used a doc suntitle', 'doc-001-002-0054552', '{\"created_by\":[\"me\",\"me1\",\"me2\"],\"created_by_date\":[\"2025-03-13\",\"2025-03-05\",\"2025-03-13\"],\"reviewed_by\":[\"you\",\"you1\",\"you2\"],\"reviewed_by_date\":[\"2025-03-13\",\"2025-03-13\",\"2025-03-13\"],\"approved_by\":[\"he\",\"he1\",\"he2\"],\"approved_by_date\":[\"2025-03-13\",\"2025-03-13\",\"2025-03-13\"],\"reason_of_revision\":[\"she\",\"she1\",\"she2\"]}', '[\"AAAAAAAAAA\",\"BBBBBBBBBB\",\"CCCCCCCCCC\",\"DDDDDDDDD\"]', '{\"section_titles\":[\"AAAAAAAAAA title\",\"BBBBBBBBBB Title\",\"CCCCCCCCCC Title\",\"DDDDDDDDD Title\"],\"subtitle_titles\":{\"1\":[\"AAAAAAAAAA Subtitle\",\"AAAAAAAAAA1 Subtitle\"],\"2\":[\"BBBBBBBBBB Subtitle\"],\"3\":[\"CCCCCCCCCC Subtitle\",\"CCCCCCCCCC1 Subtitle\"],\"4\":[\"DDDDDDDDD Subtitle\"]},\"subtitle_contents\":{\"1\":[\"AAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA Content\",\"AAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntect\"],\"2\":[\"BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect\"],\"3\":[\"CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content\",\"CCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 Content\"],\"4\":[\"DDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD Content\"]},\"subtitle_images\":{\"1\":[\"AAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA Image\",\"AAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 Image\"],\"2\":[\"BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image\"],\"3\":[\"CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image\",\"CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image\"],\"4\":[\"DDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD Image\"]}}', '2025-03-13 05:57:23', '2025-03-13 05:57:23', NULL),
(7, 'Need to Fetch ALl Points and Columns 22222', 'Its a testing Doc and and this field is used a doc suntitle 22222', 'doc-001-002-005455222222', '{\"created_by\":[\"me\",\"me1\",\"me2\"],\"created_by_date\":[\"2025-03-13\",\"2025-03-05\",\"2025-03-13\"],\"reviewed_by\":[\"you\",\"you1\",\"you2\"],\"reviewed_by_date\":[\"2025-03-13\",\"2025-03-13\",\"2025-03-13\"],\"approved_by\":[\"he\",\"he1\",\"he2\"],\"approved_by_date\":[\"2025-03-13\",\"2025-03-13\",\"2025-03-13\"],\"reason_of_revision\":[\"she\",\"she1\",\"she2\"]}', '[\"AAAAAAAAAA22222\",\"BBBBBBBBBB22222\",\"CCCCCCCCCC22222\",\"DDDDDDDDD22222\"]', '{\"section_titles\":[\"AAAAAAAAAA title\",\"BBBBBBBBBB Title\",\"CCCCCCCCCC Title\",\"DDDDDDDDD Title\"],\"subtitle_titles\":{\"1\":[\"AAAAAAAAAA Subtitle\",\"AAAAAAAAAA1 Subtitle\"],\"2\":[\"BBBBBBBBBB Subtitle\"],\"3\":[\"CCCCCCCCCC Subtitle\",\"CCCCCCCCCC1 Subtitle\"],\"4\":[\"DDDDDDDDD Subtitle\"]},\"subtitle_contents\":{\"1\":[\"AAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA Content\",\"AAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntect\"],\"2\":[\"BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect\"],\"3\":[\"CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content\",\"CCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 Content\"],\"4\":[\"DDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD Content\"]},\"subtitle_images\":{\"1\":[\"AAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA Image\",\"AAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 Image\"],\"2\":[\"BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image\"],\"3\":[\"CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image\",\"CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image\"],\"4\":[\"DDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD Image\"]}}', '2025-03-13 06:42:33', '2025-03-13 07:01:57', '2025-03-13 07:01:57'),
(8, NULL, NULL, NULL, '{\"created_by\":[null,null,null],\"created_by_date\":[\"2025-03-22\",\"2025-03-22\",\"2025-03-22\"],\"reviewed_by\":[null,null,null],\"reviewed_by_date\":[\"2025-03-22\",\"2025-03-22\",\"2025-03-22\"],\"approved_by\":[null,null,null],\"approved_by_date\":[\"2025-03-22\",\"2025-03-22\",\"2025-03-22\"],\"reason_of_revision\":[null,null,null]}', '[null,null]', '{\"section_titles\":[null,null],\"subtitle_titles\":[],\"subtitle_contents\":[],\"subtitle_images\":[]}', '2025-03-22 04:25:17', '2025-03-22 08:51:19', '2025-03-22 08:51:19'),
(9, NULL, NULL, NULL, '{\"created_by\":[null],\"created_by_date\":[\"2025-03-22\"],\"reviewed_by\":[null],\"reviewed_by_date\":[\"2025-03-22\"],\"approved_by\":[null],\"approved_by_date\":[\"2025-03-22\"],\"reason_of_revision\":[null]}', '[]', '{\"section_titles\":[],\"subtitle_titles\":[],\"subtitle_contents\":[],\"subtitle_images\":[]}', '2025-03-22 04:25:53', '2025-03-22 08:51:23', '2025-03-22 08:51:23'),
(10, NULL, NULL, NULL, '{\"created_by\":[null],\"created_by_date\":[\"2025-03-22\"],\"reviewed_by\":[null],\"reviewed_by_date\":[\"2025-03-22\"],\"approved_by\":[null],\"approved_by_date\":[\"2025-03-22\"],\"reason_of_revision\":[null]}', '[]', '{\"section_titles\":[],\"subtitle_titles\":[],\"subtitle_contents\":[],\"subtitle_images\":[]}', '2025-03-22 04:26:25', '2025-03-22 08:51:31', '2025-03-22 08:51:31'),
(11, NULL, NULL, NULL, '{\"created_by\":[null,null],\"created_by_date\":[\"2025-03-22\",\"2025-03-22\"],\"reviewed_by\":[null,null],\"reviewed_by_date\":[\"2025-03-22\",\"2025-03-22\"],\"approved_by\":[null,null],\"approved_by_date\":[\"2025-03-22\",\"2025-03-22\"],\"reason_of_revision\":[null,null]}', '[null,null]', '{\"section_titles\":[null,null],\"subtitle_titles\":[],\"subtitle_contents\":[],\"subtitle_images\":[]}', '2025-03-22 04:26:31', '2025-03-22 08:51:26', '2025-03-22 08:51:26'),
(12, NULL, NULL, NULL, '{\"created_by\":[null],\"created_by_date\":[\"2025-03-22\"],\"reviewed_by\":[null],\"reviewed_by_date\":[\"2025-03-22\"],\"approved_by\":[null],\"approved_by_date\":[\"2025-03-22\"],\"reason_of_revision\":[null]}', '[]', '{\"section_titles\":[],\"subtitle_titles\":[],\"subtitle_contents\":[],\"subtitle_images\":[]}', '2025-03-22 04:26:36', '2025-03-22 08:51:28', '2025-03-22 08:51:28'),
(13, 'Need to Fetch ALl Points and Columns', 'Its a testing Doc and and this field is used a doc suntitle', 'doc-001-002-0054552', '{\"created_by\":[\"me\",\"me1\",\"me2\"],\"created_by_date\":[\"2025-03-13\",\"2025-03-05\",\"2025-03-13\"],\"reviewed_by\":[\"you\",\"you1\",\"you2\"],\"reviewed_by_date\":[\"2025-03-13\",\"2025-03-13\",\"2025-03-13\"],\"approved_by\":[\"he\",\"he1\",\"he2\"],\"approved_by_date\":[\"2025-03-13\",\"2025-03-13\",\"2025-03-13\"],\"reason_of_revision\":[\"she\",\"she1\",\"she2\"]}', '[\"AAAAAAAAAA\",\"BBBBBBBBBB\",\"CCCCCCCCCC\",\"DDDDDDDDD\"]', '{\"section_titles\":[\"AAAAAAAAAA title\",\"BBBBBBBBBB Title\",\"CCCCCCCCCC Title\",\"DDDDDDDDD Title\"],\"subtitle_titles\":{\"1\":[\"AAAAAAAAAA Subtitle\",\"AAAAAAAAAA1 Subtitle\"],\"2\":[\"BBBBBBBBBB Subtitle\"],\"3\":[\"CCCCCCCCCC Subtitle\",\"CCCCCCCCCC1 Subtitle\"],\"4\":[\"DDDDDDDDD Subtitle\"]},\"subtitle_contents\":{\"1\":[\"AAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA ContentAAAAAAAAAA Content\",\"AAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntectAAAAAAAAAA1 COntect\"],\"2\":[\"BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect BBBBBBBBBB Contect\"],\"3\":[\"CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content CCCCCCCCCC Content\",\"CCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 ContentCCCCCCCCCC1 Content\"],\"4\":[\"DDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD ContentDDDDDDDDD Content\"]},\"subtitle_images\":{\"1\":[\"AAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA ImageAAAAAAAAAA Image\",\"AAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 ImageAAAAAAAAAA1 Image\"],\"2\":[\"BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image BBBBBBBBBB Image\"],\"3\":[\"CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image CCCCCCCCCC Image\",\"CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image CCCCCCCCCC1 Image\"],\"4\":[\"DDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD ImageDDDDDDDDD Image\"]}}', '2025-03-22 08:51:34', '2025-03-22 08:51:34', NULL),
(14, NULL, NULL, NULL, '{\"created_by\":[null],\"created_by_date\":[\"2025-03-23\"],\"reviewed_by\":[null],\"reviewed_by_date\":[\"2025-03-23\"],\"approved_by\":[null],\"approved_by_date\":[\"2025-03-23\"],\"reason_of_revision\":[null]}', '[]', '{\"section_titles\":[],\"subtitle_titles\":{\"1\":[null]},\"subtitle_contents\":{\"1\":[null]},\"subtitle_images\":[]}', '2025-03-23 02:13:26', '2025-03-24 22:46:51', '2025-03-24 22:46:51'),
(15, NULL, NULL, NULL, '{\"created_by\":[null],\"created_by_date\":[\"2025-03-24\"],\"reviewed_by\":[null],\"reviewed_by_date\":[\"2025-03-24\"],\"approved_by\":[null],\"approved_by_date\":[\"2025-03-24\"],\"reason_of_revision\":[null]}', '[null]', '{\"section_titles\":[null],\"subtitle_titles\":{\"1\":[null]},\"subtitle_contents\":{\"1\":[null]},\"subtitle_images\":{\"1\":[null]}}', '2025-03-23 20:36:27', '2025-03-24 22:46:54', '2025-03-24 22:46:54'),
(16, NULL, NULL, NULL, '{\"created_by\":[null],\"created_by_date\":[\"2025-03-24\"],\"reviewed_by\":[null],\"reviewed_by_date\":[\"2025-03-24\"],\"approved_by\":[null],\"approved_by_date\":[\"2025-03-24\"],\"reason_of_revision\":[null]}', '[null]', '{\"section_titles\":[null],\"subtitle_titles\":{\"1\":[null]},\"subtitle_contents\":{\"1\":[null]},\"subtitle_images\":{\"1\":[\"IMG-20240928-WA0002.jpg\"]}}', '2025-03-23 20:37:14', '2025-03-24 22:46:56', '2025-03-24 22:46:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
