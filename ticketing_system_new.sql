-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 02:01 AM
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
-- Database: `ticketing_system_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `show_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `final_total` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `show_id`, `order_date`, `total_harga`, `created_at`, `updated_at`, `payment_type_id`, `discount_id`, `discount_amount`, `final_total`) VALUES
(1, 2, 1, '2026-01-10 14:30:00', 7500000.00, '2026-01-23 11:11:54', '2026-01-25 07:10:53', NULL, NULL, 0.00, 0.00),
(2, 2, 3, '2026-01-12 16:00:00', 1200000.00, '2026-01-23 11:11:54', '2026-01-25 07:10:53', NULL, NULL, 0.00, 0.00),
(3, 2, 1, '2026-01-23 18:20:07', 40000000.00, '2026-01-23 11:20:07', '2026-01-23 11:20:07', NULL, NULL, 0.00, 0.00),
(4, 2, 1, '2026-01-23 19:38:45', 35000000.00, '2026-01-23 12:38:45', '2026-01-23 12:38:45', NULL, NULL, 0.00, 0.00),
(5, 2, 1, '2026-01-25 14:37:23', 35000000.00, '2026-01-25 07:37:23', '2026-01-25 07:37:23', NULL, NULL, 0.00, 0.00),
(6, 2, 2, '2026-01-25 18:32:47', 450000.00, '2026-01-25 11:32:47', '2026-01-25 11:32:47', 7, NULL, 0.00, 0.00),
(7, 2, 2, '2026-01-26 18:15:48', 1200000.00, '2026-01-26 11:15:48', '2026-01-26 11:15:48', 8, NULL, 0.00, 0.00),
(8, 2, 1, '2026-01-27 06:11:28', 15000000.00, '2026-01-26 23:11:28', '2026-01-26 23:11:28', 4, NULL, 0.00, 15000000.00),
(9, 2, 3, '2026-01-27 06:15:57', 400000.00, '2026-01-26 23:15:57', '2026-01-26 23:15:57', 3, 1, 80000.00, 320000.00),
(10, 2, 1, '2026-01-27 06:21:21', 60000000.00, '2026-01-26 23:21:21', '2026-01-26 23:21:21', 4, 1, 12000000.00, 48000000.00),
(11, 2, 3, '2026-01-27 06:24:18', 400000.00, '2026-01-26 23:24:18', '2026-01-26 23:24:18', 3, 2, 25.00, 399975.00),
(12, 2, 3, '2026-01-27 06:28:46', 400000.00, '2026-01-26 23:28:46', '2026-01-26 23:28:46', 8, 2, 100000.00, 300000.00),
(13, 2, 1, '2026-01-27 06:29:23', 25000000.00, '2026-01-26 23:29:23', '2026-01-26 23:29:23', 9, 1, 5000000.00, 20000000.00),
(14, 2, 2, '2026-01-28 02:44:20', 1200000.00, '2026-01-27 19:44:20', '2026-01-27 19:44:20', 1, 3, 480000.00, 720000.00);

-- --------------------------------------------------------

--
-- Table structure for table `booking_items`
--

