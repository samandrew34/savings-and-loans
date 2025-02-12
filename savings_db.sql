-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 12:08 AM
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
-- Table structure for table `buttonss_tbl`
--

CREATE TABLE `buttonss_tbl` (
  `id` int(11) NOT NULL,
  `buttonnames` text NOT NULL,
  `activeids` text NOT NULL,
  `inactiveids` text NOT NULL,
  `customerid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buttonss_tbl`
--

INSERT INTO `buttonss_tbl` (`id`, `buttonnames`, `activeids`, `inactiveids`, `customerid`, `status`) VALUES
(1, 'Add Button', '1,2,3', '4,5,6', 1, 1),
(2, 'Add Button', '1,2,3', '4,5,6', 2, 1),
(3, 'Add Button', '1,2,3', '4,5,6', 3, 1),
(4, 'Add Button', '1,2,3', '4,5,6', 4, 1),
(5, 'Add Button', '1,2,3', '4,5,6', 5, 1),
(6, 'Add Button', '1,2,3', '4,5,6', 6, 1),
(7, 'Add Button', '1,2,3', '4,5,6', 7, 1),
(8, 'Add Button', '1,2,3', '4,5,6', 8, 1),
(9, 'Add Button', '1,2,3', '4,5,6', 9, 1),
(10, 'Add Button', '1,2,3', '4,5,6', 10, 1),
(11, 'Add Button', '1,2,3', '4,5,6', 11, 1),
(12, 'Add Button', '1,2,3', '4,5,6', 12, 1),
(13, 'Add Button', '1,2,3', '4,5,6', 13, 1),
(14, 'View Button', '19,20,21', '22,23,24', 1, 1),
(15, 'View Button', '19,20,21', '22,23,24', 2, 1),
(16, 'View Button', '19,20,21', '22,23,24', 3, 1),
(17, 'View Button', '19,20,21', '22,23,24', 4, 1),
(18, 'View Button', '19,20,21', '22,23,24', 5, 1),
(19, 'View Button', '19,20,21', '22,23,24', 6, 1),
(20, 'View Button', '19,20,21', '22,23,24', 7, 1),
(21, 'View Button', '19,20,21', '22,23,24', 8, 1),
(22, 'View Button', '19,20,21', '22,23,24', 9, 1),
(23, 'View Button', '19,20,21', '22,23,24', 10, 1),
(24, 'View Button', '19,20,21', '22,23,24', 11, 1),
(25, 'View Button', '19,20,21', '22,23,24', 12, 1),
(26, 'View Button', '19,20,21', '22,23,24', 13, 1),
(27, 'Delete Button', '13,14,15', '16,17,18', 1, 1),
(28, 'Delete Button', '13,14,15', '16,17,18', 2, 1),
(29, 'Delete Button', '13,14,15', '16,17,18', 3, 1),
(30, 'Delete Button', '13,14,15', '16,17,18', 4, 1),
(31, 'Delete Button', '13,14,15', '16,17,18', 5, 1),
(32, 'Delete Button', '13,14,15', '16,17,18', 6, 1),
(33, 'Delete Button', '13,14,15', '16,17,18', 7, 1),
(34, 'Delete Button', '13,14,15', '16,17,18', 8, 1),
(35, 'Delete Button', '13,14,15', '16,17,18', 9, 1),
(36, 'Delete Button', '13,14,15', '16,17,18', 10, 1),
(37, 'Delete Button', '13,14,15', '16,17,18', 11, 1),
(38, 'Delete Button', '13,14,15', '16,17,18', 12, 1),
(39, 'Delete Button', '13,14,15', '16,17,18', 13, 1),
(40, 'Submit Button', '25,26,27', '28,29,30', 1, 1),
(41, 'Submit Button', '25,26,27', '28,29,30', 2, 1),
(42, 'Submit Button', '25,26,27', '28,29,30', 3, 1),
(43, 'Submit Button', '25,26,27', '28,29,30', 4, 1),
(44, 'Submit Button', '25,26,27', '28,29,30', 5, 1),
(45, 'Submit Button', '25,26,27', '28,29,30', 6, 1),
(46, 'Submit Button', '25,26,27', '28,29,30', 7, 1),
(47, 'Submit Button', '25,26,27', '28,29,30', 8, 1),
(48, 'Submit Button', '25,26,27', '28,29,30', 9, 1),
(49, 'Submit Button', '25,26,27', '28,29,30', 10, 1),
(50, 'Submit Button', '25,26,27', '28,29,30', 11, 1),
(51, 'Submit Button', '25,26,27', '28,29,30', 12, 1),
(52, 'Submit Button', '25,26,27', '28,29,30', 13, 1),
(53, 'Approve Button', '31,32,33', '34,35,36', 1, 1),
(54, 'Approve Button', '31,32,33', '34,35,36', 2, 1),
(55, 'Approve Button', '31,32,33', '34,35,36', 3, 1),
(56, 'Approve Button', '31,32,33', '34,35,36', 4, 1),
(57, 'Approve Button', '31,32,33', '34,35,36', 5, 1),
(58, 'Approve Button', '31,32,33', '34,35,36', 6, 1),
(59, 'Approve Button', '31,32,33', '34,35,36', 7, 1),
(60, 'Approve Button', '31,32,33', '34,35,36', 8, 1),
(61, 'Approve Button', '31,32,33', '34,35,36', 9, 1),
(62, 'Approve Button', '31,32,33', '34,35,36', 10, 1),
(63, 'Approve Button', '31,32,33', '34,35,36', 11, 1),
(64, 'Approve Button', '31,32,33', '34,35,36', 12, 1),
(65, 'Approve Button', '31,32,33', '34,35,36', 13, 1),
(66, 'Reject Button', '37,38,39', '40,41,42', 1, 1),
(67, 'Reject Button', '37,38,39', '40,41,42', 2, 1),
(68, 'Reject Button', '37,38,39', '40,41,42', 3, 1),
(69, 'Reject Button', '37,38,39', '40,41,42', 4, 1),
(70, 'Reject Button', '37,38,39', '40,41,42', 5, 1),
(71, 'Reject Button', '37,38,39', '40,41,42', 6, 1),
(72, 'Reject Button', '37,38,39', '40,41,42', 7, 1),
(73, 'Reject Button', '37,38,39', '40,41,42', 8, 1),
(74, 'Reject Button', '37,38,39', '40,41,42', 9, 1),
(75, 'Reject Button', '37,38,39', '40,41,42', 10, 1),
(76, 'Reject Button', '37,38,39', '40,41,42', 11, 1),
(77, 'Reject Button', '37,38,39', '40,41,42', 12, 1),
(78, 'Reject Button', '37,38,39', '40,41,42', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `buttons_tbl`
--

CREATE TABLE `buttons_tbl` (
  `id` int(11) NOT NULL,
  `buttonnames` text NOT NULL,
  `activeids` text NOT NULL,
  `inactiveids` text NOT NULL,
  `customerid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buttons_tbl`
--

INSERT INTO `buttons_tbl` (`id`, `buttonnames`, `activeids`, `inactiveids`, `customerid`, `status`) VALUES
(1, 'Add Button', '1,2,3', '4,5,6', 1, 1),
(2, 'Add Button', '1,2,3', '4,5,6', 2, 1),
(3, 'Add Button', '1,2,3', '4,5,6', 3, 1),
(4, 'Add Button', '1,2,3', '4,5,6', 4, 1),
(5, 'Add Button', '1,2,3', '4,5,6', 5, 1),
(6, 'Add Button', '1,2,3', '4,5,6', 6, 1),
(7, 'Add Button', '1,2,3', '4,5,6', 7, 1),
(8, 'Add Button', '1,2,3', '4,5,6', 8, 1),
(9, 'Add Button', '1,2,3', '4,5,6', 9, 1),
(10, 'Add Button', '1,2,3', '4,5,6', 10, 1),
(11, 'Add Button', '1,2,3', '4,5,6', 11, 1),
(12, 'Add Button', '1,2,3', '4,5,6', 12, 1),
(13, 'Add Button', '1,2,3', '4,5,6', 13, 1),
(14, 'View Button', '19,20,21', '22,23,24', 1, 1),
(15, 'View Button', '19,20,21', '22,23,24', 2, 1),
(16, 'View Button', '19,20,21', '22,23,24', 3, 1),
(17, 'View Button', '19,20,21', '22,23,24', 4, 1),
(18, 'View Button', '19,20,21', '22,23,24', 5, 1),
(19, 'View Button', '19,20,21', '22,23,24', 6, 1),
(20, 'View Button', '19,20,21', '22,23,24', 7, 1),
(21, 'View Button', '19,20,21', '22,23,24', 8, 1),
(22, 'View Button', '19,20,21', '22,23,24', 9, 1),
(23, 'View Button', '19,20,21', '22,23,24', 10, 1),
(24, 'View Button', '19,20,21', '22,23,24', 11, 1),
(25, 'View Button', '19,20,21', '22,23,24', 12, 1),
(26, 'View Button', '19,20,21', '22,23,24', 13, 1),
(27, 'Delete Button', '13,14,15', '16,17,18', 1, 1),
(28, 'Delete Button', '13,14,15', '16,17,18', 2, 1),
(29, 'Delete Button', '13,14,15', '16,17,18', 3, 1),
(30, 'Delete Button', '13,14,15', '16,17,18', 4, 1),
(31, 'Delete Button', '13,14,15', '16,17,18', 5, 1),
(32, 'Delete Button', '13,14,15', '16,17,18', 6, 1),
(33, 'Delete Button', '13,14,15', '16,17,18', 7, 1),
(34, 'Delete Button', '13,14,15', '16,17,18', 8, 1),
(35, 'Delete Button', '13,14,15', '16,17,18', 9, 1),
(36, 'Delete Button', '13,14,15', '16,17,18', 10, 1),
(37, 'Delete Button', '13,14,15', '16,17,18', 11, 1),
(38, 'Delete Button', '13,14,15', '16,17,18', 12, 1),
(39, 'Delete Button', '13,14,15', '16,17,18', 13, 1),
(40, 'Submit Button', '25,26,27', '28,29,30', 1, 1),
(41, 'Submit Button', '25,26,27', '28,29,30', 2, 1),
(42, 'Submit Button', '25,26,27', '28,29,30', 3, 1),
(43, 'Submit Button', '25,26,27', '28,29,30', 4, 1),
(44, 'Submit Button', '25,26,27', '28,29,30', 5, 1),
(45, 'Submit Button', '25,26,27', '28,29,30', 6, 1),
(46, 'Submit Button', '25,26,27', '28,29,30', 7, 1),
(47, 'Submit Button', '25,26,27', '28,29,30', 8, 1),
(48, 'Submit Button', '25,26,27', '28,29,30', 9, 1),
(49, 'Submit Button', '25,26,27', '28,29,30', 10, 1),
(50, 'Submit Button', '25,26,27', '28,29,30', 11, 1),
(51, 'Submit Button', '25,26,27', '28,29,30', 12, 1),
(52, 'Submit Button', '25,26,27', '28,29,30', 13, 1),
(53, 'Approve Button', '31,32,33', '34,35,36', 1, 1),
(54, 'Approve Button', '31,32,33', '34,35,36', 2, 1),
(55, 'Approve Button', '31,32,33', '34,35,36', 3, 1),
(56, 'Approve Button', '31,32,33', '34,35,36', 4, 1),
(57, 'Approve Button', '31,32,33', '34,35,36', 5, 1),
(58, 'Approve Button', '31,32,33', '34,35,36', 6, 1),
(59, 'Approve Button', '31,32,33', '34,35,36', 7, 1),
(60, 'Approve Button', '31,32,33', '34,35,36', 8, 1),
(61, 'Approve Button', '31,32,33', '34,35,36', 9, 1),
(62, 'Approve Button', '31,32,33', '34,35,36', 10, 1),
(63, 'Approve Button', '31,32,33', '34,35,36', 11, 1),
(64, 'Approve Button', '31,32,33', '34,35,36', 12, 1),
(65, 'Approve Button', '31,32,33', '34,35,36', 13, 1),
(66, 'Reject Button', '37,38,39', '40,41,42', 1, 1),
(67, 'Reject Button', '37,38,39', '40,41,42', 2, 1),
(68, 'Reject Button', '37,38,39', '40,41,42', 3, 1),
(69, 'Reject Button', '37,38,39', '40,41,42', 4, 1),
(70, 'Reject Button', '37,38,39', '40,41,42', 5, 1),
(71, 'Reject Button', '37,38,39', '40,41,42', 6, 1),
(72, 'Reject Button', '37,38,39', '40,41,42', 7, 1),
(73, 'Reject Button', '37,38,39', '40,41,42', 8, 1),
(74, 'Reject Button', '37,38,39', '40,41,42', 9, 1),
(75, 'Reject Button', '37,38,39', '40,41,42', 10, 1),
(76, 'Reject Button', '37,38,39', '40,41,42', 11, 1),
(77, 'Reject Button', '37,38,39', '40,41,42', 12, 1),
(78, 'Reject Button', '37,38,39', '40,41,42', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customerdata`
--

CREATE TABLE `customerdata` (
  `customerid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `workid` varchar(50) DEFAULT NULL,
  `rank` enum('MR','MRS','MISS') NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `othername` varchar(100) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `maritalStatus` enum('married','single') NOT NULL,
  `options` enum('loans','savings','both') NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `connumber` varchar(10) NOT NULL,
  `idnumber` varchar(14) NOT NULL,
  `idtype` varchar(7) NOT NULL DEFAULT 'GH-CARD',
  `email` varchar(100) NOT NULL,
  `customeremail` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `gurantorrank` varchar(255) NOT NULL,
  `gufirstname` varchar(255) NOT NULL,
  `guothername` varchar(255) NOT NULL,
  `gusurname` varchar(255) NOT NULL,
  `guidnumber` varchar(255) NOT NULL,
  `guaddress` varchar(255) NOT NULL,
  `gucontact` varchar(255) NOT NULL,
  `verification` int(10) NOT NULL DEFAULT 0,
  `amountapplied` int(255) NOT NULL DEFAULT 100,
  `amountrecomended` int(255) NOT NULL DEFAULT 0,
  `fullamount` int(255) NOT NULL DEFAULT 0,
  `customerimage` varchar(255) NOT NULL,
  `customernumber` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerdata`
--

INSERT INTO `customerdata` (`customerid`, `userid`, `workid`, `rank`, `firstname`, `surname`, `othername`, `fullname`, `maritalStatus`, `options`, `gender`, `connumber`, `idnumber`, `idtype`, `email`, `customeremail`, `location`, `gurantorrank`, `gufirstname`, `guothername`, `gusurname`, `guidnumber`, `guaddress`, `gucontact`, `verification`, `amountapplied`, `amountrecomended`, `fullamount`, `customerimage`, `customernumber`, `created_at`) VALUES
(1, 7, 'OKRU-1234567890', 'MRS', 'fdfds', 'gfggf', 'fggf', '', 'married', 'savings', 'female', '0', '', 'GH-CARD', 'johnnnnnn@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 1, 0, 0, 0, 'cus.jpg', '', '2025-02-01 00:44:24'),
(2, 7, 'OKRU-1234567890', 'MRS', 'booss', 'ama', 'boom', '', 'married', 'savings', 'female', '0', '', 'GH-CARD', 'john@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 'cus.jpg', '', '2025-01-31 21:51:59'),
(3, 7, 'OKRU-1234567890', 'MRS', 'banda', 'sanfo', 'bus', '', 'single', 'savings', 'female', '542642209', '', 'GH-CARD', 'sam@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 'cus.jpg', '', '2025-02-01 09:41:10'),
(4, 7, 'OKRU-1234567890', 'MR', 'sarah', 'brond', 'jom', '', 'married', 'loans', 'male', '123456789', '1234567890', 'GH-CARD', 'ha@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 'cus.jpg', '', '2025-02-01 14:47:55'),
(5, 7, 'OKRU-1234567890', 'MR', 'mass', 'dus', 'bas', 'mass bas dus', 'married', 'loans', 'male', '12345678', '12345678909', 'GH-CARD', 'm@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 'cus.jpg', '', '2025-02-01 14:58:01'),
(6, 7, 'OKRU-1234567890', 'MR', 'hgo', 'min', 'jib', 'hgo jib min', 'married', 'loans', 'male', '5467890', '76590', 'GH-CARD', 'f@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 'cus.jpg', 'OKRU-CUS-7086254486', '2025-02-01 15:03:50'),
(7, 7, 'OKRU-1234567890', 'MR', 'mm', 'vb', 'hb', 'mm hb vb', 'married', 'loans', 'male', '123456789', '1234567', 'GH-CARD', 'vc@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 'cus.jpg', 'OKRU-CUS-4412709033', '2025-02-01 15:21:37'),
(8, 7, 'OKRU-1234567890', 'MRS', 'gfjhsgfdhjfds', 'hsgfhkgsf', 'sahgjjhgas', 'gfjhsgfdhjfds sahgjjhgas hsgfhkgsf', 'married', 'loans', 'male', '4432543', '6732546732', 'GH-CARD', 'admin@example.com', 'admin@example.com', '', 'MRS', 'hjgfsghjfs', '', '', '', '', '', 0, 0, 0, 0, 'cus.jpg', 'OKRU-CUS-1782105439', '2025-02-02 18:19:14'),
(9, 7, 'OKRU-1234567890', 'MRS', 'fdfds', 'gfggf', 'cxv', '', 'married', 'savings', 'female', '', '', 'GH-CARD', 'nnnnn@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 100, 0, 0, 'cus.jpg', '', '2025-02-03 18:26:56'),
(10, 7, 'OKRU-1234567890', 'MRS', 'fdd', 'dfds', 'fdfd', '', 'single', 'savings', 'female', '', '', 'GH-CARD', 'mnnnnat@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 100, 0, 0, 'cus.jpg', 'OKRU-CUS-7925409389', '2025-02-03 18:41:29'),
(11, 7, 'OKRU-1234567890', 'MRS', 'dfds', 'fdsfds', 'fdsfds', 'dfds fdsfds fdsfds', 'single', 'savings', 'female', '234214', '432343', 'GH-CARD', 'mmmmat@gmail.com', 'admin@example.com', '', '', '', '', '', '', '', '', 0, 100, 0, 0, 'cus.jpg', 'OKRU-CUS-9741063422', '2025-02-03 19:08:21'),
(12, 7, 'OKRU-1234567890', 'MRS', 'ffgrfd', 'gfdfg', 'gfgf', 'ffgrfd gfgf gfdfg', 'single', 'savings', 'female', '2321', '3223', 'GH-CARD', 'l@gmail.com', 'admin@example.com', 'kumasi', '', '', '', '', '', '', '', 0, 100, 0, 0, 'cus.jpg', 'OKRU-CUS-7591668061', '2025-02-03 21:54:25'),
(13, 7, 'OKRU-1234567890', 'MRS', 'gfhgh', 'hghg', 'hggh', 'gfhgh hggh hghg', 'single', 'savings', 'female', '6546', '655656', 'GH-CARD', 'cxzas@gmail.com', 'admin@example.com', 'Soroda', '', '', '', '', '', '', '', 0, 100, 0, 0, 'cus.jpg', 'OKRU-CUS-2146891909', '2025-02-03 23:06:37');

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
  `visible_to_user_ids` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissionss`
--

INSERT INTO `permissionss` (`permitid`, `userid`, `email`, `role`, `menu_head`, `dropdown_item`, `links`, `can_view`, `can_add`, `can_edit`, `can_delete`, `hide_menu`, `hide_dropdown`, `visible_to_user_ids`, `created_at`, `updated_at`) VALUES
(1, 7, 'admin@example.com', 'super_administrator', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(2, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'Add User', 'add_user.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(3, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'View Users', 'view_users.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(4, 7, 'admin@example.com', 'super_administrator', 'Users Management', 'Manage Roles', 'manage_roles.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(5, 7, 'admin@example.com', 'super_administrator', 'Clients & Loans', 'Add Client', 'add_client.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(6, 7, 'admin@example.com', 'super_administrator', 'Clients & Loans', 'View Clients', 'view_clients.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(7, 8, 'adminuser@example.com', 'administrator', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(8, 8, 'adminuser@example.com', 'administrator', 'User Management', 'View Users', 'view_users.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(9, 8, 'adminuser@example.com', 'administrator', 'User Management', 'Manage Roles', 'manage_roles.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(10, 9, 'loanofficer@example.com', 'loan_officer', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(11, 9, 'loanofficer@example.com', 'loan_officer', 'Loan Management', 'Add Loan', 'add_loan.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(12, 9, 'loanofficer@example.com', 'loan_officer', 'Loan Management', 'View Loans', 'view_loans.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(13, 10, 'auditor@example.com', 'auditor', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(14, 10, 'auditor@example.com', 'auditor', 'Auditing', 'View Transactions', 'view_transactions.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(15, 11, 'secretary@example.com', 'secretary', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(16, 11, 'secretary@example.com', 'secretary', 'Clients & Loans', 'Add Client', 'add_client.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(17, 11, 'secretary@example.com', 'secretary', 'Clients & Loans', 'View Clients', 'view_clients.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(18, 12, 'dataentry@example.com', 'data_entry', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 20:08:06', '2025-01-30 20:08:06'),
(32, 7, 'admin@example.com', 'super_administrator', 'System Settings', 'System Configuration', 'system_config.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 21:19:11', '2025-01-30 21:19:11'),
(33, 7, 'admin@example.com', 'super_administrator', 'Reports', 'View Reports', 'view_reports.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 21:19:11', '2025-01-30 21:19:11'),
(34, 7, 'admin@example.com', 'super_administrator', 'System Settings', 'View Logs', 'view_logs.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 21:19:11', '2025-01-30 21:19:11'),
(35, 7, 'admin@example.com', 'super_administrator', 'User Management', 'Reset Password', 'reset_password.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 21:19:11', '2025-01-30 21:19:11'),
(36, 7, 'admin@example.com', 'super_administrator', 'Permissions', 'Manage Permissions', 'manage_permissions.php', 1, 1, 1, 1, 0, 0, '', '2025-01-30 21:19:11', '2025-01-30 21:19:11');

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
  `show_to_specific_ids` text DEFAULT NULL,
  `hide_add` text DEFAULT NULL,
  `hide_edit` text DEFAULT NULL,
  `hide_delete` text DEFAULT NULL,
  `hide_view` text DEFAULT NULL,
  `hide_fetch` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permit`
--

INSERT INTO `permit` (`permissionid`, `userid`, `email`, `role`, `menu_head`, `dropdown_item`, `links`, `can_view`, `can_add`, `can_edit`, `can_delete`, `hide_menu`, `hide_dropdown`, `created_at`, `updated_at`, `visible_to_user_ids`, `visible_to_all`, `visible_to_one`, `show_to_specific_ids`, `hide_add`, `hide_edit`, `hide_delete`, `hide_view`, `hide_fetch`) VALUES
(1, 7, 'admin@example.com', 'super_administrator', 'Dashboard', 'Overview', 'dashboard.php', 1, 1, 1, 0, 0, 0, '2025-01-30 17:39:10', '2025-01-31 21:29:58', '7', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 7, 'admin@example.com', 'super_administrator', 'Customer Management', 'Add User', 'usermanagement/add_user.php', 1, 0, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-02-04 19:56:32', NULL, 0, NULL, NULL, '8', NULL, NULL, NULL, NULL),
(3, 7, 'admin@example.com', 'super_administrator', 'Customer Management', 'View Users', 'usermanagement/view_users.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-02-04 19:56:40', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 7, 'admin@example.com', 'super_administrator', 'Customer Management', 'Manage Roles', 'usermanagement/manage_roles.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-02-04 19:56:45', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 7, 'admin@example.com', 'super_administrator', 'Clients & Loans', 'Add Client', 'add_client.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 7, 'admin@example.com', 'super_administrator', 'Clients & Loans', 'View Clients', 'view_clients.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 8, 'adminuser@example.com', 'administrator', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, 'adminuser@example.com', 'administrator', 'User Management', 'View Users', 'view_users.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 8, 'adminuser@example.com', 'administrator', 'User Management', 'Manage Roles', 'manage_roles.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 9, 'loanofficer@example.com', 'loan_officer', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 9, 'loanofficer@example.com', 'loan_officer', 'Loan Management', 'Add Loan', 'add_loan.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 9, 'loanofficer@example.com', 'loan_officer', 'Loan Management', 'View Loans', 'view_loans.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 10, 'auditor@example.com', 'auditor', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 10, 'auditor@example.com', 'auditor', 'Auditing', 'View Transactions', 'view_transactions.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 11, 'secretary@example.com', 'secretary', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 11, 'secretary@example.com', 'secretary', 'Clients & Loans', 'Add Client', 'add_client.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 11, 'secretary@example.com', 'secretary', 'Clients & Loans', 'View Clients', 'view_clients.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 12, 'dataentry@example.com', 'data_entry', 'Dashboard', 'Dashboard', 'dashboard.php', 1, 1, 1, 1, 0, 0, '2025-01-30 17:39:10', '2025-01-30 17:39:10', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 7, 'admin@example.com', 'super_administrator', 'System Settings', 'System Configuration', 'system_config.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 7, 'admin@example.com', 'super_administrator', 'Reports', 'View Reports', 'view_reports.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 7, 'admin@example.com', 'super_administrator', 'System Settings', 'View Logs', 'view_logs.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 7, 'admin@example.com', 'super_administrator', 'User Management', 'Reset Password', 'reset_password.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-01-30 21:20:16', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 7, 'admin@example.com', 'super_administrator', 'Permissions', 'Manage Permissions', 'permissions/manage_permissions.php', 1, 1, 1, 1, 0, 0, '2025-01-30 21:20:16', '2025-02-04 21:34:41', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
-- Table structure for table `usersbuttons`
--

CREATE TABLE `usersbuttons` (
  `id` int(11) NOT NULL,
  `buttonnames` text NOT NULL,
  `activeids` text NOT NULL,
  `inactiveids` text NOT NULL,
  `userid` int(11) NOT NULL,
  `role` text NOT NULL,
  `fullname` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersbuttons`
--

INSERT INTO `usersbuttons` (`id`, `buttonnames`, `activeids`, `inactiveids`, `userid`, `role`, `fullname`, `status`) VALUES
(1, 'Add Button', '1,2,3', '4,5,6', 7, 'super_administrator', 'Super Admin', 1),
(2, 'Add Button', '1,2,3', '4,5,6', 8, 'administrator', 'John Doe', 1),
(3, 'Add Button', '1,2,3', '4,5,6', 9, 'loan_officer', 'Jane Smith', 1),
(4, 'Add Button', '1,2,3', '4,5,6', 10, 'auditor', 'Alex Brown', 1),
(5, 'Add Button', '1,2,3', '4,5,6', 11, 'secretary', 'Sarah Lee', 1),
(6, 'Add Button', '1,2,3', '4,5,6', 12, 'data_entry', 'David Clark', 1),
(7, 'Add Button', '1,2,3', '4,5,6', 13, 'data_entry', 'samson appiah', 1),
(8, 'View Button', '19,20,21', '22,23,24', 7, 'super_administrator', 'Super Admin', 1),
(9, 'View Button', '19,20,21', '22,23,24', 8, 'administrator', 'John Doe', 1),
(10, 'View Button', '19,20,21', '22,23,24', 9, 'loan_officer', 'Jane Smith', 1),
(11, 'View Button', '19,20,21', '22,23,24', 10, 'auditor', 'Alex Brown', 1),
(12, 'View Button', '19,20,21', '22,23,24', 11, 'secretary', 'Sarah Lee', 1),
(13, 'View Button', '19,20,21', '22,23,24', 12, 'data_entry', 'David Clark', 1),
(14, 'View Button', '19,20,21', '22,23,24', 13, 'data_entry', 'samson appiah', 1),
(15, 'Delete Button', '13,14,15', '16,17,18', 7, 'super_administrator', 'Super Admin', 1),
(16, 'Delete Button', '13,14,15', '16,17,18', 8, 'administrator', 'John Doe', 1),
(17, 'Delete Button', '13,14,15', '16,17,18', 9, 'loan_officer', 'Jane Smith', 1),
(18, 'Delete Button', '13,14,15', '16,17,18', 10, 'auditor', 'Alex Brown', 1),
(19, 'Delete Button', '13,14,15', '16,17,18', 11, 'secretary', 'Sarah Lee', 1),
(20, 'Delete Button', '13,14,15', '16,17,18', 12, 'data_entry', 'David Clark', 1),
(21, 'Delete Button', '13,14,15', '16,17,18', 13, 'data_entry', 'samson appiah', 1),
(22, 'Submit Button', '25,26,27', '28,29,30', 7, 'super_administrator', 'Super Admin', 1),
(23, 'Submit Button', '25,26,27', '28,29,30', 8, 'administrator', 'John Doe', 1),
(24, 'Submit Button', '25,26,27', '28,29,30', 9, 'loan_officer', 'Jane Smith', 1),
(25, 'Submit Button', '25,26,27', '28,29,30', 10, 'auditor', 'Alex Brown', 1),
(26, 'Submit Button', '25,26,27', '28,29,30', 11, 'secretary', 'Sarah Lee', 1),
(27, 'Submit Button', '25,26,27', '28,29,30', 12, 'data_entry', 'David Clark', 1),
(28, 'Submit Button', '25,26,27', '28,29,30', 13, 'data_entry', 'samson appiah', 1),
(29, 'Approve Button', '31,32,33', '34,35,36', 7, 'super_administrator', 'Super Admin', 1),
(30, 'Approve Button', '31,32,33', '34,35,36', 8, 'administrator', 'John Doe', 1),
(31, 'Approve Button', '31,32,33', '34,35,36', 9, 'loan_officer', 'Jane Smith', 1),
(32, 'Approve Button', '31,32,33', '34,35,36', 10, 'auditor', 'Alex Brown', 1),
(33, 'Approve Button', '31,32,33', '34,35,36', 11, 'secretary', 'Sarah Lee', 1),
(34, 'Approve Button', '31,32,33', '34,35,36', 12, 'data_entry', 'David Clark', 1),
(35, 'Approve Button', '31,32,33', '34,35,36', 13, 'data_entry', 'samson appiah', 1),
(36, 'Reject Button', '37,38,39', '40,41,42', 7, 'super_administrator', 'Super Admin', 1),
(37, 'Reject Button', '37,38,39', '40,41,42', 8, 'administrator', 'John Doe', 1),
(38, 'Reject Button', '37,38,39', '40,41,42', 9, 'loan_officer', 'Jane Smith', 1),
(39, 'Reject Button', '37,38,39', '40,41,42', 10, 'auditor', 'Alex Brown', 1),
(40, 'Reject Button', '37,38,39', '40,41,42', 11, 'secretary', 'Sarah Lee', 1),
(41, 'Reject Button', '37,38,39', '40,41,42', 12, 'data_entry', 'David Clark', 1),
(42, 'Reject Button', '37,38,39', '40,41,42', 13, 'data_entry', 'samson appiah', 1);

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
  `account` varchar(10) NOT NULL DEFAULT '1',
  `process` varchar(10) NOT NULL DEFAULT '1',
  `userimage` varchar(255) NOT NULL DEFAULT 'user.jpg',
  `hide_add` text NOT NULL,
  `hide_edit` text NOT NULL,
  `hide_view` text NOT NULL,
  `hide_delete` text NOT NULL,
  `hide_fetch` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`userid`, `workid`, `fullname`, `username`, `email`, `password`, `role`, `status`, `account`, `process`, `userimage`, `hide_add`, `hide_edit`, `hide_view`, `hide_delete`, `hide_fetch`, `created_at`, `updated_at`) VALUES
(7, 'OKRU-1234567890', 'Super Admin', 'superadmin', 'admin@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'super_administrator', 'active', '0', '1', 'user.jpg', '', '', '', '', '', '2025-01-29 18:49:39', '2025-02-06 22:09:53'),
(8, 'OKRU-2345678901', 'John Doe', 'adminuser', 'adminuser@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'administrator', 'inactive', '1', '1', 'user.jpg', '', '', '', '', '', '2025-01-29 18:49:39', '2025-02-07 01:37:42'),
(9, 'OKRU-3456789012', 'Jane Smith', 'loanofficer', 'loanofficer@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'loan_officer', 'active', '1', '1', 'user.jpg', '', '', '', '', '', '2025-01-29 18:49:39', '2025-02-06 22:09:30'),
(10, 'OKRU-4567890123', 'Alex Brown', 'auditor', 'auditor@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'auditor', 'active', '1', '1', 'user.jpg', '', '', '', '', '', '2025-01-29 18:49:39', '2025-02-04 23:38:07'),
(11, 'OKRU-5678901234', 'Sarah Lee', 'secretary', 'secretary@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'secretary', 'active', '1', '1', 'user.jpg', '', '', '', '', '', '2025-01-29 18:49:39', '2025-02-04 23:38:10'),
(12, 'OKRU-6789012345', 'David Clark', 'dataentry', 'dataentry@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'data_entry', 'active', '1', '1', 'user.jpg', '', '', '', '', '', '2025-01-29 18:49:39', '2025-02-04 23:38:15'),
(13, 'OKRU-67890123994', 'samson appiah', 'jonas', 'veem@example.com', '$2y$10$LTk7tEV9OLyLTLEIyBqaCO9QRbL2ncwcexb9IkhWZ2JS18NdCZK6y', 'data_entry', 'active', '1', '1', 'user.jpg', '', '', '', '', '', '2025-02-04 23:38:53', '2025-02-04 23:40:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buttonss_tbl`
--
ALTER TABLE `buttonss_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `buttons_tbl`
--
ALTER TABLE `buttons_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `customerdata`
--
ALTER TABLE `customerdata`
  ADD PRIMARY KEY (`customerid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `userid` (`userid`);

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
-- Indexes for table `usersbuttons`
--
ALTER TABLE `usersbuttons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

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
-- AUTO_INCREMENT for table `buttonss_tbl`
--
ALTER TABLE `buttonss_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `buttons_tbl`
--
ALTER TABLE `buttons_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `customerdata`
--
ALTER TABLE `customerdata`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `permissionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
-- AUTO_INCREMENT for table `usersbuttons`
--
ALTER TABLE `usersbuttons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buttonss_tbl`
--
ALTER TABLE `buttonss_tbl`
  ADD CONSTRAINT `buttonss_tbl_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customerdata` (`customerid`) ON DELETE CASCADE;

--
-- Constraints for table `buttons_tbl`
--
ALTER TABLE `buttons_tbl`
  ADD CONSTRAINT `buttons_tbl_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customerdata` (`customerid`) ON DELETE CASCADE;

--
-- Constraints for table `customerdata`
--
ALTER TABLE `customerdata`
  ADD CONSTRAINT `customerdata_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users_tbl` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `usersbuttons`
--
ALTER TABLE `usersbuttons`
  ADD CONSTRAINT `usersbuttons_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users_tbl` (`userid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
