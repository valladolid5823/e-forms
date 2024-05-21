-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 10:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

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
-- Table structure for table `tbl_afia_gmp_checklist_template_header`
--

CREATE TABLE `tbl_afia_gmp_checklist_template_header` (
  `PK_id` int(11) NOT NULL,
  `gcth_title` text DEFAULT NULL,
  `gcth_status` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_afia_gmp_checklist_template_header`
--

INSERT INTO `tbl_afia_gmp_checklist_template_header` (`PK_id`, `gcth_title`, `gcth_status`) VALUES
(1, 'PERSONNEL', 'A'),
(2, 'EQUIPMENT', 'A'),
(3, 'PEST CONTROL', 'A'),
(4, 'COLD HOLDING', 'A'),
(5, 'HANDWASHING', 'A'),
(6, 'STORAGE (RAW MATERIALS, INGREDIENTS, AND PACKAGING MATERIALS)', 'A'),
(7, 'GARBAGE STORAGE AND DISPOSAL', 'A'),
(8, 'GLASS, BRITTLE PLASTICS, CERAMICS', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_afia_gmp_checklist_template_header`
--
ALTER TABLE `tbl_afia_gmp_checklist_template_header`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_afia_gmp_checklist_template_header`
--
ALTER TABLE `tbl_afia_gmp_checklist_template_header`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
