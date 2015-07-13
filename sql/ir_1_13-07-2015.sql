-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2015 at 02:54 PM
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
-- Table structure for table `sb_admin`
--

CREATE TABLE IF NOT EXISTS `sb_admin` (
`admin_id` int(2) NOT NULL COMMENT 'Primary Key',
  `admin_uname` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Username',
  `admin_passwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Password',
  `admin_password_salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Password Salt',
  `admin_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Email',
  `admin_type` enum('1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Admin Type',
  `admin_status` tinyint(1) NOT NULL COMMENT 'Admin Status ',
  `admin_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Admin Created On'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table Stores Admin Credentials';

--
-- Dumping data for table `sb_admin`
--

INSERT INTO `sb_admin` (`admin_id`, `admin_uname`, `admin_passwd`, `admin_password_salt`, `admin_email`, `admin_type`, `admin_status`, `admin_created_on`) VALUES
(1, 'admin', '123456', '$2y$10$G.JoOHjAOcMb7PDHWHSSGugoWxasJpMYKp5sSiz4sIDgSIMMNgis2', 'admin@admin.com', '1', 1, '2015-07-13 08:46:04');

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

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_child_services`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_child_services` (
`sb_child_service_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_child_servcie_name` int(150) NOT NULL COMMENT 'Child Service Name',
  `sb_child_service_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Service Created On'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds child services';

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_guest_bookings`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_guest_bookings` (
`sb_hotel_guest_booking_id` int(11) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_id` int(11) NOT NULL COMMENT 'FK(sb_hotels)',
  `sb_guest_reference_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Reference id',
  `sb_guest_check_in_date` date NOT NULL COMMENT 'check in date',
  `sb_guest_check_out_date` date NOT NULL COMMENT 'check out date ',
  `sb_guest_rooms_alloted` int(11) NOT NULL COMMENT 'no of rooms alloted',
  `sb_guest_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'guest created on'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds guest bookings created by hotel admins/admin';

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_guest_reservation_attributes`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_guest_reservation_attributes` (
`sb_guest_res_attr_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_guest_refernce_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'FK(sb_hotel_guest_bookings)',
  `sb_guest_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'guest name',
  `sb_guest_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'guest email',
  `sb_guest_contact_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'guest contact no',
  `sb_guest_actual_check_in` datetime NOT NULL COMMENT 'guest check in date',
  `sb_guest_actual_check_out` datetime NOT NULL COMMENT 'guest check out date',
  `sb_guest_allocated_room_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'guest allocated room no',
  `sb_guest_last_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'data modified on'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds guest booking and other attributes';

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_manager_cat`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_manager_cat` (
`sb_manager_cat_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_manager_cat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Manager Category Name'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds manager category';

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_parent_services`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_parent_services` (
`sb_parent_service_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_parent_service_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Parent service name',
  `sb_parent_service_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Parent service created on'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds parent service data';

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_request_service`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_request_service` (
  `sb_hotel_requst_ser_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_id` int(10) NOT NULL COMMENT 'FK(sb_hotels)',
  `sb_hotel_service_map_id` int(10) NOT NULL COMMENT 'FK(sb_hotel_service_map)',
  `sb_guest_reference_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sb_guest_refernce_id',
  `sb_guest_allocated_room_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sb_allocated_room_no',
  `sb_hotel_ser_vendor_id` int(10) NOT NULL COMMENT 'FK(sb_venor)',
  `sb_hotel_ser_reqstd_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'service requested on',
  `sb_service_log` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds requested services data';

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_services_status`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_services_status` (
`sb_service_status_id` int(11) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_requst_ser_id` int(11) NOT NULL COMMENT 'FK(sb_hotel_request_service)',
  `sb_hotel_service_assigned` enum('y','n') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Is service allocated',
  `sb_hotel_ser_assgnd_to_user_id` int(11) NOT NULL COMMENT 'FK(sb_hotel_user_id)',
  `sb_hotel_ser_start_date` date NOT NULL COMMENT 'service start date',
  `sb_hotel_ser_start_time` time NOT NULL COMMENT 'service start time',
  `sb_hotel_ser_finished_date` date NOT NULL COMMENT 'service finished date',
  `sb_hotel_ser_finished_time` time NOT NULL COMMENT 'service finished time',
  `sb_hotel_service_status` int(11) NOT NULL COMMENT 'FK(service status tbl)',
  `sb_ser_updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'service updated on'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds service status';

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_service_map`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_service_map` (
  `sb_hotel_service_map_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_parent_service_id` int(10) NOT NULL COMMENT 'FK(sb_hotel_parent_service)',
  `sb_child_service_id` int(10) NOT NULL COMMENT 'FK(ab_hotel_child_service)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds parent child service mapping';

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_staff_cat`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_staff_cat` (
`sb_staff_cat_id` int(10) NOT NULL COMMENT 'Primary Key',
  `sb_staff_cat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Staff category name'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds staff category';

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

-- --------------------------------------------------------

--
-- Table structure for table `sb_hotel_user_service_access_map`
--

CREATE TABLE IF NOT EXISTS `sb_hotel_user_service_access_map` (
`sb_hotel_user_ser_map_id` int(11) NOT NULL COMMENT 'Primary Key',
  `sb_hotel_user_id` int(11) NOT NULL COMMENT 'FK(sb_hotel_users)',
  `sb_hotel_service_map_id` int(11) NOT NULL COMMENT 'FK(sb_hotel_service_map)',
  `sb_service_rel_creatd_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'service created on',
  `sb_service_rel_status` tinyint(4) NOT NULL COMMENT 'service status',
  `sb_service_relation_updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'service updated on'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds user  service relation';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sb_admin`
--
ALTER TABLE `sb_admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `sb_hotels`
--
ALTER TABLE `sb_hotels`
 ADD PRIMARY KEY (`sb_hotel_id`);

--
-- Indexes for table `sb_hotel_child_services`
--
ALTER TABLE `sb_hotel_child_services`
 ADD PRIMARY KEY (`sb_child_service_id`);

--
-- Indexes for table `sb_hotel_guest_bookings`
--
ALTER TABLE `sb_hotel_guest_bookings`
 ADD PRIMARY KEY (`sb_hotel_guest_booking_id`);

--
-- Indexes for table `sb_hotel_guest_reservation_attributes`
--
ALTER TABLE `sb_hotel_guest_reservation_attributes`
 ADD PRIMARY KEY (`sb_guest_res_attr_id`);

--
-- Indexes for table `sb_hotel_manager_cat`
--
ALTER TABLE `sb_hotel_manager_cat`
 ADD PRIMARY KEY (`sb_manager_cat_id`);

--
-- Indexes for table `sb_hotel_parent_services`
--
ALTER TABLE `sb_hotel_parent_services`
 ADD PRIMARY KEY (`sb_parent_service_id`);

--
-- Indexes for table `sb_hotel_request_service`
--
ALTER TABLE `sb_hotel_request_service`
 ADD PRIMARY KEY (`sb_hotel_requst_ser_id`);

--
-- Indexes for table `sb_hotel_services_status`
--
ALTER TABLE `sb_hotel_services_status`
 ADD PRIMARY KEY (`sb_service_status_id`);

--
-- Indexes for table `sb_hotel_service_map`
--
ALTER TABLE `sb_hotel_service_map`
 ADD PRIMARY KEY (`sb_hotel_service_map_id`);

--
-- Indexes for table `sb_hotel_staff_cat`
--
ALTER TABLE `sb_hotel_staff_cat`
 ADD PRIMARY KEY (`sb_staff_cat_id`);

--
-- Indexes for table `sb_hotel_users`
--
ALTER TABLE `sb_hotel_users`
 ADD PRIMARY KEY (`sb_hotel_user_id`);

--
-- Indexes for table `sb_hotel_user_service_access_map`
--
ALTER TABLE `sb_hotel_user_service_access_map`
 ADD PRIMARY KEY (`sb_hotel_user_ser_map_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sb_admin`
--
ALTER TABLE `sb_admin`
MODIFY `admin_id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sb_hotels`
--
ALTER TABLE `sb_hotels`
MODIFY `sb_hotel_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_child_services`
--
ALTER TABLE `sb_hotel_child_services`
MODIFY `sb_child_service_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_guest_bookings`
--
ALTER TABLE `sb_hotel_guest_bookings`
MODIFY `sb_hotel_guest_booking_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_guest_reservation_attributes`
--
ALTER TABLE `sb_hotel_guest_reservation_attributes`
MODIFY `sb_guest_res_attr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_manager_cat`
--
ALTER TABLE `sb_hotel_manager_cat`
MODIFY `sb_manager_cat_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_parent_services`
--
ALTER TABLE `sb_hotel_parent_services`
MODIFY `sb_parent_service_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_services_status`
--
ALTER TABLE `sb_hotel_services_status`
MODIFY `sb_service_status_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_staff_cat`
--
ALTER TABLE `sb_hotel_staff_cat`
MODIFY `sb_staff_cat_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_users`
--
ALTER TABLE `sb_hotel_users`
MODIFY `sb_hotel_user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
--
-- AUTO_INCREMENT for table `sb_hotel_user_service_access_map`
--
ALTER TABLE `sb_hotel_user_service_access_map`
MODIFY `sb_hotel_user_ser_map_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
