-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 05:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `child_of`
--

CREATE TABLE `child_of` (
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child_of`
--

INSERT INTO `child_of` (`student_id`, `parent_id`) VALUES
(7, 1),
(8, 5),
(9, 4),
(10, 3),
(11, 6);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `meeting_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`meeting_id`, `student_id`) VALUES
(1, 7),
(2, 8),
(3, 7),
(4, 10),
(5, 9),
(6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `grade_req` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `name`, `description`, `grade_req`) VALUES
(112233, 'Writing', 'Learn to write essays', 5),
(112244, 'Intro Mathematics', 'Basic Algebra', 4),
(112255, 'English Composition', 'Understanding the Language Composition', 5),
(112266, 'Arithmetic', 'Addition and Subtraction', 4),
(112277, 'Intro to Programming', 'Programming Fundamentals', 5),
(112288, 'Geometry', 'Squares', 4);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `assigned_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `meeting_id`, `title`, `author`, `type`, `url`, `notes`, `assigned_date`) VALUES
(101, 1, 'Scholastic Success with Writing, Grade 5', 'Scholastic', 'Paperback', 'https://www.amazon.com/Scholastic-Success-Writing-Grade-5/dp/054520075X/ref=sr_1_4?keywords=Writing+Books+for+5th+Grade&qid=1677170921&sr=8-4', 'Book on writing', '2023-02-22'),
(102, 6, 'Python for Kids, 2nd Edition', 'Jason Briggs', 'Hard Cover', 'https://www.amazon.com/Python-Kids-2nd-Introduction-Programming/dp/1718503024/ref=sr_1_6?keywords=Introduction+to+Programming&qid=1677170978&sr=8-6', 'Learn basic Python', '2023-02-28'),
(103, 2, 'Spectrum Math Grade 5', 'Spectrum', 'Paperback', 'https://www.christianbook.com/spectrum-math-grade-5/9781483808734/pd/804565?en=bing-pla&event=SHOP&kw=homeschool-0-20%7C804565&p=1179517&dv=c&cb_src=bing&cb_typ=shopping&cb_cmp=376722714&cb_adg=1232552771500215&cb_kyw=default&msclkid=2ef4bfaf33d91199a4a8d', 'An introduction to math', '2023-02-27'),
(104, 4, 'Mastering Essential Math Skills GEOMETRY Grades 4-6', 'Richard W. Fisher', 'Paperback', 'https://www.amazon.com/Mastering-Essential-Skills-GEOMETRY-Grades/dp/0966621174/ref=sr_1_1_sspa?crid=MISIQJFVQ7U9&keywords=Geometry+for+kids&qid=1677171179&sprefix=geometry+for+kid%2Caps%2C94&sr=8-1-spons&psc=1&spLa=ZW5jcnlwdGVkUXVhbGlmaWVyPUExSlFBMzBPWkZ', 'Squares and Circles ', '2023-02-25'),
(105, 5, 'Carson Dellosa Skill Builders Reading Comprehension Workbook―Language Arts', 'Carson Dellosa Education', 'Paperback', 'https://www.amazon.com/Reading-Comprehension-Grade-Skill-Builders/dp/1936023342/ref=sr_1_2?crid=OJ0MT4FCO9Y6&keywords=english+comp+middle+school&qid=1677171325&s=books&sprefix=english+comp+middle+schoo%2Cstripbooks%2C98&sr=1-2', 'Comprehend English', '2023-02-22'),
(106, 3, 'The Ultimate Grade 5 Math Workbook', 'IXL Learning', 'Paperback', 'https://www.amazon.com/Ultimate-Grade-Workbook-Decimals-Fractions/dp/1947569457/ref=sr_1_12_sspa?crid=3U1AWGHD0JJIR&keywords=Arithmetic+for+kids+textbook&qid=1677171390&sprefix=arithmetic+for+kids+texbook%2Caps%2C77&sr=8-12-spons&psc=1&spLa=ZW5jcnlwdGVkUX', 'Do some math homework', '2023-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meeting_id` int(11) NOT NULL,
  `meeting_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time_slot_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `announcement` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meeting_id`, `meeting_name`, `date`, `time_slot_id`, `capacity`, `group_id`, `announcement`) VALUES
(1, 'Writing', '2023-02-27', 1, 4, 112233, 'Write essays fast'),
(2, 'Intro Mathematics', '2023-02-26', 4, 3, 112244, 'Lets do some math'),
(3, 'Arithmetic', '2023-03-04', 3, 6, 112266, 'Add and Subtract numbers'),
(4, 'Geometry', '2023-03-05', 5, 6, 112288, 'Compare the size of squares'),
(5, 'English Composition', '2023-02-04', 2, 6, 112255, ''),
(6, 'Intro to Programming', '2023-02-11', 4, 6, 112277, 'Learn C');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parent_id`) VALUES
(1),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `grade`) VALUES
(7, 9),
(8, 9),
(9, 12),
(10, 10),
(11, 10);

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `time_slot_id` int(11) NOT NULL,
  `day_of_the_week` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`time_slot_id`, `day_of_the_week`, `start_time`, `end_time`) VALUES
(1, 'Saturday', '07:00:00', '08:00:00'),
(2, 'Saturday', '09:00:00', '10:00:00'),
(3, 'Saturday', '12:00:00', '13:00:00'),
(4, 'Sunday', '07:00:00', '08:00:00'),
(5, 'Sunday', '10:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone`) VALUES
(1, 'tonystark@gmail.com', 'iamironman', 'Tony Stark', '5551234'),
(2, 'steverogers@admin.gmail.com', 'firstavenger', 'Steve Rogers', '5551235'),
(3, 'brucebanner@gmail.com', 'strongestavenger', 'Bruce Banner', '5551236'),
(4, 'thorodinson@gmail.com', 'pointbreak', 'Thor Odinson', '5551237'),
(5, 'clintbarton@gmail.com', 'legolas', 'Clint Barton', '5551238'),
(6, 'natasharomanov@gmail.com', 'budapest', 'Natasha Romanov', '5551239'),
(7, 'peterparker@student.gmail.com', 'queens', 'Peter Parker', '5552345'),
(8, 'wandamaximoff@student.gmail.com', 'scarletwitch', 'Wanda Maximoff', '5552346'),
(9, 'samwilson@student.gmail.com', 'falcon', 'Sam Wilson', '5552347'),
(10, 'scottlang@student.gmail.com', 'antman', 'Scott Lang', '5557846'),
(11, 'buckybarnes@student.gmail.com', 'wintersoldier', 'Bucky Barnes', '5557638');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `child_of`
--
ALTER TABLE `child_of`
  ADD PRIMARY KEY (`student_id`,`parent_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`meeting_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`,`meeting_id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `time_slot_id` (`time_slot_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`time_slot_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `child_of`
--
ALTER TABLE `child_of`
  ADD CONSTRAINT `child_of_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `child_of_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`parent_id`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`) ON DELETE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `meetings_ibfk_2` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`time_slot_id`);

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
