<?php
/**
* Change password page
*
* @package    module_login
* @version    1.0
* @date       5 August 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('simple.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
if (file_exists($filePath)) {
	require_once($filePath);
}
else {
	$filePath = $ws->paramGet('INCLUDES_DIR') . 'init_template_apps.php';
	if (file_exists($filePath)) {
		require_once($filePath);
	}
}

$ws->assign('classPage', 'user-password');

$tokenId = $ws->argGet('key');

$wlogin = new wlogin();
$ws->setTemplateDir(array());
$ws->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('LOGIN_NAME') . '/' . TEMPLATES_SRC_PATH);
$ws->addTemplateDir($ws->paramGet($ws->paramGet('LOGIN_NAME') . '_TEMPLATES_SRC_DIR'));
$ws->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_SRC_DIR'));
$ws->addTemplateDir($ws->paramGet('TEMPLATES_SRC_DIR'));

$token = new object_token();
$ws->assign('passwordBox', $wlogin->displayPasswordBox($tokenId));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('user_password.tpl');

?>
