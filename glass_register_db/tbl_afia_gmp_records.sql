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
-- Table structure for table `tbl_afia_gmp_records`
--

CREATE TABLE `tbl_afia_gmp_records` (
  `PK_id` int(11) NOT NULL,
  `gr_status_flag` char(1) DEFAULT 'A',
  `reviewer_draw_sign` text DEFAULT NULL,
  `reviewer_img_sign` text DEFAULT NULL,
  `reviewer_name` text DEFAULT NULL,
  `reviewer_position` text DEFAULT NULL,
  `reviewed_date` text DEFAULT NULL,
  `approver_draw_sign` text DEFAULT NULL,
  `approver_img_sign` text DEFAULT NULL,
  `approver_name` text DEFAULT NULL,
  `approver_position` text DEFAULT NULL,
  `approved_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_afia_gmp_records`
--
ALTER TABLE `tbl_afia_gmp_records`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_afia_gmp_records`
--
ALTER TABLE `tbl_afia_gmp_records`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
