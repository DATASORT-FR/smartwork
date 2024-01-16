<?php
/**
* Login module : inscription processing
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
$login = $ws->argPost('email');
$email = $ws->argPost('email');
$surName = $ws->argPost('surname');
$password = $ws->argPost('password');

$fct_return = $connect->control($login);
if ($fct_return->statusGet()) {
	if($fct_return->returnGet()['id'] == 0) {
		$fct_return = $connect->inscription($login, $email, $surName, $password);
		if ($fct_return->statusGet()) {
			$return = 'Ok';
		}
		else {
			$return = 'Error';
		}
	}
	else {
		$return = 'Exist';
	}
}
else {
	$return = 'Error';
}
echo $return;
exit();
?>
