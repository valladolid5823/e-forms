-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 09:30 AM
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
-- Table structure for table `tbl_batch_manufacturing_production_procedures`
--

CREATE TABLE `tbl_batch_manufacturing_production_procedures` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `processing_step` varchar(255) NOT NULL,
  `procedure_description` text NOT NULL,
  `sop_reference` text NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_products`
--

CREATE TABLE `tbl_batch_manufacturing_products` (
  `PK_id` int(11) NOT NULL,
  `batch_number` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `formula_code` varchar(255) NOT NULL,
  `product_label` varchar(255) NOT NULL,
  `mfg_date` date NOT NULL,
  `expiry_date` date NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL,
  `batch_quantity` int(11) NOT NULL,
  `packaging` text NOT NULL,
  `storage_condition` varchar(30) NOT NULL,
  `prepared_by` varchar(255) NOT NULL,
  `prepared_date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `approved_by` varchar(255) NOT NULL,
  `approved_date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_deviation`
--

CREATE TABLE `tbl_batch_manufacturing_product_deviation` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `deviation_classification` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sop_reference` text NOT NULL,
  `requested_by` varchar(255) NOT NULL,
  `requested_date_time` datetime NOT NULL,
  `notes` text NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `approved_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_help`
--

CREATE TABLE `tbl_batch_manufacturing_product_help` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `help` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_issuance`
--

CREATE TABLE `tbl_batch_manufacturing_product_issuance` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `issued_by` varchar(255) NOT NULL,
  `issued_date_time` datetime NOT NULL,
  `accepted_by` varchar(255) NOT NULL,
  `accepted_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_labels`
--

CREATE TABLE `tbl_batch_manufacturing_product_labels` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `label_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lot_number` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_code` varchar(255) NOT NULL,
  `quantity_staged` int(11) NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL,
  `total_quantity_staged` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_label_trace`
--

CREATE TABLE `tbl_batch_manufacturing_product_label_trace` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `label_name` text NOT NULL,
  `total_quantity_staged` int(11) NOT NULL,
  `total_used` int(11) NOT NULL,
  `disposed` int(11) NOT NULL,
  `total_remains` int(11) NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_packaging_materials`
--

CREATE TABLE `tbl_batch_manufacturing_product_packaging_materials` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `packaging_material_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lot_number` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_packaging_materials_verification`
--

CREATE TABLE `tbl_batch_manufacturing_product_packaging_materials_verification` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `quantity_staged` int(11) NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_packaging_material_trace`
--

CREATE TABLE `tbl_batch_manufacturing_product_packaging_material_trace` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `packaging_material_name` text NOT NULL,
  `total_quantity_staged` int(11) NOT NULL,
  `total_used` int(11) NOT NULL,
  `disposed` int(11) NOT NULL,
  `total_remains` int(11) NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_post_production_verification`
--

CREATE TABLE `tbl_batch_manufacturing_product_post_production_verification` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `post_production_verification` text NOT NULL,
  `sop_reference` text NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_preoperation_verification`
--

CREATE TABLE `tbl_batch_manufacturing_product_preoperation_verification` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `pre_operation_verification` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `sop_reference` text NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_processing_equipment`
--

CREATE TABLE `tbl_batch_manufacturing_product_processing_equipment` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `equipment_id_number` int(11) NOT NULL,
  `calibration_date` date NOT NULL,
  `calibration_required` text NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_raw_materials`
--

CREATE TABLE `tbl_batch_manufacturing_product_raw_materials` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `raw_materials_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lot_number` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_code` varchar(255) NOT NULL,
  `expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_reference_documents`
--

CREATE TABLE `tbl_batch_manufacturing_product_reference_documents` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `sop_name` text NOT NULL,
  `sop_number` int(11) NOT NULL,
  `description` text NOT NULL,
  `document` text NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_retest`
--

CREATE TABLE `tbl_batch_manufacturing_product_retest` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `retest_date` date NOT NULL,
  `quantity_staged` int(11) NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL,
  `total_quantity_staged` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_review`
--

CREATE TABLE `tbl_batch_manufacturing_product_review` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `post_production_review` text NOT NULL,
  `production_reviewed_by` varchar(255) NOT NULL,
  `production_reviewed_date_time` datetime NOT NULL,
  `qa_reviewed_by` varchar(255) NOT NULL,
  `qa_reviewed_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_rework`
--

CREATE TABLE `tbl_batch_manufacturing_product_rework` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `material_quantity_for_reprocessing` int(11) NOT NULL,
  `material_quantity_for_rework` int(11) NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_team_members`
--

CREATE TABLE `tbl_batch_manufacturing_product_team_members` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `qualified` varchar(11) NOT NULL,
  `notes` text NOT NULL,
  `training_record_reference` text NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_yield_caculation`
--

