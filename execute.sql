-- Venkat 13-05-2020
-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 07:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mandi_b2c`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `status` enum('A','IA','D') NOT NULL COMMENT '''A'' - Active, ''IA''-Inactive,''D'' -Delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`company_id`, `company_name`, `company_address`, `city`, `state`, `country`, `pincode`, `status`) VALUES
(1, 'Quality Mango Factory', 'No 22, West Street', 'Chennai', 'Tamil Nadu', 'India', '600001', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `customer_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `customer_code` varchar(100) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_city` varchar(100) NOT NULL,
  `customer_district` varchar(100) NOT NULL,
  `customer_state` varchar(100) NOT NULL,
  `customer_country` varchar(100) NOT NULL,
  `bank_account_number` varchar(255) NOT NULL,
  `bank_ifsc_code` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `status` enum('A','IA','D') NOT NULL COMMENT '''A'' - Active, ''IA''-Inactive,''D'' -Delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `farmer_master`
--

CREATE TABLE `farmer_master` (
  `farmer_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `farmer_code` varchar(100) NOT NULL,
  `farmer_name` varchar(255) NOT NULL,
  `farmer_address` varchar(255) NOT NULL,
  `farmer_city` varchar(100) NOT NULL,
  `farmer_district` varchar(100) NOT NULL,
  `farmer_state` varchar(100) NOT NULL,
  `farmer_country` varchar(100) NOT NULL,
  `status` enum('A','IA','D') NOT NULL COMMENT '''A'' - Active, ''IA''-Inactive,''D'' -Delete	'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `product_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit_of_measurement` varchar(20) NOT NULL,
  `price` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `status` enum('A','IA','D') NOT NULL COMMENT ' ''A'' - Active, ''IA''-Inactive,''D'' -Delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `company_id`, `user_type_id`, `user_name`, `user_password`, `status`) VALUES
(1, 1, 1, 'super admin', '123456', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user_type_master`
--

CREATE TABLE `user_type_master` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(50) NOT NULL,
  `status` enum('A','IA','D') NOT NULL COMMENT '	''A'' - Active, ''IA''-Inactive,''D'' -Delete	'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type_master`
--

INSERT INTO `user_type_master` (`user_type_id`, `user_type_name`, `status`) VALUES
(1, 'admin', 'A'),
(2, 'user', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `farmer_master`
--
ALTER TABLE `farmer_master`
  ADD PRIMARY KEY (`farmer_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_type_master`
--
ALTER TABLE `user_type_master`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `farmer_master`
--
ALTER TABLE `farmer_master`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type_master`
--
ALTER TABLE `user_type_master`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD CONSTRAINT `customer_master_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_master` (`company_id`);

--
-- Constraints for table `farmer_master`
--
ALTER TABLE `farmer_master`
  ADD CONSTRAINT `farmer_master_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_master` (`company_id`);

--
-- Constraints for table `product_master`
--
ALTER TABLE `product_master`
  ADD CONSTRAINT `product_master_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_master` (`company_id`);

--
-- Constraints for table `user_master`
--
ALTER TABLE `user_master`
  ADD CONSTRAINT `user_master_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_master` (`company_id`),
  ADD CONSTRAINT `user_master_ibfk_2` FOREIGN KEY (`user_type_id`) REFERENCES `user_type_master` (`user_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
