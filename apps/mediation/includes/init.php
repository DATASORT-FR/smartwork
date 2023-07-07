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

// App Defines
define('FAMILY_CATEGORY', 'famille');
define('FOLK_CATEGORY', 'societe');
define('ECONOMY_CATEGORY', 'économie');
define('JUDICIAL_CATEGORY', 'judiciaire');

define('FAMILY_CODE', 'family');
define('FOLK_CODE', 'folk');
define('ECONOMY_CODE', 'économy');
define('JUDICIAL_CODE', 'judicial');

define('FAMILY_CLASS', 'family');
define('FOLK_CLASS', 'folk');
define('ECONOMY_CLASS', 'économy');
define('JUDICIAL_CLASS', 'judicial');

define('API_ROOT', 'api/');

$ws = workspace::ws_open(SITE_ROOT_DIR);

// Template css
$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_TEMPLATES_CSS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_CSS_PATH);
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_STYLE', 'template.css');

// Template js
$ws->paramSet($ws->paramGet('APP_NAME') . '_RELA_JS_DIR', RELA_PATH . APPS_PATH . $ws->paramGet('APP_NAME'). '/' . TEMPLATES_JS_PATH);
$ws->paramSet($ws->paramGet('APP_NAME') . '_TEMPLATE_JS', 'template.js');
$ws->paramSet($ws->paramGet('APP_NAME') . '_HOLDER_JS', 'holder.min.js');

// Pages Names
$ws->paramSet($ws->paramGet('APP_NAME') . '_PAGE_COMPANIES', 'companies');
$ws->paramSet($ws->paramGet('APP_NAME') . '_PAGE_COMPANY', 'company');

// Classes initialization
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_CLASSES_DIR') . 'classes.php';
if (file_exists($filePath)) {	
	require_once($filePath);
}

// Api path initialization
$ws->paramSet($ws->paramGet('APP_NAME') . '_API_DIR', SITE_ROOT_DIR . APPS_PATH . $ws->paramGet('APP_NAME') . '/' . API_ROOT);

// Modules initialization
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'article_image/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'caroussel/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'login/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'statistics/index.php');
require_once($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . 'thumbnails/index.php');

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
* construct Article url
*
* @param 	string	- Article reference
* 		 	string	- Article title
*
* @access public
*/
function constructArticleHref($reference, $title = '') {
	$href = '';
	
	$ws = workspace::ws_open();
	$connect = new object_connect();
	if (empty($title)) {
		$linkPage = 'article';		
	}
	else {
		$title = mb_substr($title, 0, 50);
		if ((strlen($title) > 48)and (preg_match("# #iusU", $title))) {
			$title = mb_substr($title, 0, mb_strrpos($title, ' '));
		}
		$title = preg_replace("#[\#]+#iusU", '',$title);
		$title = preg_replace("#[-.,\?\:\\\/\s\"]+#iusU", '_',$title);
		$title = preg_replace("#_+#ius", '_',$title);
		$title = LIB_content::cleanSpecial($title);
		$linkPage = 'article' . '-' . $title;
	}
	$href = $connect->constructHref($ws->paramGet('APP_CODE'), $linkPage, 'id:' .  $reference);

	return $href;
}


/**
* Find default Article image
*
* @param 	string	- Article reference
* 		 	string	- Article Category 
*
* @access public
*/
function findArticleImage($reference, $category = '') {
	$defaultImage = '';
	
	$atemp = array();
	$atemp = explode(';', $category);
	if ((empty($defaultImage)) and (in_array(FAMILY_CATEGORY, $atemp))) {
		$defaultImage = './images/mediation/mediation-famille_' . substr($reference, -1) . '.jpg';
	}
	if ((empty($defaultImage)) and (in_array(FOLK_CATEGORY, $atemp))) {
		$defaultImage = './images/mediation/mediation-societe_' . substr($reference, -1) . '.jpg';
	}
	if ((empty($defaultImage)) and (in_array(ECONOMY_CATEGORY, $atemp))) {
		$defaultImage = './images/mediation/mediation-economie_' . substr($reference, -1) . '.jpg';
	}
	if ((empty($defaultImage)) and (in_array(JUDICIAL_CATEGORY, $atemp))) {
		$defaultImage = './images/mediation/mediation-judiciaire_' . substr($reference, -1) . '.jpg';
	}
	if (empty($defaultImage)) {
		$defaultImage = './images/mediation/mediation-general_' . substr($reference, -1) . '.jpg';
	}

	return $defaultImage;
}

?>