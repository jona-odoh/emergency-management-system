-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 02:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `state` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agency_id` varchar(50) NOT NULL,
  `photo` varchar(700) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `state`, `username`, `password`, `address`, `agency_id`, `photo`) VALUES
(10, 'Jonathan Odoh', 'jonathan@gmail.com', '09063633140', 'Abuja', 'admin', 'admin', 'FCT', '6757', 'admin08d9b861efdf38556a13bceab9930529.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `id` int(11) NOT NULL,
  `agency_id` varchar(50) NOT NULL,
  `agency_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `personincharge` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`id`, `agency_id`, `agency_name`, `phone_number`, `email`, `personincharge`, `username`, `password`, `state`, `address`, `photo`) VALUES
(3, '1337', 'Police', '090637889', 'police@gmail.com', 'Jonathan', 'police', '12345', 'abuja', 'FCT', 'agency149e3e44f00d4dad791c2102a3cd1c7e.jpg'),
(4, '9496', 'EFCC', '09063633140', 'efcc@gmail.com', 'Mark', 'efcc', '12345', 'Abuja', 'Matiama', 'agency9d048ddf481d5009d104bfd3a4afb72b.jpg'),
(5, '5253', 'Federal Fire Service', '0907657688', 'ffs@gmail.com', 'Victor', 'ffs', '12345', 'Kogi', 'Felele', 'agency68fbecbc443b96a0fbc0c18e9b201e88.jpg'),
(6, '9434', 'Civil Defence', '090766777', 'civil@gmail.com', 'Esther', 'civil', '12345', 'Nasarawa ', 'Lafia', 'agency2bb60c40c688f55f49b3940064d1c95e.png'),
(7, '1342', 'Federal Medical Center', '090787887', 'fmc@gmail.com', 'David', 'fmc', '12345', 'Abuja', 'Central Area', 'agency482b2fd2b3bed88c560f789553794131.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `id` int(11) NOT NULL,
  `emergency_id` int(11) NOT NULL,
  `agency_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `agency_name` varchar(50) NOT NULL,
  `case_severity` varchar(50) NOT NULL,
  `emergency_category` varchar(50) NOT NULL,
  `date` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `state` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dates` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `victim_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `photo` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`id`, `emergency_id`, `agency_id`, `agency_name`, `case_severity`, `emergency_category`, `date`, `state`, `phone_number`, `address`, `name`, `status`, `email`, `dates`, `victim_id`, `description`, `photo`) VALUES
(78, 6001, '1337', '', 'Normal', 'Accident', '', 'Abuja', '09063633140', 'nn', 'Jonathan Odoh', 'Pending', 'jonathan@gmail.com', '17-05-2023', '3253', 'nn', 'emergency0283bcfb67710bf2957fe23b3a061590.jpeg'),
(79, 3642, '9496', '', 'Normal', 'Accident', '', 'Abuja', '090637889', 'tgfhg', 'Police', 'Resolved', 'police@gmail.com', '18-05-2023', '1337', 'hjhgf', 'emergency38642db2c33f41d4f4a5157c0fcbb2b0.jpeg'),
(80, 5637, '9496', '', 'Normal', 'Accident', '', 'Kogi', '09063633140', 'gtbf', 'EFCC', 'Resolved', 'efcc@gmail.com', '18-05-2023', '9496', 'ggb', 'emergencye153c9b4edaf52253f997e9a7c9923ad.jpeg'),
(81, 8287, '1337', '', 'Normal', 'Accident', '', 'Abuja', '09063633140', 'hh', 'Jonathan Odoh', 'Resolved', 'jonathan@gmail.com', '29-05-2023', '3253', 'sgzf', 'emergency34e2e5968dfd4122bcb598c4b63bb9eb.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_type`
--

CREATE TABLE `emergency_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_type`
--

INSERT INTO `emergency_type` (`id`, `name`, `description`) VALUES
(1, 'Accident', ''),
(2, 'Fire out break', ''),
(3, 'Covid-19', ''),
(4, 'Insurgency', ''),
(5, 'Armed Robbery', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `joined` varchar(30) NOT NULL,
  `state` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `joined`, `state`, `phone`, `user_id`, `address`, `photo`) VALUES
(23, 'Jonathan Odoh', 'jonathan@gmail.com', 'jona', 'jona', '', 'Abuja', '09063633140', '3253', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_type`
--
ALTER TABLE `emergency_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `emergency_type`
--
ALTER TABLE `emergency_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
