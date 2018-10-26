-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2018 at 11:40 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kmutt_sign`
--

-- --------------------------------------------------------

--
-- Table structure for table `km_person_count`
--

CREATE TABLE `km_person_count` (
  `id` int(11) NOT NULL,
  `val` varchar(200) DEFAULT NULL,
  `maxval` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `footer` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `km_person_count`
--

INSERT INTO `km_person_count` (`id`, `val`, `maxval`, `title`, `footer`) VALUES
(1, '34', '20', 'Kmutt Counting', 'Congratulation');

-- --------------------------------------------------------

--
-- Table structure for table `km_user`
--

CREATE TABLE `km_user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(200) NOT NULL,
  `user_pass` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `km_user`
--

INSERT INTO `km_user` (`user_id`, `user_username`, `user_pass`, `name`) VALUES
(1, 'administrator', 'password', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `km_person_count`
--
ALTER TABLE `km_person_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `km_user`
--
ALTER TABLE `km_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `km_person_count`
--
ALTER TABLE `km_person_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `km_user`
--
ALTER TABLE `km_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
