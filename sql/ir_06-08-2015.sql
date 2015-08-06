ALTER TABLE `sb_hotel_service_map` ADD `sb_is_service_in_use` TINYINT(1) NOT NULL COMMENT '1-Used,0-Not In Use' AFTER `sb_child_service_id`;
