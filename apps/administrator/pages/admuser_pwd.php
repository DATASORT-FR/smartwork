<?php
/**
* User password administration
*
* @package    administration_user
* @version    1.0
* @date       19 Juillet 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$user_id = $ws->argPost('id');
if ($user_id == '') {
	$user_id = $ws->sessionGet('user_pwd_id');
}
else {
	$ws->sessionSet('user_pwd_id', $user_id);
}

$user = new object_user(); /* Open user class */
$user_display = $user->display($user_id);
$user_code = $user_display->returnGet()['login'];

$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));
$wcrud = new wcrud('object_user', $ws->extractPage(__FILE__));
$wcrud->titleSet(false); /* use Title */
//$wcrud->titleCodeSet($user_code);
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */
$wcrud->returnSet(false);

$wcrud->fieldSet('password', 'password');
$wcrud->displayCrudEdit($user_id);

?>
