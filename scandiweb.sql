-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2022 at 07:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `scandiweb`
--
CREATE DATABASE IF NOT EXISTS `scandiweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scandiweb`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `sku` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `price` float NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`sku`, `name`, `price`, `type`, `description`) VALUES
('GGWP0007', 'Wear and Peace', 20, 'Book', '2KG'),
('JVC200123', 'Acme DISC', 1, 'Disc', '700 MB'),
('TR120555', 'Chair', 40, 'Furniture', '24x45x15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`sku`),
  ADD UNIQUE KEY `sku` (`sku`);
COMMIT;
