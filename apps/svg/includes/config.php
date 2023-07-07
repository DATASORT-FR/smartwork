<?php
/**
* This file contains config parameters
*
*/

defined('_WSEXEC') or die();

// ====================================
// Database Intialization
// ====================================
$ws->paramSet('ARTICLEWS_SERVERNAME', MEDIATION_ARTICLEWS_SERVERNAME);
$ws->paramSet('ARTICLEWS_LOGIN', MEDIATION_ARTICLEWS_LOGIN);
$ws->paramSet('ARTICLEWS_PASSWORD', MEDIATION_ARTICLEWS_PASSWORD);

$ws->paramSet('ADMARTICLEWS_SERVERNAME', MEDIATION_ADMARTICLEWS_SERVERNAME);
$ws->paramSet('ADMARTICLEWS_LOGIN', MEDIATION_ADMARTICLEWS_LOGIN);
$ws->paramSet('ADMARTICLEWS_PASSWORD', MEDIATION_ADMARTICLEWS_PASSWORD);

?>