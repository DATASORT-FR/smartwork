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
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_diagnostic.php';
require_once($filePath);

$categoryName = SEPARATION_RESULT_CATEGORY;
$displayHtml = displayResult($categoryName);

$title = 'Diagnostic-Résultat';
$ws->logTrace($ws->paramGet('TRACE_NAME'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $title);

echo($displayHtml);

?>