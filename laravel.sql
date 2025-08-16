-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2025 pada 09.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `last_seen_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `is_active`, `last_login_at`, `remember_token`, `created_at`, `updated_at`, `is_online`, `last_seen_at`) VALUES
(1, 'Super Admin', 'admin@boscuan.com', '2025-08-03 00:03:55', '$2y$12$UJO251nStp9NXSfr72/woOxQ2kcQJvvrZ1zCOZ37IQiFEAakAoL62', 'super_admin', 1, '2025-08-04 10:44:09', NULL, '2025-08-03 00:03:55', '2025-08-04 10:56:51', 1, '2025-08-04 10:56:51'),
(2, 'Admin Boscuan', 'staff@boscuan.com', '2025-08-03 00:03:55', '$2y$12$oem1Tlig.yUyjbiDoVxUeumClNT7hQVWuoxpbk4ZkL6kH18/5.BeO', 'admin', 1, NULL, NULL, '2025-08-03 00:03:55', '2025-08-03 00:03:55', 0, NULL),
(3, 'Demo Admin', 'demo@boscuan.com', '2025-08-03 00:03:56', '$2y$12$KixCP3Q29OeQq4hyXjRbEekyxCnTaRVVz1xXYsE0ud457wiSzegn2', 'admin', 1, NULL, NULL, '2025-08-03 00:03:56', '2025-08-03 00:03:56', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banners`
--

