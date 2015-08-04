<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2015-08-03 12:15:40 --> 404 Page Not Found: Assets/img
ERROR - 2015-08-03 12:15:43 --> The upload path does not appear to be valid.
ERROR - 2015-08-03 12:15:52 --> The upload path does not appear to be valid.
ERROR - 2015-08-03 12:21:00 --> Severity: Notice --> Use of undefined constant sb_hotel_useremail - assumed 'sb_hotel_useremail' C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 258
ERROR - 2015-08-03 12:21:36 --> 404 Page Not Found: Assets/img
ERROR - 2015-08-03 12:47:00 --> Severity: Notice --> Undefined variable: logged_in_user_type C:\xampp\htdocs\sebastian-admin-panel\application\views\create_hotel_admin_user.php 120
ERROR - 2015-08-03 12:50:05 --> 404 Page Not Found: Assets/img
ERROR - 2015-08-03 12:50:09 --> Severity: Notice --> Use of undefined constant sb_hotel_useremail - assumed 'sb_hotel_useremail' C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 261
ERROR - 2015-08-03 12:56:05 --> Severity: Notice --> Undefined property: User::$services_model C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 104
ERROR - 2015-08-03 12:56:05 --> Severity: Error --> Call to a member function get_hotel_parent_services() on null C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 104
ERROR - 2015-08-03 13:23:34 --> Query error: Unknown column 'sb_parent_service_id' in 'field list' - Invalid query: INSERT INTO `sb_hotel_users` (`sb_hotel_username`, `sb_hotel_useremail`, `sb_hotel_user_shift_from`, `sb_hotel_user_shift_to`, `sb_hotel_user_status`, `sb_hotel_user_type`, `sb_staff_designation_id`, `sb_parent_service_id`, `sb_hotel_user_pic`, `sb_hotel_id`, `sb_hotel_userpasswd`) VALUES ('testmanager', 'testmanager@email.com', '17:00:45', '17:00:45', '1', 'm', '1', '1', '1438601014.jpg', '6', '$2y$11$ONpouunU/Qx8dOry928.5OmuuLeZkirTES/yExPuyMMAj9F.hHw.C')
ERROR - 2015-08-03 13:33:03 --> Severity: Notice --> Use of undefined constant sb_hotel_useremail - assumed 'sb_hotel_useremail' C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 279
ERROR - 2015-08-03 13:33:47 --> Query error: Unknown column 'sb_hotel_service_map.sb_parent_service_id' in 'on clause' - Invalid query: SELECT `sb_hotel_parent_services`.`sb_parent_service_id`, `sb_parent_service_name`
FROM `sb_hotel_user_service_access_map`
JOIN `sb_hotel_parent_services` ON `sb_hotel_parent_services`.`sb_parent_service_id` = `sb_hotel_service_map`.`sb_parent_service_id`
WHERE `sb_hotel_user_id` = '39'
GROUP BY `sb_hotel_parent_services`.`sb_parent_service_id`
ERROR - 2015-08-03 13:33:47 --> Query error: Unknown column 'sb_hotel_user_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1438601627
WHERE `sb_hotel_user_id` = '39'
AND `id` = 'a9615d529d63b4313634072627f2fbb46791f929'
ERROR - 2015-08-03 14:33:31 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 178
ERROR - 2015-08-03 14:33:35 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 69
ERROR - 2015-08-03 14:33:35 --> Query error: Column 'sb_parent_service_id' in where clause is ambiguous - Invalid query: SELECT `sb_hotel_child_services`.`sb_child_service_id`, `sb_child_service_name`
FROM `sb_hotel_service_map`
JOIN `sb_hotel_child_services` ON `sb_hotel_child_services`.`sb_child_service_id` = `sb_hotel_service_map`.`sb_child_service_id`
WHERE `sb_hotel_id` = '6'
AND `sb_parent_service_id` IS NULL
ERROR - 2015-08-03 14:33:35 --> Query error: Unknown column 'sb_hotel_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1438605215
WHERE `sb_hotel_id` = '6'
AND `sb_parent_service_id` IS NULL
AND `id` = '451fd10f528201331754802f816d7b884d5bbe9c'
ERROR - 2015-08-03 14:34:32 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 178
ERROR - 2015-08-03 14:34:34 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 69
ERROR - 2015-08-03 14:34:34 --> Query error: Column 'sb_parent_service_id' in where clause is ambiguous - Invalid query: SELECT `sb_hotel_child_services`.`sb_child_service_id`, `sb_child_service_name`
FROM `sb_hotel_service_map`
JOIN `sb_hotel_child_services` ON `sb_hotel_child_services`.`sb_child_service_id` = `sb_hotel_service_map`.`sb_child_service_id`
WHERE `sb_hotel_id` = '6'
AND `sb_parent_service_id` IS NULL
ERROR - 2015-08-03 14:34:34 --> Query error: Unknown column 'sb_hotel_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1438605274
WHERE `sb_hotel_id` = '6'
AND `sb_parent_service_id` IS NULL
AND `id` = '451fd10f528201331754802f816d7b884d5bbe9c'
ERROR - 2015-08-03 14:35:18 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 69
ERROR - 2015-08-03 14:35:18 --> Query error: Column 'sb_parent_service_id' in where clause is ambiguous - Invalid query: SELECT `sb_hotel_child_services`.`sb_child_service_id`, `sb_child_service_name`
FROM `sb_hotel_service_map`
JOIN `sb_hotel_child_services` ON `sb_hotel_child_services`.`sb_child_service_id` = `sb_hotel_service_map`.`sb_child_service_id`
WHERE `sb_hotel_id` = '6'
AND `sb_parent_service_id` IS NULL
ERROR - 2015-08-03 14:35:18 --> Query error: Unknown column 'sb_hotel_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1438605318
WHERE `sb_hotel_id` = '6'
AND `sb_parent_service_id` IS NULL
AND `id` = '451fd10f528201331754802f816d7b884d5bbe9c'
ERROR - 2015-08-03 14:35:56 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 68
ERROR - 2015-08-03 14:35:56 --> Query error: Column 'sb_parent_service_id' in where clause is ambiguous - Invalid query: SELECT `sb_hotel_child_services`.`sb_child_service_id`, `sb_child_service_name`
FROM `sb_hotel_service_map`
JOIN `sb_hotel_child_services` ON `sb_hotel_child_services`.`sb_child_service_id` = `sb_hotel_service_map`.`sb_child_service_id`
WHERE `sb_hotel_id` = '6'
AND `sb_parent_service_id` IS NULL
ERROR - 2015-08-03 14:35:56 --> Query error: Unknown column 'sb_hotel_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1438605356
WHERE `sb_hotel_id` = '6'
AND `sb_parent_service_id` IS NULL
AND `id` = '451fd10f528201331754802f816d7b884d5bbe9c'
ERROR - 2015-08-03 14:36:56 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 68
ERROR - 2015-08-03 14:37:09 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 68
ERROR - 2015-08-03 14:37:30 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 68
ERROR - 2015-08-03 14:37:30 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:38:43 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 68
ERROR - 2015-08-03 14:38:43 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:39:42 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 68
ERROR - 2015-08-03 14:39:42 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:41:08 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 69
ERROR - 2015-08-03 14:41:08 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:41:23 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 69
ERROR - 2015-08-03 14:41:23 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:42:13 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 69
ERROR - 2015-08-03 14:42:13 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:42:24 --> Severity: Notice --> Undefined variable: sb_parent_service_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\Ajax.php 69
ERROR - 2015-08-03 14:42:24 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:43:38 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:43:44 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 14:43:53 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\sebastian-admin-panel\application\models\Services_model.php 143
ERROR - 2015-08-03 15:31:50 --> 404 Page Not Found: Assets/img
ERROR - 2015-08-03 15:32:06 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 178
ERROR - 2015-08-03 15:33:00 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 178
ERROR - 2015-08-03 15:33:33 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 178
ERROR - 2015-08-03 15:34:45 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 179
ERROR - 2015-08-03 15:35:55 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 179
ERROR - 2015-08-03 15:37:25 --> Severity: Notice --> Undefined index: sb_hotel_id C:\xampp\htdocs\sebastian-admin-panel\application\controllers\admin\User.php 179
ERROR - 2015-08-03 15:39:27 --> 404 Page Not Found: admin/User/add_user
