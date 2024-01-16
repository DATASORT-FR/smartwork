<?php
/**
* Login module : logout processing
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
$fct_return = $connect->disconnect();
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
