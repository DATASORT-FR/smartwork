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
defined('_WSEXEC') or die();

// App Defines
define('API_ROOT', 'api/');
if (!defined('SEPARATION_ESPACE_DEBUG')) {
	define('SEPARATION_ESPACE_DEBUG', false);
}

$ws = workspace::ws_open();

// Classes initialization
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_CLASSES_DIR') . 'classes.php';
if (file_exists($filePath)) {	
	require_once($filePath);
}

// connection informations
$flagConnect = false;
$nameConnect = "";
if ($ws->sessionGet('connect_id') <> $ws->paramGet('USER_GUEST')) {
	$flagConnect = $ws->connected();
	$nameConnect = $ws->connected_name();
}

$ws->clearcss();
$ws->addcss("./libs/font-awesome-5/css/all.min.css", false);
$ws->addcss("./libs/bootstrap-5.0.2/css/bootstrap.min.css", false);
$ws->addcss("./apps/separation/washla/css/lib/owl.carousel.min.css");
$ws->addcss("./apps/separation/washla/css/navbar.css", false);
$ws->addcss("./apps/separation/washla/css/main.css");
$ws->addcss("./apps/separation/washla/css/stylesheet.css");
$ws->addcss("./apps/separation/washla/css/responsive.css");

$ws->addcss("./libs/datepicker-1.0.0/css/datepicker.css");
$ws->addcss("./libs/workspace-1.0.3/css/workspace.css");
$ws->addcss("./modules/content/templates/css/content.css");
$ws->addcss("./modules/crud/templates/css/crud.css");
$ws->addcss("./plugins/accordion/templates/css/accordion.css");
$ws->addcss("./plugins/currency/templates/css/currency.css");
$ws->addcss("./plugins/display/templates/css/display.css");
$ws->addcss("./plugins/integer/templates/css/integer.css");
$ws->addcss("./plugins/number/templates/css/number.css");
$ws->addcss("./plugins/page/templates/css/page.css");
$ws->addcss("./plugins/paraph/templates/css/paraph.css");
if ($ws->connected() and ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
	$ws->addcss("./modules/listcomp/templates/css/listcomp.css", false);
	$ws->addcss("./modules/mediamanager/templates/css/mediamanager.css", false);
	$ws->addcss("./modules/social/templates/css/social.css", false);
	$ws->addcss("./plugins/datagrid/templates/css/datagrid.css", false);
	$ws->addcss("./plugins/editor/templates/css/editor.css", false);
	$ws->addcss("./plugins/image/templates/css/image.css", false);
	$ws->addcss("./plugins/video/templates/css/video.css", false);
}
$ws->addcss("./templates/css/template.css");

$ws->clearjs();
$ws->addjs("./libs/bootstrap-5.0.2/js/bootstrap.bundle.min.js", false);
$ws->addjs("./apps/separation/washla/js/lib/plugins.js");
$ws->addjs("./apps/separation/washla/js/lib/nav.fixed.top.js");
$ws->addjs("./apps/separation/washla/js/main.js");

$ws->addjs("./libs/datepicker-1.0.0/js/bootstrap-datepicker.js");
$ws->addjs("./libs/workspace-1.0.3/js/workspace.js");
$ws->addjs("./language/fr/message_js.js");
$ws->addjs("./modules/crud/templates/js/crud.js");
$ws->addjs("./modules/login/templates/js/login.js");
if ($ws->connected() and ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
	$ws->addjs("./modules/listcomp/templates/js/listcomp.js", false);
	$ws->addjs("./modules/mediamanager/templates/js/mediamanager.js", false);
	$ws->addjs("./modules/menu/templates/js/menu.js", false);
	$ws->addjs("./plugins/datagrid/templates/js/datagrid.js", false);
	$ws->addjs("./plugins/image/templates/js/image.js", false);
	$ws->addjs("./plugins/video/templates/js/video.js", false);
	$ws->addjs("./libs/chartjs-2.7.2/js/chart.bundle.min.js", false);
	$ws->addjs("./libs/workspace-1.0.3/js/graph.js", false);
}

?>