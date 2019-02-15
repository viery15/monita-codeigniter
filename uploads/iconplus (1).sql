-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2019 at 08:25 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iconplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `jenis_layanan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `jenis_layanan`) VALUES
(6, 'INTRANET');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id_master` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `no_so` varchar(255) NOT NULL,
  `no_io` varchar(255) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `tgl_masuk_verif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nip_ptl` char(20) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `keterangan` text,
  `site_id` varchar(255) NOT NULL,
  `nip_pic` char(20) NOT NULL,
  `tgl_verifikasi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_pekerjaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id_master`, `nama_pelanggan`, `no_so`, `no_io`, `id_layanan`, `tgl_masuk_verif`, `nip_ptl`, `id_mitra`, `keterangan`, `site_id`, `nip_pic`, `tgl_verifikasi`, `status_pekerjaan`) VALUES
(82, 'SMK KEPUTIH', 'PA/ACT/11/TER', '12345', 6, '2019-02-10 09:11:54', '2110161012', 3, 'sadaisaaa', 'a', '1', '2019-02-10 09:11:54', 'belum terverifikasi'),
(83, 'PUSKESMAS KEPUTIH', 'PA/ACT/12/TER', '23123133', 6, '2019-02-10 12:50:06', '2110161012', 2, 'ASDASD', '', '', '0000-00-00 00:00:00', 'belum terverifikasi'),
(84, 'PUSKESMAS KEPUTIH', 'PA/ACT/12/TER', '23123133', 6, '2019-02-10 12:50:11', '2110161012', 2, 'ASDASD', '', '', '0000-00-00 00:00:00', 'belum terverifikasi'),
(85, 'PUSKESMAS KEPUTIH', 'PA/ACT/12/TER', '23123133', 6, '2019-02-10 12:50:12', '2110161012', 2, 'ASDASD', '', '', '0000-00-00 00:00:00', 'belum terverifikasi'),
(86, 'PUSKESMAS KEPUTIH', 'PA/ACT/12/TER', '23123133', 6, '2019-02-10 12:50:14', '2110161012', 2, 'ASDASD', '', '', '0000-00-00 00:00:00', 'belum terverifikasi'),
(87, 'XX', 'A', 'C', 6, '2019-02-10 12:51:52', '2110161012', 4, 'ZX', '', '', '0000-00-00 00:00:00', 'belum terverifikasi'),
(88, 'weffwef', 'sdfsf', 'dfdf', 6, '2019-02-10 12:59:09', '2110161025', 2, '', '', '', '0000-00-00 00:00:00', 'belum terverifikasi'),
(89, 'uiigi', 'jbk', 'kjk', 6, '2019-02-10 13:01:25', '2110161025', 2, '', '', '', '0000-00-00 00:00:00', 'belum terverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_perusahaan`) VALUES
(2, 'GMT'),
(3, 'AZKA'),
(4, 'SIMBIKA'),
(5, 'kks');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nip` char(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `role` char(20) NOT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nip`, `nama`, `username`, `password`, `no_telp`, `role`, `email`) VALUES
(2, '2110161012', 'farhan', 'farhangendut', 'farhangendut', '081233186926', 'asset', NULL),
(3, '2110161025', 'yos', 'yos', 'yos', '087850408057', 'aktivasi', NULL),
(4, '6768689', 'admin', 'admin', 'admin', '65798787', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id_master`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
