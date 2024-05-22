-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 10:05 AM
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
-- Table structure for table `tbl_allergen_test_record`
--

CREATE TABLE `tbl_allergen_test_record` (
  `PK_id` int(11) NOT NULL,
  `FK_at_signature_id` int(11) NOT NULL,
  `allergen_name` varchar(255) DEFAULT NULL,
  `sop_reference` text DEFAULT NULL,
  `material_tested` varchar(255) DEFAULT NULL,
  `test_kit_used` varchar(255) DEFAULT NULL,
  `results` varchar(50) DEFAULT NULL,
  `deficiency` varchar(255) DEFAULT NULL,
  `performed_by` varchar(255) DEFAULT NULL,
  `performed_date_time` datetime DEFAULT NULL,
  `corrective_action` text DEFAULT NULL,
  `corrected_by` varchar(255) DEFAULT NULL,
  `corrected_date_time` datetime DEFAULT NULL,
  `notes_comments` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `reviewed_by` varchar(255) DEFAULT NULL,
  `reviewed_date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_allergen_test_record`
--
ALTER TABLE `tbl_allergen_test_record`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_allergen_test_record`
--
ALTER TABLE `tbl_allergen_test_record`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
