-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2016 at 07:38 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `apointments`
--

CREATE TABLE `apointments` (
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `pid` int(7) NOT NULL,
  `Advisor` varchar(50) NOT NULL,
  `arrival_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `appointment_time` varchar(10) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(10) NOT NULL,
  `logged` tinyint(1) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `student_sent` int(1) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_id` int(7) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `FirstName`, `LastName`, `password`, `level`, `logged`, `Status`, `student_sent`, `student_name`, `student_id`, `lastupdate`) VALUES
('admin1', 'admin1', 'admin1', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 1, 1, '', 0, '', 0, '2016-12-09 16:30:55'),
('admin2', 'admin2', 'admin2', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 1, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('aramjohn', 'Alyssa', 'Ramjohn', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 0, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('cmullerk', 'Carmen', 'Muller Karger', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 0, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('display', 'display', 'queues', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 3, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('FD1', 'Front', 'Desk', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 2, 1, '', 0, '', 0, '2016-12-09 16:32:57'),
('galarzal', 'Luis', 'Galarza', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 0, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('joasanab', 'JoAnna', 'Sanabria', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 0, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('lbrown', 'Lynneah', 'Brown', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 0, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('nawedder', 'Natasha', 'Wedderburn', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 0, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('sanchem', 'Mario', 'Sanchez', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 0, 1, 'OO', 0, 'No One', 0, '2016-12-09 16:30:55'),
('schenckc', 'Carmen', 'Schenck', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 0, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('StudentSignIn', 'student', 'sign in', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 4, 0, '', 0, '', 0, '2016-12-09 16:30:55'),
('SysAdm', 'System', 'Administrator', '$2y$10$VIWAuf3p/r15w09hE54aEeafGSukgLzH3feoDi6vavJFFTEPajqiG', 1, 0, '', 0, '', 0, '2016-12-09 16:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `id` int(11) NOT NULL,
  `msg` varchar(256) DEFAULT NULL,
  `ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`id`, `msg`, `ts_update`) VALUES
(1, 'RFW', '2016-12-09 03:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `walk_in`
--

CREATE TABLE `walk_in` (
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Advisor` varchar(50) NOT NULL,
  `ts_updte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL,
  `pid` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `walk_in`
--

INSERT INTO `walk_in` (`FirstName`, `LastName`, `Advisor`, `ts_updte`, `id`, `pid`) VALUES
('lol', 'ollo', 'sanchem', '2016-12-09 12:41:58', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apointments`
--
ALTER TABLE `apointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walk_in`
--
ALTER TABLE `walk_in`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apointments`
--
ALTER TABLE `apointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `msgs`
--
ALTER TABLE `msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `walk_in`
--
ALTER TABLE `walk_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
