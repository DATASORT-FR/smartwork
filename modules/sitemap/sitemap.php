<?php
/**
* Sitemap class
*
* @package    module_sitemap
* @version    1.2
* @date       2 Janvier 2018
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('WSITEMAP_NAME', 'sitemap');
$ws->paramSet('WSITEMAP_DEFAULT_NAME', '_default');

// Menu Path
$ws->paramSet($ws->paramGet('WSITEMAP_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('WSITEMAP_NAME') . '/' . TEMPLATES_SRC_PATH);

/**
* Classes for sitemap module.
*/
class Wsitemap
{

	private $_nameArray = array();
	private $_sitemapArray = array();

	function initSmarty($smarty) {
		$ws = workspace::ws_open();
		
		// template directories load
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('WSITEMAP_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('WSITEMAP_NAME') . '_TEMPLATES_SRC_DIR'));

	}

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

    }

    function addLoc() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$name = '';
		$title = ''; 
		$loc  = '';
		$lastmod = '';
		$changefreq = '';
		$priority = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$argFound = false;
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "TITLE" :
						$argFound = true;
						$title = trim($atemp[1]);
						break;
					case "LOC" :
						$argFound = true;
						$loc = trim($atemp[1]);
						break;
					case "NAME" :
						$argFound = true;
						$name = trim($atemp[1]);
						break;
					case "LASTMOD" :
						$argFound = true;
						$lastmod = trim($atemp[1]);
						break;
					case "CHANGEFREQ" :
						$argFound = true;
						$changefreq = trim($atemp[1]);
						break;
					case "PRIORITY" :
						$argFound = true;
						$priority = trim($atemp[1]);
						break;
				}
			}
			if (!$argFound) {
				switch ($noident) {
					case 1 :
						$title = trim($argFunc[$temp]);
						break;
					case 2 :
						$loc = trim($argFunc[$temp]);
						break;
					case 3 :
						$name = trim($argFunc[$temp]);
						break;
					case 4 :
						$lastmod = trim($argFunc[$temp]);
						break;
					case 5 :
						$changefreq = trim($argFunc[$temp]);
						break;
					case 6 :
						$priority = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}
		if (empty($name)) {
			$name = $ws->paramGet('WSITEMAP_DEFAULT_NAME');
		}
		if (!empty($loc)) {
			$item = array();
			$item['name'] = $name;
			$item['title'] = $title;
			$item['loc'] = $loc;
			$item['lastmod'] = $lastmod;
			$item['changefreq'] = $changefreq;
			$item['priority'] = $priority;
			$this->_sitemapArray[] = $item;
		}
	}
	
    function addListSubject() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$application = '';
		$name = '';
		$lastmod = '';
		$changefreq = '';
		$priority = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "APPLICATION" :
						$application = trim($atemp[1]);
						break;
					case "NAME" :
						$name = trim($atemp[1]);
						break;
					case "LASTMOD" :
						$lastmod = trim($atemp[1]);
						break;
					case "CHANGEFREQ" :
						$changefreq = trim($atemp[1]);
						break;
					case "PRIORITY" :
						$priority = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$application = trim($argFunc[$temp]);
						break;
					case 2 :
						$name = trim($argFunc[$temp]);
						break;
					case 3 :
						$lastmod = trim($argFunc[$temp]);
						break;
					case 4 :
						$changefreq = trim($argFunc[$temp]);
						break;
					case 5 :
						$priority = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 
	
		$status = 1;
		$subjectArray = array();
		$objForumSubject = new object_forum_subject();
		$fct_return = $objForumSubject->findList(0, $application, '', $status);
		if ($fct_return->statusGet()) {
			$subjectArray = $fct_return->returnGet();
		}
		foreach($subjectArray as $subjectItem) {
			$subjectLabel = $subjectItem['label'];
			$connect = new object_connect();
			$subjectLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $subjectItem['id'], 'type:subject');
			if (empty($name)) {
				$name = $subjectItem['name'];
			}
			if (empty($lastmod)) {
				$lastmod = dateFormat('YYYY-MM-dd', strtotime($subjectItem['date_last_topic']));
			}
			$this->addLoc($subjectLabel, $subjectLink, $name, $lastmod, $changefreq, $priority);
		}
		
	}

    function addListTopic() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$application = '';
		$name = '';
		$lastmod = '';
		$changefreq = '';
		$priority = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "APPLICATION" :
						$application = trim($atemp[1]);
						break;
					case "NAME" :
						$name = trim($atemp[1]);
						break;
					case "LASTMOD" :
						$lastmod = trim($atemp[1]);
						break;
					case "CHANGEFREQ" :
						$changefreq = trim($atemp[1]);
						break;
					case "PRIORITY" :
						$priority = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$application = trim($argFunc[$temp]);
						break;
					case 2 :
						$name = trim($argFunc[$temp]);
						break;
					case 3 :
						$lastmod = trim($argFunc[$temp]);
						break;
					case 4 :
						$changefreq = trim($argFunc[$temp]);
						break;
					case 5 :
						$priority = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 
	
		$status = 1;
		$subjectArray = array();
		$objForumSubject = new object_forum_subject();
		$fct_return = $objForumSubject->findList(0, $application, '', $status);
		if ($fct_return->statusGet()) {
			$subjectArray = $fct_return->returnGet();
		}
		foreach($subjectArray as $subjectItem) {
			$subjectId = $subjectItem['id'];
			$topicArray = array();
			$objForumTopic = new object_forum_topic();
			$fct_return = $objForumTopic->findList($subjectId, '', 'asc', $status);
			if ($fct_return->statusGet()) {
				$topicArray = $fct_return->returnGet();
			}
			foreach($topicArray as $topicItem) {
				$topicLabel = $topicItem['label'];
				$connect = new object_connect();
				$topicLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $topicItem['id'], 'type:topic');;
				if (empty($lastmod)) {
					$lastmod = dateFormat('YYYY-MM-dd', strtotime($topicItem['date_last_post']));
				}
				$this->addLoc($topicLabel, $topicLink, $name, $lastmod, $changefreq, $priority);
			}
		}
	}

    function addContent() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$code = '';
		$name = '';
		$lastmod = '';
		$changefreq = '';
		$priority = '';
		$style = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "CODE" :
						$code = trim($atemp[1]);
						break;
					case "NAME" :
						$name = trim($atemp[1]);
						break;
					case "LASTMOD" :
						$lastmod = trim($atemp[1]);
						break;
					case "CHANGEFREQ" :
						$changefreq = trim($atemp[1]);
						break;
					case "PRIORITY" :
						$priority = trim($atemp[1]);
						break;
					case "STYLE" :
						$style = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$code = trim($argFunc[$temp]);
						break;
					case 2 :
						$name = trim($argFunc[$temp]);
						break;
					case 3 :
						$lastmod = trim($argFunc[$temp]);
						break;
					case 4 :
						$changefreq = trim($argFunc[$temp]);
						break;
					case 5 :
						$priority = trim($argFunc[$temp]);
						break;
					case 6 :
						$style = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 
		
		$contentId = 0;
		$code = strtoupper($code);
		$connect = new object_connect();
		$objContent = new object_content();
		$fct_return = $objContent->find($ws->paramGet('APP_CODE'), $code);
		if ($fct_return->statusGet()) {
			$content = $fct_return->returnGet();
			$contentId = $content['id'];
			$title = $content['title'];
			if (empty($style)) {
				$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $contentId);
			}
			else {
				$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $contentId, 'style:' . $style);
			}
			if (empty($lastmod)) {
				$lastmod = dateFormat('YYYY-MM-dd', strtotime($content['date_update']));
			}			
			$this->addLoc($title, $contentLink, $name, $lastmod, $changefreq, $priority);
		}
		
	}
	
	function addMenuContent() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$name = '';
		$menu_code = '';
		$lastmod = '';
		$changefreq = '';
		$priority = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "CODE" :
						$menu_code = trim($atemp[1]);
						break;
					case "NAME" :
						$name = trim($atemp[1]);
						break;
					case "LASTMOD" :
						$lastmod = trim($atemp[1]);
						break;
					case "CHANGEFREQ" :
						$changefreq = trim($atemp[1]);
						break;
					case "PRIORITY" :
						$priority = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$menu_code = trim($argFunc[$temp]);
						break;
					case 2 :
						$name = trim($argFunc[$temp]);
						break;
					case 3 :
						$lastmod = trim($argFunc[$temp]);
						break;
					case 4 :
						$changefreq = trim($argFunc[$temp]);
						break;
					case 5 :
						$priority = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 
	
		$menu_code = strtoupper($menu_code);
		$connect = new object_connect();
		$menu = array();
		$adm_menu = new object_menu();
		$fct_return = $adm_menu->displayItems($ws->paramGet('APP_CODE'), $menu_code);
		if ($fct_return->statusGet()) {
			$menu = $fct_return->returnGet();
		}
		if (isset($menu['list'])) {
			$menu_array = $menu['list'];
			foreach($menu_array as $menu_item) {
				if (isset($menu_item['connected'])) {
					$show_item = $menu_item['connected'];
				}
				else {
					$show_item = false;
				}
				if ($show_item) {
					$ref = trim($menu_item['ref']);
					$refId = trim($menu_item['content_id']);
					if ((($ref == '') or ($ref == '#')) and (($refId == '') or ($refId == '0'))) {
						$contentLink = '#';
					}
					else {
						if (($ref == './') and (($refId == '') or ($refId == '0'))) {
							$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'));
						}
						else {
							if (($refId != '') and ($refId != '0')) {
								$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'), $ref, 'id:' . $refId);
							}
							else {
								$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'), $ref);							
							}
						}
					}
					$this->addLoc($menu_item['name'], $contentLink, $name, $lastmod, $changefreq, $priority);
				}
			}
		}
	}
	
    function addListContent() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$name = '';
		$code = '';
		$category = '';
		$lastmod = '';
		$changefreq = '';
		$priority = '';
		$style = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "CODE" :
						$code = trim($atemp[1]);
						break;
					case "CATEGORY" :
						$category = trim($atemp[1]);
						break;
					case "NAME" :
						$name = trim($atemp[1]);
						break;
					case "LASTMOD" :
						$lastmod = trim($atemp[1]);
						break;
					case "CHANGEFREQ" :
						$changefreq = trim($atemp[1]);
						break;
					case "PRIORITY" :
						$priority = trim($atemp[1]);
						break;
					case "STYLE" :
						$style = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$code = trim($argFunc[$temp]);
						break;
					case 2 :
						$category = trim($argFunc[$temp]);
						break;
					case 3 :
						$name = trim($argFunc[$temp]);
						break;
					case 4 :
						$lastmod = trim($argFunc[$temp]);
						break;
					case 5 :
						$changefreq = trim($argFunc[$temp]);
						break;
					case 6 :
						$priority = trim($argFunc[$temp]);
						break;
					case 7 :
						$style = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		$contentArray = array();
		$code = strtoupper($code);
		$objContent = new object_content();
		$fct_return = $objContent->findList($ws->paramGet('APP_CODE'), $code, $category);
		if ($fct_return->statusGet()) {
			$contentArray = $fct_return->returnGet();
		}
		
		$dateCurrent = new DateTime(date("Y-m-d"));
		$connect = new object_connect();
		foreach($contentArray as $key=>$content) {
			$contentId = $content['id'];
			$title = $content['title'];
			if (empty($style)) {
				$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $contentId);
			}
			else {
				$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $contentId, 'style:' . $style);
			}
			if (empty($lastmod)) {
				$lastmod = dateFormat('YYYY-MM-dd', strtotime($content['date_update']));
			}			
			$datePublication = new DateTime($content['date_publication']);
			if (($content['status_id'] == 1) and ($datePublication <= $dateCurrent)) {
				$this->addLoc($title, $contentLink, $name, $lastmod, $changefreq, $priority);
			}
		}

	}
	
    function displayXml() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$sitemapList = array();
		foreach($this->_sitemapArray as $key=>$item) {			
			$site = '';
			if (empty($ws->canonicalGet())) {
				$item['loc'] = preg_replace("#^\./#isU", $ws->baseUrlGet(), $item['loc']);
			}
			else {
				$item['loc'] = preg_replace('#^\./' . strtolower($ws->paramGet('APP_CODE')) . '/#Usi', $ws->canonicalGet() . '/' , $item['loc']);
				$item['loc'] = preg_replace('#^\./#Usi', $ws->canonicalGet() . '/' , $item['loc']);
			}
			$sitemapList[] = $item;
		}

		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('Sitemap',$sitemapList);
		header('Content-Type: text/xml; charset=UTF-8');
		$displayXml = $smarty->fetch('sitemapxml.tpl');
		echo $displayXml;
	}

    function display($app, $menu_code, $style = 'default', $classAdd = '') {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$sitemapList = array();

		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('Sitemap',$sitemapList);
		$displayHtml = $smarty->fetch('sitemap.tpl');
		return $displayHtml;
	}

}

?>
