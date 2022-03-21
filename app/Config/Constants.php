<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
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
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
 |--------------------------------------------------------------------------
 | Backend API Constants
 |--------------------------------------------------------------------------
 |
 | Provide API Constants
 | require information to be in seconds.
 */
define('TEST_LOCAL_MODE', true); // test local server
define('TEST_RELEASE_MODE', true); // test release server

define('API_VERSION', 1);
define('APP_VERSION', '1.0.0');
define('ADMIN_VERSION', '1.0');

//upload
define('UPLOAD_PATH', FCPATH . 'uploads' . DIRECTORY_SEPARATOR);
define('UPLOAD_URL_PATH', "uploads/");
define('TEMP_DIR', "temp");

//email
defined('SMTP_EMAIL_ADDRESS')           OR  define('SMTP_EMAIL_ADDRESS', 'agbd@gmail.com');
defined('SMTP_EMAIL_PASSWORD')           OR  define('SMTP_EMAIL_PASSWORD', 'pointphone1!');

//common constants
define('API_PAGE_CNT', 30);
define('STATUS_NORMAL', '1');
define('STATUS_DELETE', '0');
define('STATUS_ON', 1);
define('STATUS_OFF', 0);
define('STATUS_CHECK', '2');

// user status
define('USER_STATUS_PAUSE', '2');
define('USER_STATUS_EXIT', '3');

// Api ResultCode
define('STR_RESULT_CODE', 'resultcode');
define('API_RESULT_SUCCESS', 0);    //성공

define('API_RESULT_ERROR_SYSTEM', 101);  //체계 오유
define('API_RESULT_ERROR_DB', 102);    //DB 오유
define('API_RESULT_ERROR_PRIVILEGE', 103);    //권한 오유
define('API_RESULT_ERROR_PARAM', 104);    //Parameter 오유
define('API_RESULT_ERROR_UPLOAD', 105);   //화일upload 오유

define('API_RESULT_ERROR_ACCESS_TOKEN', 201);   //접근Token 오유
define('API_RESULT_ERROR_CERT_KEY', 202);   //인증번호 오유
define('API_RESULT_ERROR_LOGIN_FAILED', 203); //Login 오유
define('API_RESULT_ERROR_LOGIN_PASSWORD', 204); //비밀번호 오유
define('API_RESULT_ERROR_USER_NO_EXIST', 205); //회원정보없음 오유
define('API_RESULT_ERROR_EMAIL_DUPLICATE', 206);    //Email중복 오유
define('API_RESULT_ERROR_EMAIL_NO_EXIST', 207); //Email없음 오유
define('API_RESULT_ERROR_USER_PAUSED', 208); //정지회원 오유
define('API_RESULT_ERROR_NICKNAME_DUPLICATE', 209);    //이름중복 오유
define('API_RESULT_ERROR_NICKNAME_LENGTH', 210);    //이름길이 오유
define('API_RESULT_ERROR_EMAIL_VERIFIED', 211);    //Email인증 오유

define('API_RESULT_ERROR_PURCHASE', 301);    //결제 오유
define('API_RESULT_ERROR_PURCHASE_DUPLICATED', 302);    //결제 중복 오유

// push type
define('PUSH_TYPE_NOTICE', 0);    // 공동

/*
 |--------------------------------------------------------------------------
 | Admin Constants
 |--------------------------------------------------------------------------
 |
 | Provide Admin Constants
 | require information to be in seconds.
 */
defined('DEFAULT_LANGUAGE_FILE_NAME') || define('DEFAULT_LANGUAGE_FILE_NAME', "trans_lang"); // logout event
defined('DEFAULT_LOCATION') || define('DEFAULT_LOCATION', "Kr"); // logout event
define('SESSION_ADMIN_UID', 'session_admin_uid');

//ajax result error
define('AJAX_RESULT_SUCCESS', 'success');
define('AJAX_RESULT_ERROR', 'error');
define('AJAX_RESULT_DUP', 'dup');
define('AJAX_RESULT_EMPTY', 'empty');


// Menu
define('MENU_USER', 'menu_user');
define('MENU_PHOTO_CHECK', 'menu_photo_check');
define('MENU_NOTIFICATION', 'menu_notification');
define('MENU_STATISTIC', 'menu_statistic');
define('MENU_NOTICE', 'menu_notice');
define('MENU_SETTING', 'menu_setting');

// Year
define('STATISTIC_MIN_YEAR', 2010);
define('STATISTIC_MAX_YEAR', 2110);