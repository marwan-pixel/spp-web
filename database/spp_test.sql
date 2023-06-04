-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 03:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`kode_petugas`, `nama_petugas`, `password`) VALUES
('12121', 'Jane Do', '$2y$10$8JQ0nOZ6vAufw2ihrIhOkOc6sqjOZuLJgPpAjZjqDCIs27zy3vPJO'),
('12122', 'Alex', '$2y$10$BfFmuKbzhTbxf6Kuzi3Yh.1rTTTvRJW7w5XQps8MI2C3MkNSTAAqK');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `instansi` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`instansi`) VALUES
('PONPES AR-RAHMAH'),
('SD AR-RAHMAH'),
('SMP AR-RAHMAH'),
('TK AR-RAHMAH');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis_pembayaran` int(11) NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `biaya` int(11) NOT NULL,
  `instansi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis_pembayaran`, `jenis_pembayaran`, `biaya`, `instansi`) VALUES
(1, 'Biaya SPP SD', 100000, 'SMP AR-RAHMAH'),
(2, 'Tabungan SD', 25000, 'SD AR-RAHMAH'),
(3, 'Biaya Laundry', 15000, 'PONPES AR-RAHMAH');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas` varchar(6) NOT NULL,
  `instansi` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas`, `instansi`) VALUES
('7C', 'PONPES AR-RAHMAH'),
('8C', 'PONPES AR-RAHMAH'),
('9C', 'PONPES AR-RAHMAH'),
('1', 'SD AR-RAHMAH'),
('2', 'SD AR-RAHMAH'),
('3', 'SD AR-RAHMAH'),
('4', 'SD AR-RAHMAH'),
('5', 'SD AR-RAHMAH'),
('6', 'SD AR-RAHMAH'),
('7A', 'SMP AR-RAHMAH'),
('7B', 'SMP AR-RAHMAH'),
('8A', 'SMP AR-RAHMAH'),
('8B', 'SMP AR-RAHMAH'),
('9A', 'SMP AR-RAHMAH'),
('9B', 'SMP AR-RAHMAH'),
('TK A', 'TK AR-RAHMAH'),
('TK B', 'TK AR-RAHMAH');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nipd` int(10) NOT NULL,
  `nama_siswa` varchar(40) NOT NULL,
  `kelas` varchar(6) NOT NULL,
  `password` varchar(255) NOT NULL,
  `potongan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nipd`, `nama_siswa`, `kelas`, `password`, `potongan`) VALUES
(101010101, 'Jin Doe', 'TK A', '$2y$10$SwEOwrXGJ37Xe0qfsssbs.OvEJ3.6T6aBiCXk8/a.N4xSpI0PmtnC', 0),
(101010102, 'Jon Doe', 'TK A', '$2y$10$m.dr8XLYAoeM1pKtjL.EIenppu4JdpdEqgRD9ygdETFbWo7ZzeLPO', 0),
(101010103, 'Jun Doe', 'TK B', '$2y$10$XroqxpwvW8A0j2R34dYlmOJJYOcf96RrEniOh3HxGD33GBTvNQIp.', 0),
(101010104, 'Jo Do', '1', '$2y$10$WlvhCZyvgvLOiU6h4YqTpuvrqADl6FT7oZgLInV1Z0gfpupYN6Gyq', 10),
(101010105, 'Alex', '1', '$2y$10$kyJ08nP9cQOn2.ifGSHHDOYieRIaLKObmnLTlKbBT3WBaq2n79qlK', 0),
(101010106, 'Alexa', 'TK A', '$2y$10$ea/TCxsx6hV1EP2j/ADhL.kZ8vam0ozFajkE1t63jHVhwJrxypWSm', 0),
(101010107, 'Lala', 'TK B', '$2y$10$efLXLp1fA2wCnPEg0zrYz.0B6KbpiPIU3zncDgKnK5d0d9PNQcAd2', 0),
(101010108, 'Lili', 'TK B', '$2y$10$7hDEbBPsB.GgSV7Doq3vgO9nIZ3pS7rz/5bH.SX5fsBBJ6iQHhXX2', 0),
(101010109, 'Lulu', 'TK B', '$2y$10$bCnt8Px4xYMbI9MSa7XgvOrAOCvAfLrRT90zBWuugQXrIrqROKD.y', 0),
(101010110, 'Dila', '1', '$2y$10$D.AJxh6S/2rtvb4.T8uJX.0Xi9cAOlJe5PM55C1ZEc6TvG/Xusy5O', 0),
(101010111, 'Laras', 'TK A', '$2y$10$iIxUQaBvaKQapYJjsJ2oqOGTp8YCgDD6LDqr0.UcDY7VDBPcZ/MZ2', 0),
(101010112, 'Mono', '2', '$2y$10$D.o7LbOD6S/S9lLo25ejh.eZi7lDnXCGd4L0rcgwu08dnc2khyjI6', 0),
(101010113, 'Ninoo', '7A', '$2y$10$R3mZ118ckWuJ0YBsuDckk.UOIk7LNFV0VkFB3jCzBf5h2vLzZGHCq', 0),
(101010114, 'Bono', '7A', '$2y$10$Y75.192L9tFfynt/SI7/MuVGviMbiWkiHt/2.7EmME2EZOsfoK.tm', 0),
(101010115, 'Bobob', '7A', '$2y$10$DD2ewntBO9Bhw.M94t9Vfe5nsU38C2HLnB3H6YLP56zmurJq2rVX6', 0),
(101010116, 'Bibib', '7B', '$2y$10$dYPDov5TB.oeNHi/g6cXI.QgfDkHulB3HxBJVQToJjkgAZzqfM11m', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `no_transaksi` int(11) NOT NULL,
  `nipd` int(10) NOT NULL,
  `nominal` int(7) NOT NULL,
  `status` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`instansi`) USING BTREE;

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis_pembayaran`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas`) USING BTREE,
  ADD KEY `instansi` (`instansi`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nipd`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `nis` (`nipd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id_jenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
