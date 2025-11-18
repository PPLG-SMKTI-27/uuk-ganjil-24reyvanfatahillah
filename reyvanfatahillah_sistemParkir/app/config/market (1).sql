-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2025 at 01:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_transaksi`
--

CREATE TABLE `daftar_transaksi` (
  `id_transaksi` int NOT NULL,
  `id_parkir` int NOT NULL,
  `id_petugas` int NOT NULL,
  `total_pembayaran` decimal(11,2) NOT NULL,
  `jam_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parkiran`
--

CREATE TABLE `parkiran` (
  `id_parkir` int NOT NULL,
  `id_tipe` int NOT NULL,
  `biaya` decimal(11,2) NOT NULL,
  `jam_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jam_keluar` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('masukParkir','prosesPembayaran','keluarParkir') NOT NULL DEFAULT 'masukParkir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kendaraan`
--

CREATE TABLE `tipe_kendaraan` (
  `id_tipe` int NOT NULL,
  `tipe` enum('roda dua','roda empat') NOT NULL,
  `harga` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipe_kendaraan`
--

INSERT INTO `tipe_kendaraan` (`id_tipe`, `tipe`, `harga`) VALUES
(1, 'roda dua', '5000.00'),
(2, 'roda empat', '10000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','petugas loket') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`) VALUES
(1, 'admin', 'adm@admin.com', '12345678', 'admin'),
(2, 'petugas loket', 'petugas@loket.com', '12345678', 'petugas loket');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_transaksi`
--
ALTER TABLE `daftar_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_parkir` (`id_parkir`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `parkiran`
--
ALTER TABLE `parkiran`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- Indexes for table `tipe_kendaraan`
--
ALTER TABLE `tipe_kendaraan`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_transaksi`
--
ALTER TABLE `daftar_transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parkiran`
--
ALTER TABLE `parkiran`
  MODIFY `id_parkir` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipe_kendaraan`
--
ALTER TABLE `tipe_kendaraan`
  MODIFY `id_tipe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_transaksi`
--
ALTER TABLE `daftar_transaksi`
  ADD CONSTRAINT `daftar_transaksi_ibfk_1` FOREIGN KEY (`id_parkir`) REFERENCES `parkiran` (`id_parkir`),
  ADD CONSTRAINT `daftar_transaksi_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `parkiran`
--
ALTER TABLE `parkiran`
  ADD CONSTRAINT `parkiran_ibfk_1` FOREIGN KEY (`id_tipe`) REFERENCES `tipe_kendaraan` (`id_tipe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
