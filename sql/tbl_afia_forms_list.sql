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
-- Table structure for table `tbl_afia_forms_list`
--

CREATE TABLE `tbl_afia_forms_list` (
  `PK_id` int(11) NOT NULL,
  `afl_form_code` varchar(25) DEFAULT NULL,
  `afl_form_name` text DEFAULT NULL,
  `afl_status_flag` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_afia_forms_list`
--

INSERT INTO `tbl_afia_forms_list` (`PK_id`, `afl_form_code`, `afl_form_name`, `afl_status_flag`) VALUES
(1, 'gmp_cdsi', 'GMP Checklist – Daily Self Inspection Sheet', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_afia_forms_list`
--
ALTER TABLE `tbl_afia_forms_list`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_afia_forms_list`
--
ALTER TABLE `tbl_afia_forms_list`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
