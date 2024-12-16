-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 12:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `christmas_raffle`
--

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ticket_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contestants`
--

INSERT INTO `contestants` (`id`, `first_name`, `last_name`, `phone`, `email`, `ticket_number`) VALUES
(5, 'John', 'smith', '3435465667', 'conip42236@pokeline.com', 63),
(6, 'Tom', 'Walter', '3534567656', 'conip42236@pokeline.com', 2),
(7, 'Kim ', 'Kale', '3454522467', 'conip42236@pokeline.com', 47),
(8, 'Timmy', 'Tom', '5676876933', 'conip42236@pokeline.com', 93),
(10, 'Tim', 'Walter', '5768768343', 'conip42236@pokeline.com', 1),
(11, 'Teena', 'Jimmy', '5345356655', 'conip42236@pokeline.com', 31),
(12, 'Akku', 'Tom', '435354657', 'conip42236@pokeline.com', 81),
(13, 'Kial', 'kelly', '4354536534', 'conip42236@pokeline.com', 41);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'testuser1', '482c811da5d5b4bc6d497ffa98491e38', 'conip42236@pokeline.com'),
(2, 'testuser2', '34819d7beeabb9260a5c854bc85b3e44', 'conip42236@pokeline.com');

-- --------------------------------------------------------

--
-- Table structure for table `winner`
--

CREATE TABLE `winner` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `ticket_number` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `winner`
--

INSERT INTO `winner` (`id`, `first_name`, `last_name`, `ticket_number`, `date`) VALUES
(9, 'Tom', 'Walter', 2, '2024-12-15 23:51:34'),
(10, 'Tom', 'Walter', 2, '2024-12-15 23:54:49'),
(11, 'Tom', 'Walter', 2, '2024-12-15 23:55:15'),
(12, 'Kim ', 'Kale', 47, '2024-12-15 23:55:32'),
(13, 'Tim', 'Walter', 1, '2024-12-15 23:55:46'),
(14, 'Teena', 'Jimmy', 31, '2024-12-15 23:55:56'),
(15, 'Kim ', 'Kale', 47, '2024-12-15 23:56:05'),
(16, 'John', 'smith', 63, '2024-12-15 23:56:14'),
(17, 'Tom', 'Walter', 2, '2024-12-16 00:08:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `winner`
--
ALTER TABLE `winner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `winner`
--
ALTER TABLE `winner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
