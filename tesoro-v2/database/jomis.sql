-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2018 at 12:29 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jomis`
--

-- --------------------------------------------------------

--
-- Table structure for table `jo`
--

DROP TABLE IF EXISTS `jo`;
CREATE TABLE IF NOT EXISTS `jo` (
  `job_no` int(11) NOT NULL AUTO_INCREMENT,
  `job_kind` int(11) NOT NULL,
  `agent` int(11) NOT NULL,
  `artist` int(11) DEFAULT NULL,
  `artist_assigned_by` int(11) DEFAULT NULL,
  `artist_assigned_on` datetime DEFAULT NULL,
  `cover` int(11) DEFAULT NULL,
  `cover_updated_by` int(11) DEFAULT NULL,
  `cover_updated_on` datetime DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `materials` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `printing` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `customer` text NOT NULL,
  `pages` text NOT NULL,
  `received_on` datetime NOT NULL,
  `deadline_on` datetime DEFAULT NULL,
  `encoded_on` datetime NOT NULL,
  PRIMARY KEY (`job_no`),
  KEY `job_kind` (`job_kind`),
  KEY `agent` (`agent`),
  KEY `artist` (`artist`),
  KEY `cover` (`cover`),
  KEY `color` (`color`),
  KEY `materials` (`materials`),
  KEY `size` (`size`),
  KEY `printing` (`printing`),
  KEY `payment` (`payment`),
  KEY `artist_assigned_by` (`artist_assigned_by`),
  KEY `cover_updated_by` (`cover_updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=678457 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo`
--

INSERT INTO `jo` (`job_no`, `job_kind`, `agent`, `artist`, `artist_assigned_by`, `artist_assigned_on`, `cover`, `cover_updated_by`, `cover_updated_on`, `color`, `materials`, `size`, `printing`, `payment`, `description`, `customer`, `pages`, `received_on`, `deadline_on`, `encoded_on`) VALUES
(2134, 2, 2, 3, 5, '2018-09-25 07:26:57', 3, 5, '2018-09-25 07:28:09', 2, NULL, NULL, 1, NULL, 'Filipino', 'F.Bustamante National High School', '', '2018-12-24 00:00:00', NULL, '2018-09-18 14:19:09'),
(2357, 2, 2, 3, 5, '2018-09-25 07:37:33', NULL, NULL, NULL, 1, 1, 1, 1, NULL, '', 'Rolly', '', '2018-02-25 00:00:00', '2018-09-18 00:00:00', '2018-09-14 15:39:44'),
(9087, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 'Tabloid', 'Rolly', '134', '2018-02-25 00:00:00', NULL, '2018-09-14 12:14:07'),
(12345, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Year', 'Rolly', '', '1998-02-25 00:00:00', NULL, '2018-09-11 19:06:00'),
(12412, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Me', 'Rolly', '134', '2018-02-25 00:00:00', NULL, '2018-09-13 18:05:19'),
(21678, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ded', 'ed', '', '2018-09-18 00:00:00', NULL, '2018-09-18 14:26:00'),
(21796, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ded', 'Fotofun', '', '2018-01-04 00:00:00', NULL, '2018-09-18 14:24:35'),
(25890, 1, 2, 3, 3, '2018-09-21 00:00:00', 3, 3, '2018-09-24 10:44:42', NULL, NULL, NULL, NULL, 1, 'Year', 'Rolly', '134', '2018-02-25 00:00:00', NULL, '2018-09-14 11:49:36'),
(46778, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Year', 'Rolly', '134', '2018-02-25 00:00:00', NULL, '2018-09-13 18:09:08'),
(56364, 1, 2, 3, 3, '2018-09-24 09:12:21', 3, 3, '2018-09-24 09:14:16', NULL, NULL, NULL, NULL, NULL, '', 'Fotofun', '', '2018-09-21 00:00:00', NULL, '2018-09-21 08:19:23'),
(65890, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Year', 'Rolly', '134', '2018-02-09 00:00:00', NULL, '2018-09-14 12:00:01'),
(77890, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Year', 'Rolly', '123', '2018-02-25 00:00:00', NULL, '2018-09-13 18:10:10'),
(213567, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Filipino', 'emcor- kidapawan', '12', '2018-09-18 00:00:00', NULL, '2018-09-18 14:29:08'),
(458395, 1, 2, 3, 3, '2018-09-24 10:12:54', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'emcor- kidapawan', '', '2018-09-21 00:00:00', NULL, '2018-09-21 08:24:35'),
(678456, 3, 2, 3, 3, '2018-09-24 12:49:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'emcor- kidapawan', '', '2018-09-18 00:00:00', NULL, '2018-09-18 14:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `joc_units`
--

DROP TABLE IF EXISTS `joc_units`;
CREATE TABLE IF NOT EXISTS `joc_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `units` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `joc_units`
--

