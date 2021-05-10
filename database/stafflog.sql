-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 12, 2019 at 03:07 PM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stafflog`
--

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `fieldID` bigint(5) NOT NULL AUTO_INCREMENT,
  `fieldName` varchar(50) NOT NULL,
  PRIMARY KEY (`fieldID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`fieldID`, `fieldName`) VALUES
(1, 'Yes'),
(2, 'No');
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `accesstype`
--

DROP TABLE IF EXISTS `accesstype`;
CREATE TABLE IF NOT EXISTS `accesstype` (
  `accessID` bigint(5) NOT NULL,
  `accessDesc` varchar(255) NOT NULL,
  PRIMARY KEY (`accessID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesstype`
--

INSERT INTO `accesstype` (`accessID`, `accessDesc`) VALUES
(0, 'Super Admin'),
(1, 'Regular HR Admin'),
(2, 'Security'),
(3, 'Disabled User');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `DeptID` bigint(20) NOT NULL AUTO_INCREMENT,
  `deptName` varchar(255) NOT NULL,
  PRIMARY KEY (`DeptID`),
  UNIQUE KEY `deptName_UNIQUE` (`deptName`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DeptID`, `deptName`) VALUES
(1, 'Accounts'),
(2, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `empattendance`
--

DROP TABLE IF EXISTS `empattendance`;
CREATE TABLE IF NOT EXISTS `empattendance` (
  `attID` int(11) NOT NULL AUTO_INCREMENT,
  `empID` bigint(20) DEFAULT NULL,
  `attendance` tinyint(1) DEFAULT NULL,
  `DateIN` date DEFAULT NULL,
  `TimeIN` time DEFAULT NULL,
  `TimeOUT` time DEFAULT NULL,
  PRIMARY KEY (`attID`),
  KEY `empAttRecord` (`empID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empattendance`
--

INSERT INTO `empattendance` (`attID`, `empID`, `attendance`, `DateIN`, `TimeIN`, `TimeOUT`) VALUES
(1, 2159, 1, '2019-06-04', '02:30:00', NULL),
(2, 2006, 1, '2019-06-04', '16:38:00', NULL),
(3, 2013, 1, '2019-06-04', '16:46:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `empID` bigint(20) NOT NULL,
  `empFirstName` varchar(255) DEFAULT NULL,
  `empLastName` varchar(255) DEFAULT NULL,
  `deptID` bigint(20) DEFAULT NULL,
  `typeID` int(11) DEFAULT NULL,
  `empPosition` varchar(255) DEFAULT NULL,
  `empAddress` varchar(255) DEFAULT NULL,
  `empGender` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `empPhoto` varchar(255) DEFAULT NULL,
  `empStatus` varchar(11) DEFAULT NULL,
  `empStartDate` date DEFAULT NULL,
  `empEndDate` date DEFAULT NULL,
  PRIMARY KEY (`empID`),
  KEY `deptID_idx` (`deptID`),
  KEY `typeID_idx` (`typeID`),
  KEY `userID_idx` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empID`, `empFirstName`, `empLastName`, `deptID`, `typeID`, `empPosition`, `empAddress`, `empGender`, `created_date`, `created_by`, `empPhoto`, `empStatus`, `empStartDate`, `empEndDate`) VALUES
(12, 'Carol', 'Lewis', 11, 5, 'Driver', 'Fern Hill District \r\nLawrence Tavern P.O.\r\nSt. Andrew', 'Female', '2019-02-25 12:08:47', 24, '', NULL, '2019-02-25', NULL),
(22, 'Suzie', 'Jennings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `employee`
--
DROP TRIGGER IF EXISTS `employee_AFTER_DELETE`;
DELIMITER $$
CREATE TRIGGER `employee_AFTER_DELETE` AFTER DELETE ON `employee` FOR EACH ROW BEGIN
INSERT INTO employees_audit
    SET action = 'Record Deleted',
		empNo = OLD.empID,
		firstname = OLD.empFirstName,
        lastname = OLD.empLastName,
        updated_by = OLD.created_by,
        changedat = NOW(); 
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `employee_AFTER_INSERT`;
DELIMITER $$
CREATE TRIGGER `employee_AFTER_INSERT` AFTER INSERT ON `employee` FOR EACH ROW BEGIN
INSERT INTO employees_audit
SET 
empNo = NEW.empID, 
firstname = NEW.empFirstName, 
lastname = NEW.empLastName, 
changedat = NOW(), 
updated_by = NEW.created_by,
action = 'New Record';
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `employee_BEFORE_UPDATE`;
DELIMITER $$
CREATE TRIGGER `employee_BEFORE_UPDATE` BEFORE UPDATE ON `employee` FOR EACH ROW BEGIN
INSERT INTO employees_audit
    SET action = 'Record Updated',
     empNo = OLD.empID,
		firstname = OLD.empFirstName,
        lastname = OLD.empLastName,
        updated_by = NEW.created_by,
        changedat = NOW(); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees_audit`
--

DROP TABLE IF EXISTS `employees_audit`;
CREATE TABLE IF NOT EXISTS `employees_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empNo` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `changedat` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=317 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees_audit`
--

INSERT INTO `employees_audit` (`id`, `empNo`, `firstname`, `lastname`, `changedat`, `updated_by`, `action`) VALUES
(1, 12, 'Carol', 'Lewis', '2018-12-19 11:44:47', 0, 'Record updated');

-- --------------------------------------------------------

--
-- Table structure for table `employeetype`
--

DROP TABLE IF EXISTS `employeetype`;
CREATE TABLE IF NOT EXISTS `employeetype` (
  `typeID` int(11) NOT NULL AUTO_INCREMENT,
  `employeeType` varchar(55) NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employeetype`
--

INSERT INTO `employeetype` (`typeID`, `employeeType`) VALUES
(2, 'Contract'),
(3, 'Full-Time'),
(4, 'Part-Time'),
(5, 'Seasonal');

-- --------------------------------------------------------

--
-- Table structure for table `logtbl`
--

DROP TABLE IF EXISTS `logtbl`;
CREATE TABLE IF NOT EXISTS `logtbl` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `empID` bigint(20) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `dateIN` date DEFAULT NULL,
  `timeIN` time DEFAULT NULL,
  `dateOUT` date DEFAULT NULL,
  `timeOUT` time DEFAULT NULL,
  `licNumber` varchar(25) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`logID`),
  KEY `user_idx` (`userID`),
  KEY `empID_idx` (`empID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logtbl`
--

INSERT INTO `logtbl` (`logID`, `empID`, `userID`, `dateIN`, `timeIN`, `dateOUT`, `timeOUT`, `licNumber`, `comments`) VALUES
(1, 2159, 2, '2019-06-04', '02:30:00', '2019-06-04', '16:46:00', '2265FV', ''),
(3, 2006, 2, '2019-06-04', '16:38:00', '2019-06-04', '16:42:00', 'gewgg3', ''),
(4, 2013, 2, '2019-06-04', '16:46:00', '2019-06-04', '16:47:00', '', '');

--
-- Triggers `logtbl`
--
DROP TRIGGER IF EXISTS `logTBL_AFTER_DELETE`;
DELIMITER $$
CREATE TRIGGER `logTBL_AFTER_DELETE` AFTER DELETE ON `logtbl` FOR EACH ROW BEGIN
INSERT INTO TBL_logAudit
SET action = 'Record Deleted',
empID = OLD.empID,
dateIN = OLD.dateIN, 
timeIN = OLD.timeIN, 
dateOUT = OLD.dateOUT, 
timeOUT = OLD.timeOUT,
licNumber = OLD.licNumber,
userID = OLD.userID,
changeDate = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `logTBL_AFTER_INSERT`;
DELIMITER $$
CREATE TRIGGER `logTBL_AFTER_INSERT` AFTER INSERT ON `logtbl` FOR EACH ROW BEGIN
INSERT INTO TBL_logAudit
SET 
empID = NEW.empID, 
dateIN = NEW.dateIN, 
timeIN = NEW.timeIN, 
dateOUT = NEW.dateOUT, 
timeOUT = NEW.timeOUT,
licNumber = NEW.licNumber,
changeDate = NOW(), 
userID = NEW.userID,
action = 'New Record';
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `logTBL_AFTER_UPDATE`;
DELIMITER $$
CREATE TRIGGER `logTBL_AFTER_UPDATE` AFTER UPDATE ON `logtbl` FOR EACH ROW BEGIN
INSERT INTO TBL_logAudit
SET 
empID = OLD.empID,
dateIN = OLD.dateIN, 
timeIN = OLD.timeIN, 
dateOUT = NEW.dateOUT, 
timeOUT = NEW.timeOUT,
licNumber = OLD.licNumber,
userID = OLD.userID,
changeDate = NOW(), 
action = 'Log Record Updated';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logaudit`
--

DROP TABLE IF EXISTS `tbl_logaudit`;
CREATE TABLE IF NOT EXISTS `tbl_logaudit` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `empID` int(11) DEFAULT NULL,
  `dateIN` date DEFAULT NULL,
  `timeIN` time DEFAULT NULL,
  `dateOUT` date DEFAULT NULL,
  `timeOUT` time DEFAULT NULL,
  `licNumber` varchar(25) DEFAULT NULL,
  `changeDate` datetime DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`logID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_logaudit`
--

INSERT INTO `tbl_logaudit` (`logID`, `empID`, `dateIN`, `timeIN`, `dateOUT`, `timeOUT`, `licNumber`, `changeDate`, `userID`, `action`) VALUES
(1, 2159, '2019-06-04', '02:30:00', NULL, NULL, '2265FV', '2019-06-04 14:16:38', 2, 'New Record'),
(2, 2159, '2019-06-04', '02:30:00', '2019-06-04', '16:00:00', '2265FV', '2019-06-04 14:20:42', 2, 'Log Record Updated'),
(3, 2006, '2019-06-04', '16:38:00', NULL, NULL, 'gewgg3', '2019-06-04 16:38:25', 2, 'New Record'),
(4, 2006, '2019-06-04', '16:38:00', '2019-06-04', '16:41:00', 'gewgg3', '2019-06-04 16:41:54', 2, 'Log Record Updated'),
(5, 2006, '2019-06-04', '16:38:00', '2019-06-04', '16:42:00', 'gewgg3', '2019-06-04 16:42:57', 2, 'Log Record Updated'),
(6, 2159, '2019-06-04', '02:30:00', '2019-06-04', '16:46:00', '2265FV', '2019-06-04 16:46:24', 2, 'Log Record Updated'),
(7, 2013, '2019-06-04', '16:46:00', NULL, NULL, '', '2019-06-04 16:46:57', 2, 'New Record'),
(8, 2013, '2019-06-04', '16:46:00', '2019-06-04', '16:47:00', '', '2019-06-04 16:47:13', 2, 'Log Record Updated');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` longtext NOT NULL,
  `user_registered` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `firstname`, `lastname`, `username`, `password`, `user_registered`, `last_login`, `access`) VALUES
(1, 'Admin', 'User', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-12-19 00:00:00', '2019-06-12 08:05:28', 0);

--
-- Triggers `user`
--
DROP TRIGGER IF EXISTS `user_BEFORE_UPDATE`;
DELIMITER $$
CREATE TRIGGER `user_BEFORE_UPDATE` BEFORE UPDATE ON `user` FOR EACH ROW BEGIN
INSERT INTO user_log
	SET ACTION = 'loggedin',
    userID = OLD.userID,
    username = OLD.username,
    lastlogin = NOW(); 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
CREATE TABLE IF NOT EXISTS `user_log` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`logID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`logID`, `userID`, `userName`, `lastLogin`, `action`) VALUES
(1, 3, 'admin', '2019-02-26 16:23:28', 'loggedin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `empattendance`
--
ALTER TABLE `empattendance`
  ADD CONSTRAINT `empAttRecord` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `deptID` FOREIGN KEY (`deptID`) REFERENCES `departments` (`DeptID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empType` FOREIGN KEY (`typeID`) REFERENCES `employeetype` (`typeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userID` FOREIGN KEY (`created_by`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `logtbl`
--
ALTER TABLE `logtbl`
  ADD CONSTRAINT `EmpID` FOREIGN KEY (`empID`) REFERENCES `employee` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`userID`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
