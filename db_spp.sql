-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26 Mar 2023 pada 16.14
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`) VALUES
(1, 'Administrator', 'admin@gmail.com', '$2y$10$9sgLIZvdTjtQ2MYG3jty.uXFw4tXoq3it2iwoe/S11GMewv8ooywG'),
(2, 'Firenze Higa ', 'firenzehiga@gmail.com', '$2y$10$Vs63Lohh1tqf.05r4nkQjOKVrYYp1K/GEzqcDdT8oiBfEIi2oFVga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jurusan`) VALUES
(1, 'X', 'DKV 1'),
(2, 'X', 'DKV 2'),
(3, 'X', 'DKV 3'),
(4, 'X', 'TKJ'),
(5, 'X', 'RPL 1'),
(6, 'X', 'RPL 2'),
(7, 'XI', 'MM 1'),
(8, 'XI', 'MM 2'),
(9, 'XI', 'TKJ 1'),
(10, 'XI', 'TKJ 2'),
(11, 'XI', 'RPL'),
(12, 'XII', 'MM 1'),
(13, 'XII', 'MM 2'),
(14, 'XII', 'MM 3'),
(15, 'XII', 'MM 4'),
(16, 'XII', 'TKJ 1'),
(17, 'XII', 'TKJ 2'),
(18, 'XII', 'RPL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `trxid` varchar(50) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `spp_bulan` int(11) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `trxid`, `id_admin`, `id_siswa`, `tgl_bayar`, `spp_bulan`, `id_spp`, `jumlah_bayar`) VALUES
(7, '184027', 1, 20, '2023-03-23', 1, 1, 300000),
(8, '276719', 1, 10, '2023-03-23', 2, 1, 300000),
(9, '657443', 1, 10, '2023-03-24', 1, 1, 300000),
(10, '556776', 1, 10, '2023-03-24', 4, 1, 300000),
(11, '480685', 1, 28, '2023-03-25', 1, 1, 300000),
(12, '279242', 1, 21, '2023-03-25', 2, 1, 300000),
(13, '538845', 1, 22, '2023-03-26', 4, 1, 300000),
(15, '300455', 1, 10, '2023-03-26', 3, 1, 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `id_spp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nama_siswa`, `email`, `password`, `id_kelas`, `alamat`, `no_telp`, `id_spp`) VALUES
(10, '0042376555', 'Doni Irawan ', 'ggwpkuzo@gmail.com', '$2y$10$nD6dFkT/W5Txw7TeoCfpeeDYSZMLfY1hv9ekUfuN87/Mgw1Sibqwe', 17, 'PuriCDASDAS', '2221213', 1),
(20, '0052376555', 'Adiputra', 'pemilik@gmail.com', '$2y$10$nD6dFkT/W5Txw7TeoCfpeeDYSZMLfY1hv9ekUfuN87/Mgw1Sibqwe', 15, 'Puri', '2221213', 1),
(21, '0053456558', 'Adiputra', 'admin@gmail.com', '$2y$10$nD6dFkT/W5Txw7TeoCfpeeDYSZMLfY1hv9ekUfuN87/Mgw1Sibqwe', 1, 'Anjay Mabar', '0895940432523', 1),
(22, '0052376558', 'Firenze Higa Putra', 'putrayanda@gmail.com', '$2y$10$nD6dFkT/W5Txw7TeoCfpeeDYSZMLfY1hv9ekUfuN87/Mgw1Sibqwe', 1, 'xasdasdasd', '0895940432523', 1),
(24, '0052376558', 'Adiputra', 'admin@gmail.com', '$2y$10$nD6dFkT/W5Txw7TeoCfpeeDYSZMLfY1hv9ekUfuN87/Mgw1Sibqwe', 1, 'asdsad', '0895940432523', 1),
(28, '005237232', 'Angger Cakra', 'angger@gmail.com', '$2y$10$nD6dFkT/W5Txw7TeoCfpeeDYSZMLfY1hv9ekUfuN87/Mgw1Sibqwe', 18, 'jauh', '2221213', 1),
(32, '0022376558', 'Adiputra', 'putrayanda@gmail.com', '$2y$10$nD6dFkT/W5Txw7TeoCfpeeDYSZMLfY1hv9ekUfuN87/Mgw1Sibqwe', 1, 'asasa', '081283185233', 1),
(33, '11111111111', 'Pandu Jon', 'admin@gmail.com', '$2y$10$7fzy9BDDHI6/p8I6MrX8RODT/utdz8Dq3t5SJz773Wv1KhOag0McG', 2, 'aa', '0895940432523', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2023, 300000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
