<?php
/**
* Main file for diagram chart design
*
* @package    Diagram svg
* @subpackage controller
* @version    1.0
* @date       28 September 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateHome.php';
require_once($filePath);

$ws->caching = false;
$ws->build('diagram-design.tpl');

?>