-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 08:08 PM
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
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `absent`
--

CREATE TABLE `absent` (
  `id` int(11) NOT NULL,
  `empname` varchar(500) NOT NULL,
  `AttendanceTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absent`
--

INSERT INTO `absent` (`id`, `empname`, `AttendanceTime`) VALUES
(46, 'MOHANI KUMARI', '2023-12-29 10:32:25'),
(47, 'JONNADA NAGABUSHANAM', '2023-12-31 10:32:25'),
(48, 'QWWQWQ', '2023-12-29 10:32:25'),
(49, 'JONNADA NAGABUSHANAM', '2024-01-31 12:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `approver`
--

CREATE TABLE `approver` (
  `id` int(11) NOT NULL,
  `aprname` varchar(500) NOT NULL,
  `apremail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `approver`
--

INSERT INTO `approver` (`id`, `aprname`, `apremail`) VALUES
(1, 'YSS', '19l31a1904@vignaniit.edu.in'),
(6, 'YSS2', 'it@anikasterilis.com');

-- --------------------------------------------------------

--
-- Table structure for table `ca`
--

CREATE TABLE `ca` (
  `id` int(11) NOT NULL,
  `empemail` varchar(255) NOT NULL,
  `empname` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `submissionTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ca`
--

INSERT INTO `ca` (`id`, `empemail`, `empname`, `status`, `submissionTime`) VALUES
(12, 'naradamohan1@gmail.com', 'JONNADA NAGABUSHANAM', 1, '2024-01-01 05:29:36'),
(15, 'naradamohan1@gmail.com', 'Mohan Narada Reddy', 1, '2024-01-01 06:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `camsbiometricattendance`
--

CREATE TABLE `camsbiometricattendance` (
  `ID` int(11) NOT NULL,
  `ServiceTagId` varchar(20) DEFAULT NULL,
  `UserID` varchar(9) DEFAULT NULL,
  `AttendanceTime` datetime DEFAULT NULL,
  `AttendanceType` varchar(16) DEFAULT NULL,
  `InputType` varchar(200) DEFAULT NULL,
  `option` varchar(200) DEFAULT NULL,
  `addoption` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `camsbiometricattendance`
--

INSERT INTO `camsbiometricattendance` (`ID`, `ServiceTagId`, `UserID`, `AttendanceTime`, `AttendanceType`, `InputType`, `option`, `addoption`) VALUES
(6, 'ZXQI19009096', '2', '2023-12-16 11:58:23', 'CheckIn', 'Fingerprint', NULL, NULL),
(8, 'ZXQI19009096', '2', '2023-12-16 12:12:15', 'BreakOut', 'Fingerprint', NULL, NULL),
(9, 'ZXQI19009096', '2', '2023-12-16 12:12:20', 'CheckOut', 'Fingerprint', NULL, NULL),
(10, NULL, '3', '2023-12-16 09:12:00', 'CheckOut', 'System', 'CAMS instrument fault', ''),
(11, NULL, '3', '2023-12-16 12:13:00', 'CheckIn', 'System', 'CAMS instrument fault', ''),
(12, NULL, '3', '2023-12-16 12:13:00', 'CheckOut', 'System', 'CAMS instrument fault', ''),
(13, 'ZXQI19009096', '2', '2023-12-16 12:24:20', 'BreakIn', 'Fingerprint', NULL, NULL),
(14, 'ZXQI19009096', '2', '2023-12-16 12:25:51', 'CheckIn', 'Fingerprint', NULL, NULL),
(15, 'ZXQI19009096', '2', '2023-12-16 12:26:38', 'CheckIn', 'Fingerprint', NULL, NULL),
(16, 'ZXQI19009096', '2', '2023-12-16 12:30:05', 'CheckOut', 'Fingerprint', NULL, NULL),
(17, NULL, '8', '2023-12-16 14:25:00', 'CheckIn', 'System', 'Other- mention', 'qwerty'),
(18, NULL, '8', '2023-12-16 17:30:00', 'CheckOut', 'System', 'Other- mention', 'ytrewq'),
(20, NULL, '10', '2023-12-15 10:44:00', 'CheckIn', 'Fingerprint', '', ''),
(21, NULL, '10', '2023-12-15 17:42:00', 'CheckOut', 'System', 'Other- mention', ''),
(24, 'ZXQI19009096', '2', '2023-12-16 16:47:42', 'CheckIn', 'Fingerprint', NULL, NULL),
(25, 'ZXQI19009096', '2', '2023-12-16 16:48:32', 'CheckIn', 'Fingerprint', NULL, NULL),
(26, 'ZXQI19009096', '3', '2023-12-16 16:55:08', 'CheckIn', 'Fingerprint', NULL, NULL),
(27, 'ZXQI19009096', '3', '2023-12-16 16:55:22', 'CheckOut', 'Fingerprint', NULL, NULL),
(29, NULL, '2', '2023-12-16 18:06:00', 'CheckOut', 'System', 'CAMS instrument fault', ''),
(31, 'ZXQI19009096', '2', '2023-12-16 17:30:30', 'BreakOut', 'Fingerprint', NULL, NULL),
(32, 'ZXQI19009096', '2', '2023-12-16 17:30:48', 'BreakIn', 'Fingerprint', NULL, NULL),
(36, 'ZXQI19009096', '3', '2023-12-18 10:04:24', 'CheckIn', 'Fingerprint', NULL, NULL),
(39, NULL, '2', '2023-12-18 09:34:00', 'CheckIn', 'System', 'Power Cut', ''),
(42, NULL, '2', '2023-12-18 18:00:00', 'CheckOut', 'System', 'Power Cut', ''),
(43, NULL, '0', '2023-12-19 09:32:00', 'CheckIn', 'System', 'Internet Issue', ''),
(44, NULL, '1', '2023-12-19 09:31:00', 'CheckIn', 'System', 'Power Cut', ''),
(45, 'ZXQI19009096', '2', '2023-12-21 09:39:39', 'CheckIn', 'Fingerprint', NULL, NULL),
(46, 'ZXQI19009096', '2', '2023-12-21 09:41:59', 'CheckOut', 'Fingerprint', NULL, NULL),
(47, 'ZXQI19009096', '2', '2023-12-21 09:42:13', 'CheckIn', 'Face', NULL, NULL),
(48, NULL, '2', '2023-11-02 13:01:00', 'CheckIn', 'System', 'Power Cut', ''),
(50, NULL, '2', '2024-01-02 09:28:00', 'CheckIn', 'System', 'Internet Issue', ''),
(51, NULL, '2', '2024-01-02 17:29:00', 'CheckOut', 'System', 'Internet Issue', ''),
(52, NULL, '3', '2024-01-01 09:18:00', 'CheckIn', 'System', 'Power Cut', ''),
(54, NULL, '1', '2023-12-31 09:20:00', 'CheckIn', 'System', 'Internet Issue', ''),
(55, NULL, '1', '2023-12-31 20:20:00', 'CheckOut', 'System', 'Internet Issue', ''),
(56, NULL, '1', '2024-01-01 20:21:00', 'CheckOut', 'System', 'Internet Issue', ''),
(57, NULL, '1', '2024-01-01 20:21:00', 'CheckIn', 'System', 'Power Cut', ''),
(58, NULL, '3', '2024-01-31 08:59:00', 'CheckIn', 'System', 'Internet Issue', ''),
(59, NULL, '3', '2024-01-31 21:59:00', 'CheckOut', 'System', 'Power Cut', ''),
(60, NULL, '10', '2024-01-01 10:25:00', 'CheckIn', 'System', 'Power Cut', ''),
(61, NULL, '10', '2024-01-01 22:25:00', 'CheckOut', 'System', 'Internet Issue', ''),
(62, NULL, '3', '2024-01-01 22:46:00', 'CheckOut', 'System', 'Power Cut', '');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `ID` int(11) NOT NULL,
  `desg` varchar(20) DEFAULT NULL,
  `shifts` varchar(9) DEFAULT NULL,
  `fromshifttime1` time DEFAULT NULL,
  `toshifttime1` time DEFAULT NULL,
  `fromshifttime2` time DEFAULT NULL,
  `toshifttime2` time DEFAULT NULL,
  `fromshifttime3` time DEFAULT NULL,
  `toshifttime3` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`ID`, `desg`, `shifts`, `fromshifttime1`, `toshifttime1`, `fromshifttime2`, `toshifttime2`, `fromshifttime3`, `toshifttime3`) VALUES
(4, 'SECURITY GAURDS', '2', '08:00:00', '20:00:00', '20:00:00', '08:00:00', '00:00:00', '00:00:00'),
(5, 'EXAMPLE', '3', '08:30:00', '16:30:00', '16:30:00', '22:00:00', '22:00:00', '07:00:00'),
(8, 'HOUSE KEEPER', '1', '09:00:00', '17:30:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00'),
(9, 'IT', '1', '09:30:00', '18:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `emp_no` varchar(100) NOT NULL,
  `empdob` date NOT NULL,
  `empname` varchar(100) NOT NULL,
  `empemail` varchar(100) NOT NULL,
  `empms` varchar(200) NOT NULL,
  `empph` varchar(200) NOT NULL,
  `empgen` varchar(200) NOT NULL,
  `empdoj` date NOT NULL,
  `rm` varchar(200) NOT NULL,
  `desg` varchar(200) NOT NULL,
  `dept` varchar(200) NOT NULL,
  `empty` varchar(200) NOT NULL,
  `salf` int(11) NOT NULL,
  `salbp` int(11) NOT NULL,
  `sald` int(11) NOT NULL,
  `sald1` int(11) NOT NULL,
  `pan` varchar(200) NOT NULL,
  `adn` varchar(200) NOT NULL,
  `bn` varchar(200) NOT NULL,
  `ban` varchar(200) NOT NULL,
  `ifsc` varchar(200) NOT NULL,
  `pdf` varchar(200) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `empstatus` varchar(100) NOT NULL,
  `reason` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`ID`, `UserID`, `emp_no`, `empdob`, `empname`, `empemail`, `empms`, `empph`, `empgen`, `empdoj`, `rm`, `desg`, `dept`, `empty`, `salf`, `salbp`, `sald`, `sald1`, `pan`, `adn`, `bn`, `ban`, `ifsc`, `pdf`, `pic`, `status`, `empstatus`, `reason`) VALUES
(27, 2, 'ASPL202312130003', '2001-09-02', 'SUSHANT', 'it@anikasterilis.com', 'Single', '7093135988', 'M', '2023-12-05', 'Prabhdeep Singh Maan', 'IT', 'ERER', 'ERETR', 3434, 3434, 434, 3434, 'BAZPY5657D', '508803358129', 'BOI', '918121126889', 'PYTM0123456', 'SUSHANT_d1090b28-9319-11ee-9b8e-0a5697bced46.pdf', 'yss.jpg', 1, '0', ''),
(28, 3, 'ASPL202312130004', '2002-06-17', 'Mohan Narada Reddy', 'naradamohan1@gmail.com', 'Single', '9885852424', 'F', '2023-12-13', 'Prabhdeep Singh Maan', 'IT', 'IT', 'Permanent', 300000, 280000, 100, 1500, 'FHSPR1826R', '2147483647', 'UBI', '122322010000365', 'UBIN0912239', 'Mohan Reddy_2324_IN_505.pdf', 'QWWQWQ_sales.png', 1, '0', ''),
(29, 10, 'ASPL202312140005', '1980-06-01', 'JONNADA NAGABUSHANAM', 'jonnadanaga111@gmail.com', 'Married', '7409836887', 'M', '2023-12-14', 'PSM', 'PSO', 'PSO', 'Permanent', 3000000, 20000, 1212, 11111, 'ABCD4-2323-D', '2111-1111-1111', 'IOB', '211212', '1212', 'JONNADA NAGABUSHANAM_restore.pdf', 'JONNADA NAGABUSHANAM_pic.jpg', 0, '0', ''),
(30, 1, 'ASPL202312190006', '2005-12-06', 'QWWQWQ', 'somisirr@gmail.com', 'Single', '7888888888', 'M', '2023-12-07', 'Prabhdeep Singh Maan', 'SECURITY GAURDS', 'QW', 'Permanent', 122112, 2121, 2121, 212, 'QDDQW-1221-2', '2111-1111-2111', 'ICICI', '212121', '21212112', 'QWWQWQ_done.pdf', 'QWWQWQ_sales.png', 0, '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `date`, `value`) VALUES
(24, '2024-01-08', 'YSS1'),
(26, '2024-01-04', 'Bhogi'),
(27, '2024-01-12', 'Sankranti');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `ID` int(11) NOT NULL,
  `empname` varchar(100) NOT NULL,
  `leavetype` varchar(100) NOT NULL,
  `applied` timestamp NOT NULL DEFAULT current_timestamp(),
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `desg` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `status1` int(11) NOT NULL,
  `status2` int(11) DEFAULT NULL,
  `reason` longtext NOT NULL,
  `empemail` varchar(100) NOT NULL,
  `empph` varchar(200) NOT NULL,
  `aprname` varchar(500) NOT NULL,
  `apremail` varchar(200) NOT NULL,
  `hrremark` longtext DEFAULT NULL,
  `aprtime` datetime DEFAULT NULL,
  `aprremark` longtext NOT NULL,
  `hrtime` datetime DEFAULT NULL,
  `leavetype2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`ID`, `empname`, `leavetype`, `applied`, `from`, `to`, `desg`, `status`, `status1`, `status2`, `reason`, `empemail`, `empph`, `aprname`, `apremail`, `hrremark`, `aprtime`, `aprremark`, `hrtime`, `leavetype2`) VALUES
(1, 'Mohan Narada Reddy', 'SL', '2023-12-22 07:13:23', '2023-12-22 00:00:00', '2023-12-24 00:00:00', 'IT', 1, 1, NULL, ' 1st leave', 'naradamohan1@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', 'bal', '2023-12-22 09:33:58', '', NULL, NULL),
(2, 'Mohan Narada Reddy', 'CASUAL LEAVE', '2023-12-22 07:13:35', '2023-12-22 00:00:00', '2023-12-24 00:00:00', 'IT', 2, 1, NULL, ' 2nd leave', 'naradamohan1@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', 'ok', '2023-12-22 09:40:40', 'no', NULL, NULL),
(3, 'Mohan Narada Reddy', 'SL', '2023-12-22 07:14:26', '2023-12-22 00:00:00', '2023-12-24 00:00:00', 'IT', 2, 0, NULL, ' 3rd leave', 'naradamohan1@gmail.com', '9885852424', '', '', 'rejected\r\n', NULL, '', NULL, NULL),
(4, 'Mohan Narada Reddy', 'SL', '2023-12-22 08:43:21', '2023-12-22 00:00:00', '2023-12-22 00:00:00', 'IT', 1, 1, NULL, ' 4th\n', 'naradamohan1@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', '1/12', '2023-12-22 09:50:56', '', NULL, NULL),
(5, 'Mohan Narada Reddy', 'CASUAL LEAVE', '2023-12-22 08:43:35', '2023-12-22 00:00:00', '2023-12-24 00:00:00', 'IT', 2, 1, NULL, '5th', 'naradamohan1@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', '11nlb', '2023-12-22 09:54:52', 'no', NULL, NULL),
(7, 'Mohan Narada Reddy', 'SL', '2023-12-22 09:15:12', '2023-12-24 00:00:00', '2023-12-25 00:00:00', 'IT', 1, 1, NULL, ' 7', 'naradamohan1@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', 'hrr', '2023-12-22 18:11:40', '', '2023-12-22 17:28:18', NULL),
(8, 'Mohan Narada Reddy', 'CASUAL LEAVE', '2023-12-22 09:26:48', '2023-12-22 00:00:00', '2023-12-22 00:00:00', 'IT', 1, 1, NULL, ' 8th', 'naradamohan1@gmail.com', '9885852424', 'YSS2', 'shinessushantha@gmail.com', 'ok', '2023-12-22 18:10:40', '', NULL, NULL),
(9, 'Mohan Narada Reddy', 'SL', '2023-12-22 10:11:04', '2023-12-30 00:00:00', '2024-01-02 00:00:00', 'IT', 2, 1, NULL, ' 9', 'naradamohan1@gmail.com', '9885852424', 'YSS2', 'shinessushantha@gmail.com', 'qweerrtt', '2023-12-22 18:11:11', 'no', '2023-12-22 12:22:11', NULL),
(10, 'Mohan Narada Reddy', 'CASUAL LEAVE', '2023-12-22 17:15:13', '2023-12-22 00:00:00', '2023-12-22 00:00:00', 'IT', 1, 1, NULL, ' es', 'naradamohan1@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', '2q3wer', '2023-12-23 14:05:09', '', NULL, NULL),
(11, 'Mohan Narada Reddy', 'SL', '2023-12-23 13:06:25', '2023-12-23 00:00:00', '2023-12-23 00:00:00', 'IT', 2, 1, NULL, ' okok', 'naradamohan1@gmail.com', '9885852424', 'YSS2', 'shinessushantha@gmail.com', 'ok', '2023-12-23 14:21:43', 'ok', NULL, NULL),
(16, 'SUSHANT', 'SL', '2023-12-23 16:51:34', '2023-12-27 00:00:00', '2023-12-30 00:00:00', 'IT', 3, 0, NULL, ' 1st', 'shinessushantha@gmail.com', '7093135988', 'YSS2', 'shinessushantha@gmail.com', '2', NULL, '', NULL, NULL),
(21, 'Mohan Narada Reddy', 'SL', '2023-12-23 17:09:51', '2023-12-29 00:00:00', '2023-12-30 00:00:00', 'IT', 0, 0, 0, ' 1st', 'naradamohan1@gmail.com', '9885852424', '', '', NULL, NULL, '', NULL, NULL),
(22, 'Mohan Narada Reddy', 'CASUAL LEAVE', '2023-12-23 17:11:01', '2023-12-23 00:00:00', '2023-12-29 00:00:00', 'IT', 1, 1, 1, ' 2nd', 'naradamohan1@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', '1', '2023-12-27 18:01:28', '', NULL, NULL),
(23, 'SUSHANT', 'CASUAL LEAVE', '2023-12-23 17:28:17', '2023-12-29 00:00:00', '2024-01-01 00:00:00', 'IT', 1, 1, 1, ' 2nd', 'shinessushantha@gmail.com', '7093135988', 'YSS2', 'shinessushantha@gmail.com', '2', '2023-12-24 18:36:52', 'no', NULL, NULL),
(24, 'QWWQWQ', 'SL', '2023-12-23 17:34:06', '2023-12-30 00:00:00', '2023-12-31 00:00:00', 'SECURITY GAURDS', 2, 0, 1, ' it', 'it@anikasterilis.com', '7888888888', '', '', 'no', NULL, '', '2023-12-23 18:34:58', NULL),
(25, 'SUSHANT', 'CASUAL LEAVE(HALF DAY)', '2023-12-24 12:25:17', '2023-12-24 09:30:00', '2023-12-24 13:00:00', 'IT', 1, 1, 1, ' 1s', 'shinessushantha@gmail.com', '7093135988', 'YSS2', 'shinessushantha@gmail.com', '1st', '2023-12-24 18:19:26', '', '2023-12-24 15:33:30', 'FN'),
(26, 'SUSHANT', 'CASUAL LEAVE', '2023-12-24 12:30:59', '2023-12-30 00:00:00', '2023-12-31 00:00:00', 'IT', 2, 0, 0, ' 2nd', 'shinessushantha@gmail.com', '7093135988', 'YSS', '19l31a1904@vignaniit.edu.in', 'no', NULL, '', '2023-12-24 15:33:15', '0'),
(27, 'QWWQWQ', 'CASUAL LEAVE(HALF DAY)', '2023-12-24 17:27:03', '2023-12-24 14:00:00', '2023-12-24 18:00:00', 'SECURITY GAURDS', 2, 0, 1, ' 3rd', 'it@anikasterilis.com', '7888888888', '', '', 'no', NULL, '', NULL, 'AN'),
(28, 'Mohan Narada Reddy', 'CASUAL LEAVE', '2023-12-27 16:35:45', '2023-12-28 00:00:00', '2023-12-30 00:00:00', 'IT', 2, 0, 0, ' 1st ', 'naradamohan1@gmail.com', '9885852424', '', '', 'qw', NULL, '', '2023-12-27 16:36:25', '0'),
(29, 'Mohan Narada Reddy', 'CASUAL LEAVE(HALF DAY)', '2023-12-27 18:08:25', '2023-12-27 09:30:00', '2023-12-27 13:00:00', 'IT', 2, 1, 1, '2nd.', 'naradamohan1@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', '2nd..', '2023-12-27 18:14:45', 'nno', '2023-12-27 18:08:54', 'FN'),
(31, 'MOHANI KUMARI', 'CASUAL LEAVE(HALF DAY)', '2023-12-28 04:56:59', '2023-12-28 14:00:00', '2023-12-28 18:00:00', 'WEB DEV', 2, 0, 1, ' 1st.', 'naradamohan2@gmail.com', '9885852424', '', '', 'no', NULL, '', '2023-12-28 04:58:23', 'AN'),
(32, 'MOHANI KUMARI', 'CASUAL LEAVE', '2023-12-28 04:57:58', '2023-12-30 00:00:00', '2024-01-02 00:00:00', 'WEB DEV', 1, 1, 1, ' 2nd', 'naradamohan2@gmail.com', '9885852424', 'YSS', '19l31a1904@vignaniit.edu.in', 'ok', '2023-12-28 04:59:39', '', NULL, ''),
(34, 'JONNADA NAGABUSHANAM', 'HALF DAY', '2024-01-01 16:35:25', '2024-01-01 14:00:00', '2024-01-01 18:00:00', 'PSO', 1, 1, 1, ' t', 'jonnadanaga111@gmail.com', '7409836887', '', '', NULL, NULL, '', NULL, 'AN'),
(35, 'Mohan Narada Reddy', 'HALF DAY', '2024-01-01 17:15:24', '2024-01-01 14:00:00', '2024-01-01 18:00:00', 'IT', 1, 1, 1, ' g', 'naradamohan1@gmail.com', '9885852424', '', '', NULL, NULL, '', NULL, 'AN');

-- --------------------------------------------------------

--
-- Table structure for table `leavetype`
--

CREATE TABLE `leavetype` (
  `id` int(11) NOT NULL,
  `leavetype` varchar(100) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leavetype`
--

INSERT INTO `leavetype` (`id`, `leavetype`, `RegDate`) VALUES
(5, 'CASUAL LEAVE', '2023-12-19 12:01:36'),
(7, 'SL', '2023-12-27 16:18:49'),
(9, 'HALF DAY', '2024-01-01 15:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `mail_log`
--

CREATE TABLE `mail_log` (
  `ID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `purpose` varchar(500) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mail_log`
--

INSERT INTO `mail_log` (`ID`, `email`, `purpose`, `log_date`) VALUES
(69, 'naradamohan1@gmail.com', 'for adding employee details.', '2023-11-25 05:13:49'),
(154, 'shinessushant@gmail.com', 'for adding employee details.', '2023-12-09 09:15:19'),
(172, '', 'for adding employee details.', '2023-12-18 06:59:39'),
(173, '19l31a1904@vignaniit.edu.in', 'for adding employee details.', '2023-12-18 08:37:26'),
(174, 'ysushant3555@gmail.com', 'for adding employee details.', '2023-12-18 08:39:34'),
(175, 'shinessushantha@gmail.com', 'for changing the login password.', '2023-12-18 09:16:23'),
(176, '19l31a1904@vignaniit.edu.in', 'for adding employee details.', '2023-12-18 09:20:03'),
(177, 'it@anikasterilis.com', 'for login link.', '2023-12-18 09:22:34'),
(178, 'shinessushantha@gmail.com', 'for login link.', '2023-12-18 09:22:46'),
(179, 'mohan.anika123@gmail.com', 'for adding employee details.', '2023-12-21 05:47:57'),
(180, 'mohan9885852424@gmail.com', 'for adding employee details.', '2023-12-21 08:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `onb`
--

CREATE TABLE `onb` (
  `ID` int(11) NOT NULL,
  `empdob` date NOT NULL,
  `empname` varchar(100) NOT NULL,
  `empemail` varchar(100) NOT NULL,
  `empms` varchar(200) NOT NULL,
  `empph` varchar(200) NOT NULL,
  `empgen` varchar(200) NOT NULL,
  `pan` varchar(200) NOT NULL,
  `adn` varchar(200) NOT NULL,
  `bn` varchar(200) NOT NULL,
  `ban` varchar(200) NOT NULL,
  `ifsc` varchar(200) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `empstatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `onb`
--

INSERT INTO `onb` (`ID`, `empdob`, `empname`, `empemail`, `empms`, `empph`, `empgen`, `pan`, `adn`, `bn`, `ban`, `ifsc`, `pic`, `status`, `empstatus`) VALUES
(29, '2001-09-02', 'SUSHANT', 'shinessushantha@gmail.com', 'Single', '8121126889', 'M', 'BAZPY5657D', '508803358129', 'BOI', '918121126889', 'PYTM0123456', 'yss.jpg', 1, 0),
(30, '2002-06-17', 'Mohan Reddy', 'naradamohan1@gmail.com', 'Single', '9885852424', 'F', 'FHSPR1826R', '2147483647', 'UBI', '122322010000365', 'UBIN0912239', 'Reddy_mohan.jpg', 1, 0),
(34, '2002-06-10', 'HENRY', 'mohan.anika123@gmail.com', 'Single', '9885852424', 'M', 'FHSPR-1826-R', '7042-2831-2797', 'BOM', '122322010000365', 'UBIN0912239', 'HENRY_edit-xxl.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pdf_table`
--

CREATE TABLE `pdf_table` (
  `id` int(11) NOT NULL,
  `pdf_content` varchar(255) NOT NULL,
  `upload_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf_table`
--

INSERT INTO `pdf_table` (`id`, `pdf_content`, `upload_timestamp`) VALUES
(8, 'uploaded_pdf_659309fc342bc.pdf', '2024-01-01 18:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `empstatus` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`ID`, `name`, `email`, `password`, `user_type`, `empstatus`) VALUES
(52, 'TECH TEAM', 'it@anikasterilis.com', '202cb962ac59075b964b07152d234b70', 'admin', '0'),
(53, 'Mr. Maan', 'prabhdeep.singh@teknoscan.co.in', '9b70e076b3b7165778a62af6b2131df8', 'admin', '0'),
(54, 'yss', 'shinessushantha@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user', '0'),
(55, 'Mohan Reddy', 'naradamohan1@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absent`
--
ALTER TABLE `absent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approver`
--
ALTER TABLE `approver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ca`
--
ALTER TABLE `ca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camsbiometricattendance`
--
ALTER TABLE `camsbiometricattendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `leavetype`
--
ALTER TABLE `leavetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_log`
--
ALTER TABLE `mail_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `onb`
--
ALTER TABLE `onb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pdf_table`
--
ALTER TABLE `pdf_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absent`
--
ALTER TABLE `absent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `approver`
--
ALTER TABLE `approver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ca`
--
ALTER TABLE `ca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `camsbiometricattendance`
--
ALTER TABLE `camsbiometricattendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `leavetype`
--
ALTER TABLE `leavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mail_log`
--
ALTER TABLE `mail_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `onb`
--
ALTER TABLE `onb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pdf_table`
--
ALTER TABLE `pdf_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
