-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 04:23 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuhome`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `code` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT 'รหัสนิสิต',
  `name` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อจริง-นามสกุล',
  `level` int(11) NOT NULL COMMENT 'ชั้นปี',
  `major` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'สาขา',
  `sex` varchar(1) CHARACTER SET utf8 NOT NULL COMMENT 'เพศ ช/ญ',
  `birthdate` date NOT NULL,
  `ID` varchar(13) CHARACTER SET utf8 NOT NULL,
  `address` varchar(150) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(15) CHARACTER SET utf8 NOT NULL,
  `picture` longblob NOT NULL,
  `parent_name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อผู้ปกครอง',
  `parent_tel` varchar(15) CHARACTER SET utf8 NOT NULL COMMENT 'เบอร์ผู้ปกครอง',
  `teacher_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
