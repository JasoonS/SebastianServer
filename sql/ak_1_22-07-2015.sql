
ALTER TABLE `sb_guest_services` CHANGE `order_detail_id` `service_detail` TEXT NOT NULL COMMENT 'if req is order then this will contain order detail table FK else request details will be in json format';

ALTER TABLE `sb_guest_services` ADD `sb_child_service_id` INT NOT NULL COMMENT 'fk(sb_hotel_child_services)' AFTER `sb_staff_cat_id`;

ALTER TABLE `sb_hotel_services_status` CHANGE `sb_hotel_service_status` `sb_hotel_service_status` ENUM('pending','completed','accepted','rejected') NOT NULL DEFAULT 'pending' COMMENT 'Service current status';

ALTER TABLE `sb_hotel_request_service` CHANGE `sb_guest_reference_id` `sb_hotel_guest_booking_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'sb_hotel_guest_booking_id';

ALTER TABLE `sb_hotel_request_service` ADD `sb_parent_service_id` INT NOT NULL COMMENT 'PK(sb_hotel_parent_services)' AFTER `sb_hotel_service_map_id`;

ALTER TABLE `sb_hotel_user_service_access_map` ADD `sb_parent_service_id` INT NOT NULL COMMENT 'PK(sb_hotel_parent_services)' AFTER `sb_hotel_service_map_id`;

ALTER TABLE `sb_hotel_users` CHANGE `sb_staff_cat_id` `sb_staff_designation_id` INT(10) NOT NULL COMMENT 'FK(sb_hotel_staff_designation)';

CREATE TABLE IF NOT EXISTS `sb_hotel_staff_designation` (
`sb_staff_designation_id` int(11) NOT NULL,
  `sb_staff_designation_name` varchar(150) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `sb_hotel_staff_designation`
 ADD PRIMARY KEY (`sb_staff_designation_id`);

ALTER TABLE `sb_hotel_staff_designation`
MODIFY `sb_staff_designation_id` int(11) NOT NULL AUTO_INCREMENT;