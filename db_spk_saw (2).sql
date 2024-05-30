-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 07:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_nilai`
--

CREATE TABLE `detail_nilai` (
  `id` int(4) NOT NULL,
  `id_soal` int(4) NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `id_pegawai` int(4) NOT NULL,
  `nilai` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_nilai`
--

INSERT INTO `detail_nilai` (`id`, `id_soal`, `id_kategori`, `id_pegawai`, `nilai`) VALUES
(1, 3, 1, 2, 20),
(2, 4, 1, 2, 5),
(3, 5, 1, 2, 20),
(4, 6, 1, 2, 20),
(5, 7, 1, 2, 20),
(6, 8, 3, 2, 20),
(7, 9, 3, 2, 20),
(8, 10, 3, 2, 20),
(9, 11, 3, 2, 20),
(10, 12, 3, 2, 20),
(11, 13, 4, 2, 20),
(12, 14, 4, 2, 20),
(13, 15, 4, 2, 20),
(14, 16, 4, 2, 20),
(15, 17, 4, 2, 20),
(16, 18, 2, 2, 20),
(17, 19, 2, 2, 20),
(18, 20, 2, 2, 20),
(19, 21, 2, 2, 20),
(20, 22, 2, 2, 20);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(4) NOT NULL,
  `nama_kategori` varchar(35) NOT NULL,
  `prosentase` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `prosentase`) VALUES
(1, 'Disiplin', 30),
(2, 'Kejujuran', 35),
(3, 'Kinerja', 20),
(4, 'Kreativitas', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(4) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `foto` varchar(100) NOT NULL,
  `K1` int(4) DEFAULT NULL,
  `K2` int(4) DEFAULT NULL,
  `K3` int(4) DEFAULT NULL,
  `K4` int(4) DEFAULT NULL,
  `total` decimal(6,2) DEFAULT NULL,
  `createdAtDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `tempat_lahir`, `tgl_lahir`, `tgl_masuk`, `no_hp`, `jabatan`, `email`, `alamat`, `status`, `foto`, `K1`, `K2`, `K3`, `K4`, `total`, `createdAtDate`) VALUES
(2, 'Nazriel', 'cirebon', '2024-01-27', '2024-01-27', '+6289508303311', 'programer', 'wijayatoyota09@gmail.com', 'fda', 'Y', '1706273941575-LOGO-PIC.png', 85, 100, 100, 100, 0.00, '2024-01-26 19:59:01'),
(3, 'Shinta', 'cirebon', '2024-02-26', '2024-02-27', '+6289508303311', 'programer', 'wijayatoyota09@gmail.com', 'Kota baru Keandra ds. Sindang Jawa Cluster Drosia F106', 'N', '1708939560349-DINA.png', 0, 0, 0, 0, 0.00, '2024-02-26 16:26:00'),
(4, 'Susi', 'cirebon', '2024-03-02', '2024-03-09', '8522421649966', 'direktur66', 'csjagatgenius@gmail.com', 'Blok maju Rt. 11/03 Ds. Tegalwangi Cirebon', 'N', '1708939602117-intan.png', 0, 0, 0, 0, 0.00, '2024-02-26 16:26:42'),
(5, 'Anton', 'cirebon6', '2024-02-02', '2024-02-10', '085224216499', 'programer', 'wijayatoyota09@gmail.com', 'Kota baru Keandra ds. Sindang Jawa Cluster Drosia F106', 'N', '1708939903976-konna.png', 0, 0, 0, 0, 0.00, '2024-02-26 16:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(4) NOT NULL,
  `id_kategori` int(2) NOT NULL,
  `deskripsi_soal` text NOT NULL,
  `skor_nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_kategori`, `deskripsi_soal`, `skor_nilai`) VALUES
(3, 1, 'Soal Disiplin 1', 20),
(4, 1, 'Soal Disiplin 2', 20),
(5, 1, 'Soal Disiplin 3', 20),
(6, 1, 'Soal Disiplin 4', 20),
(7, 1, 'Soal Disiplin 5', 20),
(8, 3, 'Soal KInerja', 20),
(9, 3, 'Soal Kinerja', 20),
(10, 3, 'Soal Kinerja', 20),
(11, 3, 'Soal Kinerja', 20),
(12, 3, 'Soal Kinerja', 20),
(13, 4, 'Soal Kreativitas1', 20),
(14, 4, 'Soal Kreativitas2', 20),
(15, 4, 'Soal Kreativitas3', 20),
(16, 4, 'Soal Kreativitas4', 20),
(17, 4, 'Soal Kreativitas5', 20),
(18, 2, 'Soal kejujuruan 1', 20),
(19, 2, 'Soal kejujuruan 2', 20),
(20, 2, 'Soal kejujuruan 3', 20),
(21, 2, 'Soal kejujuruan 4', 20),
(22, 2, 'Soal kejujuruan 5', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(35) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `address` varchar(80) NOT NULL,
  `active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `email`, `password`, `phone`, `picture`, `address`, `active`) VALUES
(3, 'Budi handoko', 'admin1', 'datacenter@gmail.com', 'admin', '8522421649966', '1708066586479-infaq.png', 'Kota baru Keandra ds. Sindang Jawa Cluster Drosia F106', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
