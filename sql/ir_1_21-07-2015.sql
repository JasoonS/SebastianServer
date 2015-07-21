USE `sandbox_sebastian`;

ALTER TABLE `sb_admin` ADD `admin_last_logged_in` TIMESTAMP NOT NULL COMMENT 'Admin last Login' AFTER `admin_status`;