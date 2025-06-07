-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2023 at 03:27 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thecmss`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES
(1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com'),
(255, 'priyan', 'priyan', 'pri@gmail.com'),
(256, 'admin', 'admin@123', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `branchName` varchar(50) NOT NULL,
  PRIMARY KEY (`branchName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchName`) VALUES
('Computer Science'),
('Software Development');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course` varchar(30) DEFAULT NULL,
  `courseCode` varchar(10) DEFAULT NULL,
  `branch` varchar(20) DEFAULT NULL,
  `noSemester` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `courseCode`, `branch`, `noSemester`) VALUES
(139, 'Web Development', '001', 'Computer Science', '2');

-- --------------------------------------------------------

--
-- Table structure for table `fee_info`
--

DROP TABLE IF EXISTS `fee_info`;
CREATE TABLE IF NOT EXISTS `fee_info` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course` varchar(50) DEFAULT NULL,
  `theory` int(11) DEFAULT NULL,
  `practical` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_info`
--

INSERT INTO `fee_info` (`id`, `course`, `theory`, `practical`) VALUES
(4, 'Web Development', 550, 250);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
CREATE TABLE IF NOT EXISTS `staffs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `staffsId` varchar(10) DEFAULT NULL,
  `staffsName` varchar(50) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `accessLevel` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(10) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `course` varchar(30) DEFAULT NULL,
  `batch` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentId`, `studentName`, `course`, `batch`) VALUES
