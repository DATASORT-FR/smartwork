<?php
/**
* This file contains initialization code
*
* @package    global
* @subpackage initialization
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

$ws = workspace::ws_open(SITE_ROOT_DIR);

// global
$ws->errorPageSet('offres-missions-freelance.html');

// Template css
$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_CSS_PATH);
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE', 'template.css');

// Template js
$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_JS_PATH);
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS', 'template.js');
$ws->paramSet($ws->paramGet('APP_NAME') . '_HOLDER_JS', 'holder.min.js');

// Pages Names
$ws->paramSet($ws->paramGet('APP_NAME') . '_PAGE_JOBNAMES', 'fiches-metiers-freelance');

// Classes initialization
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_CLASSES_DIR') . 'classes.php';
if (file_exists($filePath)) {	
	require_once($filePath);
}

// Api path initialization

// Modules initialization
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'caroussel/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'login/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'randcompanies/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'statistics/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'thumbnails/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'contentside/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'jobnameside/index.php');

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

/**
* construct Mission url
*
* @param 	string	- mission reference
* 		 	string	- mission title
*
* @access public
*/
function constructMissionHref($reference, $title = '') {
	$href = '';
	
	$ws = workspace::ws_open();
	$connect = new object_connect();
	if (empty($title)) {
		$linkPage = 'mission';		
	}
	else {
		$title = mb_substr($title, 0, 50);
		if ((strlen($title) > 48)and (preg_match("# #iusU", $title))) {
			$title = mb_substr($title, 0, mb_strrpos($title, ' '));
		}
		$title = preg_replace("#[\#]+#iusU", '',$title);
		$title = LIB_content::cleanSpecial($title);
		$title = preg_replace("#[^[:alnum:]]#iusU", '-',$title);
		$title = preg_replace("#[&?]#iusU", '-',$title);
		$title = preg_replace("#-+#ius", '-',$title);
		$linkPage = 'mission' . '-' . $title;
	}
	$href = $connect->constructHref($ws->paramGet('APP_CODE'), $linkPage, 'id:' .  $reference);

	return $href;
}

?>