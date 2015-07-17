USE `sandbox_sebastian`;

ALTER TABLE `sb_hotel_guest_reservation_attributes` ADD `sb_guest_terms` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '1= terms and conditions accepted' AFTER `sb_guest_allocated_room_no`;

ALTER TABLE `sb_hotel_guest_reservation_attributes` CHANGE `sb_guest_name` `sb_guest_firstName` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'guest first name';

ALTER TABLE `sb_hotel_guest_reservation_attributes` ADD `sb_guest_lastName` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'guest last name' AFTER `sb_guest_firstName`;

ALTER TABLE `sb_hotel_guest_reservation_attributes` CHANGE `sb_guest_refernce_id` `sb_guest_reference_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'FK(sb_hotel_guest_bookings)';

