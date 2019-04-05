-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2019 at 03:09 AM
-- Server version: 10.3.13-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id336246_facespace`
--
CREATE DATABASE IF NOT EXISTS `id336246_facespace` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id336246_facespace`;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `userid`, `title`, `body`, `postDate`, `likes`) VALUES
(1, 1, 'Welcome!', 'Welcome to Facespace created by Joe Hernandez & Esmir Osmanovic. Feel free to share anything!', '2019-03-05 01:37:47', 247),
(6, 2, 'Goosebumps are caused by a muscle.', 'Arrector pili muscles, fan-shaped muscles at the base of each hair, are responsible for goosebumps—which contract when the body is cold in an effort to generate heat and cause a person’s hair to “stand up straight” on their skin.', '2019-03-05 01:40:55', 12),
(7, 2, 'A cruise ship crashed so much it had to rename.', 'The Norwegian Dream suffered a series of troubles over its 14-year lifespan that led many to believe that it was cursed. In August 1999, it collided with a container ship on the way to Dover, England. Eight years later, it hit a barge while leaving Uruguay. In November 2005, a passenger died while snorkeling on board when the ship was anchored. It’s no wonder the ships owners eventually renamed the disaster-prone vessel.', '2019-03-05 01:47:30', 45),
(8, 1, 'Ketchup', 'Ketchup was sold in the 1830s as medicine.', '2019-03-05 01:50:41', 234),
(9, 0, 'Whats up?', 'I hope all of you have a good day! :)', '2019-03-05 01:52:39', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `email`, `password`) VALUES
(1, 'jhern61', 'jhern61@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710'),
(2, 'Oesmir', 'Oesmir30@gmail.com', 'b654972762106f8079173399ecfc1736'),
(3, 'jhern', 'parvenu05@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
