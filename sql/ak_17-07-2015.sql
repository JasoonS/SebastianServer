USE `sandbox_sebastian`;

CREATE TABLE IF NOT EXISTS `sb_staff_devicetoken` (
  `sdt_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sdt_token` varchar(255) NOT NULL,
  `sdt_deviceType` enum('ios','android') NOT NULL,
  `sdt_macid` varchar(255) NOT NULL,
  `sb_hotel_user_id` varchar(255) NOT NULL COMMENT 'FK(sb_hotel_users)',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sdt_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `sb_guest_devicetoken` (
  `cdt_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cdt_token` varchar(255) NOT NULL,
  `cdt_deviceType` enum('ios','android') NOT NULL,
  `sb_hotel_guest_booking_id` varchar(255) NOT NULL COMMENT 'FK(sb_hotel_guest_bookings)',
  `cdt_macid` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cdt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

ALTER TABLE `sb_hotel_service_map` CHANGE `sb_hotel_service_map_id` `sb_hotel_service_map_id` INT(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

ALTER TABLE `sb_hotel_service_map` ADD `sb_hotel_id` INT NOT NULL COMMENT 'FK(sb_hotels)' AFTER `sb_hotel_service_map_id`;

ALTER TABLE `sb_hotel_parent_services` ADD `sb_parent_service_image` VARCHAR(150) NOT NULL COMMENT 'Image name for Parent Service' AFTER `sb_parent_service_name`, ADD `sb_parent_service_color` VARCHAR(20) NOT NULL COMMENT 'Color code for that service text' AFTER `sb_parent_service_image`;

ALTER TABLE `sb_hotel_child_services` ADD `sb_child_servcie_detail` TEXT NOT NULL COMMENT 'child servcie detail' AFTER `sb_child_servcie_name`;

ALTER TABLE `sb_hotel_child_services` CHANGE `sb_child_servcie_name` `sb_child_servcie_name` VARCHAR(150) NOT NULL COMMENT 'Child Service Name';

