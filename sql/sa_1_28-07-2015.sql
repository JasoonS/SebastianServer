ALTER TABLE `sb_hotel_services_status` CHANGE `sb_hotel_service_assigned` `sb_hotel_service_assigned` ENUM('y','n') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n' COMMENT 'Is service allocated';

ALTER TABLE `sb_hotel_child_services` ADD `service_image` VARCHAR(255) NOT NULL AFTER `sb_child_servcie_detail`;