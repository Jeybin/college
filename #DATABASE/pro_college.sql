-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2017 at 06:50 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro_college`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `assignedclasses`
--

DROP TABLE IF EXISTS `assignedclasses`;
CREATE TABLE IF NOT EXISTS `assignedclasses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignedclasses`
--

INSERT INTO `assignedclasses` (`id`, `teacher`, `courseid`, `semester`) VALUES
(2, 6, 3, 2),
(4, 6, 14, 6),
(6, 6, 15, 1),
(7, 7, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `assignedsubjects`
--

DROP TABLE IF EXISTS `assignedsubjects`;
CREATE TABLE IF NOT EXISTS `assignedsubjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacherid` int(11) NOT NULL,
  `subjects` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignedsubjects`
--

INSERT INTO `assignedsubjects` (`id`, `teacherid`, `subjects`) VALUES
(1, 7, '4,3,2,1');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentssubmited`
--

DROP TABLE IF EXISTS `assignmentssubmited`;
CREATE TABLE IF NOT EXISTS `assignmentssubmited` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignmentid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `assigment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentssubmited`
--

INSERT INTO `assignmentssubmited` (`id`, `assignmentid`, `studentid`, `assigment`) VALUES
(1, 3, 1, ''),
(2, 3, 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

DROP TABLE IF EXISTS `attendence`;
CREATE TABLE IF NOT EXISTS `attendence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `period` text NOT NULL,
  `attendence` text NOT NULL,
  `teacher` int(11) NOT NULL,
  `attendencedate` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `studentid`, `subjectid`, `period`, `attendence`, `teacher`, `attendencedate`) VALUES
(1, 2, 1, '1', 'present', 7, '2017-03-18'),
(2, 5, 1, '1', 'absent', 7, '2017-03-18'),
(3, 7, 1, '1', 'present', 7, '2017-03-18'),
(4, 1, 1, '1', 'present', 7, '2017-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL,
  `course` text NOT NULL,
  `course_duration` text NOT NULL,
  `allotedseats` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department`, `course`, `course_duration`, `allotedseats`) VALUES
(1, 7, 'Diploma in Computer Engineering', '3', 3),
(3, 7, 'Diploma in Computer Hardware and Maintenance', '6', 20),
(4, 8, 'Electronic and communication', '6', 10),
(5, 8, 'Applied electrnics', '6', 55),
(6, 8, 'Communication systems', '4', 60),
(7, 8, 'Instrumentation', '2', 30),
(8, 7, 'Computer  science', '6', 45),
(9, 7, 'B.sc computer science', '6', 35),
(10, 7, 'M.sc Computer science', '4', 70),
(11, 7, 'Bca', '6', 25),
(12, 7, 'MCA', '4', 5),
(14, 9, 'Abc Robo', '6', 50),
(15, 11, 'Test 1', '6', 50);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(7, 'Computer'),
(8, 'Eletronics'),
(9, 'Robotics'),
(11, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `hods`
--

DROP TABLE IF EXISTS `hods`;
CREATE TABLE IF NOT EXISTS `hods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hods`
--

INSERT INTO `hods` (`id`, `department`, `teacher`) VALUES
(4, 7, 5),
(5, 11, 10);

-- --------------------------------------------------------

--
-- Table structure for table `internalmarks`
--

DROP TABLE IF EXISTS `internalmarks`;
CREATE TABLE IF NOT EXISTS `internalmarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `mark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internalmarks`
--

INSERT INTO `internalmarks` (`id`, `studentid`, `subjectid`, `semester`, `mark`) VALUES
(1, 2, 4, 1, '9'),
(2, 7, 4, 1, '8'),
(3, 1, 4, 1, '4'),
(4, 5, 4, 1, '4');

-- --------------------------------------------------------

--
-- Table structure for table `parentsdetails`
--

DROP TABLE IF EXISTS `parentsdetails`;
CREATE TABLE IF NOT EXISTS `parentsdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) NOT NULL,
  `guardianname` text NOT NULL,
  `guardianrelation` text NOT NULL,
  `guardianjob` text NOT NULL,
  `mailid` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `mailverification` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parentsdetails`
--

INSERT INTO `parentsdetails` (`id`, `studentid`, `guardianname`, `guardianrelation`, `guardianjob`, `mailid`, `phone`, `password`, `mailverification`) VALUES
(1, 1, 'Lewis Pate', 'Et necessitatibus lorem hic in qui temporibus mollit incididunt expedita', 'Perspiciatis recusandae Dolores sequi delectus esse dolorem duis et qui facere quasi cumque laboris', 'neqecuciqo@yahoo.com', 'cf9c24', '+736-22-5795354', 'not verified'),
(2, 8, 'Lawrence Wilkinson', 'Reiciendis et impedit qui consequuntur quia voluptas nemo adipisci expedita qui sapiente sit commodi commodo repudiandae fugit eaque quo expedita', 'In non voluptatibus consequatur Hic', 'kepinohom@gmail.com', '849c13', '+162-88-4566498', 'not verified');

-- --------------------------------------------------------

--
-- Table structure for table `postedassignments`
--

DROP TABLE IF EXISTS `postedassignments`;
CREATE TABLE IF NOT EXISTS `postedassignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subjectid` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `heading` text NOT NULL,
  `description` text NOT NULL,
  `posteddate` text NOT NULL,
  `lastdate` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postedassignments`
--

INSERT INTO `postedassignments` (`id`, `subjectid`, `semester`, `teacherid`, `course`, `heading`, `description`, `posteddate`, `lastdate`) VALUES
(4, 1, 1, 4, 3, 'Accusantium nihil voluptate in omnis velit minim enim quidem', 'Nesciunt, blanditiis harum voluptatum aut dicta dolorem cupidatat sit, cumque.', '2017-03-17', '2017-03-30'),
(3, 1, 1, 4, 3, 'Test 3', 'Sit, anim fuga. Elit, sunt ullamco nobis lorem ullamco ab omnis recusandae. Laudantium, fugiat.', '2017-03-15', '2017-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admissionnumber` text NOT NULL,
  `admissionyear` text NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `course` int(11) NOT NULL,
  `password` text NOT NULL,
  `profileimage` text NOT NULL,
  `mailverification` text NOT NULL,
  `studentstatus` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admissionnumber`, `admissionyear`, `name`, `address`, `phone`, `email`, `course`, `password`, `profileimage`, `mailverification`, `studentstatus`) VALUES
(1, '542', '2017', 'Vladimir Colon', 'Qui sint velit, labore quam est eiusmod enim modi tenetur nisi ex perferendis.', '+333-83-2248722', 'zitumubyxe@gmail.com', 1, '000', './assets/img/students/profilepic/58c402877ff1d9.74953085.png', 'verified', ''),
(2, '141', '2017', 'Daniel Hill', 'Possimus, quia veritatis veritatis quis facere corrupti, nisi suscipit nisi odio facilis.', '+499-82-7915391', 'gunafag@yahoo.com', 1, 'eda536', './assets/img/students/profilepic/58c40b9810c146.00291289.png', 'not verified', ''),
(5, '407', '2015', 'Kevyn Stevens', 'Est, doloribus cillum sequi excepturi eaque aliquip quis sit ut exercitation ullamco duis sed consequatur? Esse, ut deleniti ea aliquam.', '+435-85-9628067', 'roxyx@hotmail.com', 1, 'eaeccf', './assets/img/students/profilepic/58c4f0455510a0.99706480.jpg', 'not verified', ''),
(7, '859', '2017', 'Rebekah Cobb', 'Et incididunt quae omnis fugit, adipisicing consequatur non omnis nisi vel natus dolores consequatur? In minima ut.', '+124-31-1448304', 'hopiwumy@hotmail.com', 1, '93a6fb', './assets/img/students/profilepic/58c4f06d5c2ec6.50432679.jpg', 'not verified', ''),
(8, '47', '2015', 'Gannon Haley', 'Ratione velit, eaque officia aspernatur non atque labore esse cillum aliquip sed ea provident, vero excepteur omnis.', '+862-65-4544075', 'tuhuwodoce@gmail.com', 14, '123', './assets/img/students/profilepic/58ccda63a39a07.57152797.png', 'verified', 'studying');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `subject` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course`, `semester`, `subject`) VALUES
(1, 1, 1, 'Mathematics'),
(2, 1, 1, 'abc'),
(3, 1, 6, 'Test Subject'),
(4, 1, 1, 'Test Subject');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `mail` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `mailverification` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `phone`, `mail`, `password`, `image`, `mailverification`) VALUES
(5, 'Ian Pruitt', '+234-33-3411784', 'kafal@hotmail.com', '000', './assets/img/teachers/profile/58c2b63f311b88.18707557.png', 'not verified'),
(4, 'Hayley Hunter', '+845-10-5210698', 'jeybin@gmail.com', '123', './assets/img/teachers/profile/58c2b635aae992.84306583.jpg', 'verified'),
(6, 'Macon Mcfadden', '+436-95-9831525', 'cexyvavoca@gmail.com', '123', './assets/img/teachers/profile/58c4ef0518f0f7.39662890.png', 'verified'),
(7, 'Timothy Christian', '+691-43-9694480', 'jeybincodemagos@gmail.com', '123', './assets/img/teachers/profile/58c4ef1e1f9896.76021563.jpg', 'verified'),
(8, 'Noble Talley', '+291-53-6996779', 'becer@gmail.com', '617639', './assets/img/teachers/profile/58ccd5ea9e5476.03012939.jpg', 'not verified'),
(10, 'Amal', '+472-28-3583766', 'amalmeladoor@gmail.com', 'a80836', './assets/img/teachers/profile/58ccd6cf53cee7.04674471.png', 'not verified');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

DROP TABLE IF EXISTS `timetables`;
CREATE TABLE IF NOT EXISTS `timetables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courseid` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `subject` text NOT NULL,
  `day` text NOT NULL,
  `period` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `courseid`, `semester`, `subject`, `day`, `period`) VALUES
(1, 1, 1, '1', 'monday', '1'),
(2, 1, 1, '4', 'tuesday', '1'),
(3, 1, 1, '2', 'wednesday', '3'),
(4, 1, 1, '1', 'friday', '6'),
(5, 1, 1, '4', 'monday', '4');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
