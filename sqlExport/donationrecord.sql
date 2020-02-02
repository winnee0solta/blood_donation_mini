-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2020 at 02:13 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `donationrecord`
--

CREATE TABLE `donationrecord` (
  `citizenshipID` varchar(15) NOT NULL,
  `donerName` varchar(30) DEFAULT NULL,
  `donerContactNumber` varchar(10) DEFAULT NULL,
  `donatedBloodGroup` varchar(3) DEFAULT NULL,
  `donatedVolume` int(11) DEFAULT NULL,
  `donerGender` enum('M','F','O') DEFAULT NULL,
  `donationDate` date DEFAULT NULL,
  `organizationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donationrecord`
--
ALTER TABLE `donationrecord`
  ADD PRIMARY KEY (`citizenshipID`),
  ADD KEY `organizationID` (`organizationID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donationrecord`
--
ALTER TABLE `donationrecord`
  ADD CONSTRAINT `donationrecord_ibfk_1` FOREIGN KEY (`organizationID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
