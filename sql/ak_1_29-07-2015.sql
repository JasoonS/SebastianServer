ALTER TABLE  `sb_hotel_services_status` ADD  `reject_reson` VARCHAR( 255 ) NOT NULL AFTER  `sb_hotel_service_status` ;

ALTER TABLE  `sb_hotel_services_status` CHANGE  `reject_reson`  `reject_reason` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ;

ALTER TABLE `sb_hotels` ADD `sb_hotel_phone` VARCHAR(15) NOT NULL AFTER `sb_hotel_address`;