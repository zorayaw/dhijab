-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 10:03 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hijab`
--

-- --------------------------------------------------------

--
-- Table structure for table `asal_transaksi`
--

CREATE TABLE `asal_transaksi` (
  `at_id` int(11) NOT NULL,
  `at_nama` varchar(50) DEFAULT NULL,
  `at_tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asal_transaksi`
--

INSERT INTO `asal_transaksi` (`at_id`, `at_nama`, `at_tanggal`) VALUES
(3, 'WhatsApp', '2019-05-01 08:59:03'),
(4, 'Line', '2019-05-01 08:59:20'),
(5, 'Shopee', '2019-05-01 08:59:35'),
(6, 'COD', '2019-05-01 08:59:43'),
(7, 'Bukalapak', '2019-05-01 09:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_nama` varchar(50) DEFAULT NULL,
  `id_kategori_barang` int(11) NOT NULL,
  `id_jenis_barang` int(11) NOT NULL DEFAULT 1,
  `barang_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_nama`, `id_kategori_barang`, `id_jenis_barang`, `barang_stok`) VALUES
(70, 'Square Baby Pink S', 1, 1, 163),
(71, 'Square Baby Pink M', 2, 1, 89),
(72, 'Square Baby Pink L', 3, 1, 0),
(76, 'Nadira Baby Pink S', 7, 1, 94),
(79, 'Wolfis Baby Pink', 35, 2, 4864),
(80, 'Square Baby Tosca S', 1, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `barang_non_reseller`
--

CREATE TABLE `barang_non_reseller` (
  `bnr_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `bnr_harga` varchar(50) NOT NULL,
  `bnr_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_non_reseller`
--

INSERT INTO `barang_non_reseller` (`bnr_id`, `barang_id`, `bnr_harga`, `bnr_tanggal`) VALUES
(55, 70, '124124', '2019-07-08 08:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `barang_reseller`
--

CREATE TABLE `barang_reseller` (
  `br_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `br_kuantitas` int(50) NOT NULL,
  `br_harga` varchar(50) NOT NULL,
  `br_tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_reseller`
--

INSERT INTO `barang_reseller` (`br_id`, `barang_id`, `br_kuantitas`, `br_harga`, `br_tanggal`) VALUES
(3014, 70, 12, '2000', '2019-07-08 08:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `history_stock_barang`
--

CREATE TABLE `history_stock_barang` (
  `hsb_id` int(11) NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `stock_berkurang` int(50) NOT NULL,
  `lvl` int(11) NOT NULL,
  `hsb_tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_stock_barang`
--

INSERT INTO `history_stock_barang` (`hsb_id`, `pemesanan_id`, `barang_id`, `stock_berkurang`, `lvl`, `hsb_tanggal`) VALUES
(25, 25, 70, 7, 2, '2019-11-10 18:03:11'),
(26, 26, 70, 14, 1, '2019-11-11 05:38:59'),
(27, 26, 70, 6, 2, '2019-11-11 05:50:23'),
(28, 27, 70, 5, 3, '2019-11-11 06:05:14'),
(29, 28, 75, 3, 1, '2019-11-11 15:43:05'),
(30, 28, 74, 13, 1, '2019-11-11 15:43:05'),
(31, 28, 78, 2, 1, '2019-11-11 15:43:05'),
(32, 28, 70, 6, 1, '2019-11-11 15:43:05'),
(33, 29, 79, 5, 1, '2019-12-31 04:49:30'),
(34, 30, 75, 10, 1, '2019-12-31 05:06:11'),
(35, 30, 79, 5, 1, '2019-12-31 05:06:11'),
(36, 31, 73, 5, 2, '2019-12-31 05:36:41'),
(37, 31, 71, 5, 2, '2019-12-31 05:36:41'),
(38, 31, 79, 10, 2, '2019-12-31 05:36:41'),
(39, 32, 80, 20, 3, '2019-12-31 05:51:54'),
(40, 32, 79, 30, 3, '2019-12-31 05:51:54'),
(41, 33, 75, 10, 1, '2019-12-31 06:01:08'),
(42, 33, 79, 10, 1, '2019-12-31 06:01:08'),
(43, 34, 74, 10, 2, '2019-12-31 06:15:29'),
(44, 34, 79, 11, 2, '2019-12-31 06:15:29'),
(45, 35, 80, 3, 3, '2019-12-31 06:21:02'),
(46, 35, 79, 3, 3, '2019-12-31 06:21:02'),
(47, 36, 79, 3, 1, '2019-12-31 06:35:06'),
(48, 36, 74, 3, 1, '2019-12-31 06:35:06'),
(49, 37, 79, 210, 3, '2020-01-01 02:12:11'),
(60, 44, 74, 2, 1, '2020-05-03 14:38:20'),
(61, 45, 73, 4, 2, '2020-05-04 05:21:22'),
(62, 46, 82, 4, 2, '2020-05-04 10:55:06'),
(63, 47, 75, 1, 1, '2020-05-05 05:01:39'),
(64, 48, 77, 3, 1, '2020-05-05 06:27:55'),
(65, 49, 74, 2, 1, '2020-05-05 06:36:25'),
(66, 50, 77, 1, 1, '2020-05-05 06:39:52'),
(67, 51, 78, 3, 1, '2020-05-05 07:21:42'),
(68, 52, 77, 2, 1, '2020-05-05 07:22:45'),
(69, 52, 73, 3, 1, '2020-05-05 07:22:45'),
(70, 53, 82, 2, 2, '2020-05-05 09:13:55'),
(71, 54, 78, -21, 1, '2020-05-05 09:36:11'),
(72, 55, 78, 2, 2, '2020-05-05 10:37:30'),
(73, 56, 74, 2, 1, '2020-05-05 11:03:14'),
(74, 57, 74, 3, 1, '2020-05-05 11:42:00'),
(75, 58, 80, 3, 1, '2020-05-05 17:26:08'),
(76, 59, 79, 2, 2, '2020-05-06 03:17:15'),
(77, 60, 74, 2, 1, '2020-05-06 03:27:06'),
(78, 61, 74, 3, 1, '2020-05-06 03:46:07'),
(79, 62, 75, 2, 1, '2020-05-06 03:47:06'),
(80, 63, 74, 2, 1, '2020-05-06 10:14:28'),
(81, 64, 73, 2, 1, '2020-05-06 13:11:19'),
(82, 65, 74, 2, 1, '2020-05-06 13:23:39'),
(83, 66, 74, 2, 1, '2020-05-06 13:59:16'),
(84, 67, 73, 1, 2, '2020-05-06 15:21:40'),
(85, 68, 77, 2, 1, '2020-05-07 10:16:21'),
(86, 69, 74, 2, 1, '2020-05-07 15:25:26'),
(87, 70, 82, 3, 1, '2020-05-07 16:20:58'),
(88, 71, 74, 1, 1, '2020-05-08 04:02:40'),
(89, 72, 73, 1, 1, '2020-05-08 04:04:33'),
(90, 72, 79, 2, 1, '2020-05-08 04:04:33'),
(91, 73, 70, 1, 2, '2020-05-08 05:57:42'),
(92, 74, 74, 2, 2, '2020-05-08 09:11:38'),
(93, 75, 79, 2, 3, '2020-05-08 09:42:44'),
(94, 76, 71, 2, 1, '2020-05-08 10:23:53'),
(95, 77, 79, 2, 3, '2020-05-08 11:08:42'),
(96, 78, 79, 2, 3, '2020-05-08 17:03:35'),
(97, 79, 79, 2, 3, '2020-05-08 17:04:21'),
(98, 80, 74, 2, 2, '2020-05-08 17:17:05'),
(99, 81, 74, 2, 1, '2020-05-08 17:28:19'),
(100, 82, 77, 1, 1, '2020-05-09 06:16:05'),
(101, 83, 79, 1, 3, '2020-05-09 07:07:05'),
(102, 84, 79, 1, 3, '2020-05-09 07:10:15'),
(103, 85, 71, 2, 1, '2020-05-09 11:01:29'),
(104, 86, 74, 2, 1, '2020-05-09 15:16:26'),
(105, 87, 79, 1, 3, '2020-05-09 15:24:02'),
(106, 88, 74, 2, 1, '2020-05-10 04:55:12'),
(107, 89, 79, 2, 3, '2020-05-10 04:58:30'),
(108, 90, 78, 1, 2, '2020-05-10 06:44:15'),
(109, 91, 78, 1, 1, '2020-05-10 06:45:12'),
(110, 92, 75, 1, 2, '2020-05-10 06:51:04'),
(111, 93, 73, 2, 2, '2020-05-10 11:54:06'),
(112, 94, 77, 2, 1, '2020-05-10 14:35:50'),
(113, 95, 73, 2, 1, '2020-05-11 06:21:26'),
(114, 96, 79, 2, 3, '2020-05-12 06:12:51'),
(115, 97, 77, 2, 1, '2020-05-12 06:19:43'),
(116, 98, 71, 1, 1, '2020-05-12 06:21:02'),
(117, 99, 80, 1, 2, '2020-05-12 06:22:15'),
(118, 100, 71, 1, 1, '2020-05-12 06:26:38'),
(119, 101, 76, 1, 1, '2020-05-12 08:25:35'),
(120, 102, 79, 2, 3, '2020-05-12 08:35:43'),
(121, 103, 79, 1, 3, '2020-05-12 08:38:44'),
(122, 104, 71, 1, 2, '2020-05-12 08:40:45'),
(123, 105, 79, 2, 3, '2020-05-12 09:37:42'),
(124, 106, 78, 1, 1, '2020-05-12 09:38:55'),
(125, 107, 70, 1, 1, '2020-05-12 09:41:31'),
(126, 108, 79, 1, 3, '2020-05-12 11:04:26'),
(127, 109, 77, 2, 1, '2020-05-12 13:34:03'),
(128, 110, 80, 1, 2, '2020-05-12 13:37:51'),
(129, 111, 77, 1, 2, '2020-05-12 13:40:17'),
(130, 112, 76, 1, 1, '2020-05-13 06:00:57'),
(131, 113, 80, 1, 1, '2020-05-13 15:45:56'),
(132, 114, 80, 1, 1, '2020-05-13 16:10:21'),
(133, 114, 76, 1, 1, '2020-05-13 16:10:21'),
(134, 114, 70, 1, 2, '2020-05-13 16:10:38'),
(135, 115, 79, 1, 3, '2020-05-13 16:13:27'),
(136, 116, 71, 1, 2, '2020-05-13 16:16:32'),
(137, 117, 84, 6, 2, '2020-05-13 16:45:26'),
(138, 114, 70, 1, 2, '2020-05-14 07:35:42'),
(139, 118, 71, 1, 2, '2020-05-14 07:40:37'),
(140, 119, 80, 1, 1, '2020-05-14 08:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori_barang` int(11) NOT NULL,
  `nama_kategori` varchar(250) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga_ecer` int(11) NOT NULL,
  `harga_grosir_3_11` int(11) NOT NULL,
  `harga_grosir_12_29` int(11) NOT NULL,
  `grosir_diatas_30` int(11) NOT NULL,
  `reseller` int(11) NOT NULL,
  `HPP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori_barang`, `nama_kategori`, `berat`, `harga_ecer`, `harga_grosir_3_11`, `harga_grosir_12_29`, `grosir_diatas_30`, `reseller`, `HPP`) VALUES
(1, 'Square S', 240, 47500, 42500, 41000, 39000, 41000, 32000),
(2, 'Square M', 280, 50000, 45000, 43000, 41000, 43000, 35000),
(3, 'Square L', 350, 53000, 48000, 46000, 44000, 46000, 38000),
(4, 'Ayra S', 235, 78000, 73000, 68000, 63000, 68000, 0),
(5, 'Ayra M', 315, 85000, 80000, 75000, 70000, 75000, 0),
(6, 'Ayra L', 415, 98000, 93000, 88000, 83000, 88000, 0),
(7, 'Nadira S', 235, 78000, 73000, 68000, 63000, 68000, 0),
(8, 'Nadira M', 315, 85000, 80000, 75000, 70000, 75000, 0),
(9, 'Nadira L', 415, 98000, 93000, 88000, 83000, 88000, 0),
(10, 'Saila S', 225, 75000, 70000, 65000, 60000, 65000, 0),
(11, 'Saila M', 270, 80000, 75000, 70000, 65000, 70000, 0),
(12, 'Saila Non S', 225, 65000, 60000, 55000, 50000, 55000, 0),
(13, 'Saila Non M', 270, 70000, 65000, 60000, 55000, 60000, 0),
(14, 'Saila Non L', 320, 75000, 70000, 65000, 60000, 65000, 0),
(15, 'Farra', 42, 15000, 14000, 13000, 12000, 13000, 0),
(16, 'Nadira Kids XS', 65, 50000, 45000, 42500, 40000, 42500, 0),
(17, 'Nadira Kids S', 85, 55000, 50000, 47500, 45000, 475000, 0),
(18, 'Nadira Kids M', 115, 60000, 55000, 52500, 50000, 52500, 0),
(19, 'Nadira Kids L', 155, 65000, 60000, 57500, 55000, 57500, 0),
(20, 'Adeeva XS', 190, 63000, 58000, 55500, 53000, 55500, 0),
(21, 'Adeeva S', 235, 66000, 61000, 58500, 56000, 58500, 0),
(22, 'Adeeva M', 260, 69000, 64000, 61500, 59000, 61500, 0),
(23, 'Adeeva L', 285, 75000, 70000, 67500, 65000, 675000, 0),
(24, 'Adeeva XL', 340, 81000, 76000, 73500, 71000, 73500, 0),
(25, 'Wupol', 60, 19500, 18000, 17000, 16000, 17000, 0),
(26, 'Dhia BTM-BTT', 125, 50000, 45000, 43000, 41000, 43000, 0),
(27, 'Banda Army', 30, 10000, 9000, 8500, 75000, 85000, 0),
(28, 'Kupluk Army', 35, 12000, 10000, 9500, 8500, 9500, 0),
(29, 'Maisafa Apricot', 175, 57500, 52500, 50000, 47500, 50000, 0),
(30, 'Maisa Pink', 175, 55000, 50000, 47500, 45000, 47500, 0),
(31, 'Maira Pink', 175, 52000, 47000, 44500, 42000, 44500, 0),
(32, 'Alea Pink', 175, 52500, 47500, 45000, 42500, 45000, 0),
(33, 'Azalea Pale Mint', 175, 52500, 47500, 45000, 42500, 45000, 0),
(34, 'Diamond Pale Mint', 175, 52500, 47500, 44500, 42000, 44500, 0),
(35, 'Wolfis', 240, 28500, 27500, 27250, 27000, 28500, 24000),
(36, 'Bubble', 240, 25000, 24000, 23750, 23500, 25000, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `kurir_id` int(11) NOT NULL,
  `kurir_nama` varchar(50) DEFAULT NULL,
  `kurir_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `kurir_harga` varchar(20) NOT NULL,
  `ongkir` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`kurir_id`, `kurir_nama`, `kurir_tanggal`, `kurir_harga`, `ongkir`) VALUES
(1, 'JNE', '2019-04-19 15:50:14', '10000', '22000'),
(2, 'J & T', '2019-04-19 15:50:23', '10000', '22000'),
(4, 'Grab', '2019-04-19 15:50:40', '10000', '12000'),
(5, 'Gojek', '2019-05-01 09:05:31', '10000', '12000'),
(6, 'tidak ada kurir', '2019-11-11 06:03:54', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `list_barang`
--

CREATE TABLE `list_barang` (
  `lb_id` int(11) NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `lb_qty` int(20) NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `lb_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `lb_lvl` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_barang`
--

INSERT INTO `list_barang` (`lb_id`, `pemesanan_id`, `lb_qty`, `barang_id`, `lb_tanggal`, `lb_lvl`, `harga`, `berat`) VALUES
(32, 30, 10, 75, '2019-12-31 05:06:11', 1, 93000, 415),
(33, 30, 5, 79, '2019-12-31 05:06:11', 1, 28500, 240),
(37, 32, 20, 80, '2019-12-31 05:51:54', 3, 20000, 0),
(38, 32, 30, 79, '2019-12-31 05:51:54', 3, 24000, 0),
(39, 33, 10, 75, '2019-12-31 06:01:08', 1, 93000, 415),
(40, 33, 10, 79, '2019-12-31 06:01:08', 1, 27500, 240),
(45, 36, 3, 79, '2019-12-31 06:35:06', 1, 28500, 240),
(46, 36, 3, 74, '2019-12-31 06:35:06', 1, 73000, 235),
(47, 37, 210, 79, '2020-01-01 02:12:11', 3, 24000, 0),
(48, 37, 220, 80, '2020-01-01 02:12:11', 3, 20000, 0),
(53, 39, 10, 74, '2020-01-01 02:45:40', 1, 73000, 235),
(55, 41, 1, 73, '2020-01-01 02:58:18', 1, 78000, 235),
(57, 43, 110, 79, '2020-01-01 03:14:52', 3, 24000, 0),
(58, 44, 2, 74, '2020-05-03 14:38:19', 1, 78000, 235),
(59, 45, 4, 73, '2020-05-04 05:21:22', 2, 68000, 235),
(60, 46, 4, 82, '2020-05-04 10:55:06', 2, 61500, 260),
(61, 47, 1, 75, '2020-05-05 05:01:39', 1, 98000, 415),
(62, 48, 3, 77, '2020-05-05 06:27:55', 1, 80000, 315),
(63, 49, 2, 74, '2020-05-05 06:36:25', 1, 78000, 235),
(64, 50, 1, 77, '2020-05-05 06:39:52', 1, 85000, 315),
(65, 51, 3, 78, '2020-05-05 07:21:42', 1, 93000, 415),
(66, 52, 2, 77, '2020-05-05 07:22:45', 1, 85000, 315),
(67, 52, 3, 73, '2020-05-05 07:22:45', 1, 73000, 235),
(68, 53, 2, 82, '2020-05-05 09:13:55', 2, 61500, 260),
(69, 54, -21, 78, '2020-05-05 09:36:11', 1, 98000, 415),
(70, 55, 2, 78, '2020-05-05 10:37:29', 2, 88000, 415),
(71, 56, 2, 74, '2020-05-05 11:03:14', 1, 78000, 235),
(75, 60, 2, 74, '2020-05-06 03:27:06', 1, 78000, 235),
(76, 61, 3, 74, '2020-05-06 03:46:07', 1, 73000, 235),
(77, 62, 2, 75, '2020-05-06 03:47:06', 1, 98000, 415),
(78, 63, 2, 74, '2020-05-06 10:14:28', 1, 78000, 235),
(80, 65, 2, 74, '2020-05-06 13:23:39', 1, 78000, 235),
(81, 66, 2, 74, '2020-05-06 13:59:16', 1, 78000, 235),
(83, 68, 2, 77, '2020-05-07 10:16:21', 1, 85000, 315),
(84, 69, 2, 74, '2020-05-07 15:25:26', 1, 78000, 235),
(85, 70, 3, 82, '2020-05-07 16:20:58', 1, 64000, 260),
(86, 71, 1, 74, '2020-05-08 04:02:40', 1, 78000, 235),
(87, 72, 1, 73, '2020-05-08 04:04:33', 1, 78000, 235),
(88, 72, 2, 79, '2020-05-08 04:04:33', 1, 28500, 240),
(89, 73, 1, 70, '2020-05-08 05:57:42', 2, 41000, 240),
(90, 74, 2, 74, '2020-05-08 09:11:38', 2, 68000, 235),
(91, 75, 2, 79, '2020-05-08 09:42:44', 3, 24000, 0),
(92, 76, 2, 71, '2020-05-08 10:23:53', 1, 50000, 280),
(95, 79, 2, 79, '2020-05-08 17:04:21', 3, 24000, 0),
(96, 80, 2, 74, '2020-05-08 17:17:05', 2, 68000, 235),
(97, 81, 2, 74, '2020-05-08 17:28:19', 1, 78000, 235),
(101, 85, 2, 71, '2020-05-09 11:01:29', 1, 50000, 280),
(105, 89, 2, 79, '2020-05-10 04:58:30', 3, 24000, 0),
(110, 94, 2, 77, '2020-05-10 14:35:50', 1, 85000, 315),
(111, 95, 2, 73, '2020-05-11 06:21:26', 1, 78000, 235),
(112, 96, 2, 79, '2020-05-12 06:12:51', 3, 24000, 0),
(113, 97, 2, 77, '2020-05-12 06:19:43', 1, 85000, 315),
(114, 98, 1, 71, '2020-05-12 06:21:02', 1, 50000, 280),
(117, 101, 1, 76, '2020-05-12 08:25:35', 1, 78000, 235),
(118, 102, 2, 79, '2020-05-12 08:35:43', 3, 24000, 0),
(119, 103, 1, 79, '2020-05-12 08:38:44', 3, 24000, 0),
(120, 104, 1, 71, '2020-05-12 08:40:45', 2, 43000, 280),
(121, 105, 2, 79, '2020-05-12 09:37:42', 3, 24000, 0),
(122, 106, 1, 78, '2020-05-12 09:38:55', 1, 98000, 415),
(123, 107, 1, 70, '2020-05-12 09:41:29', 1, 47500, 240),
(125, 109, 2, 77, '2020-05-12 13:34:03', 1, 85000, 315),
(126, 110, 1, 80, '2020-05-12 13:37:51', 2, 41000, 240),
(127, 111, 1, 77, '2020-05-12 13:40:17', 2, 75000, 315),
(128, 112, 1, 76, '2020-05-13 06:00:57', 1, 78000, 235),
(129, 113, 1, 80, '2020-05-13 15:45:56', 1, 47500, 240),
(130, 114, 1, 80, '2020-05-13 16:10:21', 1, 47500, 240),
(131, 114, 1, 76, '2020-05-13 16:10:21', 1, 78000, 235),
(132, 114, 1, 70, '2020-05-13 16:10:37', 2, 47500, 240),
(133, 115, 1, 79, '2020-05-13 16:13:27', 3, 24000, 0),
(134, 116, 1, 71, '2020-05-13 16:16:31', 2, 43000, 280),
(135, 117, 6, 84, '2020-05-13 16:45:26', 2, 85000, 30),
(136, 114, 1, 70, '2020-05-14 07:35:42', 2, 47500, 240),
(137, 118, 1, 71, '2020-05-14 07:40:37', 2, 43000, 280),
(138, 119, 1, 80, '2020-05-14 08:01:46', 1, 47500, 240);

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `mp_id` int(11) NOT NULL,
  `mp_nama` varchar(50) DEFAULT NULL,
  `mp_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`mp_id`, `mp_nama`, `mp_tanggal`) VALUES
(1, 'Cash', '2019-05-12 14:10:06'),
(2, 'BNI', '2019-05-12 14:11:41'),
(3, 'BRI', '2019-05-12 14:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` int(11) NOT NULL,
  `pemesanan_nama` varchar(50) DEFAULT NULL,
  `pemesanan_nama_akun` varchar(250) NOT NULL DEFAULT '-',
  `pemesanan_tanggal` date NOT NULL,
  `pemesanan_hp` varchar(25) DEFAULT NULL,
  `pemesanan_alamat` text DEFAULT NULL,
  `email_pemesan` varchar(250) NOT NULL,
  `kurir_id` int(11) DEFAULT NULL,
  `no_resi` varchar(30) NOT NULL,
  `at_id` int(11) DEFAULT NULL,
  `mp_id` int(11) NOT NULL,
  `biaya_ongkir` int(11) NOT NULL,
  `status_pemesanan` int(1) NOT NULL,
  `biaya_admin` int(11) NOT NULL DEFAULT 0,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `uang_kembalian` varchar(10) NOT NULL,
  `note` varchar(50) NOT NULL,
  `status_customer` int(11) NOT NULL,
  `status_eks` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`pemesanan_id`, `pemesanan_nama`, `pemesanan_nama_akun`, `pemesanan_tanggal`, `pemesanan_hp`, `pemesanan_alamat`, `email_pemesan`, `kurir_id`, `no_resi`, `at_id`, `mp_id`, `biaya_ongkir`, `status_pemesanan`, `biaya_admin`, `diskon`, `uang_kembalian`, `note`, `status_customer`, `status_eks`, `username`) VALUES
(103, 'admin', '-', '2020-05-13', '989', 'jbkfvfr', '-', 6, '-', 6, 1, 0, 3, 0, 0, '0', 'ya', 3, 0, 'Order'),
(104, 'cobauser', 'cindy', '2020-05-12', '848', 'jbk', 'cdyy2400@gmail.com', 2, '8878', 4, 3, 8000, 0, 30000, 30000, '20000', 'ya', 2, 0, 'cindy'),
(105, 'admin', '-', '2020-04-01', '875745', 'hfudhe', '-', 6, '-', 6, 1, 0, 3, 0, 0, '0', 'ya', 3, 0, 'cindy'),
(106, 'yayaya', '-', '2020-05-12', '7834832', 'jbkfvfr', 'cdyy2400@gmail.com', 2, '732673', 5, 1, 8000, 0, 30000, 30000, '20000', 'ya', 1, 0, 'cindy'),
(107, 'stefanie', '-', '2020-02-01', '7878787', 'jbkfvfr', 'cdyy2400@gmail.com', 1, '6767', 4, 3, 8000, 0, 30000, 30000, '20000', 'ya', 1, 0, 'cindy'),
(108, 'admin', '-', '2020-02-08', '6757656', 'jbkfvfr', '-', 6, '-', 6, 1, 0, 4, 0, 0, '0', 'ya', 3, 0, 'cindy'),
(109, 'heihei', '-', '2018-07-17', '7867', 'jbk', 'cdyy2400@gmail.com', 2, '-', 5, 1, 8000, 1, 30000, 30000, '20000', 'ya', 1, 0, 'Order'),
(110, 'yoiyoi', 'cindy', '2020-05-12', '784278', 'jbk', 'cdyy2400@gmail.com', 1, '767667', 4, 3, 8000, 0, 30000, 30000, '20000', 'ya', 2, 0, 'yoi'),
(111, 'cobaaaa', 'cindy', '2020-05-18', '893232', 'uhdia', 'cdyy2400@gmail.com', 1, 'Owner', 4, 3, 8000, 0, 30000, 30000, '20000', 'ya', 2, 0, '-'),
(112, '13 mei', '-', '2020-05-13', '8778778', 'uhdia', 'cdyy2400@gmail.com', 2, '-', 5, 1, 8000, 0, 30000, 30000, '20000', 'ya', 1, 3, 'Order'),
(114, 'cobanian', '-', '2020-05-22', '3532', 'uhdia', 'cdyy2400@gmail.com', 2, '-', 5, 1, 8000, 1, 30000, 30000, '20000', 't', 1, 0, 'Order'),
(115, 'admin', '-', '2020-02-13', '5435', '-', '-', 6, '-', 6, 1, 0, 3, 0, 0, '0', 'ya', 3, 0, 'Order'),
(117, 'fanfan', 'cindy', '2020-05-13', '6787', 'hjwdne', 'cdyy2400@gmail.com', 2, '7867', 6, 3, 8000, 0, 30000, 30000, '20000', 'ya', 2, 1, 'Order'),
(118, 'coba 14 mei', 'cindy', '2020-05-14', '78787', 'hjwdne', 'cdyy2400@gmail.com', 2, '78787867667', 4, 1, 8000, 0, 30000, 30000, '20000', 'ya', 2, 0, 'Order'),
(119, 'coba masuk resi', '-', '2020-05-03', '4353', 'uhdia', 'cdyy2400@gmail.com', 2, '7326542476327684234', 5, 1, 8000, 0, 30000, 30000, '20000', 'ya', 1, 0, 'Order');

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_stok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `kategori` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok`, `id_barang`, `jumlah`, `tanggal`, `kategori`, `status`) VALUES
(1, 75, 10, '2020-01-01 00:00:00', 1, 2),
(2, 75, 10, '2020-01-01 00:00:00', 1, 2),
(3, 75, 10, '2020-01-01 00:00:00', 1, 2),
(4, 75, 10, '2020-01-01 00:00:00', 1, 2),
(5, 79, 210, '2020-01-01 00:00:00', 1, 1),
(6, 80, 220, '2020-01-01 00:00:00', 1, 1),
(7, 74, 2, '2020-01-01 00:00:00', 1, 1),
(8, 80, 3, '2020-01-01 00:00:00', 1, 1),
(9, 73, 10, '2020-01-01 00:00:00', 1, 1),
(10, 79, 3, '2020-01-01 00:00:00', 1, 1),
(11, 74, 10, '2020-01-01 00:00:00', 1, 1),
(12, 75, 1, '2020-01-01 00:00:00', 1, 1),
(13, 75, 1, '2020-01-01 00:00:00', 1, 2),
(14, 73, 1, '2020-01-01 00:00:00', 1, 1),
(15, 73, 1, '2020-01-01 00:00:00', 1, 1),
(16, 73, 1, '2020-01-01 00:00:00', 1, 2),
(17, 75, 3, '2020-01-01 10:11:19', 1, 2),
(18, 79, 110, '2020-01-01 10:14:52', 1, 1),
(19, 74, 2, '2020-05-03 21:38:20', 1, 1),
(20, 73, 4, '2020-05-04 12:21:22', 1, 1),
(21, 82, 4, '2020-05-04 17:55:06', 1, 1),
(22, 75, 1, '2020-05-05 12:01:39', 1, 1),
(23, 77, 3, '2020-05-05 13:27:55', 1, 1),
(24, 74, 2, '2020-05-05 13:36:25', 1, 1),
(25, 77, 1, '2020-05-05 13:39:52', 1, 1),
(26, 78, 3, '2020-05-05 14:21:42', 1, 1),
(27, 77, 2, '2020-05-05 14:22:45', 1, 1),
(28, 73, 3, '2020-05-05 14:22:45', 1, 1),
(29, 82, 2, '2020-05-05 16:13:55', 1, 1),
(30, 78, -21, '2020-05-05 16:36:11', 1, 1),
(31, 78, 2, '2020-05-05 17:37:30', 1, 1),
(32, 74, 2, '2020-05-05 18:03:14', 1, 1),
(33, 74, 3, '2020-05-05 18:42:00', 1, 1),
(34, 80, 3, '2020-05-06 00:26:08', 1, 1),
(35, 79, 2, '2020-05-06 10:17:15', 1, 1),
(36, 74, 2, '2020-05-06 10:27:06', 1, 1),
(37, 74, 3, '2020-05-06 10:46:07', 1, 1),
(38, 75, 2, '2020-05-06 10:47:06', 1, 1),
(39, 79, 2, '2020-05-06 15:21:35', 1, 2),
(40, 74, 2, '2020-05-06 15:22:10', 1, 2),
(41, 80, 3, '2020-05-06 15:22:10', 1, 2),
(42, 73, 10, '2020-05-06 15:22:10', 1, 2),
(43, 79, 3, '2020-05-06 15:22:10', 1, 2),
(44, 80, 3, '2020-05-06 15:22:49', 1, 2),
(45, 74, 2, '2020-05-06 17:14:28', 1, 1),
(46, 73, 2, '2020-05-06 20:11:19', 1, 1),
(47, 74, 2, '2020-05-06 20:23:39', 1, 1),
(48, 74, 2, '2020-05-06 20:59:16', 1, 1),
(49, 73, 1, '2020-05-06 22:21:40', 1, 1),
(50, 77, 2, '2020-05-07 17:16:21', 1, 1),
(51, 74, 2, '2020-05-07 22:25:26', 1, 1),
(52, 82, 3, '2020-05-07 23:20:58', 1, 1),
(53, 74, 1, '2020-05-08 11:02:40', 1, 1),
(54, 73, 1, '2020-05-08 11:04:33', 1, 1),
(55, 79, 2, '2020-05-08 11:04:33', 1, 1),
(56, 70, 1, '2020-05-08 12:57:42', 1, 1),
(57, 74, 2, '2020-05-08 16:11:38', 1, 1),
(58, 79, 2, '2020-05-08 16:42:44', 1, 1),
(59, 71, 2, '2020-05-08 17:23:53', 1, 1),
(60, 73, 1, '2020-05-08 18:02:04', 1, 2),
(61, 79, 2, '2020-05-08 18:08:42', 1, 1),
(62, 79, 2, '2020-05-09 00:03:35', 1, 1),
(63, 79, 2, '2020-05-09 00:04:21', 1, 1),
(64, 74, 2, '2020-05-09 00:17:05', 1, 1),
(65, 74, 2, '2020-05-09 00:28:19', 1, 1),
(66, 77, 1, '2020-05-09 13:16:05', 1, 1),
(67, 79, 1, '2020-05-09 14:07:05', 1, 1),
(68, 79, 1, '2020-05-09 14:10:15', 1, 1),
(69, 71, 2, '2020-05-09 18:01:29', 1, 1),
(70, 73, 2, '2020-05-09 21:02:32', 1, 2),
(71, 74, 3, '2020-05-09 21:46:03', 1, 2),
(72, 74, 2, '2020-05-09 22:16:26', 1, 1),
(73, 79, 1, '2020-05-09 22:24:02', 1, 1),
(74, 79, 1, '2020-05-10 11:52:38', 1, 2),
(75, 74, 2, '2020-05-10 11:55:12', 1, 1),
(76, 79, 2, '2020-05-10 11:58:31', 1, 1),
(77, 78, 1, '2020-05-10 13:44:15', 1, 1),
(78, 78, 1, '2020-05-10 13:45:12', 1, 1),
(79, 75, 1, '2020-05-10 13:51:04', 1, 1),
(80, 79, 2, '2020-05-10 17:22:03', 1, 2),
(81, 79, 2, '2020-05-10 17:44:51', 1, 2),
(82, 77, 1, '2020-05-10 18:08:37', 1, 2),
(83, 78, 1, '2020-05-10 18:09:22', 1, 2),
(84, 74, 2, '2020-05-10 18:09:56', 1, 2),
(85, 75, 1, '2020-05-10 18:16:53', 1, 2),
(86, 79, 1, '2020-05-10 18:29:33', 1, 2),
(87, 74, 2, '2020-05-10 18:45:06', 1, 2),
(88, 73, 2, '2020-05-10 18:54:07', 1, 1),
(89, 78, 1, '2020-05-10 21:27:12', 1, 2),
(90, 77, 2, '2020-05-10 21:35:50', 1, 1),
(91, 79, 1, '2020-05-11 12:43:33', 1, 2),
(92, 73, 2, '2020-05-11 13:21:26', 1, 1),
(93, 78, 5, '2020-05-11 22:57:39', 1, 2),
(94, 79, 2, '2020-05-12 13:12:51', 1, 1),
(95, 77, 2, '2020-05-12 13:19:43', 1, 1),
(96, 71, 1, '2020-05-12 13:21:02', 1, 1),
(97, 80, 1, '2020-05-12 13:22:15', 1, 1),
(98, 71, 1, '2020-05-12 13:26:38', 1, 1),
(99, 76, 1, '2020-05-12 15:25:35', 1, 1),
(100, 79, 2, '2020-05-12 15:35:43', 1, 1),
(101, 79, 1, '2020-05-12 15:38:44', 1, 1),
(102, 71, 1, '2020-05-12 15:40:45', 1, 1),
(103, 79, 2, '2020-05-12 16:37:43', 1, 1),
(104, 78, 1, '2020-05-12 16:38:55', 1, 1),
(105, 70, 1, '2020-05-12 16:41:31', 1, 1),
(106, 79, 1, '2020-05-12 18:04:26', 1, 1),
(107, 79, 1, '2020-05-12 18:05:30', 1, 2),
(108, 80, 1, '2020-05-12 19:50:59', 1, 2),
(109, 73, 2, '2020-05-12 19:51:15', 1, 2),
(110, 77, 2, '2020-05-12 20:34:03', 1, 1),
(111, 80, 1, '2020-05-12 20:37:51', 1, 1),
(112, 77, 1, '2020-05-12 20:40:17', 1, 1),
(113, 76, 1, '2020-05-13 13:00:57', 1, 1),
(114, 70, 30, '2020-05-13 21:39:48', 1, 2),
(115, 73, 5, '2020-05-13 21:50:38', 1, 2),
(116, 80, 1, '2020-05-13 22:45:56', 1, 1),
(117, 80, 1, '2020-05-13 23:10:21', 1, 1),
(118, 76, 1, '2020-05-13 23:10:21', 1, 1),
(119, 70, 1, '2020-05-13 23:10:38', 1, 1),
(120, 79, 1, '2020-05-13 23:13:27', 1, 1),
(121, 71, 1, '2020-05-13 23:16:32', 1, 1),
(122, 71, 1, '2020-05-13 23:44:13', 1, 2),
(123, 84, 6, '2020-05-13 23:45:27', 1, 1),
(124, 70, 1, '2020-05-14 14:35:42', 1, 1),
(125, 71, 1, '2020-05-14 14:40:37', 1, 1),
(126, 80, 1, '2020-05-14 15:01:46', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `uang_masuk`
--

CREATE TABLE `uang_masuk` (
  `id_uang_masuk` int(11) NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uang_masuk`
--

INSERT INTO `uang_masuk` (`id_uang_masuk`, `pemesanan_id`, `jumlah`, `tanggal`) VALUES
(15, 38, 1092500, '2020-01-01 02:41:00'),
(16, 43, 29040000, '2020-01-01 03:14:52'),
(17, 75, 624000, '2020-05-08 09:42:44'),
(18, 77, 624000, '2020-05-08 11:08:42'),
(19, 78, 624000, '2020-05-08 17:03:35'),
(20, 79, 624000, '2020-05-08 17:04:21'),
(21, 83, 312000, '2020-05-09 07:07:05'),
(22, 84, 312000, '2020-05-09 07:10:15'),
(23, 87, 312000, '2020-05-09 15:24:02'),
(24, 89, 624000, '2020-05-10 04:58:31'),
(25, 91, 24000, '2020-05-10 11:17:05'),
(26, 80, 24000, '2020-05-10 11:42:19'),
(27, 96, 576000, '2020-05-12 06:12:51'),
(28, 102, 576000, '2020-05-12 08:35:43'),
(29, 103, 288000, '2020-05-12 08:38:44'),
(30, 105, 576000, '2020-05-12 09:37:43'),
(31, 108, 288000, '2020-05-12 11:04:26'),
(32, 115, 288000, '2020-05-13 16:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(50) DEFAULT NULL,
  `user_hp` varchar(20) DEFAULT NULL,
  `user_alamat` text DEFAULT NULL,
  `user_foto` varchar(50) DEFAULT NULL,
  `user_level` int(2) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_hp`, `user_alamat`, `user_foto`, `user_level`, `username`, `password`) VALUES
(1, 'Owner', '081255555555', 'Jl.Tnabun', 'about-img.jpg', 1, 'owner', '1234'),
(2, 'Order', '121', 'Bumi', 'product3.jpg', 2, 'order', '1234'),
(3, 'Stok', '10468013', 'Bumi', 'r4.jpg', 3, 'stok', '1234'),
(6, 'cindy', '0909', 'jl kemang', NULL, 2, 'cdyy2400', '1234'),
(8, 'yoi', '67676', 'ygubhj', NULL, 2, 'yoiyoi', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asal_transaksi`
--
ALTER TABLE `asal_transaksi`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `barang_non_reseller`
--
ALTER TABLE `barang_non_reseller`
  ADD PRIMARY KEY (`bnr_id`);

--
-- Indexes for table `barang_reseller`
--
ALTER TABLE `barang_reseller`
  ADD PRIMARY KEY (`br_id`);

--
-- Indexes for table `history_stock_barang`
--
ALTER TABLE `history_stock_barang`
  ADD PRIMARY KEY (`hsb_id`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori_barang`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`kurir_id`);

--
-- Indexes for table `list_barang`
--
ALTER TABLE `list_barang`
  ADD PRIMARY KEY (`lb_id`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`mp_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `uang_masuk`
--
ALTER TABLE `uang_masuk`
  ADD PRIMARY KEY (`id_uang_masuk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asal_transaksi`
--
ALTER TABLE `asal_transaksi`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `barang_non_reseller`
--
ALTER TABLE `barang_non_reseller`
  MODIFY `bnr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `barang_reseller`
--
ALTER TABLE `barang_reseller`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3015;

--
-- AUTO_INCREMENT for table `history_stock_barang`
--
ALTER TABLE `history_stock_barang`
  MODIFY `hsb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `kurir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `list_barang`
--
ALTER TABLE `list_barang`
  MODIFY `lb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `uang_masuk`
--
ALTER TABLE `uang_masuk`
  MODIFY `id_uang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
