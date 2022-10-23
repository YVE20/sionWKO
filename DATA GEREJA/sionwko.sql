-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2022 at 12:18 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_alkitab`
--

CREATE TABLE `tb_alkitab` (
  `bible_id` varchar(200) NOT NULL,
  `bibleCategory_id` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `book` varchar(200) DEFAULT NULL,
  `paragraph` varchar(200) DEFAULT NULL,
  `chapter` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_baptis`
--

CREATE TABLE `tb_data_baptis` (
  `baptism_id` varchar(200) NOT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `place_ofBirth` varchar(200) DEFAULT NULL,
  `date_ofBirth` datetime DEFAULT NULL,
  `date_ofBaptism` datetime DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `church` varchar(30) DEFAULT NULL,
  `father_name` varchar(200) DEFAULT NULL,
  `mother_name` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `pastor` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_baptis`
--

INSERT INTO `tb_data_baptis` (`baptism_id`, `full_name`, `gender`, `place_ofBirth`, `date_ofBirth`, `date_ofBaptism`, `religion`, `church`, `father_name`, `mother_name`, `address`, `pastor`, `photo`, `created_at`, `updated_at`) VALUES
('BPTS/09/2022/1', 'Yearico Vio Euaggelion', 'male', 'Pontianak', '2000-12-28 00:00:00', '2012-12-13 00:00:00', NULL, 'SION WKO', 'Iskandar Bong', 'Nelly Chen', 'Pontianak', 'Pdt. Niko', '', '2022-09-09 12:09:02', '2022-09-09 12:09:02'),
('BPTS/09/2022/2', 'Bahmundi Antrosono', 'female', 'Sekadau', '2022-12-31 00:00:00', '2022-12-31 00:00:00', 'Christian', 'SION WKO', 'lkjlk;', 'jlkj;lk', 'lkj;lkjl', 'Pdt. Andytara', 'Baptis/209.2022..png', '2022-09-09 12:16:28', '2022-09-09 17:32:03'),
('BPTS/09/2022/3', 'lkjlk', 'male', 'kjhkj', '2022-12-31 00:00:00', '2022-12-31 00:00:00', 'Christian', 'SION WKO', 'lkj', 'lkj', 'jh', 'lkjlk', '', '2022-09-17 09:05:55', '2022-09-17 09:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_jemaat`
--

CREATE TABLE `tb_data_jemaat` (
  `congregation_id` varchar(200) NOT NULL,
  `baptism_id` varchar(200) DEFAULT NULL,
  `sidi_id` varchar(200) DEFAULT NULL,
  `familyCard_id` varchar(200) DEFAULT NULL,
  `service_environtment` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_jemaat`
--

INSERT INTO `tb_data_jemaat` (`congregation_id`, `baptism_id`, `sidi_id`, `familyCard_id`, `service_environtment`, `created_at`, `updated_at`) VALUES
('DAJA/2', 'BPTS/09/2022/1', 'SIDI/09/2022/1', '000000101010101', '2', '2022-09-13 06:32:55', '2022-09-15 07:33:26'),
('DAJA/3', 'lkdsakl', 'j', 'lkjl', '5', '2022-09-17 08:56:34', '2022-09-17 08:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_sidi`
--

CREATE TABLE `tb_data_sidi` (
  `sidi_id` varchar(200) NOT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `place_ofBirth` varchar(200) DEFAULT NULL,
  `date_ofBirth` datetime DEFAULT NULL,
  `NIK` varchar(30) DEFAULT NULL,
  `baptism_file` varchar(200) DEFAULT NULL,
  `date_ofBaptism` datetime DEFAULT NULL,
  `church` varchar(200) DEFAULT NULL,
  `father_name` varchar(200) DEFAULT NULL,
  `mother_name` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `marriage_certificate` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `date_ofSIDI` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_sidi`
--

INSERT INTO `tb_data_sidi` (`sidi_id`, `full_name`, `gender`, `place_ofBirth`, `date_ofBirth`, `NIK`, `baptism_file`, `date_ofBaptism`, `church`, `father_name`, `mother_name`, `address`, `marriage_certificate`, `photo`, `phone_number`, `date_ofSIDI`, `created_at`, `updated_at`) VALUES
('SIDI/09/2022/1', 'Yearico Vio Euaggelion', 'male', 'Pontianak', '2000-12-28 00:00:00', '6171022812000005', 'Baptis/1.09.2022..png', '2012-12-13 00:00:00', 'GBI Rayon 11 Pekanbaru', 'Iskandar Bong', 'Nelly Chen', 'Pontianak', 'Pernikahan/1.09.2022..png', 'Photo/1.09.2022..png', '081347748346', '2005-01-01 00:00:00', '2022-09-09 13:34:36', '2022-09-09 17:05:14'),
('SIDI/09/2022/2', 'kjh', 'female', 'kjhkj', '2022-12-30 00:00:00', 'khj', '', '2022-12-31 00:00:00', 'lkjlkj', 'lkjlk;', 'jlkj;lk', 'lkj;lkjl', '', '', 'kj;lj', '2022-12-30 00:00:00', '2022-09-17 09:07:40', '2022-09-17 09:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dtl_kartu_keluarga`
--

CREATE TABLE `tb_dtl_kartu_keluarga` (
  `number` int(200) NOT NULL,
  `familyCard_id` varchar(200) DEFAULT NULL,
  `fullName` varchar(200) DEFAULT NULL,
  `NIK` varchar(200) DEFAULT NULL,
  `gender` varbinary(30) DEFAULT NULL,
  `place_ofBirth` varchar(200) DEFAULT NULL,
  `date_ofBirth` datetime DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `education` varchar(30) DEFAULT NULL,
  `job` varchar(200) DEFAULT NULL,
  `blood` varchar(30) DEFAULT NULL,
  `marriage` varchar(30) DEFAULT NULL,
  `date_ofMarriage` datetime DEFAULT NULL,
  `family_status` varchar(30) DEFAULT NULL,
  `citizenship` varchar(200) DEFAULT NULL,
  `paspor` varchar(200) DEFAULT NULL,
  `fatherName` varchar(200) DEFAULT NULL,
  `motherName` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dtl_kartu_keluarga`
--

INSERT INTO `tb_dtl_kartu_keluarga` (`number`, `familyCard_id`, `fullName`, `NIK`, `gender`, `place_ofBirth`, `date_ofBirth`, `religion`, `education`, `job`, `blood`, `marriage`, `date_ofMarriage`, `family_status`, `citizenship`, `paspor`, `fatherName`, `motherName`, `created_at`, `updated_at`) VALUES
(1, '1010101011010', 'TESTING', '11111111', 0x6d616c65, 'Jakarta', '1998-11-11 00:00:00', 'BUDDHA', 'Diploma I / II', 'Guru', 'B', 'Kawin Tercatat', NULL, 'Suami', 'WNI', '-', 'Sutarni', 'Mulyani', '2022-09-13 09:53:33', '2022-09-13 09:53:33'),
(2, '1010101011010', 'HQHQHQHQH', '2222222', 0x66656d616c65, 'Pekanbaru', '1999-09-10 00:00:00', 'CATHOLIC', 'Akademi/ Diploma III/ S.Muda', 'Wiraswasta', 'O', 'Kawin Tercatat', '2022-12-31 00:00:00', 'Istri', 'WNI', '-', 'Antoni', 'Mili', '2022-09-13 09:56:05', '2022-09-13 09:56:05'),
(3, '1010101011010', 'THTHTHHQLJQ', '333333', 0x6d616c65, 'Medan', '2004-10-31 00:00:00', 'MUSLIM', 'Belum Tamat SD / Sederajat', 'Pelajar', 'AB', 'Belum Kawin', NULL, 'Anak', 'WNI', '-', 'TESTING', 'HQHQHQHQH', '2022-09-13 09:57:11', '2022-09-13 09:57:11'),
(4, '000000101010101', 'HAHAHAHAHAh', '989898989', 0x6d616c65, 'Pontianak', '1980-08-11 00:00:00', 'MUSLIM', 'Akademi/ Diploma III/ S.Muda', 'Guru', 'O', 'Kawin Tercatat', '2000-12-31 00:00:00', 'Suami', 'WNI', '-', 'Handoko', 'Maria', '2022-09-13 10:08:59', '2022-09-13 10:08:59'),
(5, '000000101010101', 'YUAYUAYUAYU', '8787878787', 0x66656d616c65, 'Palembang', '1985-06-13 00:00:00', 'KONGHUCU', 'Diploma I / II', 'Dokter', 'A', 'Kawin Tercatat', '2000-12-31 00:00:00', 'Istri', 'WNI', '-', 'Anto', 'Cindy', '2022-09-13 10:10:00', '2022-09-13 10:10:00'),
(6, '000000101010101', 'Yearico Vio Euaggelion', '181818181818', 0x6d616c65, 'Makasar', '2005-10-26 00:00:00', 'CATHOLIC', 'SLTP / Sederajat', 'Pelajar', 'O', 'Belum Kawin', NULL, 'Anak', 'WNI', '-', 'HAHAHAHAHAh', 'YUAYUAYUAYU', '2022-09-13 10:10:45', '2022-09-15 07:33:05'),
(7, '000000101010101', 'OOIOIOOIOI', '748672681', 0x66656d616c65, 'Cilegon', '2006-03-16 00:00:00', 'CHRISTIAN', 'SLTP / Sederajat', 'Pelajar', 'AB', 'Belum Kawin', NULL, 'Anak', 'WNI', '-', 'HAHAHAHAHAh', 'YUAYUAYUAYU', '2022-09-13 10:11:59', '2022-09-13 10:11:59'),
(8, '000000101010101', 'PQPQPQPQPQPQ', '11188181818', 0x6d616c65, 'Serang', '2008-08-11 00:00:00', 'CHRISTIAN', 'SLTP / Sederajat', 'Pelajar', 'B', 'Belum Kawin', NULL, 'Istri', 'WNI', '-', 'HAHAHAHAHAh', 'YUAYUAYUAYU', '2022-09-13 10:12:48', '2022-09-13 10:12:48'),
(11, '657498798', 'lkjlkj', '098940234809', 0x6d616c65, 'lkj', '2022-09-17 00:00:00', 'CHRISTIAN', 'Strata III', 'jh;lkdsj', 'A', 'Kawin Tercatat', '2022-12-07 00:00:00', 'Suami', 'WNI', 'kjh', 'lkJLKjlk', 'lkjlkjlk', '2022-09-13 10:25:38', '2022-09-13 10:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `event_id` varchar(200) NOT NULL,
  `eventCategory_id` varchar(200) DEFAULT NULL,
  `speaker` varchar(200) DEFAULT NULL,
  `place` varchar(200) DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `theme` varchar(200) DEFAULT NULL,
  `contact_person` varchar(30) DEFAULT NULL,
  `photo` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_event`
--

INSERT INTO `tb_event` (`event_id`, `eventCategory_id`, `speaker`, `place`, `sermon_date`, `address`, `theme`, `contact_person`, `photo`, `created_at`, `updated_at`) VALUES
('EVT/3', 'EVT/HRFG', 'jlkj', 'lkjl', '2022-09-12 00:00:00', 'KALIMANTAN BARAT', 'lkj', '0180348509', 'ReformasiGereja/3.09.2022..jpg', '2022-09-12 10:04:13', '2022-09-12 11:31:12'),
('EVT/4', 'EVT/HUT/GM', 'Pdt. Budianto', 'Pontianak', '2021-12-30 00:00:00', 'Jln. Osamaliki 10', 'KKR GELOMBANG KESEMBUHAN', '0810047917', 'HUT/4.09.2022..png', '2022-09-12 10:23:59', '2022-09-12 10:57:19'),
('EVT/6', 'EVT/HUT/GMIH', 'lkjl', 'kjlkj', '2016-01-03 00:00:00', 'kjhkj', 'kj', 'kjhkj', '', '2022-09-12 11:34:29', '2022-09-12 11:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ibadah`
--

CREATE TABLE `tb_ibadah` (
  `worship_id` varchar(200) NOT NULL,
  `category_id` varchar(200) DEFAULT NULL,
  `speaker` varchar(200) DEFAULT NULL,
  `sermon_title` varchar(200) DEFAULT NULL,
  `sermon_content` varchar(200) DEFAULT NULL,
  `place` varchar(200) DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time NOT NULL,
  `speaker_contact` varchar(200) DEFAULT NULL,
  `service_environtment` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ibadah`
--

INSERT INTO `tb_ibadah` (`worship_id`, `category_id`, `speaker`, `sermon_title`, `sermon_content`, `place`, `sermon_date`, `time`, `speaker_contact`, `service_environtment`, `created_at`, `updated_at`) VALUES
('10010', 'IBD/IBKB/2022', 'Pdt. Ani', 'MASA PANDEMI MEMBANGKITKAN SEMANGAT', 'lfdlasdfjalkdsjf;lk', 'GBI Rock', '2011-12-02 00:00:00', '17:15:00', '0813198491', '-', '2022-09-05 17:59:32', '2022-09-11 10:21:23'),
('sdfsadf', 'IBD/IBKI/2022', 'kjh', 'kjh', 'lksfdasfd', 'jhlk', '2021-11-29 00:00:00', '00:00:00', 'kjhk', '3', '2022-09-16 08:51:36', '2022-09-16 08:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kartu_keluarga`
--

CREATE TABLE `tb_kartu_keluarga` (
  `familyCard_id` varchar(200) NOT NULL,
  `family_headName` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `RTRW` varchar(30) DEFAULT NULL,
  `zipCode` varchar(30) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kartu_keluarga`
--

INSERT INTO `tb_kartu_keluarga` (`familyCard_id`, `family_headName`, `address`, `RTRW`, `zipCode`, `photo`, `created_at`, `updated_at`) VALUES
('000000101010101', 'HAHAHAHAHAh', 'Pontianak', '001/003', '810819', 'Photo/000000101010101.09.2022..png', '2022-09-13 10:14:50', '2022-09-13 10:14:50'),
('1010101011010', 'TESTING', 'Pontianak', '10/11', '09809', 'Photo/1010101011010.09.2022..png', '2022-09-13 10:08:00', '2022-09-13 10:08:00'),
('657498798', 'MALAA', 'LLLL', '987', '9798', 'Photo/657498798.09.2022..png', '2022-09-13 10:26:49', '2022-09-13 10:30:55'),
('ij', 'iojjl', 'kjlk', 'jlkj', 'lkjl', 'Photo/ij.09.2022..png', '2022-09-17 09:09:46', '2022-09-17 09:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_alkitab`
--

CREATE TABLE `tb_kategori_alkitab` (
  `bibleCategory_id` varchar(200) NOT NULL,
  `bible` varchar(200) DEFAULT NULL,
  `isChanged` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_event`
--

CREATE TABLE `tb_kategori_event` (
  `eventCategory_id` varchar(200) NOT NULL,
  `event` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_event`
--

INSERT INTO `tb_kategori_event` (`eventCategory_id`, `event`, `created_at`, `updated_at`) VALUES
('EVT/HRFG', 'Hari Reformasi Gereja', '2022-09-12 15:25:25', '2022-09-12 15:25:25'),
('EVT/HUT/GM', 'HUT Gerja Mula', '2022-09-12 15:26:17', '2022-09-12 15:26:17'),
('EVT/HUT/GMIH', 'HUT GMIH', '2022-09-12 15:25:25', '2022-09-12 15:25:25'),
('EVT/HUT/GS', 'Hut Gereja SION', '2022-09-12 15:24:28', '2022-09-12 15:24:28'),
('EVT/HUT/RP', 'HUT Rumah Pastori', '2022-09-12 15:24:28', '2022-09-12 15:24:28'),
('EVT/PRKDS', 'Perjamuan Kudus', '2022-09-12 15:25:58', '2022-09-12 15:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_ibadah`
--

CREATE TABLE `tb_kategori_ibadah` (
  `category_id` varchar(200) NOT NULL,
  `category` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_ibadah`
--

INSERT INTO `tb_kategori_ibadah` (`category_id`, `category`, `created_at`, `updated_at`) VALUES
('IBD/IBASM/2022', 'Ibadah Anak Sekolah Minggu', '2022-08-27 22:56:53', '2022-08-27 22:56:53'),
('IBD/IBKB/2022', 'Ibadah Kaum Bapak', '2022-08-27 22:58:16', '2022-09-07 12:09:37'),
('IBD/IBKI/2022', 'Ibadah Kaum Ibu', '2022-08-27 22:58:16', '2022-08-27 22:58:16'),
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
  `serviceCategory_id` varchar(200) NOT NULL,
  `service` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_pelayanan`
--

INSERT INTO `tb_kategori_pelayanan` (`serviceCategory_id`, `service`, `created_at`, `updated_at`) VALUES
('SC/09/2022/1', 'Majelis Ibadah Minggu', '2022-09-17 14:54:28', '2022-09-17 14:54:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_khadim`
--

CREATE TABLE `tb_khadim` (
  `khadim_id` varchar(200) DEFAULT NULL,
  `serviceCategory_id` varchar(200) DEFAULT NULL,
  `theme` varchar(200) DEFAULT NULL,
  `khadim` varchar(200) DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_khadim`
--

INSERT INTO `tb_khadim` (`khadim_id`, `serviceCategory_id`, `theme`, `khadim`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('KHDM/09/2022/1', '', 'Berkat Tuhan Di hari ini', 'Pdt. EranA', '2022-09-17 00:00:00', '16:39:00', '2022-09-17 09:42:58', '2022-09-17 09:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `tb_majelis_ibadah_minggu`
--

CREATE TABLE `tb_majelis_ibadah_minggu` (
  `assembly_id` varchar(200) NOT NULL,
  `serviceCategory_id` varchar(200) DEFAULT NULL,
  `assembly` varchar(200) DEFAULT NULL,
  `coordinator` varchar(200) DEFAULT NULL,
  `khadim_companion` varchar(200) DEFAULT NULL,
  `uniform` varchar(200) DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_majelis_ibadah_minggu`
--

INSERT INTO `tb_majelis_ibadah_minggu` (`assembly_id`, `serviceCategory_id`, `assembly`, `coordinator`, `khadim_companion`, `uniform`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('SER/09/2022/1', '', 'TEST', 'lkjlk', 'lkjl', 'jlkjlk', '2022-12-31 00:00:00', '11:00:00', '2022-09-17 08:27:30', '2022-09-17 08:35:01'),
('SER/09/2022/2', '', 'lkjl', 'jlkj', 'lkj', 'lkjlk', '2022-12-31 00:00:00', '23:59:00', '2022-09-17 08:38:06', '2022-09-17 08:38:06'),
('SER/09/2022/3', '', 'kjh', 'kjhk', 'jhkj', 'hkjh', '2022-12-31 00:00:00', '23:59:00', '2022-09-17 08:42:18', '2022-09-17 08:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemusik`
--

CREATE TABLE `tb_pemusik` (
  `musician_id` varchar(200) DEFAULT NULL,
  `serviceCategory_id` varchar(200) DEFAULT NULL,
  `projector` varchar(200) DEFAULT NULL,
  `infocus` varchar(200) DEFAULT NULL,
  `keyboard` varchar(200) DEFAULT NULL,
  `prokantor` varchar(200) DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penataan_bunga`
--

CREATE TABLE `tb_penataan_bunga` (
  `flowerArrangement_id` varchar(200) DEFAULT NULL,
  `serviceCategory_id` varchar(200) DEFAULT NULL,
  `mothersOnDuty` varchar(200) DEFAULT NULL,
  `coordinator` varchar(200) DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penataan_bunga`
--

INSERT INTO `tb_penataan_bunga` (`flowerArrangement_id`, `serviceCategory_id`, `mothersOnDuty`, `coordinator`, `sermon_date`, `time`, `created_at`, `updated_at`) VALUES
('FLW/09/2022/1', '', 'lskadfjlks', 'TEST', '2022-12-31 00:00:00', '03:02:00', '2022-09-17 10:17:23', '2022-09-17 10:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penerima_baru`
--

CREATE TABLE `tb_penerima_baru` (
  `welcoming_id` varchar(200) DEFAULT NULL,
  `serviceCategory_id` varchar(200) DEFAULT NULL,
  `welcomer` varchar(200) DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pujian`
--

CREATE TABLE `tb_pujian` (
  `singing_id` varchar(200) DEFAULT NULL,
  `serviceCategory_id` varchar(200) DEFAULT NULL,
  `singer` varchar(200) DEFAULT NULL,
  `sermon_date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_temp_dtl_kartu_keluarga`
--

CREATE TABLE `tb_temp_dtl_kartu_keluarga` (
  `number` int(200) NOT NULL,
  `familyCard_id` varchar(200) DEFAULT NULL,
  `fullName` varchar(200) DEFAULT NULL,
  `NIK` varchar(200) DEFAULT NULL,
  `gender` varbinary(30) DEFAULT NULL,
  `place_ofBirth` varchar(200) DEFAULT NULL,
  `date_ofBirth` datetime DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `education` varchar(30) DEFAULT NULL,
  `job` varchar(200) DEFAULT NULL,
  `blood` varchar(30) DEFAULT NULL,
  `marriage` varchar(30) DEFAULT NULL,
  `date_ofMarriage` datetime DEFAULT NULL,
  `family_status` varchar(30) DEFAULT NULL,
  `citizenship` varchar(200) DEFAULT NULL,
  `paspor` varchar(200) DEFAULT NULL,
  `fatherName` varchar(200) DEFAULT NULL,
  `motherName` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `remember_token` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `name`, `email`, `username`, `phone`, `password`, `gender`, `picture`, `level`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', 'Admin', '081347748346', '$2y$10$2qdXXqIZHEl5Xutj5eK7Nez6nsuNmNd/ZQSgV0.tt6s0du5emTkkC', 'Male', NULL, 'Admin', 'OFFLINE', NULL, '2022-08-24 23:57:05', '2022-08-24 23:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
-- Indexes for table `tb_majelis_ibadah_minggu`
--
ALTER TABLE `tb_majelis_ibadah_minggu`
  ADD PRIMARY KEY (`assembly_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_dtl_kartu_keluarga`
--
ALTER TABLE `tb_dtl_kartu_keluarga`
  MODIFY `number` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_temp_dtl_kartu_keluarga`
--
ALTER TABLE `tb_temp_dtl_kartu_keluarga`
  MODIFY `number` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
sionwkosionwko