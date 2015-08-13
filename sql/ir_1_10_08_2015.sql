ALTER TABLE `sb_hotel_service_map` ADD `sb_sub_child_service_id` INT(10) NOT NULL COMMENT 'FK(sub_child_service_id)' AFTER `sb_child_service_price`;

ALTER TABLE `sb_hotel_service_map` ADD `is_child_paid` ENUM('y','n') NOT NULL DEFAULT 'n' COMMENT 'Is child Paid' AFTER `sb_child_service_id`;

ALTER TABLE `sb_hotel_service_map` CHANGE `is_child_paid` `sb_is_child_paid` ENUM('y','n') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n' COMMENT 'Is child Paid';

ALTER TABLE `sb_hotel_service_map` ADD `sb_child_price` FLOAT(5,2) NOT NULL DEFAULT '0.00' COMMENT 'Child service price' AFTER `sb_is_child_paid`;


ALTER TABLE `sb_hotel_service_map` ADD `is_sub_child_paid` ENUM('y','n') NOT NULL DEFAULT 'n' COMMENT 'Is sub child payble' AFTER `sb_sub_child_service_id`;

ALTER TABLE `sb_hotel_service_map` ADD `sb_sub_child_price` FLOAT(5,2) NOT NULL DEFAULT '0.00' COMMENT 'Sub Child Price' AFTER `is_sub_child_paid`;

ALTER TABLE `sb_hotel_service_map` CHANGE `is_sub_child_paid` `sb_is_sub_child_paid` ENUM('y','n') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n' COMMENT 'Is sub child payble';
