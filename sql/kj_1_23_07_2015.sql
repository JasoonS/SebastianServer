-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2015 at 07:52 AM
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
-- Table structure for table `sb_hotel_users`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_users` (
  `sb_hotel_user_id` int(11) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_id` int(11) NOT NULL COMMENT 'FK(sb_hotels)',
  `sb_hotel_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'hotel username',
  `sb_hotel_useremail` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user email',
  `sb_hotel_userpasswd` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user password',
  `sb_hotel_user_pic` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Profile picture Only name',
  `sb_hotel_user_type` enum('a','m','s') COLLATE utf8_unicode_ci NOT NULL COMMENT 'user type a-hotel admin,m-hotel manager,s-hotel staff',
  `sb_hotel_user_status` tinyint(1) NOT NULL COMMENT 'user status, 1= Active user; 0 = Deleted user',
  `sb_staff_designation_id` int(10) NOT NULL COMMENT 'FK(sb_hotel_staff_designation)',
  `sb_hotel_user_shift_from` time NOT NULL COMMENT 'Staff''s start shift time ',
  `sb_hotel_user_shift_to` time NOT NULL COMMENT 'Staff''s end shift time ',
  `sb_hotel_user_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'user created on'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sb_hotel_users`
--

INSERT INTO `sb_hotel_users` (`sb_hotel_user_id`, `sb_hotel_id`, `sb_hotel_username`, `sb_hotel_useremail`, `sb_hotel_userpasswd`, `sb_hotel_user_pic`, `sb_hotel_user_type`, `sb_hotel_user_status`, `sb_staff_designation_id`, `sb_hotel_user_shift_from`, `sb_hotel_user_shift_to`, `sb_hotel_user_created_on`) VALUES
(1, 1, 'Akshay', 'akshay.patil@eeshana.com', 'j4h8nhgq', '', 's', 1, 1, '10:00:00', '18:00:00', '2015-07-23 03:43:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_hotel_users`
--
ALTER TABLE `sb_hotel_users`
  ADD PRIMARY KEY (`sb_hotel_user_id`), ADD UNIQUE KEY `email_unique` (`sb_hotel_useremail`) COMMENT 'Hotel Staff Users have unique email';

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_hotel_users`
--
ALTER TABLE `sb_hotel_users`
  MODIFY `sb_hotel_user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
