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
$ws->control('article.tpl');
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'article_calculate.php';
require_once($filePath);

$ws->urlTitleSet($pageTitle );
$ws->urlDescriptionSet($pageDescription);
$ws->urlKeywordsSet($urlKeywords);
$ws->urlNewsKeywordsSet($urlNewsKeywords);
$ws->urlImageSet('');

$ws->assign('ArticleLink', $articleLink);
$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('article.tpl');

?>
