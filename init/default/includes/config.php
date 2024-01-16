<?php
/**
* This file contains configuration for default administration
*
* @package    default_configuration
* @version    1.5
* @date       4 May 2017
* @update	  03 March 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
defined('_WSEXEC') or die();

define('APP_SMARTY_CACHE', true);
define('APP_SMARTY_COMPILE_CHECK', true);
define('APP_SMARTY_FORCE_COMPILE', true);
define('APP_COOKIE_PARAM', true);
define('APP_COOKIE', '_ga');
define('APP_BROWSER_CACHE', true);
//define('APP_IMAGES_PATH', './images/default/');

define('APP_LOCAL_PARAM', 'fr_FR.utf8');
define('APP_LOCAL_LANGUAGE', 'fra');
define('APP_LOCAL_ZONE', 'Europe/Paris');
define('APP_LOCAL_DATE_FORMAT', 'd/m/Y');

// content
//define('APP_CODE_CONTENT', 'SEPARATION');
//define('APP_ID_CONTENT', 23);

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
	
//define('TOKEN_DURATION', 60);

// Visitor Logs
define('APP_SMARTLOGWS_SERVERNAME', 'http://195.154.178.227/smartlog/apps/jobfree/webservice.php?wsdl');
define('APP_SMARTLOGWS_LOGIN', 'adminData');
define('APP_SMARTLOGWS_PASSWORD', '4ag[67fg_h');
define('APP_SMARTLOGWS_APPNAME', 'jobfree');

//define('APP_TRACE_NAME', 'JOBFREE');

// ====================================
// Specific
// ====================================
$ws->paramSet('ARTICLEWS_SERVERNAME', 'http://195.154.178.227/scraping/apps/jobfree/webservice-job.php?wsdl');
$ws->paramSet('ARTICLEWS_LOGIN', 'userData');
$ws->paramSet('ARTICLEWS_PASSWORD', '4ag[67fg_h');

$ws->paramSet('ADMARTICLEWS_SERVERNAME', 'http://195.154.178.227/scraping/apps/jobfree/webservice-admjob.php?wsdl');
$ws->paramSet('ADMARTICLEWS_LOGIN', 'adminData');
$ws->paramSet('ADMARTICLEWS_PASSWORD', '4ag[67fg_h');

?>