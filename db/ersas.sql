-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2021 at 05:51 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ersas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `email`, `password`) VALUES
(1, 'admin@ersas.ur', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allot`
--

CREATE TABLE `tbl_allot` (
  `allot_id` int(11) NOT NULL,
  `exam` varchar(255) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL,
  `invig` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_allot`
--

INSERT INTO `tbl_allot` (`allot_id`, `exam`, `room`, `invig`) VALUES
(2, '2', '5', '2'),
(3, '3', '6', '3'),
(4, '4', '6', '3'),
(5, '5', '7', '4'),
(6, '6', '7', '2'),
(7, '1', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE `tbl_exam` (
  `exam_id` int(11) NOT NULL,
  `course` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `etime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_exam`
--

INSERT INTO `tbl_exam` (`exam_id`, `course`, `dept`, `year`, `edate`, `etime`) VALUES
(1, 'Java', 'IS', '4', '2020-11-30', '14:10:00'),
(2, 'C++', 'IT', '3', '2020-12-03', '16:10:00'),
(3, 'GIS', 'IT', '2', '2020-11-30', '09:40:00'),
(4, 'Math for engineers', 'CS', '1', '2020-12-01', '14:00:00'),
(5, 'Web design', 'IS', '3', '2020-12-01', '10:40:00'),
(6, 'Web dev', 'IT', '4', '2020-12-10', '10:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invigilator`
--

CREATE TABLE `tbl_invigilator` (
  `invig_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invigilator`
--

INSERT INTO `tbl_invigilator` (`invig_id`, `firstname`, `lastname`, `dept`) VALUES
(1, 'John', 'Munyakayanza', 'IS'),
(2, 'Pelin', 'Mutanguha', 'IT'),
(3, 'Frank', 'Irakoze', 'CS'),
(4, 'Christine', 'Kanyana', 'IS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE `tbl_registration` (
  `reg_id` int(11) NOT NULL,
  `status` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`reg_id`, `status`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `room_id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `room_no` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`room_id`, `location`, `room_no`, `capacity`) VALUES
(1, 'KIST2', 120, 30),
(2, 'CMHS', 101, 50),
(3, 'KIST1', 102, 50),
(5, 'KIST2', 115, 110),
(6, 'Muhabura', 301, 150),
(7, 'KIST1', 105, 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `stu_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `regno` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `exam` int(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`stu_id`, `firstname`, `lastname`, `regno`, `dept`, `year`, `exam`, `token`) VALUES
(1, 'Ange', 'Kanyana', '217000', 'IS', '4', 1, '101'),
(2, 'John', 'Kakuba', '217002', 'IT', '3', 2, '101'),
(3, 'Sandra', 'Sinzi', '217003', 'IS', '4', 1, '102'),
(4, 'Charmante', 'Keza', '217009', 'CS', '2', 3, '101'),
(5, 'Ange', 'Kanyana', '217000', 'IS', '4', 4, '101'),
(6, 'Germain', 'Ntwali', '217010', 'IS', '3', 5, '101'),
(7, 'Jesse', 'Cyusa', '217011', 'IS', '4', 5, '102'),
(8, 'Chantal', 'Dusabe', '217012', 'IS', '3', 5, '103'),
(9, 'Kanyana', 'Ange', '217000', 'IT', '4', 6, '101'),
(10, 'Roger', 'Mizero', '2323534', 'CS', '4', 6, '102');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_allot`
--
ALTER TABLE `tbl_allot`
  ADD PRIMARY KEY (`allot_id`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `tbl_invigilator`
--
ALTER TABLE `tbl_invigilator`
  ADD PRIMARY KEY (`invig_id`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`stu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_allot`
--
ALTER TABLE `tbl_allot`
  MODIFY `allot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_invigilator`
--
ALTER TABLE `tbl_invigilator`
  MODIFY `invig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
