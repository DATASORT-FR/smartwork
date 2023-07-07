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
$ws->control('mission.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateSearch.php';
require_once($filePath);

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'mission_calculate.php';
require_once($filePath);

$ws->urlTitleSet($pageTitle );
$ws->urlDescriptionSet($pageDescription);
$ws->urlKeywordsSet($urlKeywords);
$ws->urlNewsKeywordsSet($urlNewsKeywords);
$ws->urlImageSet('');

$ws->assign('MissionLink', $missionLink);
$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('mission.tpl');

?>
