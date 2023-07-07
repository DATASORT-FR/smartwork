<?php
/**
* connected page
*
* @package    connected
* @subpackage controller
* @version    1.0
* @date       5 August 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

$userId = 0;
if ($flagConnect) {
	$userId = $ws->connected_id();
}
if ($userId != 0) {
	$ws->control('moncompte.tpl');
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template_outil.php';
	require_once($filePath);

	$ws->assign('classPage', 'moncompte');

	$title = $ws->getConfigVars('Title_mon_compte');

	$wlogin = new wlogin();
	$ws->assign('IncAccount',$wlogin->displayAccount());

	$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);
	$ws->build('moncompte.tpl');
}
else {
	$ws->redirect("./login.html");
}
?>
