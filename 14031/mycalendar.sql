-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2016 at 04:21 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycalendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventcalendar`
--

CREATE TABLE `eventcalendar` (
  `id` int(11) NOT NULL,
  `title` varchar(65) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `eventDate` varchar(10) NOT NULL,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventcalendar`
--

INSERT INTO `eventcalendar` (`id`, `title`, `detail`, `eventDate`, `dateAdded`) VALUES
(1, '', '', '01/01/2017', '2016-12-04'),
(2, 'jumat', 'kuliah?', '01/06/2017', '2016-12-04'),
(3, 'testing', 'this is a test', '12/20/2016', '2016-12-04'),
(4, 'testing', 'this is a test', '12/20/2016', '2016-12-05'),
(5, 'something', 'it is something secret', '12/08/2016', '2016-12-06'),
(6, 'something', 'it is something secret', '12/08/2016', '2016-12-06'),
(7, 'something', 'it is something secret', '12/08/2016', '2016-12-06'),
(8, 'something', 'it is something secret', '12/08/2016', '2016-12-06'),
(9, 'something', 'it is something secret', '12/08/2016', '2016-12-06'),
(10, 'something', 'it is something secret', '12/08/2016', '2016-12-06'),
(11, 'something', 'it is something secret', '12/08/2016', '2016-12-06'),
(12, 'veb', 'hai veb', '12/09/2016', '2016-12-06'),
(13, 'natal', 'lalala', '12/25/2016', '2016-12-06'),
(14, 'sesuatu', 'ini sesuatu lho', '02/15/2017', '2016-12-07'),
(15, 'lalala', 'lilili', '01/01/2017', '2016-12-07'),
(16, 'hahaha', 'lalalala', '01/06/2017', '2016-12-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventcalendar`
--
ALTER TABLE `eventcalendar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventcalendar`
--
ALTER TABLE `eventcalendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
