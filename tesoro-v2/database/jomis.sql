-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 06:58 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

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

CREATE TABLE `jo` (
  `job_no` int(11) NOT NULL,
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
  `received_on` date NOT NULL,
  `deadline_on` date DEFAULT NULL,
  `encoded_by` int(11) NOT NULL,
  `encoded_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `joc_units`
--

CREATE TABLE `joc_units` (
  `id` int(11) NOT NULL,
  `units` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `joc_units`
--

INSERT INTO `joc_units` (`id`, `units`, `updated_on`, `updated_by`) VALUES
(1, 'book/s', '2018-10-02 09:58:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jos_list`
--

CREATE TABLE `jos_list` (
  `id` int(11) NOT NULL,
  `status` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(10, 'Cancelled', '2018-10-02 09:54:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_colors`
--

CREATE TABLE `jo_colors` (
  `id` int(11) NOT NULL,
  `color` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_colors`
--

INSERT INTO `jo_colors` (`id`, `color`, `updated_on`, `updated_by`) VALUES
(1, 'Black', '2018-10-02 08:57:03', 1),
(2, 'White', '2018-10-02 08:58:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_copies`
--

CREATE TABLE `jo_copies` (
  `id` int(11) NOT NULL,
  `job_no` int(11) NOT NULL,
  `units` int(11) DEFAULT NULL,
  `copies` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jo_kinds`
--

CREATE TABLE `jo_kinds` (
  `id` int(11) NOT NULL,
  `job_type` int(11) NOT NULL,
  `job_kind` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_kinds`
--

INSERT INTO `jo_kinds` (`id`, `job_type`, `job_kind`, `updated_on`, `updated_by`) VALUES
(1, 1, 'Yearbook', '2018-09-11 19:02:45', 1),
(2, 2, 'Receipt', '2018-10-02 09:16:00', 1),
(3, 3, 'Tabloid', '2018-09-11 19:03:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_materials`
--

CREATE TABLE `jo_materials` (
  `id` int(11) NOT NULL,
  `materials` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_materials`
--

INSERT INTO `jo_materials` (`id`, `materials`, `updated_on`, `updated_by`) VALUES
(1, 'Carbonless White', '2018-10-02 09:33:19', 1),
(2, 'Glossy', '2018-10-02 09:34:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_notifications`
--

CREATE TABLE `jo_notifications` (
  `id` int(11) NOT NULL,
  `job_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `published_on` datetime NOT NULL,
  `status` set('read','unread') NOT NULL DEFAULT 'unread',
  `seen` set('No','Yes') NOT NULL DEFAULT 'No',
  `notify` set('No','Yes') NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jo_payments`
--

CREATE TABLE `jo_payments` (
  `id` int(11) NOT NULL,
  `payment` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_payments`
--

INSERT INTO `jo_payments` (`id`, `payment`, `updated_on`, `updated_by`) VALUES
(1, 'Full', '2018-10-02 09:44:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_printing`
--

CREATE TABLE `jo_printing` (
  `id` int(11) NOT NULL,
  `printing` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_printing`
--

INSERT INTO `jo_printing` (`id`, `printing`, `updated_on`, `updated_by`) VALUES
(1, 'Offset', '2018-10-02 09:48:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_size`
--

CREATE TABLE `jo_size` (
  `id` int(11) NOT NULL,
  `size` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_size`
--

INSERT INTO `jo_size` (`id`, `size`, `updated_on`, `updated_by`) VALUES
(1, '8.5x11', '2018-10-02 09:38:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jo_status`
--

CREATE TABLE `jo_status` (
  `id` int(11) NOT NULL,
  `job_no` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sample` text NOT NULL,
  `correction` text NOT NULL,
  `notes` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jo_type`
--

CREATE TABLE `jo_type` (
  `id` int(11) NOT NULL,
  `job_type` text NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jo_type`
--

INSERT INTO `jo_type` (`id`, `job_type`, `updated_on`, `updated_by`) VALUES
(1, 'Big', '2018-10-04 13:11:19', 1),
(2, 'Small', '2018-09-11 19:02:17', 1),
(3, 'Big Small', '2018-11-09 11:42:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(11) NOT NULL,
  `app_name` text NOT NULL,
  `app_version` text NOT NULL,
  `app_status` set('BETA','OFFICIAL') NOT NULL DEFAULT 'BETA',
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `app_name`, `app_version`, `app_status`, `updated_by`, `updated_on`) VALUES
(1, 'Job Order Management Information System (JOMIS)', 'v2.11.9.2018', 'BETA', 1, '2018-10-11 11:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `system_reports`
--

CREATE TABLE `system_reports` (
  `id` int(11) NOT NULL,
  `report_type` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_by` int(11) NOT NULL,
  `sent_on` datetime NOT NULL,
  `status` set('New','On-Going','Done') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_reports_type`
--

CREATE TABLE `system_reports_type` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_reports_type`
--

INSERT INTO `system_reports_type` (`id`, `type`) VALUES
(1, 'Bugs'),
(2, 'Suggestions');

-- --------------------------------------------------------

--
-- Table structure for table `users_list`
--

CREATE TABLE `users_list` (
  `id` int(11) NOT NULL,
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
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_list`
--

INSERT INTO `users_list` (`id`, `type`, `status`, `username`, `email`, `password`, `firstname`, `middlename`, `lastname`, `birthdate`, `gender`, `picture`, `added_on`) VALUES
(1, 2, 'Active', 'romalepali', 'rolleenao07@gmail.com', '928387fb61f387cc597b41d0e74e43d5', 'Rolly', 'Lee', 'Linao', '1998-02-25', 'Male', 'default', '2018-08-08 08:03:39'),
(2, 6, 'Active', 'agent1234', 'agent1234@gmail.com', '7c6ee78e3283335f9f45b3893bfb082d', 'Agent', 'Gud', 'Ko', '1998-02-25', 'Male', 'default', '2018-11-08 13:17:28'),
(3, 7, 'Active', 'artist1234', 'artist1234@gmail.com', '4c7832b54fd1695930ec5c92f275a447', 'Artist', 'Me', 'Uy', '2018-11-08', 'Female', 'default', '2018-11-08 13:53:13'),
(4, 3, 'Active', 'supervisor1234', 'supervisor1234@gmail.com', '6c90322ecd47d58de1948abf3b3c5fb7', 'Super', 'Di', 'Ko', '2018-11-08', 'Male', 'default', '2018-11-08 13:56:46'),
(5, 4, 'Active', 'orgb1234', 'orgb1234@gmail.com', '443e10a3bf6148a226064c5741fe63b5', 'Organizer', 'Sa', 'Big', '2018-11-08', 'Female', 'default', '2018-11-08 15:47:52'),
(6, 5, 'Active', 'orgs1234', 'orgs1234@gmail.com', 'b16298db961b1267120cf529420a84cf', 'Organizer', 'Sa', 'Small', '2018-11-09', 'Female', 'default', '2018-11-09 08:22:33'),
(7, 1, 'Active', 'limited1234', 'limited1234@gmail.com', 'c4db1172ac3d1054928a722eed727432', 'Lim', 'Ited', 'User', '2018-11-09', 'Male', 'default', '2018-11-09 10:52:18'),
(8, 8, 'Active', 'encoder1234', 'encoder1234@gmail.com', 'ef3cc6bf07b66a7d7eacf7096057004a', 'Encoder', 'Na', 'Jud', '2018-11-09', 'Male', 'default', '2018-11-09 10:53:09'),
(9, 9, 'Active', 'boss1234', 'boss1234@gmail.com', '6b2f07505a200597e339ec0cba8e8230', 'Aym', 'Da', 'Boss', '2018-11-09', 'Female', 'default', '2018-11-09 10:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE `users_type` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(7, 'Artist'),
(8, 'Encoder'),
(9, 'Boss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jo`
--
ALTER TABLE `jo`
  ADD PRIMARY KEY (`job_no`),
  ADD KEY `job_kind` (`job_kind`),
  ADD KEY `agent` (`agent`),
  ADD KEY `artist` (`artist`),
  ADD KEY `cover` (`cover`),
  ADD KEY `color` (`color`),
  ADD KEY `materials` (`materials`),
  ADD KEY `size` (`size`),
  ADD KEY `printing` (`printing`),
  ADD KEY `payment` (`payment`),
  ADD KEY `artist_assigned_by` (`artist_assigned_by`),
  ADD KEY `cover_updated_by` (`cover_updated_by`),
  ADD KEY `encoded_by` (`encoded_by`);

--
-- Indexes for table `joc_units`
--
ALTER TABLE `joc_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jos_list`
--
ALTER TABLE `jos_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jo_colors`
--
ALTER TABLE `jo_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jo_copies`
--
ALTER TABLE `jo_copies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_no` (`job_no`),
  ADD KEY `units` (`units`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `jo_kinds`
--
ALTER TABLE `jo_kinds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_type` (`job_type`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jo_materials`
--
ALTER TABLE `jo_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jo_notifications`
--
ALTER TABLE `jo_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_no` (`job_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jo_payments`
--
ALTER TABLE `jo_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jo_printing`
--
ALTER TABLE `jo_printing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jo_size`
--
ALTER TABLE `jo_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jo_status`
--
ALTER TABLE `jo_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_no` (`job_no`),
  ADD KEY `status` (`status`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `jo_type`
--
ALTER TABLE `jo_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_reports`
--
ALTER TABLE `system_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_type` (`report_type`),
  ADD KEY `sent_by` (`sent_by`);

--
-- Indexes for table `system_reports_type`
--
ALTER TABLE `system_reports_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_list`
--
ALTER TABLE `users_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `users_type`
--
ALTER TABLE `users_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jo`
--
ALTER TABLE `jo`
  MODIFY `job_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `joc_units`
--
ALTER TABLE `joc_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jos_list`
--
ALTER TABLE `jos_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jo_colors`
--
ALTER TABLE `jo_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jo_copies`
--
ALTER TABLE `jo_copies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jo_kinds`
--
ALTER TABLE `jo_kinds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jo_materials`
--
ALTER TABLE `jo_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jo_notifications`
--
ALTER TABLE `jo_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jo_payments`
--
ALTER TABLE `jo_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jo_printing`
--
ALTER TABLE `jo_printing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jo_size`
--
ALTER TABLE `jo_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jo_status`
--
ALTER TABLE `jo_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jo_type`
--
ALTER TABLE `jo_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_reports`
--
ALTER TABLE `system_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_reports_type`
--
ALTER TABLE `system_reports_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_list`
--
ALTER TABLE `users_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_type`
--
ALTER TABLE `users_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `jo_ibfk_12` FOREIGN KEY (`encoded_by`) REFERENCES `users_list` (`id`),
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
-- Constraints for table `jo_notifications`
--
ALTER TABLE `jo_notifications`
  ADD CONSTRAINT `jo_notifications_ibfk_2` FOREIGN KEY (`job_no`) REFERENCES `jo` (`job_no`),
  ADD CONSTRAINT `jo_notifications_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users_list` (`id`);

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
-- Constraints for table `system_reports`
--
ALTER TABLE `system_reports`
  ADD CONSTRAINT `system_reports_ibfk_1` FOREIGN KEY (`report_type`) REFERENCES `system_reports_type` (`id`),
  ADD CONSTRAINT `system_reports_ibfk_2` FOREIGN KEY (`sent_by`) REFERENCES `users_list` (`id`);

--
-- Constraints for table `users_list`
--
ALTER TABLE `users_list`
  ADD CONSTRAINT `users_list_ibfk_1` FOREIGN KEY (`type`) REFERENCES `users_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
