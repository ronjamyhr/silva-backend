-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 30, 2019 at 08:06 AM
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
  `date` date NOT NULL,
  `time` int(200) NOT NULL,
  `number_of_guests` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customer_id`, `date`, `time`, `number_of_guests`) VALUES
(1, 1, '2019-08-28', 18, 2),
(2, 1, '2019-08-28', 18, 5),
(3, 6, '2019-08-25', 18, 4),
(4, 2, '2019-08-25', 21, 2),
(5, 1, '2019-08-28', 18, 5),
(6, 2, '2019-08-28', 18, 5),
(7, 2, '2019-09-30', 21, 2),
(8, 2, '2019-09-30', 21, 2),
(9, 1, '2019-08-28', 18, 5),
(10, 8, '2019-09-10', 21, 5),
(11, 1, '2019-08-28', 18, 5),
(12, 1, '2019-08-28', 18, 5),
(13, 9, '2019-09-10', 21, 5),
(14, 10, '2019-09-10', 21, 5),
(15, 11, '2019-09-10', 21, 5),
(16, 3, '2019-09-21', 18, 4),
(17, 1, '2019-09-21', 18, 4),
(18, 14, '2019-09-12', 21, 3),
(19, 15, '2019-09-12', 21, 3),
(20, 15, '2019-09-12', 21, 3),
(21, 18, '2019-09-21', 18, 4),
(22, 18, '2019-09-21', 18, 4),
(23, 18, '2019-09-21', 18, 4),
(24, 19, '2019-09-01', 21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_number` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone_number`) VALUES
(1, 'Pelle', 'pelle@pelle.com', '070564768'),
(18, 'anna', 'anna@pelle.com', '0708976756'),
(19, 'jocke', 'jocke@pelle.com', '0707176356');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
