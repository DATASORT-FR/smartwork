<?php
/**
* This file contains config parameters
*
*/

defined('_WSEXEC') or die();

define('APP_SMARTY_CACHE', false);
define('APP_SMARTY_COMPILE_CHECK', true);
define('APP_SMARTY_FORCE_COMPILE', true);
define('COOKIE_PARAM', true);
define('BROWSER_CACHE', true);
define('APP_IMAGES_PATH', './images/separation/');

define('APP_LOCAL_PARAM', 'fr_FR.utf8');
define('APP_LOCAL_LANGUAGE', 'fra');
define('APP_LOCAL_ZONE', 'Europe/Paris');
define('APP_LOCAL_DATE_FORMAT', 'd/m/Y');

// mail define
define('MAIL_HOST', 'smtp.ionos.fr');
define('MAIL_PORT', 587);
define('MAIL_AUTH', true);
define('MAIL_SECURE', 'tls');
define('MAIL_USER', 'webmaster@planete-separation.fr');
define('MAIL_PASSWORD', 'Planet202110!');
define('MAIL_NO_VERIFY', false);
define('MAIL_DEBUG', false);
define('MAIL_DEBUG_LEVEL', 0);
define('MAIL_DEBUG_TO', 'alain.vandeputte@datasort.fr');
define('MAIL_CONTACT_TO', 'contact@planete-separation.fr');
define('DOSSIER_CONTACT_TO', 'dossier@planete-separation.fr');
	
define('TOKEN_DURATION', 60);

define('SEPARATION_DOMAIN_ID', 1);
define('SEPARATION_DIAGRAM_ID', 1);
define('SEPARATION_ESPACE_DEBUG', false);
define('SEPARATION_RESULT_CATEGORY', 'DIAGNOSTIC');
define('SEPARATION_PROCEDURE_CATEGORY', 'PROCEDURE');
define('SEPARATION_DOSSIER_CATEGORY', 'DOSSIER');

// Visitor Logs
define('APP_SMARTLOGWS_SERVERNAME', 'http://195.154.178.227/smartlog/apps/separation/webservice.php?wsdl');
define('APP_SMARTLOGWS_LOGIN', 'adminData');
define('APP_SMARTLOGWS_PASSWORD', '4ag[67fg_h');
define('APP_SMARTLOGWS_APPNAME', 'separation');

// ====================================
// Database Intialization
// ====================================
define('DIAGRAM_SERVERNAME', 'https://www.powerarbo.fr/api');
define('DIAGRAM_LOGIN', '');
define('DIAGRAM_PASSWORD', '');

define('TRACE_SERVERNAME', 'http://localhost/smartwork/dmg/api');
define('TRACE_LOGIN', '');
define('TRACE_PASSWORD', '');

?>