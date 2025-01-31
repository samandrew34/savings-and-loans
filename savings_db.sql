-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 02:06 AM
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
-- Table structure for table `customerdata`
--

CREATE TABLE `customerdata` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `workid` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `othername` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `maritalStatus` varchar(255) NOT NULL,
  `optiontype` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `telno` varchar(255) NOT NULL,
  `idtype` varchar(255) NOT NULL DEFAULT 'GH-CARD',
  `idnumber` varchar(13) NOT NULL,
  `residentialaddress` varchar(255) NOT NULL,
  `businesslocation` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `gurantorrank` varchar(255) NOT NULL,
  `gufirstname` varchar(255) NOT NULL,
  `gusurname` varchar(255) NOT NULL,
  `guothername` varchar(255) NOT NULL,
  `gufullname` varchar(255) NOT NULL,
  `amountapplied` int(255) NOT NULL DEFAULT 0,
  `amountrecomended` int(255) NOT NULL DEFAULT 0,
  `fullamount` int(255) NOT NULL DEFAULT 0,
  `process` varchar(255) NOT NULL DEFAULT 'pending',
  `loanactivity` varchar(255) NOT NULL DEFAULT 'no loan',
  `guidnumber` varchar(255) NOT NULL,
  `guaddress` varchar(255) NOT NULL,
  `customernumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerdata`
--

INSERT INTO `customerdata` (`id`, `userid`, `workid`, `rank`, `email`, `firstname`, `surname`, `othername`, `fullname`, `maritalStatus`, `optiontype`, `gender`, `telno`, `idtype`, `idnumber`, `residentialaddress`, `businesslocation`, `occupation`, `jobtitle`, `gurantorrank`, `gufirstname`, `gusurname`, `guothername`, `gufullname`, `amountapplied`, `amountrecomended`, `fullamount`, `process`, `loanactivity`, `guidnumber`, `guaddress`, `customernumber`) VALUES
(5, 9, 'OKRU-MCR-14964807', '', 'samdoe@gmail.com', 'joshua ansah', 'kus', 'kusah', '', '', '', '', '', 'GH-CARD', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'pending', 'no loan', '', '', ''),
(6, 9, 'OKRU-MCR-14964807', 'MRS', 'does@gmail.com', 'bra john', 'ganja', 'goodas', '', '', '', '', '', 'GH-CARD', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'pending', 'no loan', '', '', ''),
(7, 9, 'OKRU-MCR-14964807', 'MISS', 'andoh@gmail.com', 'andoh appiah', 'andoh', 'none', '', '2', '2', '', '', 'GH-CARD', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'pending', 'no loan', '', '', ''),
(8, 9, 'OKRU-MCR-14964807', 'MRS', 'ad@gmail.com', 'abass musah', 'musah', 'doma', '', '2', '1', '2', '', 'GH-CARD', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 'pending', 'no loan', '', '', ''),
(9, 9, 'OKRU-MCR-14964807', 'MRS', 'sa@gmail.com', 'fgdf', 'fdgg', 'fgdgfd', 'fgdf fgdgfd fdgg', '2', '2', '1', '098778', 'GH-CARD', '098877', 'dfgfdx', 'gffgd', 'gfdgfd', '', 'Mrs', 'gfdgfd', 'gfdgfd', 'gfdfd', 'gfdgfd gfdfd gfdgfd', 0, 0, 0, 'pending', 'no loan', '', '', 'CUS-3332722154'),
(10, 9, 'OKRU-MCR-14964807', 'MR', 'fix@gmail.com', '5454', '4533', '5445', '5454 5445 4533', '1', '1', '1', '54', 'GH-CARD', '544', '4554', '5543', '544', '', 'Mr', '5454', '5443', '543543', '5454 543543 5443', 0, 0, 0, 'pending', 'no loan', '5443433', '', 'CUS-9885568071');

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
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `linkid` int(11) NOT NULL,
  `link_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`linkid`, `link_name`) VALUES
(1, 'dashboard.php'),
(2, 'add_user.php'),
(3, 'view_users.php'),
(4, 'manage_roles.php'),
(5, 'add_client.php'),
(6, 'view_clients.php'),
(7, 'add_loan.php'),
(8, 'view_loans.php'),
(9, 'loan_payments.php'),
(10, 'view_transactions.php'),
(11, 'approve_transactions.php'),
(12, 'audit_trail.php'),
(13, 'loan_reports.php'),
(14, 'payment_reports.php'),
(15, 'yearly_graph.php'),
(16, 'settings.php'),
(17, 'profile.php'),
(18, 'logout.php');

-- --------------------------------------------------------

--
-- Table structure for table `main_deposit`
--

CREATE TABLE `main_deposit` (
  `depositid` int(11) NOT NULL,
  `amount` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_deposit`
