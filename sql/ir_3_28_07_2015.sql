-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2015 at 11:06 AM
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
-- Table structure for table `sb_roles_mod`
--

CREATE TABLE IF NOT EXISTS `sb_roles_mod` (
`sb_role_mod_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_roleid` int(10) NOT NULL COMMENT 'FK(sb_roles)',
  `sb_mod_id` int(10) NOT NULL COMMENT 'FK(sb_modules)',
  `sb_role_mod_val` tinyint(1) NOT NULL COMMENT 'role mod value',
  `sb_role_mod_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds roles modules association';

--
-- Dumping data for table `sb_roles_mod`
--

INSERT INTO `sb_roles_mod` (`sb_role_mod_id`, `sb_roleid`, `sb_mod_id`, `sb_role_mod_val`, `sb_role_mod_added_on`) VALUES
(1, 1, 1, 1, '2015-07-27 06:43:14'),
(2, 1, 3, 1, '2015-07-27 06:43:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_roles_mod`
--
ALTER TABLE `sb_roles_mod`
 ADD PRIMARY KEY (`sb_role_mod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_roles_mod`
--
ALTER TABLE `sb_roles_mod`
MODIFY `sb_role_mod_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
