-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2024 at 11:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `knife`
--

CREATE TABLE `knife` (
  `knife_id` int(11) NOT NULL,
  `knife_pic` varchar(255) NOT NULL,
  `knife_code` varchar(100) NOT NULL,
  `knife_name` varchar(100) NOT NULL,
  `knife_material` varchar(100) NOT NULL,
  `maker_id` int(11) NOT NULL,
  `steel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `knife`
--

INSERT INTO `knife` (`knife_id`, `knife_pic`, `knife_code`, `knife_name`, `knife_material`, `maker_id`, `steel_id`) VALUES
(1, 'Benchmade-Bugout.jpg', 'BM-535', 'Benchmade_Bugout', 'Grivory_Plastic', 1, 1),
(2, 'Benchmade-Nakamura.jpg', 'BM-484', 'Benchmade_Nakamura', 'G-10_Resin', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `maker`
--

CREATE TABLE `maker` (
  `maker_id` int(11) NOT NULL,
  `maker_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maker`
--

INSERT INTO `maker` (`maker_id`, `maker_name`) VALUES
(1, 'Benchmade');

-- --------------------------------------------------------

--
-- Table structure for table `steel`
--

CREATE TABLE `steel` (
  `steel_id` int(11) NOT NULL,
  `steel_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel`
--

INSERT INTO `steel` (`steel_id`, `steel_name`) VALUES
(1, 'S30V'),
(2, 'M390');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `knife`
--
ALTER TABLE `knife`
  ADD PRIMARY KEY (`knife_id`),
  ADD KEY `MAKER_C` (`maker_id`),
  ADD KEY `STEEL_C` (`steel_id`);

--
-- Indexes for table `maker`
--
ALTER TABLE `maker`
  ADD PRIMARY KEY (`maker_id`);

--
-- Indexes for table `steel`
--
ALTER TABLE `steel`
  ADD PRIMARY KEY (`steel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `knife`
--
ALTER TABLE `knife`
  MODIFY `knife_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `maker`
--
ALTER TABLE `maker`
  MODIFY `maker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `steel`
--
ALTER TABLE `steel`
  MODIFY `steel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `knife`
--
ALTER TABLE `knife`
  ADD CONSTRAINT `MAKER_C` FOREIGN KEY (`maker_id`) REFERENCES `maker` (`maker_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `STEEL_C` FOREIGN KEY (`steel_id`) REFERENCES `steel` (`steel_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
