<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2015-11-30 02:30:02 --> 404 Page Not Found: Web-console/ServerInfo.jsp
ERROR - 2015-11-30 02:30:13 --> 404 Page Not Found: Jmx-console/HtmlAdaptor
ERROR - 2015-11-30 02:30:26 --> 404 Page Not Found: Invoker/JMXInvokerServlet
ERROR - 2015-11-30 02:35:29 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 03:14:40 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 04:32:55 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 05:00:59 --> 404 Page Not Found: Web-console/ServerInfo.jsp
ERROR - 2015-11-30 05:01:12 --> 404 Page Not Found: Jmx-console/HtmlAdaptor
ERROR - 2015-11-30 05:01:24 --> 404 Page Not Found: Invoker/JMXInvokerServlet
ERROR - 2015-11-30 05:16:48 --> 404 Page Not Found: Web-console/ServerInfo.jsp
ERROR - 2015-11-30 05:16:59 --> 404 Page Not Found: Jmx-console/HtmlAdaptor
ERROR - 2015-11-30 05:17:08 --> 404 Page Not Found: Invoker/JMXInvokerServlet
ERROR - 2015-11-30 06:07:06 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 06:37:06 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 07:10:22 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 07:45:10 --> 404 Page Not Found: Faviconico/index
ERROR - 2015-11-30 07:45:12 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 07:53:46 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 07:53:52 --> Query error: Field 'sb_guest_actual_check_out' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_guest_reservation_attributes` (`sb_guest_actual_check_in`, `sb_guest_allocated_room_no`, `sb_guest_reservation_code`, `sb_guest_terms`) VALUES ('2015-11-30 07:53:52','1','112233','1')
ERROR - 2015-11-30 08:38:11 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 08:40:13 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '{\"special_info\":\"testing 123\"}')
ERROR - 2015-11-30 08:40:16 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '{\"special_info\":\"testing 123\"}')
ERROR - 2015-11-30 08:40:17 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '{\"special_info\":\"testing 123\"}')
ERROR - 2015-11-30 08:40:18 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '{\"special_info\":\"testing 123\"}')
ERROR - 2015-11-30 08:40:19 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '{\"special_info\":\"testing 123\"}')
ERROR - 2015-11-30 08:40:43 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('67', '2', '11', '5', '1', 0, '[]')
ERROR - 2015-11-30 08:48:56 --> Query error: Table 'sebastian.cities' doesn't exist - Invalid query: SELECT sb_hotels.sb_hotel_id, GROUP_CONCAT(sb_languages.lang_name) as lang_name, GROUP_CONCAT(sb_hotel_lang_map.lang_id) as lang_id, sb_hotel_address, sb_hotel_city, sb_hotel_country, sb_hotel_category, `sb_hotel_email`, `sb_hotel_name`, `sb_hotel_owner`, `sb_hotel_pic`, `sb_hotel_star`, `sb_hotel_state`, `sb_hotel_phone`, (select name from states where id=sb_hotel_state) as state_name, (select name from cities where id=sb_hotel_city) as city_name, (select name from countries where id=sb_hotel_country) as country_name, `sb_hotel_website`, `sb_hotel_zipcode`, `sb_property_built_month`, `sb_property_built_year`, `sb_property_open_year`
FROM `sb_hotels`
LEFT JOIN `sb_hotel_lang_map` ON `sb_hotel_lang_map`.`sb_hotel_id` = `sb_hotels`.`sb_hotel_id`
LEFT JOIN `sb_languages` ON `sb_languages`.`lang_id` = `sb_hotel_lang_map`.`lang_id`
WHERE `sb_hotels`.`sb_hotel_id` = '2'
GROUP BY `sb_hotels`.`sb_hotel_id`
ERROR - 2015-11-30 08:53:13 --> 404 Page Not Found: Https:/s3.amazonaws.com
ERROR - 2015-11-30 08:53:16 --> 404 Page Not Found: Https:/s3.amazonaws.com
ERROR - 2015-11-30 08:54:26 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 08:54:26 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 08:54:29 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 08:54:29 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 08:54:46 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 08:54:46 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 08:54:51 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 08:54:51 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 11:29:41 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 11:36:39 --> 404 Page Not Found: Muieblackcat/index
ERROR - 2015-11-30 11:36:39 --> 404 Page Not Found: PhpMyAdmin/scripts
ERROR - 2015-11-30 12:15:10 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 13:08:52 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 13:09:42 --> Query error: Field 'sb_guest_actual_check_out' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_guest_reservation_attributes` (`sb_guest_actual_check_in`, `sb_guest_allocated_room_no`, `sb_guest_reservation_code`, `sb_guest_terms`) VALUES ('2015-11-30 01:09:42','2','12345678901','1')
ERROR - 2015-11-30 13:12:28 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 13:20:58 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 13:21:07 --> 404 Page Not Found: Faviconico/index
ERROR - 2015-11-30 13:22:13 --> 404 Page Not Found: Faviconico/index
ERROR - 2015-11-30 13:22:38 --> 404 Page Not Found: Faviconico/index
ERROR - 2015-11-30 13:22:41 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 13:23:59 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 13:25:10 --> 404 Page Not Found: Faviconico/index
ERROR - 2015-11-30 13:25:18 --> 404 Page Not Found: Sebastian-admin-panel/admin
ERROR - 2015-11-30 13:44:39 --> 404 Page Not Found: Faviconico/index
ERROR - 2015-11-30 13:56:12 --> 404 Page Not Found: Assets/fonts
ERROR - 2015-11-30 13:58:47 --> 404 Page Not Found: Assets/fonts
ERROR - 2015-11-30 14:09:54 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 14:10:05 --> Query error: Field 'sb_guest_actual_check_out' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_guest_reservation_attributes` (`sb_guest_actual_check_in`, `sb_guest_allocated_room_no`, `sb_guest_reservation_code`, `sb_guest_terms`) VALUES ('2015-11-30 02:10:05','1','123456','1')
ERROR - 2015-11-30 14:14:00 --> Query error: Field 'sb_guest_actual_check_out' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_guest_reservation_attributes` (`sb_guest_actual_check_in`, `sb_guest_allocated_room_no`, `sb_guest_reservation_code`, `sb_guest_terms`) VALUES ('2015-11-30 02:14:00','1','123456','1')
ERROR - 2015-11-30 14:14:40 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 14:19:32 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 14:20:12 --> 404 Page Not Found: Assets/css
ERROR - 2015-11-30 14:21:01 --> Query error: Field 'sb_guest_actual_check_out' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_guest_reservation_attributes` (`sb_guest_actual_check_in`, `sb_guest_allocated_room_no`, `sb_guest_reservation_code`, `sb_guest_terms`) VALUES ('2015-11-30 02:21:01','1','111123','1')
ERROR - 2015-11-30 14:24:30 --> Query error: Field 'sb_guest_actual_check_out' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_guest_reservation_attributes` (`sb_guest_actual_check_in`, `sb_guest_allocated_room_no`, `sb_guest_reservation_code`, `sb_guest_terms`) VALUES ('2015-11-30 02:24:30','1','123456','1')
ERROR - 2015-11-30 14:24:43 --> Query error: Field 'sb_guest_actual_check_out' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_guest_reservation_attributes` (`sb_guest_actual_check_in`, `sb_guest_allocated_room_no`, `sb_guest_reservation_code`, `sb_guest_terms`) VALUES ('2015-11-30 02:24:43','2','123456','1')
ERROR - 2015-11-30 14:24:50 --> Query error: Field 'sb_guest_actual_check_out' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_guest_reservation_attributes` (`sb_guest_actual_check_in`, `sb_guest_allocated_room_no`, `sb_guest_reservation_code`, `sb_guest_terms`) VALUES ('2015-11-30 02:24:50','5','123456','1')
ERROR - 2015-11-30 14:27:39 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('36', '2', '1', '5', '1', 0, '{\"urgency\":\"As soon as possible\",\"issue\":\"nothing\",\"special_info\":\"nothing\"}')
ERROR - 2015-11-30 14:37:47 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '{\"special_info\":\"hi\"}')
ERROR - 2015-11-30 14:37:58 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '{\"special_info\":\"hi\"}')
ERROR - 2015-11-30 14:44:36 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '{\"special_info\":\"hi\"}')
ERROR - 2015-11-30 14:44:54 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '1', 0, '[]')
ERROR - 2015-11-30 14:49:49 --> Query error: Field 'sb_quantity' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '101', 0, '[]')
ERROR - 2015-11-30 14:56:20 --> Query error: Field 'sb_hotel_ser_vendor_id' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_request_service` (`sb_hotel_service_map_id`, `sb_hotel_id`, `sb_parent_service_id`, `sb_hotel_guest_booking_id`, `sb_guest_allocated_room_no`, `sub_child_services_id`, `sb_service_log`) VALUES ('33', '2', '1', '5', '101', 0, '[]')
ERROR - 2015-11-30 14:58:07 --> Query error: Field 'sb_hotel_ser_assgnd_to_user_id' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_services_status` (`sb_hotel_ser_start_date`, `sb_hotel_ser_start_time`, `sb_hotel_requst_ser_id`) VALUES ('2015-12-02', '00:00:15', 30)
ERROR - 2015-11-30 15:00:58 --> Query error: Field 'sb_hotel_ser_finished_date' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_services_status` (`sb_hotel_ser_start_date`, `sb_hotel_ser_start_time`, `sb_hotel_requst_ser_id`) VALUES ('2015-12-02', '00:00:15', 31)
ERROR - 2015-11-30 15:02:26 --> Query error: Field 'reject_reason' doesn't have a default value - Invalid query: INSERT INTO `sb_hotel_services_status` (`sb_hotel_ser_start_date`, `sb_hotel_ser_start_time`, `sb_hotel_requst_ser_id`) VALUES ('2015-12-02', '00:00:15', 32)
ERROR - 2015-11-30 15:54:29 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 16:48:06 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 17:19:06 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 17:52:29 --> 404 Page Not Found: Muieblackcat/index
ERROR - 2015-11-30 17:52:29 --> 404 Page Not Found: PhpMyAdmin/scripts
ERROR - 2015-11-30 17:52:29 --> 404 Page Not Found: Phpmyadmin/scripts
ERROR - 2015-11-30 17:52:29 --> 404 Page Not Found: Pma/scripts
ERROR - 2015-11-30 17:52:29 --> 404 Page Not Found: Myadmin/scripts
ERROR - 2015-11-30 17:52:29 --> 404 Page Not Found: MyAdmin/scripts
ERROR - 2015-11-30 18:27:42 --> 404 Page Not Found: Muieblackcat/index
ERROR - 2015-11-30 18:27:42 --> 404 Page Not Found: PhpMyAdmin/scripts
ERROR - 2015-11-30 18:27:42 --> 404 Page Not Found: Phpmyadmin/scripts
ERROR - 2015-11-30 18:27:43 --> 404 Page Not Found: Pma/scripts
ERROR - 2015-11-30 18:39:28 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 18:44:05 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 19:03:35 --> 404 Page Not Found: Muieblackcat/index
ERROR - 2015-11-30 19:03:35 --> 404 Page Not Found: PhpMyAdmin/scripts
ERROR - 2015-11-30 19:03:35 --> 404 Page Not Found: Phpmyadmin/scripts
ERROR - 2015-11-30 19:03:35 --> 404 Page Not Found: Pma/scripts
ERROR - 2015-11-30 19:03:35 --> 404 Page Not Found: Myadmin/scripts
ERROR - 2015-11-30 19:03:35 --> 404 Page Not Found: MyAdmin/scripts
ERROR - 2015-11-30 20:36:29 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 20:49:17 --> 404 Page Not Found: Httptestphp/index
ERROR - 2015-11-30 21:46:27 --> 404 Page Not Found: Httptestphp/index
