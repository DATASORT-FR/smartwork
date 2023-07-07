<?php
/**
* This file contains classes and models initialization dor diagrams
*
* @package    use_diagram
* @subpackage initialization
* @version    1.0
* @date       10 October 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

// ====================================
// Database Intialization
// ====================================
$ws->paramSet('DGM_DSN', DGM_DSN);
$ws->paramSet('DGM_USERNAME', DGM_USERNAME);
$ws->paramSet('DGM_PASSWORD', DGM_PASSWORD);
$ws->paramSet('DGM_MODEL_FILE', DGM_MODEL_FILE);
$ws->paramSet('DGM_SCHEMA_FILE', DGM_SCHEMA_FILE);

$ws->paramSet('TRACE_DSN', TRACE_DSN);
$ws->paramSet('TRACE_USERNAME', TRACE_USERNAME);
$ws->paramSet('TRACE_PASSWORD', TRACE_PASSWORD);
$ws->paramSet('TRACE_MODEL_FILE', TRACE_MODEL_FILE);
$ws->paramSet('TRACE_SCHEMA_FILE', TRACE_SCHEMA_FILE);

	try {
		$db_dgm = PDO_extend::ws_open('dgm');
		$db_trace = PDO_extend::ws_open('trace');
	}
	catch (Exception $msg) {
		displayMsg($msg, 'Error DB DGM', 1, false);
		die;
	}	

?>