CREATE TABLE `booking_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `pass_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal_harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_items`
--

INSERT INTO `booking_items` (`id`, `booking_id`, `pass_id`, `jumlah`, `subtotal_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 7500000.00, '2026-01-23 11:11:54', '2026-01-25 07:10:53'),
(2, 2, 6, 3, 1200000.00, '2026-01-23 11:11:54', '2026-01-25 07:10:53'),
(3, 3, 9, 1, 15000000.00, '2026-01-23 11:20:07', '2026-01-23 11:20:07'),
(4, 3, 10, 1, 25000000.00, '2026-01-23 11:20:07', '2026-01-23 11:20:07'),
(5, 4, 11, 1, 35000000.00, '2026-01-23 12:38:45', '2026-01-23 12:38:45'),
(6, 5, 11, 1, 35000000.00, '2026-01-25 07:37:23', '2026-01-25 07:37:23'),
(7, 6, 4, 1, 450000.00, '2026-01-25 11:32:47', '2026-01-25 11:32:47'),
(8, 7, 3, 1, 1200000.00, '2026-01-26 11:15:48', '2026-01-26 11:15:48'),
(9, 8, 9, 1, 15000000.00, '2026-01-26 23:11:28', '2026-01-26 23:11:28'),
(10, 9, 6, 1, 400000.00, '2026-01-26 23:15:57', '2026-01-26 23:15:57'),
(11, 10, 10, 1, 25000000.00, '2026-01-26 23:21:21', '2026-01-26 23:21:21'),
(12, 10, 11, 1, 35000000.00, '2026-01-26 23:21:21', '2026-01-26 23:21:21'),
(13, 11, 6, 1, 400000.00, '2026-01-26 23:24:18', '2026-01-26 23:24:18'),
(14, 12, 6, 1, 400000.00, '2026-01-26 23:28:46', '2026-01-26 23:28:46'),
(15, 13, 10, 1, 25000000.00, '2026-01-26 23:29:23', '2026-01-26 23:29:23'),
(16, 14, 3, 1, 1200000.00, '2026-01-27 19:44:20', '2026-01-27 19:44:20');

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
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `show_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `show_id`, `nama`, `type`, `value`, `start_at`, `end_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Black Friday', 'percent', 20.00, '2026-01-27 06:00:00', '2026-01-28 09:00:00', 1, '2026-01-26 21:47:05', '2026-01-26 23:27:34'),
(2, NULL, 'Samurai Heart', 'fixed', 100000.00, '2026-01-27 00:00:00', '2026-01-28 07:00:00', 1, '2026-01-26 21:49:56', '2026-01-26 23:28:09'),
(3, 2, 'Festival New Year', 'percent', 40.00, '2026-01-28 02:00:00', '2026-01-28 05:00:00', 1, '2026-01-27 19:43:46', '2026-01-27 19:43:46');

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
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Heavy Metal', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(2, 'Metalcore', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(3, 'Nu Metal', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(4, 'Hard Rock', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(5, 'Post-Hardcore', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(6, 'Alternative', '2026-01-23 11:11:54', '2026-01-23 11:11:54');

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
(4, '2026_01_12_182723_create_genres_table', 1),
(5, '2026_01_12_182733_create_shows_table', 1),
(6, '2026_01_12_182742_create_pass_types_table', 1),
(7, '2026_01_12_182743_create_passes_table', 1),
(8, '2026_01_12_182750_create_bookings_table', 1),
(9, '2026_01_12_182759_create_booking_items_table', 1),
(10, '2026_01_14_153010_add_unique_show_tipe_to_passes_table', 1),
(11, '2026_01_14_185124_add_unique_judul_to_shows_table', 1),
(12, '2026_01_24_151003_create_payment_types_table', 2),
(13, '2026_01_25_165936_add_payment_type_id_to_bookings_table', 3),
(14, '2026_01_26_213349_create_discounts_table', 4),
(15, '2026_01_26_223448_add_discount_fields_to_bookings_table', 4),
(16, '2026_01_28_021514_add_show_id_to_discounts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `passes`
--

CREATE TABLE `passes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `show_id` bigint(20) UNSIGNED NOT NULL,
  `pass_type_id` bigint(20) UNSIGNED NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passes`
--

INSERT INTO `passes` (`id`, `show_id`, `pass_type_id`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1500000.00, 100, '2026-01-23 11:11:54', '2026-01-25 07:10:53'),
(2, 1, 1, 500000.00, 500, '2026-01-23 11:11:54', '2026-01-25 07:10:53'),
(3, 2, 2, 1200000.00, 118, '2026-01-23 11:11:54', '2026-01-27 19:44:20'),
(4, 2, 1, 450000.00, 599, '2026-01-23 11:11:54', '2026-01-25 11:32:47'),
(5, 3, 2, 1000000.00, 150, '2026-01-23 11:11:54', '2026-01-25 07:10:53'),
(6, 3, 1, 400000.00, 697, '2026-01-23 11:11:54', '2026-01-26 23:28:46'),
(9, 1, 3, 15000000.00, 8, '2026-01-23 11:17:58', '2026-01-26 23:11:28'),
(10, 1, 4, 25000000.00, 2, '2026-01-23 11:19:24', '2026-01-26 23:29:23'),
(11, 1, 5, 35000000.00, 5, '2026-01-23 12:38:15', '2026-01-26 23:21:21');

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
-- Table structure for table `pass_types`
--

CREATE TABLE `pass_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pass_types`
--

INSERT INTO `pass_types` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'regular', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(2, 'premium', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(3, 'vip', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(4, 'early bird', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(5, 'vvip', '2026-01-23 12:37:35', '2026-01-23 12:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'dana', '2026-01-25 07:24:22', '2026-01-25 07:24:22'),
(3, 'go-pay', '2026-01-25 07:24:22', '2026-01-25 07:24:22'),
(4, 'paypal', '2026-01-25 07:24:22', '2026-01-25 07:24:22'),
(7, 'bank bca', '2026-01-25 07:33:53', '2026-01-25 07:33:53'),
(8, 'bank bni', '2026-01-25 07:34:00', '2026-01-25 07:34:12'),
(9, 'ovo', '2026-01-25 07:34:27', '2026-01-25 07:34:27');

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
('iyRLhh4VM67VA8j7pypMTp2ODTNP6oxhzJTlo13f', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMTBXV2tQQTNlUkpCUDJWQnVqbDJnTUdjWDFKUEd0MGp6UzVWbGJLeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ib29raW5ncy8xNCI7czo1OiJyb3V0ZSI7czoxMzoiYm9va2luZ3Muc2hvdyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1769543068),
('nBXD7PYuJzDF6iumeyQT5v8oC079rz6DHCSsGuSJ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieUdQY1lLaVRidUF3R1lQOUFYbVhVMTI4dGFYb1NTTDZRcjhGZ3NaTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ib29raW5ncy8xMyI7czo1OiJyb3V0ZSI7czoxMzoiYm9va2luZ3Muc2hvdyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1769470171);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `genre_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `user_id`, `genre_id`, `judul`, `deskripsi`, `lokasi`, `tanggal_waktu`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Heavy Metal Night', 'Malam penuh distorsi dan riff berat bersama line-up band pilihan.', 'Stadion Utama', '2026-02-22 19:00:00', 'shows/heavy_metal_night.jpg', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(2, 1, 2, 'Metalcore Breakdown Fest', 'Breakdown, moshpit, dan energi brutal untuk pecinta Metalcore.', 'Hall Concert City', '2026-03-08 19:30:00', 'shows/metalcore_breakdown_fest.jpg', '2026-01-23 11:11:54', '2026-01-23 11:11:54'),
(3, 1, 3, 'Nu Metal Reunion', 'Nu Metal klasik dengan nuansa nostalgia dan setlist yang memompa adrenalin.', 'Outdoor Arena', '2026-03-29 20:00:00', 'shows/nu_metal_reunion.jpg', '2026-01-23 11:11:54', '2026-01-23 11:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `no_hp`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@gmail.com', NULL, 'admin', NULL, '$2y$12$h7YoTIOTqPouCSDvGZVICu0QqP46NmvIK6WkRWtto7O1saLy8169e', NULL, '2026-01-23 11:11:54', '2026-01-25 07:10:52'),
(2, 'Regular User', 'user@gmail.com', '081234567890', 'user', NULL, '$2y$12$n9C/2LWCjMyPMwB1WRXo2OcUp4uZPmtlOrm2ty5a0BtVnUD9h.u96', NULL, '2026-01-23 11:11:54', '2026-01-25 07:10:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_show_id_foreign` (`show_id`),
  ADD KEY `bookings_payment_type_id_foreign` (`payment_type_id`),
  ADD KEY `bookings_discount_id_foreign` (`discount_id`);

--
-- Indexes for table `booking_items`
--
ALTER TABLE `booking_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_items_booking_id_foreign` (`booking_id`),
  ADD KEY `booking_items_pass_id_foreign` (`pass_id`);

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
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_show_id_foreign` (`show_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genres_nama_unique` (`nama`);

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
-- Indexes for table `passes`
--
ALTER TABLE `passes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `passes_show_id_pass_type_id_unique` (`show_id`,`pass_type_id`),
  ADD KEY `passes_pass_type_id_foreign` (`pass_type_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pass_types`
--
ALTER TABLE `pass_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pass_types_nama_unique` (`nama`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_types_nama_unique` (`nama`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shows_judul_unique` (`judul`),
  ADD KEY `shows_user_id_foreign` (`user_id`),
  ADD KEY `shows_genre_id_foreign` (`genre_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `booking_items`
--
ALTER TABLE `booking_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `passes`
--
ALTER TABLE `passes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pass_types`
--
ALTER TABLE `pass_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`),
  ADD CONSTRAINT `bookings_show_id_foreign` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_items`
--
ALTER TABLE `booking_items`
  ADD CONSTRAINT `booking_items_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_items_pass_id_foreign` FOREIGN KEY (`pass_id`) REFERENCES `passes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_show_id_foreign` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `passes`
--
ALTER TABLE `passes`
  ADD CONSTRAINT `passes_pass_type_id_foreign` FOREIGN KEY (`pass_type_id`) REFERENCES `pass_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `passes_show_id_foreign` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
