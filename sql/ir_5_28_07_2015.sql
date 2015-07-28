-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2015 at 11:12 AM
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
-- Table structure for table `sb_user_roles`
--

CREATE TABLE IF NOT EXISTS `sb_user_roles` (
`sb_user_role_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_user_id` int(10) NOT NULL COMMENT 'FK(sb_hotel_users)',
  `sb_roleid` int(10) NOT NULL COMMENT 'FK(sb_roles)',
  `sb_role_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'user with role added on',
  `sb_user_role_status` tinyint(1) NOT NULL COMMENT 'role status'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds roles assigned to user id';

--
-- Dumping data for table `sb_user_roles`
--

INSERT INTO `sb_user_roles` (`sb_user_role_id`, `sb_hotel_user_id`, `sb_roleid`, `sb_role_added_on`, `sb_user_role_status`) VALUES
(1, 1, 1, '2015-07-27 06:40:55', 1),
(2, 1, 2, '2015-07-27 06:40:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_user_roles`
--
ALTER TABLE `sb_user_roles`
 ADD PRIMARY KEY (`sb_user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_user_roles`
--
ALTER TABLE `sb_user_roles`
MODIFY `sb_user_role_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
