-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2015 at 03:35 PM
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

USE `sandbox_sebastian`;

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotels`
--

CREATE TABLE IF NOT EXISTS `sb_hotels` (
`sb_hotel_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hotel Name',
  `sb_hotel_country` int(10) NOT NULL COMMENT 'Hotel Country',
  `sb_hotel_city` int(10) NOT NULL COMMENT 'Hotel City',
  `sb_hotel_state` int(10) NOT NULL COMMENT 'Hotel State',
  `sb_hotel_zipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hotel Zip code',
  `sb_hotel_address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hotel Address',
  `sb_hotel_star` tinyint(1) NOT NULL COMMENT 'Hotel Star',
  `sb_hotel_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hotel Category',
  `sb_hotel_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Hotel Created On'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds hotel demographics';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_hotels`
--
ALTER TABLE `sb_hotels`
 ADD PRIMARY KEY (`sb_hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_hotels`
--
ALTER TABLE `sb_hotels`
MODIFY `sb_hotel_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