INSERT INTO `joc_units` (`id`, `units`, `updated_on`, `updated_by`) VALUES
(1, 'book/s', '2018-09-11 19:04:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_list`
--

DROP TABLE IF EXISTS `jos_list`;
CREATE TABLE IF NOT EXISTS `jos_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jos_list`
--

INSERT INTO `jos_list` (`id`, `status`, `updated_on`, `updated_by`) VALUES
(1, 'No Files Yet', '2018-09-18 08:05:35', 1),
(2, 'Layout', '2018-09-18 08:06:38', 1),
(3, 'Proof Read (1st)', '2018-09-18 08:08:09', 1),
(4, 'Proof Read (2nd)', '2018-09-18 08:08:23', 1),
(5, 'Proof Read (Final)', '2018-09-18 08:08:36', 1),
(6, 'Pending', '2018-09-18 08:08:49', 1),
(7, 'For Printing', '2018-09-18 08:10:31', 1),
(8, 'Impose', '2018-09-18 08:10:41', 1),
(9, 'Out', '2018-09-18 08:10:52', 1),
(10, 'Cancelled', '2018-09-18 08:11:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_colors`
--

DROP TABLE IF EXISTS `jo_colors`;
CREATE TABLE IF NOT EXISTS `jo_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_colors`
--

INSERT INTO `jo_colors` (`id`, `color`, `updated_on`, `updated_by`) VALUES
(1, 'Black', '2018-09-27 14:53:47', 1),
(2, 'White', '2018-09-27 14:53:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_copies`
--

DROP TABLE IF EXISTS `jo_copies`;
CREATE TABLE IF NOT EXISTS `jo_copies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_no` int(11) NOT NULL,
  `units` int(11) DEFAULT NULL,
  `copies` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_no` (`job_no`),
  KEY `units` (`units`),
  KEY `added_by` (`added_by`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_copies`
--

INSERT INTO `jo_copies` (`id`, `job_no`, `units`, `copies`, `added_on`, `added_by`) VALUES
(1, 46778, 1, 1, '2018-09-13 18:09:08', 2),
(2, 25890, 1, 1, '2018-09-14 11:49:36', 2),
(3, 56364, 1, 12, '2018-09-21 08:19:23', 2),
(4, 458395, 1, 2, '2018-09-21 08:24:35', 2),
(5, 213567, NULL, 2, '2018-09-24 14:01:47', 3),
(6, 213567, NULL, 12, '2018-09-24 14:01:59', 3),
(7, 213567, 1, 3, '2018-09-24 14:02:16', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jo_kinds`
--

DROP TABLE IF EXISTS `jo_kinds`;
CREATE TABLE IF NOT EXISTS `jo_kinds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_type` int(11) NOT NULL,
  `job_kind` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_type` (`job_type`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_kinds`
--

INSERT INTO `jo_kinds` (`id`, `job_type`, `job_kind`, `updated_on`, `updated_by`) VALUES
(1, 1, 'Yearbook', '2018-09-11 19:02:45', 1),
(2, 2, 'Receipt', '2018-09-11 19:02:55', 1),
(3, 3, 'Tabloid', '2018-09-11 19:03:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_materials`
--

DROP TABLE IF EXISTS `jo_materials`;
CREATE TABLE IF NOT EXISTS `jo_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materials` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_materials`
--

INSERT INTO `jo_materials` (`id`, `materials`, `updated_on`, `updated_by`) VALUES
(1, 'Carbonless White', '2018-09-11 19:03:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_payments`
--

DROP TABLE IF EXISTS `jo_payments`;
CREATE TABLE IF NOT EXISTS `jo_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_payments`
--

INSERT INTO `jo_payments` (`id`, `payment`, `updated_on`, `updated_by`) VALUES
(1, 'Full', '2018-09-11 19:03:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_printing`
--

DROP TABLE IF EXISTS `jo_printing`;
CREATE TABLE IF NOT EXISTS `jo_printing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `printing` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_printing`
--

INSERT INTO `jo_printing` (`id`, `printing`, `updated_on`, `updated_by`) VALUES
(1, 'Offset', '2018-09-11 19:03:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_size`
--

DROP TABLE IF EXISTS `jo_size`;
CREATE TABLE IF NOT EXISTS `jo_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_size`
--

INSERT INTO `jo_size` (`id`, `size`, `updated_on`, `updated_by`) VALUES
(1, '8.5x11', '2018-09-11 19:03:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_status`
--

DROP TABLE IF EXISTS `jo_status`;
CREATE TABLE IF NOT EXISTS `jo_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_no` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sample` text NOT NULL,
  `correction` text NOT NULL,
  `notes` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_no` (`job_no`),
  KEY `status` (`status`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_status`
--

INSERT INTO `jo_status` (`id`, `job_no`, `status`, `sample`, `correction`, `notes`, `updated_on`, `updated_by`) VALUES
(1, 25890, 10, '', '', 'Gamay', '2018-09-18 00:00:00', 1),
(2, 458395, 1, '', '', '', '2018-09-24 10:24:37', 3),
(3, 458395, 2, '', '', 'naga layout pa', '2018-09-24 10:25:20', 3),
(4, 25890, 1, '', '', '', '2018-09-24 10:27:16', 3),
(5, 458395, 10, '', '', '', '2018-09-24 10:34:02', 3),
(6, 458395, 1, '', '', '', '2018-09-24 10:34:55', 3),
(7, 458395, 9, '', '', '', '2018-09-24 10:35:25', 3),
(8, 678456, 1, '', '', 'waiting', '2018-09-24 12:50:03', 3),
(9, 2134, 10, '', '', '', '2018-09-25 07:27:34', 5),
(10, 2134, 2, '', '', '', '2018-09-25 07:28:00', 5),
(11, 2134, 10, '', '', '', '2018-09-25 07:28:30', 5),
(12, 56364, 10, '', '', '', '2018-09-25 07:29:29', 3),
(13, 678456, 10, '', '', '', '2018-09-25 07:29:42', 3),
(14, 25890, 10, '', '', '', '2018-09-25 07:29:54', 3),
(15, 2134, 8, '', '', '', '2018-09-25 07:31:43', 5),
(16, 2134, 10, '', '', '', '2018-09-25 07:33:16', 5),
(17, 2357, 1, '', '', '', '2018-09-25 07:52:24', 5),
(18, 2357, 10, '', '', '', '2018-09-25 07:52:32', 5),
(19, 2134, 1, '', '', '', '2018-09-25 07:57:20', 5),
(20, 2357, 3, '', '', '', '2018-09-25 07:57:39', 5),
(21, 2134, 10, '', '', '', '2018-09-25 08:06:32', 5);

-- --------------------------------------------------------

--
-- Table structure for table `jo_type`
--

DROP TABLE IF EXISTS `jo_type`;
CREATE TABLE IF NOT EXISTS `jo_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_type` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_type`
--

INSERT INTO `jo_type` (`id`, `job_type`, `updated_on`, `updated_by`) VALUES
(1, 'Big', '2018-09-11 19:02:07', 1),
(2, 'Small', '2018-09-11 19:02:17', 1),
(3, 'Big Small', '2018-09-11 19:02:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_list`
--

DROP TABLE IF EXISTS `users_list`;
CREATE TABLE IF NOT EXISTS `users_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `status` set('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `birthdate` date NOT NULL,
  `gender` set('Female','Male') NOT NULL,
  `picture` text NOT NULL,
  `added_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_list`
--

INSERT INTO `users_list` (`id`, `type`, `status`, `username`, `email`, `password`, `firstname`, `middlename`, `lastname`, `birthdate`, `gender`, `picture`, `added_on`) VALUES
(1, 2, 'Active', 'romalepali', 'rolleenao07@gmail.com', '928387fb61f387cc597b41d0e74e43d5', 'Rolly', 'Lee', 'Linao', '1998-02-25', 'Male', '249433', '2018-08-08 08:03:39'),
(2, 6, 'Active', 'pjlee1234', 'pjlee1234@gmail.com', 'a683887de157041e74c7698c74efacfc', 'Peter', 'James', 'Lee', '2018-09-11', 'Male', 'default', '2018-09-11 00:00:00'),
(3, 4, 'Active', 'orgb1234', 'orgb1234@gmail.com', '443e10a3bf6148a226064c5741fe63b5', 'Organizer', 'Kay', 'Big', '2018-09-21', 'Male', 'default', '2018-09-21 09:37:52'),
(4, 6, 'Active', 'avergara', 'aprilgnvergara@gmail.com', '2e9867ccf3194aa7192cf63ae15435f2', 'April', 'Nalzaro', 'Vergara', '1998-04-19', 'Female', 'default', '2018-09-21 11:08:44'),
(5, 5, 'Active', 'orgs1234', 'orgs1234@gmail.com', 'b16298db961b1267120cf529420a84cf', 'Organizer', 'Jud', 'Small', '2018-09-25', 'Male', 'default', '2018-09-25 07:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

DROP TABLE IF EXISTS `users_type`;
CREATE TABLE IF NOT EXISTS `users_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_type`
--

INSERT INTO `users_type` (`id`, `type`) VALUES
(1, 'Limited User'),
(2, 'Support Maintenance'),
(3, 'Supervisor'),
(4, 'Organizer (Big)'),
(5, 'Organizer (Small)'),
(6, 'Agent'),
(7, 'Artist');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jo`
--
ALTER TABLE `jo`
  ADD CONSTRAINT `jo_ibfk_1` FOREIGN KEY (`job_kind`) REFERENCES `jo_kinds` (`id`),
  ADD CONSTRAINT `jo_ibfk_10` FOREIGN KEY (`artist_assigned_by`) REFERENCES `users_list` (`id`),
  ADD CONSTRAINT `jo_ibfk_11` FOREIGN KEY (`cover_updated_by`) REFERENCES `users_list` (`id`),
  ADD CONSTRAINT `jo_ibfk_2` FOREIGN KEY (`printing`) REFERENCES `jo_printing` (`id`),
  ADD CONSTRAINT `jo_ibfk_3` FOREIGN KEY (`payment`) REFERENCES `jo_payments` (`id`),
  ADD CONSTRAINT `jo_ibfk_4` FOREIGN KEY (`color`) REFERENCES `jo_colors` (`id`),
  ADD CONSTRAINT `jo_ibfk_5` FOREIGN KEY (`materials`) REFERENCES `jo_materials` (`id`),
  ADD CONSTRAINT `jo_ibfk_6` FOREIGN KEY (`agent`) REFERENCES `users_list` (`id`),
  ADD CONSTRAINT `jo_ibfk_7` FOREIGN KEY (`artist`) REFERENCES `users_list` (`id`),
  ADD CONSTRAINT `jo_ibfk_8` FOREIGN KEY (`cover`) REFERENCES `users_list` (`id`),
  ADD CONSTRAINT `jo_ibfk_9` FOREIGN KEY (`size`) REFERENCES `jo_size` (`id`);

--
-- Constraints for table `joc_units`
--
ALTER TABLE `joc_units`
  ADD CONSTRAINT `joc_units_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jos_list`
--
ALTER TABLE `jos_list`
  ADD CONSTRAINT `jos_list_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_colors`
--
ALTER TABLE `jo_colors`
  ADD CONSTRAINT `jo_colors_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_copies`
--
ALTER TABLE `jo_copies`
  ADD CONSTRAINT `jo_copies_ibfk_1` FOREIGN KEY (`job_no`) REFERENCES `jo` (`job_no`),
  ADD CONSTRAINT `jo_copies_ibfk_2` FOREIGN KEY (`units`) REFERENCES `joc_units` (`id`),
  ADD CONSTRAINT `jo_copies_ibfk_3` FOREIGN KEY (`added_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_kinds`
--
ALTER TABLE `jo_kinds`
  ADD CONSTRAINT `jo_kinds_ibfk_1` FOREIGN KEY (`job_type`) REFERENCES `jo_type` (`id`),
  ADD CONSTRAINT `jo_kinds_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_materials`
--
ALTER TABLE `jo_materials`
  ADD CONSTRAINT `jo_materials_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_payments`
--
ALTER TABLE `jo_payments`
  ADD CONSTRAINT `jo_payments_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_printing`
--
ALTER TABLE `jo_printing`
  ADD CONSTRAINT `jo_printing_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_size`
--
ALTER TABLE `jo_size`
  ADD CONSTRAINT `jo_size_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_status`
--
ALTER TABLE `jo_status`
  ADD CONSTRAINT `jo_status_ibfk_1` FOREIGN KEY (`status`) REFERENCES `jos_list` (`id`),
  ADD CONSTRAINT `jo_status_ibfk_2` FOREIGN KEY (`job_no`) REFERENCES `jo` (`job_no`),
  ADD CONSTRAINT `jo_status_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `jo_type`
--
ALTER TABLE `jo_type`
  ADD CONSTRAINT `jo_type_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `users_list`
--
ALTER TABLE `users_list`
  ADD CONSTRAINT `users_list_ibfk_1` FOREIGN KEY (`type`) REFERENCES `users_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
