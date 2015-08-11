ALTER TABLE `sb_hotel_service_map` ADD `sb_sub_child_service_id` INT(10) NOT NULL ;
ALTER TABLE `sb_hotel_service_map` ADD `sb_sub_child_price` INT( 10 ) NOT NULL DEFAULT '0.00';
ALTER TABLE `sb_hotel_request_service` CHANGE `quantity` `sb_quantity` INT( 10 ) NOT NULL ;