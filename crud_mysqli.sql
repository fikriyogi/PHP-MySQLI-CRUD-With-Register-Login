-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jan 2018 pada 20.29
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crud_mysqli`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`id_log` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tgl_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `email`, `tgl_log`) VALUES
(1, 'fikriyogi@gmail.com', '2018-01-18 19:06:26'),
(2, 'fikriyogi@gmail.com', '2018-01-18 19:06:33'),
(3, 'fikriyogi@gmail.com', '2018-01-18 19:08:54'),
(4, 'fikriyogi@gmail.com', '2018-01-18 19:10:00'),
(5, 'fikriyogi@gmail.com', '2018-01-18 19:11:13'),
(6, 'fikriyogi@gmail.com', '2018-01-18 19:13:28'),
(7, 'fikriyogi@gmail.com', '2018-01-18 19:16:44'),
(8, 'fikriyogi5@gmail.com', '2018-01-18 19:18:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mhsasia`
--

CREATE TABLE IF NOT EXISTS `mhsasia` (
`id` int(5) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `alamat` varchar(35) NOT NULL,
  `nim` varchar(12) NOT NULL,
  `email` varchar(34) NOT NULL,
  `dusun` varchar(50) NOT NULL,
  `rt` char(3) NOT NULL,
  `rw` char(3) NOT NULL,
  `no_telpon` varchar(34) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `nik` char(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mhsasia`
--

INSERT INTO `mhsasia` (`id`, `nama`, `alamat`, `nim`, `email`, `dusun`, `rt`, `rw`, `no_telpon`, `photo`, `nik`) VALUES
(17, 'Budigunawan', ';lk', 'lk', 'lk', '', '', '', 'lk', '', 'k'),
(16, 'Fikri Yogi', 'kl', 'l', 'k;l', '1', '', '', 'k', 'photo/6358466824210098091411538.jpg', '3987243'),
(14, 'Ericha', 'k', 'jlk', 'jkl', '', '', '', 'j', 'photo/3HMLaMK.png', '187398123'),
(18, 'Khairul Fahri', 'lkl', 'kl', 'kl', '2', '001', '', 'kk', '', ''),
(15, 'lkj', 'lkj', 'klj', 'sdn004pulauterap@gmail.com', '', '', '', '', '', '209138'),
(19, 'iopp', '098', '', '', '', '', '', '', '', ''),
(20, 'dusun', 'lere', '', '', '1', '002', '', '12323', '', 'jkj213123'),
(21, 'Sri Darmasari', 'Bengkalis', '23423', 'sdn004pulauterap@gmail.com', '', '', '', '0853', 'photo/bayern-mnchen-tactics-se.png', '13055567567'),
(22, 'Fajri', 'ter', '234234343', 'sdn004pulauterap@gmail.com', 'dusun', '001', '002', '0831', '', '140'),
(23, '', '', '', '', '', '', '', '', '', ''),
(24, '', '', '', '', '', '', '', '', '', ''),
(25, 'Nama', '', '', '', '', '', '', '', '', ''),
(26, '', '', '', '', '', '', '', '', '', ''),
(27, 'Fikri', '', '', '', '', '', '', '', '', ''),
(28, 'Fajri', '', '', '', '', '', '', '', '', ''),
(29, 'Fajri', 'Lerne', '', '', '', '', '', '', '', ''),
(30, 'Fajri', '', '', '', '', '', '', '', '', ''),
(31, 'Budi', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tgl_daftar` timestamp NULL DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `tgl_daftar`, `status`) VALUES
(2, 'dosen', 'fikriyogi@gmail.com', 'b40d317dad65b25c608797a5f4a97e60', '2018-01-18 19:03:52', '0'),
(3, 'fikriyogi5', 'fikriyogi5@gmail.com', 'e37c4f1b74f68330bf09be95d03124af', '0000-00-00 00:00:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `mhsasia`
--
ALTER TABLE `mhsasia`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `mhsasia`
--
ALTER TABLE `mhsasia`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
