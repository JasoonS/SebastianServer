-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2015 at 10:15 AM
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
-- Table structure for table `sb_hotels`
--
USE `sandbox_sebastian`;

CREATE TABLE IF NOT EXISTS `sb_hotels` (
  `sb_hotel_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hotel Name',
  `sb_hotel_country` int(10) NOT NULL COMMENT 'Hotel Country',
  `sb_hotel_city` int(10) NOT NULL COMMENT 'Hotel City',
  `sb_hotel_state` int(10) NOT NULL COMMENT 'Hotel State',
  `sb_hotel_zipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hotel Zip code',
  `sb_hotel_address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hotel Address',
  `sb_hotel_star` tinyint(1) NOT NULL COMMENT 'Hotel Star',
  `sb_hotel_category` enum('Hotel','Resort','','') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hotel Category',
  `sb_hotel_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Hotel Created On',
  `sb_hotel_website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sb_hotel_pic` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sb_hotel_owner` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sb_property_built_month` int(11) NOT NULL,
  `sb_hotel_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sb_property_built_year` int(11) NOT NULL,
  `sb_property_open_year` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - inactive 1-active'
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds hotel demographics';

--
-- Dumping data for table `sb_hotels`
--

INSERT INTO `sb_hotels` (`sb_hotel_id`, `sb_hotel_name`, `sb_hotel_country`, `sb_hotel_city`, `sb_hotel_state`, `sb_hotel_zipcode`, `sb_hotel_address`, `sb_hotel_star`, `sb_hotel_category`, `sb_hotel_created_on`, `sb_hotel_website`, `sb_hotel_pic`, `sb_hotel_owner`, `sb_property_built_month`, `sb_hotel_email`, `sb_property_built_year`, `sb_property_open_year`, `is_active`) VALUES
(1, 'Eesh ana', 1, 2, 4, '411028', 'Swargate, Pune', 5, '', '2015-07-23 10:05:12', '', '', '', 0, '', 0, 0, 1),
(2, 'hjgjgh', 1, 5909, 42, '23334', 'jghjgh', 0, 'Hotel', '2015-07-23 12:44:33', '', '', '', 0, '', 0, 0, 1),
(3, 'dadsa', 1, 5909, 42, '12345', 'fdfsdf', 3, 'Hotel', '2015-07-23 13:08:39', '', '', '', 0, '', 0, 0, 1),
(4, 'sdfsdfs', 1, 5909, 42, '12344', 'fdsf', 2, 'Hotel', '2015-07-23 13:09:24', '', '', '', 0, '', 0, 0, 1),
(5, 'dsadsa', 1, 5909, 42, '12345', 'dsadasdas', 0, 'Hotel', '2015-07-23 13:10:07', '', '', '', 0, '', 0, 0, 1),
(6, 'Myhotel', 1, 5909, 42, '42342', 'czxczxc', 2, 'Hotel', '2015-07-24 08:55:32', '', '', '', 0, '', 0, 0, 1),
(7, 'gfdgfdg', 1, 5909, 42, '32424', 'gdf', 3, 'Hotel', '2015-07-24 09:22:49', '', '', '', 0, '', 0, 0, 1),
(8, 'gfdgfdgfdgdf', 1, 5909, 42, '54354', 'gfdgdf', 2, 'Resort', '2015-07-24 09:23:25', '', '', '', 0, '', 0, 0, 1),
(9, 'hgfdhgf', 1, 5909, 42, '43242', 'ghfhfgh', 2, 'Hotel', '2015-07-24 09:24:19', '', '', '', 0, '', 0, 0, 1),
(10, 'ret', 1, 5909, 42, '43243', 'tret', 2, 'Hotel', '2015-07-24 09:27:22', '', '', '', 0, '', 0, 0, 1),
(11, 'ggdfgfdg', 1, 5909, 42, '12344', 'hgghfh', 5, 'Hotel', '2015-07-27 06:04:52', 'http://getbootstrap.com', '', 'fdsfdsf', 0, 'kalyani.joshi@eeshana.com', 0, 0, 1),
(12, 'gfdgfdgfdgfd', 1, 5909, 42, '43242', 'fdsfsdf', 2, 'Hotel', '2015-07-27 06:15:52', 'http://getbootstrap.com', '1437977752.jpg', 'fdsf fdsf', 0, 'gfdgfdgfg@q.com', 0, 0, 1),
(13, 'gdfggfdg', 1, 5909, 42, '12344', 'hgghfh', 5, 'Hotel', '2015-07-27 06:18:11', 'http://getbootstrap.com', '1437977891.jpg', 'KJ', 0, 'kalyani.joshi@eeshana.com', 0, 0, 1),
(14, 'gdfggfdg', 1, 5909, 42, '12344', 'hgghfh', 5, 'Hotel', '2015-07-27 06:18:48', 'http://getbootstrap.com', '1437977891.jpg', 'KJ', 0, 'kalyani.joshi@eeshana.com', 0, 0, 1),
(15, 'mmmm', 1, 5909, 42, '43243', 'fdsf', 2, 'Hotel', '2015-07-27 06:20:04', 'http://getbootstrap.com', '1437978004.jpg', 'fdsf', 0, 'dsadsad@ee.com', 0, 0, 1),
(16, 'bvcbcbvb', 1, 5909, 42, '12344', 'hgghfh', 3, 'Hotel', '2015-07-27 07:29:21', 'http://stackoverflow.com', '', 'fdsfds', 4, 'kalyani.joshi@eeshana.com', 1998, 2002, 1),
(17, 'hgfhgfhgf', 1, 5909, 42, '12344', 'hgghfh', 4, 'Hotel', '2015-07-27 08:21:23', 'http://jqueryui.com', '1437985283.jpg', 'fdsdf', 1, 'kalyani.joshi@eeshana.com', 2010, 2012, 1),
(18, 'fsfsd', 1, 5909, 42, '54354', '5435435', 6, 'Hotel', '2015-07-27 08:24:47', 'http://stackoverflow.com', '', '4554', 1, 'dfsfdsfdfdsfd@qqq.com', 1997, 1998, 1),
(19, 'dsadsadsdas', 1, 5910, 42, '435', 'fdfsdf', 4, 'Hotel', '2015-07-28 07:06:14', 'http://stackoverflow.com', '1437985592.jpg', 'fsdaf', 1, 'dfffsdd@qq.com', 2014, 2014, 1),
(20, 'fdfsdf', 178, 33094, 2921, '45345', 'gfdgfdgfgfg', 7, 'Hotel', '2015-07-28 07:49:59', 'http://getbootstrap.com', '1438069799.jpg', 'fdafdsf', 0, 'fsdfdsfsdf@qq.com', 2013, 2015, 1);

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
  MODIFY `sb_hotel_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
