-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 04:20 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmsgds`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `password`) VALUES
('admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `sno` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `docid` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `disease` varchar(255) NOT NULL,
  `appointmentdate` date NOT NULL,
  `appointmenttime` time NOT NULL,
  `consultancyfees` varchar(50) NOT NULL,
  `userstatus` varchar(255) NOT NULL,
  `doctorstatus` varchar(50) NOT NULL,
  `action` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`sno`, `userid`, `docid`, `specialization`, `disease`, `appointmentdate`, `appointmenttime`, `consultancyfees`, `userstatus`, `doctorstatus`, `action`) VALUES
(6, 'rahul', 'dharma', 'Neurology', 'Headache', '2021-05-29', '14:00:00', 'Rs 1500/-', '1', '1', 1),
(7, 'kan', 'Lewis Parole', 'Orthopedic', 'Back pain(10)', '2021-05-29', '12:00:00', 'Rs 1200/-', '1', '1', 1),
(10, 'venky', 'Mary Edwards', 'Physiotheraphy', 'Neck pain(5 days)', '2021-05-31', '10:00:00', 'Rs 2000/-', '1', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_doc`
--

CREATE TABLE `deleted_doc` (
  `docid` varchar(255) NOT NULL,
  `docname` varchar(255) NOT NULL,
  `specilaization` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmpassword` varchar(255) NOT NULL,
  `consultancyfees` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deleted_doc`
--

INSERT INTO `deleted_doc` (`docid`, `docname`, `specilaization`, `password`, `confirmpassword`, `consultancyfees`) VALUES
('Tom Neville', 'Dr.Tom Neville', 'Emergency', '123', '123', 'Rs 500/-');

-- --------------------------------------------------------

--
-- Table structure for table `doctable`
--

CREATE TABLE `doctable` (
  `docid` varchar(50) NOT NULL,
  `docname` varchar(50) NOT NULL,
  `specilaization` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirmpassword` varchar(50) NOT NULL,
  `consultancyfees` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctable`
--

INSERT INTO `doctable` (`docid`, `docname`, `specilaization`, `password`, `confirmpassword`, `consultancyfees`) VALUES
('Dean Thomas', 'Dr.Dean Thomas', 'Cardiology', '123', '123', 'Rs 2000/-'),
('dharma', 'Dharma Devan', 'Neurology', '123', '123', 'Rs 1500/-'),
('jagadesan', 'Jagadesan', 'Neurology', '123', '123', 'Rs 1500/-'),
('Lewis Parole', 'Dr.Lewis Parole', 'Orthopedic', '123', '123', 'Rs 1200/-'),
('Mary Edwards ', 'Dr.Mary Edwards', 'Physiotheraphy', '123', '123', 'Rs 2000/-'),
('vengadesh', 'vengadesh K S', 'Dermatology', '123', '123', 'Rs 1000/-');

--
-- Triggers `doctable`
--
DELIMITER $$
CREATE TRIGGER `deleteddoc` AFTER DELETE ON `doctable` FOR EACH ROW INSERT INTO deleted_doc VALUES(OLD.DOCID,OLD.DOCNAME,OLD.SPECILAIZATION,OLD.PASSWORD,OLD.CONFIRMPASSWORD,OLD.CONSULTANCYFEES)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pattable`
--

CREATE TABLE `pattable` (
  `fullname` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneno` bigint(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pattable`
--

INSERT INTO `pattable` (`fullname`, `userid`, `email`, `phoneno`, `password`, `gender`) VALUES
('Ganapathy Subramanian', 'ganapathyda', 'ganapathy5@gmail.com', 6385470031, '123', 'male'),
('Kamesh Babu', 'kamesh', 'kamesh212@gmail.com', 8097654320, '123', 'Male'),
('kanmani', 'kan', 'km@gmail.com', 9876543210, '123', 'Female'),
('Rahul', 'Rahul', 'Rahul@gmail.com', 8098108869, '123', 'Male'),
('Sharmila', 'sharmila', 'sharmaila@gmail.com', 123457890, '123', 'female'),
('sugasaranesh', 'suga', 'suga@gmail.com', 9876543215, '123', 'Male'),
('vengadesh', 'venky', 'venky@gmail.com', 8098108869, '123', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `sno` int(11) NOT NULL,
  `docid` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `mailid` varchar(50) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `adate` date NOT NULL,
  `atime` time NOT NULL,
  `gender` varchar(10) NOT NULL,
  `cfees` varchar(50) NOT NULL,
  `disease` varchar(50) NOT NULL,
  `medicine` varchar(50) NOT NULL,
  `meet` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`sno`, `docid`, `userid`, `fullname`, `mailid`, `mobile`, `adate`, `atime`, `gender`, `cfees`, `disease`, `medicine`, `meet`, `message`, `status`) VALUES
(3, 'dharma', 'rahul', 'Rahul', 'Rahul@gmail.com', 8098108869, '2021-05-29', '14:00:00', 'Male', 'Rs 1500/-', 'Headache', 'Advil', 'Yes', 'Take rest, massage and heat to the affected area and neck', 1),
(4, 'Lewis Parole', 'kan', 'kanmani', 'km@gmail.com', 9876543210, '2021-05-29', '12:00:00', 'Female', 'Rs 1200/-', 'Back pain(10)', 'Acetaminophen (Tylenol) ,Omnigel', 'no', 'Avoid smoking\r\n\r\nMaintain a healthy weight\r\n\r\nReduce stress which may cause muscle tension', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `doctable`
--
ALTER TABLE `doctable`
  ADD PRIMARY KEY (`docid`);

--
-- Indexes for table `pattable`
--
ALTER TABLE `pattable`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
