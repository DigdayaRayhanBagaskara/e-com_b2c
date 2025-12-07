-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2025 at 07:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-com_b2c`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_menu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_menu` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok_menu` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_menu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_menu` enum('Makanan','Minuman') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`, `harga_menu`, `stok_menu`, `deskripsi_menu`, `jenis_menu`, `foto_menu`, `created_at`, `updated_at`) VALUES
(1, 'Asam Pedas Baung', '10000', '8', 'Asam pedas baung adalah masakan ikan baung yang dimasak dengan kuah asam dan pedas khas Melayu. Kuahnya merah menyala dan kaya rempah, menghasilkan cita rasa segar, pedas, dan gurih yang kuat.', 'Makanan', 'asam_pedas_baung-20250430124012.jpg', '2025-04-30 05:40:12', '2025-05-05 00:46:57'),
(2, 'Sambal Lado Tanak', '10000', '9', 'Sambal lado tanak merupakan sambal khas Melayu yang dimasak lama dengan santan dan campuran cabai, serai, dan rempah lainnya. Biasanya dicampur dengan teri, jengkol, atau udang, menghasilkan rasa gurih pedas yang khas dan tahan lama.', 'Makanan', 'sambal_lado_tanak-20250430124029.jpg', '2025-04-30 05:40:29', '2025-05-05 00:45:36');

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
(41, '2014_10_12_000000_create_users_table', 1),
(42, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(43, '2025_04_29_185823_create_rekening_tabel', 1),
(44, '2025_04_29_185826_create_menu_tabel', 1),
(45, '2025_04_29_185829_create_pesanan_tabel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint UNSIGNED NOT NULL,
  `id_users` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rekening` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pesanan` datetime NOT NULL,
  `pesanan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_antar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pesanan` enum('diproses','ditolak','diterima') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_rekening` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bank` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `nama_rekening`, `nama_bank`, `nomor_rekening`, `created_at`, `updated_at`) VALUES
(1, 'QRIS Kantin Dang Merdu', 'QRIS', 'ID1011200100021A01', '2025-04-30 05:40:40', '2025-04-30 05:40:40'),
(2, 'Kantin Dang Merdu', 'BSI', '11239950290', '2025-04-30 05:40:49', '2025-04-30 05:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `no_hp`, `alamat`, `foto`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '081234567890', 'Jl. Kandis', 'admin-20250501103347.jpeg', '$2y$12$ycoekgZbOiW.BClpeRmTMetdDdwOishJj5iQZb1eiaHgz/PPifgum', 'Admin', '2025-04-30 05:39:40', '2025-05-01 03:33:47'),
(2, 'Customer', 'customer@gmail.com', '081324576890', 'Jl. Rokan', 'customer-20250501105741.jpeg', '$2y$12$tqNfBfqzVALXK0NWP9mBQezpgVR3cuUtd6fnLls.3C5EEPQ9rusFG', 'Customer', '2025-04-30 05:39:41', '2025-05-01 03:57:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
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
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
