<?php
/**
* This file contains initialization code
*
* @package    default_initialization
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

if (!defined('JOBFREE_COOKIE')) {
	define('JOBFREE_COOKIE', '');
}

$ws = workspace::ws_open(SITE_ROOT_DIR);

// global
$ws->errorPageSet('error.html');
$ws->paramSet($ws->paramGet('APP_NAME') . '_COOKIE', JOBFREE_COOKIE);

// Template css
$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_CSS_PATH);
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE', 'template.css');

// Template js
$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_JS_PATH);
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS', 'template.js');
$ws->paramSet($ws->paramGet('APP_NAME') . '_HOLDER_JS', 'holder.min.js');

// Pages Names
$ws->paramSet($ws->paramGet('APP_NAME') . '_PAGE_FILES', 'files');

// Classes initialization
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_CLASSES_DIR') . 'classes.php';
if (file_exists($filePath)) {	
	require_once($filePath);
}

// Api path initialization

// Modules initialization
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'caroussel/caroussel.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'contentside/contentside.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'fileside/fileside.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'thumbnails/thumbnails.php');

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

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_HOLDER_JS');
if (file_exists($filePath)) {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR') . $ws->paramGet($ws->paramGet('APP_NAME') . '_HOLDER_JS');
	$ws->addjs($filePath);
}

?>