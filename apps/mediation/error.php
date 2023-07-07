<?php
/**
* Error file for Job freelance
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
$ws->control();
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

// Main zone
$article = new object_article();
$listHeader = $article->getListArticle();
$list = $listHeader['list'];
$listCount = $listHeader['count'];
$listPage =	$listHeader['page'];
$listPageCount = $listHeader['page_count'];
$listPageItemCount = $listHeader['page_item_count'];
$listSearch = $listHeader['search'];
$listCategory = $listHeader['category'];
//$listLocations = $listHeader['location'];
$listTags = $listHeader['tags'];
$articleList = array();
$connect = new object_connect();
for ($i=0; $i < count($list); $i++) {
	$item = get_object_vars($list[$i]);
	$item['intro'] = preg_replace("#\r\n|\r|\n#U",' ',$item['intro']);
	$item['href'] = constructArticleHref($item['reference'], $item['title']);
	$articleList[] = $item;
}
$ws->assign('ArticleList', $articleList);

$ws->build('error.tpl');
?>