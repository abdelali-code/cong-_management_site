-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 01:35 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testmana`
--

-- --------------------------------------------------------

--
-- Table structure for table `conge`
--

CREATE TABLE `conge`
(
  `numero` int
(11) NOT NULL,
  `demande_date` timestamp NOT NULL DEFAULT current_timestamp
(),
  `type` varchar
(20) NOT NULL,
  `date_debut` date NOT NULL,
  `date_retour` date NOT NULL,
  `nombre_jour` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

CREATE TABLE `demande`
(
  `user_cin` varchar
(10) DEFAULT NULL,
  `conge_numero` int
(11) DEFAULT NULL,
  `decision` varchar
(20) DEFAULT 'not yet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
  `firstName` varchar
(60) NOT NULL,
  `lastName` varchar
(60) NOT NULL,
  `CIN` varchar
(12) NOT NULL,
  `tel` varchar
(20) NOT NULL,
  `email` varchar
(60) NOT NULL,
  `grade` varchar
(20) DEFAULT NULL,
  `service` varchar
(60) DEFAULT NULL,
  `type` char
(2) NOT NULL DEFAULT 'EM',
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conge`
--
ALTER TABLE `conge`
ADD PRIMARY KEY
(`numero`);

--
-- Indexes for table `demande`
--
ALTER TABLE `demande`
ADD KEY `user_cin`
(`user_cin`),
ADD KEY `conge_numero`
(`conge_numero`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`CIN`),
ADD UNIQUE KEY `CIN`
(`CIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conge`
--
ALTER TABLE `conge`
  MODIFY `numero` int
(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `demande`
--
ALTER TABLE `demande`
ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY
(`user_cin`) REFERENCES `users`
(`CIN`),
ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY
(`conge_numero`) REFERENCES `conge`
(`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
