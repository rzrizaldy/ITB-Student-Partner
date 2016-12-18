-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Des 2016 pada 17.52
-- Versi Server: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: ` db18214027`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `ID` int(10) NOT NULL,
  `Judul` text NOT NULL,
  `NamaPenulis` varchar(100) NOT NULL,
  `Fakultas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`ID`, `Judul`, `NamaPenulis`, `Fakultas`) VALUES
(1072, 'A New RTL Design Approach for a DCT/IDCT-Based Image Compression Architecture using the mCBE Algorithm', 'Rachmad Vidya Wicaksana Putra, Rella Mareta, Nurfitri Anbarsanti & Trio Adiono', 'School of Electrical Engineering and Informatics'),
(1335, 'A Scaling-up Synthesis from Laboratory Scale to Pilot Scale and to near Commercial Scale for Paste-Glue Production', 'Johnner P. Sitompul, Hyung Woo Lee, Yook Chan Kim & Matthew W. Chang', 'Faculty of Industrial Technology'),
(2266, 'Adjustment of Daily Activities: the Influence of Smartphone Adoption on the Travel Pattern of Mobile Professionals in the Greater Jakarta Area', 'Gloriani Novita Christin, Ofyar Z Tamin2, Idwan Santosa & Miming Miharja', 'School of Architecture, Planning and Policy Development');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
