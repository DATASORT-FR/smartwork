<?php
/**
* Password change process
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
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_template.php';
require_once($filePath);

$userId = 0;
$login = '';
$tokenId = $ws->argGet('key');
$password = $ws->argPost('password');

$token = new object_token();
$fct_return = $token->control($tokenId, $ws->paramGet('APP_CODE'), 'PASSWORD');
if ($fct_return->statusGet()) {
	if($fct_return->returnGet()['user_id'] != '') {
		$userId = $fct_return->returnGet()['user_id'];
		$connect = new object_connect();
		$fct_return = $connect->display($userId);
		if ($fct_return->statusGet()) {
			$login = $fct_return->returnGet()['login'];
		}
	}
}
$return = 'Error';
if (($login != '') and ($password != '')){
	$connect = new object_connect();
	$fct_return = $connect->changePassword($login, $password);
	if ($fct_return->statusGet()) {
		$token->use($tokenId);
		$return = 'Ok';
	}
}
echo $return;
exit();
?>
