-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 01:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelompok4_toko_aneka_atk`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(8) NOT NULL,
  `id_kategori` int(8) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `nama_barang`, `harga_barang`, `created_at`, `updated_at`) VALUES
(1, 2, 'Buku Kotak Kecil', 3500, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(2, 5, 'Sampul Buku Coklat', 250, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(3, 5, 'Mika Jilid', 500, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(4, 5, 'Magnet', 1000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(5, 1, 'Amplop Coklat Kecil', 2000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(6, 1, 'Staples', 10000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(7, 1, 'Isi Staples', 2500, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(8, 1, 'Amplop Coklat Besar', 2000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(9, 6, 'Print', 750, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(10, 4, 'Permen', 75, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(11, 1, 'Spidol', 1500, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(12, 3, 'HVS A4', 50000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(13, 1, 'Tip-Ex', 7000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(14, 1, 'Pensil Joyko', 4000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(15, 1, 'Isi Pensil Besar', 4000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(16, 1, 'Isolasi Bening', 2000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(17, 2, 'Buku Akutansi', 21000, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(18, 1, 'Bolpen Lucu', 3500, '2023-05-24 19:23:28', '2023-05-24 19:23:28'),
(19, 1, 'Lem Fox', 12000, '2023-05-24 19:23:28', '2023-05-24 19:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(8) NOT NULL,
  `id_transaksi` int(8) NOT NULL,
  `id_barang` int(8) NOT NULL,
  `jumlah_barang` int(10) NOT NULL,
  `harga_barang_transaksi` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_barang`, `jumlah_barang`, `harga_barang_transaksi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3500, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(2, 1, 2, 4, 1000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(3, 2, 3, 10, 5000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(4, 2, 4, 2, 2000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(5, 2, 5, 1, 2000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(6, 3, 6, 1, 10000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(7, 4, 7, 1, 2500, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(8, 4, 8, 3, 6000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(9, 4, 9, 5, 3750, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(10, 5, 10, 2, 250, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(11, 5, 4, 1, 1000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(12, 6, 11, 1, 1500, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(13, 6, 12, 1, 50000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(14, 6, 13, 1, 7000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(15, 6, 14, 1, 4000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(16, 7, 15, 1, 4000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(17, 7, 11, 1, 1500, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(18, 8, 16, 1, 2000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(19, 8, 6, 1, 10000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(20, 8, 17, 1, 21000, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(21, 9, 18, 1, 3500, '2023-05-24 19:21:37', '2023-05-24 19:21:37'),
(22, 10, 4, 5, 5000, '2023-05-24 19:21:37', '2023-05-24 19:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(8) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Alat Tulis', '2023-05-24 19:14:19', '2023-05-24 19:14:19'),
(2, 'Buku', '2023-05-24 19:14:19', '2023-05-24 19:14:19'),
(3, 'Kertas', '2023-05-24 19:14:19', '2023-05-24 19:14:19'),
(4, 'Jajanan', '2023-05-24 19:14:19', '2023-05-24 19:14:19'),
(5, 'Sampul Buku', '2023-05-24 19:14:19', '2023-05-24 19:14:19'),
(6, 'Jasa Print', '2023-05-24 19:14:19', '2023-05-24 19:14:19');

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
(2, '2023_05_24_182700_create_kategori_table', 1),
(3, '2023_05_24_182627_create_transaksi_table', 2),
(4, '2023_05_24_182641_create_detail_transaksi_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(8) NOT NULL,
  `tanggal` date NOT NULL,
  `total_transaksi` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `total_transaksi`, `created_at`, `updated_at`) VALUES
(1, '2023-03-05', 4500, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(2, '2023-03-05', 9000, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(3, '2023-03-05', 10000, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(4, '2023-03-05', 12250, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(5, '2023-03-05', 1250, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(6, '2023-03-05', 62500, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(7, '2023-03-05', 5500, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(8, '2023-03-05', 33000, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(9, '2023-03-05', 3500, '2023-05-24 19:20:02', '2023-05-24 19:20:02'),
(10, '2023-03-05', 31000, '2023-05-24 19:20:02', '2023-05-24 19:20:02');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$.HAJgBfQKgMq5t5o1/HeW.JW7g5rPDdx13fKwDu1AmJZ4B0F70KUm', NULL, '2023-05-16 06:17:14', '2023-05-16 06:17:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`),
  ADD KEY `memiliki` (`id_kategori`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `dimiliki` (`id_transaksi`),
  ADD KEY `berisi` (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `memiliki` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `berisi` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `dimiliki` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
