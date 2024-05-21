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
-- Table structure for table `tbl_afia_gmp_checklist_template_row`
--

CREATE TABLE `tbl_afia_gmp_checklist_template_row` (
  `PK_id` int(11) NOT NULL,
  `FK_gcth_id` int(11) DEFAULT NULL,
  `gctr_title` text DEFAULT NULL,
  `gctr_status` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_afia_gmp_checklist_template_row`
--

INSERT INTO `tbl_afia_gmp_checklist_template_row` (`PK_id`, `FK_gcth_id`, `gctr_title`, `gctr_status`) VALUES
(1, 1, 'Personnel is wearing clean and proper apparel: wear appropriate; hairnets, beard nets, pocketless pants, kitchen coat, mask, and footwear. ', 'A'),
(2, 1, 'Personnel follow proper hand wash procedure. Has clean, trimmed nails that do not damage food handling gloves.', 'A'),
(3, 1, 'Personnel have no open wounds. Bandages or covers for burns, wounds, sores, scabs, and splints are waterproof, colored,. All are covered with a food service glove while handling food.', 'A'),
(4, 1, 'Personnel have no loose items. Jewelry is limited to a plain ring, such as a wedding band, and no watches, bracelets or jewelry of any other kind.', 'A'),
(5, 1, 'Employees appear in good health.', 'A'),
(6, 1, 'Eating, drinking, chewing gum, smoking, or using tobacco are allowed only in designated areas away from preparation, service, storage, and ware washing areas.', 'A'),
(7, 1, 'Hand sinks are unobstructed, operational, and clean.', 'A'),
(8, 1, 'Hand sinks are stocked with soap, a hand dryer in working conditions, and warm water.', 'A'),
(9, 1, 'Employee restrooms are operational and clean.', 'A'),
(10, 2, 'All production equipment and utensils are clean and sanitized.', 'A'),
(11, 2, 'Metal detector verified as working properly', 'A'),
(12, 2, 'Mixers, tables, and soakers are clean and sanitized', 'A'),
(13, 2, 'Coolers are certified as working properly', 'A'),
(14, 2, 'Fillers are cleaned, sanitized, and in good repair', 'A'),
(15, 3, 'Outside doors kept closed and locked are well-sealed.', 'A'),
(16, 3, 'No evidence of pests is present.', 'A'),
(17, 3, 'Bait and traps are monitored.', 'A'),
(18, 3, 'A regular schedule of pest control by the licensed pest control operator.', 'A'),
(19, 4, 'Refrigerators are kept clean and organized.', 'A'),
(20, 4, 'The temperature of cold food being held is at or below 40 ºF.', 'A'),
(21, 4, 'Food is protected from contamination.', 'A'),
(22, 5, 'All Handwashing stations are working, unblocked, and are being used.', 'A'),
(23, 5, 'A handwashing reminder sign is posted', 'A'),
(24, 5, 'Hand sinks are stocked with soap, disposable towels, and warm water', 'A'),
(25, 6, 'Temperatures of the dry storage area are between 40 ºF and 90 ºF or State public health department requirement.', 'A'),
(26, 6, 'All food and paper supplies have been stored a minimum of 6 inches off the floor or as required by applicable regulation', 'A'),
(27, 6, 'All food is labeled with name and received date.', 'A'),
(28, 6, 'Dry ingredients, packaging, and shelf-stable goods are stored well away from chemicals and cleaning equipment.', 'A'),
(29, 6, 'Open bags of food are stored and wrapped in protective packaging and labeled with the common name.', 'A'),
(30, 6, 'The FIFO (First In, First Out) method of inventory control is used.', 'A'),
(31, 6, 'There is no bulging, leaking, or damaged goods.', 'A'),
(32, 6, 'Food is protected from contamination.', 'A'),
(33, 7, 'Kitchen garbage cans are empty, clean, and free from pests.', 'A'),
(34, 7, 'The loading dock and area around the dumpster are clean.', 'A'),
(35, 7, 'Dumpsters are clean.', 'A'),
(36, 8, 'Breakage of glass, plastics, ceramics are kept in the designated bin', 'A'),
(37, 8, 'All relevant items are in their designated areas.', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_afia_gmp_checklist_template_row`
--
ALTER TABLE `tbl_afia_gmp_checklist_template_row`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_afia_gmp_checklist_template_row`
--
ALTER TABLE `tbl_afia_gmp_checklist_template_row`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
