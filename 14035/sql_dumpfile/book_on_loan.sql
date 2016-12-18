-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2016 at 11:01 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinjam_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_on_loan`
--

CREATE TABLE `book_on_loan` (
  `book_id` int(10) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `book_desc` varchar(500) DEFAULT NULL,
  `date_loan` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_return` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_on_loan`
--

INSERT INTO `book_on_loan` (`book_id`, `book_title`, `book_desc`, `date_loan`, `date_return`, `user_id`) VALUES
(30, 'MMMMM', 'asasasa', '2016-11-28 16:30:00', '2016-11-30 16:40:00', 'rafidwiriz'),
(31, 'Lalal', 'sasasasas', '2016-11-29 16:30:00', '2016-12-02 16:40:00', 'rafidwiriz'),
(32, 'Purcel', 'Lalal', '2016-11-30 07:00:00', '2016-11-30 10:40:00', 'rafidwiriz'),
(33, 'Kalkulus', 'Inggris', '2016-12-01 07:20:00', '2016-12-03 07:30:00', 'rafidisekolah'),
(35, 'Lalala', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque suscipit tortor est, non feugiat nisl commodo sed. Cras quis volutpat.', '2016-12-14 01:00:00', '2016-12-22 01:10:00', 'rafidisekolah'),
(36, 'All We Know', 'The Chainsmoker', '2016-12-13 16:50:00', '2016-12-15 17:00:00', 'rafidwiriz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_on_loan`
--
ALTER TABLE `book_on_loan`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_on_loan`
--
ALTER TABLE `book_on_loan`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
