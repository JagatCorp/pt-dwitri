-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2024 pada 22.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dwiputri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jasa`
--

CREATE TABLE `tb_jasa` (
  `id` int(8) NOT NULL,
  `jenis_jasa_id` int(4) NOT NULL,
  `nilai_spk` int(8) NOT NULL,
  `margin_spk` int(8) NOT NULL,
  `pajak` int(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenisjasa`
--

CREATE TABLE `tb_jenisjasa` (
  `id` int(4) NOT NULL,
  `nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jenisjasa`
--

INSERT INTO `tb_jenisjasa` (`id`, `nama`) VALUES
(1, 'dddd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenispengadaan`
--

CREATE TABLE `tb_jenispengadaan` (
  `id` int(4) NOT NULL,
  `nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jenispengadaan`
--

INSERT INTO `tb_jenispengadaan` (`id`, `nama`) VALUES
(1, 'PT. Expektasi Global Indonesia66');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nidi`
--

CREATE TABLE `tb_nidi` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `daya` int(6) NOT NULL,
  `rupiah` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_nidi`
--

INSERT INTO `tb_nidi` (`id`, `nama`, `alamat`, `daya`, `rupiah`) VALUES
(1, 'werw77', 'dsafadf77', 347, 227),
(2, 'dddd', 'Blok Maju Rt. 11/03', 4566, 333);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id` int(4) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jk` enum('P','L') NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id`, `nama_pegawai`, `alamat`, `jk`, `no_telp`) VALUES
(1, 'calita55', 'fdafa55', 'P', '4566655'),
(2, 'Calita', 'Blok Maju Rt. 11/03', 'L', '2222');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengadaan`
--

CREATE TABLE `tb_pengadaan` (
  `id` int(8) NOT NULL,
  `jenis_pengadaan_id` int(4) NOT NULL,
  `nilai_pengadaan` int(8) NOT NULL,
  `margin_pengadaan` int(8) NOT NULL,
  `pajak` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengadaan`
--

INSERT INTO `tb_pengadaan` (`id`, `jenis_pengadaan_id`, `nilai_pengadaan`, `margin_pengadaan`, `pajak`) VALUES
(1, 1, 55, 55, 55),
(2, 1, 32, 23, 23);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id` int(8) NOT NULL,
  `jenis_pengeluaran` enum('1','2') NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jml_pengeluaran` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_slo`
--

CREATE TABLE `tb_slo` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `daya` int(6) NOT NULL,
  `rupiah` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_slo`
--

INSERT INTO `tb_slo` (`id`, `nama`, `alamat`, `daya`, `rupiah`) VALUES
(1, 'dddd44', 'Blok Maju Rt. 11/0344', 45664, 3334);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `email`, `password`, `phone`, `picture`, `address`, `active`) VALUES
(3, 'Budi handoko', 'admin1', 'datacenter@gmail.com', 'admin', '8522421649966', '1708066586479-infaq.png', 'Kota baru Keandra ds. Sindang Jawa Cluster Drosia F106', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jasa`
--
ALTER TABLE `tb_jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jenisjasa`
--
ALTER TABLE `tb_jenisjasa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jenispengadaan`
--
ALTER TABLE `tb_jenispengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_nidi`
--
ALTER TABLE `tb_nidi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengadaan`
--
ALTER TABLE `tb_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_slo`
--
ALTER TABLE `tb_slo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jasa`
--
ALTER TABLE `tb_jasa`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_jenisjasa`
--
ALTER TABLE `tb_jenisjasa`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_jenispengadaan`
--
ALTER TABLE `tb_jenispengadaan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_nidi`
--
ALTER TABLE `tb_nidi`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pengadaan`
--
ALTER TABLE `tb_pengadaan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_slo`
--
ALTER TABLE `tb_slo`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
