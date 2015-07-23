DROP TABLE `sb_hotel_staff_cat`, `sb_hotel_staff_cat_map`;

ALTER TABLE `sb_hotel_services_status` CHANGE `sb_hotel_service_assigned` `sb_hotel_service_assigned` ENUM('y','n') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n' COMMENT 'Is service allocated';

