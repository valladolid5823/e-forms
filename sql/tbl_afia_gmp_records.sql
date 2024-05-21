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
-- Table structure for table `tbl_afia_gmp_records`
--

CREATE TABLE `tbl_afia_gmp_records` (
  `PK_id` int(11) NOT NULL,
  `gr_datetime_inspected` datetime DEFAULT NULL,
  `gr_inspected_by` varchar(255) DEFAULT NULL,
  `gr_approved_by` varchar(255) DEFAULT NULL,
  `gr_created_by` varchar(255) NOT NULL,
  `gr_datetime_created` datetime DEFAULT current_timestamp(),
  `gr_datetime_updated` datetime DEFAULT current_timestamp(),
  `gr_status_flag` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_afia_gmp_records`
--

INSERT INTO `tbl_afia_gmp_records` (`PK_id`, `gr_datetime_inspected`, `gr_inspected_by`, `gr_approved_by`, `gr_created_by`, `gr_datetime_created`, `gr_datetime_updated`, `gr_status_flag`) VALUES
(1, '2022-04-22 13:30:00', 'SS', 'SS', 'Shayna Smith', '2022-04-22 13:41:01', '2022-04-22 13:41:01', 'A'),
(2, '2022-04-25 11:00:00', 'SS', 'SS', 'Shayna Smith', '2022-04-26 11:44:48', '2022-04-26 11:44:48', 'A'),
(3, '2022-04-26 13:30:00', 'SS', 'SS', 'Shayna Smith', '2022-04-26 11:46:22', '2022-04-26 11:46:22', 'A'),
(4, '2022-04-27 12:30:00', 'SS', 'SS', 'Shayna Smith', '2022-04-28 10:32:32', '2022-04-28 10:32:32', 'A'),
(5, '2022-04-28 12:30:00', 'SS', 'SS', 'Shayna Smith', '2022-04-28 10:34:32', '2022-04-28 10:34:32', 'A'),
(6, '2022-04-29 12:30:00', 'SS', 'SS', 'Shayna Smith', '2022-04-29 10:49:28', '2022-04-29 10:49:28', 'A'),
(7, '2022-05-02 14:00:00', 'SS', 'SS', 'Shayna Smith', '2022-05-02 12:11:24', '2022-05-02 12:11:24', 'A'),
(8, '2022-05-03 12:30:00', 'SS', 'SS', 'Shayna Smith', '2022-05-03 12:36:31', '2022-05-03 12:36:31', 'A'),
(9, '2022-05-04 13:09:00', 'SS', 'SS', 'Shayna Smith', '2022-05-04 11:11:11', '2022-05-04 11:11:11', 'A'),
(10, '2022-05-05 13:00:00', 'SS', 'SS', 'Shayna Smith', '2022-05-05 11:04:13', '2022-05-05 11:04:13', 'A'),
(11, '2022-05-06 13:48:00', 'SS', 'SS', 'Shayna Smith', '2022-05-06 11:59:15', '2022-05-06 11:59:15', 'A'),
(12, '2022-05-10 12:20:00', 'SS', 'SS', 'Shayna Smith', '2022-05-10 11:04:20', '2022-05-10 11:04:20', 'A'),
(13, '2022-05-09 07:50:00', 'FS', 'FS', 'Shayna Smith', '2022-05-10 11:08:45', '2022-05-10 11:08:45', 'A'),
(14, '2022-05-11 14:00:00', 'SS', 'SS', 'Shayna Smith', '2022-05-11 12:55:08', '2022-05-11 12:55:08', 'A'),
(15, '2022-05-12 13:15:00', 'SS', 'SS', 'Shayna Smith', '2022-05-12 13:08:58', '2022-05-12 13:08:58', 'A'),
(16, '2022-05-13 13:37:00', 'SS', 'SS', 'Shayna Smith', '2022-05-13 11:39:55', '2022-05-13 11:39:55', 'A'),
(17, '2022-05-18 12:12:00', 'SS', 'SS', 'Shayna Smith', '2022-05-18 10:19:27', '2022-05-18 10:19:27', 'A'),
(18, '2022-05-19 12:20:00', 'SS', 'SS', 'Shayna Smith', '2022-05-19 13:25:21', '2022-05-19 13:25:21', 'A'),
(19, '2022-05-20 12:24:00', 'SS', 'SS', 'Shayna Smith', '2022-05-20 10:24:58', '2022-05-20 10:24:58', 'A'),
(20, '2022-05-23 13:00:00', 'SS', 'Ss', 'Shayna@prp', '2022-05-23 10:58:54', '2022-05-23 10:58:54', 'A'),
(21, '2022-05-24 13:30:00', 'SS', 'Ss', 'Shayna@prp', '2022-05-24 11:28:17', '2022-05-24 11:28:17', 'A'),
(22, '2022-05-25 13:00:00', 'Ss', 'Ss', 'Shayna@prp', '2022-05-25 11:04:26', '2022-05-25 11:04:26', 'A'),
(23, '2022-05-26 14:00:00', 'Ss', 'Ss', 'Shayna@prp', '2022-05-26 12:00:32', '2022-05-26 12:00:32', 'A'),
(24, '2022-05-27 13:20:00', 'Ss', 'Ss', 'Shayna@prp', '2022-05-27 11:22:35', '2022-05-27 11:22:35', 'A'),
(25, '2022-05-31 13:00:00', 'Ss', 'Ss', 'Shayna@prp', '2022-05-31 12:51:20', '2022-05-31 12:51:20', 'A'),
(26, '2022-06-01 13:30:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-01 13:03:57', '2022-06-01 13:03:57', 'A'),
(27, '2022-06-02 13:54:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-02 11:55:39', '2022-06-02 11:55:39', 'A'),
(28, '2022-06-03 15:30:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-03 13:21:28', '2022-06-03 13:21:28', 'A'),
(29, '2022-06-06 12:30:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-06 10:40:14', '2022-06-06 10:40:14', 'A'),
(30, '2022-06-07 12:30:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-07 10:41:00', '2022-06-07 10:41:00', 'A'),
(31, '2022-06-08 12:18:00', 'SS', 'SS', 'Shayna Smith', '2022-06-08 10:21:39', '2022-06-08 10:21:39', 'A'),
(32, '2022-06-09 12:24:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-09 10:26:22', '2022-06-09 10:26:22', 'A'),
(33, '2022-06-10 12:30:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-10 11:19:37', '2022-06-10 11:19:37', 'A'),
(34, '2022-06-13 13:00:00', 'BD', 'Ss', 'Shayna@prp', '2022-06-13 10:26:30', '2022-06-13 10:26:30', 'A'),
(35, '2022-06-14 12:25:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-14 10:29:11', '2022-06-14 10:29:11', 'A'),
(36, '2022-06-15 13:10:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-15 11:13:45', '2022-06-15 11:13:45', 'A'),
(37, '2022-06-16 12:10:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-16 10:15:46', '2022-06-16 10:15:46', 'A'),
(38, '2022-06-21 12:30:00', 'Ss', 'Ss', 'Shayna@prp', '2022-06-21 11:01:23', '2022-06-21 11:01:23', 'A');

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
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
