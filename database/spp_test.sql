-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 11:59 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `kode_petugas` varchar(10) NOT NULL,
  `nama_petugas` varchar(28) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`kode_petugas`, `nama_petugas`, `password`, `status`) VALUES
('12121', 'Jane Do', '$2y$10$8JQ0nOZ6vAufw2ihrIhOkOc6sqjOZuLJgPpAjZjqDCIs27zy3vPJO', 1),
('12122', 'Alex', '$2y$10$BfFmuKbzhTbxf6Kuzi3Yh.1rTTTvRJW7w5XQps8MI2C3MkNSTAAqK', 1),
('12123', 'Malas', '$2y$10$vC7SssMXOFs5UYq6fEfSzuDoVRR2oc88/J4Ysj6w5TAFNGMZZAwCO', 1),
('6873278425', 'nlknlnl', '$2y$10$1mum/RiWanF8h/SO.XH2nupRN5yec/Pm1bMZzuz9Rr5dnUvV7LzEG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `jenis_instansi` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`jenis_instansi`, `status`) VALUES
('PONPES AR-RAHMAH', 1),
('SD AR-RAHMAH', 1),
('SMK AR-RAHMAH', 0),
('SMP AR-RAHMAH', 1),
('TK AR-RAHMAH', 1);

--
-- Triggers `instansi`
--
DELIMITER $$
CREATE TRIGGER `nonactivated_biaya` AFTER UPDATE ON `instansi` FOR EACH ROW IF (NEW.status = 0) 
THEN
    UPDATE jenis_pembayaran SET 
    jenis_pembayaran.status = NEW.status
    WHERE jenis_pembayaran.instansi = NEW.jenis_instansi;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nonactivated_instansi` AFTER UPDATE ON `instansi` FOR EACH ROW IF (NEW.status = 0) THEN
    UPDATE kelas SET kelas.status = NEW.status
    WHERE kelas.instansi = NEW.jenis_instansi;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_instansi` AFTER UPDATE ON `instansi` FOR EACH ROW UPDATE kelas
set kelas.instansi = NEW.jenis_instansi 
WHERE
kelas.instansi = NEW.jenis_instansi
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis_pembayaran` int(11) NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `biaya` int(11) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis_pembayaran`, `jenis_pembayaran`, `biaya`, `instansi`, `status`) VALUES
(1, 'Biaya SPP SD', 100000, 'SD AR-RAHMAH', 1),
(2, 'Tabungan SD', 25000, 'SD AR-RAHMAH', 1),
(3, 'Biaya Laundry', 15000, 'PONPES AR-RAHMAH', 1),
(4, 'Biaya SPP TK', 150000, 'TK AR-RAHMAH', 1),
(5, 'Iuran Renang', 25000, 'SD AR-RAHMAH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas` varchar(6) NOT NULL,
  `instansi` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas`, `instansi`, `status`) VALUES
('1', 'SD AR-RAHMAH', 1),
('2', 'SD AR-RAHMAH', 1),
('3', 'SD AR-RAHMAH', 1),
('4', 'SD AR-RAHMAH', 1),
('5', 'SD AR-RAHMAH', 1),
('6', 'SD AR-RAHMAH', 1),
('7A', 'SMP AR-RAHMAH', 1),
('7B', 'SMP AR-RAHMAH', 1),
('7C', 'PONPES AR-RAHMAH', 1),
('8A', 'SMP AR-RAHMAH', 1),
('8B', 'SMP AR-RAHMAH', 1),
('8C', 'PONPES AR-RAHMAH', 1),
('9A', 'SMP AR-RAHMAH', 1),
('9B', 'SMP AR-RAHMAH', 1),
('9C', 'PONPES AR-RAHMAH', 1),
('TK A', 'TK AR-RAHMAH', 1),
('TK B', 'TK AR-RAHMAH', 1);

--
-- Triggers `kelas`
--
DELIMITER $$
CREATE TRIGGER `nonactivated_kelas` AFTER UPDATE ON `kelas` FOR EACH ROW IF (NEW.status = 0) THEN
    UPDATE siswa set siswa.status = new.status
    WHERE siswa.kelas = new.kelas;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_kelas` AFTER UPDATE ON `kelas` FOR EACH ROW UPDATE siswa
  SET kelas = NEW.kelas
  WHERE siswa.kelas = NEW.kelas
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nipd` int(10) NOT NULL,
  `nama_siswa` varchar(40) NOT NULL,
  `kelas` varchar(6) DEFAULT NULL,
  `thn_akademik` varchar(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `potongan` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nipd`, `nama_siswa`, `kelas`, `thn_akademik`, `password`, `potongan`, `status`) VALUES
