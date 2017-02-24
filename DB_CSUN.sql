-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2017 at 08:59 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_csun_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` smallint(6) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `club_id` smallint(6) NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `dept_id` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `video_url` text,
  `logo_url` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`club_id`, `name`, `url`, `dept_id`, `description`, `video_url`, `logo_url`) VALUES
(1, 'EMSA', 'www.emsa.com/index.html', 1, 'HOUHOUHOUHOUHOUHUHOUH', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` smallint(6) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `name`) VALUES
(1, 'Computer Science & Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_detail`
--

CREATE TABLE `meeting_detail` (
  `meeting_id` smallint(6) NOT NULL,
  `club_id` smallint(6) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `room_no` varchar(12) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_detail`
--

INSERT INTO `meeting_detail` (`meeting_id`, `club_id`, `date`, `description`, `room_no`, `time`) VALUES
(1, 1, '2017-02-15', '\r\n~~TO BECOME AN OFFICIAL SWE MEMBER~~ \r\nGoto http://societyofwomenengineers.swe.org/ and click on the membership tab. If you have any issues, email us at SWE@my.csun.edu and we will send you a step-by-step guide.', 'JD8000', '06:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `member_club`
--

CREATE TABLE `member_club` (
  `id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `club_id` smallint(6) NOT NULL,
  `dept_id` smallint(6) NOT NULL,
  `date_joined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_no` varchar(100) NOT NULL,
  `building_id` smallint(6) NOT NULL,
  `capacity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_meet`
--

CREATE TABLE `student_meet` (
  `id` smallint(6) NOT NULL,
  `meeting_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` smallint(6) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `salt` varchar(12) NOT NULL,
  `hash` char(64) NOT NULL,
  `club_id` smallint(6) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `csun_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `meeting_detail`
--
ALTER TABLE `meeting_detail`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `member_club`
--
ALTER TABLE `member_club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_no`);

--
-- Indexes for table `student_meet`
--
ALTER TABLE `student_meet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `club_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `meeting_detail`
--
ALTER TABLE `meeting_detail`
  MODIFY `meeting_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `member_club`
--
ALTER TABLE `member_club`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_meet`
--
ALTER TABLE `student_meet`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` smallint(6) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
