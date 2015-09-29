-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2015 at 01:10 PM
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
-- Table structure for table `sb_modules`
--

CREATE TABLE IF NOT EXISTS `sb_modules` (
  `sb_mod_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_mod_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Module Key',
  `sb_mod_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Module Name',
  `sb_mod_is_parent` enum('y','n') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Is parent module',
  `sb_mod_parent_id` int(10) NOT NULL COMMENT 'Parent id if not module is not parent',
  `sb_mod_status` tinyint(1) NOT NULL COMMENT 'module status',
  `mod_order` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds parent and child modules';

--
-- Dumping data for table `sb_modules`
--

INSERT INTO `sb_modules` (`sb_mod_id`, `sb_mod_key`, `sb_mod_name`, `sb_mod_is_parent`, `sb_mod_parent_id`, `sb_mod_status`, `mod_order`) VALUES
(1, 'admin_activities', 'Property Info', 'y', 0, 1, 0),
(2, 'hotel', 'Signed Up Hotels', 'n', 1, 1, 1),
(7, 'hotel/view_hotel/', 'Property Description', 'n', 16, 1, 0),
(3, 'user/type/hotel-admin', 'Manage ', 'n', 1, 1, 3),
(4, 'user/type/hotel-admingfdgf', 'Hotel Admins', 'n', 3, 1, 4),
(5, 'user/type/hotel-managersf', 'Edit User', 'n', 0, 0, 5),
(6, 'user/type/admin', 'Super Administrators', 'n', 35, 1, 2),
(8, 'Performance-1', 'Performance', 'y', 0, 1, 6),
(9, 'Performance', 'Item Statistics', 'n', 8, 1, 8),
(10, 'HotelServices/edit', 'Add', 'n', 24, 1, 9),
(11, 'vendor', 'vendor', 'n', 1, 0, 10),
(12, 'Guestprofiles', 'Customer Experience', 'y', 0, 1, 6),
(13, 'guestprofiles/guest', 'Guest Feedback', 'n', 12, 1, 12),
(14, 'guestprofiles/guest_history', 'Guest history', 'n', 24, 1, 3),
(15, 'hotel/surroundings/', 'Surroundings', 'n', 16, 1, 20),
(16, 'Restaurants', 'Content', 'y', 0, 1, 4),
(17, 'HotelServices/edit', 'Facilities', 'n', 16, 1, 1),
(18, 'Hotel_rooms', 'Rates & availability', 'y', 0, 1, 1),
(19, 'HotelRooms', 'Manage', 'n', 18, 1, 18),
(20, 'hotel/photos/', 'Photos', 'n', 16, 1, 19),
(21, 'guestprofiles/guest_arrivals', 'Guests pre-arrival', 'n', 24, 1, 2),
(22, 'Notes', 'Live Chat', 'y', 0, 1, 21),
(23, 'notes/createnote', 'Guest in house', 'n', 24, 1, 1),
(24, 'Forum', 'Guest Info', 'y', 0, 1, 8),
(25, 'forum', 'Guest Chat', 'n', 22, 1, 1),
(26, 'Staff-p', 'Inbox', 'y', 0, 1, 20),
(27, 'staff', 'Staff Chat', 'n', 22, 1, 2),
(28, 'email', 'Guest Inbox', 'n', 26, 1, 22),
(32, 'email/staff_email', 'Staff Inbox', 'n', 26, 1, 23),
(41, 'HotelServices/add', 'Add New Services', 'n', 40, 1, 1),
(31, 'module', 'Add/Remove Module', 'n', 1, 1, 23),
(33, 'email/sebastian_email', 'Sebastian Inbox', 'n', 26, 1, 24),
(34, 'dashboard\r\n', 'Home\r\n', 'y', 0, 1, -1),
(35, 'admin_activities1', 'Admin Activities', 'y', 0, 1, 0),
(36, 'hotel', 'Signed Up Hotels', 'n', 35, 1, 1),
(37, 'hotel-user-admin', 'Hotel Users', 'y', 0, 1, 2),
(39, 'user/type/hotel-admin', 'Hotel Admin', 'n', 37, 1, 1),
(40, 'hotel-services', 'Hotel Services', 'y', 0, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_modules`
--
ALTER TABLE `sb_modules`
  ADD PRIMARY KEY (`sb_mod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_modules`
--
ALTER TABLE `sb_modules`
  MODIFY `sb_mod_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
