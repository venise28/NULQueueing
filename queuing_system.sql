-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 01:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queuing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE `academics` (
  `id` int(11) NOT NULL,
  `queue_number` varchar(255) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `program` varchar(255) DEFAULT NULL,
  `concern` text DEFAULT NULL,
  `endorsed_from` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `remarks` varchar(555) DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academics`
--

INSERT INTO `academics` (`id`, `queue_number`, `student_id`, `program`, `concern`, `endorsed_from`, `timestamp`, `remarks`, `transaction`) VALUES
(45, 'SEA006', 'GUEST', 'SEA', 'Brian De Guzman', NULL, '2023-11-03 08:05:15', NULL, 'Subject Registration'),
(46, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-03 08:10:43', NULL, 'Subject Registration'),
(47, 'SAS001', 'GUEST', 'SAS', 'Carlito Loyola Jr.', NULL, '2023-11-07 03:03:52', NULL, 'Subject Registration'),
(48, 'SAS001', '123455', 'SAS', 'Carlito Loyola Jr.', NULL, '2023-11-07 03:10:58', NULL, 'Subject Registration'),
(49, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 05:58:35', NULL, 'Subject Registration'),
(50, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 05:58:38', NULL, 'Subject Registration'),
(51, 'SAS008', 'GUEST', 'SAS', 'Carlito Loyola Jr.', NULL, '2023-11-09 05:58:41', NULL, 'Subject Registration'),
(52, 'SAS008', 'GUEST', 'SAS', 'Carlito Loyola Jr.', NULL, '2023-11-09 05:58:44', NULL, 'Subject Registration'),
(53, 'SEA006', 'GUEST', 'SEA', 'Brian De Guzman', NULL, '2023-11-09 05:58:59', NULL, 'Subject Registration'),
(54, 'SEA006', 'GUEST', 'SEA', 'Brian De Guzman', NULL, '2023-11-09 05:59:02', NULL, 'Subject Registration'),
(55, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 05:59:52', NULL, 'Subject Registration'),
(56, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:02:34', NULL, 'Subject Registration'),
(57, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:02:36', NULL, 'Subject Registration'),
(58, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:08:35', NULL, 'Subject Registration'),
(59, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:08:38', NULL, 'Subject Registration'),
(60, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:13:20', NULL, 'Subject Registration'),
(61, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:13:35', NULL, 'Subject Registration'),
(62, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:13:44', NULL, 'Subject Registration'),
(63, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:16:18', NULL, 'Subject Registration'),
(64, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:16:20', NULL, 'Subject Registration'),
(65, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:18:28', NULL, 'Subject Registration'),
(66, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:18:30', NULL, 'Subject Registration'),
(67, 'SCS003', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:18:35', NULL, 'Subject Registration'),
(68, 'SCS004', 'GUEST', 'SCS', 'Marlon Diloy', NULL, '2023-11-09 06:21:51', NULL, 'Subject Registration'),
(69, 'SEA007', 'GUEST', 'SEA', 'Brian De Guzman', NULL, '2023-11-09 06:21:54', NULL, 'Subject Registration'),
(70, 'SAS009', 'GUEST', 'SAS', 'Carlito Loyola Jr.', NULL, '2023-11-09 06:21:56', NULL, 'Subject Registration'),
(71, 'SAS010', 'GUEST', 'SAS', 'Carlito Loyola Jr.', NULL, '2023-11-09 06:21:59', NULL, 'Subject Registration'),
(72, 'SEA008', 'GUEST', 'SEA', 'Brian De Guzman', NULL, '2023-11-09 06:22:19', NULL, 'Subject Registration');

-- --------------------------------------------------------

--
-- Table structure for table `academics_logs`
--

CREATE TABLE `academics_logs` (
  `id` int(11) NOT NULL,
  `queue_number` varchar(255) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `endorsed_from` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `timeout` timestamp NULL DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academics_logs`
--

INSERT INTO `academics_logs` (`id`, `queue_number`, `student_id`, `endorsed_from`, `timestamp`, `timeout`, `transaction`) VALUES
(1, 'SCS001', '2020-120283', 'Academics', '2023-10-26 13:46:38', '2023-10-26 13:46:52', 'accounting'),
(2, 'SCS002', '2020-120283', 'Academics', '2023-10-26 13:51:37', '2023-10-26 13:51:59', 'accounting');

-- --------------------------------------------------------

--
-- Table structure for table `accounting`
--

CREATE TABLE `accounting` (
  `id` int(11) NOT NULL,
  `queue_number` varchar(64) NOT NULL,
  `student_id` varchar(64) NOT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `timeout` timestamp NULL DEFAULT NULL,
  `endorsed_from` varchar(255) DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL,
  `remarks` varchar(64) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting`
--

INSERT INTO `accounting` (`id`, `queue_number`, `student_id`, `timestamp`, `timeout`, `endorsed_from`, `transaction`, `remarks`, `status`) VALUES
(1, 'R001', '2020-1200', '2023-09-23 14:14:32', NULL, NULL, NULL, 'gIOaLPHONSE', 0),
(2, 'AS212', '2020-1245', '2023-09-23 14:14:32', NULL, NULL, NULL, 'THIS IS NICE', 1),
(3, 'SCS007', '2020-120283', '2023-10-25 00:31:42', NULL, 'Academics', NULL, 'qweqwrqwrqasdqweqweqwe', 0),
(4, 'SCS008', '2020-120283', '2023-10-26 21:14:10', NULL, 'Academics', NULL, 'asdqweqwrqweqasdweq', 0),
(5, 'SCS009', '2020-120283', '2023-10-26 21:20:32', NULL, 'Academics', NULL, '12312241sdasdasd', 0),
(6, 'SCS010', '2020-120283', '2023-10-26 21:21:13', NULL, 'Academics', NULL, '123124123asdasdqweqweyrui', 0),
(7, 'SCS013', '2020-120283', '2023-10-26 21:24:49', NULL, 'Academics', NULL, 'asdqweqweqweqwe', 0),
(8, 'SCS001', '2020-120283', '2023-10-26 21:46:52', NULL, 'Academics', 'accounting', '123123123asdqweqweqw', 0),
(9, 'SCS002', '2020-120283', '2023-10-26 21:51:59', NULL, 'Academics', 'accounting', '12312412412qweqweqweqwe123123', 0),
(10, 'AD002', '2020-123', '2023-09-24 22:36:25', NULL, 'ADMISSION', NULL, 'test', 0),
(11, 'AD001', '2020-123', '2023-09-21 07:35:47', NULL, 'ADMISSION', NULL, 'test endorse', 0),
(12, 'AD001', '2020-123', '2023-09-21 07:35:47', NULL, 'ADMISSION', NULL, 'test endorse ulit', 0),
(13, 'AD002', '2020-123', '2023-09-24 22:36:25', NULL, 'ADMISSION', NULL, 'endorse sa accounting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `users` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`users`, `id`, `email`, `password`) VALUES
('window1', 1, 'magalingka@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `id` int(11) NOT NULL,
  `queue_number` varchar(45) DEFAULT NULL,
  `student_id` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `endorsed_from` varchar(45) DEFAULT NULL,
  `transaction` varchar(45) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `program` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`id`, `queue_number`, `student_id`, `timestamp`, `endorsed_from`, `transaction`, `remarks`, `program`, `status`) VALUES
(1, 'AD010', 'GUEST', '2023-11-08 21:50:31', NULL, '', '', '-', 0),
(2, 'AD011', 'GUEST', '2023-11-08 23:19:04', NULL, '', '', '-', 0),
(3, 'AD012', 'GUEST', '2023-11-10 05:06:23', NULL, '', '', '-', 0),
(4, 'AD013', 'GUEST', '2023-11-10 05:17:04', NULL, '', '', '-', 0),
(5, 'AD014', 'GUEST', '2023-11-10 05:21:38', NULL, '', '', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admission_logs`
--

CREATE TABLE `admission_logs` (
  `id` int(11) NOT NULL,
  `student_id` varchar(45) DEFAULT NULL,
  `queue_number` varchar(45) DEFAULT NULL,
  `office` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `timeout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `queue_number` varchar(64) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `timestamp` varchar(64) DEFAULT NULL,
  `timeout` timestamp(6) NULL DEFAULT NULL,
  `endorsed_from` varchar(255) DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL,
  `remarks` varchar(64) DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `queue_number`, `student_id`, `timestamp`, `timeout`, `endorsed_from`, `transaction`, `remarks`, `status`) VALUES
(1, 'AC011', '2020-12001', '0000-00-00 00:00:00', NULL, NULL, NULL, 'Hi this is just a test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `ID` int(11) NOT NULL,
  `acronym` varchar(11) NOT NULL,
  `collegeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`ID`, `acronym`, `collegeName`) VALUES
(1, 'SCS', 'School of Computer Studies'),
(2, 'SEA', 'School of Engineering and Architecture'),
(3, 'SAS', 'School of Arts and Sciences'),
(4, 'SABM', 'School of Accountancy and Business Management'),
(5, 'SHS', 'Senior High School');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `ID` int(11) NOT NULL,
  `acronym` varchar(11) NOT NULL,
  `officeName` varchar(255) NOT NULL,
  `office` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`ID`, `acronym`, `officeName`, `office`) VALUES
(1, 'AD', 'ADMISSION', 0),
(2, 'R', 'REGISTRAR', 0),
(3, 'AC', 'ACCOUNTING', 0),
(4, 'VE', 'VENISE', 0),
(5, 'MA', 'MAGICAL', 0),
(6, 'CL', 'CLINIC', 1),
(7, 'AS', 'ASSETS', 1),
(8, 'IT', 'ITRO', 1),
(9, 'G', 'GUIDANCE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `program_chairs`
--

CREATE TABLE `program_chairs` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_chairs`
--

INSERT INTO `program_chairs` (`id`, `full_name`, `program`, `status`) VALUES
(1, 'Vincent Rivera', 'SCS', 'offline'),
(2, 'Marlon Diloy', 'SCS', 'available'),
(3, 'Carlito Loyola Jr.', 'SAS', NULL),
(4, 'Marjualita Malapo', 'SAS', NULL),
(5, 'Frederick Dalena', 'SAS', NULL),
(6, 'Jude Thaddeus Bartolome', 'SAS', NULL),
(7, 'Brian De Guzman', 'SEA', NULL),
(9, 'Juliet Niega', 'SEA', NULL),
(10, 'Joseph Alcoran', 'SEA', NULL),
(11, 'Florenda De Vero', 'SABM', NULL),
(12, 'Johnny Boy Tizon', 'SABM', NULL),
(13, 'Arnel Villamin', 'SABM', NULL),
(14, 'Richard Miguel Butial', 'SHS', NULL),
(15, 'Jhanna Mae Tadique', 'SHS', NULL),
(16, 'Maria Carina Pontanar', 'SHS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `queue_number` varchar(10) NOT NULL,
  `office` varchar(20) NOT NULL,
  `program` varchar(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `student_id`, `queue_number`, `office`, `program`, `timestamp`, `status`, `remarks`) VALUES
(1, '2020-123', 'AD001', 'ADMISSION', '', '2023-09-21 07:35:47', 1, NULL),
(2, '2020-123', 'R001', 'REGISTRAR', '', '2023-09-23 03:19:13', 1, NULL),
(3, '2020-12345', 'AC0011', 'ACCOUNTING', '', '2023-09-23 06:14:32', 1, NULL),
(4, '2020-123', 'AC002', 'ACCOUNTING', '', '2023-09-23 06:14:40', 0, NULL),
(5, '2020-123', 'AD002', 'ADMISSION', '', '2023-09-24 22:36:25', 1, NULL),
(6, '2020-123', 'AS001', 'ASSETS', '', '2023-09-24 22:37:35', 0, NULL),
(7, '2020-123', 'AC003', 'ACCOUNTING', '', '2023-09-25 06:49:46', 0, NULL),
(8, '2020-123', 'CL001', 'CLINIC', '', '2023-09-28 02:41:32', 0, NULL),
(9, '2020-123', 'AC004', 'ACCOUNTING', '', '2023-09-28 02:50:22', 0, NULL),
(11, '2020-123', 'R002', 'REGISTRAR', '', '2023-09-28 02:50:39', 0, NULL),
(12, '2020-123', 'R003', 'REGISTRAR', '', '2023-09-28 02:50:49', 0, NULL),
(13, '2020-123', 'CL002', 'CLINIC', '', '2023-09-28 02:56:33', 0, NULL),
(14, '2020-123', 'AS002', 'ASSETS', '', '2023-09-28 02:57:34', 0, NULL),
(15, '2020-123', 'AS003', 'ASSETS', '', '2023-09-28 02:57:41', 0, NULL),
(16, 'GUEST', 'AD003', 'ADMISSION', '', '2023-09-28 04:31:40', 0, NULL),
(17, '2020-123', 'R004', 'REGISTRAR', '', '2023-09-28 04:31:46', 0, NULL),
(18, '2020-123', 'CL003', 'CLINIC', '', '2023-09-28 04:35:04', 0, NULL),
(19, '2020-123', 'IT001', 'ITRO', '', '2023-09-28 04:35:15', 0, NULL),
(22, '2020-12001', 'AC011', 'ACCOUNTING', '', '0000-00-00 00:00:00', 1, NULL),
(24, '2020-12001', 'AC123', 'ACCOUNTING', '', '0000-00-00 00:00:00', 0, NULL),
(25, 'GUEST', 'AD004', 'ADMISSION', '', '2023-10-10 14:21:00', 0, NULL),
(29, '231312', 'AD005', 'ADMISSION', 'SEA', '2023-10-10 14:27:08', 1, NULL),
(46, '2020-12028', 'SCS001', 'ACADEMICS', 'SCS', '2023-10-26 13:46:38', 0, NULL),
(47, '2020-12028', 'SCS002', 'ACADEMICS', 'SCS', '2023-10-26 13:51:37', 0, NULL),
(48, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-03 08:10:43', 0, NULL),
(49, '2020-123', 'R005', 'REGISTRAR', 'SCS', '2023-11-03 12:40:59', 0, NULL),
(50, 'GUEST', 'AC124', 'ACCOUNTING', '-', '2023-11-05 15:46:41', 0, NULL),
(51, 'GUEST', 'SAS001', 'ACADEMICS', '-', '2023-11-07 03:03:52', 0, NULL),
(52, '123455', 'R006', 'REGISTRAR', 'SABM', '2023-11-07 03:10:09', 0, NULL),
(53, '123455', 'AD006', 'ADMISSION', 'SABM', '2023-11-07 03:10:13', 0, NULL),
(54, '123455', 'G001', 'GUIDANCE', 'SABM', '2023-11-07 03:10:17', 0, NULL),
(55, '123455', 'SAS001', 'ACADEMICS', 'SABM', '2023-11-07 03:10:58', 0, NULL),
(56, '12312', 'AD007', 'ADMISSION', 'SAS', '2023-11-09 04:42:06', 0, NULL),
(57, '12312', 'R007', 'REGISTRAR', 'SAS', '2023-11-09 04:42:09', 0, NULL),
(58, '12312', 'AC125', 'ACCOUNTING', 'SAS', '2023-11-09 04:42:15', 0, NULL),
(59, '12312', 'AD008', 'ADMISSION', 'SAS', '2023-11-09 04:42:45', 0, NULL),
(60, 'GUEST', 'AD009', 'ADMISSION', '-', '2023-11-09 04:45:49', 0, NULL),
(61, 'GUEST', 'AD010', 'ADMISSION', '-', '2023-11-09 04:50:31', 0, NULL),
(62, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 05:58:35', 0, NULL),
(63, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 05:58:38', 0, NULL),
(64, 'GUEST', 'SAS008', 'ACADEMICS', '-', '2023-11-09 05:58:41', 0, NULL),
(65, 'GUEST', 'SAS008', 'ACADEMICS', '-', '2023-11-09 05:58:44', 0, NULL),
(66, 'GUEST', 'SEA006', 'ACADEMICS', '-', '2023-11-09 05:58:59', 0, NULL),
(67, 'GUEST', 'SEA006', 'ACADEMICS', '-', '2023-11-09 05:59:02', 0, NULL),
(68, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 05:59:52', 0, NULL),
(69, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:02:34', 0, NULL),
(70, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:02:36', 0, NULL),
(71, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:08:36', 0, NULL),
(72, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:08:38', 0, NULL),
(73, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:13:20', 0, NULL),
(74, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:13:35', 0, NULL),
(75, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:13:44', 0, NULL),
(76, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:16:18', 0, NULL),
(77, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:16:20', 0, NULL),
(78, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:18:28', 0, NULL),
(79, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:18:30', 0, NULL),
(80, 'GUEST', 'SCS003', 'ACADEMICS', '-', '2023-11-09 06:18:35', 0, NULL),
(81, 'GUEST', 'AD011', 'ADMISSION', '-', '2023-11-09 06:19:04', 0, NULL),
(82, 'GUEST', 'SCS004', 'ACADEMICS', '-', '2023-11-09 06:21:51', 0, NULL),
(83, 'GUEST', 'SEA007', 'ACADEMICS', '-', '2023-11-09 06:21:54', 0, NULL),
(84, 'GUEST', 'SAS009', 'ACADEMICS', '-', '2023-11-09 06:21:56', 0, NULL),
(85, 'GUEST', 'SAS010', 'ACADEMICS', '-', '2023-11-09 06:21:59', 0, NULL),
(86, 'GUEST', 'AC126', 'ACCOUNTING', '-', '2023-11-09 06:22:09', 0, NULL),
(87, 'GUEST', 'R008', 'REGISTRAR', '-', '2023-11-09 06:22:11', 0, NULL),
(88, 'GUEST', 'R009', 'REGISTRAR', '-', '2023-11-09 06:22:14', 0, NULL),
(89, 'GUEST', 'R010', 'REGISTRAR', '-', '2023-11-09 06:22:16', 0, NULL),
(90, 'GUEST', 'SEA008', 'ACADEMICS', '-', '2023-11-09 06:22:19', 0, NULL),
(91, 'GUEST', 'AD012', 'ADMISSION', '-', '2023-11-10 12:06:22', 0, NULL),
(92, 'GUEST', 'R011', 'REGISTRAR', '-', '2023-11-10 12:06:24', 0, NULL),
(93, 'GUEST', 'AD013', 'ADMISSION', '-', '2023-11-10 12:17:04', 0, NULL),
(94, 'GUEST', 'R012', 'REGISTRAR', '-', '2023-11-10 12:17:06', 0, NULL),
(95, 'GUEST', 'AC127', 'ACCOUNTING', '-', '2023-11-10 12:17:08', 0, NULL),
(96, 'GUEST', 'AD014', 'ADMISSION', '-', '2023-11-10 12:21:38', 0, NULL),
(97, 'GUEST', 'R013', 'REGISTRAR', '-', '2023-11-10 12:21:40', 0, NULL),
(98, 'GUEST', 'AC128', 'ACCOUNTING', '-', '2023-11-10 12:21:42', 0, NULL),
(99, 'GUEST', 'VE001', 'VENISE', '-', '2023-11-10 12:22:41', 0, NULL),
(100, 'GUEST', 'BN001', 'BEAN', '-', '2023-11-10 12:27:33', 0, NULL),
(101, 'GUEST', 'BN002', 'BEAN', '-', '2023-11-10 12:27:37', 0, NULL),
(102, '2020-123', 'VE002', 'VENISE', 'SAS', '2023-11-10 12:37:13', 0, NULL),
(103, 'GUEST', 'G002', 'GUIDANCE', '-', '2023-11-10 12:49:06', 0, NULL),
(104, 'GUEST', 'AS004', 'ASSETS', '-', '2023-11-10 12:49:11', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `id` int(11) NOT NULL,
  `queue_number` varchar(64) NOT NULL,
  `student_id` varchar(64) NOT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `endorsed_from` varchar(255) DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `window` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrar`
--

INSERT INTO `registrar` (`id`, `queue_number`, `student_id`, `timestamp`, `endorsed_from`, `transaction`, `remarks`, `status`, `window`) VALUES
(1, 'R0001', '2121', '2023-11-07 14:20:18', '2121', '2121', '2121', 0, 1),
(2, 'R0002', '2121', '2023-11-07 14:21:56', '2121', '2121', '2112', 0, 0),
(3, 'R0003', '2121', '2023-11-07 14:26:37', '2121', '2121', '2121', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `registrar_done`
--

CREATE TABLE `registrar_done` (
  `id` varchar(64) NOT NULL,
  `queue_number` varchar(64) NOT NULL,
  `student_id` varchar(64) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `endorsed_from` varchar(255) DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `timeout` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrar_done`
--

INSERT INTO `registrar_done` (`id`, `queue_number`, `student_id`, `time_stamp`, `endorsed_from`, `transaction`, `remarks`, `status`, `timeout`) VALUES
('', 'R001', '123', '2023-10-30 18:21:04', 'REGISTRAR', '123', '123', 0, NULL),
('', 'R0001', '123', '2023-10-30 18:22:42', 'REGISTRAR', '123', '123', 0, NULL),
('', '23', '321', '2023-10-31 12:00:44', 'REGISTRAR', '312', '321', 0, NULL),
('', '21', '21', '2023-11-01 09:55:48', 'REGISTRAR', '21', '21', 0, NULL),
('', '21', '21', '2023-11-01 10:02:58', 'REGISTRAR', '21', '21', 0, NULL),
('', '21', '21', '2023-11-01 10:07:05', 'REGISTRAR', '21', '21', 0, NULL),
('', '21', '21', '2023-11-01 10:10:46', 'REGISTRAR', '21', '21', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentid_list`
--

CREATE TABLE `studentid_list` (
  `id` int(11) NOT NULL,
  `student_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentid_list`
--

INSERT INTO `studentid_list` (`id`, `student_id`) VALUES
(1, '2020-123');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `ID` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`ID`, `full_name`, `office`, `username`, `password`, `role`, `status`) VALUES
(1, 'Dora D. Explorer', 'CLINIC', 'Dddddora', '123456', 'Admin', NULL),
(2, 'Olaf D. Snowman', 'ACCOUNTING', 'inSummer2', '123456', 'Admin', NULL),
(3, 'Marlon Diloy', 'SCS', 'marlondiloy', '12345678', 'admin', 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academics_logs`
--
ALTER TABLE `academics_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_logs`
--
ALTER TABLE `admission_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `program_chairs`
--
ALTER TABLE `program_chairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentid_list`
--
ALTER TABLE `studentid_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `academics_logs`
--
ALTER TABLE `academics_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accounting`
--
ALTER TABLE `accounting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admission_logs`
--
ALTER TABLE `admission_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `studentid_list`
--
ALTER TABLE `studentid_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
