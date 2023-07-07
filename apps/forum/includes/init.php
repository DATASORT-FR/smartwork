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

$ws = workspace::ws_open();

// connection informations
$flagAdmin = false;
$flagConnect = false;
$nameConnect = "";
if ($ws->connected() and ($ws->connected_id() <> $ws->paramGet('USER_GUEST'))) {
	$flagConnect = $ws->connected();
	$nameConnect = $ws->connected_name();
}
if ($ws->connected() and ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
	$flagAdmin = true;
}

$ws->addcss("./libs/font-awesome-5/css/all.min.css", false);
$ws->addcss("./apps/forum/washla/css/navbar.css");
$ws->addcss("./apps/forum/washla/css/main.css");
$ws->addcss("./apps/forum/washla/css/stylesheet.css");
$ws->addcss("./apps/forum/washla/css/responsive.css");

$ws->addjs("./apps/forum/washla/js/lib/nav.fixed.top.js");
$ws->addjs("./apps/forum/templates/js/template.js");
$ws->addjs($ws->paramGet('RELA_CKEDITOR_JS_DIR') . $ws->paramGet('CKEDITOR_JS_FILE'), false);

$ws->clearjs("./libs/jquery-3.6.0/js/jquery.min.js");
$ws->clearjs("./libs/workspace-1.0.3/js/workspace.js");

?>