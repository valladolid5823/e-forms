-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 05:05 AM
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
-- Table structure for table `tbl_watch_performance_check`
--

CREATE TABLE `tbl_watch_performance_check` (
  `PK_id` int(11) NOT NULL,
  `FK_watch_signature_id` int(11) NOT NULL,
  `substance` text NOT NULL,
  `reading` text NOT NULL,
  `pass_fail` varchar(30) NOT NULL,
  `inspected_by` varchar(254) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_watch_performance_check`
--

INSERT INTO `tbl_watch_performance_check` (`PK_id`, `FK_watch_signature_id`, `substance`, `reading`, `pass_fail`, `inspected_by`, `date_time`) VALUES
(2, 79, 'Substance', 'Reading', '', 'Inspected by', '2024-05-21 10:21:00'),
(3, 80, 'Substance', 'Reading', '', 'Inspected by', '2024-05-21 10:21:00'),
(4, 81, 'Substance', 'Reading', '', 'asd', '2024-05-21 10:25:00'),
(5, 82, 'asd', 'asd', '', 'asdas', '2024-05-21 10:43:00'),
(6, 83, 'asdasd', 'asdasd', 'Pass', 'asd', '2024-05-21 10:44:00'),
(7, 84, 'as', 'dasdas', 'Pass', 'dasdas', '2024-05-21 10:58:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_watch_performance_check`
--
ALTER TABLE `tbl_watch_performance_check`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_watch_performance_check`
--
ALTER TABLE `tbl_watch_performance_check`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
