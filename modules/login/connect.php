<?php
/**
* Login module : login processing
*
* @package    module_login
* @version    1.0
* @date       15 September 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, 'Main');

$connect = new object_connect();
$login = $ws->argPost('login');
$password = $ws->argPost('password');

$fct_return = $connect->connect($login, $password);
if ($fct_return->statusGet()) {
	if($fct_return->returnGet() != 0) {
		$return = 'Ok';
	}
	else {
		$return = 'Unvalid';
	}
}
else {
	$return = 'Error';
}
echo $return;
exit();

?>
