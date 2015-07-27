USE `sandbox_sebastian`;
ALTER TABLE `sb_hotel_users` CHANGE `sb_hotel_user_type` `sb_hotel_user_type` ENUM('a','m','s','u') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user type a-hotel admin,m-hotel manager,s-hotel staff';
ALTER TABLE `sb_hotel_users` CHANGE `sb_hotel_user_type` `sb_hotel_user_type` ENUM('a','m','s','u') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user type a-hotel admin,m-hotel manager,s-hotel staff,u-system-admin';
ALTER TABLE `sb_hotel_users` ADD `sb_hotel_user_last_login` TIMESTAMP NOT NULL COMMENT 'User last login time' AFTER `sb_hotel_user_created_on`;


