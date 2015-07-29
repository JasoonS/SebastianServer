-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2015 at 11:05 AM
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
-- Table structure for table `sb_roles`
--

CREATE TABLE IF NOT EXISTS `sb_roles` (
`sb_roleid` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_role` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Roles',
  `sb_role_status` tinyint(1) NOT NULL COMMENT 'Role status'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds roles';

--
-- Dumping data for table `sb_roles`
--

INSERT INTO `sb_roles` (`sb_roleid`, `sb_role`, `sb_role_status`) VALUES
(1, 'admin', 1),
(2, 'hotel admin', 1),
(3, 'hotel manager', 1),
(4, 'hotel staff', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_roles`
--
ALTER TABLE `sb_roles`
 ADD PRIMARY KEY (`sb_roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_roles`
--
ALTER TABLE `sb_roles`
MODIFY `sb_roleid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
