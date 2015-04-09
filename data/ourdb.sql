-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2015 at 03:54 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ourdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE IF NOT EXISTS `classroom` (
  `room_number` varchar(5) NOT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`room_number`, `capacity`) VALUES
('116', 40),
('118', 40),
('120', 40),
('121', 40),
('123', 40),
('126', 40),
('127', 40),
('128', 40),
('129', 40),
('130', 40),
('131', 40),
('132', 40),
('133', 40),
('134', 40),
('201', 40),
('LH1', 40),
('LH2', 40),
('LH3', 40);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(20) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  `reg_students` int(11) DEFAULT NULL,
  `department_dpt_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `title`, `credits`, `reg_students`, `department_dpt_name`) VALUES
('BO1010', 'Introduction to Life Sciences', 4, 40, 'Biomedical Engineering'),
('CE6300', 'Advanced Foundation Engineering', 1, 40, 'Civil Engineering'),
('CS1280', 'Introduction to OS', 1, 40, 'Computer Science and Engineering'),
('CS2020', 'Design and Analysis of Algorithms', 4, 40, 'Computer Science and Engineering'),
('CS2050', 'Computer Organization', 3, 40, 'Computer Science and Engineering'),
('CS5270', 'Numerical Linear Algebra for Data Analysis', 4, 40, 'Computer Science and Engineering'),
('EE3300', 'Digital Signal Processing', 4, 40, 'Electrical Engineering'),
('EE6380', 'Deep Learning', 5, 40, 'Electrical Engineering'),
('ME5820', 'Turbulence', 2, 40, 'Mechanical Engineering'),
('PH3222', 'Particle Physics', 2, 40, 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `dpt_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dpt_name`) VALUES
('Biomedical Engineering'),
('Biotechnology'),
('Chemical Engineering'),
('Chemistry'),
('Civil Engineering'),
('Computer Science and Engineering'),
('Design'),
('Electrical Engineering'),
('Engineering Science'),
('Liberal Arts'),
('Materials Science and Metallurgical Engi'),
('Mathematics'),
('Mechanical Engineering'),
('Physics');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `department_dpt_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Instructor Table';

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`ID`, `Name`, `department_dpt_name`) VALUES
(1, 'Renu John', 'Biomedical Engineering'),
(2, 'Harikrishnan Narayanan Unni', 'Biomedical Engineering'),
(3, 'Subha Narayan Rath', 'Biomedical Engineering'),
(4, 'Jyotsnendu Giri', 'Biomedical Engineering'),
(5, 'Mohan Raghavan', 'Biomedical Engineering'),
(6, 'Ramana Vinjamuri', 'Biomedical Engineering'),
(7, 'Basant Kumar Patel', 'Biotechnology'),
(8, 'Anindya Roy', 'Biotechnology'),
(9, 'N. K. Raghavendra', 'Biotechnology'),
(10, 'Thenmalarchelvi Rathinavelan', 'Biotechnology'),
(11, 'Rajakumara Eerappa', 'Biotechnology'),
(12, 'Anamika Bhargava', 'Biotechnology'),
(13, 'Kirti Chandra Sahu', 'Chemical Engineering'),
(14, 'Vinod Janardhanan', 'Chemical Engineering'),
(15, 'Sunil Kumar Maity', 'Chemical Engineering'),
(16, 'Parag D. Pawar', 'Chemical Engineering'),
(17, 'Saptarshi Majumdar', 'Chemical Engineering'),
(18, 'Anand Mohan', 'Chemical Engineering'),
(19, 'Narasimha Mangadoddy', 'Chemical Engineering'),
(20, 'Chandra Shekhar Sharma', 'Chemical Engineering'),
(21, 'Debaprasad Shee', 'Chemical Engineering'),
(22, 'Phanindra Varma Jampana', 'Chemical Engineering'),
(23, 'Kishalay Mitra', 'Chemical Engineering'),
(24, 'Lopamudra Giri', 'Chemical Engineering'),
(25, 'Devarai Santhosh Kumar', 'Chemical Engineering'),
(26, 'Balaji Iyer', 'Chemical Engineering'),
(27, 'Faiz Ahmed Khan', 'Chemistry'),
(28, 'Ch.Subrahmanyam', 'Chemistry'),
(29, 'G. Satyanarayana', 'Chemistry'),
(30, 'M.Deepa', 'Chemistry'),
(31, 'Tarun Kanti Panda', 'Chemistry'),
(32, 'G. Prabusankar', 'Chemistry'),
(33, 'D. S. Sharada', 'Chemistry'),
(34, 'Bhabani Shankar Mallik', 'Chemistry'),
(35, 'Surendra Kumar Martha', 'Chemistry'),
(36, 'Kolluru V.L. Subramaniam', 'Civil Engineering'),
(37, 'S. Sireesh', 'Civil Engineering'),
(38, 'B. Umashankar', 'Civil Engineering'),
(39, 'Amirtham Rajagopal', 'Civil Engineering'),
(40, 'Shashidhar', 'Civil Engineering'),
(41, 'K.B.V.N.Phanindra', 'Civil Engineering'),
(42, 'S. Suriya Prakash', 'Civil Engineering'),
(43, 'M. Mahendrakumar', 'Civil Engineering'),
(44, 'Debraj Bhattacharyya', 'Civil Engineering'),
(45, 'Basudev Biswal', 'Civil Engineering'),
(46, 'Asif Qureshi', 'Civil Engineering'),
(47, 'B. Munwar Basha', 'Civil Engineering'),
(48, 'Riddhi Singh', 'Civil Engineering'),
(49, 'Anil Agarwal', 'Civil Engineering'),
(50, 'Surendra Nadh Somala', 'Civil Engineering'),
(51, 'Bheemarjuna Reddy Tamma', 'Computer Science and Engineering'),
(52, 'C. Krishna Mohan', 'Computer Science and Engineering'),
(53, 'M. V. Panduranga Rao', 'Computer Science and Engineering'),
(54, 'Ch. Sobhan Babu', 'Computer Science and Engineering'),
(55, 'Naveen Sivadasan', 'Computer Science and Engineering'),
(56, 'Subrahmanyam Kalyanasundaram', 'Computer Science and Engineering'),
(57, 'N R Aravind', 'Computer Science and Engineering'),
(58, 'Vineeth N Balasubramanian', 'Computer Science and Engineering'),
(59, 'Sathya Peri', 'Computer Science and Engineering'),
(60, 'Ramakrishna Upadrasta', 'Computer Science and Engineering'),
(61, 'Manish Singh', 'Computer Science and Engineering'),
(62, 'Kotaro Kataoka', 'Computer Science and Engineering'),
(63, 'Deepak John Mathew', 'Design'),
(64, 'Neelakantan', 'Design'),
(65, 'Prasad S Onkar', 'Design'),
(66, 'U B Desai', 'Electrical Engineering'),
(67, 'Mohammed Zafar Ali Khan', 'Electrical Engineering'),
(68, 'Kiran Kuchi', 'Electrical Engineering'),
(69, 'Shiv Govind Singh', 'Electrical Engineering'),
(70, 'Ashudeb Dutta', 'Electrical Engineering'),
(71, 'Sri Rama Murty Kodukula', 'Electrical Engineering'),
(72, 'P. Rajalakshmi', 'Electrical Engineering'),
(73, 'Vaskar Sarkar', 'Electrical Engineering'),
(74, 'Ketan P. Detroja', 'Electrical Engineering'),
(75, 'Soumya Jana', 'Electrical Engineering'),
(76, 'K Siva Kumar', 'Electrical Engineering'),
(77, 'G V V Sharma', 'Electrical Engineering'),
(78, 'Amit Acharyya', 'Electrical Engineering'),
(79, 'Sumohana Channappayya', 'Electrical Engineering'),
(80, 'Siva Rama Krishna', 'Electrical Engineering'),
(81, 'Ravikumar Bhimasingu', 'Electrical Engineering'),
(82, 'Sushmee Badhulika', 'Electrical Engineering'),
(83, 'Pradeep Kumar Yemula', 'Electrical Engineering'),
(84, 'Abhinav Kumar', 'Electrical Engineering'),
(85, 'Badri Narayan Rath', 'Liberal Arts'),
(86, 'Indira Jalli', 'Liberal Arts'),
(87, 'K. P. Prabheesh', 'Liberal Arts'),
(88, 'Amrita Deb', 'Liberal Arts'),
(89, 'Srirupa Chatterjee', 'Liberal Arts'),
(90, 'Mahati Chittem', 'Liberal Arts'),
(91, 'Shubha Ranganathan', 'Liberal Arts'),
(92, 'Haripriya Narasimhan', 'Liberal Arts'),
(93, 'Nandini Ramesh Sankar', 'Liberal Arts'),
(94, 'Prakash Mondal', 'Liberal Arts'),
(95, 'D. Sukumar', 'Mathematics'),
(96, 'Challa Subrahmanya Sastry', 'Mathematics'),
(97, 'Balasubramaniam Jayaram', 'Mathematics'),
(98, 'P A Lakshmi Narayana', 'Mathematics'),
(99, 'G Ramesh', 'Mathematics'),
(100, 'Tanmoy Paul', 'Mathematics'),
(101, 'D Venku Naidu', 'Mathematics'),
(102, 'CH. V. G. Narasimha Kumar', 'Mathematics'),
(103, 'Pradipto Banerjee', 'Mathematics'),
(104, 'Prabhakar Akella', 'Mathematics'),
(105, 'Pinaki Prasad Bhattacharjee', 'Materials Science and Metallurgical Engi'),
(106, 'Suhash Ranjan Dey', 'Materials Science and Metallurgical Engi'),
(107, 'Ranjith Ramadurai', 'Materials Science and Metallurgical Engi'),
(108, 'Bharat Bhooshan PANIGRAHI', 'Materials Science and Metallurgical Engi'),
(109, 'Atul Suresh Deshpande', 'Materials Science and Metallurgical Engi'),
(110, 'Saswata Bhattacharya', 'Materials Science and Metallurgical Engi'),
(111, 'Mudrika Khandelwal', 'Materials Science and Metallurgical Engi'),
(112, 'Subhradeep Chatterjee', 'Materials Science and Metallurgical Engi'),
(113, 'Vinayak Eswaran', 'Mechanical Engineering'),
(114, 'N. Venkata Reddy', 'Mechanical Engineering'),
(115, 'Raja Banerjee', 'Mechanical Engineering'),
(116, 'M.Ramji', 'Mechanical Engineering'),
(117, 'R.Prasanth Kumar', 'Mechanical Engineering'),
(118, 'K. Venkatasubbaiah', 'Mechanical Engineering'),
(119, 'Abhay Sharma', 'Mechanical Engineering'),
(120, 'B. Venkatesham', 'Mechanical Engineering'),
(121, 'S. Suryakumar', 'Mechanical Engineering'),
(122, 'Ashok Kumar Pandey', 'Mechanical Engineering'),
(123, 'Chandrika Prakash Vyasarayani', 'Mechanical Engineering'),
(124, 'Viswanath Chinthapenta', 'Mechanical Engineering'),
(125, 'Harish Nagaraj Dixit', 'Mechanical Engineering'),
(126, 'Nishanth Dongari', 'Mechanical Engineering'),
(127, 'Karri Badarinath', 'Mechanical Engineering'),
(128, 'Pankaj Kolhe', 'Mechanical Engineering'),
(129, 'Gangadharan Raju', 'Mechanical Engineering'),
(130, 'Saravanan B', 'Mechanical Engineering'),
(131, 'Syed Nizamuddin Khaderi', 'Mechanical Engineering'),
(132, 'Anjan Kumar Giri', 'Physics'),
(133, 'V.Kanchana', 'Physics'),
(134, 'Saket Asthana', 'Physics'),
(135, 'Prem Pal', 'Physics'),
(136, 'Manish K. Niranjan', 'Physics'),
(137, 'Narendra Sahu', 'Physics'),
(138, 'Debasish Chaudhuri', 'Physics'),
(139, 'Vandana Sharma', 'Physics'),
(140, 'J.Suryanarayana', 'Physics'),
(141, 'Jyoti Ranjan Mohanty', 'Physics'),
(142, 'Raghavendra Srikanth Hundi', 'Physics'),
(143, 'Sai Santosh Kumar Raavi', 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `sec_id` int(11) NOT NULL,
  `semester` varchar(8) NOT NULL,
  `year` year(4) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `time_slot_time_slot_id` int(11) NOT NULL,
  `classroom_room_number` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sec_id`, `semester`, `year`, `course_id`, `time_slot_time_slot_id`, `classroom_room_number`) VALUES
(1, 'Fall', 2015, 'BO1010', 4, '129'),
(2, 'Fall', 2015, 'BO1010', 33, '132'),
(1, 'Spring', 2014, 'CE6300', 1, '130'),
(2, 'Spring', 2014, 'CE6300', 31, '132'),
(1, 'Fall', 2015, 'CS1280', 29, '121'),
(2, 'Fall', 2015, 'CS1280', 25, 'LH3'),
(1, 'Fall', 2015, 'CS2020', 11, '130'),
(2, 'Fall', 2015, 'CS2020', 16, '131'),
(1, 'Fall', 2015, 'CS2050', 24, '118'),
(2, 'Fall', 2015, 'CS2050', 24, '130'),
(1, 'Spring', 2012, 'CS5270', 25, '116'),
(2, 'Spring', 2012, 'CS5270', 30, '130'),
(1, 'Spring', 2014, 'EE3300', 11, '126'),
(2, 'Spring', 2014, 'EE3300', 26, '128'),
(1, 'Fall', 2015, 'EE6380', 19, '132'),
(2, 'Fall', 2015, 'EE6380', 17, 'LH2'),
(1, 'Fall', 2015, 'ME5820', 16, 'LH3'),
(2, 'Fall', 2015, 'ME5820', 15, '134'),
(1, 'Fall', 2015, 'PH3222', 9, '120'),
(2, 'Fall', 2015, 'PH3222', 1, '120');

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE IF NOT EXISTS `teaches` (
  `instructor_ID` int(11) NOT NULL,
  `section_course_id` varchar(10) NOT NULL,
  `section_sec_id` int(11) NOT NULL,
  `section_semester` varchar(8) NOT NULL,
  `section_year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teaches`
--

INSERT INTO `teaches` (`instructor_ID`, `section_course_id`, `section_sec_id`, `section_semester`, `section_year`) VALUES
(7, 'BO1010', 1, 'Fall', 2015),
(7, 'BO1010', 2, 'Fall', 2015),
(46, 'CE6300', 1, 'Spring', 2014),
(46, 'CE6300', 2, 'Spring', 2014),
(51, 'CS2020', 1, 'Fall', 2015),
(51, 'CS2020', 2, 'Fall', 2015),
(56, 'CS1280', 1, 'Fall', 2015),
(56, 'CS1280', 2, 'Fall', 2015),
(57, 'CS2050', 1, 'Fall', 2015),
(57, 'CS2050', 2, 'Fall', 2015),
(57, 'CS5270', 1, 'Spring', 2012),
(57, 'CS5270', 2, 'Spring', 2012),
(68, 'EE3300', 1, 'Spring', 2014),
(68, 'EE3300', 2, 'Spring', 2014),
(68, 'EE6380', 1, 'Fall', 2015),
(68, 'EE6380', 2, 'Fall', 2015),
(116, 'ME5820', 1, 'Fall', 2015),
(116, 'ME5820', 2, 'Fall', 2015),
(135, 'PH3222', 1, 'Fall', 2015),
(135, 'PH3222', 2, 'Fall', 2015);

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE IF NOT EXISTS `time_slot` (
  `time_slot_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`time_slot_id`, `day`, `start`, `end`) VALUES
