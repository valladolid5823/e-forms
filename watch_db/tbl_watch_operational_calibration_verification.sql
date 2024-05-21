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
-- Table structure for table `tbl_watch_operational_calibration_verification`
--

CREATE TABLE `tbl_watch_operational_calibration_verification` (
  `PK_id` int(11) NOT NULL,
  `FK_watch_signature_id` int(11) NOT NULL,
  `equipment_tracking_no` varchar(254) NOT NULL,
  `equipment_description` text NOT NULL,
  `model_no` varchar(254) NOT NULL,
  `serial_no` varchar(254) NOT NULL,
  `calibration_certification_date` date NOT NULL,
  `calibration_certification_due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_watch_operational_calibration_verification`
--

INSERT INTO `tbl_watch_operational_calibration_verification` (`PK_id`, `FK_watch_signature_id`, `equipment_tracking_no`, `equipment_description`, `model_no`, `serial_no`, `calibration_certification_date`, `calibration_certification_due_date`) VALUES
(1, 79, 'Equipment tracking', 'Equipment description', 'Model', 'Serial', '2024-05-21', '2024-05-21'),
(2, 80, 'Equipment tracking', 'Equipment description', 'Model', 'Serial', '2024-05-21', '2024-05-21'),
(3, 81, 'asd', 'asda', 'sdasdas', 'dasdasd', '2024-05-21', '2024-05-21'),
(4, 82, 'asd', 'asd', 'asd', 'asdasd', '2024-05-21', '2024-05-21'),
(5, 83, 'asd', 'asdas', 'dasd', 'asdasd', '2024-05-21', '2024-05-21'),
(6, 84, 'as', 'dasda', 'sdasd', 'asdasd', '2024-05-21', '2024-05-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_watch_operational_calibration_verification`
--
ALTER TABLE `tbl_watch_operational_calibration_verification`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_watch_operational_calibration_verification`
--
ALTER TABLE `tbl_watch_operational_calibration_verification`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