(1010101010, 'FIONA ADELYA', '1', '2024/2025', '$2y$10$bbg3bV/OnhFlxdxaPaCJOuXz.hy8L0/PM1Ah/LrZpeECagcgao.ae', 0, 1),
(1010101012, 'Jane Doe', '1', '2022/2023', '$2y$10$aSxcfudFcNN9i6erDeJjZepdnJWP2wHr9XfkzPA5yNJVa1LZl6ihu', 0, 1),
(2147483647, 'Muhammad Alkenzio Ghaisan Firdaus', '3', '2024/2025', '$2y$10$86d92Skfw8lbyWcx4Xud6.iTExIxF2YCYpUxhJeSIMSp92C4i8u.6', 0, 1);

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `update_siswa` AFTER UPDATE ON `siswa` FOR EACH ROW UPDATE transactions SET
	transactions.nipd = NEW.nipd
   	WHERE transactions.nipd = NEW.nipd
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `thn_akademik` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`thn_akademik`, `status`) VALUES
('2001/2002', 1),
('2020/2021', 0),
('2021/2022', 0),
('2022/2023', 0),
('2023/2024', 0),
('2024/2025', 0);

--
-- Triggers `tahun_akademik`
--
DELIMITER $$
CREATE TRIGGER `update_tahun_akademik` AFTER UPDATE ON `tahun_akademik` FOR EACH ROW UPDATE siswa 
SET siswa.thn_akademik = NEW.thn_akademik
WHERE siswa.thn_akademik = NEW.thn_akademik
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `no_transaksi` int(11) NOT NULL,
  `nipd` int(10) NOT NULL,
  `nominal` int(7) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`no_transaksi`, `nipd`, `nominal`, `status`, `image`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2147483647, 25000, 2, 'bukti.png', 'Biaya SPP SD Untuk 3 Bulan', '2023-06-02 11:02:15', '2023-07-07 11:49:55'),
(2, 2147483647, 25000, 2, 'bukti.png', 'Biaya SPP SD', '2023-05-05 11:04:45', '2023-07-07 11:50:02'),
(3, 2147483647, 25000, 2, 'bukti.png', 'Biaya SPP SD', '2023-04-06 11:04:45', '2023-07-07 11:50:03'),
(4, 1010101010, 25000, 1, 'bukti.png', 'Biaya SPP SD', '2023-06-02 11:51:32', '2023-07-09 10:00:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kode_petugas`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`jenis_instansi`) USING BTREE;

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis_pembayaran`),
  ADD KEY `instansi` (`instansi`) USING BTREE;

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas`) USING BTREE,
  ADD KEY `instansi` (`instansi`) USING BTREE;

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nipd`),
  ADD KEY `kelas` (`kelas`),
  ADD KEY `tahun_akademik` (`thn_akademik`);

--
-- Indexes for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`thn_akademik`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `nipd` (`nipd`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id_jenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD CONSTRAINT `jenis_pembayaran_ibfk_1` FOREIGN KEY (`instansi`) REFERENCES `instansi` (`jenis_instansi`) ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`instansi`) REFERENCES `instansi` (`jenis_instansi`) ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`thn_akademik`) REFERENCES `tahun_akademik` (`thn_akademik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`nipd`) REFERENCES `siswa` (`nipd`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