(38, '20WD12', 'tom', 'Web Development', '2020'),
(35, '20WD08', 'swartz', 'Web Development', '2020'),
(43, '20WD06', 'lily', 'Web Development', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem1_css_marks`
--

DROP TABLE IF EXISTS `webdevelopment_sem1_css_marks`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem1_css_marks` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `marks` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem1_css_marks`
--

INSERT INTO `webdevelopment_sem1_css_marks` (`id`, `studentId`, `studentName`, `subjectName`, `marks`) VALUES
(1, '20WD06', 'lily', 'CSS', '60'),
(2, '20WD08', 'swartz', 'CSS', '70');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem1_examreg`
--

DROP TABLE IF EXISTS `webdevelopment_sem1_examreg`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem1_examreg` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `course` varchar(30) DEFAULT NULL,
  `semester` varchar(30) DEFAULT NULL,
  `subjectCode` varchar(30) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `subjectType` varchar(30) DEFAULT NULL,
  `examAuthz` varchar(30) DEFAULT NULL,
  `TransactionNo` varchar(30) DEFAULT NULL,
  `TransactionDate` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem1_examreg`
--

INSERT INTO `webdevelopment_sem1_examreg` (`id`, `studentId`, `studentName`, `course`, `semester`, `subjectCode`, `subjectName`, `subjectType`, `examAuthz`, `TransactionNo`, `TransactionDate`) VALUES
(1, '20WD06', 'lily', 'Web Development', '1', '011', 'HTML', 'Theory', 'approved', 'XXXX9568', '2023-06-01'),
(2, '20WD06', 'lily', 'Web Development', '1', '012', 'CSS', 'Theory', 'approved', 'XXXX9568', '2023-06-01'),
(3, '20WD06', 'lily', 'Web Development', '1', '013', 'Java Script', 'Theory', 'approved', 'XXXX9568', '2023-06-01'),
(4, '20WD06', 'lily', 'Web Development', '1', '014', 'Working With Web Page', 'Practical', 'approved', 'XXXX9568', '2023-06-01'),
(5, '20WD08', 'swartz', 'Web Development', '1', '011', 'HTML', 'Theory', 'approved', 'XXXX9567', '2023-06-01'),
(6, '20WD08', 'swartz', 'Web Development', '1', '012', 'CSS', 'Theory', 'approved', 'XXXX9567', '2023-06-01'),
(7, '20WD08', 'swartz', 'Web Development', '1', '014', 'Working With Web Page', 'Practical', 'denied', 'XXXX9567', '2023-06-01'),
(8, '20WD08', 'swartz', 'Web Development', '1', '013', 'Java Script', 'Theory', 'approved', 'XXXX9567', '2023-06-01'),
(9, '20WD12', 'tom', 'Web Development', '1', '011', 'HTML', 'Theory', 'approved', 'XXXX9561', '2023-06-01'),
(10, '20WD12', 'tom', 'Web Development', '1', '012', 'CSS', 'Theory', 'denied', 'XXXX9561', '2023-06-01'),
(11, '20WD12', 'tom', 'Web Development', '1', '013', 'Java Script', 'Theory', 'approved', 'XXXX9561', '2023-06-01'),
(12, '20WD12', 'tom', 'Web Development', '1', '014', 'Working With Web Page', 'Practical', 'approved', 'XXXX9561', '2023-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem1_html_marks`
--

DROP TABLE IF EXISTS `webdevelopment_sem1_html_marks`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem1_html_marks` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `marks` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem1_html_marks`
--

INSERT INTO `webdevelopment_sem1_html_marks` (`id`, `studentId`, `studentName`, `subjectName`, `marks`) VALUES
(1, '20WD08', 'swartz', 'HTML', '70'),
(2, '20WD12', 'tom', 'HTML', '80'),
(3, '20WD06', 'lily', 'HTML', '60');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem1_javascript_marks`
--

DROP TABLE IF EXISTS `webdevelopment_sem1_javascript_marks`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem1_javascript_marks` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `marks` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem1_javascript_marks`
--

INSERT INTO `webdevelopment_sem1_javascript_marks` (`id`, `studentId`, `studentName`, `subjectName`, `marks`) VALUES
(1, '20WD08', 'swartz', 'JavaScript', '60'),
(2, '20WD12', 'tom', 'JavaScript', '70'),
(3, '20WD06', 'lily', 'JavaScript', '80');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem1_subjects`
--

DROP TABLE IF EXISTS `webdevelopment_sem1_subjects`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem1_subjects` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(30) DEFAULT NULL,
  `subjectCode` varchar(30) DEFAULT NULL,
  `subjectType` varchar(30) DEFAULT NULL,
  `fee` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem1_subjects`
--

INSERT INTO `webdevelopment_sem1_subjects` (`id`, `subjectName`, `subjectCode`, `subjectType`, `fee`) VALUES
(1, 'HTML', '011', 'Theory', NULL),
(2, 'CSS', '012', 'Theory', NULL),
(3, 'Java Script', '013', 'Theory', NULL),
(4, 'Working With Web Page', '014', 'Practical', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem1_workingwithwebpage_marks`
--

DROP TABLE IF EXISTS `webdevelopment_sem1_workingwithwebpage_marks`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem1_workingwithwebpage_marks` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `marks` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem1_workingwithwebpage_marks`
--

INSERT INTO `webdevelopment_sem1_workingwithwebpage_marks` (`id`, `studentId`, `studentName`, `subjectName`, `marks`) VALUES
(1, '20WD06', 'lily', 'WorkingWithWebPage', '90'),
(2, '20WD12', 'tom', 'WorkingWithWebPage', '90');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem2_examreg`
--

DROP TABLE IF EXISTS `webdevelopment_sem2_examreg`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem2_examreg` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `course` varchar(30) DEFAULT NULL,
  `semester` varchar(30) DEFAULT NULL,
  `subjectCode` varchar(30) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `subjectType` varchar(30) DEFAULT NULL,
  `examAuthz` varchar(30) DEFAULT NULL,
  `TransactionNo` varchar(30) DEFAULT NULL,
  `TransactionDate` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem2_examreg`
--

INSERT INTO `webdevelopment_sem2_examreg` (`id`, `studentId`, `studentName`, `course`, `semester`, `subjectCode`, `subjectName`, `subjectType`, `examAuthz`, `TransactionNo`, `TransactionDate`) VALUES
(1, '20WD06', 'lily', 'Web Development', '2', '021', 'PHP', 'Theory', 'approved', 'XXXX8564', '2024-01-20'),
(2, '20WD06', 'lily', 'Web Development', '2', '022', 'SQL', 'Theory', 'approved', 'XXXX8564', '2024-01-20'),
(3, '20WD06', 'lily', 'Web Development', '2', '023', 'Working With Backend', 'Practical', 'denied', 'XXXX8564', '2024-01-20'),
(4, '20WD08', 'swartz', 'Web Development', '2', '021', 'PHP', 'Theory', 'approved', 'XXXX8569', '2024-01-16'),
(5, '20WD08', 'swartz', 'Web Development', '2', '022', 'SQL', 'Theory', 'approved', 'XXXX8569', '2024-01-16'),
(6, '20WD08', 'swartz', 'Web Development', '2', '023', 'Working With Backend', 'Practical', 'approved', 'XXXX8569', '2024-01-16'),
(7, '20WD12', 'tom', 'Web Development', '2', '021', 'PHP', 'Theory', 'denied', 'XXXX8561', '2024-01-16'),
(8, '20WD12', 'tom', 'Web Development', '2', '022', 'SQL', 'Theory', 'approved', 'XXXX8561', '2024-01-16'),
(9, '20WD12', 'tom', 'Web Development', '2', '023', 'Working With Backend', 'Practical', 'approved', 'XXXX8561', '2024-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem2_php_marks`
--

DROP TABLE IF EXISTS `webdevelopment_sem2_php_marks`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem2_php_marks` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `marks` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem2_php_marks`
--

INSERT INTO `webdevelopment_sem2_php_marks` (`id`, `studentId`, `studentName`, `subjectName`, `marks`) VALUES
(1, '20WD08', 'swartz', 'PHP', '80'),
(2, '20WD06', 'lily', 'PHP', '70');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem2_sql_marks`
--

DROP TABLE IF EXISTS `webdevelopment_sem2_sql_marks`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem2_sql_marks` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `marks` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem2_sql_marks`
--

INSERT INTO `webdevelopment_sem2_sql_marks` (`id`, `studentId`, `studentName`, `subjectName`, `marks`) VALUES
(1, '20WD06', 'lily', 'SQL', '80'),
(2, '20WD12', 'tom', 'SQL', '70');

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem2_subjects`
--

DROP TABLE IF EXISTS `webdevelopment_sem2_subjects`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem2_subjects` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(30) DEFAULT NULL,
  `subjectCode` varchar(30) DEFAULT NULL,
  `subjectType` varchar(30) DEFAULT NULL,
  `fee` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem2_subjects`
--

INSERT INTO `webdevelopment_sem2_subjects` (`id`, `subjectName`, `subjectCode`, `subjectType`, `fee`) VALUES
(1, 'PHP', '021', 'Theory', NULL),
(2, 'SQL', '022', 'Theory', NULL),
(3, 'Working With Backend', '023', 'Practical', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `webdevelopment_sem2_workingwithbackend_marks`
--

DROP TABLE IF EXISTS `webdevelopment_sem2_workingwithbackend_marks`;
CREATE TABLE IF NOT EXISTS `webdevelopment_sem2_workingwithbackend_marks` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentId` varchar(30) DEFAULT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `subjectName` varchar(30) DEFAULT NULL,
  `marks` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webdevelopment_sem2_workingwithbackend_marks`
--

INSERT INTO `webdevelopment_sem2_workingwithbackend_marks` (`id`, `studentId`, `studentName`, `subjectName`, `marks`) VALUES
(1, '20WD08', 'swartz', 'WorkingWithBackend', '90'),
(2, '20WD12', 'tom', 'WorkingWithBackend', '90');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
