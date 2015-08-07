<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2015-08-07 12:15:47 --> Query error: Unknown column 'sb_child_servcie_name' in 'field list' - Invalid query: SELECT `sb_hotel_child_services`.`sb_child_service_id`, `sb_child_servcie_name`, `sb_hotel_service_map_id`
FROM `sb_hotel_service_map`
JOIN `sb_hotel_child_services` ON `sb_hotel_child_services`.`sb_child_service_id` = `sb_hotel_service_map`.`sb_child_service_id`
WHERE `sb_hotel_id` = '21'
AND `sb_hotel_child_services`.`sb_parent_service_id` = '2'
ERROR - 2015-08-07 12:23:07 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:23:08 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:27:31 --> Query error: Column 'sb_hotel_user_id' in where clause is ambiguous - Invalid query: SELECT *
FROM `sb_hotel_users`
JOIN `sb_hotel_user_service_access_map` ON `sb_hotel_user_service_access_map`.`sb_hotel_user_id` = `sb_hotel_users`.`sb_hotel_user_id`
WHERE (sb_hotel_users.sb_hotel_id='21' AND sb_hotel_user_type='s' AND sb_hotel_user_id <> '56' AND sb_parent_service_id='1')
AND (`sb_hotel_users`.`sb_hotel_user_id` LIKE '%%' ESCAPE '!'
							OR  `sb_hotel_username` LIKE '%%' ESCAPE '!'
							OR  `sb_hotel_useremail` LIKE '%%' ESCAPE '!'
							OR  `sb_hotel_user_type` LIKE '%%' ESCAPE '!')
ORDER BY `sb_hotel_users`.`sb_hotel_user_id` DESC
 LIMIT 10
ERROR - 2015-08-07 12:29:46 --> Severity: Notice --> Undefined index: sb_child_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 361
ERROR - 2015-08-07 12:29:46 --> Query error: Unknown column 'sb_child_service_name' in 'field list' - Invalid query: SELECT `sb_hotel_child_services`.`sb_child_service_id`, `sb_child_service_name`, `sb_hotel_service_map_id`
FROM `sb_hotel_service_map`
JOIN `sb_hotel_child_services` ON `sb_hotel_child_services`.`sb_child_service_id` = `sb_hotel_service_map`.`sb_child_service_id`
WHERE `sb_hotel_id` = '21'
AND `sb_hotel_child_services`.`sb_parent_service_id` = '1'
AND `sb_hotel_child_services`.`sb_child_service_id` IS NULL
ERROR - 2015-08-07 12:33:04 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:33:04 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:33:04 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:34:26 --> Severity: Notice --> Undefined index: sb_child_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 361
ERROR - 2015-08-07 12:34:26 --> Severity: Warning --> array_keys() expects parameter 1 to be array, boolean given C:\xampp\htdocs\sebastian-admin-panel\system\database\DB_query_builder.php 1505
ERROR - 2015-08-07 12:34:26 --> Severity: Warning --> sort() expects parameter 1 to be array, null given C:\xampp\htdocs\sebastian-admin-panel\system\database\DB_query_builder.php 1506
ERROR - 2015-08-07 12:34:26 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\sebastian-admin-panel\system\database\DB_query_builder.php 1534
ERROR - 2015-08-07 12:36:08 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:36:08 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:36:09 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:36:23 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:36:24 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:36:24 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:37:20 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:37:20 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:37:20 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:38:01 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:38:01 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:38:01 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:38:38 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:38:38 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:38:39 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:39:39 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:39:39 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:39:39 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 231
ERROR - 2015-08-07 12:46:40 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 229
ERROR - 2015-08-07 12:46:40 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 229
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: hotel_name C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 33
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 36
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: user_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 231
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 231
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: user_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 260
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 260
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: hotel_name C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 33
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 36
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: user_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 231
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 231
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: user_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 260
ERROR - 2015-08-07 12:53:46 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 260
ERROR - 2015-08-07 12:56:45 --> Severity: Notice --> Undefined index: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 546
ERROR - 2015-08-07 12:56:45 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 36
ERROR - 2015-08-07 12:56:45 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 231
ERROR - 2015-08-07 12:56:45 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 260
ERROR - 2015-08-07 12:56:45 --> Severity: Notice --> Undefined index: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 546
ERROR - 2015-08-07 12:56:45 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 36
ERROR - 2015-08-07 12:56:45 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 231
ERROR - 2015-08-07 12:56:45 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 260
ERROR - 2015-08-07 12:57:50 --> Severity: Notice --> Undefined index: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 546
ERROR - 2015-08-07 12:57:50 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 36
ERROR - 2015-08-07 12:57:50 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 231
ERROR - 2015-08-07 12:57:50 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 260
ERROR - 2015-08-07 12:57:50 --> Severity: Notice --> Undefined index: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 546
ERROR - 2015-08-07 12:57:50 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 36
ERROR - 2015-08-07 12:57:50 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 231
ERROR - 2015-08-07 12:57:50 --> Severity: Notice --> Undefined variable: hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 260
ERROR - 2015-08-07 13:00:24 --> Severity: Notice --> Undefined index: sb_staff_designation_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 609
ERROR - 2015-08-07 13:06:43 --> Severity: Notice --> Undefined index: sb_staff_designation_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 609
ERROR - 2015-08-07 13:08:21 --> Severity: Notice --> Undefined index: sb_staff_designation_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 609
ERROR - 2015-08-07 13:10:19 --> Severity: Notice --> Undefined index: sb_staff_designation_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 609
ERROR - 2015-08-07 13:11:51 --> Severity: Notice --> Undefined index: sb_staff_designation_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 609
ERROR - 2015-08-07 13:29:26 --> Severity: Notice --> Undefined index: sb_staff_designation_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 609
ERROR - 2015-08-07 13:32:59 --> Severity: Notice --> Undefined index: sb_staff_designation_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 609
