<?php
/**
* Copy of diagram
*
* @package    use_diagram
* @subpackage Json api
* @version    1.0
* @date       15 March 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$diagramId = $ws->paramGet('ID');
if ($diagramId != '') {
	$_SESSION['object_diagram_id'] = $diagramId;
}
else {
	$diagramId = $_SESSION['object_diagram_id'];
}

$copyFlag = false;
if ($diagramId != '') {
	$diagram = new object_diagram();
	$copyFlag = $diagram->copy($diagramId)->statusGet();
}
$ws->build('return');

?>
