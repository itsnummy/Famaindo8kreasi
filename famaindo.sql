-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for famaindo
CREATE DATABASE IF NOT EXISTS `famaindo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `famaindo`;

-- Dumping structure for table famaindo.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table famaindo.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table famaindo.faktur_penjualan
CREATE TABLE IF NOT EXISTS `faktur_penjualan` (
  `no_transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_sales` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pelanggan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `kontak_wa` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `item_pesanan` text COLLATE utf8mb4_general_ci NOT NULL,
  `harga_satuan` int NOT NULL,
  `total_item` int NOT NULL,
  `kredit` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_akhir` int NOT NULL,
  `potongan` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `biaya_lain` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kembali` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tunai` varchar(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `tgl_jt` date NOT NULL,
  `subtotal` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'progress',
  `K_Debit` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DP_PO` int DEFAULT NULL,
  `jml` int NOT NULL,
  `K_Kredit` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pajak` int DEFAULT NULL,
  `terbilang` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table famaindo.faktur_penjualan: ~3 rows (approximately)
INSERT INTO `faktur_penjualan` (`no_transaksi`, `kode_sales`, `pelanggan`, `alamat`, `kontak_wa`, `email`, `item_pesanan`, `harga_satuan`, `total_item`, `kredit`, `total_akhir`, `potongan`, `biaya_lain`, `kembali`, `tunai`, `tanggal`, `tgl_jt`, `subtotal`, `keterangan`, `status`, `K_Debit`, `DP_PO`, `jml`, `K_Kredit`, `pajak`, `terbilang`) VALUES
	('0025', NULL, 'Sekretariat Wakil Presiden', 'Jakarta Pusat', NULL, NULL, 'Tas Ibu dan Anak', 100000, 10000000, NULL, 10000000, NULL, NULL, NULL, NULL, '2025-11-15', '2025-11-30', 10000000, 'Pemesanan telah diselesaikan pada 2025-12-09 10:59:39', 'selesai', NULL, NULL, 100, NULL, NULL, 'Sepuluh Juta Rupiah'),
	('03872', NULL, 'Politeknik STMI Jakarta', NULL, NULL, NULL, 'qvhdhqwgdyhjvbn dsajkjasjd', 120000, 14400000, NULL, 14400000, NULL, NULL, NULL, NULL, '2025-12-09', '2025-12-13', 14400000, 'Pemesanan telah diselesaikan pada 2025-12-10 03:21:35', 'selesai', NULL, NULL, 120, NULL, NULL, 'Empat Belas Juta Empat Ratus Ribu Rupiah'),
	('2222', NULL, 'PT Kayu Permata', NULL, '081211220450', NULL, 'Tas', 2000000, 200000000, NULL, 200000000, NULL, NULL, NULL, NULL, '2025-12-02', '2025-12-20', 200000000, NULL, 'progress', NULL, NULL, 100, NULL, NULL, 'Dua Ratus Juta Rupiah');

-- Dumping structure for table famaindo.kwitansi
CREATE TABLE IF NOT EXISTS `kwitansi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sejumlah` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `utk_pembayaran` text COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no_transaksi` (`no_transaksi`),
  CONSTRAINT `kwitansi_ibfk_1` FOREIGN KEY (`no_transaksi`) REFERENCES `faktur_penjualan` (`no_transaksi`),
  CONSTRAINT `no_transaksi` FOREIGN KEY (`no_transaksi`) REFERENCES `faktur_penjualan` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table famaindo.kwitansi: ~4 rows (approximately)
INSERT INTO `kwitansi` (`id`, `no_transaksi`, `sejumlah`, `utk_pembayaran`, `jenis`) VALUES
	(1, '0025', '5000000', 'DP Tas Ibu dan Anak', 1),
	(2, '0025', '5000000', 'lunas', 2),
	(5, '03872', '400000', 'DP', 1),
	(6, '03872', '14000000', 'lunas', 2),
	(9, '2222', '100000000', 'DP', 1);

-- Dumping structure for table famaindo.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table famaindo.migrations: ~4 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(5, '2014_10_12_000000_create_users_table', 1),
	(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(7, '2019_08_19_000000_create_failed_jobs_table', 1),
	(8, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- Dumping structure for table famaindo.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table famaindo.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table famaindo.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table famaindo.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table famaindo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table famaindo.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@famaindo.com', '$2y$12$9XIYo5fN3K3GJNVFM/omr.4aM43y8fDJ9FvzO3dhVqFU4K0yHfhjW', NULL, '2025-12-08 07:19:18', '2025-12-08 07:19:18'),
	(3, 'okei', 'saya@gmail.com', '$2y$12$lKmFXqLbMxLIcmDRJFKf4up1lL8/AKLpApCd2djHau8rptnngw7/C', NULL, '2025-12-08 19:40:16', '2025-12-08 20:14:22'),
	(4, 'iya', 'kha@gmailcom', '$2y$12$ZsuYEEMmJeXfL1hcU6cG1ejZkxRGJN169b7V0qeQK2hjBrxZeJRy2', NULL, '2025-12-08 20:16:27', '2025-12-08 20:16:27');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
