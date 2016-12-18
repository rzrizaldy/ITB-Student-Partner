-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2016 at 04:19 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waroenk`
--

-- --------------------------------------------------------

--
-- Table structure for table `peta_icon`
--

CREATE TABLE `peta_icon` (
  `nomor` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `deskripsi` tinytext NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peta_icon`
--

INSERT INTO `peta_icon` (`nomor`, `nama`, `jenis`, `deskripsi`, `lat`, `lng`, `img`) VALUES
(1, 'Gudeg Yogya Ayam Penyet', 'murah', 'enak', -6.899158, 107.609013, 'img/1.jpg'),
(2, 'Roti Gempol', 'populer', 'enak', -6.902847, 107.615769, ''),
(3, 'Nasi Uduk Pecel Lele Puput', 'murah', 'enak', -6.897417, 107.606615, ''),
(4, 'Es Cendol Idaman', 'murah', 'enak', -6.907817, 107.614356, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peta_icon`
--
ALTER TABLE `peta_icon`
  ADD PRIMARY KEY (`nomor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peta_icon`
--
ALTER TABLE `peta_icon`
  MODIFY `nomor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
