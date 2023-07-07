<?php
/**
* This file contains config parameters
*
*/

defined('_WSEXEC') or die();

define('APP_SMARTY_CACHE', false);
define('APP_SMARTY_COMPILE_CHECK', true);
define('APP_SMARTY_FORCE_COMPILE', true);
define('APP_COOKIE_PARAM', false);
//define('APP_COOKIE', '_ga');
define('APP_BROWSER_CACHE', true);
define('APP_IMAGES_PATH', './images/separation/');

define('APP_LOCAL_PARAM', 'fr_FR.utf8');
define('APP_LOCAL_LANGUAGE', 'fra');
define('APP_LOCAL_ZONE', 'Europe/Paris');
define('APP_LOCAL_DATE_FORMAT', 'dd/MM/YYYY');

// content
define('APP_CODE_CONTENT', 'SEPARATION');
define('APP_ID_CONTENT', 23);

// mail define
define('MAIL_HOST', 'smtp.orange.fr');
define('MAIL_PORT', 465);
define('MAIL_AUTH', true);
define('MAIL_SECURE', 'ssl');
define('MAIL_USER', 'vandeputtealain@orange.fr');
define('MAIL_PASSWORD', 'Moumouth1');
define('MAIL_NO_VERIFY', true);
define('MAIL_DEBUG', true);
define('MAIL_DEBUG_LEVEL', 0);
define('MAIL_DEBUG_TO', 'alain.vandeputte@datasort.fr');
define('MAIL_CONTACT_TO', 'alain.vandeputte@datasort.fr');
define('DOSSIER_CONTACT_TO', 'alain.vandeputte@datasort.fr');
	
define('TOKEN_DURATION', 60);

// Visitor Logs
define('APP_SMARTLOGWS_SERVERNAME', 'http://195.154.178.227/smartlog/apps/separation/webservice.php?wsdl');
define('APP_SMARTLOGWS_LOGIN', 'adminData');
define('APP_SMARTLOGWS_PASSWORD', '4ag[67fg_h');
define('APP_SMARTLOGWS_APPNAME', 'separation');

define('APP_TRACE_NAME', 'SEPARATION');
	
// ====================================
// Specific
// ====================================
define('SEPARATION_DOMAIN_ID', 9);
define('SEPARATION_DIAGRAM_ID', 49);
define('SEPARATION_ESPACE_DEBUG', false);
define('SEPARATION_RESULT_CATEGORY', 'DIAGNOSTIC');
define('SEPARATION_PROCEDURE_CATEGORY', 'PROCEDURE');
define('SEPARATION_DOSSIER_CATEGORY', 'DOSSIER');

// Database Intialization
define('DIAGRAM_SERVERNAME', 'https://www.powerarbo.fr/api');
//define('DIAGRAM_SERVERNAME', 'http://localhost/smartwork/dmg/api');
define('DIAGRAM_LOGIN', '');
define('DIAGRAM_PASSWORD', '');

//define('TRACE_SERVERNAME', 'https://www.powerarbo.fr/api');
define('TRACE_SERVERNAME', 'http://localhost/smartwork/dmg/api');
define('TRACE_LOGIN', '');
define('TRACE_PASSWORD', '');

?>