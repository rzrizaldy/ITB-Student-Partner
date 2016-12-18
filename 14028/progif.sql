-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: sql7.freemysqlhosting.net
-- Generation Time: Dec 08, 2016 at 03:16 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sql7148438`
--

-- --------------------------------------------------------

--
-- Table structure for table `informasi_perpustakaan`
--

CREATE TABLE IF NOT EXISTS `informasi_perpustakaan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `informasi_perpustakaan`
--

INSERT INTO `informasi_perpustakaan` (`no`, `nama`, `deskripsi`, `alamat`, `latitude`, `longitude`, `image`) VALUES
(1, 'Perpustakaan Pusat ITB', 'Jam Buka : 07.00-21.00', 'Jalan Ganesha Nomor 12', -6.88845, 107.611, 'https://upload.wikimedia.org/wikipedia/id/5/54/Perpus_ITB.jpg'),
(2, 'Perpustakaan Salman ITB', 'Jam Buka : 09.00 - 16.00 ', 'Jl. Ganesha, Lb. Siliwangi', -6.89377, 107.611, 'http://salmanitb.com/wp-content/uploads/2014/12/20141204_143738-640x360.jpg'),
(3, 'Perpustakaan Gedung Merdeka', 'Jam Buka : 08.00 - 16.00', 'Jl. Asia Afrika, Sumur Bandung', -6.921, 107.609, 'http://perwakilan.jabarprov.go.id/public/images/gedung-merdeka.jpg'),
(4, 'Bale Pustaka', '', 'JL. Jawa No. 6, Sumur Bandung', -6.91452, 107.613, 'http://keuskupanbandung.org/img_post/L_313.jpg'),
(5, 'Perpustakaan Pusdai', '', 'Jl. Diponegoro No.63, Cibeunying Kaler', -6.90027, 107.626, 'http://4.bp.blogspot.com/-ZzO0RV_ma6g/UVgSTjzUDjI/AAAAAAAAOGA/9gOruQ80buc/s1600/pusdai+(3).jpg'),
(6, 'PERPUSDA Kota Bandung', '', 'Jalan Wastukencana No.2, Sumur Bandung', -6.91317, 107.609, 'https://jejakkakijurnalis.files.wordpress.com/2014/11/20141113_151712.jpg'),
(7, 'BAPUSIPDA Jawa Barat', '', 'Jl. Kawaluyaan Indah II No. 4', -6.93452, 107.663, 'http://s24.postimg.org/lkuu147tx/1009073copy.jpg'),
(8, 'PITIMOSS Library', 'Jam Buka : 09.00 - 20.00 ', 'Jl. Banda No.12-S, Sumur Bandung', -6.91254, 107.618, 'https://pbs.twimg.com/media/CD58QZoVIAAgE_D.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
