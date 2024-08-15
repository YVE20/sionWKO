-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2024 at 10:14 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sionwko`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_alkitab`
--

CREATE TABLE `tb_alkitab` (
  `bible_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `bibleCategory_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `book` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paragraph` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chapter` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bulletin_cover`
--

CREATE TABLE `tb_bulletin_cover` (
  `cover_id` varchar(100) NOT NULL,
  `cover` varchar(200) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `theme` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bulletin_cover`
--

INSERT INTO `tb_bulletin_cover` (`cover_id`, `cover`, `month`, `theme`, `created_at`, `updated_at`) VALUES
('COVER/02/2023/4', 'COVER/4.06.2023..jpg', '06', 'Mensyukuri Nikmat Kehidupan', '2023-02-06 13:18:03', '2023-06-01 21:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_baptis`
--

CREATE TABLE `tb_data_baptis` (
  `baptism_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `familyCard_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `place_ofBirth` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_ofBirth` datetime DEFAULT NULL,
  `date_ofBaptism` datetime DEFAULT NULL,
  `religion` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `church` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `father_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mother_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pastor` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_data_baptis`
--

INSERT INTO `tb_data_baptis` (`baptism_id`, `familyCard_id`, `full_name`, `gender`, `place_ofBirth`, `date_ofBirth`, `date_ofBaptism`, `religion`, `church`, `father_name`, `mother_name`, `address`, `pastor`, `photo`, `created_at`, `updated_at`) VALUES
('BPTS/09/2022/1', '000000101010101', 'Yearico Vio Euaggelion', 'male', 'Pontianak', '2000-12-28 00:00:00', '2012-12-13 00:00:00', 'Christian', 'SION WKO', 'Iskandar Bong', 'Nelly Chen', 'Pontianak', 'Pdt. Niko', '', '2022-09-09 12:09:02', '2023-02-06 14:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_jemaat`
--

CREATE TABLE `tb_data_jemaat` (
  `congregation_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `baptism_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sidi_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `familyCard_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_environtment` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_data_jemaat`
--

INSERT INTO `tb_data_jemaat` (`congregation_id`, `baptism_id`, `sidi_id`, `familyCard_id`, `service_environtment`, `created_at`, `updated_at`) VALUES
('DAJA/1', '-', '-', '-', '1', '2022-12-06 13:41:36', '2022-12-06 13:41:36'),
('DAJA/2', '-', '-', '-', '2', '2022-12-06 13:41:46', '2022-12-06 13:41:46'),
('DAJA/3', '-', '-', '-', '3', '2022-12-06 13:41:56', '2022-12-06 13:41:56'),
('DAJA/4', 'BPTS/09/2022/1', '-', '-', '4', '2022-12-06 13:42:14', '2022-12-19 12:55:13'),
('DAJA/5', 'BPTS/09/2022/1', 'SIDI/09/2022/1', '-', '5', '2022-12-06 13:42:22', '2022-12-06 13:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_sidi`
--

CREATE TABLE `tb_data_sidi` (
  `sidi_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `familyCard_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `place_ofBirth` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_ofBirth` datetime DEFAULT NULL,
  `NIK` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `baptism_file` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_ofBaptism` datetime DEFAULT NULL,
  `church` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `father_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mother_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `marriage_certificate` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_ofSIDI` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_data_sidi`
--

INSERT INTO `tb_data_sidi` (`sidi_id`, `familyCard_id`, `full_name`, `gender`, `place_ofBirth`, `date_ofBirth`, `NIK`, `baptism_file`, `date_ofBaptism`, `church`, `father_name`, `mother_name`, `address`, `marriage_certificate`, `photo`, `phone_number`, `date_ofSIDI`, `created_at`, `updated_at`) VALUES
('SIDI/09/2022/1', '', 'Yearico Vio Euaggelion', 'male', 'Pontianak', '2000-12-28 00:00:00', '6171022812000005', 'Baptis/1.09.2022..png', '2012-12-13 00:00:00', 'GBI Rayon 11 Pekanbaru', 'Iskandar Bong', 'Nelly Chen', 'Pontianak', 'Pernikahan/1.09.2022..png', 'Photo/1.09.2022..png', '081347748346', '2005-01-01 00:00:00', '2022-09-09 13:34:36', '2022-09-09 17:05:14'),
('SIDI/09/2022/2', '', 'kjh', 'female', 'kjhkj', '2022-12-30 00:00:00', 'khj', '', '2022-12-31 00:00:00', 'lkjlkj', 'lkjlk;', 'jlkj;lk', 'lkj;lkjl', 'Pernikahan/2.10.2022..jpg', '', 'kj;lj', '2022-12-30 00:00:00', '2022-09-17 09:07:40', '2022-10-10 12:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dtl_kartu_keluarga`
--

CREATE TABLE `tb_dtl_kartu_keluarga` (
  `number` int NOT NULL,
  `familyCard_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fullName` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NIK` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varbinary(30) DEFAULT NULL,
  `place_ofBirth` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_ofBirth` datetime DEFAULT NULL,
  `religion` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `education` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `job` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `blood` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `marriage` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_ofMarriage` datetime DEFAULT NULL,
  `family_status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `citizenship` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paspor` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fatherName` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `motherName` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_dtl_kartu_keluarga`
--

INSERT INTO `tb_dtl_kartu_keluarga` (`number`, `familyCard_id`, `fullName`, `NIK`, `gender`, `place_ofBirth`, `date_ofBirth`, `religion`, `education`, `job`, `blood`, `marriage`, `date_ofMarriage`, `family_status`, `citizenship`, `paspor`, `fatherName`, `motherName`, `created_at`, `updated_at`) VALUES
(13, '-', 'delvis kuera', '-', 0x6d616c65, 'wosia', '2022-11-02 00:00:00', 'CHRISTIAN', 'SLTA / Sederajat', 'petani', 'O', 'Kawin Tercatat', '2022-11-01 00:00:00', 'Suami', 'WNI', '-', 'dio', 'dina', '2022-11-01 15:04:21', '2022-11-01 15:07:45'),
(14, '000000101010101', 'Yearico Vio Euaggelion', '6171022812000005', 0x6d616c65, 'Pontianak', '2000-12-28 00:00:00', 'CHRISTIAN', 'Diploma IV / Strata I', 'Swasta', 'O', 'Belum Kawin', NULL, 'Anak', 'WNI', NULL, 'Iskandar', 'Nelly', '2023-06-01 21:40:49', '2023-06-01 21:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `event_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `eventCategory_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `speaker` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `place` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `theme` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_person` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time` time NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ibadah`
--

CREATE TABLE `tb_ibadah` (
  `worship_id` int NOT NULL,
  `category_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `speaker` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_title` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_content` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `place` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time NOT NULL,
  `speaker_contact` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `worship` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `service_environtment` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ibadah`
--

INSERT INTO `tb_ibadah` (`worship_id`, `category_id`, `speaker`, `sermon_title`, `sermon_content`, `place`, `sermon_date`, `time`, `speaker_contact`, `worship`, `service_environtment`, `created_at`, `updated_at`) VALUES
(1, 'IBD/IBLP/2022', 'Pnt. Hudson Ballamu', '-', '<p>-</p>', 'Kel. Paleba – Moot', '2023-02-05 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '1', '2022-10-03 17:33:40', '2023-02-04 11:55:20'),
(2, 'IBD/IBLP/2022', 'Ibu. Frelly Tomasoa', '-', '<p>-</p>', 'Ibu. Yaneke Lantaka Kel. Sangkop – Nata', '2023-02-12 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '1', '2022-10-03 17:34:18', '2023-02-04 11:54:58'),
(3, 'IBD/IBLP/2022', 'Dkn. Altje Surupati', '-', '<p>-</p>', 'Pnt. M. Bokako Kel. Bokako – Levara', '2023-02-19 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '1', '2022-10-03 17:34:55', '2023-02-04 11:54:34'),
(4, 'IBD/IBLP/2022', 'Pnt. Arianto Serang', '-', '<p>-</p>', 'Kel. Sasombo – Roring', '2023-02-26 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '1', '2022-10-03 17:35:24', '2023-02-04 11:54:03'),
(5, 'IBD/IBLP/2022', 'Pnt. Ferdinan Denny', '-', '<p>-</p>', 'Kel. Aneke – Moot', '2023-02-05 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '2', '2022-10-03 17:39:03', '2023-02-04 11:58:25'),
(6, 'IBD/IBLP/2022', 'Pdt. Roky Lahura', '-', '<p>-</p>', 'Kel. Mamahe – Undap', '2023-02-12 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '2', '2022-10-03 17:39:45', '2023-02-04 11:56:56'),
(7, 'IBD/IBLP/2022', 'Pnt. Nofian Surupati', '-', '<p>-</p>', 'Kel. Mangimbulude-Boediman', '2023-02-19 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '2', '2022-10-03 17:40:16', '2023-02-04 11:56:33'),
(8, 'IBD/IBLP/2022', 'Pdt. Lanny Lumansik', '-', '<p>-</p>', 'Kel. Lahura – Kainama', '2023-02-26 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '2', '2022-10-03 17:40:42', '2023-02-04 11:56:15'),
(9, 'IBD/IBLP/2022', 'Dkn. Fani Boleu', '-', '<p>-</p>', 'Sdri. Yuni Ewy', '2023-02-05 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '3', '2022-10-03 17:41:32', '2023-02-04 12:01:35'),
(10, 'IBD/IBLP/2022', 'Sdri. Alsi Mamaghe', '-', '-', 'Kel. Tupan – Lumansik', '2023-02-12 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '3', '2022-10-03 17:42:29', '2023-02-04 12:01:09'),
(11, 'IBD/IBLP/2022', 'Pnt. Ireine Boediman', '-', '<p>-</p>', 'Ibu. Alwina Kansil', '2023-02-19 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '3', '2022-10-03 17:43:09', '2023-02-04 12:00:14'),
(12, 'IBD/IBLP/2022', 'Pnt. R. Lawongo', '-', '<p>-</p>', 'Kel. Paputungan – Popoko', '2023-02-26 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '3', '2022-10-03 17:43:41', '2023-02-04 11:59:47'),
(13, 'IBD/IBLP/2022', 'Pnt. A. Rembet', '-', '<p>-</p>', 'Kel. Bawues-Makangiras', '2023-02-05 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '4', '2022-10-07 07:18:23', '2023-02-04 12:03:31'),
(14, 'IBD/IBLP/2022', 'Bpk. Weldy Salindeho', '-', '<p>-</p>', 'Kel. Balaira-Rembet', '2023-02-12 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '4', '2022-10-07 07:19:02', '2023-02-04 12:03:08'),
(15, 'IBD/IBLP/2022', 'Dkn. Eldora Mia', '-', '<p>-</p>', 'Kel. Surupati Boham', '2023-02-19 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '4', '2022-10-07 07:20:08', '2023-02-04 12:02:50'),
(16, 'IBD/IBLP/2022', 'Pnt. R. Bawues', '-', '<p>-</p>', 'Bpk. Onesimus Salor', '2023-02-26 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '4', '2022-10-07 07:20:53', '2023-02-04 12:02:31'),
(17, 'IBD/IBLP/2022', 'Dkn. Sry Manuho', '-', '<p>-</p>', 'Kel. Pulasari – Mantol', '2023-02-05 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '5', '2022-10-07 07:21:27', '2023-02-04 12:06:54'),
(18, 'IBD/IBLP/2022', 'Ibu. Oktovina Wote', '-', '<p>-</p>', 'Ibu. Orpa Lantaka', '2023-02-12 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '5', '2022-10-07 07:22:02', '2023-02-04 12:06:32'),
(19, 'IBD/IBLP/2022', 'Pnt. Deki Rahamani', '-', '<p>-</p>', 'Kel. Laarni-Mahundingan', '2023-02-19 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '5', '2022-10-07 07:22:29', '2023-02-04 12:06:07'),
(20, 'IBD/IBLP/2022', 'Pnt. F. Niomba', '-', '<p>-</p>', 'Kel. Sasingan - Teby', '2023-02-26 00:00:00', '17:00:00', '-', 'Ibadah Lingkungan Pelayanan', '5', '2022-10-07 07:22:58', '2023-02-04 12:05:45'),
(29, 'IBD/IBKB/2022', 'Bpk. Novit Wea', '-', '<p>-</p>', 'Bpk. Alfret Mamaghe', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '3', '2022-10-08 09:50:27', '2023-02-04 12:29:06'),
(30, 'IBD/IBKB/2022', 'Pnt. R. Lawongo', '-', '<p>-</p>', 'Bpk. Yober Mamahe', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '3', '2022-10-08 09:51:07', '2023-02-04 12:28:47'),
(31, 'IBD/IBKB/2022', 'Pdt.Roki Lahura', '-', '-', 'Gedung Serba Guna (Gabungan)', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '3', '2022-10-08 09:53:00', '2023-02-04 12:27:49'),
(32, 'IBD/IBKB/2022', 'Bpk. Jakson Tuisan', '-', '<p>-</p>', 'Bpk. Pieter Moot', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '3', '2022-10-08 09:53:35', '2023-02-04 12:24:30'),
(33, 'IBD/IBKB/2022', 'Bpk. Fretsgon Bawues', '-', '<p>-</p>', 'Bpk. A. Larangahen', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '4', '2022-10-08 09:54:27', '2023-02-04 12:30:58'),
(34, 'IBD/IBKB/2022', 'Bpk. M. Tomasoa', '-', '<p>-</p>', 'Bpk. B. Matahari', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '4', '2022-10-08 09:55:07', '2023-02-04 12:30:39'),
(35, 'IBD/IBKB/2022', 'Pdt.Roki Lahura', '-', '<p>-</p>', 'Gedung Serba Guna (Gabungan)', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '4', '2022-10-08 09:55:34', '2023-02-04 12:29:54'),
(36, 'IBD/IBKB/2022', 'Bpk. B. Waas', '-', '<p>-</p>', 'Bpk. Zakarias Salindeho & Bpk. Weldy Salindeho', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '4', '2022-10-08 09:56:12', '2023-02-04 12:30:19'),
(37, 'IBD/IBKB/2022', 'Pnt. Yosias Sbea', '-', '<p>-</p>', 'Bpk. Efrat Rau', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '5', '2022-10-08 09:56:43', '2023-02-04 12:33:35'),
(38, 'IBD/IBKB/2022', 'Bpk. M. Sasingan', '-', '<p>-</p>', 'Bpk. Viktor Boroni', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '5', '2022-10-08 09:57:13', '2023-02-04 12:33:14'),
(39, 'IBD/IBKB/2022', 'Pdt.Roki Lahura', '-', '<p>-</p>', 'Gedung Serba Guna (Gabungan)', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '5', '2022-10-08 09:58:01', '2023-02-04 12:32:24'),
(40, 'IBD/IBKB/2022', 'Dkn. M. Majuntu', '-', '<p>-</p>', 'Bpk. Hektor Teby', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '5', '2022-10-08 09:58:31', '2023-02-04 12:32:44'),
(41, 'IBD/IBKI/2022', 'Lp 1', '-', '<p>-</p>', 'Gedung Gereja', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '1', '2022-10-08 09:59:07', '2023-02-04 12:41:35'),
(42, 'IBD/IBKI/2022', 'Ibu. Marleni Wilena', '-', '-', 'Ibu. Hanny Mamahe', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '1', '2022-10-08 09:59:32', '2023-02-04 12:41:15'),
(43, 'IBD/IBKI/2022', 'Ibu. Vanny Kotabadjo', '-', '<p>-</p>', 'Ibu. Marlina Kapisi', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '1', '2022-10-08 10:00:04', '2023-02-04 12:40:43'),
(44, 'IBD/IBKI/2022', 'Dkn. Eldora Mia', '-', '<p>-</p>', 'Ibu. Dince Lahengko', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '1', '2022-10-08 10:00:33', '2023-02-04 12:40:14'),
(45, 'IBD/IBKI/2022', 'Lp 1', '-', '<p>-</p>', 'Gedung Gereja', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '2', '2022-10-08 10:00:53', '2023-02-04 12:44:27'),
(46, 'IBD/IBKI/2022', 'Ibu. Yuan Rano', '-', '<p>-</p>', 'Ibu. Arnice Ume', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '2', '2022-10-08 10:01:30', '2023-02-04 12:44:04'),
(47, 'IBD/IBKI/2022', 'Pdt. Roky Lahura', '-', '<p>-</p>', 'Ibu. M. Manikome & Ibu. Vivi Leaua', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '2', '2022-10-08 10:02:04', '2023-02-04 12:43:22'),
(48, 'IBD/IBKI/2022', 'Pnt. A. Rembet', '-', '<p>-</p>', 'Pnt. Fanny E. Niomba & Ibu. A. Niomba', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '2', '2022-10-08 10:02:35', '2023-02-04 12:42:58'),
(49, 'IBD/IBKI/2022', 'Lp 1', '-', '<p>-</p>', 'Gedung Gereja', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '3', '2022-10-08 10:10:03', '2023-02-04 12:46:58'),
(50, 'IBD/IBKI/2022', 'Ibu. Veny Balaira', '-', '<p>-</p>', 'Ibu. Tria Kokomomok', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '3', '2022-10-08 10:10:37', '2023-02-04 12:46:39'),
(51, 'IBD/IBKI/2022', 'Dkn. Fani Boleu', '-', '<p>-</p>', 'Ibu. Inggrid Mamahe', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '3', '2022-10-08 10:11:03', '2023-02-04 12:46:18'),
(52, 'IBD/IBKI/2022', 'Ibu. J Kembuan', '-', '<p>-</p>', 'Ibu. Naomi Nyenye', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '3', '2022-10-08 10:11:29', '2023-02-04 12:45:41'),
(53, 'IBD/IBKI/2022', 'Lp 1', '-', '<p>-</p>', 'Gedung Gereja', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '4', '2022-10-08 10:11:49', '2023-02-04 12:48:47'),
(54, 'IBD/IBKI/2022', 'Ibu. Winda Patras', '-', '-', 'Ibu. Sil Tunang', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '4', '2022-10-08 10:12:17', '2023-02-04 12:48:18'),
(55, 'IBD/IBKI/2022', 'Ibu. Sil Tunjang', '-', '<p>-</p>', 'Ibu. Titin Bohang', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '4', '2022-10-08 10:12:48', '2023-02-04 12:47:41'),
(56, 'IBD/IBKI/2022', 'Pnt. M. Bokako', '-', '<p>-</p>', 'Ibu. Matelda Kansil', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '4', '2022-10-08 10:13:14', '2023-02-04 12:47:22'),
(57, 'IBD/IBKI/2022', 'Lp 1', '-', '<p>-</p>', 'Gedung Gereja', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '5', '2022-10-08 10:13:46', '2023-02-04 12:50:54'),
(58, 'IBD/IBKI/2022', 'Ibu. Meldy Tebi', '-', '<p>-</p>', 'Ibu. Jeisha Boediman', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '5', '2022-10-08 10:14:12', '2023-02-04 12:50:29'),
(59, 'IBD/IBKI/2022', 'IBu. Marleny barani', '-', '<p>-</p>', 'Ibu. Yessi Tumewu', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '5', '2022-10-08 10:14:46', '2023-02-04 12:50:03'),
(60, 'IBD/IBKI/2022', 'Dkn. A Surupati', '-', '<p>-</p>', 'Ibu. Saris Laami', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Ibu', '5', '2022-10-08 10:15:07', '2023-02-04 12:49:33'),
(61, 'IBD/IBP/2022', 'Pnt. Deky Rahamani-', '-', '<p>-</p>', 'Farel & Neslly Umur', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Pemuda', '-', '2022-10-08 10:18:31', '2023-02-04 11:51:31'),
(62, 'IBD/IBP/2022', 'Sdri. Marini Sambali', '-', '<p>-</p>', 'Sdr. Alex Tamosoa', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Pemuda', '-', '2022-10-08 10:19:09', '2023-02-04 11:51:07'),
(63, 'IBD/IBP/2022', 'Pnt. Nofian Surupati', '-', '<p>-</p>', 'Pnt. Deky & Glen Rahamani', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Pemuda', '-', '2022-10-08 10:19:45', '2023-02-04 11:50:49'),
(64, 'IBD/IBP/2022', 'Sdr. Glen Rahamani', '-', '<p>-</p>', 'Dkn. Hendrik Tunang', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Pemuda', '-', '2022-10-08 10:20:12', '2023-02-04 11:50:27'),
(65, 'IBD/IBR/2022', 'K\' Susella Mamahe', '-', '<p>-</p>', 'Jesen & Agnes Roring', '2023-02-05 00:00:00', '12:30:00', '-', 'Ibadah Remaja', '-', '2022-10-08 10:20:58', '2023-02-04 11:45:33'),
(66, 'IBD/IBR/2022', 'Pnt. Iren Boediman', '-', '<p>-</p>', 'Juan Patty', '2023-02-12 00:00:00', '12:30:00', '-', 'Ibadah Remaja', '-', '2022-10-08 10:21:30', '2023-02-04 11:46:25'),
(67, 'IBD/IBR/2022', 'K\' Weldy Salindeho', '-', '<p>-</p>', 'Ari Titansion Aneke', '2023-02-19 00:00:00', '12:30:00', '-', 'Ibadah Remaja', '-', '2022-10-08 10:21:58', '2023-02-04 11:46:45'),
(68, 'IBD/IBR/2022', 'K\'Thimotius Sambali', '-', '<p>-</p>', 'Prita L. Paputungan', '2023-02-26 00:00:00', '12:30:00', '-', 'Ibadah Remaja', '-', '2022-10-08 10:22:28', '2023-02-04 11:45:49'),
(69, 'IBD/IBMG/2022', 'K\'Henny Mamahe', '-', '<p>-</p>', 'Adk. Farnes Umur', '2023-02-05 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '1', '2022-10-08 10:23:29', '2023-02-06 12:31:02'),
(70, 'IBD/IBMG/2022', 'K\'Marleni Wilena', '-', '<p>-</p>', 'Adk. Asrivhia & Afri Injiln', '2023-02-12 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '1', '2022-10-08 10:24:03', '2023-02-06 12:30:37'),
(71, 'IBD/IBMG/2022', 'K\'Ryane Makaenas', '-', '<p>-</p>', 'Adk. Meyan & Heini Moot', '2023-02-19 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '1', '2022-10-08 10:24:36', '2023-02-06 12:30:11'),
(73, 'IBD/IBMG/2022', 'K\'Morris Gam', '-', '<p>-</p>', 'K\'Vivi Leaua', '2023-02-05 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '2', '2022-10-08 10:25:22', '2023-02-06 12:50:20'),
(74, 'IBD/IBMG/2022', 'K\'Ireine Boediman', '-', '<p>-</p>', 'Adk. Kanza Aneke', '2023-02-12 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '2', '2022-10-08 10:25:52', '2023-02-06 12:49:42'),
(75, 'IBD/IBMG/2022', 'K\'Vivi Leaua', '-', '<p>-</p>', 'Adk. Ute & Ica Mamahe', '2023-02-19 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '2', '2022-10-08 10:26:30', '2023-02-06 12:49:22'),
(77, 'IBD/IBMG/2022', 'K\'Elisabeth Laarni', '-', '<p>-</p>', 'Adk. Helwen Mamahe', '2023-02-05 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '3', '2022-10-08 10:27:37', '2023-02-04 12:57:10'),
(78, 'IBD/IBMG/2022', 'K\'Alsi Mamahe', '-', '<p>-</p>', 'Adk. Willi & Paskalia Moot', '2023-02-12 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '3', '2022-10-08 10:28:13', '2023-02-04 12:56:33'),
(79, 'IBD/IBMG/2022', 'K\'Elsa Mamahe', '-', '<p>-</p>', 'Adk. Marsel Belian Ali', '2023-02-19 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '3', '2022-10-08 10:28:52', '2023-02-04 12:56:04'),
(80, 'IBD/IBMG/2022', 'K\'Marlin Bokako', '-', '<p>-</p>', 'Adk. Sella & Ardani Wea', '2023-02-26 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '3', '2022-10-08 10:37:21', '2023-02-04 12:55:37'),
(81, 'IBD/IBMG/2022', 'K\'Dinda Balaira', '-', '<p>-</p>', 'Adk. Kenzo & Timothy', '2023-02-05 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '4', '2022-10-08 10:38:00', '2023-02-04 13:00:29'),
(82, 'IBD/IBMG/2022', 'K\'Mauren Tamosoa', '-', '<p>-</p>', 'Adk. Feifel Balaira', '2023-02-12 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '4', '2022-10-08 10:39:08', '2023-02-04 12:59:41'),
(83, 'IBD/IBMG/2022', 'K\'Dinda Balaira', '-', '<p>-</p>', 'Adk. Kesya Bawues', '2023-02-19 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '4', '2022-10-08 10:39:56', '2023-02-04 12:58:50'),
(84, 'IBD/IBMG/2022', 'Pnt. M. Bokako', '-', '<p>-</p>', 'Adk. Cantika Saliendeho', '2023-02-26 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '4', '2022-10-08 10:40:21', '2023-02-04 12:58:09'),
(85, 'IBD/IBMG/2022', 'K\'Meldi Tebi', '-', '<p>-</p>', 'Adk. Aldo & Edo', '2023-02-05 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '5', '2022-10-08 10:41:04', '2023-02-06 13:00:54'),
(86, 'IBD/IBMG/2022', 'K\'Jesya Boediman', '-', '<p>-</p>', 'Adk. Yadin Aarni', '2023-02-12 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '5', '2022-10-08 10:41:31', '2023-02-06 13:00:28'),
(87, 'IBD/IBMG/2022', 'K\'Marleny Barani', '-', '<p>-</p>', 'Adk. Radit & Nuela Sasingan', '2023-02-19 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '5', '2022-10-08 10:42:15', '2023-02-06 12:59:58'),
(88, 'IBD/IBKB/2022', 'Pnt. R. Bawues', '-', '<p>-</p>', 'Bpk. Mariyones Maradika', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '1', '2023-02-04 12:17:17', '2023-02-04 12:23:36'),
(89, 'IBD/IBKB/2022', 'Bpk. Yuder Nayoan', '-', '<p>-</p>', 'Bpk. Ramli Limoro', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '1', '2023-02-04 12:19:46', '2023-02-04 12:26:03'),
(90, 'IBD/IBKB/2022', 'Pdt.Roki Lahura', '-', '<p>-</p>', 'Gedung Serba Guna (Gabungan)', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '1', '2023-02-04 12:21:45', '2023-02-04 12:25:47'),
(91, 'IBD/IBKB/2022', 'Bpk. Weldy Salindeho', '-', '<p>-</p>', 'Bpk. Hudson Balamu', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '1', '2023-02-04 12:23:12', '2023-02-04 12:23:12'),
(92, 'IBD/IBKB/2022', 'Bpk. Budi Kawung', '-', '<p>-</p>', 'Bpk. Andre Batita', '2023-02-05 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '2', '2023-02-04 12:34:46', '2023-02-04 12:34:46'),
(93, 'IBD/IBKB/2022', 'Bpk. Tony Patty', '-', '<p>-</p>', 'Bpk. Patras Ewy', '2023-02-12 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '2', '2023-02-04 12:35:42', '2023-02-04 12:35:42'),
(94, 'IBD/IBKB/2022', 'Pdt.Roki Lahura', '-', '<p>-</p>', 'Gedung Serba Guna (Gabungan)', '2023-02-19 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '2', '2023-02-04 12:36:27', '2023-02-04 12:36:27'),
(95, 'IBD/IBKB/2022', 'Bpk. Novit Wea', '-', '<p>-</p>', 'Bpk. Agustinus Aneke', '2023-02-26 00:00:00', '11:00:00', '-', 'Ibadah Kaum Bapak', '2', '2023-02-04 12:37:42', '2023-02-04 12:37:42'),
(96, 'IBD/IBLL/2022', 'Dkn Majuntu', '-', '<p>-</p>', 'Pnt. Roni Bawues', '2023-02-09 00:00:00', '19:30:00', '-', 'Ibadah Keluarga Pelayan', '-', '2023-02-04 13:03:35', '2023-02-06 13:36:24'),
(97, 'IBD/IBMG/2022', 'K\'Susela Mamahe', '-', '<p>-</p>', 'Adk. Nyobet Gulati', '2023-02-26 00:00:00', '07:00:00', '-', 'Ibadah Minggu Gembira', '1', '2023-02-06 12:25:26', '2023-02-06 12:29:49'),
(98, 'IBD/IBMG/2022', 'K\' Irna Manzanaris', '-', '<p>-</p>', 'Adk. Clif Lantaka', '2023-02-26 00:00:00', '19:00:00', '-', 'Ibadah Minggu Gembira', '2', '2023-02-06 12:44:52', '2023-02-07 10:17:55'),
(99, 'IBD/IBMG/2022', 'K\' Meldy Tebi', '-', '<p>-</p>', 'Adk. Made, Esar & Elan', '2023-02-26 00:00:00', '07:00:00', '-', 'Ibadah Minggu Gembira', '5', '2023-02-06 12:57:42', '2023-02-06 12:59:22'),
(100, 'IBD/IBASM/2022', 'Pengasuh Sekolah Minggu', '-', '<p>-</p>', 'Gedung Serba Guna', '2023-02-05 00:00:00', '07:00:00', '-', 'Ibadah Anak Sekolah Minggu', '-', '2023-02-06 13:10:40', '2023-02-06 13:16:09'),
(101, 'IBD/IBASM/2022', 'Pengasuh Sekolah Minggu', '-', '-', 'Gedung Serba Guna', '2023-02-19 00:00:00', '07:00:00', '-', 'Ibadah Anak Sekolah Minggu', '-', '2023-02-06 13:12:20', '2023-02-06 13:12:20'),
(102, 'IBD/IBASM/2022', 'Pengasuh Sekolah Minggu', '-', '<p>-</p>', 'Gedung Serba Guna', '2023-02-12 00:00:00', '07:00:00', '-', 'Ibadah Anak Sekolah Minggu', '-', '2023-02-06 13:14:18', '2023-02-06 13:14:18'),
(103, 'IBD/IBASM/2022', 'Pengasuh Sekolah Minggu', '-', '<p>-</p>', 'Gedung Serba Guna', '2023-02-26 00:00:00', '07:00:00', '-', 'Ibadah Anak Sekolah Minggu', '-', '2023-02-06 13:15:21', '2023-02-06 13:15:54'),
(104, 'IBD/IBLL/2022', 'Dkn. Lusy Mohibu', '-', '<p>-</p>', 'Pnt. Roni Bawues', '2023-02-23 00:00:00', '07:00:00', '-', 'Ibadah Keluarga Pelayan', '-', '2023-02-06 13:35:07', '2023-02-06 13:36:40'),
(105, 'IBD/IBM/2022', 'Pdt. Lanny Tupan Lumansik, S.Th', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-05 00:00:00', '07:00:00', '-', 'Ibadah Minggu', '-', '2023-02-06 13:51:12', '2023-02-07 07:36:21'),
(106, 'IBD/IBM/2022', 'Pdt. Roki Lahura, S.Th', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-12 00:00:00', '07:00:00', '-', 'Ibadah Minggu', '-', '2023-02-06 13:59:47', '2023-02-07 07:36:03'),
(107, 'IBD/IBM/2022', 'Pdt. Lanny Tupan Lumansik, S.Th', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-19 00:00:00', '07:00:00', '-', 'Ibadah Minggu', '-', '2023-02-06 14:01:28', '2023-02-07 07:35:45'),
(108, 'IBD/IBM/2022', 'Pdt. Roki Lahura, S.Th', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-26 00:00:00', '07:00:00', '-', 'Ibadah Minggu', '-', '2023-02-07 07:34:40', '2023-02-07 07:37:26'),
(109, 'IBD/IBLL/2022', 'ka iren', '-', '<p>-</p>', 'gedung serba guna', '2023-02-07 00:00:00', '00:00:00', '-', 'Ibadah Pelajar', '-', '2023-02-07 07:42:12', '2023-02-07 07:42:12'),
(110, 'IBD/IBLL/2022', 'ka iren', '-', '<p>-</p>', 'gereja', '2023-02-22 00:00:00', '00:00:00', '-', 'Ibadah Usinda', '-', '2023-02-07 07:42:57', '2023-02-07 07:42:57'),
(111, 'IBD/IBLL/2022', 'Pdt.Roki Lahura', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-27 00:00:00', '00:00:00', '-', 'Ibadah Pergumulan MJ', '-', '2023-02-07 07:43:26', '2023-02-07 07:43:26'),
(112, 'IBD/IBM/2022', 'Pdt. Lanny Tupan Lumansik, S.Th', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-05 00:00:00', '09:30:00', '-', 'Ibadah Minggu', '-', '2023-02-07 07:52:31', '2023-02-07 07:56:43'),
(113, 'IBD/IBM/2022', 'Pdt. Roki Lahura, S.Th', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-12 00:00:00', '09:30:00', '-', 'Ibadah Minggu', '-', '2023-02-07 07:53:00', '2023-02-07 07:56:21'),
(114, 'IBD/IBM/2022', 'Pdt. Lanny Tupan Lumansik, S.Th', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-19 00:00:00', '09:30:00', '-', 'Ibadah Minggu', '-', '2023-02-07 07:53:47', '2023-02-07 07:55:50'),
(115, 'IBD/IBM/2022', 'Pdt. Roki Lahura, S.Th', '-', '<p>-</p>', 'Gedung Gereja Sion WKO', '2023-02-26 00:00:00', '09:30:00', '-', 'Ibadah Minggu', '-', '2023-02-07 07:54:21', '2023-02-07 07:55:27'),
(116, 'IBD/IBLL/2022', 'Pdt. Lanny Tupan Lumansik, S.Th', '-', '<p>-</p>', 'Bpk. Aprius Surupatu', '2023-02-03 00:00:00', '00:00:00', '-', 'Ibadah Usinda', '-', '2023-02-07 07:59:51', '2023-02-10 06:18:00'),
(117, 'IBD/IBASM/2022', 'pipit', '-', '<p>-</p>', 'gereja', '2023-03-26 00:00:00', '07:00:00', 'tiara', 'Ibadah Anak Sekolah Minggu', '-', '2023-03-24 05:13:55', '2023-03-24 05:14:42'),
(118, 'IBD/IBKB/2022', 'jlkjlk', '-', '<p>-</p>', 'dxfgbdfxgb', '2024-01-28 00:00:00', '22:53:00', 'jlkjl', 'Ibadah Kaum Bapak', '2', '2024-01-22 20:53:14', '2024-01-22 20:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kartu_keluarga`
--

CREATE TABLE `tb_kartu_keluarga` (
  `familyCard_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `family_headName` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `RTRW` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zipCode` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kartu_keluarga`
--

INSERT INTO `tb_kartu_keluarga` (`familyCard_id`, `family_headName`, `address`, `RTRW`, `zipCode`, `photo`, `created_at`, `updated_at`) VALUES
('-', 'DELVIS KUERA', 'jl. tugu nusantara, Desa WKO', '01/02', '95115', '', '2022-12-08 11:04:26', '2022-12-08 11:04:26'),
('000000101010101', 'Iskandar', 'Jln. Merak 10', '001/112', '53534', 'Photo/000000101010101.06.2023..jpg', '2023-06-01 21:42:39', '2023-06-01 21:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_alkitab`
--

CREATE TABLE `tb_kategori_alkitab` (
  `bibleCategory_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `bible` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isChanged` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_event`
--

CREATE TABLE `tb_kategori_event` (
  `eventCategory_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `event` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori_event`
--

INSERT INTO `tb_kategori_event` (`eventCategory_id`, `event`, `created_at`, `updated_at`) VALUES
('EVT/HRFG', 'Hari Reformasi Gereja', '2022-09-12 15:25:25', '2022-09-12 15:25:25'),
('EVT/HUT/GM', 'HUT Gerja Mula-mula', '2022-09-12 15:26:17', '2022-09-12 15:26:17'),
('EVT/HUT/GMIH', 'HUT GMIH', '2022-09-12 15:25:25', '2022-09-12 15:25:25'),
('EVT/HUT/GS', 'Hut Gereja Sion WKO', '2022-09-12 15:24:28', '2022-09-12 15:24:28'),
('EVT/HUT/RP', 'HUT Rumah Pastori Jemaat', '2022-09-12 15:24:28', '2022-09-12 15:24:28'),
('EVT/PRKDS', 'Perjamuan Kudus', '2022-09-12 15:25:58', '2022-09-12 15:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_ibadah`
--

CREATE TABLE `tb_kategori_ibadah` (
  `category_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori_ibadah`
--

INSERT INTO `tb_kategori_ibadah` (`category_id`, `category`, `created_at`, `updated_at`) VALUES
('IBD/IBASM/2022', 'Ibadah Anak Sekolah Minggu', '2022-08-27 22:56:53', '2022-08-27 22:56:53'),
('IBD/IBKB/2022', 'Ibadah Kaum Bapak', '2022-08-27 22:58:16', '2022-09-07 12:09:37'),
('IBD/IBKI/2022', 'Ibadah Kaum Ibu', '2022-08-27 22:58:16', '2022-08-27 22:58:16'),
('IBD/IBLL/2022', 'Ibadah Lain-lain', '2022-11-01 12:27:37', '2022-11-01 12:27:37'),
('IBD/IBLP/2022', 'Ibadah Lingkungan Pelayan', '2022-08-27 22:58:55', '2022-08-27 22:58:55'),
('IBD/IBM/2022', 'Ibadah Minggu', '2022-08-27 22:56:53', '2022-08-27 22:56:53'),
('IBD/IBMG/2022', 'Ibadah Minggu Gembira', '2022-08-27 22:58:55', '2022-08-27 22:58:55'),
('IBD/IBP/2022', 'Ibadah Pemuda', '2022-08-27 22:57:40', '2022-08-27 22:57:40'),
('IBD/IBR/2022', 'Ibadah Remaja', '2022-08-27 22:57:40', '2022-08-27 22:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_pelayanan`
--

CREATE TABLE `tb_kategori_pelayanan` (
  `serviceCategory_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `service` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori_pelayanan`
--

INSERT INTO `tb_kategori_pelayanan` (`serviceCategory_id`, `service`, `created_at`, `updated_at`) VALUES
('FA/2022', 'Penataan Bunga', '2022-09-27 00:27:49', '2022-09-27 00:27:52'),
('KHDM/2022', 'Khadim', '2022-09-27 00:27:22', '2022-09-27 00:27:24'),
('MIM/2022', 'Majelis Ibadah Minggu', '2022-09-27 00:26:59', '2022-09-27 00:27:01'),
('PJN/2022', 'Pujian', '2022-10-08 20:04:47', '2022-10-08 20:04:50'),
('PMSK/2022', 'Pemusik', '2022-09-27 00:28:22', '2022-09-27 00:28:25'),
('PNTM/2022', 'Penerima Tamu', '2022-10-08 20:05:27', '2022-10-08 20:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kesaksian`
--

CREATE TABLE `tb_kesaksian` (
  `testimony_id` varchar(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_khadim`
--

CREATE TABLE `tb_khadim` (
  `khadim_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serviceCategory_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `theme` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `khadim` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_khadim`
--

INSERT INTO `tb_khadim` (`khadim_id`, `serviceCategory_id`, `theme`, `khadim`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('KHDM/02/2023/1', '', 'Membangun Solidaritas Persaudaraan Kejadian 4:1-16', 'Pdt. Lanny Tupan Lumansik', '2023-02-05 00:00:00', '07:00:00', '2023-02-07 08:51:41', '2023-02-07 09:03:37'),
('KHDM/02/2023/2', '', 'Buah Pertobatan Kisah Para Rasul 4:1-15', 'Pdt. Roki Lahura, S.Th', '2023-02-12 00:00:00', '07:00:00', '2023-02-07 08:58:47', '2023-02-07 09:03:23'),
('KHDM/02/2023/3', '', 'Memanfaatkan Potensi Diri 2 Raja-Raja 4:1-7', 'Pdt. Lanny Tupan Lumansik', '2023-02-19 00:00:00', '07:00:00', '2023-02-07 09:00:47', '2023-02-07 09:02:30'),
('KHDM/02/2023/4', '', 'Menjalin Hidup Beriman yang Baru Roma 8:31-39', 'Pdt. Roki Lahura, S.Th', '2023-02-26 00:00:00', '07:00:00', '2023-02-07 09:02:07', '2023-02-07 09:55:43'),
('KHDM/02/2023/5', 'KHDM/2022', 'Menjalin Hidup Beriman yang Baru Roma 8:31-39', 'Pdt. Roki Lahura, S.Th', '2023-02-26 00:00:00', '09:30:00', '2023-02-07 09:55:10', '2023-02-07 09:55:10'),
('KHDM/02/2023/6', 'KHDM/2022', 'Memanfaatkan Potensi Diri 2 Raja-Raja 4:1-7', 'Pdt. Lanny Tupan Lumansik', '2023-02-19 00:00:00', '09:30:00', '2023-02-07 09:56:11', '2023-02-07 09:56:11'),
('KHDM/02/2023/7', 'KHDM/2022', 'Buah Pertobatan Kisah Para Rasul 4:1-15', 'Pdt. Roki Lahura, S.Th', '2023-02-12 00:00:00', '09:30:00', '2023-02-07 09:57:21', '2023-02-07 09:57:21'),
('KHDM/02/2023/8', 'KHDM/2022', 'Membangun Solidaritas Persaudaraan Kejadian 4:1-16', 'Pdt. Lanny Tupan Lumansik', '2023-02-05 00:00:00', '09:30:00', '2023-02-07 09:58:03', '2023-02-07 09:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_majelis_ibadah_minggu`
--

CREATE TABLE `tb_majelis_ibadah_minggu` (
  `assembly_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `serviceCategory_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `assembly` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `coordinator` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `khadim_companion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uniform` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_majelis_ibadah_minggu`
--

INSERT INTO `tb_majelis_ibadah_minggu` (`assembly_id`, `serviceCategory_id`, `assembly`, `coordinator`, `khadim_companion`, `uniform`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('SER/02/2023/10', 'MIM/2022', 'Kelompok 1', 'ddddd', 'hhh', 'Bebas Batik', '2023-06-26 00:00:00', '09:30:00', '2023-02-07 10:21:51', '2023-02-07 10:21:51'),
('SER/02/2023/8', '', 'Kelompok 1', 'Dkn. S. Manuho', 'Dkn. E. Mia', 'Bebas Batik', '2023-06-26 00:00:00', '07:00:00', '2023-02-07 08:43:19', '2023-02-07 09:58:44'),
('SER/02/2023/9', 'MIM/2022', 'Kelompok 1', 'ddddd', 'ttt', 'Bebas Batik', '2023-06-26 00:00:00', '07:00:00', '2023-02-07 10:21:17', '2023-02-07 10:21:17'),
('SER/09/2022/1', '', 'Kelompok 1', 'Dkn. M Majuntu', 'Pnt. M. Bokako', 'Lengan Panjang/Semi Jas.', '2023-06-05 00:00:00', '07:00:00', '2022-09-26 15:44:45', '2023-02-07 08:45:18'),
('SER/09/2022/2', '', 'Kelompok 2', 'Pnt. A. Serang', 'Dkn. L. Mohibu', 'Lengan Panjang/Semi Jas.', '2023-06-05 00:00:00', '09:30:00', '2022-09-26 15:45:32', '2023-02-07 08:47:20'),
('SER/10/2022/3', '', 'Kelompok 2', 'Pnt. F. Denny', 'Pnt. N. Kabarey', 'Bebas Rapi Berdasi', '2023-06-12 00:00:00', '07:00:00', '2022-10-07 07:49:58', '2023-02-07 08:46:59'),
('SER/10/2022/4', '', 'Kelompok 1', 'Dkn. M. Baende', 'Pnt. F. Niomba', 'Bebas Rapi Berdasi', '2023-06-12 00:00:00', '07:00:00', '2022-10-07 07:50:37', '2023-02-07 08:44:55'),
('SER/10/2022/5', '', 'Kelompok 1', 'Pnt. Ireine B', 'Dkn. Dikson B', 'Bebas Rapi', '2023-06-19 00:00:00', '07:00:00', '2022-10-07 07:51:18', '2023-02-07 08:43:56'),
('SER/10/2022/6', '', 'Kelompok 2', 'Pnt. Nofian S', 'Pnt. Adriana R', 'Bebas Rapi', '2023-06-19 00:00:00', '09:30:00', '2022-10-07 07:52:05', '2023-02-07 08:46:37'),
('SER/10/2022/7', '', 'Kelompok 2', 'Pnt. Y. Sabea', 'Dkn. Yulita B', 'Bebas Batik', '2023-06-26 00:00:00', '07:00:00', '2022-10-07 07:54:56', '2023-02-07 08:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembagian_majelis`
--

CREATE TABLE `tb_pembagian_majelis` (
  `assemblyData_id` varchar(200) NOT NULL,
  `assembly_group` varchar(200) DEFAULT NULL,
  `assembly_name` varchar(200) DEFAULT NULL,
  `sermon_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembagian_majelis`
--

INSERT INTO `tb_pembagian_majelis` (`assemblyData_id`, `assembly_group`, `assembly_name`, `sermon_date`, `created_at`, `updated_at`) VALUES
('MJLS/10/2022/10', 'Kelompok 1', 'PNT. IRENE BOEDIMAN', '2023-06-27', '2022-10-07 07:31:04', '2023-06-01 21:29:12'),
('MJLS/10/2022/11', 'Kelompok 2', 'DKN. LUSI MOHIBU', '2023-02-26', '2022-10-07 07:31:20', '2023-02-07 08:35:12'),
('MJLS/10/2022/12', 'Kelompok 2', 'PNT. FERDINAN DENNY', '2023-02-12', '2022-10-07 07:31:33', '2023-02-07 09:06:26'),
('MJLS/10/2022/13', 'Kelompok 2', 'DKN. YULISTA MOOT', '2023-02-19', '2022-10-07 07:31:44', '2023-02-07 09:06:12'),
('MJLS/10/2022/14', 'Kelompok 2', 'PNT. NOVITA KABAREY', '2023-02-26', '2022-10-07 07:31:56', '2023-02-07 09:06:01'),
('MJLS/10/2022/7', 'Kelompok 1', 'DKN. MELKI MAJUNTU', '2023-06-05', '2022-10-07 07:30:09', '2023-06-01 21:29:32'),
('MJLS/10/2022/8', 'Kelompok 1', 'PNT. MARLIN BOKAKO', '2023-06-12', '2022-10-07 07:30:23', '2023-06-01 21:29:27'),
('MJLS/10/2022/9', 'Kelompok 1', 'DKN. MERIATI BAENDE', '2023-06-19', '2022-10-07 07:30:53', '2023-06-01 21:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemusik`
--

CREATE TABLE `tb_pemusik` (
  `musician_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serviceCategory_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `projector` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `infocus` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keyboard` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prokantor` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pemusik`
--

INSERT INTO `tb_pemusik` (`musician_id`, `serviceCategory_id`, `projector`, `infocus`, `keyboard`, `prokantor`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('PMSK/09/2022/1', '', 'Hantolya', 'Dian', 'Dkn. Dikson', 'Ovelia Budiman', '2023-02-05 00:00:00', '07:00:00', '2022-09-26 15:47:14', '2023-02-07 09:49:27'),
('PMSK/10/2022/2', '', 'Tita/Hantolya', 'Dian', 'Dkn. Dikson', 'Bpk.Tonny Patty', '2023-02-05 00:00:00', '09:30:00', '2022-10-06 16:23:08', '2023-02-07 09:49:14'),
('PMSK/10/2022/3', '', 'Juan', 'Ancy', 'Pnt. Nofian', 'Bpk. Moris', '2023-02-12 00:00:00', '07:00:00', '2022-10-07 07:41:53', '2023-02-07 09:49:37'),
('PMSK/10/2022/4', '', 'Adriano/Juan', 'Ancy', 'Pnt. Nofian', 'Ibu. Irna M.', '2023-02-12 00:00:00', '09:30:00', '2022-10-07 07:42:20', '2023-02-07 09:49:46'),
('PMSK/10/2022/5', '', 'Meisy', 'Marini', 'Bpk. Wenny', 'Ibu. Selly S', '2023-02-19 00:00:00', '07:00:00', '2022-10-07 07:42:46', '2023-02-07 09:48:54'),
('PMSK/10/2022/6', '', 'Jojo/Meisy', 'Marini', 'Bpk. Wenny', 'Ibu. Selly S', '2023-02-19 00:00:00', '09:30:00', '2022-10-07 07:43:09', '2023-02-07 09:48:47'),
('PMSK/10/2022/7', '', 'Jelda', 'Marsiano', 'Pnt. Nofian', 'Ibu. Mauren T', '2023-02-26 00:00:00', '07:00:00', '2022-10-07 07:43:42', '2023-02-07 09:46:17'),
('PMSK/10/2022/8', '', 'Relan/Laura', 'Marsiano', 'Pnt. Nofian', 'Sdri. Marini S', '2023-02-26 00:00:00', '09:30:00', '2022-10-07 07:44:08', '2023-02-07 09:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penataan_bunga`
--

CREATE TABLE `tb_penataan_bunga` (
  `flowerArrangement_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serviceCategory_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mothersOnDuty` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `coordinator` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penataan_bunga`
--

INSERT INTO `tb_penataan_bunga` (`flowerArrangement_id`, `serviceCategory_id`, `mothersOnDuty`, `coordinator`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('FLW/09/2022/1', '', 'Lingkungan Pelayanan 1', 'Koordinator KW LP 1', '2023-02-05 00:00:00', '07:00:00', '2022-09-26 15:46:34', '2023-02-07 09:11:33'),
('FLW/10/2022/2', '', 'Lingkungan Pelayanan 2', 'Koordinator KW LP 2', '2023-02-12 00:00:00', '07:00:00', '2022-10-06 16:19:45', '2023-02-07 09:11:21'),
('FLW/10/2022/3', '', 'Lingkungan Pelayanan 3', 'Koordinator KW LP 3', '2023-02-19 00:00:00', '07:00:00', '2022-10-07 07:45:41', '2023-02-07 09:11:09'),
('FLW/10/2022/4', '', 'Lingkungan Pelayanan 4', 'Koordinator KW LP 4', '2023-02-26 00:00:00', '07:00:00', '2022-10-07 07:46:07', '2023-02-07 09:10:47'),
('FLW/02/2023/5', 'FA/2022', 'fffffr', 'eee', '2023-02-26 00:00:00', '07:00:00', '2023-02-07 10:29:07', '2023-02-07 10:29:07'),
('FLW/02/2023/6', 'FA/2022', 'ss', 'sss', '2023-02-19 00:00:00', '07:00:00', '2023-02-07 10:29:22', '2023-02-07 10:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penerima_tamu`
--

CREATE TABLE `tb_penerima_tamu` (
  `welcoming_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serviceCategory_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `welcomer` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penerima_tamu`
--

INSERT INTO `tb_penerima_tamu` (`welcoming_id`, `serviceCategory_id`, `welcomer`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('PNRTM/10/2022/1', 'PNTM/2022', 'Pnt. Ireine B', '2022-10-02 00:00:00', '07:00:00', '2022-09-26 15:52:39', '2022-10-07 07:33:16'),
('PNRTM/10/2022/2', 'PNTM/2022', 'Dkn. Fani B', '2022-10-02 00:00:00', '07:00:00', '2022-10-06 16:29:48', '2022-10-07 07:34:20'),
('PNRTM/10/2022/3', 'PNTM/2022', 'Pnt. Fanny N', '2022-10-02 00:00:00', '07:00:00', '2022-10-07 07:33:55', '2022-10-07 07:34:48'),
('PNRTM/10/2022/4', 'PNTM/2022', 'Pnt. Y sabea', '2022-10-02 00:00:00', '09:30:00', '2022-10-07 07:35:01', '2022-10-07 07:35:01'),
('PNRTM/10/2022/5', '', 'Dkn. Yulita B', '2023-02-05 00:00:00', '07:00:00', '2022-10-07 07:35:13', '2023-02-07 10:08:16'),
('PNRTM/10/2022/6', '', 'Pnt. Herlina S', '2023-02-05 00:00:00', '09:30:00', '2022-10-07 07:35:24', '2023-02-07 10:07:58'),
('PNRTM/10/2022/7', '', 'Pnt. Noflien', '2023-02-12 00:00:00', '07:00:00', '2022-10-07 07:35:47', '2023-02-07 10:07:29'),
('PNRTM/10/2022/8', '', 'Dkn. Altje', '2023-02-12 00:00:00', '09:30:00', '2022-10-07 07:36:03', '2023-02-07 10:07:13'),
('PNRTM/10/2022/9', '', 'Pnt. Adriana R', '2023-02-19 00:00:00', '07:00:00', '2022-10-07 07:36:16', '2023-02-07 10:06:29'),
('PNRTM/10/2022/10', '', 'Dkn. Hendrik', '2023-02-19 00:00:00', '09:30:00', '2022-10-07 07:36:52', '2023-02-07 10:06:19'),
('PNRTM/10/2022/11', '', 'Pnt. Ronny', '2023-02-26 00:00:00', '07:00:00', '2022-10-07 07:37:05', '2023-02-07 10:06:04'),
('PNRTM/10/2022/12', '', 'Dkn. Melki', '2023-02-26 00:00:00', '09:30:00', '2022-10-07 07:37:18', '2023-02-07 10:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pujian`
--

CREATE TABLE `tb_pujian` (
  `singing_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serviceCategory_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `singer` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pujian`
--

INSERT INTO `tb_pujian` (`singing_id`, `serviceCategory_id`, `singer`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('SGR/10/2022/1', '', 'VG. KB Lp 2', '2023-02-05 00:00:00', '07:00:00', '2022-09-26 15:47:40', '2023-02-07 10:14:20'),
('SGR/10/2022/2', '', 'VG/Duet/Solo', '2023-02-05 00:00:00', '09:30:00', '2022-10-06 16:26:26', '2023-02-07 10:14:08'),
('SGR/10/2022/3', '', 'Solo', '2023-02-12 00:00:00', '07:00:00', '2022-10-07 07:38:23', '2023-02-07 10:13:49'),
('SGR/10/2022/4', '', 'PS. Usinda', '2023-02-12 00:00:00', '09:30:00', '2022-10-07 07:38:37', '2023-02-07 10:12:35'),
('SGR/10/2022/5', '', 'Solo', '2023-02-19 00:00:00', '07:00:00', '2022-10-07 07:38:49', '2023-02-07 10:13:28'),
('SGR/10/2022/6', '', 'Vg. Bid. Anak Masamper KB', '2023-02-19 00:00:00', '09:30:00', '2022-10-07 07:39:02', '2023-02-07 10:11:54'),
('SGR/10/2022/7', '', 'Ps. Lp 1', '2023-02-26 00:00:00', '07:00:00', '2022-10-07 07:39:12', '2023-02-07 10:11:33'),
('SGR/10/2022/8', '', 'Ps. Lp 5', '2023-02-26 00:00:00', '09:30:00', '2022-10-07 07:39:24', '2023-02-07 10:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rapat_evaluasi`
--

CREATE TABLE `tb_rapat_evaluasi` (
  `evaluationMeeting_id` varchar(200) NOT NULL,
  `evaluationMeeting` varchar(200) DEFAULT NULL,
  `place` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rapat_evaluasi`
--

INSERT INTO `tb_rapat_evaluasi` (`evaluationMeeting_id`, `evaluationMeeting`, `place`, `date`, `time`, `created_at`, `updated_at`) VALUES
('RAPAT/02/2023/2', 'Evaluasi BPHJ', 'Gedung Serba Guna', '2023-02-28', '19:30:00', '2023-02-07 08:25:41', '2023-02-07 08:25:41'),
('RAPAT/02/2023/3', 'Evaluasi Regio', 'Disesuaikan', '2023-02-26', '19:30:00', '2023-02-07 08:27:30', '2023-02-07 08:27:30'),
('RAPAT/12/2022/1', 'Evaluasi Majelis', 'gedung serba guna', '2023-02-03', '19:30:00', '2022-12-19 11:42:33', '2023-02-07 08:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_renungan`
--

CREATE TABLE `tb_renungan` (
  `reflection_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reflection_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bible_verse` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `verse` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contents` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_renungan`
--

INSERT INTO `tb_renungan` (`reflection_id`, `reflection_title`, `bible_verse`, `verse`, `contents`, `publish_date`, `created_at`, `updated_at`) VALUES
('REN/01/2024/71', 'Daniel 2:15', 'Daniel 2:15', 'He inquired of Arioch the king’s deputy, “Why is the decree from the king so urgent?” Then Arioch informed Daniel about the matter. ', '-', '2024-01-22', '2024-01-22 20:48:58', '2024-01-22 20:48:58'),
('REN/02/2023/21', 'Permulaan Pengetahuan', 'Amsal 1:7', '', 'Pendidikan adalah pembelajaran yang membahas pengetahuan dan keterampilan. Pendidikan memang biasanya dilakukan di bawah bimbingan orang lain, namun beberapa orang juga memilih untuk melakukannya secara mandiri (oto-didak). Hal ini dilakukan karena beberapa pertimbangan seperti keterbatasan ruang, waktu, dan biaya.\r\n\r\nAda nama-nama seperti Pablo Casals yang masih berlatih cello selama enam jam sehari di usianya yang ke-95. Juga ada William Mc Pherson, seorang pengawas tambang batu yang mengalami kehilangan penglihatan dan kedua tangannya, serta mati rasa di sebagian wajahnya karena ledakan di tambang.\r\n\r\nIa bertekad membaca Alkitab dengan cara belajar secara mandiri membaca huruf timbul dengan ujung lidahnya. Dalam 65 tahun berikutnya, ia dikabarkan telah membaca Alkitab sebanyak empat kali menggunakan lidahnya.\r\n\r\nDi dalam alkitab kita baca di 2 Timotius 3:14-17, bahwa sedari kecil Timotius sudah diperkenalkan Kitab Suci sebagai jalan dan hikmat dari Tuhan untuk menuntunnya kepada keselamatan. Timotius dipersiapkan Paulus untuk memimpin sebuah jemaat.\r\n\r\nNamun, karena tugas penginjilan, Paulus tidak dapat selalu bersama-sama dengan Timotius, sebab itu Timotius perlu mendidik dirinya sendiri untuk dapat melakukan tugasnya dengan baik. Kadang kala, pendidikan secara mandiri menjadi cara yang baik dan diperlukan untuk mengetahui kenyataan yang sebenarnya dari apa yang harus kita kerjakan.\r\n\r\nMaka sebenarnya ketika kita sudah diperkenalkan dan dibimbing tentang kebenaran firman Tuhan oleh orang tua atau pemimpin rohani kita, itu adalah sebuah modal awal sekaligus himbauan bagi kita untuk terus mendorong dan mendidik diri kita sendiri mengenai ajaran firman Tuhan.\r\n\r\nTentu Tuhan ingin kita semua menjadi pemimpin, setidaknya bagi diri kita sendiri. Maka yang perlu kita lakukan adalah terus mendidik dan mengedukasi diri kita sendiri. Percayalah, tidak ada ruginya menjadi orang yang selalu belajar, belajar, dan belajar. Ketika kita menjadi seorang pembelajar, kita telah menjadikan diri kita \"aset berharga\".', NULL, '2023-02-12 13:47:34', '2023-02-12 13:47:34'),
('REN/02/2023/22', 'Genesis 37:24', 'Genesis 37:24', 'Then they took him and threw him into the cistern. (Now the cistern was empty; there was no water in it.)', '-', NULL, '2023-02-13 02:29:51', '2023-02-13 02:29:51'),
('REN/02/2023/23', '2 Samuel 10:16', '2 Samuel 10:16', 'Then Hadadezer sent for Arameans from beyond the Euphrates River, and they came to Helam. Shobach, the general in command of Hadadezer’s army, led them.', '-', NULL, '2023-02-16 05:35:20', '2023-02-16 05:35:20'),
('REN/02/2023/24', 'Numbers 13:23', 'Numbers 13:23', 'When they came to the valley of Eshcol, they cut down from there a branch with one cluster of grapes, and they carried it on a staff between two men, as well as some of the pomegranates and the figs. ', '-', NULL, '2023-02-17 08:48:47', '2023-02-17 08:48:47'),
('REN/02/2023/25', '1 Chronicles 21:21', '1 Chronicles 21:21', 'When David came to Ornan, Ornan looked and saw David; he came out from the threshing floor and bowed to David with his face to the ground. ', '-', NULL, '2023-02-18 01:51:42', '2023-02-18 01:51:42'),
('REN/02/2023/26', 'John 10:31', 'John 10:31', 'The Jewish leaders picked up rocks again to stone him to death.', '-', NULL, '2023-02-19 04:43:34', '2023-02-19 04:43:34'),
('REN/02/2023/27', '2 Timothy 3:16', '2 Timothy 3:16', 'Every scripture is inspired by God and useful for teaching, for reproof, for correction, and for training in righteousness, ', '-', NULL, '2023-02-20 04:36:06', '2023-02-20 04:36:06'),
('REN/02/2023/28', 'Psalms 139:11', 'Psalms 139:11', 'If I were to say, “Certainly the darkness will cover me, and the light will turn to night all around me,”', '-', NULL, '2023-02-21 03:14:39', '2023-02-21 03:14:39'),
('REN/02/2023/29', 'Isaiah 28:28', 'Isaiah 28:28', 'Grain is crushed, though one certainly does not thresh it forever. The wheel of one’s wagon rolls over it, but his horses do not crush it.', '-', NULL, '2023-02-22 08:29:13', '2023-02-22 08:29:13'),
('REN/02/2023/30', 'Philemon 1:22', 'Philemon 1:22', 'At the same time also, prepare a place for me to stay, for I hope that through your prayers I will be given back to you. ', '-', NULL, '2023-02-27 19:47:24', '2023-02-27 19:47:24'),
('REN/02/2023/31', 'Psalms 68:7', 'Psalms 68:7', 'O God, when you lead your people into battle, when you march through the wastelands, (Selah)', '-', NULL, '2023-02-28 07:43:27', '2023-02-28 07:43:27'),
('REN/03/2023/32', '1 Chronicles 4:18', '1 Chronicles 4:18', '(His Judahite wife gave birth to Jered the father of Gedor, Heber the father of Soco, and Jekuthiel the father of Zanoah.) These were the sons of Pharaoh’s daughter Bithiah, whom Mered married. ', '-', NULL, '2023-03-02 02:53:46', '2023-03-02 02:53:46'),
('REN/03/2023/33', 'Genesis 11:11', 'Genesis 11:11', 'And after becoming the father of Arphaxad, Shem lived 500 years and had other sons and daughters. ', '-', NULL, '2023-03-03 15:56:06', '2023-03-03 15:56:06'),
('REN/03/2023/34', 'Jeremiah 5:10', 'Jeremiah 5:10', 'The Lord commanded the enemy, “March through the vineyards of Israel and Judah and ruin them. But do not destroy them completely. Strip off their branches for these people do not belong to the Lord. ', '-', NULL, '2023-03-08 01:24:50', '2023-03-08 01:24:50'),
('REN/03/2023/35', 'Jeremiah 51:4', 'Jeremiah 51:4', 'Let them fall slain in the land of Babylonia, mortally wounded in the streets of her cities.', '-', NULL, '2023-03-10 03:57:10', '2023-03-10 03:57:10'),
('REN/03/2023/36', 'Proverbs 30:29', 'Proverbs 30:29', 'There are three things that are magnificent in their step, four things that move about magnificently: ', '-', NULL, '2023-03-11 04:04:30', '2023-03-11 04:04:30'),
('REN/03/2023/37', 'Romans 1:20', 'Romans 1:20', 'For since the creation of the world his invisible attributes—his eternal power and divine nature—have been clearly seen because they are understood through what has been made. So people are without ex', '-', NULL, '2023-03-13 03:39:49', '2023-03-13 03:39:49'),
('REN/03/2023/38', 'Exodus 14:4', 'Exodus 14:4', 'I will harden Pharaoh’s heart, and he will chase after them. I will gain honor because of Pharaoh and because of all his army, and the Egyptians will know that I am the Lord.” So this is what they did', '-', NULL, '2023-03-14 00:50:06', '2023-03-14 00:50:06'),
('REN/03/2023/39', 'Matthew 3:16', 'Matthew 3:16', 'After Jesus was baptized, just as he was coming up out of the water, the heavens opened and he saw the Spirit of God descending like a dove and coming to rest on him. ', '-', NULL, '2023-03-15 13:09:59', '2023-03-15 13:09:59'),
('REN/03/2023/40', 'Joshua 22:11', 'Joshua 22:11', 'The Israelites received this report: “Look, the Reubenites, the Gadites, and the half-tribe of Manasseh have built an altar at the entrance to the land of Canaan, at Geliloth near the Jordan on the Is', '-', NULL, '2023-03-17 17:28:16', '2023-03-17 17:28:16'),
('REN/03/2023/41', 'Isaiah 28:19', 'Isaiah 28:19', 'Whenever it sweeps by, it will overtake you; indeed, every morning it will sweep by, it will come through during the day and the night.” When this announcement is understood, it will cause nothing but', '-', NULL, '2023-03-19 07:09:16', '2023-03-19 07:09:16'),
('REN/03/2023/42', 'Romans 1:10', 'Romans 1:10', 'and I always ask in my prayers if, perhaps now at last I may succeed in visiting you according to the will of God. ', '-', NULL, '2023-03-19 07:09:18', '2023-03-19 07:09:18'),
('REN/03/2023/43', 'Isaiah 66:22', 'Isaiah 66:22', '“For just as the new heavens and the new earth I am about to make will remain standing before me,” says the Lord, “so your descendants and your name will remain. ', '-', NULL, '2023-03-20 05:57:58', '2023-03-20 05:57:58'),
('REN/03/2023/44', 'Matthew 8:14', 'Matthew 8:14', 'Now when Jesus entered Peter’s house, he saw his mother-in-law lying down, sick with a fever. ', '-', NULL, '2023-03-21 10:05:31', '2023-03-21 10:05:31'),
('REN/03/2023/45', 'Proverbs 2:21', 'Proverbs 2:21', 'For the upright will reside in the land, and those with integrity will remain in it,', '-', NULL, '2023-03-22 08:58:48', '2023-03-22 08:58:48'),
('REN/03/2023/46', 'Proverbs 8:23', 'Proverbs 8:23', 'From eternity I have been fashioned, from the beginning, from before the world existed.', '-', NULL, '2023-03-23 14:11:21', '2023-03-23 14:11:21'),
('REN/03/2023/47', 'Joshua 2:7', 'Joshua 2:7', 'Meanwhile, the king’s men tried to find them on the road to the Jordan River near the fords. The city gate was shut as soon as they set out in pursuit of them. ', '-', NULL, '2023-03-24 04:28:24', '2023-03-24 04:28:24'),
('REN/03/2023/48', 'Psalms 105:10', 'Psalms 105:10', 'He gave it to Jacob as a decree, to Israel as a lasting promise, ', '-', NULL, '2023-03-26 01:32:28', '2023-03-26 01:32:28'),
('REN/03/2023/49', 'Psalms 109:1', 'Psalms 109:1', 'For the music director, a psalm of David. O God whom I praise, do not ignore me.', '-', NULL, '2023-03-28 23:35:15', '2023-03-28 23:35:15'),
('REN/03/2023/50', 'Luke 3:5', 'Luke 3:5', '<b>Every valley will be filled,</b> <b>and every mountain and hill will be brought low,</b> <b>and the crooked will be made straight,</b> <b>and the rough ways will be made smooth,</b> ', '-', NULL, '2023-03-29 22:03:20', '2023-03-29 22:03:20'),
('REN/04/2023/51', '2 Kings 15:34', '2 Kings 15:34', 'He did what the Lord approved, just as his father Uzziah had done. ', '-', NULL, '2023-04-01 06:55:55', '2023-04-01 06:55:55'),
('REN/04/2023/52', 'John 20:27', 'John 20:27', 'Then he said to Thomas, “Put your finger here, and examine my hands. Extend your hand and put it into my side. Do not continue in your unbelief, but believe.” ', '-', NULL, '2023-04-02 16:25:01', '2023-04-02 16:25:01'),
('REN/04/2023/53', '2 Chronicles 15:1', '2 Chronicles 15:1', 'God’s Spirit came upon Azariah son of Oded. ', '-', NULL, '2023-04-07 10:24:50', '2023-04-07 10:24:50'),
('REN/04/2023/54', 'Ephesians 6:5', 'Ephesians 6:5', 'Slaves, obey your human masters with fear and trembling, in the sincerity of your heart, as to Christ, ', '-', NULL, '2023-04-07 10:25:16', '2023-04-07 10:25:16'),
('REN/04/2023/55', 'Acts 18:19', 'Acts 18:19', 'When they reached Ephesus, Paul left Priscilla and Aquila behind there, but he himself went into the synagogue and addressed the Jews. ', '-', NULL, '2023-04-08 08:51:01', '2023-04-08 08:51:01'),
('REN/04/2023/56', 'Matthew 21:1', 'Matthew 21:1', 'Now when they approached Jerusalem and came to Bethphage, at the Mount of Olives, Jesus sent two disciples, ', '-', NULL, '2023-04-09 09:03:03', '2023-04-09 09:03:03'),
('REN/04/2023/57', 'Psalms 83:8', 'Psalms 83:8', 'Even Assyria has allied with them, lending its strength to the descendants of Lot. (Selah)', '-', NULL, '2023-04-16 17:36:11', '2023-04-16 17:36:11'),
('REN/04/2023/58', '2 Kings 13:21', '2 Kings 13:21', 'One day some men were burying a man when they spotted a raiding party. So they threw the dead man into Elisha’s tomb. When the body touched Elisha’s bones, the dead man came to life and stood on his f', '-', NULL, '2023-04-18 19:58:29', '2023-04-18 19:58:29'),
('REN/04/2023/59', 'Exodus 29:5', 'Exodus 29:5', 'and take the garments and clothe Aaron with the tunic, the robe of the ephod, the ephod, and the breastpiece; you are to fasten the ephod on him by using the skillfully woven waistband. ', '-', NULL, '2023-04-20 11:51:44', '2023-04-20 11:51:44'),
('REN/04/2023/60', '1 Samuel 23:7', '1 Samuel 23:7', 'When Saul was told that David had come to Keilah, Saul said, “God has delivered him into my hand, for he has boxed himself into a corner by entering a city with two barred gates.” ', '-', NULL, '2023-04-27 14:27:03', '2023-04-27 14:27:03'),
('REN/04/2023/61', 'Psalms 105:9', 'Psalms 105:9', 'the promise he made to Abraham, the promise he made by oath to Isaac. ', '-', NULL, '2023-04-29 04:39:03', '2023-04-29 04:39:03'),
('REN/04/2023/62', 'Ruth 1:17', 'Ruth 1:17', 'Wherever you die, I will die—and there I will be buried. May the Lord punish me severely if I do not keep my promise! Only death will be able to separate me from you!”', '-', NULL, '2023-04-30 09:24:04', '2023-04-30 09:24:04'),
('REN/05/2023/63', 'Nehemiah 2:20', 'Nehemiah 2:20', 'I responded to them by saying, “The God of heaven will prosper us. We his servants will start the rebuilding. But you have no just or ancient right in Jerusalem.” ', '-', NULL, '2023-05-01 04:10:19', '2023-05-01 04:10:19'),
('REN/05/2023/66', '-', 'amsal 1:7', '', '<p>-</p>', NULL, '2023-05-02 14:53:22', '2023-05-02 14:53:22'),
('REN/05/2023/67', 'Proverbs 13:16', 'Proverbs 13:16', 'Every shrewd person acts with knowledge, but a fool displays his folly. ', '-', '2023-05-03', '2023-05-04 10:40:16', '2023-05-04 10:40:16'),
('REN/05/2023/68', 'sdf', 'Kejadian 3:3', 'tetapi tentang buah pohon yang ada di tengah-tengah taman, Allah berfirman: Jangan kamu makan ataupun raba buah itu, nanti kamu mati. \" tetapi dari buah pohon yang ada di tengah taman, Allah telah berfirman, \'Kamu tidak boleh memakannya, kamu juga tidak boleh menyentuhnya, nanti kamu akan mati.', '<p>asfdd</p>', '2023-05-04', '2023-05-04 17:59:25', '2023-05-04 18:44:01'),
('REN/05/2023/69', 'TUHAN ADALAH KEKUATAN KU', 'Markus 1:1', 'asdfad', '<p>sdfsdfnsa</p>\r\n<p>&nbsp;</p>\r\n<p>asdf</p>\r\n<p>asdf</p>\r\n<p>adf</p>\r\n<p>aswfd</p>\r\n<p>aws</p>\r\n<p>dfas</p>\r\n<p>dfasw</p>\r\n<p>df</p>', '2023-05-26', '2023-05-04 18:37:11', '2023-05-04 18:38:28'),
('REN/06/2023/70', 'Job 1:18', 'Job 1:18', 'While this one was still speaking another messenger arrived and said, “Your sons and your daughters were eating and drinking wine in their oldest brother’s house, ', '-', '2023-06-01', '2023-06-01 21:21:51', '2023-06-01 21:21:51'),
('REN/08/2024/72', '1 Kings 12:31', '1 Kings 12:31', 'He built temples on the high places and appointed as priests common people who were not Levites. ', '-', '2024-08-15', '2024-08-15 17:13:32', '2024-08-15 17:13:32'),
('REN/10/2022/1', 'TUHAN ADALAH KEKUATAN KU', 'Mazmur 10:15', 'Patahkanlah lengan orang fasik dan orang jahat, tuntutlah kefasikannya, sampai Engkau tidak menemuinya lagi.', 'COBA', NULL, '2022-10-27 16:16:09', '2022-10-27 16:16:33'),
('REN/10/2022/2', 'PENGKOTBAH', 'Amsal 3:10', 'maka lumbung-lumbungmu akan diisi penuh sampai melimpah-limpah, dan bejana pemerahanmu akan meluap dengan air buah anggurnya.', 'klsjdflkasdjflk', NULL, '2022-10-27 16:19:50', '2022-10-27 16:19:50'),
('REN/10/2022/3', 'Amsal 22:6', 'Amsal 22:6', 'Didiklah orang muda menurut jalan yang patut baginya, maka pada masa tuanyapun ia tidak akan menyimpang dari pada jalan itu.', '<p><strong>GEREJA KOSONG</strong></p>\r\n<p><em>&ldquo;Karena itu pergilah, jadikanlah semua bangsa muridku dan babtislah mereka dalam nama Bapa dan Anak dan roh Kudus, dan ajarlah mereka melakukan segala sesuatu yang telah Kuperintahkan kepadamu. Dan ketahuilah, Aku menyertai kamu senantiasa sampai kepada akhir jaman. (Matius 28:19-20)</em></p>\r\n<p>Perbedaan mencolok saya lihat dan rasakan ketika saya baru pindah domisili. Pengalaman yang sungguh asing dibandingkan dengan kota saya sebelumnya. Di kota Manado Anda menemukan gereja&nbsp; hampir di tiap jalan atau gang. Bahkan di sebuah ruas jalan yang tidak terlalu panjang, ada 5-6 gereja. Itu terdiri dari gereja besar, gereja kecil, gereja tradisional, gereja injili, karismatik ada.</p>', NULL, '2022-10-28 16:45:15', '2022-10-28 16:46:07'),
('REN/10/2022/4', 'Wahyu 1:8', 'Wahyu 1:8', '\"Aku adalah Alfa dan Omega, firman Tuhan Allah, yang ada dan yang sudah ada dan yang akan datang, Yang Mahakuasa.\"', '-', NULL, '2022-10-29 04:24:41', '2022-10-29 04:24:41'),
('REN/10/2022/5', 'Yesaya 58:11', 'Yesaya 58:11', 'TUHAN akan menuntun engkau senantiasa dan akan memuaskan hatimu di tanah yang kering, dan akan membaharui kekuatanmu; engkau akan seperti taman yang diairi dengan baik dan seperti mata air yang tidak ', '-', NULL, '2022-10-30 22:36:50', '2022-10-30 22:36:50'),
('REN/10/2022/6', 'Filipi 1:21', 'Filipi 1:21', 'Karena bagiku hidup adalah Kristus dan mati adalah keuntungan.', '-', NULL, '2022-10-31 14:05:20', '2022-10-31 14:05:20'),
('REN/11/2022/10', 'Amsal 22:6', 'Amsal 22:6', 'Didiklah orang muda menurut jalan yang patut baginya, maka pada masa tuanyapun ia tidak akan menyimpang dari pada jalan itu.', '-', NULL, '2022-11-04 05:51:39', '2022-11-04 05:51:39'),
('REN/11/2022/11', 'Mazmur 18:1-2', 'Mazmur 18:1-2', 'Untuk pemimpin biduan. Dari hamba TUHAN, yakni Daud yang menyampaikan perkataan nyanyian ini kepada TUHAN, pada waktu TUHAN telah melepaskan dia dari cengkeraman semua musuhnya dan dari tangan Saul. (', '-', NULL, '2022-11-06 09:33:55', '2022-11-06 09:33:55'),
('REN/11/2022/12', 'Yohanes 10:10', 'Yohanes 10:10', 'Pencuri datang hanya untuk mencuri dan membunuh dan membinasakan; Aku datang, supaya mereka mempunyai hidup, dan mempunyainya dalam segala kelimpahan.', '-', NULL, '2022-11-07 06:14:51', '2022-11-07 06:14:51'),
('REN/11/2022/13', '1 Yohanes 3:18', '1 Yohanes 3:18', 'Anak-anakku, marilah kita mengasihi bukan dengan perkataan atau dengan lidah, tetapi dengan perbuatan dan dalam kebenaran.', '-', NULL, '2022-11-09 11:27:32', '2022-11-09 11:27:32'),
('REN/11/2022/14', 'Amsal 21:3', 'Amsal 21:3', 'Melakukan kebenaran dan keadilan lebih dikenan TUHAN dari pada korban.', '-', NULL, '2022-11-10 14:10:43', '2022-11-10 14:10:43'),
('REN/11/2022/15', 'Yesaya 33:22', 'Yesaya 33:22', 'Sebab TUHAN ialah Hakim kita, TUHAN ialah yang memberi hukum bagi kita; TUHAN ialah Raja kita, Dia akan menyelamatkan kita.', '-', NULL, '2022-11-11 14:17:56', '2022-11-11 14:17:56'),
('REN/11/2022/16', '1 Korintus 2:14', '1 Korintus 2:14', 'Tetapi manusia duniawi tidak menerima apa yang berasal dari Roh Allah, karena hal itu baginya adalah suatu kebodohan; dan ia tidak dapat memahaminya, sebab hal itu hanya dapat dinilai secara rohani.', '-', NULL, '2022-11-13 01:53:31', '2022-11-13 01:53:31'),
('REN/11/2022/17', '1 Korintus 6:19-20', '1 Korintus 6:19-20', 'Atau tidak tahukah kamu, bahwa tubuhmu adalah bait Roh Kudus yang diam di dalam kamu, Roh Kudus yang kamu peroleh dari Allah, --dan bahwa kamu bukan milik kamu sendiri? Sebab kamu telah dibeli dan har', '-', NULL, '2022-11-14 15:25:32', '2022-11-14 15:25:32'),
('REN/11/2022/18', 'Mazmur 62:1', 'Mazmur 62:1', 'Untuk pemimpin biduan. Menurut: Yedutun. Mazmur Daud. (62-2) Hanya dekat Allah saja aku tenang, dari pada-Nyalah keselamatanku.', '-', NULL, '2022-11-15 14:08:07', '2022-11-15 14:08:07'),
('REN/11/2022/19', '1 Petrus 3:8', '1 Petrus 3:8', 'Dan akhirnya, hendaklah kamu semua seia sekata, seperasaan, mengasihi saudara-saudara, penyayang dan rendah hati,', '-', NULL, '2022-11-16 06:57:26', '2022-11-16 06:57:26'),
('REN/11/2022/20', 'Yesaya 40:28', 'Yesaya 40:28', 'Tidakkah kautahu, dan tidakkah kaudengar? TUHAN ialah Allah kekal yang menciptakan bumi dari ujung ke ujung; Ia tidak menjadi lelah dan tidak menjadi lesu, tidak terduga pengertian-Nya.', '-', NULL, '2022-11-17 07:19:05', '2022-11-17 07:19:05'),
('REN/11/2022/7', 'Yesaya 26:3', 'Yesaya 26:3', 'Yang hatinya teguh Kaujagai dengan damai sejahtera, sebab kepada-Mulah ia percaya.', '-', NULL, '2022-11-01 02:32:29', '2022-11-01 02:32:29'),
('REN/11/2022/8', 'Mazmur 145:3', 'Mazmur 145:3', 'Besarlah TUHAN dan sangat terpuji, dan kebesaran-Nya tidak terduga.', '-', NULL, '2022-11-02 01:59:39', '2022-11-02 01:59:39'),
('REN/11/2022/9', '1 Tesalonika 5:15', '1 Tesalonika 5:15', 'Perhatikanlah, supaya jangan ada orang yang membalas jahat dengan jahat, tetapi usahakanlah senantiasa yang baik, terhadap kamu masing-masing dan terhadap semua orang.', '-', NULL, '2022-11-03 10:12:14', '2022-11-03 10:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_temp_dtl_kartu_keluarga`
--

CREATE TABLE `tb_temp_dtl_kartu_keluarga` (
  `number` int NOT NULL,
  `familyCard_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fullName` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NIK` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varbinary(30) DEFAULT NULL,
  `place_ofBirth` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_ofBirth` datetime DEFAULT NULL,
  `religion` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `education` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `job` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `blood` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `marriage` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_ofMarriage` datetime DEFAULT NULL,
  `family_status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `citizenship` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paspor` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fatherName` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `motherName` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `picture` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_token` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `name`, `email`, `username`, `phone`, `password`, `gender`, `picture`, `level`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@sionwko.com', 'Admin', '081347748346', '$2y$10$9SFgXh01hb8cjX6gCh/XPO5qREI0mDk8jeBP7mOXuEcWAiCknV7DG', 'Male', NULL, 'Admin', 'OFFLINE', NULL, '2022-08-24 23:57:05', '2022-08-24 23:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_alkitab`
--
ALTER TABLE `tb_alkitab`
  ADD PRIMARY KEY (`bible_id`);

--
-- Indexes for table `tb_bulletin_cover`
--
ALTER TABLE `tb_bulletin_cover`
  ADD PRIMARY KEY (`cover_id`);

--
-- Indexes for table `tb_data_baptis`
--
ALTER TABLE `tb_data_baptis`
  ADD PRIMARY KEY (`baptism_id`);

--
-- Indexes for table `tb_data_jemaat`
--
ALTER TABLE `tb_data_jemaat`
  ADD PRIMARY KEY (`congregation_id`);

--
-- Indexes for table `tb_data_sidi`
--
ALTER TABLE `tb_data_sidi`
  ADD PRIMARY KEY (`sidi_id`);

--
-- Indexes for table `tb_dtl_kartu_keluarga`
--
ALTER TABLE `tb_dtl_kartu_keluarga`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tb_ibadah`
--
ALTER TABLE `tb_ibadah`
  ADD PRIMARY KEY (`worship_id`);

--
-- Indexes for table `tb_kartu_keluarga`
--
ALTER TABLE `tb_kartu_keluarga`
  ADD PRIMARY KEY (`familyCard_id`);

--
-- Indexes for table `tb_kategori_alkitab`
--
ALTER TABLE `tb_kategori_alkitab`
  ADD PRIMARY KEY (`bibleCategory_id`);

--
-- Indexes for table `tb_kategori_event`
--
ALTER TABLE `tb_kategori_event`
  ADD PRIMARY KEY (`eventCategory_id`);

--
-- Indexes for table `tb_kategori_ibadah`
--
ALTER TABLE `tb_kategori_ibadah`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_kategori_pelayanan`
--
ALTER TABLE `tb_kategori_pelayanan`
  ADD PRIMARY KEY (`serviceCategory_id`);

--
-- Indexes for table `tb_kesaksian`
--
ALTER TABLE `tb_kesaksian`
  ADD PRIMARY KEY (`testimony_id`);

--
-- Indexes for table `tb_majelis_ibadah_minggu`
--
ALTER TABLE `tb_majelis_ibadah_minggu`
  ADD PRIMARY KEY (`assembly_id`);

--
-- Indexes for table `tb_pembagian_majelis`
--
ALTER TABLE `tb_pembagian_majelis`
  ADD PRIMARY KEY (`assemblyData_id`);

--
-- Indexes for table `tb_rapat_evaluasi`
--
ALTER TABLE `tb_rapat_evaluasi`
  ADD PRIMARY KEY (`evaluationMeeting_id`);

--
-- Indexes for table `tb_renungan`
--
ALTER TABLE `tb_renungan`
  ADD PRIMARY KEY (`reflection_id`);

--
-- Indexes for table `tb_temp_dtl_kartu_keluarga`
--
ALTER TABLE `tb_temp_dtl_kartu_keluarga`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_dtl_kartu_keluarga`
--
ALTER TABLE `tb_dtl_kartu_keluarga`
  MODIFY `number` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_temp_dtl_kartu_keluarga`
--
ALTER TABLE `tb_temp_dtl_kartu_keluarga`
  MODIFY `number` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
