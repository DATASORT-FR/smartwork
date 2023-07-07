<?php
/**
* Mission file for Job freelance
*
* @package    Job Freelance
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('mission_detail.tpl');

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'mission_calculate.php';
require_once($filePath);

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('mission_detail.tpl');

?>
