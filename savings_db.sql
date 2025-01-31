-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 12:58 AM
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
-- Database: `savings_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dropdown_menus`
--

CREATE TABLE `dropdown_menus` (
  `id` int(11) NOT NULL,
  `menu_head_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dropdown_menus`
--

INSERT INTO `dropdown_menus` (`id`, `menu_head_id`, `name`, `is_active`) VALUES
(1, 2, 'Add New Client', 1),
(2, 2, 'View Clients', 1),
(3, 2, 'Update Client Info', 1),
(4, 3, 'Create New Loan', 1),
(5, 3, 'Manage Loans', 1),
(6, 3, 'Loan Repayment History', 1),
(7, 5, 'Transaction History', 1),
(8, 5, 'Account Balance', 1),
(9, 6, 'Loan Statistics', 1),
(10, 6, 'Payment Trends', 1),
(11, 7, 'Add New Employee', 1),
(12, 7, 'Manage Employees', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_heads`
--

CREATE TABLE `menu_heads` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_heads`
--

INSERT INTO `menu_heads` (`id`, `name`, `is_active`) VALUES
(1, 'Dashboard', 1),
(2, 'Clients', 1),
(3, 'Loans', 1),
(4, 'Payments', 1),
(5, 'Transactions', 1),
(6, 'Analytics', 1),
(7, 'User Management', 1),
(8, 'Settings', 1),
(9, 'Notifications', 1),
(10, 'Help', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permissionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `role` enum('administrator','loan_officer','auditor','data_entry') NOT NULL,
  `menu_head` varchar(255) NOT NULL,
  `dropdown_item` varchar(255) NOT NULL,
  `links` varchar(255) DEFAULT NULL,
  `can_view` tinyint(1) DEFAULT 0,
  `can_add` tinyint(1) DEFAULT 0,
  `can_edit` tinyint(1) DEFAULT 0,
  `can_delete` tinyint(1) DEFAULT 0,
  `hide_menu` tinyint(1) DEFAULT 0,
  `hide_dropdown` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visible_to_user_ids` text DEFAULT NULL,
  `visible_to_all` tinyint(1) DEFAULT 0,
  `visible_to_one` int(11) DEFAULT NULL,
  `show_to_specific_ids` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permissionid`, `userid`, `role`, `menu_head`, `dropdown_item`, `links`, `can_view`, `can_add`, `can_edit`, `can_delete`, `hide_menu`, `hide_dropdown`, `created_at`, `updated_at`, `visible_to_user_ids`, `visible_to_all`, `visible_to_one`, `show_to_specific_ids`) VALUES
(1, 1, 'administrator', 'Dashboard', 'Overview', 'test.php', 1, 0, 0, 0, 0, 0, '2025-01-28 00:14:28', '2025-01-28 23:37:05', '2,3,4', 0, 0, NULL),
(2, 1, 'administrator', 'Users', 'Manage Users', 'users.php', 1, 1, 1, 1, 0, 0, '2025-01-28 00:14:28', '2025-01-28 22:46:10', NULL, 0, 0, NULL),
(3, 1, 'administrator', 'Loans', 'Loan Applications', 'loan.php', 1, 1, 0, 0, 0, 0, '2025-01-28 00:14:28', '2025-01-28 22:45:20', '3,4', 0, 0, NULL),
(4, 1, 'administrator', 'Reports', 'View Reports', 'report.php', 1, 0, 0, 0, 0, 0, '2025-01-28 00:14:28', '2025-01-28 22:45:11', NULL, 0, 0, NULL),
(5, 3, 'administrator', 'Audits', 'Audit Logs', NULL, 1, 0, 0, 0, 0, 0, '2025-01-28 00:14:28', '2025-01-28 01:17:05', NULL, 0, 0, NULL),
(6, 3, 'administrator', 'Settings', 'System Settings', NULL, 1, 0, 0, 0, 0, 1, '2025-01-28 00:14:28', '2025-01-28 01:17:09', NULL, 0, 0, NULL),
(7, 2, 'loan_officer', 'Loans', 'Loan Applications', 'loan.php', 0, 0, 0, 0, 0, 0, '2025-01-28 23:34:39', '2025-01-28 23:36:42', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('administrator','loan_officer','auditor','data_entry') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fullname`, `username`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', '@admin', 'admin@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'administrator', 'active', '2025-01-27 23:24:39', '2025-01-27 23:43:30'),
(2, 'Loan Officer User', '@loanofficer', 'loanofficer@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'loan_officer', 'active', '2025-01-27 23:24:39', '2025-01-27 23:43:35'),
(3, 'Auditor User', '@auditor', 'auditor@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'auditor', 'active', '2025-01-27 23:24:39', '2025-01-27 23:43:39'),
(4, 'Data Entry User', '@dataentry', 'dataentry@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'data_entry', 'active', '2025-01-27 23:24:39', '2025-01-27 23:43:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dropdown_menus`
--
ALTER TABLE `dropdown_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_head_id` (`menu_head_id`);

--
-- Indexes for table `menu_heads`
--
ALTER TABLE `menu_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissionid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dropdown_menus`
--
ALTER TABLE `dropdown_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu_heads`
--
ALTER TABLE `menu_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permissionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dropdown_menus`
--
ALTER TABLE `dropdown_menus`
  ADD CONSTRAINT `dropdown_menus_ibfk_1` FOREIGN KEY (`menu_head_id`) REFERENCES `menu_heads` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