CREATE TABLE `tbl_batch_manufacturing_product_yield_caculation` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `starting_weight_of_raw_materials` text NOT NULL,
  `usable_weight_of_products` text NOT NULL,
  `process_loss` text NOT NULL,
  `yield_percentage` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch_manufacturing_product_yield_caculation_verification`
--

CREATE TABLE `tbl_batch_manufacturing_product_yield_caculation_verification` (
  `PK_id` int(11) NOT NULL,
  `FK_product_id` int(11) NOT NULL,
  `performed_by` varchar(255) NOT NULL,
  `performed_date_time` datetime NOT NULL,
  `verified_by` varchar(255) NOT NULL,
  `verified_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_batch_manufacturing_production_procedures`
--
ALTER TABLE `tbl_batch_manufacturing_production_procedures`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_products`
--
ALTER TABLE `tbl_batch_manufacturing_products`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_deviation`
--
ALTER TABLE `tbl_batch_manufacturing_product_deviation`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_help`
--
ALTER TABLE `tbl_batch_manufacturing_product_help`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_issuance`
--
ALTER TABLE `tbl_batch_manufacturing_product_issuance`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_labels`
--
ALTER TABLE `tbl_batch_manufacturing_product_labels`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_label_trace`
--
ALTER TABLE `tbl_batch_manufacturing_product_label_trace`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_packaging_materials`
--
ALTER TABLE `tbl_batch_manufacturing_product_packaging_materials`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_packaging_materials_verification`
--
ALTER TABLE `tbl_batch_manufacturing_product_packaging_materials_verification`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_packaging_material_trace`
--
ALTER TABLE `tbl_batch_manufacturing_product_packaging_material_trace`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_post_production_verification`
--
ALTER TABLE `tbl_batch_manufacturing_product_post_production_verification`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_preoperation_verification`
--
ALTER TABLE `tbl_batch_manufacturing_product_preoperation_verification`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_processing_equipment`
--
ALTER TABLE `tbl_batch_manufacturing_product_processing_equipment`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_raw_materials`
--
ALTER TABLE `tbl_batch_manufacturing_product_raw_materials`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_reference_documents`
--
ALTER TABLE `tbl_batch_manufacturing_product_reference_documents`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_retest`
--
ALTER TABLE `tbl_batch_manufacturing_product_retest`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_review`
--
ALTER TABLE `tbl_batch_manufacturing_product_review`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_rework`
--
ALTER TABLE `tbl_batch_manufacturing_product_rework`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_team_members`
--
ALTER TABLE `tbl_batch_manufacturing_product_team_members`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_yield_caculation`
--
ALTER TABLE `tbl_batch_manufacturing_product_yield_caculation`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `tbl_batch_manufacturing_product_yield_caculation_verification`
--
ALTER TABLE `tbl_batch_manufacturing_product_yield_caculation_verification`
  ADD PRIMARY KEY (`PK_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_production_procedures`
--
ALTER TABLE `tbl_batch_manufacturing_production_procedures`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_products`
--
ALTER TABLE `tbl_batch_manufacturing_products`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_deviation`
--
ALTER TABLE `tbl_batch_manufacturing_product_deviation`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_help`
--
ALTER TABLE `tbl_batch_manufacturing_product_help`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_issuance`
--
ALTER TABLE `tbl_batch_manufacturing_product_issuance`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_labels`
--
ALTER TABLE `tbl_batch_manufacturing_product_labels`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_label_trace`
--
ALTER TABLE `tbl_batch_manufacturing_product_label_trace`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_packaging_materials`
--
ALTER TABLE `tbl_batch_manufacturing_product_packaging_materials`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_packaging_materials_verification`
--
ALTER TABLE `tbl_batch_manufacturing_product_packaging_materials_verification`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_packaging_material_trace`
--
ALTER TABLE `tbl_batch_manufacturing_product_packaging_material_trace`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_post_production_verification`
--
ALTER TABLE `tbl_batch_manufacturing_product_post_production_verification`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_preoperation_verification`
--
ALTER TABLE `tbl_batch_manufacturing_product_preoperation_verification`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_processing_equipment`
--
ALTER TABLE `tbl_batch_manufacturing_product_processing_equipment`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_raw_materials`
--
ALTER TABLE `tbl_batch_manufacturing_product_raw_materials`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_reference_documents`
--
ALTER TABLE `tbl_batch_manufacturing_product_reference_documents`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_retest`
--
ALTER TABLE `tbl_batch_manufacturing_product_retest`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_review`
--
ALTER TABLE `tbl_batch_manufacturing_product_review`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_rework`
--
ALTER TABLE `tbl_batch_manufacturing_product_rework`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_team_members`
--
ALTER TABLE `tbl_batch_manufacturing_product_team_members`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_yield_caculation`
--
ALTER TABLE `tbl_batch_manufacturing_product_yield_caculation`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_batch_manufacturing_product_yield_caculation_verification`
--
ALTER TABLE `tbl_batch_manufacturing_product_yield_caculation_verification`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
