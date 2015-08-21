ALTER TABLE `sb_hotel_service_map` DROP `sb_sub_child_price`, DROP `sb_child_price`, DROP `sb_sub_child_service_id`;
ALTER TABLE `sb_hotel_request_service` ADD `order_details` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '0- no details for request order, 1 details for request order' ;
ALTER TABLE `sb_customer_order_placed` ADD `order_details` INT NOT NULL ;