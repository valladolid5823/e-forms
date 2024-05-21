-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 05:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_afia_gmp_glass_register`
--

CREATE TABLE `tbl_afia_gmp_glass_register` (
  `PK_id` int(11) NOT NULL,
  `FK_grd_record_id` int(11) NOT NULL,
  `FK_gr_comment_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `material` varchar(255) DEFAULT NULL,
  `attached_image` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `risk_class` varchar(255) NOT NULL,
  `action_required` text DEFAULT NULL,
  `action_completed` text DEFAULT NULL,
  `checked_initial` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_afia_gmp_glass_register`
--
ALTER TABLE `tbl_afia_gmp_glass_register`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_afia_gmp_glass_register`
--
ALTER TABLE `tbl_afia_gmp_glass_register`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
