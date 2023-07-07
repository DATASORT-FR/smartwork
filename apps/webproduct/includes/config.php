<?php
/**
* This file contains config parameters
*
*/

defined('_WSEXEC') or die();

// ====================================
// Database Intialization
// ====================================
$ws->paramSet('CRM_DSN', 'mysql:host=localhost;port=3306;dbname=crm');
$ws->paramSet('CRM_USERNAME', 'root');
$ws->paramSet('CRM_PASSWORD', 'astril');
$ws->paramSet('CRM_MODEL_FILE', 'crm_model.php');
$ws->paramSet('CRM_SCHEMA_FILE', 'crm_schema.xml');
	
?>