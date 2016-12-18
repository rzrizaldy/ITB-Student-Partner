-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2016 at 04:49 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transnangor`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(8) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Telepon` varchar(10) NOT NULL,
  `Alamat` varchar(40) NOT NULL,
  `IDTransaksi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `Nama`, `Email`, `Telepon`, `Alamat`, `IDTransaksi`) VALUES
('12314056', 'Ben', 'ben@g.id', '081345678', 'Jalan Cisistu', 'trvur84c'),
('13014000', 'Nesya', 'nesya@yahoo.com', '0857432179', 'Jalan Merdeka', 'suz2oxr2'),
('14513764', 'Thalita', 'thalita@ursa.id', '0856789245', 'Jalan Ursa Mayor', 'ef6j6u0r'),
('16413089', 'Capella', 'capella@gmail.com', '0867543215', 'Jalan Tidak Sesat', 'qga5gugv'),
('16515345', 'Eridanus', 'eridanus@sky.co', '0875676576', 'Jalan Kebahagiaan', 'oekdir5m'),
('16816378', 'Adit', 'aditya@gmail.com', '0856749475', 'Jalan Tubagus Ismail', 'wxkvzcc6'),
('17514089', 'Perseus', 'perseus@here.com', '086345678', 'Jalan Laut Utara', '6o2zie37'),
('18358399', 'Silvya', 'silvi@gmail.com', '0857890272', 'Jalan Yang Benar', 'dj24uej8'),
('4567890', 'Shaula', 'shaula@sco.id', '0856405678', 'Jalan Rasi Selatan', 'd8px4dfc');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `NIM` varchar(8) NOT NULL,
  `Tanggal` varchar(11) NOT NULL,
  `IDRute` varchar(20) NOT NULL,
  `Seat` varchar(30) NOT NULL,
  `IDTransaksi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`NIM`, `Tanggal`, `IDRute`, `Seat`, `IDTransaksi`) VALUES
('17514089', '14/12/2016', '4', '29', '6o2zie37'),
('4567890', '12/12/2016', '2', '3', 'd8px4dfc'),
('18358399', '12/12/2016', '2', '2', 'dj24uej8'),
('14513764', '12/12/2016', '2', '10', 'ef6j6u0r'),
('16515345', '21/12/2016', '5', '15', 'oekdir5m'),
('16413089', '12/12/2016', '2', '12', 'qga5gugv'),
('13014000', '12/12/2016', '2', '1', 'suz2oxr2'),
('12314056', '26/12/2016', '3', '6', 'trvur84c'),
('16816378', '26/12/2016', '3', '14', 'wxkvzcc6');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `berangkat` varchar(10) NOT NULL,
  `sampai` varchar(10) NOT NULL,
  `NamaRute` varchar(20) NOT NULL,
  `IDRute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`berangkat`, `sampai`, `NamaRute`, `IDRute`) VALUES
('08.45', '09.45', 'Ganesha-Jatinangor', 1),
('08.00', '09.00', 'Jatinangor-Ganesha', 2),
('10.30', '11.30', 'Ganesha-Jatinangor', 3),
('13.00', '14.00', 'Jatinangor-Ganesha', 4),
('17.00', '18.00', 'Ganesha-Jatinangor', 5),
('18.45', '19.45', 'Jatinangor-Ganesha', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`IDTransaksi`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`IDRute`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `IDRute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
