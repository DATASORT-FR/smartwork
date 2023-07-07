<?php
/**
* This file contains initialization code
*
* @package    test
* @subpackage initialization
* @version    1.2
* @date       13 December 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// App Defines
define('API_ROOT', 'api/');

$ws = workspace::ws_open(SITE_ROOT_DIR);
// Template css
$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_CSS_PATH);
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE', 'template.less');

// Template js
$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_JS_PATH);
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS', 'template.js');

// Functions
function labelTrad($label) {
	$ws = workspace::ws_open();
	
	$pos = strpos($label, '#');
	if ($pos !== false) {
		$stemp = str_replace('#', '', $label);
		$stemp = $ws->getConfigVars($stemp);
		if (!empty($stemp)) {
			$label = $stemp;
		}
	}
	return $label;
}

function labelSize($label) {

	$label = mb_substr($label, 0, 60, 'UTF-8');
//	$label = substr($label, 0, 60);

	return $label;
}

// Modules initialization

// Css files
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE');
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE');
	$ws->addcss($filePath);
}

// Javascript files
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS');
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS');
	$ws->addjs($filePath);
}

?>