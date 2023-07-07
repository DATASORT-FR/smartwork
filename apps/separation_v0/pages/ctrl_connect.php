<?php
/**
* Main file for diagram results design
*
* @package    Diagram 
* @subpackage controller
* @version    1.0
* @date       14 March 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));

$userId = 0;
$inscriptionId = $ws->sessionGet('inscription_id');
if ($flagConnect) {
	$userId = $ws->connected_id();
}
if ((SEPARATION_ESPACE_DEBUG) or ($userId != 0)) {
	echo 'Ok';
}
else {
	if ($inscriptionId != '') {
		echo 'Inactif';
	}
	else {
		echo 'Unvalid';
	}
}
exit();

?>