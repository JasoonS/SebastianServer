-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2015 at 09:31 AM
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
-- Table structure for table `sb_hotel_users`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_users` (
`sb_hotel_user_id` int(11) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_id` int(11) NOT NULL COMMENT 'FK(sb_hotels)',
  `sb_hotel_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'hotel username',
  `sb_hotel_useremail` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user email',
  `sb_hotel_userpasswd` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user password',
  `sb_hotel_user_type` enum('a','m','s') COLLATE utf8_unicode_ci NOT NULL COMMENT 'user type a-hotel admin,m-hotel manager,s-hotel staff',
  `sb_hotel_user_status` tinyint(1) NOT NULL COMMENT 'user status',
  `sb_hotel_user_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'user created on'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_hotel_users`
--
ALTER TABLE `sb_hotel_users`
 ADD PRIMARY KEY (`sb_hotel_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_hotel_users`
--
ALTER TABLE `sb_hotel_users`
MODIFY `sb_hotel_user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
