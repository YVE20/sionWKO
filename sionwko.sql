-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2022 at 07:11 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_jemaat`
--

CREATE TABLE `tb_data_jemaat` (
  `congregation_id` varchar(200) NOT NULL,
  `baptism_id` varchar(200) DEFAULT NULL,
  `sidi_id` varchar(200) DEFAULT NULL,
  `familyCard_id` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `updaetd_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `speaker_contact` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ibadah`
--

INSERT INTO `tb_ibadah` (`worship_id`, `category_id`, `speaker`, `sermon_title`, `sermon_content`, `place`, `sermon_date`, `speaker_contact`, `created_at`, `updated_at`) VALUES
('jklj', 'IBD/IBKB/2022', 'lk;j', 'lkjlk;j', 'lkjlkj', NULL, '2022-12-31 00:00:00', 'lkjlk', '2022-08-28 07:40:09', '2022-08-28 07:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kartu_keluarga`
--

CREATE TABLE `tb_kartu_keluarga` (
  `familyCard_id` varchar(200) NOT NULL,
  `family_headName` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `RT/RW` varchar(30) DEFAULT NULL,
  `zipCode` varchar(30) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('IBD/IBKB/2022', 'Ibadah Kaum Bapak', '2022-08-27 22:58:16', '2022-08-27 22:58:16'),
('IBD/IBKI/2022', 'Ibadah Kaum Ibu', '2022-08-27 22:58:16', '2022-08-27 22:58:16'),
('IBD/IBLP/2022', 'Ibadah Lingkungan Pelayan', '2022-08-27 22:58:55', '2022-08-27 22:58:55'),
('IBD/IBM/2022', 'Ibadah Minggu', '2022-08-27 22:56:53', '2022-08-27 22:56:53'),
('IBD/IBMG/2022', 'Ibadah Minggu Gembira', '2022-08-27 22:58:55', '2022-08-27 22:58:55'),
('IBD/IBP/2022', 'Ibadah Pemuda', '2022-08-27 22:57:40', '2022-08-27 22:57:40'),
('IBD/IBR/2022', 'Ibadah Remaja', '2022-08-27 22:57:40', '2022-08-27 22:57:40');

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
(1, 'Yearico Vio Euaggelion', 'euaggeliony28@gmail.com', 'YVE20', '081347748346', '123', 'Male', NULL, 'Admin', 'OFFLINE', NULL, '2022-08-24 23:57:05', '2022-08-24 23:57:05');

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
