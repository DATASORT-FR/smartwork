<?php
/**
* Login module : logout processing
*
* @package    module_login
* @subpackage controller
* @version    1.0
* @date       15 September 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, 'Main');

$connect = new object_connect();
$fct_return = $connect->disconnect();
$ws->redirect($connect->constructHref($ws->paramGet('APP_CODE')));

?>
