<?php
/**
* Login page
*
* @package    default_initialization
* @version    1.0
* @date       5 August 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

$userId = 0;
if ($ws->userConnected()) {
	$userId = $ws->connected_id();
}
if ($userId == 0) {
	$ws->control('login.tpl');
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
	require_once($filePath);

	$ws->assign('classPage', 'login');

	$content = new Wcontent();
	$ws->assign('contentBlock', $content->display('login','style:header'));
	$title = $content->displayGet('title');
	$wlogin = new wlogin();
	$ws->assign('loginBox', $wlogin->displayConnect('default', true));

	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);
	$ws->build('login.tpl');
}
else {
	$ws->redirect("./moncompte.html");
}
?>
