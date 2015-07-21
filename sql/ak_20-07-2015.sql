USE `sandbox_sebastian`;

ALTER TABLE `sb_hotel_users` ADD `sb_staff_cat_id` INT(10) NOT NULL COMMENT 'FK(sb_hotel_staff_cat)' AFTER `sb_hotel_user_status`;

ALTER TABLE `sb_hotel_users` ADD `sb_hotel_user_shift_from` TIME NOT NULL COMMENT 'Staff''s start shift time ' AFTER `sb_staff_cat_id`, ADD `sb_hotel_user_shift_to` TEXT NOT NULL COMMENT 'Staff''s end shift time ' AFTER `sb_hotel_user_shift_from`;

ALTER TABLE `sb_hotel_users` CHANGE `sb_hotel_user_shift_to` `sb_hotel_user_shift_to` TIME NOT NULL COMMENT 'Staff''s end shift time ';

ALTER TABLE `sb_hotel_users` CHANGE `sb_hotel_user_status` `sb_hotel_user_status` TINYINT(1) NOT NULL COMMENT 'user status, 1= Active user; 0 = Deleted user';

ALTER TABLE `sb_hotel_users` ADD `sb_hotel_user_pic` VARCHAR(250) NOT NULL COMMENT 'Profile picture Only name' AFTER `sb_hotel_userpasswd`;