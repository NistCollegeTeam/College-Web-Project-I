-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2021 at 01:29 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` int NOT NULL,
  `helper_id` int UNSIGNED NOT NULL,
  `category` int UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `helps`
--

INSERT INTO `helps` (`id`, `title`, `description`, `location`, `contact`, `helper_id`, `category`, `created_at`, `active`) VALUES
(2, 'First Help', 'Ge', 'ktm', 98, 5, 1, '2021-09-04 12:38:21', 1),
(3, 'First Help', 'momo', 'mo', 98, 5, 2, '2021-09-04 12:38:21', 1),
(4, 'Timestan', 'tim3e', 'bkt', 89, 5, 1, '2021-09-04 12:38:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `helps_category`
--

CREATE TABLE `helps_category` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL COMMENT 'User Id',
  `username` varchar(50) NOT NULL COMMENT 'username',
  `email` varchar(200) NOT NULL COMMENT 'email',
  `password` varchar(1000) NOT NULL COMMENT 'password',
  `active` int UNSIGNED NOT NULL DEFAULT '1',
  `email_verified` int NOT NULL DEFAULT '0',
  `role` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `active`, `email_verified`, `role`) VALUES
(1, '', 'nischal@g.com', '$2y$10$5OO2NXCAsLej7wmvZacaXePxG0dn5m2XCK49vi1zk6W3wsSKLn9Gy', 1, 0, 0);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `helps_category`
--
ALTER TABLE `helps_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `session_token`
--
ALTER TABLE `session_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User Id', AUTO_INCREMENT=7;

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
