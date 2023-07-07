<?php
/**
* This file contains config parameters
*
*/

defined('_WSEXEC') or die();

define('APP_SMARTY_CACHE', false);
define('APP_SMARTY_COMPILE_CHECK', true);
define('APP_SMARTY_FORCE_COMPILE', true);

// ====================================
// Database Intialization
// ====================================
define('DGM_DSN', 'mysql:host=localhost;port=3306;dbname=diagram_V5');
define('DGM_USERNAME', 'root');
define('DGM_PASSWORD', '');
define('DGM_MODEL_FILE', 'db_model.php');
define('DGM_SCHEMA_FILE', 'schema.xml');

define('TRACE_DSN', 'mysql:host=localhost;port=3306;dbname=trace');
define('TRACE_USERNAME', 'root');
define('TRACE_PASSWORD', '');
define('TRACE_MODEL_FILE', 'db_model.php');
define('TRACE_SCHEMA_FILE', 'schema.xml');
?>