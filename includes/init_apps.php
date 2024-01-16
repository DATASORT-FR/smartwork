<?php
/**
* This file contains initialization code for Apps
*
* @package    administration_initialization
* @version    1.2
* @date       12 November 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
$ws = workspace::ws_open(SITE_ROOT_DIR);
$ws->assign('app_title', $ws->paramGet('APP_TITLE'));

// Template css
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE', 'template.css');

// Template js
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS', 'template.js');

// Classes initialization
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_CLASSES_DIR') . 'classes.php';
if (file_exists($filePath)) {	
	require_once($filePath);
}

// Css files
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE');
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE');
	$ws->addcss($filePath);
}

// Javascript files
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_JS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS');
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_JS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS');
	$ws->addjs($filePath);
}

?>