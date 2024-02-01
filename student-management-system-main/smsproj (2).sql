-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 12:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smsproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes_data`
--

CREATE TABLE `classes_data` (
  `id` int(11) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `sections` varchar(255) DEFAULT NULL,
  `classteacher` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes_data`
--

INSERT INTO `classes_data` (`id`, `class`, `subject_name`, `sections`, `classteacher`) VALUES
(4, 'two', 'science', 'A', 'Krish karki'),
(5, 'one', 'science', 'A', 'keshav sha'),
(6, 'one', 'Math', 'A', 'Raj dev sha');

-- --------------------------------------------------------

--
-- Table structure for table `five`
--

CREATE TABLE `five` (
  `id` int(11) NOT NULL,
  `reg_no` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `class` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `four`
--

CREATE TABLE `four` (
  `id` int(11) NOT NULL,
  `reg_no` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `class` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `teacher` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_assigned` date DEFAULT curdate(),
  `file` blob DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `class`, `teacher`, `title`, `description`, `date_assigned`, `file`, `due_date`) VALUES
(12, 'two', 'krishna', 'homework', 'exercise 2.2', '2023-12-22', 0x4e6f20696d672075706c6f6164, '2222-02-22'),
(13, 'one', 'keshav sha', 'homework', 'exercise 2.2', '2023-12-22', 0x4e6f20696d672075706c6f6164, '2024-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `log_teacher`
--

CREATE TABLE `log_teacher` (
  `name` varchar(25) DEFAULT NULL,
  `role` varchar(25) DEFAULT NULL,
  `class` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_teacher`
--

INSERT INTO `log_teacher` (`name`, `role`, `class`, `email`, `password`) VALUES
('krishna', 'teacher', 'one', 'teacher@gmail.com', 'teacher1'),
('krishna2', 'teacher', 'two', 'teacher2@gmail.com', 'teacher2'),
('krishna3', 'teacher', 'three', 'teacher3@gmail.com', 'teacher3');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `teacher` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `file` mediumblob DEFAULT NULL,
  `date` date DEFAULT curdate(),
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `teacher`, `class`, `title`, `message`, `file`, `date`, `expiry_date`) VALUES
(4, 'hello', 'classone', 'bholi xuti xa ', 'asdfghj', NULL, '2023-12-15', '2222-02-22'),
(5, 'hello', 'one', 'bholi xuti xa ', 'krishna', NULL, '2023-12-22', '2222-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `one`
--

CREATE TABLE `one` (
  `id` int(11) NOT NULL,
  `reg_no` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `class` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `one`
--

INSERT INTO `one` (`id`, `reg_no`, `roll`, `fullname`, `address`, `gender`, `class`, `section`) VALUES
(1, 202401, 1, 'krish karki', '', 'male', 'one', 'A'),
(2, 202402, 2, 'keshav sha', '', 'male', 'one', 'A'),
(4, 202403, 3, 'Raj dev sha', '', 'male', 'one', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `student` varchar(100) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `three`
--

CREATE TABLE `three` (
  `id` int(11) NOT NULL,
  `reg_no` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `class` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `two`
--

CREATE TABLE `two` (
  `id` int(11) NOT NULL,
  `reg_no` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `class` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `two`
--

INSERT INTO `two` (`id`, `reg_no`, `roll`, `fullname`, `address`, `gender`, `class`, `section`) VALUES
(1, 2024, 1, 'krishna sapkota', '', 'male', 'two', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `student` varchar(100) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `student`, `class`, `section`, `fullname`, `address`, `email`, `password`, `status`) VALUES
(2, 'student', 'one', 'A', 'krishna', 'ktm', 'krishna1@gmail.com', '$2y$10$nhUsZ3/F4cZwOa9N..FSgOBR3Lj1swREA6NKkFNaMrf8QxVylbqv2', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes_data`
--
ALTER TABLE `classes_data`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `five`
--
ALTER TABLE `five`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `roll` (`roll`);

--
-- Indexes for table `four`
--
ALTER TABLE `four`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `roll` (`roll`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_teacher`
--
ALTER TABLE `log_teacher`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `one`
--
ALTER TABLE `one`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `roll` (`roll`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `three`
--
ALTER TABLE `three`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `roll` (`roll`);

--
-- Indexes for table `two`
--
ALTER TABLE `two`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `roll` (`roll`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes_data`
--
ALTER TABLE `classes_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `five`
--
ALTER TABLE `five`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `four`
--
ALTER TABLE `four`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `one`
--
ALTER TABLE `one`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `three`
--
ALTER TABLE `three`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `two`
--
ALTER TABLE `two`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
