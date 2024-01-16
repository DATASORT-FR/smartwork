<?php
/**
* This file contains the script launch file.
*
* @package   administration_script
* @version   1.1
* @date      22 January 2020
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

/* intialization */
// Arguments
$appCode = '';
$scriptName = '';

if (isset($argv[1])) {
	$atemp = explode("/", $argv[1]);
	if (isset($atemp[1])) {
		$appCode = strtoupper($atemp[0]);
		$scriptName = $atemp[1];
	}
	else {
		$scriptName = $atemp[0];	
	}
}

require_once('includes/init.php'); /* basic include */

$ws = Workspace::ws_open();

if (!$ws->script()) {
	die();	
}
else {
	$ws->argLoad($argv, 2);
}

$startDate = now();
$strDate = $startDate->format('Y-m-d H:i:s');
displayMsg($strDate . ' : ' . $ws->getConfigVars('Txt_script_begin'));
if (!empty($appCode)) {
	displayMsg($appCode, $ws->getConfigVars('Txt_script_code_app'));
	displayMsg($ws->paramGet('APP_NAME'), $ws->getConfigVars('Txt_script_app'));
	displayMsg($scriptName . '.php', $ws->getConfigVars('Txt_script_name'));
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_SCRIPTS_DIR') . $scriptName . '.php';	
}
else {
	displayMsg($scriptName . '.php', $ws->getConfigVars('Txt_script_name'));
	$filePath = $ws->paramGet('SCRIPTS_DIR') . $scriptName . '.php';
}
if (file_exists($filePath)) {
	displayMsg($scriptName, $ws->getConfigVars('Txt_script_trait'));
	require_once($filePath);
}
else {
	displayMsg($filePath, $ws->getConfigVars('Txt_script_not_found'));
}

$endDate = now();
$strDate = $endDate->format('Y-m-d H:i:s');
displayMsg($strDate . ' : ' . $ws->getConfigVars('Txt_script_end'));
displayMsg(duration($startDate, $endDate)->format('%H:%I:%S'), $ws->getConfigVars('Txt_script_duration'));
