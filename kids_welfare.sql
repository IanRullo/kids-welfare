-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kids_welfare`
--
CREATE DATABASE IF NOT EXISTS `kids_welfare` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kids_welfare`;

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE IF NOT EXISTS `adoptions` (
  `adoption_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `adoption_date` date NOT NULL,
  PRIMARY KEY (`adoption_id`),
  KEY `parent_id` (`parent_id`),
  KEY `child_id` (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adoption_form`
--

CREATE TABLE IF NOT EXISTS `adoption_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `income_proof` varchar(255) NOT NULL,
  `sworn_affidavit` varchar(255) NOT NULL,
  `reason_for_adoption` text NOT NULL,
  `social_references` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_form`
--

INSERT INTO `adoption_form` (`id`, `request_id`, `national_id`, `job_title`, `income_proof`, `sworn_affidavit`, `reason_for_adoption`, `social_references`, `submission_date`) VALUES
(1, 1, '../../assets/img1751264167_Inspector_Report_Form_Print_1.pdf', 'software engineer', '../../assets/img1751264167_Inspector_Report_Form_Print_1.pdf', '../../assets/img1751264167_Inspector_Report_Form_Print_1.pdf', 'nataka kuadopt mtoto napenda kusaidia watoto', 'makuka mohammedi na rashid amour\r\nnamba za makuka 0686805152\r\nnamba za rashid 0689651222', '2025-06-30 06:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `adoption_requests`
--

CREATE TABLE IF NOT EXISTS `adoption_requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_name` varchar(100) NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `child_id` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  PRIMARY KEY (`request_id`),
  KEY `child_id` (`child_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_requests`
--

INSERT INTO `adoption_requests` (`request_id`, `parent_name`, `contact_info`, `address`, `child_id`, `request_date`, `status`) VALUES
(1, 'Yasin Msemo', 'msemo@gmail.com', 'Some Address', 1, '2025-06-30 06:16:07', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE IF NOT EXISTS `allocations` (
  `allocation_id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `foster_id` int(11) NOT NULL,
  `allocation_date` date NOT NULL,
  PRIMARY KEY (`allocation_id`),
  KEY `child_id` (`child_id`),
  KEY `foster_id` (`foster_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocations`
--

INSERT INTO `allocations` (`allocation_id`, `child_id`, `foster_id`, `allocation_date`) VALUES
(1, 1, 2, '2025-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE IF NOT EXISTS `children` (
  `child_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `dob` date NOT NULL,
  `guide` varchar(200) NOT NULL,
  `school_name` varchar(50) DEFAULT NULL,
  `class_level` varchar(15) DEFAULT NULL,
  `address` varchar(30) NOT NULL,
  `file` varchar(200) NOT NULL,
  `report` text NOT NULL,
  `available_for_adoption` varchar(50) DEFAULT 'Yes',
  `status` enum('allocated','not allocated') DEFAULT 'not allocated',
  PRIMARY KEY (`child_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`child_id`, `first_name`, `last_name`, `gender`, `dob`, `guide`, `school_name`, `class_level`, `address`, `file`, `report`, `available_for_adoption`, `status`) VALUES
(1, 'mm', 'mm', 'Female', '2020-06-29', '0712345676', 'mkj', 'std 54', 'mjk', '../../assets/uploads/kids_welfaree1516879bae9c1fdc1811050fcd1be20.jpg', 'mjkiuuhgggggff', 'Yes', 'not allocated');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regionId` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `regionId` (`regionId`)
) ENGINE=InnoDB AUTO_INCREMENT=5010 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `regionId`, `code`, `name`) VALUES
(5000, 4000, 'DAR-DC', 'Ilala District'),
(5001, 4000, 'DAR-DC', 'Kinondoni District'),
(5002, 4000, 'ARU-DC', 'Arusha CBD'),
(5003, 4000, 'MOR-DC', 'Morogoro CBD'),
(5004, 4000, 'MORO-DC', 'Morogoro'),
(5005, 4000, 'MORO-DC', 'Mvomero'),
(5006, 4000, 'ARU-DC', 'Arumeru'),
(5007, 4000, 'KLM-DC', 'HAI District'),
(5008, 4000, 'BBT-TC', 'SIHA Town Council'),
(5009, 4000, 'LNG-DC', 'Longido District');

-- --------------------------------------------------------

--
-- Table structure for table `fostercare`
--

CREATE TABLE IF NOT EXISTS `fostercare` (
  `foster_id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) DEFAULT NULL,
  `foster_name` varchar(50) NOT NULL,
  `region` varchar(25) NOT NULL,
  `district` varchar(25) NOT NULL,
  `ward` varchar(25) NOT NULL,
  `foster_start_date` date NOT NULL,
  `foster_end_date` date DEFAULT NULL,
  PRIMARY KEY (`foster_id`),
  KEY `child_id` (`child_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fostercare`
--

INSERT INTO `fostercare` (`foster_id`, `child_id`, `foster_name`, `region`, `district`, `ward`, `foster_start_date`, `foster_end_date`) VALUES
(1, NULL, 'LAMOMA', '4000', 'Ilala District', '5009', '2025-06-20', '2025-06-30'),
(2, NULL, 'HISANI ORPHANAGE CENTER', '4000', 'Ilala District', '5009', '2020-10-29', '2025-06-30'),
(5, NULL, 'LAMOMA FOSTERCARE', 'Dar es salaam', 'Ilala', 'Ilala', '2024-07-22', '2024-07-15'),
(6, NULL, 'ABC FOSTERCARE', 'Morogoro', 'Mvomero', 'Mzumbe', '2024-07-08', '2024-07-02'),
(7, NULL, 'MASSAWE KIDS', 'Arusha', 'Arumeru', 'Usa', '2024-07-01', '2024-07-02'),
(9, NULL, 'SAYANSI', '4000', 'Ilala District', '5009', '2024-01-01', '2026-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `status`, `created_at`) VALUES
(1, 15, 'Your adoption request for child ID 1 has been approved.', 'read', '2025-06-30 06:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4010 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `code`, `name`) VALUES
(4000, 'DAR', 'Dar es salaam'),
(4001, 'ARU', 'Arusha'),
(4002, 'MOR', 'Morogoro'),
(4003, 'MWZ', 'Mwanza'),
(4004, 'TA', 'Tanga'),
(4005, 'DOM', 'Dodoma'),
(4007, 'MNY', 'Manyara'),
(4008, 'MTW', 'Mtwara'),
(4009, 'MBY', 'Mbeya');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(12) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `dob` date DEFAULT NULL,
  `marital_status` enum('single','married','divorced') NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','parent','social_worker','police') NOT NULL DEFAULT 'parent',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verification_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `gender`, `dob`, `marital_status`, `password`, `role`, `is_verified`, `verification_code`) VALUES
(1, 'Zaynab', 'Makuka', 'zaynabmakuka@gmail.com', '0626694796', 'Female', NULL, '', '$2y$10$7TcgT4sQKa/W7h5C2YfwJeP92pCCi6Gf6o14B27SOO9xJW6XztW3W', 'admin', 1, NULL),
(2, 'Mohammedi', 'Hasheem', 'makuka.mohammedi@gmail.com', '0686805152', 'Male', NULL, '', '$2y$10$7.iIaeDs.AVm2YhK7CfgL.faWKQ/GvpxjMWHwKx4OWU6WiDSZnooa', 'parent', 1, '7bd8a5bc4ffdf8ed88bf7dd170acb936'),
(3, 'Rashid', 'Amour', 'rashidalpute@gmail.com', '0712345622', 'Male', NULL, '', '$2y$10$HfQ4hdw6o/w8N25Ymr6whO9ZE/8RPiIyo.Y7uh6rUHVfSW0.IP.Fi', 'parent', 1, '4cd1370149bd850b1501eccbce72606b'),
(4, 'byzor', 'bar', 'barbyzor@yahoo.com', '0786897645', 'Male', NULL, '', '$2y$10$NlZygp8YzgHI.uujuy94yevGiTwPD7VBbv8OEFrAgsRHG7HoliIr2', 'parent', 1, 'da88a410bc1084b09f5c78ce9a2240dc'),
(5, 'rashid', 'amour', 'rashidytwoty@gmail.com', '0789654222', 'Male', NULL, '', '$2y$10$xAIBe15/ybfKVS.BmgdfCeu1/h8DCd.7YFvXJaThIzz8zxbl9fjG.', 'parent', 1, NULL),
(6, 'mamai', 'mamadu', 'mamai@gmail.com', '0712131415', 'Male', NULL, '', '$2y$10$K6tLYt34zT8EInheTC0uQOk.Nbaq/Tf08HgmtZuQ0E0tJIB22jdku', 'parent', 1, NULL),
(7, 'mshimbi', 'michael', 'mshimbi@gmail.com', '0789865434', 'Female', NULL, '', '$2y$10$lZENWjg4TpwHEh8EkMikZe5xxIGjVGY3gUKG8O1gyzLU.IL2p1ff.', 'parent', 1, NULL),
(8, 'mamaduu', 'samba', 'samba@gmail.com', '0765341234', 'Female', NULL, '', '$2y$10$zVcylXjGGg.AkqSOHxN8POTb0ZKBPYZ3KjbRZjWD8uIrW0HTwfqkm', 'parent', 1, NULL),
(9, 'Gian', 'sylvester', 'gian@gmail.com', '0744505219', 'Male', NULL, '', '$2y$10$PT.lacGaXg7wNvxRsNN4YOQ..O20AZG9a8HDRNOfvkReVnU0h/gqy', 'parent', 1, NULL),
(10, 'kitambi', 'kikubwa', 'kitambi@gmail.com', '0765431234', 'Female', NULL, '', '$2y$10$D7gg87A.NvHQ.TVi1DwmHOiPWUyJJMWlzOIcbMXLFbiIo4LfS3HoC', 'parent', 1, NULL),
(11, 'mremboo', 'massawe', 'mremboo@gmail.com', '0789654323', 'Female', '2003-09-29', 'married', '$2y$10$t8Mj4cXCyKGUWiClODsXeuBDgNtBUg3smhL7Fq6EyhScxjqMTd5cu', 'parent', 1, NULL),
(12, 'Mohammedi', 'Hasheem', 'makukahasheem@yahoo.com', '0674245152', 'Male', '1996-09-17', 'married', '$2y$10$unFW2i09WhhngYyVmffy4uAv80VQ9/WGMnbAwcXFOXKZ9Zwzwhumy', 'admin', 1, NULL),
(13, 'Laura', 'Massawe', 'massawelaura@gmail.com', '0783888209', 'Female', NULL, 'single', '$2y$10$UrhG.S6Qn8kpmz44M39MquFWVKy7RTYX7vYWHuyE.ec/L3Qr71wxC', 'social_worker', 1, NULL),
(14, 'Salum', 'Mtutura', 'salum@yahoo.com', '0786564312', 'Male', NULL, 'single', '$2y$10$9mAHCiOJE4z0quTOchM2Au8yEAW8bMQVRUrmlpi.wAKQIfp6MhiP2', 'social_worker', 1, NULL),
(15, 'Yasin', 'Msemo', 'msemo@gmail.com', '0711234565', 'Male', '1996-06-17', 'married', '$2y$10$eCkIHEAEXM9uqBqOCFgbD.My5VG0PtKct8ZUSMQF7fszUz/5doi3m', 'parent', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE IF NOT EXISTS `ward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `districtId` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `districtId` (`districtId`)
) ENGINE=InnoDB AUTO_INCREMENT=5011 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `districtId`, `code`, `name`) VALUES
(5000, 5000, 'WARD-001', 'Mafiga'),
(5001, 5000, 'WARD-002', 'Kihonda'),
(5002, 5000, 'WARD-003', 'Mvomero'),
(5003, 5000, 'WARD-004', 'Chamwino'),
(5004, 5000, 'WARD-005', 'Mindu'),
(5005, 5000, 'WARD-006', 'Mzumbe'),
(5006, 5000, 'WARD-007', 'Mlali'),
(5007, 5000, 'WARD-008', 'Mikese'),
(5008, 5000, 'WARD-009', 'Mgeta'),
(5009, 5000, 'WARD-010', 'Ilala'),
(5010, 5000, 'WARD-011', 'Kinondoni');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoptions_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `children` (`child_id`) ON DELETE CASCADE;

--
-- Constraints for table `adoption_form`
--
ALTER TABLE `adoption_form`
  ADD CONSTRAINT `adoption_form_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `adoption_requests` (`request_id`) ON DELETE CASCADE;

--
-- Constraints for table `adoption_requests`
--
ALTER TABLE `adoption_requests`
  ADD CONSTRAINT `adoption_requests_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`child_id`) ON DELETE CASCADE;

--
-- Constraints for table `allocations`
--
ALTER TABLE `allocations`
  ADD CONSTRAINT `allocations_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`child_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `allocations_ibfk_2` FOREIGN KEY (`foster_id`) REFERENCES `fostercare` (`foster_id`) ON DELETE CASCADE;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`regionId`) REFERENCES `region` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fostercare`
--
ALTER TABLE `fostercare`
  ADD CONSTRAINT `fostercare_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`child_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ward`
--
ALTER TABLE `ward`
  ADD CONSTRAINT `ward_ibfk_1` FOREIGN KEY (`districtId`) REFERENCES `district` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
