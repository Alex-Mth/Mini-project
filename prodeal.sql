-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 08:54 AM
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
-- Database: `prodeal`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bid` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `plotid` int(10) NOT NULL,
  `booking_date` date NOT NULL,
  `token_amount` int(100) NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `bid` int(10) NOT NULL,
  `plotid` int(10) NOT NULL,
  `areainsqft` decimal(10,0) NOT NULL,
  `description` varchar(500) NOT NULL,
  `bedrooms` int(5) NOT NULL,
  `bathrooms` int(5) NOT NULL,
  `floor` int(5) NOT NULL,
  `roof` varchar(10) NOT NULL,
  `age` int(10) NOT NULL,
  `condition` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_images`
--

CREATE TABLE `building_images` (
  `imageid` varchar(10) NOT NULL,
  `bid` int(10) NOT NULL,
  `image` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plots`
--

CREATE TABLE `plots` (
  `plotid` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `areainsqft` int(10) NOT NULL,
  `withorwithoutproperty` int(5) NOT NULL,
  `pricepersqft` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `front` mediumblob NOT NULL,
  `back` mediumblob NOT NULL,
  `left` mediumblob NOT NULL,
  `right` mediumblob NOT NULL,
  `rentorsale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plot_images`
--

CREATE TABLE `plot_images` (
  `imageid` int(10) NOT NULL,
  `plotid` int(10) NOT NULL,
  `image` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(10) NOT NULL DEFAULT 1,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `name`, `phone`, `email`, `password`) VALUES
(1, 'test2', 'alex mathew', 1234567890, 'test2@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD KEY `booking` (`bid`),
  ADD KEY `fk_booking_user` (`username`),
  ADD KEY `fk_booking_plots` (`plotid`);

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `fk_plotid` (`plotid`);

--
-- Indexes for table `building_images`
--
ALTER TABLE `building_images`
  ADD PRIMARY KEY (`imageid`),
  ADD KEY `fk_bid` (`bid`);

--
-- Indexes for table `plots`
--
ALTER TABLE `plots`
  ADD PRIMARY KEY (`plotid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `plot_images`
--
ALTER TABLE `plot_images`
  ADD PRIMARY KEY (`imageid`),
  ADD KEY `plots_images` (`plotid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking` FOREIGN KEY (`bid`) REFERENCES `building` (`bid`),
  ADD CONSTRAINT `fk_booking_plots` FOREIGN KEY (`plotid`) REFERENCES `plots` (`plotid`),
  ADD CONSTRAINT `fk_booking_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `building`
--
ALTER TABLE `building`
  ADD CONSTRAINT `fk_plotid` FOREIGN KEY (`plotid`) REFERENCES `plots` (`plotid`);

--
-- Constraints for table `building_images`
--
ALTER TABLE `building_images`
  ADD CONSTRAINT `fk_bid` FOREIGN KEY (`bid`) REFERENCES `building` (`bid`);

--
-- Constraints for table `plots`
--
ALTER TABLE `plots`
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `plot_images`
--
ALTER TABLE `plot_images`
  ADD CONSTRAINT `plots_images` FOREIGN KEY (`plotid`) REFERENCES `plots` (`plotid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
