ALTER TABLE `sb_hotel_guest_bookings` ADD `is_checkedout` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '0= not checked-out, 1= checked out' ;

CREATE TABLE IF NOT EXISTS `sb_visitor` (
  `visitor_id` bigint(20) NOT NULL,
  `visitor_firstName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_lastName` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `visitor_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `sb_hotel_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `visit_cout` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `sb_visitor` CHANGE `visit_cout` `visit_cout` INT(11) NOT NULL DEFAULT '1';

ALTER TABLE `sb_visitor` CHANGE `visitor_id` `visitor_id` BIGINT(20) NOT NULL AUTO_INCREMENT;