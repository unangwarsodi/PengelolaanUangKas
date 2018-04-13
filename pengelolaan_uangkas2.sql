-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 13 Apr 2018 pada 06.57
-- Versi Server: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengelolaan_uangkas2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `jabatan` varchar(40) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_organisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`id_anggota`, `nama`, `alamat`, `email`, `jabatan`, `no_telepon`, `username`, `password`, `id_organisasi`) VALUES
(33, 'Galih Sentanu', 'Panongan', 'galih1234@gmail.com', 'Wakil Ketua', '0822168209801', 'galih', 'galih', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_organisasi`
--

CREATE TABLE `tbl_organisasi` (
  `id_organisasi` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_organisasi`
--

INSERT INTO `tbl_organisasi` (`id_organisasi`, `nama`, `alamat`, `no_telepon`, `username`, `password`) VALUES
(15, 'Koprasi Siswa', 'SMK Negeri 1 Majalengka', '083324562321', 'koprasi', 'koprasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_uangkaskeluar`
--

CREATE TABLE `tbl_uangkaskeluar` (
  `id_kas_keluar` int(11) NOT NULL,
  `tanggal` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `id_organisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_uangkaskeluar`
--

INSERT INTO `tbl_uangkaskeluar` (`id_kas_keluar`, `tanggal`, `jumlah`, `keterangan`, `id_organisasi`) VALUES
(20, '28 Februari 201', 6000, 'Beli Sepidol 1', 15),
(21, '28 Februari 201', 25000, 'Beli 1 Pack Bolpoin', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_uangkasmasuk`
--

CREATE TABLE `tbl_uangkasmasuk` (
  `id_kas_masuk` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `id_organisasi` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_uangkasmasuk`
--

INSERT INTO `tbl_uangkasmasuk` (`id_kas_masuk`, `tanggal`, `jumlah`, `keterangan`, `id_organisasi`, `total`) VALUES
(54, '28 Februari 2018', 100000, 'Iuran Anggota', 15, 100000),
(55, '28 Februari 2018', 50000, 'Denda', 15, 119000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_organisasi` (`id_organisasi`);

--
-- Indexes for table `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  ADD PRIMARY KEY (`id_organisasi`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_uangkaskeluar`
--
ALTER TABLE `tbl_uangkaskeluar`
  ADD PRIMARY KEY (`id_kas_keluar`);

--
-- Indexes for table `tbl_uangkasmasuk`
--
ALTER TABLE `tbl_uangkasmasuk`
  ADD PRIMARY KEY (`id_kas_masuk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  MODIFY `id_organisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_uangkaskeluar`
--
ALTER TABLE `tbl_uangkaskeluar`
  MODIFY `id_kas_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_uangkasmasuk`
--
ALTER TABLE `tbl_uangkasmasuk`
  MODIFY `id_kas_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD CONSTRAINT `tbl_anggota_ibfk_1` FOREIGN KEY (`id_organisasi`) REFERENCES `tbl_organisasi` (`id_organisasi`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
