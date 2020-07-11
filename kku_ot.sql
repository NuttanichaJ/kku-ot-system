-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2020 at 03:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kku_ot`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr_master`
--

CREATE TABLE `hr_master` (
  `HR_ID` int(10) UNSIGNED NOT NULL,
  `PREFIX_2` varchar(50) NOT NULL,
  `PREFIX` varchar(20) NOT NULL,
  `HR_NAME` varchar(60) NOT NULL,
  `HR_SURNAME` varchar(60) NOT NULL,
  `CITIZEN_ID` varchar(30) NOT NULL,
  `STATUS` varchar(200) NOT NULL,
  `HR_FULL` varchar(255) NOT NULL,
  `FACULTY_ID` int(10) NOT NULL,
  `FACULTY_NAME` varchar(255) NOT NULL,
  `WORK_PLACE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hr_master`
--

INSERT INTO `hr_master` (`HR_ID`, `PREFIX_2`, `PREFIX`, `HR_NAME`, `HR_SURNAME`, `CITIZEN_ID`, `STATUS`, `HR_FULL`, `FACULTY_ID`, `FACULTY_NAME`, `WORK_PLACE`) VALUES
(10, 'POSITON1', '', 'NAME1', 'SURNAME1', '', '', '', 1, 'FACULTY1', 'WORK_PLACE1'),
(20, 'POSITON2', '', 'NAME2', 'SURNAME2', '', '', '', 2, 'FACULTY2', 'WORK_PLACE2'),
(30, 'POSITION3', '', 'NAME3', 'SURNAME3', '', '', '', 1, 'FACULTY1', 'WORK_PLACE1');

-- --------------------------------------------------------

--
-- Table structure for table `ot_holiday`
--

CREATE TABLE `ot_holiday` (
  `FACULTY_ID` int(11) NOT NULL,
  `HOLIDAY_DATE` date NOT NULL,
  `HOLIDAY_DESC` varchar(255) NOT NULL,
  `CAN_WORK` varchar(1) NOT NULL,
  `CREATE_BY` varchar(50) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `CREATE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ot_holiday`
--

INSERT INTO `ot_holiday` (`FACULTY_ID`, `HOLIDAY_DATE`, `HOLIDAY_DESC`, `CAN_WORK`, `CREATE_BY`, `CREATE_DATE`, `CREATE_ID`) VALUES
(1, '2020-07-01', 'วันหยุด', 'N', 'HR1', '2020-07-10 17:45:38', 1),
(2, '2020-07-01', 'วันหยุด', 'Y', 'HR2', '2020-07-10 18:41:41', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ot_item`
--

CREATE TABLE `ot_item` (
  `ITEM_ID` int(10) UNSIGNED NOT NULL,
  `OT_ID` int(10) UNSIGNED NOT NULL,
  `OT_TYPE` varchar(1) NOT NULL,
  `ITEM_STATUS` int(11) NOT NULL,
  `HR_ID` int(11) NOT NULL,
  `STUDENT_CODE` varchar(13) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `SURNAME` varchar(50) NOT NULL,
  `POSITION_NAME` varchar(255) NOT NULL,
  `WORK_DATE` date NOT NULL,
  `HOLIDAY` varchar(1) NOT NULL,
  `WORK_FROM` time NOT NULL,
  `TIME_FROM_ID` int(11) NOT NULL,
  `TIME_TO_ID` int(11) NOT NULL,
  `WORK_TO` time NOT NULL,
  `AMOUNT` int(11) NOT NULL,
  `CREATE_BY` varchar(50) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `CREATE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ot_item`
--

INSERT INTO `ot_item` (`ITEM_ID`, `OT_ID`, `OT_TYPE`, `ITEM_STATUS`, `HR_ID`, `STUDENT_CODE`, `NAME`, `SURNAME`, `POSITION_NAME`, `WORK_DATE`, `HOLIDAY`, `WORK_FROM`, `TIME_FROM_ID`, `TIME_TO_ID`, `WORK_TO`, `AMOUNT`, `CREATE_BY`, `CREATE_DATE`, `CREATE_ID`) VALUES
(1, 2, '1', 5, 10, '', 'NAME1', 'SURNAME1', 'POSITON1', '2020-07-02', '', '19:51:00', 0, 0, '23:51:00', 200, 'HR1', '2020-07-10 19:51:20', 1),
(2, 2, '1', 5, 10, '', 'NAME1', 'SURNAME1', 'POSITON1', '2020-07-02', '', '17:50:00', 0, 0, '18:50:00', 200, 'HR1', '2020-07-11 16:50:16', 1),
(3, 2, '1', 5, 10, '', 'NAME1', 'SURNAME1', 'POSITON1', '2020-06-15', '', '21:54:00', 0, 0, '12:54:00', 420, 'HR1', '2020-07-11 19:54:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ot_project`
--

CREATE TABLE `ot_project` (
  `OT_ID` int(10) UNSIGNED NOT NULL,
  `OT_NAME` varchar(255) NOT NULL,
  `OT_DESC` longtext NOT NULL,
  `OT_TYPE` varchar(1) NOT NULL,
  `OT_OWNER` varchar(255) NOT NULL,
  `SIGNER` varchar(255) NOT NULL,
  `TOTAL_AMOUNT` int(10) UNSIGNED NOT NULL,
  `OT_STATUS` int(11) NOT NULL,
  `CREATE_BY` varchar(50) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_BY` varchar(50) NOT NULL,
  `UPDATE_DATE` datetime NOT NULL,
  `CREATE_ID` int(11) NOT NULL,
  `CREATE_USER_TEXT` varchar(255) NOT NULL,
  `FACULTY_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ot_project`
--

INSERT INTO `ot_project` (`OT_ID`, `OT_NAME`, `OT_DESC`, `OT_TYPE`, `OT_OWNER`, `SIGNER`, `TOTAL_AMOUNT`, `OT_STATUS`, `CREATE_BY`, `CREATE_DATE`, `UPDATE_BY`, `UPDATE_DATE`, `CREATE_ID`, `CREATE_USER_TEXT`, `FACULTY_ID`) VALUES
(1, 'โครงการ1 ของ HR1', '', '', 'NAME1 SURNAME1', '', 0, 0, 'HR1', '2020-07-10 17:41:40', '', '0000-00-00 00:00:00', 1, 'NAME1 SURNAME1', 1),
(2, 'โครงการ2 ของ HR1', '', '', 'NAME1 SURNAME1', '', 820, 0, 'HR1', '2020-07-10 17:42:07', 'HR1', '2020-07-11 19:54:37', 1, 'NAME1 SURNAME1', 1),
(3, 'โครงการ1 ของ HR2.', '', '', 'NAME2 SURNAME2', '', 0, 0, 'HR2', '2020-07-10 18:10:38', '', '0000-00-00 00:00:00', 2, 'NAME2 SURNAME2', 2),
(4, 'โครงการ2 ของ HR2', '', '', 'NAME2 SURNAME2', '', 0, 0, 'HR2', '2020-07-10 18:10:51', '', '0000-00-00 00:00:00', 2, 'NAME2 SURNAME2', 2),
(5, 'โครงการ1 ของ HR3', '', '', 'NAME3 SURNAME3', '', 0, 0, 'HR3', '2020-07-10 18:47:19', '', '0000-00-00 00:00:00', 3, 'NAME3 SURNAME3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ot_type`
--

CREATE TABLE `ot_type` (
  `OTTYPE_ID` int(11) NOT NULL,
  `OT_TYPE` int(1) NOT NULL,
  `OTTYPE_NAME` varchar(255) NOT NULL,
  `OTTYPE_RATE` int(11) NOT NULL,
  `CREATE_BY` varchar(255) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `CREATE_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ot_type`
--

INSERT INTO `ot_type` (`OTTYPE_ID`, `OT_TYPE`, `OTTYPE_NAME`, `OTTYPE_RATE`, `CREATE_BY`, `CREATE_DATE`, `CREATE_ID`) VALUES
(1, 1, 'กรณีวันปกติ', 200, 'HR1', '2020-07-10 17:43:21', 1),
(2, 1, 'กรณีวันหยุดราชการ', 420, 'HR1', '2020-07-10 17:44:10', 1),
(3, 2, 'สอบ', 100, 'HR1', '2020-07-10 17:44:39', 1),
(4, 3, 'ทำpart-time', 50, 'HR1', '2020-07-10 17:45:02', 1),
(5, 1, 'กรณีวันปกติ2', 200, 'HR2', '2020-07-10 18:16:59', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE `sys_user` (
  `USER_ID` int(11) UNSIGNED NOT NULL,
  `HR_ID` int(10) NOT NULL,
  `USER_NAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `HR_NAME` varchar(60) NOT NULL,
  `HR_SURNAME` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`USER_ID`, `HR_ID`, `USER_NAME`, `PASSWORD`, `HR_NAME`, `HR_SURNAME`) VALUES
(1, 10, 'HR1', '123', 'NAME1', 'SURNAME1'),
(2, 20, 'HR2', '123', 'NAME2', 'SURNAME2'),
(3, 30, 'HR3', '123', 'NAME3', 'SURNAME3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hr_master`
--
ALTER TABLE `hr_master`
  ADD PRIMARY KEY (`HR_ID`);

--
-- Indexes for table `ot_holiday`
--
ALTER TABLE `ot_holiday`
  ADD PRIMARY KEY (`FACULTY_ID`,`HOLIDAY_DATE`);

--
-- Indexes for table `ot_item`
--
ALTER TABLE `ot_item`
  ADD PRIMARY KEY (`ITEM_ID`,`OT_ID`);

--
-- Indexes for table `ot_project`
--
ALTER TABLE `ot_project`
  ADD PRIMARY KEY (`OT_ID`);

--
-- Indexes for table `ot_type`
--
ALTER TABLE `ot_type`
  ADD PRIMARY KEY (`OTTYPE_ID`);

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
