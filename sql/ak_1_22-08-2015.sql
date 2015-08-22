-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2015 at 08:23 AM
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
-- Table structure for table `sb_hotel_restaurant`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_restaurant` (
`sb_hotel_restaurant` bigint(20) NOT NULL,
  `sb_hotel_id` bigint(20) NOT NULL,
  `sb_hotel_restaurant_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `sb_hotel_restaurant_details` text COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_delete` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_hotel_restaurant`
--
ALTER TABLE `sb_hotel_restaurant`
 ADD PRIMARY KEY (`sb_hotel_restaurant`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_hotel_restaurant`
--
ALTER TABLE `sb_hotel_restaurant`
MODIFY `sb_hotel_restaurant` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;