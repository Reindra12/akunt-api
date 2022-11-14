-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2022 pada 16.17
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_akunt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `time` timestamp NOT NULL DEFAULT '2022-11-15 05:42:53',
  `type` enum('expense','revenue') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `title`, `amount`, `time`, `type`, `created_at`, `updated_at`) VALUES
(4, 'kacang', 50000, '2022-11-15 05:42:53', 'revenue', '2022-11-15 06:07:34', '2022-11-14 22:48:06'),
(5, 'Hadiah', 50000, '2022-11-15 05:42:53', 'revenue', '2022-11-15 06:07:54', '2022-11-15 06:07:54'),
(6, 'Hadiah', 50000, '2022-11-15 05:42:53', 'revenue', '2022-11-15 06:11:57', '2022-11-15 06:11:57'),
(7, 'Hadiah', 50000, '2022-11-15 05:42:53', 'revenue', '2022-11-14 16:48:57', '2022-11-14 16:48:57'),
(8, 'Hadiah', 50000, '2022-11-15 05:42:53', 'revenue', '2022-11-14 16:49:13', '2022-11-14 16:49:13'),
(9, 'Belanja', 30000, '2022-11-15 05:42:53', 'revenue', '2022-11-14 17:03:16', '2022-11-14 17:03:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
