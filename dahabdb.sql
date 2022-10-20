-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2020 at 03:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 8.1.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sourcecodester_pmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(2, 'Dr.', 'Fady', 'fady@admin.com', '012', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'dr_av.png'),
(3, 'Eng.', 'Amr', 'amr@admin.com', '012', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'eng_av.png'),
(1, 'Eng.', 'Omar', 'omar@admin.com', '012', 'd4466cce49457cfea18222f5a7cd3573', 'admin', 'omar_av.png');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(9, 'Saif', 'Gad', 'saif@gmail.com', '012', '44c099ff522cd529ade21a9c7aa54ebf', 'salesman', 'saif_av.png'),
(8, 'Ruba', 'Ashraf', 'ruba@gmail.com', '012', '7458f96b989285d0eed13b3df9134930', 'salesman', 'ruba_av.png'),
(7, 'Nourhan', 'Hossam', 'nourhan@gmail.com', '012', '11c89af0c56598298c1631659ff61c01', 'salesman', 'nour_av.png'),
(6, 'Hajer', 'Ghoneim', 'hajer@gmail.com', '012', '8fac8283e71111d126c93fe5d33ca7f1', 'salesman', 'hajer_av.png');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `karat_21`
--
CREATE TABLE `karat_21` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `buy` varchar(60) NOT NULL,
  `sell` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `karat_21` (`id`, `buy`, `sell`) VALUES
(1, '1120', '1104.5');
-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `karat_24`
--
CREATE TABLE `karat_24` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `buy` varchar(60) NOT NULL,
  `sell` varchar(60) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `karat_24` (`id`, `buy`, `sell`) VALUES
(1, '1279.87', '1262.16');
-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `international`
--
CREATE TABLE `international` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `buy` varchar(60) NOT NULL,
  `sell` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `international` (`id`, `buy`, `sell`) VALUES
(1, '1635', '	1632');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
