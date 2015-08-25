<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
 |--------------------------------------------------------------------------
 | Creating Custom Specfic Constants
 |--------------------------------------------------------------------------
 */
  define('BASE_URL','http://localhost/sebastian-admin-panel/');
  //define('BASE_URL','http://bizmoapps.com/sebastian/');
  define('THEME_ASSETS',BASE_URL.'assets/');

 /*
 |--------------------------------------------------------------------------
 | Creating System Message Constants
 |--------------------------------------------------------------------------
 */
 define('ERR_MSG_LEVEL_1','Authentication Falied');
 define('ERR_MSG_LEVEL_2','Please log in to continue');
 define('ERR_MSG_LEVEL_3', 'You are not autorize to access this module');
 define('SUC_MSG_LEVEL_1','Log out Successfully. Please log in to continue.');
 define('SUC_MSG_LEVEL_2','Your Password is sent in your email successfully.');
 define('HOTEL_SELECT_SERVICES_SUCCESS','Hotel Services Updated Successfully.');
 define('HOTEL_CREATION_SUCCESS','Hotel Created Successfully.');
 define('HOTEL_CREATION_FAIL','Error in Hotel Creation.');
 define('ROOMS_CREATION_SUCCESS','Rooms Created Successfully.');
 define('ROOMS_CREATION_FAIL','Error in Rooms Creation.');
 define('HOTEL_UPDATION_SUCCESS','Hotel Updated Successfully.');
 define('HOTEL_UPDATION_FAIL','Error in Hotel Updation.');
 define('HOTEL_ADMIN_CREATION_SUCCESS','Hotel User Created Successfully.');
 define('HOTEL_ADMIN_CREATION_ERROR','Error in Hotel User Creation.');
 define('HOTEL_ADMIN_UPDATION_SUCCESS','Hotel User Updated Successfully.');
 define('PARENT_SERVICE_CREATION_SUCCESS','Parent Service is created Successfully.');
 define('PARENT_SERVICE_UPDATION_SUCCESS','Parent Service is Updated Successfully.');
 define('CHILD_SERVICE_UPDATION_SUCCESS','Child Service is Updated Successfully.');
 define('HOTEL_ADMIN_UPDATION_ERROR','Error in Hotel User Updation.');
 define('CHILD_SERVICE_CREATION_SUCCESS',"Child Services are created successfully excluding services which are already present.");
 define('CHILD_SERVICE_CREATION_FAILURE',"Child Services with same name are already present.");
 define('HOTEL_SERVICE_CREATION_SUCCESS','Service for your hotel is created Successfully.');
 define('HOTEL_SERVICE_CREATION_ERROR','Error in service creation for hotel.');
 define('HOTEL_SERVICE_UPDATION_SUCCESS','Service for your hotel is updated Successfully.');
 define('HOTEL_SERVICE_UPDATION_ERROR','Error in service updation for hotel.');
 define('FOLDER_BASE_URL','http://localhost/sebastian-admin-panel');
 define('FOLDER_ICONS_URL','http://localhost/sebastian-admin-panel/user_data/');
 //define('FOLDER_BASE_URL','http://bizmoapps.com/sebastian');


 /*
 |--------------------------------------------------------------------------
 | Creating System Labels
 |--------------------------------------------------------------------------
 |
 */
 define('LABEL_1','Admin Dashboard');
 define('LABEL_2','Hotelier Dashboard');


 //FOLDER NAMES FOR IMAGE UPLOAD
 define('HOTEL_USER_PIC',"user_data/hotel_user_pic");
 define('HOTEL_PIC',"user_data/hotel_pic");
 define('PARENT_SERVICE_PIC',"user_data/parent_service_pic");
 define('CHILD_SERVICE_PIC',"user_data/child_service_pic");
 define('SUBCHILD_SERVICE_PIC',"user_data/sub_child_service_pic");
 
  
