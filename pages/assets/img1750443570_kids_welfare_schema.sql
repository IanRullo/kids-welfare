-- Database: kids_welfare

CREATE DATABASE IF NOT EXISTS `kids_welfare` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kids_welfare`;

-- Table: user
CREATE TABLE `user` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(12) NOT NULL,
  `marital_status` ENUM('Single','Married','Divorced','Widowed') DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `gender` ENUM('Male','Female') NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','parent','social_worker','police') NOT NULL DEFAULT 'parent',
  `is_verified` TINYINT(1) NOT NULL DEFAULT 0,
  `verification_code` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: adoptions
CREATE TABLE `adoptions` (
  `adoption_id` INT(11) NOT NULL AUTO_INCREMENT,
  `parent_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `child_id` INT(11) NOT NULL,
  `adoption_date` DATE NOT NULL,
  PRIMARY KEY (`adoption_id`),
  FOREIGN KEY (`parent_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`child_id`) REFERENCES `children`(`child_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: adoption_requests
CREATE TABLE `adoption_requests` (
  `request_id` INT(11) NOT NULL AUTO_INCREMENT,
  `parent_name` VARCHAR(100) NOT NULL,
  `contact_info` VARCHAR(100) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `child_id` INT(11) NOT NULL,
  `request_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `status` ENUM('pending','approved','rejected') DEFAULT 'pending',
  PRIMARY KEY (`request_id`),
  FOREIGN KEY (`child_id`) REFERENCES `children`(`child_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: adoption_form
CREATE TABLE `adoption_form` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `request_id` INT(11) NOT NULL,
  `national_id` VARCHAR(255) NOT NULL,
  `job_title` VARCHAR(100) NOT NULL,
  `income_proof` VARCHAR(255) NOT NULL,
  `sworn_affidavit` VARCHAR(255) NOT NULL,
  `reason_for_adoption` TEXT NOT NULL,
  `social_references` TEXT NOT NULL,
  `submission_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`request_id`) REFERENCES `adoption_requests`(`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: children
CREATE TABLE `children` (
  `child_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `gender` ENUM('Male','Female') NOT NULL,
  `dob` DATE NOT NULL,
  `guide` VARCHAR(200) NOT NULL,
  `school_name` VARCHAR(50),
  `class_level` VARCHAR(15),
  `address` VARCHAR(30) NOT NULL,
  `file` VARCHAR(200) NOT NULL,
  `report` TEXT NOT NULL,
  `available_for_adoption` VARCHAR(50) DEFAULT 'Yes',
  `status` ENUM('allocated','not allocated') DEFAULT 'not allocated',
  PRIMARY KEY (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: allocations
CREATE TABLE `allocations` (
  `allocation_id` INT(11) NOT NULL AUTO_INCREMENT,
  `child_id` INT(11) NOT NULL,
  `foster_id` INT(11) NOT NULL,
  `allocation_date` DATE NOT NULL,
  PRIMARY KEY (`allocation_id`),
  FOREIGN KEY (`child_id`) REFERENCES `children`(`child_id`) ON DELETE CASCADE,
  FOREIGN KEY (`foster_id`) REFERENCES `fostercare`(`foster_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: fostercare
CREATE TABLE `fostercare` (
  `foster_id` INT(11) NOT NULL AUTO_INCREMENT,
  `child_id` INT(11) DEFAULT NULL,
  `foster_name` VARCHAR(50) NOT NULL,
  `region` VARCHAR(25) NOT NULL,
  `district` VARCHAR(25) NOT NULL,
  `ward` VARCHAR(25) NOT NULL,
  `foster_start_date` DATE NOT NULL,
  `foster_end_date` DATE DEFAULT NULL,
  PRIMARY KEY (`foster_id`),
  FOREIGN KEY (`child_id`) REFERENCES `children`(`child_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: notifications
CREATE TABLE `notifications` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `message` TEXT NOT NULL,
  `status` ENUM('unread','read') DEFAULT 'unread',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: region
CREATE TABLE `region` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: district
CREATE TABLE `district` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `regionId` INT(11) NOT NULL,
  `code` VARCHAR(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`regionId`) REFERENCES `region`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: ward
CREATE TABLE `ward` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `districtId` INT(11) NOT NULL,
  `code` VARCHAR(20) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`districtId`) REFERENCES `district`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: visitors
CREATE TABLE `visitors` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(45) NOT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `visit_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY (`visit_time`),
  KEY (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
