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

// Main
$article_ref = $ws->paramGet('ID');
if ($article_ref != '') {
	$_SESSION['object_article_ref'] = $article_ref;
}
else {
	$article_ref = $_SESSION['object_article_ref'];
}

$articleObject = new object_article();
$article = $articleObject->getArticle($article_ref);

$reference = $article['reference'];
$article['date_publication'] = dateFormat('EEEE dd MMMM YYYY', strtotime($article['date_publication']));

$defaultImage = findArticleImage($article['id'], $article['category']);
$articleImage = new JF_ArticleImage();
$article['displayImage'] = $articleImage->display($article, $defaultImage, "video");

$connect = new object_connect();
$listLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'articles');
$adminLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'article_admin', 'command:edit', 'id:' . $article['id']);
$articleLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'article_detail', 'id:' . $article_ref);
$urlLink = constructArticleHref($reference, $article['title']);
$ws->urlLinkSet($urlLink);

$urlKeywords = preg_replace("#;#iusU", ',', $article['keywords']);

$urlNewsKeywords = '';
$listTags = explode(';', $article['tags']);
$tags = array();
for ($i=0; $i < count($listTags); $i++) {
	if ($i > 0) {
		$urlNewsKeywords .= ',';
	}
	$urlNewsKeywords .= $listTags[$i];
	$item = array();
	$item['tag'] = $listTags[$i];
	$item['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'articles', 'tag:' .  $listTags[$i]);	
	$tags[] = $item;
}

$articleLinks = $article['link'];
$links = array();
for ($i=0; $i < count($articleLinks); $i++) {
	$item = get_object_vars($articleLinks[$i]);
	switch ($item['status']) {
		case STATUS_CLOSED :
			$item['status'] = $ws->getConfigVars("Txt_article_status_closed");
			break;
		default:
			$item['status'] = $ws->getConfigVars("Txt_article_status_active");
	}
	$links[] = $item;
}

$article['linkSite'] = '';
$article['linkTitle'] = '';
$article['linkUrl'] = '';
if (isset($links[0])) {
	$article['linkSite'] = $links[0]['site'];
	$article['linkTitle'] = $links[0]['title'];
	$article['linkUrl'] = $links[0]['url'];
}

switch ($article['status']) {
	case STATUS_DUPLICATE :
		$article['statusName'] = $ws->getConfigVars("Txt_article_status_duplicate");
		break;
	case STATUS_KO :
		$article['statusName'] = $ws->getConfigVars("Txt_article_status_ko");
		break;
	case STATUS_INIT :
		$article['statusName'] = $ws->getConfigVars("Txt_article_status_init");
		break;
	case STATUS_ACTIVE :
		$article['statusName'] = $ws->getConfigVars("Txt_article_status_active");
		break;
	case STATUS_CLOSED :
		$article['statusName'] = $ws->getConfigVars("Txt_article_status_closed");
		break;
	case STATUS_BACKUPED :
		$article['statusName'] = $ws->getConfigVars("Txt_article_status_backuped");
		break;
	default:
		$article['statusName'] = '';
}

$pageTitle = $article['category'] . ' ' . $article['subcategory'] . '-' . $article['title'];
$pageTitle = mb_substr($pageTitle, 0, 70);

$pageDescription = $article['thematic'] . ' - ' . $article['subthematic'] . ' - ' .  $article['title'] . '. ' . $article['intro'];
if (mb_strlen($pageDescription) > 330) {
	$pageDescription = mb_substr($pageDescription, 0, 330);
	$cesure = 0;
	$cesure = mb_strrpos($pageDescription, '.');
		
	$cesure1 = mb_strrpos($pageDescription, ';');
	if ($cesure1 > $cesure) {
		$cesure = $cesure1;
	}
	$cesure1 = mb_strrpos($pageDescription, ',');
	if ($cesure1 > $cesure) {
		$cesure = $cesure1;
	}
	$cesure1 = mb_strrpos($pageDescription, ' ');
	if ($cesure1 - $cesure > 10) {
		$cesure = $cesure1;
	}
	if ($cesure > 0) {
		$pageDescription = mb_substr($pageDescription, 0, $cesure);
	}
}
$pageDescription = trim($pageDescription);

$social = new Wsocial();
$socialShare = $social->displayShare('facebook', 'linkedin', 'twitter', 'square:no');

$description = $article['description'];
$description = str_replace('<b></b>', '', $description);
$description = str_replace('<em>em>', '', $description);
$description = str_replace('<em></em>', '', $description);
$description = trim($description);
if (mb_strlen($description) > 1000) {
	$description = mb_substr($description, 0, 1000);
	if (preg_match("# #iusU", $description)) {
		$description = mb_substr($description, 0, mb_strrpos($description, ' '));
	}
	$description = trim($description);
	$description .= ' ' . ' <a href = "' . $article['linkUrl'] . '" target="_blank">';
	$description .=  $ws->getConfigVars("Txt_article_suite");
	$description .= '</a></p>';
}

$article['description'] = $description;

$ws->assign('SocialShare', $socialShare);
$ws->assign('Article', $article);
$ws->assign('Tags', $tags);
$ws->assign('Links', $links);
$ws->assign('ListLink', $listLink);
$ws->assign('AdminLink', $adminLink);