(1, 'Monday', '08:30:00', '10:00:00'),
(2, 'Monday', '10:00:00', '11:30:00'),
(3, 'Monday', '11:30:00', '13:00:00'),
(4, 'Monday', '14:30:00', '16:00:00'),
(5, 'Monday', '16:00:00', '17:30:00'),
(6, 'Monday', '17:30:00', '19:00:00'),
(7, 'Monday', '19:00:00', '20:30:00'),
(8, 'Monday', '08:30:00', '10:00:00'),
(9, 'Monday', '10:00:00', '11:30:00'),
(10, 'Monday', '11:30:00', '13:00:00'),
(11, 'Monday', '14:30:00', '16:00:00'),
(12, 'Tuesday', '16:00:00', '17:30:00'),
(13, 'Tuesday', '17:30:00', '19:00:00'),
(14, 'Tuesday', '19:00:00', '20:30:00'),
(15, 'Wednesday', '08:30:00', '10:00:00'),
(16, 'Wednesday', '10:00:00', '11:30:00'),
(17, 'Wednesday', '11:30:00', '13:00:00'),
(18, 'Wednesday', '14:30:00', '16:00:00'),
(19, 'Wednesday', '16:00:00', '17:30:00'),
(20, 'Wednesday', '17:30:00', '19:00:00'),
(21, 'Wednesday', '19:00:00', '20:30:00'),
(22, 'Thursday', '08:30:00', '10:00:00'),
(23, 'Thursday', '10:00:00', '11:30:00'),
(24, 'Thursday', '11:30:00', '13:00:00'),
(25, 'Thursday', '14:30:00', '16:00:00'),
(26, 'Thursday', '16:00:00', '17:30:00'),
(27, 'Thursday', '17:30:00', '19:00:00'),
(28, 'Thursday', '19:00:00', '20:30:00'),
(29, 'Friday', '08:30:00', '10:00:00'),
(30, 'Friday', '10:00:00', '11:30:00'),
(31, 'Friday', '11:30:00', '13:00:00'),
(32, 'Friday', '14:30:00', '16:00:00'),
(33, 'Friday', '16:00:00', '17:30:00'),
(34, 'Friday', '17:30:00', '19:00:00'),
(35, 'Friday', '19:00:00', '20:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
 ADD PRIMARY KEY (`room_number`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`course_id`), ADD KEY `fk_course_department1_idx` (`department_dpt_name`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`dpt_name`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
 ADD PRIMARY KEY (`ID`), ADD KEY `fk_instructor_department1_idx` (`department_dpt_name`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
 ADD PRIMARY KEY (`course_id`,`sec_id`,`semester`,`year`), ADD KEY `fk_section_course_idx` (`course_id`), ADD KEY `fk_section_time_slot1_idx` (`time_slot_time_slot_id`), ADD KEY `fk_section_classroom1_idx` (`classroom_room_number`);

--
-- Indexes for table `teaches`
--
ALTER TABLE `teaches`
 ADD PRIMARY KEY (`instructor_ID`,`section_course_id`,`section_sec_id`,`section_semester`,`section_year`), ADD KEY `fk_instructor_has_section_section1_idx` (`section_course_id`,`section_sec_id`,`section_semester`,`section_year`), ADD KEY `fk_instructor_has_section_instructor1_idx` (`instructor_ID`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
 ADD PRIMARY KEY (`time_slot_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
ADD CONSTRAINT `fk_course_department1` FOREIGN KEY (`department_dpt_name`) REFERENCES `department` (`dpt_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
ADD CONSTRAINT `fk_instructor_department1` FOREIGN KEY (`department_dpt_name`) REFERENCES `department` (`dpt_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
ADD CONSTRAINT `fk_section_classroom1` FOREIGN KEY (`classroom_room_number`) REFERENCES `classroom` (`room_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_section_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_section_time_slot1` FOREIGN KEY (`time_slot_time_slot_id`) REFERENCES `time_slot` (`time_slot_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
ADD CONSTRAINT `fk_instructor_has_section_instructor1` FOREIGN KEY (`instructor_ID`) REFERENCES `instructor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_instructor_has_section_section1` FOREIGN KEY (`section_course_id`, `section_sec_id`, `section_semester`, `section_year`) REFERENCES `section` (`course_id`, `sec_id`, `semester`, `year`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
