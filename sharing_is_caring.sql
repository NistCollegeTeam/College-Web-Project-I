-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 06:06 PM
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
-- Table structure for table `session_token`
--

CREATE TABLE `session_token` (
  `id` int(255) NOT NULL,
  `user_id` int(255) UNSIGNED NOT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) UNSIGNED NOT NULL COMMENT 'User Id',
  `username` varchar(50) NOT NULL COMMENT 'username',
  `email` varchar(200) NOT NULL COMMENT 'email',
  `password` varchar(1000) NOT NULL COMMENT 'password',
  `active` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `active`) VALUES
(3, '', 'admin@g.com', 'ecd00aa1acd325ba7575cb0f638b04a5', 1),
(4, '', 'nischalstha9@gmail.com', '$2y$10$vS7gyvhhRze5n7.TNCGeVeKZIikCRD0jdcmDC5ba1latjJ26ix5OO', 1),
(5, '', 'nischal@g.com', '$2y$10$5OO2NXCAsLej7wmvZacaXePxG0dn5m2XCK49vi1zk6W3wsSKLn9Gy', 1),
(6, '', 'a@g.com', '$2y$10$5XIx5C2N4GAwhDbwHunjnendjSfUesyZvC7IvbV1MZLr/YYMvmbiG', 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `session_token`
--
ALTER TABLE `session_token`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User Id', AUTO_INCREMENT=7;

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
