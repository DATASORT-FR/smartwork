<?php
/**
* This file contains configration
*
* @package    administration_initialization
* @version    1.5
* @date       4 May 2017
* @update	  03 March 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

define('SERVER_ROOT', 'E:/xampp/htdocs/');
define('FRAMEWORK_ROOT', 'smartwork/');
//define('UPLOAD_ROOT', 'E:/xampp/uploads/');

define('CONNEXION_DURATION', 120);
define('CACHE_DURATION', 5);
//define('SESSION_SERVER', true);

define('USER_GUEST', 1);
define('USER_SUPERADMIN', 2);
define('USER_DEFAULT', 3);

define('SMARTY_CACHE', false);
define('SMARTY_COMPILE_CHECK', true);
define('SMARTY_FORCE_COMPILE', true);
define('COOKIE_PARAM', false);
define('COOKIE', '_smt');
define('BROWSER_CACHE', true);

define('CSS_COMBINE', false);
define('JS_COMBINE', false);
define('URL_REWRITING', true);

define('SESSION_CACHE', false);
define('DISPLAY_PHP_ERROR', true);

define('DB_DSN', 'mysql:host=localhost;port=3306;dbname=smartwork');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_MODEL_FILE', 'db_model.php');
define('DB_SCHEMA_FILE', 'schema.xml');

define('CONTENT_DSN', 'mysql:host=localhost;port=3306;dbname=smartwork');
define('CONTENT_USERNAME', 'root');
define('CONTENT_PASSWORD', '');
define('CONTENT_MODEL_FILE', 'db_model.php');
define('CONTENT_SCHEMA_FILE', 'schema.xml');

define('FORUM_DSN', 'mysql:host=localhost;port=3306;dbname=smartwork');
define('FORUM_USERNAME', 'root');
define('FORUM_PASSWORD', '');
define('FORUM_MODEL_FILE', 'db_model.php');
define('FORUM_SCHEMA_FILE', 'schema.xml');

define('TASK_DSN', 'mysql:host=localhost;port=3306;dbname=smartwork');
define('TASK_USERNAME', 'root');
define('TASK_PASSWORD', '');
define('TASK_MODEL_FILE', 'db_model.php');
define('TASK_SCHEMA_FILE', 'schema.xml');

define('LOCAL_PARAM', 'en-GB.UTF-8');
define('LOCAL_LANGUAGE', 'en-GB');
define('LOCAL_ZONE', 'Europe/London');
define('LOCAL_DATE_FORMAT', 'dd/MM/YYYY');
define('DEFAULT_LANGUAGE', 'fr');

define('GROUP_NAME', 'www-data');

define('PARTNER_ID', 0);

// Mail default define
//define('MAIL_HOST', 'UNKNOW');
//define('MAIL_PORT', 0);
//define('MAIL_AUTH', false);
//define('MAIL_SECURE', 'none');
//define('MAIL_USER', '');
//define('MAIL_PASSWORD', '');

// visitor Logs parameters
define('SMARTLOGWS_SERVERNAME', '');
define('SMARTLOGWS_LOGIN', '');
define('SMARTLOGWS_PASSWORD', '');

?>