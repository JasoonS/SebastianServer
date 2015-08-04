-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2015 at 10:52 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sandbox_sebastian`
--

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_lang_map`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_lang_map` (
  `map_id` int(11) NOT NULL,
  `sb_hotel_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sb_hotel_lang_map`
--

INSERT INTO `sb_hotel_lang_map` (`map_id`, `sb_hotel_id`, `lang_id`) VALUES
(4, 1, 1),
(5, 1, 2),
(6, 1, 6),
(38, 23, 1),
(39, 23, 2),
(40, 23, 3),
(41, 23, 4),
(42, 23, 5),
(43, 23, 6),
(44, 23, 7),
(45, 23, 8),
(46, 23, 9),
(47, 22, 1),
(48, 22, 2),
(49, 22, 3),
(50, 22, 4),
(51, 22, 5),
(52, 22, 6),
(53, 22, 7),
(54, 22, 8),
(55, 22, 9),
(56, 21, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_hotel_lang_map`
--
ALTER TABLE `sb_hotel_lang_map`
  ADD PRIMARY KEY (`map_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_hotel_lang_map`
--
ALTER TABLE `sb_hotel_lang_map`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
