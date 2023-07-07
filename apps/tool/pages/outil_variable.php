<?php
/**
* Main file for diagram variables design
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
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_diagnostic.php';
require_once($filePath);

$displayHtml = displayVariable();

$title = 'Diagnostic-Variable';
$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

echo($displayHtml);
?>