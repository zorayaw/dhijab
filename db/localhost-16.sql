-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2020 at 06:46 AM
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
CREATE DATABASE IF NOT EXISTS `hijab` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hijab`;

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
(70, 'Square Baby Pink S', 1, 1, 137),
(71, 'Square Baby Pink M', 2, 1, 97),
(72, 'Square Baby Pink L', 3, 1, 0),
(73, 'Ayra Baby Pink S', 4, 1, 86),
(74, 'Ayra Baby Pink M', 4, 1, 82),
(76, 'Nadira Baby Pink S', 7, 1, 97),
(77, 'Nadira Baby Pink M', 8, 1, 97),
(78, 'Nadira Baby Pink L', 9, 1, 75),
(79, 'Wolfis Baby Pink', 35, 2, 4877),
(80, 'Square Baby Tosca S', 1, 1, 17),
(81, 'ayra baby pink XL', 5, 1, 10);

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
(60, 44, 78, 22, 1, '2020-05-02 02:10:21');

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
(23, 'Adeeva L', 285, 75000, 70000, 67500, 65000, 675000, 10000),
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
(49, 38, 2, 74, '2020-01-01 02:28:02', 1, 78000, 235),
(50, 38, 3, 80, '2020-01-01 02:28:02', 1, 42500, 240),
(51, 38, 10, 73, '2020-01-01 02:28:02', 1, 73000, 235),
(52, 38, 3, 79, '2020-01-01 02:28:02', 1, 28500, 240),
(53, 39, 10, 74, '2020-01-01 02:45:40', 1, 73000, 235),
(55, 41, 1, 73, '2020-01-01 02:58:18', 1, 78000, 235),
(57, 43, 110, 79, '2020-01-01 03:14:52', 3, 24000, 0),
(58, 44, 22, 78, '2020-05-02 02:10:21', 1, 88000, 415);

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
  `at_id` int(11) DEFAULT NULL,
  `mp_id` int(11) NOT NULL,
  `biaya_ongkir` int(11) NOT NULL,
  `status_pemesanan` int(1) NOT NULL,
  `biaya_admin` int(11) NOT NULL DEFAULT 0,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `uang_kembalian` varchar(10) NOT NULL,
  `note` varchar(50) NOT NULL,
  `status_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`pemesanan_id`, `pemesanan_nama`, `pemesanan_nama_akun`, `pemesanan_tanggal`, `pemesanan_hp`, `pemesanan_alamat`, `email_pemesan`, `kurir_id`, `at_id`, `mp_id`, `biaya_ongkir`, `status_pemesanan`, `biaya_admin`, `diskon`, `uang_kembalian`, `note`, `status_customer`) VALUES
(22, 'asdad', '-', '2019-11-10', '12131', '1213', '12131asda', 4, 3, 2, 131, 4, 0, 0, '1213', 'asda', 1),
(23, 'asdad', '-', '2019-11-10', '12131', '1213', '12131asda', 4, 3, 2, 131, 4, 0, 0, '1213', 'asda', 1),
(25, '121asa', '-', '2019-11-11', '1213', '1sa', '12131', 2, 4, 2, 121, 4, 0, 0, '1213', 'asdad', 2),
(26, 'cadsa', '-', '2019-11-11', '1231', 'asdada', 'asdadwqeq', 2, 4, 1, 12131, 4, 0, 0, '123131', 'asdada', 1),
(27, 'admin', '-', '2019-11-11', '-', '-', '-', 6, 6, 1, 0, 4, 0, 0, '0', 'asdada', 3),
(28, 'testing', '-', '2019-11-11', '0918318318', 'testing', 'testing@gmail.com', 1, 3, 1, 30000, 4, 0, 0, '30000', 'testing', 1),
(29, 'tes', '-', '2020-01-31', '019291391', 'Jon kebab bunga', 'tes', 4, 6, 3, 20000, 2, 0, 0, '0', 'barang ok', 1),
(30, 'tesla', '-', '2020-02-01', '10201301', 'tesl', 'tesla@gmail.com', 4, 6, 2, 20000, 3, 0, 0, '0', 'bni', 1),
(31, 'tescuy', 'tescuy', '2020-03-04', '12131', 'tescuy', 'tescuy', 4, 4, 3, 0, 4, 0, 0, '0', 'ad', 2),
(32, 'admin', '-', '0000-00-00', '-', '-', '-', 6, 6, 1, 0, 3, 0, 0, '0', 'produksi', 3),
(33, 'tes', '-', '0000-00-00', '01', 'afa', 'tes', 2, 6, 3, 100, 3, 0, 0, '0', 'teucu', 1),
(34, 'apala', 'apala', '0000-00-00', '120130', 'apala', 'apala', 4, 4, 3, 10000, 4, 0, 0, '0', 'note', 2),
(35, 'admin', '-', '0000-00-00', '-', '-', '-', 6, 6, 1, 0, 4, 0, 0, '0', 'ts', 3),
(36, 'tes', '-', '0000-00-00', '1213', 'tesa', 'tes', 4, 4, 2, 0, 3, 1, 1, '1', '10', 1),
(37, 'admin', '-', '0000-00-00', '-', '-', '-', 6, 6, 1, 0, 3, 0, 0, '0', 'tes', 3),
(38, 'budi', '-', '0000-00-00', '1000100', 'Jon Lunjuk jaya', 'budi@gmail.com', 4, 6, 3, 10000, 3, 0, 0, '0', 'testing', 1),
(39, 'tes', '-', '0000-00-00', '1231', 'asfa', 'Square Baby Tosca S', 5, 6, 3, 10000, 0, 0, 0, '0', 'testing', 1),
(40, 'tescuy', '-', '0000-00-00', '10210', 'tescuy', 'tescuy', 4, 7, 2, 0, 4, -100000, 0, '0', 'tescuy', 1),
(41, 'tescuy', '-', '0000-00-00', '10210', 'tescuy', 'tescuy', 4, 5, 3, 100000, 1, 100000, 100000, '100000', 'tescuy', 1),
(42, 'uang', '-', '0000-00-00', '10000', 'uanguang', 'uang', 5, 6, 3, 0, 4, -12000, 0, '0', 'tescuy', 1),
(43, 'admin', '-', '0000-00-00', '-', '-', '-', 6, 6, 1, 0, 3, 0, 0, '0', 'tescuy', 3),
(44, 'testing', '-', '0000-00-00', '08112131', 'dor', 'testing', 4, 6, 2, 1000, 0, 100, 100, '100', 'testing', 1);

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
(19, 78, 22, '2020-05-02 09:10:21', 1, 1);

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
(16, 43, 29040000, '2020-01-01 03:14:52');

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
(3, 'Stok', '10468013', 'Bumi', 'r4.jpg', 3, 'stok', '1234');

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
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
  MODIFY `hsb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `kurir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `list_barang`
--
ALTER TABLE `list_barang`
  MODIFY `lb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `uang_masuk`
--
ALTER TABLE `uang_masuk`
  MODIFY `id_uang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
