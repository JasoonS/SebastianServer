-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2015 at 11:08 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
-- Table structure for table `sb_user_modules`
--

CREATE TABLE IF NOT EXISTS `sb_user_modules` (
`sb_user_mod_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_user_id` int(10) NOT NULL COMMENT 'FK(sb_hotels_users)',
  `sb_mod_id` int(10) NOT NULL COMMENT 'FK(sb_modules)',
  `sb_user_mod_val` tinyint(1) NOT NULL COMMENT 'User Module Value',
  `sb_user_mod_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Added On'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds user and module association';

--
-- Dumping data for table `sb_user_modules`
--

INSERT INTO `sb_user_modules` (`sb_user_mod_id`, `sb_hotel_user_id`, `sb_mod_id`, `sb_user_mod_val`, `sb_user_mod_added_on`) VALUES
(2, 1, 2, 1, '2015-07-27 06:45:27'),
(3, 1, 4, 1, '2015-07-27 06:45:27'),
(4, 1, 6, 1, '2015-07-27 06:45:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_user_modules`
--
ALTER TABLE `sb_user_modules`
 ADD PRIMARY KEY (`sb_user_mod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_user_modules`
--
ALTER TABLE `sb_user_modules`
MODIFY `sb_user_mod_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
