-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2015 at 02:24 PM
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
-- Table structure for table `sb_admin`
--

CREATE TABLE IF NOT EXISTS `sb_admin` (
  `admin_id` int(2) NOT NULL COMMENT 'Primary Key',
  `admin_uname` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Username',
  `admin_password_salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Password Salt',
  `admin_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Email',
  `admin_type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Type',
  `admin_status` tinyint(1) NOT NULL COMMENT 'Admin Status ',
  `admin_last_logged_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Admin last Login',
  `admin_created_on` datetime NOT NULL COMMENT 'Admin Created On'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table Stores Admin Credentials';

--
-- Dumping data for table `sb_admin`
--

INSERT INTO `sb_admin` (`admin_id`, `admin_uname`, `admin_password_salt`, `admin_email`, `admin_type`, `admin_status`, `admin_last_logged_in`, `admin_created_on`) VALUES
(1, 'admin', '$2y$10$G.JoOHjAOcMb7PDHWHSSGugoWxasJpMYKp5sSiz4sIDgSIMMNgis2', 'admin@admin.com', '1', 1, '0000-00-00 00:00:00', '2015-07-13 01:46:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_admin`
--
ALTER TABLE `sb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_admin`
--
ALTER TABLE `sb_admin`
  MODIFY `admin_id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
