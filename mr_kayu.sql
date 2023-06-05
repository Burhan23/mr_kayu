-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 03:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mr_kayu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_mrkayu`
--

CREATE TABLE `admin_mrkayu` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_mrkayu`
--

INSERT INTO `admin_mrkayu` (`id`, `fname`, `email`, `username`, `role`, `password`) VALUES
(1, 'FARHAN BURHANUDIN SAIFULLAH', 'admin@gmail.com', 'admin', 3, 'kelompok');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id` int(11) NOT NULL,
  `id_investor` int(11) NOT NULL,
  `id_pengrajin` int(11) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `metode` varchar(10) NOT NULL,
  `nomer` varchar(50) NOT NULL,
  `bukti` varchar(100) NOT NULL DEFAULT 'SCAM',
  `status` varchar(50) NOT NULL DEFAULT '1',
  `id_invest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayar`
--


-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id_invest` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pembayaran`
--


-- --------------------------------------------------------

--
-- Table structure for table `invest`
--

CREATE TABLE `invest` (
  `id` int(11) NOT NULL,
  `id_investor` int(11) NOT NULL,
  `id_pengrajin` int(11) NOT NULL,
  `jumlah_dana` int(100) NOT NULL,
  `status_investor` text NOT NULL DEFAULT 'Permintaan sudah dikirim, Menunggu respon',
  `status_pengrajin` text NOT NULL DEFAULT 'Menunggu respon',
  `status` varchar(100) NOT NULL DEFAULT '1',
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `mou` varchar(100) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invest`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_product` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` mediumtext NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--


-- --------------------------------------------------------

--
-- Table structure for table `progres_pengrajin`
--

CREATE TABLE `progres_pengrajin` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_selesai` date NOT NULL DEFAULT (current_timestamp() + interval 7 day),
  `status` varchar(50) NOT NULL DEFAULT '0',
  `id_users` int(11) NOT NULL,
  `record` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progres_pengrajin`
--


-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'Pengrajin'),
(2, 'Investor'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `upgrade`
--

CREATE TABLE `upgrade` (
  `id` int(11) NOT NULL,
  `npwp` varchar(15) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `no_rekening` varchar(30) NOT NULL,
  `deskripsi` mediumtext NOT NULL,
  `bukti_ktp` varchar(100) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upgrade`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `pp` varchar(100) NOT NULL DEFAULT 'default-pp.png',
  `role` int(11) NOT NULL,
  `npwp` varchar(15) NOT NULL DEFAULT 'false',
  `nik` varchar(15) NOT NULL DEFAULT 'false',
  `no_rekening` varchar(30) NOT NULL DEFAULT 'false',
  `deskripsi` text NOT NULL DEFAULT 'Ini merupakan desktipsi pengrajin mengenai kerajinan',
  `last_login` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_mrkayu`
--
ALTER TABLE `admin_mrkayu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_investor` (`id_investor`),
  ADD KEY `id_pengrajin` (`id_pengrajin`),
  ADD KEY `id_invest` (`id_invest`);

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD KEY `id_invest` (`id_invest`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `invest`
--
ALTER TABLE `invest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_investor` (`id_investor`),
  ADD KEY `id_pengrajin` (`id_pengrajin`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `progres_pengrajin`
--
ALTER TABLE `progres_pengrajin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npwp` (`npwp`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `no_rekening` (`no_rekening`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_telepon` (`no_telepon`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `invest`
--
ALTER TABLE `invest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `progres_pengrajin`
--
ALTER TABLE `progres_pengrajin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_mrkayu`
--
ALTER TABLE `admin_mrkayu`
  ADD CONSTRAINT `admin_mrkayu_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bayar`
--
ALTER TABLE `bayar`
  ADD CONSTRAINT `bayar_ibfk_1` FOREIGN KEY (`id_investor`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bayar_ibfk_2` FOREIGN KEY (`id_pengrajin`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bayar_ibfk_3` FOREIGN KEY (`id_invest`) REFERENCES `invest` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD CONSTRAINT `detail_pembayaran_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_mrkayu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_pembayaran_ibfk_2` FOREIGN KEY (`id_invest`) REFERENCES `invest` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invest`
--
ALTER TABLE `invest`
  ADD CONSTRAINT `invest_ibfk_1` FOREIGN KEY (`id_investor`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invest_ibfk_2` FOREIGN KEY (`id_pengrajin`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `progres_pengrajin`
--
ALTER TABLE `progres_pengrajin`
  ADD CONSTRAINT `progres_pengrajin_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `progres_pengrajin_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD CONSTRAINT `upgrade_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