--

INSERT INTO `main_deposit` (`depositid`, `amount`) VALUES
(1, '5000000');

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
-- Table structure for table `permissionss`
--

CREATE TABLE `permissionss` (
  `permitid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('super_administrator','administrator','loan_officer','auditor','secretary','data_entry') NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissionss`
--

INSERT INTO `permissionss` (`permitid`, `userid`, `email`, `role`, `menu_head`, `dropdown_item`, `links`, `can_view`, `can_add`, `can_edit`, `can_delete`, `hide_menu`, `hide_dropdown`, `created_at`, `updated_at`) VALUES
(1, 7, 'admin@example.com', 'super_administrator', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(2, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'Add User', 'add_user.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(3, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'View Users', 'view_users.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(4, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'Manage Roles', 'manage_roles.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(5, 7, 'admin@example.com', 'super_administrator', 'Clients & Loans', 'Add Client', 'add_client.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(6, 7, 'admin@example.com', 'super_administrator', 'Clients & Loans', 'View Clients', 'view_clients.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(7, 8, 'adminuser@example.com', 'administrator', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(8, 8, 'adminuser@example.com', 'administrator', 'User Management', 'View Users', 'view_users.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(9, 8, 'adminuser@example.com', 'administrator', 'User Management', 'Manage Roles', 'manage_roles.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(10, 9, 'loanofficer@example.com', 'loan_officer', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(11, 9, 'loanofficer@example.com', 'loan_officer', 'Loan Management', 'Add Loan', 'add_loan.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(12, 9, 'loanofficer@example.com', 'loan_officer', 'Loan Management', 'View Loans', 'view_loans.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(13, 10, 'auditor@example.com', 'auditor', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(14, 10, 'auditor@example.com', 'auditor', 'Auditing', 'View Transactions', 'view_transactions.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(15, 11, 'secretary@example.com', 'secretary', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(16, 11, 'secretary@example.com', 'secretary', 'Clients & Loans', 'Add Client', 'add_client.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(17, 11, 'secretary@example.com', 'secretary', 'Clients & Loans', 'View Clients', 'view_clients.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(18, 12, 'dataentry@example.com', 'data_entry', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(32, 7, 'admin@example.com', 'super_administrator', 'System Settings', 'System Configuration', 'system_config.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:19:11', '2025-01-30 21:19:11'),
(33, 7, 'admin@example.com', 'super_administrator', 'Reports', 'View Reports', 'view_reports.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:19:11', '2025-01-30 21:19:11'),
(34, 7, 'admin@example.com', 'super_administrator', 'System Settings', 'View Logs', 'view_logs.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:19:11', '2025-01-30 21:19:11'),
(35, 7, 'admin@example.com', 'super_administrator', 'User Management', 'Reset Password', 'reset_password.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:19:11', '2025-01-30 21:19:11'),
(36, 7, 'admin@example.com', 'super_administrator', 'Permissions', 'Manage Permissions', 'manage_permissions.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:19:11', '2025-01-30 21:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

CREATE TABLE `permit` (
  `permissionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('super_administrator','administrator','loan_officer','auditor','secretary','data_entry') NOT NULL,
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
-- Dumping data for table `permit`
--

INSERT INTO `permit` (`permissionid`, `userid`, `email`, `role`, `menu_head`, `dropdown_item`, `links`, `can_view`, `can_add`, `can_edit`, `can_delete`, `hide_menu`, `hide_dropdown`, `created_at`, `updated_at`, `visible_to_user_ids`, `visible_to_all`, `visible_to_one`, `show_to_specific_ids`) VALUES
(1, 7, 'admin@example.com', 'super_administrator', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 0, 0, 0, '2025-01-30 17:39:10', '2025-01-30 18:39:41', NULL, 0, NULL, NULL),
(2, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'Add User', 'add_user.php', 1, 0, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 22:52:40', NULL, 0, NULL, NULL),
(3, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'View Users', 'view_users.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(4, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'Manage Roles', 'manage_roles.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(5, 7, 'admin@example.com', 'super_administrator', 'Clients & Loans', 'Add Client', 'add_client.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(6, 7, 'admin@example.com', 'super_administrator', 'Clients & Loans', 'View Clients', 'view_clients.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(7, 8, 'adminuser@example.com', 'administrator', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(8, 8, 'adminuser@example.com', 'administrator', 'User Management', 'View Users', 'view_users.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(9, 8, 'adminuser@example.com', 'administrator', 'User Management', 'Manage Roles', 'manage_roles.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(10, 9, 'loanofficer@example.com', 'loan_officer', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(11, 9, 'loanofficer@example.com', 'loan_officer', 'Loan Management', 'Add Loan', 'add_loan.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(12, 9, 'loanofficer@example.com', 'loan_officer', 'Loan Management', 'View Loans', 'view_loans.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(13, 10, 'auditor@example.com', 'auditor', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(14, 10, 'auditor@example.com', 'auditor', 'Auditing', 'View Transactions', 'view_transactions.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(15, 11, 'secretary@example.com', 'secretary', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(16, 11, 'secretary@example.com', 'secretary', 'Clients & Loans', 'Add Client', 'add_client.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(17, 11, 'secretary@example.com', 'secretary', 'Clients & Loans', 'View Clients', 'view_clients.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(18, 12, 'dataentry@example.com', 'data_entry', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL),
(32, 7, 'admin@example.com', 'super_administrator', 'System Settings', 'System Configuration', 'system_config.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL),
(33, 7, 'admin@example.com', 'super_administrator', 'Reports', 'View Reports', 'view_reports.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL),
(34, 7, 'admin@example.com', 'super_administrator', 'System Settings', 'View Logs', 'view_logs.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL),
(35, 7, 'admin@example.com', 'super_administrator', 'User Management', 'Reset Password', 'reset_password.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL),
(36, 7, 'admin@example.com', 'super_administrator', 'Permissions', 'Manage Permissions', 'manage_permissions.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleid` int(11) NOT NULL,
  `role_name` enum('super_administrator','administrator','loan_officer','auditor','secretary','data_entry') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `role_name`) VALUES
(1, 'super_administrator'),
(2, 'administrator'),
(3, 'loan_officer'),
(4, 'auditor'),
(5, 'secretary'),
(6, 'data_entry');

-- --------------------------------------------------------

--
-- Table structure for table `test_user`
--

CREATE TABLE `test_user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_user`
--

INSERT INTO `test_user` (`id`, `full_name`, `email`, `location`) VALUES
(1, 'john seglah', 'johnnnnnn@gmail.com', 'gemany'),
(2, 'john seglah', 'johnnnnnn@gmail.com', 'gemany'),
(3, 'john seglah', 'johngreat24@gmail.com', 'gemany');

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
  `role` enum('super administrator','administrator','loan_officer','auditor','secretary','data_entry') NOT NULL,
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
(4, 'Data Entry User', '@dataentry', 'dataentry@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'data_entry', 'active', '2025-01-27 23:24:39', '2025-01-27 23:43:42'),
(5, 'john doe', '@superadmin', 'super@gmail.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'super administrator', 'active', '2025-01-29 17:52:16', '2025-01-29 17:52:27'),
(6, 'harriet mawusi', '@harriet', 'harry@gmail.com', '12345', 'secretary', 'active', '2025-01-29 17:55:57', '2025-01-29 17:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `userid` int(11) NOT NULL,
  `workid` varchar(20) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_administrator','administrator','loan_officer','auditor','secretary','data_entry') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`userid`, `workid`, `fullname`, `username`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(7, 'OKRU-1234567890', 'Super Admin', 'superadmin', 'admin@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'super_administrator', 'active', '2025-01-29 18:49:39', '2025-01-29 18:50:25'),
(8, 'OKRU-2345678901', 'John Doe', 'adminuser', 'adminuser@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'administrator', 'active', '2025-01-29 18:49:39', '2025-01-29 18:50:30'),
(9, 'OKRU-3456789012', 'Jane Smith', 'loanofficer', 'loanofficer@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'loan_officer', 'active', '2025-01-29 18:49:39', '2025-01-29 18:50:33'),
(10, 'OKRU-4567890123', 'Alex Brown', 'auditor', 'auditor@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'auditor', 'active', '2025-01-29 18:49:39', '2025-01-29 18:50:37'),
(11, 'OKRU-5678901234', 'Sarah Lee', 'secretary', 'secretary@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'secretary', 'active', '2025-01-29 18:49:39', '2025-01-29 18:50:40'),
(12, 'OKRU-6789012345', 'David Clark', 'dataentry', 'dataentry@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'data_entry', 'active', '2025-01-29 18:49:39', '2025-01-29 18:50:44');

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
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`linkid`);

--
-- Indexes for table `main_deposit`
--
ALTER TABLE `main_deposit`
  ADD PRIMARY KEY (`depositid`);

--
-- Indexes for table `menu_heads`
--
ALTER TABLE `menu_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissionss`
--
ALTER TABLE `permissionss`
  ADD PRIMARY KEY (`permitid`),
  ADD KEY `fk_permit_userid` (`userid`),
  ADD KEY `fk_permit_email` (`email`);

--
-- Indexes for table `permit`
--
ALTER TABLE `permit`
  ADD PRIMARY KEY (`permissionid`),
  ADD KEY `fk_permissions_userid` (`userid`),
  ADD KEY `fk_permissions_email` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleid`);

--
-- Indexes for table `test_user`
--
ALTER TABLE `test_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `workid` (`workid`),
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
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `linkid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `main_deposit`
--
ALTER TABLE `main_deposit`
  MODIFY `depositid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_heads`
--
ALTER TABLE `menu_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissionss`
--
ALTER TABLE `permissionss`
  MODIFY `permitid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `permit`
--
ALTER TABLE `permit`
  MODIFY `permissionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test_user`
--
ALTER TABLE `test_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dropdown_menus`
--
ALTER TABLE `dropdown_menus`
  ADD CONSTRAINT `dropdown_menus_ibfk_1` FOREIGN KEY (`menu_head_id`) REFERENCES `menu_heads` (`id`);

--
-- Constraints for table `permissionss`
--
ALTER TABLE `permissionss`
  ADD CONSTRAINT `fk_permit_email` FOREIGN KEY (`email`) REFERENCES `users_tbl` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_permit_userid` FOREIGN KEY (`userid`) REFERENCES `users_tbl` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `permit`
--
ALTER TABLE `permit`
  ADD CONSTRAINT `fk_permissions_email` FOREIGN KEY (`email`) REFERENCES `users_tbl` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_permissions_userid` FOREIGN KEY (`userid`) REFERENCES `users_tbl` (`userid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
