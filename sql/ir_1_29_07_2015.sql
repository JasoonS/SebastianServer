-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2015 at 03:16 PM
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
-- Table structure for table `sb_modules`
--

CREATE TABLE IF NOT EXISTS `sb_modules` (
`sb_mod_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_mod_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Module Key',
  `sb_mod_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Module Name',
  `sb_mod_is_parent` enum('y','n') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Is parent module',
  `sb_mod_parent_id` int(10) NOT NULL COMMENT 'Parent id if not module is not parent',
  `sb_mod_status` tinyint(1) NOT NULL COMMENT 'module status'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds parent and child modules';

--
-- Dumping data for table `sb_modules`
--

INSERT INTO `sb_modules` (`sb_mod_id`, `sb_mod_key`, `sb_mod_name`, `sb_mod_is_parent`, `sb_mod_parent_id`, `sb_mod_status`) VALUES
(1, 'admin_activities', 'Admin activities', 'y', 0, 1),
(2, 'hotel', 'Hotel', 'n', 1, 1),
(7, 'user/type/hotel-staff', 'hotel staff', 'n', 3, 1),
(3, 'hotel_user', 'Hotel user', 'y', 0, 1),
(4, 'user/type/hotel-admin', 'Hotel Admins', 'n', 3, 1),
(5, 'user/type/hotel-managers', 'Hotel Managers', 'n', 3, 1),
(6, 'user/type/admin', 'admin', 'n', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_modules`
--
ALTER TABLE `sb_modules`
 ADD PRIMARY KEY (`sb_mod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_modules`
--
ALTER TABLE `sb_modules`
MODIFY `sb_mod_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
