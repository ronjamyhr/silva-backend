-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 27, 2019 at 08:26 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `silva`
--
-- --------------------------------------------------------
--
-- Table structure for table `booking`
--
CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `customer_id` int(200) NOT NULL,
  `date` datetime NOT NULL,
  `time` int(200) NOT NULL,
  `number_of_guests` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `booking`
--
INSERT INTO `booking` (`id`, `customer_id`, `date`, `time`, `number_of_guests`) VALUES
(1, 1, '2019-08-28 00:00:00', 19, 2);
-- --------------------------------------------------------
--
-- Table structure for table `customer`
--
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_number` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `customer`
--
INSERT INTO `customer` (`id`, `name`, `email`, `phone_number`) VALUES
(1, 'Bert', 'bert_fjert@enmail.se', 701234567);
--
-- Indexes for dumped tables
--
--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
