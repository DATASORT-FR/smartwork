<?php
/**
* This file contains config parameters
*
*/

defined('_WSEXEC') or die();

// Visitor Logs
define('APP_SMARTLOGWS_SERVERNAME', 'http://localhost/smartlog/apps/jobfree/webservice.php?wsdl');
define('APP_SMARTLOGWS_LOGIN', 'adminData');
define('APP_SMARTLOGWS_PASSWORD', '4ag[67fg_h');
define('APP_SMARTLOGWS_APPNAME', 'mediation');

// Database Intialization
$ws->paramSet('ARTICLEWS_SERVERNAME', 'http://localhost/scraping/apps/mediation/webservice-mediation.php?wsdl');
$ws->paramSet('ARTICLEWS_LOGIN', 'userData');
$ws->paramSet('ARTICLEWS_PASSWORD', '4ag[67fg_h');

$ws->paramSet('ADMARTICLEWS_SERVERNAME', 'http://localhost/scraping/apps/mediation/webservice-admmediation.php?wsdl');
$ws->paramSet('ADMARTICLEWS_LOGIN', 'adminData');
$ws->paramSet('ADMARTICLEWS_PASSWORD', '4ag[67fg_h');

?>