INSERT INTO `banners` (`id`, `image`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'banners/XRcsTo8YUjSC8TW6eVCn5DHGfdmcBPbIPzN9f0sU.png', 1, 1, '2025-08-03 00:35:03', '2025-08-04 10:09:02'),
(2, 'banners/jxd9ZkaD4vxI7Gx1tu4O4XafpYge6PRHR0awO0fd.jpg', 2, 1, '2025-08-03 00:35:24', '2025-08-03 00:35:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#00FFFF',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image_url`, `icon`, `color`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Slot', 'slot', '', 'fas fa-gamepad', '#00FFFF', 1, 1, '2025-08-03 00:03:56', '2025-08-03 00:17:08'),
(2, 'Togel', 'togel', '', 'fas fa-dice-six', '#FF0080', 1, 2, '2025-08-03 00:03:56', '2025-08-03 00:09:53'),
(3, 'Casino', 'casino', '', 'fas fa-dice', '#FFD700', 1, 3, '2025-08-03 00:03:56', '2025-08-03 00:19:35'),
(4, 'Sports', 'sports', '', 'fas fa-futbol', '#8B00FF', 1, 4, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(5, 'Arcade', 'arcade', '', 'fas fa-rocket', '#FF6B35', 1, 5, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(6, 'Crash-Game', 'crash-game', '', 'fas fa-chart-line', '#FF4757', 1, 6, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(7, 'Poker', 'poker', '', 'fa-solid fa-puzzle-piece', '#ff3742', 1, 7, '2025-08-03 00:03:56', '2025-08-03 00:33:16'),
(8, 'E-Sports', 'e-sports', '', 'fas fa-headset', '#5352ED', 1, 8, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(9, 'Sabung Ayam', 'sabung-ayam', '', 'fas fa-feather-alt', '#FFA502', 1, 9, '2025-08-03 00:03:56', '2025-08-03 00:03:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` enum('active','closed','waiting') DEFAULT 'waiting',
  `priority` varchar(255) NOT NULL DEFAULT 'medium',
  `last_message_at` timestamp NULL DEFAULT NULL,
  `has_unread_admin` tinyint(1) NOT NULL DEFAULT 0,
  `has_unread_user` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `chats`
--

INSERT INTO `chats` (`id`, `user_id`, `admin_id`, `guest_name`, `guest_email`, `subject`, `title`, `status`, `priority`, `last_message_at`, `has_unread_admin`, `has_unread_user`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:03:54', '2025-08-03 06:03:54'),
(2, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:04:54', '2025-08-03 06:04:54'),
(3, NULL, NULL, 'bbgusddnmdw', 'adwadwdww@gmail.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:05:12', '2025-08-03 06:05:12'),
(4, NULL, NULL, 'bbgusddnmdw', 'adwadwdww@gmail.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:05:16', '2025-08-03 06:05:16'),
(5, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:05:32', '2025-08-03 06:05:32'),
(6, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:08:07', '2025-08-03 06:08:07'),
(7, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:08:17', '2025-08-03 06:08:17'),
(8, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:09:27', '2025-08-03 06:09:27'),
(9, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:13:01', '2025-08-03 06:13:01'),
(10, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:13:53', '2025-08-03 06:13:53'),
(11, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:14:42', '2025-08-03 06:14:42'),
(12, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:17:04', '2025-08-03 06:17:04'),
(13, NULL, NULL, '111', '222@gmail.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:17:13', '2025-08-03 06:17:13'),
(14, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:17:44', '2025-08-03 06:17:44'),
(15, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:18:15', '2025-08-03 06:18:15'),
(16, NULL, NULL, '111', '222@gmail.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:18:27', '2025-08-03 06:18:27'),
(17, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:23:14', '2025-08-03 06:23:14'),
(18, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:23:34', '2025-08-03 06:23:34'),
(19, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:23:48', '2025-08-03 06:23:48'),
(20, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:24:06', '2025-08-03 06:24:06'),
(21, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:25:21', '2025-08-03 06:25:21'),
(22, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:25:38', '2025-08-03 06:25:38'),
(23, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:25:58', '2025-08-03 06:25:58'),
(24, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:26:11', '2025-08-03 06:26:11'),
(25, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:26:15', '2025-08-03 06:26:15'),
(26, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:26:26', '2025-08-03 06:26:26'),
(27, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:35:38', '2025-08-03 06:35:38'),
(28, NULL, NULL, 'baa', '2aa22@gmail.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:35:44', '2025-08-03 06:35:44'),
(29, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:47:42', '2025-08-03 06:47:42'),
(30, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:48:12', '2025-08-03 06:48:12'),
(31, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:48:23', '2025-08-03 06:48:23'),
(32, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:48:34', '2025-08-03 06:48:34'),
(33, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:48:50', '2025-08-03 06:48:50'),
(34, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:49:14', '2025-08-03 06:49:14'),
(35, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:52:18', '2025-08-03 06:52:18'),
(36, NULL, NULL, 'awddw', 'wadawdwa@gmail.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 06:52:42', '2025-08-03 06:52:42'),
(37, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 07:48:42', '2025-08-03 07:48:42'),
(38, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 07:48:53', '2025-08-03 07:48:53'),
(39, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 07:49:24', '2025-08-03 07:49:24'),
(40, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 07:49:38', '2025-08-03 07:49:38'),
(41, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 07:50:14', '2025-08-03 07:50:14'),
(42, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 07:50:42', '2025-08-03 07:50:42'),
(43, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 08:06:02', '2025-08-03 08:06:02'),
(44, NULL, NULL, 'wdw', 'awddawdw@gmail.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 08:06:50', '2025-08-03 08:06:50'),
(45, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 08:07:45', '2025-08-03 08:07:45'),
(46, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 08:12:38', '2025-08-03 08:12:38'),
(47, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 08:14:00', '2025-08-03 08:14:00'),
(48, NULL, NULL, 'Test User', 'test@example.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 08:14:02', '2025-08-03 08:14:02'),
(49, NULL, NULL, 'fe', '222@gmail.com', NULL, NULL, 'waiting', 'medium', NULL, 0, 0, '2025-08-03 08:14:17', '2025-08-03 08:14:17'),
(50, NULL, NULL, 'awdd', 'wwwdaaw@gmail.com', NULL, NULL, 'active', 'medium', '2025-08-03 08:31:48', 0, 0, '2025-08-03 08:31:42', '2025-08-03 08:31:48'),
(51, NULL, NULL, 'bgusrmdnn', 'busrmdn@gmail.com', NULL, NULL, 'active', 'medium', '2025-08-03 08:42:00', 0, 0, '2025-08-03 08:41:52', '2025-08-03 08:42:00'),
(52, NULL, NULL, 'ess', '222@gmail.com', NULL, NULL, 'active', 'medium', '2025-08-03 08:44:10', 0, 0, '2025-08-03 08:43:59', '2025-08-03 08:44:10'),
(53, NULL, NULL, 'bgusremdn', 'adwadwad@gmail.com', NULL, NULL, 'active', 'medium', '2025-08-03 22:45:28', 0, 0, '2025-08-03 22:20:34', '2025-08-03 22:45:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `is_new` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `game_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `games`
--

INSERT INTO `games` (`id`, `name`, `slug`, `image_url`, `provider_id`, `category_id`, `is_popular`, `is_new`, `is_active`, `sort_order`, `game_url`, `created_at`, `updated_at`) VALUES
(11, 'Gates Of Olympus', 'gates-of-olympus-1754237335', 'https://img.viva88athenae.com/pp/images/vs20alieninv.png', 1, 1, 1, 0, 1, 0, NULL, '2025-08-03 09:08:55', '2025-08-03 09:20:00'),
(17, 'Gates of Olympus 1000', 'gates-of-olympus-1000-1754238901', 'https://img.viva88athenae.com/pp/images/vs20olympx.png', 1, 1, 1, 0, 1, 2, NULL, '2025-08-03 09:35:01', '2025-08-03 09:37:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` varchar(255) NOT NULL,
  `sender_id` bigint(20) DEFAULT NULL,
  `message` text NOT NULL,
  `type` enum('text','image','file') NOT NULL DEFAULT 'text',
  `file_path` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `chat_id`, `sender_type`, `sender_id`, `message`, `type`, `file_path`, `file_name`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(54, 53, 'guest', NULL, 'kak', 'text', NULL, NULL, 1, '2025-08-03 22:27:17', '2025-08-03 22:26:30', '2025-08-03 22:27:17'),
(55, 53, 'admin', 1, 'iya kak', 'text', NULL, NULL, 0, NULL, '2025-08-03 22:27:20', '2025-08-03 22:27:20'),
(56, 53, 'admin', 1, 'gjjff', 'text', NULL, NULL, 0, NULL, '2025-08-03 22:34:31', '2025-08-03 22:34:31'),
(57, 53, 'admin', 1, 'halo kak', 'text', NULL, NULL, 0, NULL, '2025-08-03 22:45:28', '2025-08-03 22:45:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_02_132315_create_admins_table', 1),
(5, '2025_08_02_140107_modify_users_table_add_new_fields', 1),
(6, '2025_08_02_153521_create_chats_table', 1),
(7, '2025_08_02_153528_create_messages_table', 1),
(8, '2025_08_02_153611_add_online_status_to_admins_and_users_tables', 1),
(9, '2025_08_02_165241_create_banners_table', 1),
(10, '2025_08_02_174109_update_banners_table_remove_unnecessary_fields', 1),
(11, '2025_08_02_181040_create_settings_table', 1),
(12, '2025_08_03_052646_create_providers_table', 1),
(13, '2025_08_03_052651_create_categories_table', 1),
(14, '2025_08_03_052655_create_games_table', 1),
(15, '2025_08_03_062543_remove_type_from_games_table', 1),
(16, '2025_08_03_064939_remove_unnecessary_fields_from_games_table', 1),
(17, '2025_08_03_064944_remove_unnecessary_fields_from_providers_table', 1),
(18, '2025_08_03_071149_remove_description_from_categories_table', 2),
(19, '2025_08_03_093233_add_gif_banner_to_settings_table', 3),
(20, '2025_08_03_124949_add_guest_fields_to_chats_table', 4),
(21, '2025_08_03_125021_add_sender_fields_to_messages_table', 4),
(22, '2025_08_03_130327_make_user_id_nullable_in_chats_table', 5),
(23, '2025_08_03_131310_update_messages_table_make_sender_id_nullable', 6),
(24, '2025_08_03_161347_fix_chats_status_enum_only', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `providers`
--

INSERT INTO `providers` (`id`, `name`, `slug`, `logo_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Pragmatic Play', 'pragmatic-play', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 1, '2025-08-03 00:03:56', '2025-08-03 22:13:57'),
(2, 'Pgsoft', 'pgsoft', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 2, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(3, 'Habanero', 'habanero', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 3, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(4, 'Jili', 'jili', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 4, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(5, 'Spadegaming', 'spadegaming', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 5, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(6, '5g', '5g', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 6, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(7, 'Joker', 'joker', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 7, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(8, 'Microgaming', 'microgaming', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 8, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(9, 'Hacksaw', 'hacksaw', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 9, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(10, 'Fastspin', 'fastspin', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 10, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(11, 'NoLimit', 'nolimit', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 11, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(12, 'Playstar', 'playstar', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 12, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(13, 'Playtech', 'playtech', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 13, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(14, 'Advant', 'advant', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 14, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(15, 'Live22', 'live22', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 15, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(16, 'CQ9', 'cq9', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 16, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(17, '8 Gaming Togel', '8-gaming-togel', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 17, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(18, 'Dreamgaming', 'dreamgaming', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 18, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(19, 'CG', 'cg', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 19, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(20, 'Playtech gaming', 'playtech-gaming', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 20, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(21, 'SA', 'sa', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 21, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(22, 'Via Casino', 'via-casino', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 22, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(23, 'world', 'world', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 23, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(24, 'Sbobet', 'sbobet', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 24, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(25, 'Cmd368', 'cmd368', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 25, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(26, 'SABA Sports', 'saba-sports', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 26, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(27, 'Pg', 'pg', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 27, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(28, 'R88', 'r88', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 28, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(29, 'evo', 'evo', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 29, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(30, 'cq', 'cq', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 30, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(31, 'hack', 'hack', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 31, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(32, 'kagaming', 'kagaming', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 32, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(33, 'jilli', 'jilli', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 33, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(34, 'micro', 'micro', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 34, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(35, 'pramgatic', 'pramgatic', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 35, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(36, 'jokker', 'jokker', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 36, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(37, 'jil', 'jil', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 37, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(38, 'miccrogaming', 'miccrogaming', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 38, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(39, 'etg', 'etg', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 39, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(40, 'kingmidas', 'kingmidas', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 40, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(41, 'miki', 'miki', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 41, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(42, 'jilllli', 'jilllli', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=150&h=80&fit=crop', 1, 42, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(43, 'tfgaming', 'tfgaming', 'https://images.unsplash.com/photo-1518009124462-91af1ba7c5ee?w=150&h=80&fit=crop', 1, 43, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(44, 'sv388', 'sv388', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=80&fit=crop', 1, 44, '2025-08-03 00:03:56', '2025-08-03 00:03:56'),
(45, 'ga2', 'ga2', 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=150&h=80&fit=crop', 1, 45, '2025-08-03 00:03:56', '2025-08-03 00:03:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tTqrAopsFI4s1rV7EbU0M2oOIwtaf05XjXgqmqmg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkNoQ21nNTBYZ2NlMHlqSzkweGRWNDNHY3E1WTh3d092UVpORWpLNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9iYW5uZXJzLzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1754329451),
('w1xDFjJYi6YAo2zOcJE4yGRxVggFr2835NJGi2R1', NULL, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/17.5 Mobile/15A5370a Safari/602.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzJuSlRveGx0YVlyTkRZZU1iR3h3SENOTVFVVG11Vzg4NjBGVFZ1ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1754330281);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'BOSCUAN69', 'text', '2025-08-03 00:34:15', '2025-08-03 00:34:15'),
(2, 'site_description', 'Situs Game Online Terpercaya', 'text', '2025-08-03 00:34:15', '2025-08-03 00:34:15'),
(6, 'gif_banner', 'gif-banners/Wd4DLKVasAnXujLj00yuGk75GzhosRaLoStgE6KZ.gif', 'file', '2025-08-03 03:27:08', '2025-08-03 03:28:04'),
(7, 'support_agent_image', 'support-agents/TSM33TjwphtZ9S7JbR2juQrdNIsl04fru0AMFYrq.jpg', 'image', '2025-08-03 23:12:21', '2025-08-03 23:12:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_type` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL,
  `referred_by` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `last_seen_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `full_name`, `email`, `phone`, `bank_name`, `bank_type`, `account_number`, `referral_code`, `referred_by`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_online`, `last_seen_at`) VALUES
(2, 'bgusrmdn', 'bagus ramadhan', 'bagus ramadhan', 'bgusrmdn@gmail.com', '081281293123', NULL, NULL, NULL, 'REF1F1E6D', NULL, 1, NULL, '$2y$12$ZKFc.Nw9ryxcEe.fOPjvYe.0yy1n8N8bVbk3QpQQ6asX6KuD8QGXm', NULL, '2025-08-03 22:19:47', '2025-08-03 22:19:47', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_admin_id_foreign` (`admin_id`),
  ADD KEY `chats_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `games_slug_unique` (`slug`),
  ADD KEY `games_provider_id_foreign` (`provider_id`),
  ADD KEY `games_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_chat_id_foreign` (`chat_id`),
  ADD KEY `messages_sender_type_sender_id_index` (`sender_type`,`sender_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `providers_slug_unique` (`slug`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `games_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
