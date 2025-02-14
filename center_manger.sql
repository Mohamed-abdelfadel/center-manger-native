-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2022 at 12:41 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `center_manger`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `student_id`, `teacher_id`, `group_id`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 3),
(3, 3, 1, 2),
(4, 4, 1, 2),
(5, 5, 1, 0),
(6, 6, 1, 3),
(7, 7, 1, 0),
(8, 8, 1, 2),
(9, 9, 1, 2),
(10, 10, 1, 3),
(11, 11, 1, 2),
(12, 12, 1, 0),
(13, 13, 1, 2),
(14, 14, 1, 3),
(15, 15, 1, 3),
(16, 16, 1, 2),
(17, 17, 1, 2),
(18, 18, 1, 3),
(19, 19, 1, 2),
(20, 20, 1, 3),
(21, 21, 1, 2),
(22, 22, 1, 2),
(23, 23, 1, 2),
(24, 24, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `teacher`, `price`) VALUES
(0, 'غير مصنف', 'غير موجود', 1, 0),
(2, 'M-T-11', ' Monday-Tuesday-11:00am', 1, 350),
(3, 'M-T-12', ' Monday-Tuesday-12:00am', 1, 370);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `paid` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `grade` int(11) NOT NULL DEFAULT 0,
  `exam` int(11) DEFAULT 0,
  `attendance` int(100) NOT NULL DEFAULT 0,
  `absence` int(100) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `phone`, `paid`, `total`, `grade`, `exam`, `attendance`, `absence`, `active`) VALUES
(1, 'أمير ', 'محمد', '01121118319', 0, 0, 0, 50, 0, 0, 1),
(2, 'محمد', 'خالد', '01551001234', 0, 0, 0, 50, 0, 0, 1),
(3, 'مريم', 'احمد', '01550444044', 0, 0, 0, 0, 0, 0, 1),
(4, 'اسامه ', 'محمود', '01553444443', 0, 0, 0, 0, 0, 0, 1),
(5, 'حسام ', 'محمود', '01003806197', 0, 0, 0, 40, 0, 0, 0),
(6, 'مهند ', 'ياسر', '01555523001', 0, 0, 0, 0, 0, 0, 1),
(7, 'نيره', 'محمد', '01552301111', 0, 0, 0, 0, 0, 0, 1),
(8, 'محمد', 'هاني', '01501575375', 0, 0, 0, 0, 0, 0, 1),
(9, 'احمد', 'خالد', '01501523234', 0, 0, 0, 0, 0, 0, 1),
(10, 'يوسف ', 'ابراهيم', '01550440009', 0, 0, 0, 0, 0, 0, 1),
(11, 'محمد', 'ادم', '01550050504', 0, 0, 0, 0, 0, 0, 1),
(12, 'ادهم', 'نبيل', '01503838538', 0, 0, 0, 0, 0, 0, 1),
(13, 'فارس', 'احمد', '01555777757', 0, 0, 0, 0, 0, 0, 1),
(14, 'احمد', 'محمد', '01554915599', 0, 0, 0, 0, 0, 0, 0),
(15, 'احمد', 'ممدوح', '01550444044', 0, 0, 0, 0, 0, 0, 1),
(16, 'اشرف ', 'محمد', '01555559158', 0, 0, 0, 0, 0, 0, 1),
(17, 'يوسف', 'احمد', '01555680008', 0, 0, 0, 0, 0, 0, 1),
(18, 'محمود', 'احمد', '01550088950', 0, 0, 0, 0, 0, 0, 1),
(19, 'مريم', 'خالد', '01544420000', 0, 0, 0, 0, 0, 0, 1),
(20, 'حاتم', 'محمد', '01033588533', 0, 0, 0, 0, 0, 0, 1),
(21, 'عمار', 'انس', '01551553755', 0, 0, 0, 0, 0, 0, 1),
(22, 'اسامه ', 'احمد', '01555680008', 0, 0, 0, 0, 0, 0, 1),
(23, 'احمد', 'محمود', '01555680008', 0, 0, 0, 0, 0, 0, 1),
(24, '123', '1232', '33', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `email`, `password`, `verified`) VALUES
(1, 'محمد', 'ياسر', 'mohamed@gmail.com', '$2y$10$yP7bggOzvI18NnP6zqHNMeLLnpCMWofpLaCRr7RCUZYYdQlU0MUUm', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher` (`teacher`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
