ALTER TABLE `sb_hotel_guest_bookings` ADD `dnd` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '0 = DND OFF, 1= DND ACTIVE' AFTER `is_checkedout`;

ALTER TABLE `sb_guest_devicetoken` ADD `dnd` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '0 = DND OFF, 1= DND ACTIVE' AFTER `created_on`;