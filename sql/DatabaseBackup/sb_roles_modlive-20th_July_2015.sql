-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2015 at 05:09 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sebastian`
--

-- --------------------------------------------------------

--
-- Table structure for table `sb_roles_mod`
--

CREATE TABLE IF NOT EXISTS `sb_roles_mod` (
  `sb_role_mod_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `sb_roleid` int(10) NOT NULL COMMENT 'FK(sb_roles)',
  `sb_mod_id` int(10) NOT NULL COMMENT 'FK(sb_modules)',
  `sb_role_mod_val` tinyint(1) NOT NULL COMMENT 'role mod value',
  `sb_role_mod_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sb_role_mod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds roles modules association' AUTO_INCREMENT=39 ;

--
-- Dumping data for table `sb_roles_mod`
--

INSERT INTO `sb_roles_mod` (`sb_role_mod_id`, `sb_roleid`, `sb_mod_id`, `sb_role_mod_val`, `sb_role_mod_added_on`) VALUES
(1, 1, 1, 1, '2015-07-27 13:43:14'),
(2, 1, 3, 1, '2015-07-27 13:43:14'),
(5, 2, 3, 1, '2015-07-31 05:43:45'),
(6, 3, 3, 1, '2015-07-31 05:44:09'),
(7, 1, 8, 1, '2015-08-10 13:51:35'),
(8, 2, 8, 1, '2015-08-13 09:41:40'),
(9, 2, 12, 1, '2015-08-13 10:22:46'),
(10, 2, 15, 1, '2015-08-13 10:22:46'),
(11, 2, 16, 1, '2015-08-13 10:22:46'),
(14, 2, 7, 1, '2015-08-31 10:53:35'),
(13, 2, 13, 1, '2015-08-13 10:22:46'),
(15, 2, 20, 1, '2015-08-13 10:22:46'),
(16, 2, 21, 1, '2015-08-13 10:22:46'),
(17, 2, 22, 1, '2015-08-13 10:22:46'),
(18, 2, 17, 1, '2015-08-13 10:22:46'),
(19, 2, 5, 1, '2015-09-07 13:10:27'),
(20, 2, 19, 1, '2015-09-07 13:10:24'),
(21, 2, 18, 1, '2015-09-07 13:10:24'),
(22, 2, 23, 1, '2015-09-07 13:10:24'),
(23, 2, 24, 1, '2015-09-07 13:10:24'),
(24, 2, 25, 1, '2015-09-07 13:10:24'),
(25, 2, 26, 1, '2015-09-07 13:10:24'),
(26, 2, 27, 1, '2015-09-07 13:10:24'),
(27, 2, 28, 1, '2015-09-23 08:02:43'),
(30, 2, 1, 1, '2015-07-31 05:43:45'),
(31, 2, 3, 1, '2015-07-31 05:43:45'),
(32, 2, 31, 1, '2015-07-31 05:43:45'),
(33, 2, 14, 1, '2015-07-31 05:43:45'),
(34, 2, 7, 1, '2015-07-31 05:43:45'),
(35, 2, 9, 1, '2015-07-31 05:43:45'),
(36, 2, 32, 1, '2015-07-31 05:43:45'),
(37, 2, 33, 1, '2015-07-31 05:43:45'),
(38, 2, 34, 1, '2015-07-31 05:43:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
