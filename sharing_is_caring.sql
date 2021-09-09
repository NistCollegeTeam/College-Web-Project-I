-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 05:29 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharing_is_caring`
--

-- --------------------------------------------------------

--
-- Table structure for table `helps`
--

CREATE TABLE `helps` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `helper_id` int(10) UNSIGNED NOT NULL,
  `category` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `helps`
--

INSERT INTO `helps` (`id`, `title`, `description`, `location`, `contact`, `helper_id`, `category`, `created_at`, `active`) VALUES
(2, 'First Help', 'Ge', 'ktm', 98, 5, 1, '2021-09-04 12:38:21', 1),
(3, 'First Help', 'momo', 'mo', 98, 5, 2, '2021-09-04 12:38:21', 1),
(4, 'Timestan', 'tim3e', 'bkt', 89, 5, 1, '2021-09-04 12:38:45', 1),
(5, 'Windows Help', 'Mero other help', 'nkt', 787898, 5, 2, '2021-09-05 20:19:22', 1),
(6, 'Jacket', '', 'Kathmandu', 2147483647, 1, 2, '2021-09-06 08:57:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `helps_category`
--

CREATE TABLE `helps_category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `helps_category`
--

INSERT INTO `helps_category` (`id`, `name`, `description`) VALUES
(1, 'Food', NULL),
(2, 'Clothing', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session_token`
--

CREATE TABLE `session_token` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'User Id',
  `username` varchar(50) NOT NULL COMMENT 'username',
  `email` varchar(200) NOT NULL COMMENT 'email',
  `password` varchar(1000) NOT NULL COMMENT 'password',
  `active` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `email_verified` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `active`, `email_verified`, `role`) VALUES
(1, '', 'nischal@g.com', '$2y$10$pV3.NX4l2GeWxwWcVGv9vemtdgCaFCLLvCFGcKatzXNUDRaygaV8q', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `helps`
--
ALTER TABLE `helps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `helps_category`
--
ALTER TABLE `helps_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_token`
--
ALTER TABLE `session_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_token_ibfk_1` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `helps`
--
ALTER TABLE `helps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `helps_category`
--
ALTER TABLE `helps_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `session_token`
--
ALTER TABLE `session_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User Id', AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `session_token`
--
ALTER TABLE `session_token`
  ADD CONSTRAINT `session_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
