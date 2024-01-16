<?php
/**
* Forum class
*
* @package    forum_module
* @version    2.0
* @date       17 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('WFORUM_NAME', 'forum');

// Page Path
$ws->paramSet($ws->paramGet('WFORUM_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . TEMPLATES_SRC_PATH);
$ws->paramSet($ws->paramGet('WFORUM_NAME') . '_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/templates/css/');
$ws->paramSet($ws->paramGet('WFORUM_NAME') . '_TEMPLATES_JS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/templates/js/');

// Template css & js
$ws->paramSet($ws->paramGet('WFORUM_NAME') . '_TEMPLATE_STYLE', $ws->paramGet('WFORUM_NAME') . '.css');
$ws->paramSet($ws->paramGet('WFORUM_NAME') . '_TEMPLATE_JS', $ws->paramGet('WFORUM_NAME') . '.js');

$ws->addcss($ws->paramGet($ws->paramGet('WFORUM_NAME') . '_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('WFORUM_NAME') . '_TEMPLATE_STYLE'));
//$ws->addjs($ws->paramGet($ws->paramGet('WFORUM_NAME') . '_TEMPLATES_JS_DIR') . $ws->paramGet($ws->paramGet('WFORUM_NAME') . '_TEMPLATE_JS'));

if (!$ws->ctrlParam('FORUM_RIGHT_CREATE')) {
	$ws->paramSet('FORUM_RIGHT_CREATE', 0);
}
if (!$ws->ctrlParam('FORUM_RIGHT_READ')) {
	$ws->paramSet('FORUM_RIGHT_READ', 1);
}
if (!$ws->ctrlParam('FORUM_RIGHT_UPDATE')) {
	$ws->paramSet('FORUM_RIGHT_UPDATE', 0);
}
if (!$ws->ctrlParam('FORUM_RIGHT_DELETE')) {
	$ws->paramSet('FORUM_RIGHT_DELETE', 0);
}
if (!$ws->ctrlParam('FORUM_RIGHT_EVENT')) {
	$ws->paramSet('FORUM_RIGHT_EVENT', 0);
}

/**
* Classes for forum module.
*/
class Wforum
{

	private $_subjectArray = array();
	private $_topicArray = array();
	private $_postArray = array();
	
	private function initContent($itemArray, $index) {
		$return = '';
		
		if (isset($itemArray[$index])) {
			$return = $itemArray[$index];
		}
		return $return;
	}
	
    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

    }

	public function initSmarty($smarty) {
		$ws = workspace::ws_open();
		
		// template directories load
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('WFORUM_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('WFORUM_NAME') . '_TEMPLATES_SRC_DIR'));	
	}

    function ctrl($code) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
		
		$return = false;
		$objContent = new object_content();
		$fct_return = $objContent->ctrl($ws->paramGet('APP_CODE_CONTENT'), $code);
		if ($fct_return->statusGet()) {
			$return = $fct_return->returnGet();
		}
		else {
			$return = false;
		}
		return $return;
	}

	function displaySubjectGet($key) {
		$return = '';

		if (isset($this->_subjectArray[$key])) {
			$return = $this->_subjectArray[$key];
		}		
		return $return;
	}

	function displayTopicGet($key) {
		$return = '';

		if (isset($this->_topicArray[$key])) {
			$return = $this->_topicArray[$key];
		}		
		return $return;
	}

	function displayPostGet($key) {
		$return = '';

		if (isset($this->_postArray[$key])) {
			$return = $this->_postArray[$key];
		}		
		return $return;
	}

	/************************/
	/*  Subjects management */
	/************************/
	function fetchListSubject() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$application = '';
		$categoryId = '';
		$listStyle = '';
		$strMax = '';
		$strFlagCaption = '';
		$strFlagHeader = '';
		
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'APPLICATION' :
						$application = trim($atemp[1]);
						break;
					case 'CATEGORY' :
						$categoryId = trim($atemp[1]);
						break;
					case 'STYLE' :
						$listStyle = trim($atemp[1]);
						break;
					case 'MAX' :
						$strMax = trim($atemp[1]);
						break;
					case 'CAPTION' :
						$strFlagCaption = trim($atemp[1]);
						break;
					case 'HEADER' :
						$strFlagHeader = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$application = trim($argFunc[$temp]);
						break;
					case 2 :
						$categoryId = trim($argFunc[$temp]);
						break;
					case 3 :
						$listStyle = trim($argFunc[$temp]);
						break;
					case 4 :
						$strMax = trim($argFunc[$temp]);
						break;
					case 5 :
						$strFlagCaption = trim($argFunc[$temp]);
						break;
					case 6 :
						$strFlagHeader = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		$max = 0;
		if (!empty($strMax)) {
			$max = (int)$strMax;
		}
		$flagCaption = false;
		if (!empty($strFlagCaption)) {
			if (strtoupper(trim($strFlagCaption)) == 'TRUE') {
				$flagCaption = true;
			}
		}
		$flagHeader = false;
		if (!empty($strFlagHeader)) {
			if (strtoupper(trim($strFlagHeader)) == 'TRUE') {
				$flagHeader = true;
			}
		}
		if (empty($listStyle)) {
			$listStyle = 'listsubject';
		}
		
		$status = 1;
		if (($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$status = 0;
		}
		$subjectArray = array();
		$objForumSubject = new object_forum_subject();
		if (!empty($application)) {
			if (!empty($categoryId)) {
				$fct_return = $objForumSubject->findList($categoryId, $application, '', $status);
			}
			else {
				$fct_return = $objForumSubject->findList(0, $application, '', $status);
			}
		}
		else {
			if (!empty($categoryId)) {
				$fct_return = $objForumSubject->findList($categoryId, '', '', $status);
			}
			else {
				$fct_return = $objForumSubject->findList(0, '', '', $status);
			}
		}
		if ($fct_return->statusGet()) {
			$subjectArray = $fct_return->returnGet();
		}
		
		$listSubject = array();
		$nb = 0;
		$dateCurrent = new DateTime(date("Y-m-d"));
		foreach($subjectArray as $subjectItem) {
			if (($max == 0) or (($max > 0) and ($nb < $max))) {

				// Status
				if (!isset($subjectItem['status'])) {
					$subjectItem['status'] = $ws->getConfigVars("Lbl_status_0");
					if ($subjectItem['status_id'] == 1) {
						$subjectItem['status'] = $ws->getConfigVars("Lbl_status_1");
					}
				}
				
				// Creation date
				$subjectItem['date_day_creation'] = dateFormat('EEEE dd MMMM YYYY', strtotime($subjectItem['date_creation']));
				$subjectItem['day_creation'] = dateFormat('dd', strtotime($subjectItem['date_creation']));
				$subjectItem['month_creation'] = dateFormat('MMM', strtotime($subjectItem['date_creation']));
				$subjectItem['date_creation'] = dateFormat('dd MMMM YYYY', strtotime($subjectItem['date_creation']));

				// Last Topic date
				$subjectItem['date_last_topic_time'] = dateFormat('dd MMMM YYYY HH:mm', strtotime($subjectItem['date_last_topic']));
				$subjectItem['date_last_topic'] = dateFormat('dd MMMM YYYY', strtotime($subjectItem['date_last_topic']));

				// Last Post date
				$subjectItem['date_last_post_time'] = dateFormat('dd MMMM YYYY HH:mm', strtotime($subjectItem['date_last_post']));
				$subjectItem['date_last_post'] = dateFormat('dd MMMM YYYY', strtotime($subjectItem['date_last_post']));
				
				// Vignette
				$atemp = explode(';',$subjectItem['vignette']);
				$image = '';
				$imageAlt = '';
				$imageTitle = '';
				if (isset($atemp[0])) {
					$image = $atemp[0];
				}
				if (isset($atemp[1])) {
					$imageAlt = $atemp[1];
				}
				if (isset($atemp[2])) {
					$imageTitle = $atemp[2];
				}
				if (!file_exists($image)) {
					$image = '';
				}
				$subjectItem['vignette'] = $image;
				$subjectItem['vignette_alt'] = $imageAlt;
				$subjectItem['vignette_title'] = $imageTitle;
			
				$connect = new object_connect();
				$subjectItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $subjectItem['id'], 'type:subject');
				
				$listSubject[] = $subjectItem;
				$nb++;
			}
		}

		$connect = new object_connect();
		$subjectLinkCreate = $connect->constructHref($ws->paramGet('APP_CODE'), "admsubject", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:new', 'application:' . $application);
		$btCreate = false;
		if (($ws->paramGet('FORUM_RIGHT_CREATE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$btCreate = true;
		}
		$flagAdmin = false;
		if (($ws->paramGet('FORUM_RIGHT_CREATE') == 1) or ($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$flagAdmin = true;
		}
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('listSubject',$listSubject);
		$smarty->assign('flagCaption', $flagCaption);
		$smarty->assign('flagHeader', $flagHeader);
		$smarty->assign('subject_linkCreate',$subjectLinkCreate);
		$smarty->assign('btCreate',$btCreate);
		$smarty->assign('flagAdmin',$flagAdmin);
		$displayHtml = $smarty->fetch($listStyle . '.tpl');

		return $displayHtml;
	}

	function displayListSubject() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$application = '';
		$categoryId = '';
		$style = '';
		$strMax = '';
		$strFlagCaption = '';
		$strFlagHeader = '';

		$page = 1;
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'APPLICATION' :
						$application = trim($atemp[1]);
						break;
					case 'CATEGORY' :
						$categoryId = trim($atemp[1]);
						break;
					case 'STYLE' :
						$style = trim($atemp[1]);
						break;
					case 'MAX' :
						$strMax = trim($atemp[1]);
						break;
					case 'CAPTION' :
						$strFlagCaption = trim($atemp[1]);
						break;
					case 'HEADER' :
						$strFlagHeader = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$application = trim($argFunc[$temp]);
						break;
					case 2 :
						$categoryId = trim($argFunc[$temp]);
						break;
					case 3 :
						$style = trim($argFunc[$temp]);
						break;
					case 4 :
						$strMax = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		$max = 0;
		if (!empty($strMax)) {
			$max = (int)$strMax;
		}
		$flagCaption = false;
		if (!empty($strFlagCaption)) {
			if (strtoupper(trim($strFlagCaption)) == 'TRUE') {
				$flagCaption = true;
			}
		}
		$flagHeader = false;
		if (!empty($strFlagHeader)) {
			if (strtoupper(trim($strFlagHeader)) == 'TRUE') {
				$flagHeader = true;
			}
		}
		if (empty($style)) {
			$listStyle = 'listsubject';
		}
		else {
			$style = strtolower($style);
			$listStyle = 'listsubject_' . $style;
		}

		$connect = new object_connect();
		$subjectLinkList = $connect->constructHref($ws->paramGet('APP_CODE'), "listsubject", "module:" . $ws->paramGet('WFORUM_NAME'), "p:" . $page, 'application:' . $application, 'category:' . $categoryId, 'style:' . $style, 'max:' . $max, 'caption:' . $flagCaption, 'header:' . $flagHeader);
		$displayHtml = $this->fetchListSubject($application, $categoryId, $listStyle, $max, $flagCaption, $flagHeader);
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('forum_linkList',$subjectLinkList);
		$smarty->assign('displayHtml',$displayHtml);
		$displayHtml = $smarty->fetch('listdisplay.tpl');
		return $displayHtml;
	}

	function fetchSubject() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$argSup = array();
		$subjectId = "";
		$subjectStyle = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "ID" :
						$subjectId = trim($atemp[1]);
						break;
					case "STYLE" :
						$subjectStyle = trim($atemp[1]);
						break;
					default:
						$argSup[trim($atemp[0])] = trim($atemp[1]);
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$subjectId = trim($argFunc[$temp]);
						break;
					case 2 :
						$subjectStyle = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 

		$subject = array();
		$displayHtml = '';
		$objForumSubject = new object_forum_subject();
		$fct_return = $objForumSubject->display($subjectId);
		if ($fct_return->statusGet()) {
			$subject = $fct_return->returnGet();
		}
		$this->_subjectArray = $subject;

		$subjectDate = $this->initContent($subject,'date_creation');
		$subjectName = $this->initContent($subject,'name');
		$subjectStatusId = $this->initContent($subject,'status_id');
		$subjectCategoryId = $this->initContent($subject,'category_id');
		$subjectSequence = $this->initContent($subject,'sequence');
		$subjectVignette = $this->initContent($subject,'vignette');
		$subjectLabel = $this->initContent($subject,'label');
		$subjectAlt = $this->initContent($subject,'alt');
		$subjectAlias = $this->initContent($subject,'alias');
		$subjectClass = $this->initContent($subject,'class');
		$subjectIcon = $this->initContent($subject,'icon');
		$subjectImage = $this->initContent($subject,'image');
		$subjectDescription = $this->initContent($subject,'description');
		$subjectKeywords = $this->initContent($subject,'keywords');
		$subjectContent = $this->initContent($subject,'content');
		$subjectNbTopic = $this->initContent($subject,'nb_topic');
		$subjectDateTopic = $this->initContent($subject,'date_last_topic');
		$subjectAuthorTopic = $this->initContent($subject,'author_last_topic');
		$subjectNbPost = $this->initContent($subject,'nb_post');
		$subjectDatePost = $this->initContent($subject,'date_last_post');
		$subjectAuthorPost = $this->initContent($subject,'author_last_post');

		$btEdit = false;
		$btDelete = false;

		if (($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$btEdit = true;
		}
		if (($ws->paramGet('FORUM_RIGHT_DELETE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$btDelete = true;
		}

		$displayHtml = '';
		$fileTop = 'subjecttop.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileTop;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileTop;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$subjectTop = $displayHtml;
		
		$displayHtml = '';
		$fileAdd = 'subjectadd.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileAdd;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileAdd;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$subjectAdd = $displayHtml;
		
		$displayHtml = '';
		$fileBottom = 'subjectbottom.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileBottom;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileBottom;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$subjectBottom = $displayHtml;

		// Status
		$subjectStatus = $ws->getConfigVars("Lbl_status_0");
		if ($subjectStatusId == 1) {
			$subjectStatus = $ws->getConfigVars("Lbl_status_1");
		}

		// Creation date
		$subjectDayDate = dateFormat('EEEE dd MMMM YYYY', strtotime($subjectDate));
		$subjectDay = dateFormat('dd', strtotime($subjectDate));
		$subjectMonth = dateFormat('MMM', strtotime($subjectDate));
		$subjectDate = dateFormat('dd MMMM YYYY', strtotime($subjectDate));

		// Vignette
		$atemp = explode(';',$subjectVignette);
		$image = '';
		$imageAlt = '';
		$imageTitle = '';
		if (isset($atemp[0])) {
			$image = $atemp[0];
		}
		if (isset($atemp[1])) {
			$imageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$imageTitle = $atemp[2];
		}
		if (!file_exists($image)) {
			$image = '';
		}
		$subjectVignette = $image;
		$subjectVignetteAlt = $imageAlt;
		$subjectVignetteTitle = $imageTitle;

		// Image
		$atemp = explode(';',$subjectImage);
		$image = '';
		$imageAlt = '';
		$imageTitle = '';
		if (isset($atemp[0])) {
			$image = $atemp[0];
		}
		if (isset($atemp[1])) {
			$imageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$imageTitle = $atemp[2];
		}
		if (!file_exists($image)) {
			$image = '';
		}
		$subjectImage = $image;
		$subjectImageAlt = $imageAlt;
		$subjectImageTitle = $imageTitle;

		$connect = new object_connect();
		$subjectLinkEdit = $connect->constructHref($ws->paramGet('APP_CODE'), "admsubject", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:edit', 'id:' .  $subjectId);
		$subjectLinkDelete = $connect->constructHref($ws->paramGet('APP_CODE'), "admsubject", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:delete', 'id:' .  $subjectId);
		if (empty($subjectStyle)) {
			$subjectStyle = 'subject';
		}

		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('subject_date',$subjectDate);
		$smarty->assign('subject_dayDate',$subjectDayDate);
		$smarty->assign('subject_day',$subjectDay);
		$smarty->assign('subject_month',$subjectMonth);
		$smarty->assign('subject_name',$subjectName);
		$smarty->assign('subject_statusId',$subjectStatusId);
		$smarty->assign('subject_status',$subjectStatus);
		$smarty->assign('subject_categoryId',$subjectCategoryId);
		$smarty->assign('subject_sequence',$subjectSequence);
		$smarty->assign('subject_vignette',$subjectVignette);
		$smarty->assign('subject_vignetteAlt',$subjectVignetteAlt);
		$smarty->assign('subject_vignetteTitle',$subjectVignetteTitle);
		$smarty->assign('subject_label',$subjectLabel);
		$smarty->assign('subject_alt',$subjectAlt);
		$smarty->assign('subject_alias',$subjectAlias);
		$smarty->assign('subject_class',$subjectClass);
		$smarty->assign('subject_icon',$subjectIcon);
		$smarty->assign('subject_image',$subjectImage);
		$smarty->assign('subject_imageAlt',$subjectImageAlt);
		$smarty->assign('subject_imageTitle',$subjectImageTitle);
		$smarty->assign('subject_description',$subjectDescription);
		$smarty->assign('subject_keywords',$subjectKeywords);
		$smarty->assign('subject_top',$subjectTop);
		$smarty->assign('subject_add',$subjectAdd);
		$smarty->assign('subject_bottom',$subjectBottom);
		$smarty->assign('subject_content',$subjectContent);
		$smarty->assign('subject_nbTopic',$subjectNbTopic);
		$smarty->assign('subject_dateTopic',$subjectDateTopic);
		$smarty->assign('subject_authorTopic',$subjectAuthorTopic);
		$smarty->assign('subject_nbPost',$subjectNbPost);
		$smarty->assign('subject_datePost',$subjectDatePost);
		$smarty->assign('subject_authorPost',$subjectAuthorPost);
		foreach($argSup as $key => $value) {
			$smarty->assign('subject' . $key, $value);
		}
		
		$smarty->assign('subject_linkEdit',$subjectLinkEdit);
		$smarty->assign('subject_linkDelete',$subjectLinkDelete);

		$smarty->assign('btEdit',$btEdit);
		$smarty->assign('btDelete',$btDelete);

		$displayHtml = $smarty->fetch($subjectStyle . '.tpl');

		$ws->pageTitleSet($subjectName);
		$ws->pageDescriptionSet($subjectDescription);
		$ws->pageKeywordsSet($subjectKeywords);
		$pageImage= preg_replace('#^\./#Usi', $ws->baseUrlGet() , $subjectImage);
		$ws->pageImageSet($pageImage);
			
		return $displayHtml;
	}
	
	function displaySubject() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$argSup = array();
		$subjectId = "";
		$style = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "ID" :
						$subjectId = trim($atemp[1]);
						break;
					case "STYLE" :
						$style = trim($atemp[1]);
						break;
					default:
						$argSup[trim($atemp[0])] = trim($atemp[1]);
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$subjectId = trim($argFunc[$temp]);
						break;
					case 2 :
						$style = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 

		if (empty($style)) {
			$subjectStyle = 'subject';
		}
		else {
			$style = strtolower($style);
			$subjectStyle = 'subject_' . $style;
		}
		
		$connect = new object_connect();
		$subjectLink = $connect->constructHref($ws->paramGet('APP_CODE'), "subject", "module:" . $ws->paramGet('WFORUM_NAME'), 'id:' . $subjectId, 'style:' . $subjectStyle);
		
		$displayHtml = $this->fetchSubject($subjectId, $subjectStyle);
		
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('forum_link',$subjectLink);
		$smarty->assign('displayHtml',$displayHtml);
		$displayHtml = $smarty->fetch('display.tpl');
		return $displayHtml;
	}

	/********************/
	/*  Topics management */
	/********************/
	function fetchListTopic() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$subjectId = '';
		$listStyle = '';
		$strMax = '';
		$strFlagHeader = '';

		$page = 1;
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'SUBJECT' :
						$subjectId = trim($atemp[1]);
						break;
					case 'STYLE' :
						$listStyle = trim($atemp[1]);
						break;
					case 'MAX' :
						$strMax = trim($atemp[1]);
						break;
					case 'HEADER' :
						$strFlagHeader = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$subjectId = trim($argFunc[$temp]);
						break;
					case 2 :
						$listStyle = trim($argFunc[$temp]);
						break;
					case 3 :
						$strMax = trim($argFunc[$temp]);
						break;
					case 4 :
						$strFlagHeader = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		$max = 0;
		if (!empty($strMax)) {
			$max = (int)$strMax;
		}
		$flagHeader = false;
		if (!empty($strFlagHeader)) {
			if (strtoupper(trim($strFlagHeader)) == 'TRUE') {
				$flagHeader = true;
			}
		}
		if (empty($listStyle)) {
			$listStyle = 'listtopic';
		}
		$status = 1;
		if (($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$status = 0;
		}
		$topicArray = array();
		$displayHtml = '';
		$objForumTopic = new object_forum_topic();
		if (!empty($subjectId)) {
			$fct_return = $objForumTopic->findList($subjectId, '', 'asc', $status);
		}
		else {
			$fct_return = $objForumTopic->findList(0, '', 'asc', $status);
		}
		if ($fct_return->statusGet()) {
			$topicArray = $fct_return->returnGet();
		}
		
		$listTopic = array();
		$nb = 0;
		$dateCurrent = new DateTime(date("Y-m-d"));
		foreach($topicArray as $topicItem) {
			if (($max == 0) or (($max > 0) and ($nb < $max))) {

				// Read flag
				$dateRead = date('Y-m-d H:i:s');
				$objForumTopicHistory = new object_forum_topic_history();
				$fct_return = $objForumTopicHistory->findDate($ws->connected_id(), $topicItem['id']);
				if ($fct_return->statusGet()) {
					$dateRead = $fct_return->returnGet();
				}
				$topicRead = false;
				if ($topicItem['date_last_post'] < $dateRead) {
					$topicRead = true;
				}
				$topicItem['read'] = $topicRead;
				
				// Status
				if (!isset($topicItem['status'])) {
					$topicItem['status'] = $ws->getConfigVars("Lbl_status_0");
					if ($topicItem['status_id'] == 1) {
						$topicItem['status'] = $ws->getConfigVars("Lbl_status_1");
					}
				}

				// Creation date
				$topicItem['date_day_creation'] = dateFormat('EEEE dd MMMM YYYY', strtotime($topicItem['date_creation']));
				$topicItem['date_day_creation_time'] = dateFormat('EEEE dd MMMM YYYY HH:mm', strtotime($topicItem['date_creation']));
				$topicItem['day_creation'] = dateFormat('dd', strtotime($topicItem['date_creation']));
				$topicItem['month_creation'] = dateFormat('MMM', strtotime($topicItem['date_creation']));
				$topicItem['date_creation_time'] = dateFormat('dd MMMM YYYY HH:mm', strtotime($topicItem['date_creation']));
				$topicItem['date_creation'] = dateFormat('dd MMMM YYYY', strtotime($topicItem['date_creation']));

				// Last Post date
				if ($topicItem['date_last_post'] != null) {
					$topicItem['date_last_post_time'] = dateFormat('dd MMMM YYYY HH:mm', strtotime($topicItem['date_last_post']));
					$topicItem['date_last_post'] = dateFormat('dd MMMM YYYY', strtotime($topicItem['date_last_post']));
				}
				else {
					$topicItem['date_last_post_time'] = '';
					$topicItem['date_last_post'] = '';
				}

				// Vignette
				$atemp = explode(';','');
				$image = '';
				$imageAlt = '';
				$imageTitle = '';
				if (isset($atemp[0])) {
					$image = $atemp[0];
				}
				if (isset($atemp[1])) {
					$imageAlt = $atemp[1];
				}
				if (isset($atemp[2])) {
					$imageTitle = $atemp[2];
				}
				if (!file_exists($image)) {
					$image = '';
				}
				$topicItem['vignette'] = $image;
				$topicItem['vignette_alt'] = $imageAlt;
				$topicItem['vignette_title'] = $imageTitle;

				$connect = new object_connect();
				$topicItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $topicItem['id'], 'type:topic');
				
				$listTopic[] = $topicItem;
				$nb++;
			}
		}

		$connect = new object_connect();
		$topicLinkCreate = $connect->constructHref($ws->paramGet('APP_CODE'), "admtopic", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:new', 'subject:' . $subjectId);
		$btCreate = false;
		if ($ws->connected() and ($ws->connected_id() != $ws->paramGet('USER_GUEST'))) {
			$btCreate = true;
		}
		$flagAdmin = false;
		if (($ws->paramGet('FORUM_RIGHT_CREATE') == 1) or ($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$flagAdmin = true;
		}
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('listTopic',$listTopic);
		$smarty->assign('flagHeader', $flagHeader);
		$smarty->assign('topic_linkCreate',$topicLinkCreate);
		$smarty->assign('btCreate',$btCreate);
		$smarty->assign('flagAdmin',$flagAdmin);
		$displayHtml = $smarty->fetch($listStyle . '.tpl');

		return $displayHtml;
	}

	function displayListTopic() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$subjectId = '';
		$style = '';
		$strMax = '';
		$strFlagHeader = '';

		$page = 1;
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'SUBJECT' :
						$subjectId = trim($atemp[1]);
						break;
					case 'STYLE' :
						$style = trim($atemp[1]);
						break;
					case 'MAX' :
						$strMax = trim($atemp[1]);
						break;
					case 'HEADER' :
						$strFlagHeader = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$subjectId = trim($argFunc[$temp]);
						break;
					case 2 :
						$style = trim($argFunc[$temp]);
						break;
					case 3 :
						$strMax = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		$max = 0;
		if (!empty($strMax)) {
			$max = (int)$strMax;
		}
		$flagHeader = false;
		if (!empty($strFlagHeader)) {
			if (strtoupper(trim($strFlagHeader)) == 'TRUE') {
				$flagHeader = true;
			}
		}
		
		$displayHtml = '';
		if (empty($style)) {
			$listStyle = 'listtopic';
		}
		else {
			$style = strtolower($style);
			$listStyle = 'listtopic_' . $style;
		}
		
		$connect = new object_connect();
		$topicLinkList = $connect->constructHref($ws->paramGet('APP_CODE'), "listtopic", "module:" . $ws->paramGet('WFORUM_NAME'), "p:" . $page, 'subject:' . $subjectId, 'style:' . $listStyle, 'max:' . $max, 'header:' . $flagHeader);
		$displayHtml = $this->fetchListTopic($subjectId, $listStyle, $max, $flagHeader);
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('forum_linkList',$topicLinkList);
		$smarty->assign('displayHtml',$displayHtml);
		$displayHtml = $smarty->fetch('listdisplay.tpl');

		return $displayHtml;
	}

	function displayListLastTopic() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$style = '';
		$strMax = '';

		$page = 1;
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'MAX' :
						$strMax = trim($atemp[1]);
						break;
					case 'STYLE' :
						$style = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$strMax = trim($argFunc[$temp]);
						break;
					case 2 :
						$style = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		$max = 5;
		if (!empty($strMax)) {
			$max = (int)$strMax;
		}
		
		$displayHtml = '';
		if (empty($style)) {
			$listStyle = 'listlasttopic';
		}
		else {
			$style = strtolower($style);
			$listStyle = 'listlasttopic_' . $style;
		}
		
		$status = 1;
		if (($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$status = 0;
		}
		$topicArray = array();
		$objForumTopic = new object_forum_topic();
		$fct_return = $objForumTopic->findList(0, '', 'desc', $status);
		if ($fct_return->statusGet()) {
			$topicArray = $fct_return->returnGet();
		}
		
		$listTopic = array();
		$nb = 0;
		$dateCurrent = new DateTime(date("Y-m-d"));
		foreach($topicArray as $topicItem) {
			if ($nb < $max) {

				// Read flag
				$dateRead = date('Y-m-d H:i:s');
				$objForumTopicHistory = new object_forum_topic_history();
				$fct_return = $objForumTopicHistory->findDate($ws->connected_id(), $topicItem['id']);
				if ($fct_return->statusGet()) {
					$dateRead = $fct_return->returnGet();
				}
				$topicRead = false;
				if ($topicItem['date_last_post'] < $dateRead) {
					$topicRead = true;
				}
				$topicItem['read'] = $topicRead;
				
				// Status
				if (!isset($topicItem['status'])) {
					$topicItem['status'] = $ws->getConfigVars("Lbl_status_0");
					if ($topicItem['status_id'] == 1) {
						$topicItem['status'] = $ws->getConfigVars("Lbl_status_1");
					}
				}
				// Status
				if (!isset($topicItem['status'])) {
					$topicItem['status'] = $ws->getConfigVars("Lbl_status_0");
					if ($topicItem['status_id'] == 1) {
						$topicItem['status'] = $ws->getConfigVars("Lbl_status_1");
					}
				}

				// Creation date
				$topicItem['date_day_creation'] = dateFormat('EEEE dd MMMM YYYY', strtotime($topicItem['date_creation']));
				$topicItem['day_creation'] = dateFormat('dd', strtotime($topicItem['date_creation']));
				$topicItem['month_creation'] = dateFormat('MMM', strtotime($topicItem['date_creation']));
				$topicItem['date_creation_time'] = dateFormat('dd MMMM YYYY HH:mm', strtotime($topicItem['date_creation']));
				$topicItem['date_creation'] = dateFormat('dd MMMM YYYY', strtotime($topicItem['date_creation']));

				// Last Post date
				if ($topicItem['date_last_post'] != null) {
					$topicItem['date_last_post_time'] = dateFormat('dd MMMM YYYY HH:mm', strtotime($topicItem['date_last_post']));
					$topicItem['date_last_post'] = dateFormat('dd MMMM YYYY', strtotime($topicItem['date_last_post']));
				}
				else {
					$topicItem['date_last_post_time'] = '';
					$topicItem['date_last_post'] = '';
				}

				// Vignette
				$atemp = explode(';','');
				$image = '';
				$imageAlt = '';
				$imageTitle = '';
				if (isset($atemp[0])) {
					$image = $atemp[0];
				}
				if (isset($atemp[1])) {
					$imageAlt = $atemp[1];
				}
				if (isset($atemp[2])) {
					$imageTitle = $atemp[2];
				}
				if (!file_exists($image)) {
					$image = '';
				}
				$topicItem['vignette'] = $image;
				$topicItem['vignette_alt'] = $imageAlt;
				$topicItem['vignette_title'] = $imageTitle;

				$connect = new object_connect();
				$topicItem['href'] = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $topicItem['id'], 'type:topic');
				
				$listTopic[] = $topicItem;
				$nb++;
			}
		}

		$flagAdmin = false;
		if (($ws->paramGet('FORUM_RIGHT_CREATE') == 1) or ($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$flagAdmin = true;
		}
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('listTopic',$listTopic);
		$smarty->assign('flagAdmin',$flagAdmin);
		$displayHtml = $smarty->fetch($listStyle . '.tpl');

		return $displayHtml;
	}

	function fetchTopic() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$argSup = array();
		$topicId = "";
		$topicStyle = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "ID" :
						$topicId = trim($atemp[1]);
						break;
					case "STYLE" :
						$topicStyle = trim($atemp[1]);
						break;
					default:
						$argSup[trim($atemp[0])] = trim($atemp[1]);
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$topicId = trim($argFunc[$temp]);
						break;
					case 2 :
						$style = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 

		$topic = array();
		$displayHtml = '';
		$objForumTopic = new object_forum_topic();
		$fct_return = $objForumTopic->display($topicId);
		if ($fct_return->statusGet()) {
			$topic = $fct_return->returnGet();
		}
		$this->_topicArray = $topic;

		$topicDate = $this->initContent($topic,'date_creation');
		$topicAuthor = $this->initContent($topic,'author');
		$topicSubject = $this->initContent($topic,'subject_name');
		$topicStatusId = $this->initContent($topic,'status_id');
		$topicLabel = $this->initContent($topic,'label');
		$topicAlt = $this->initContent($topic,'alt');
		$topicAlias = $this->initContent($topic,'alias');
		$topicContent = $this->initContent($topic,'content');
		$topicNbPost = $this->initContent($topic,'nb_post');
		$topicDatePost = $this->initContent($topic,'date_last_post');
		$topicAuthorPost = $this->initContent($topic,'author_last_post');

		$btEdit = false;
		$btDelete = false;
		if (($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$btEdit = true;
		}
		if (($ws->paramGet('FORUM_RIGHT_DELETE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$btDelete = true;
		}

		$displayHtml = '';
		$fileTop = 'topictop.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileTop;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileTop;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$topicTop = $displayHtml;
		
		$displayHtml = '';
		$fileAdd = 'topicadd.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileAdd;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileAdd;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$topicAdd = $displayHtml;
		
		$displayHtml = '';
		$fileBottom = 'topicbottom.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileBottom;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileBottom;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$topicBottom = $displayHtml;

		// Status
		$topicStatus = $ws->getConfigVars("Lbl_status_0");
		if ($topicStatusId == 1) {
			$topicStatus = $ws->getConfigVars("Lbl_status_1");
		}

		// Creation date
		$topicDateDay = dateFormat('EEEE dd MMMM YYYY', strtotime($topicDate));
		$topicDay = dateFormat('dd', strtotime($topicDate));
		$topicMonth = dateFormat('MMM', strtotime($topicDate));
		$topicDateTime = dateFormat('dd MMMM YYYY HH:mm', strtotime($topicDate));
		$topicDate = dateFormat('dd MMMM YYYY', strtotime($topicDate));

		// Last Post date
		if ($topicDatePost != null) {
			$topicDatePostTime = dateFormat('dd MMMM YYYY HH:mm', strtotime($topicDatePost));
			$topicDatePost = dateFormat('dd MMMM YYYY', strtotime($topicDatePost));
		}
		else {
			$topicDatePostTime = '';
			$topicDatePost = '';
		}

		$connect = new object_connect();
		$topicLinkEdit = $connect->constructHref($ws->paramGet('APP_CODE'), "admtopic", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:edit', 'id:' .  $topicId);
		$topicLinkDelete = $connect->constructHref($ws->paramGet('APP_CODE'), "admtopic", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:delete', 'id:' .  $topicId);
		if (empty($topicStyle)) {
			$topicStyle = 'topic';
		}
		
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('topic_author',$topicAuthor);
		$smarty->assign('topic_dateDay',$topicDateDay);
		$smarty->assign('topic_day',$topicDay);
		$smarty->assign('topic_month',$topicMonth);
		$smarty->assign('topic_dateTime',$topicDateTime);
		$smarty->assign('topic_date',$topicDate);
		$smarty->assign('topic_subject',$topicSubject);
		$smarty->assign('topic_statusId',$topicStatusId);
		$smarty->assign('topic_status',$topicStatus);
		$smarty->assign('topic_label',$topicLabel);
		$smarty->assign('topic_alt',$topicAlt);
		$smarty->assign('topic_alias',$topicAlias);
		$smarty->assign('topic_top',$topicTop);
		$smarty->assign('topic_add',$topicAdd);
		$smarty->assign('topic_bottom',$topicBottom);
		$smarty->assign('topic_content',$topicContent);
		$smarty->assign('topic_nbPost',$topicNbPost);
		$smarty->assign('topic_datePostTime',$topicDatePostTime);
		$smarty->assign('topic_datePost',$topicDatePost);
		$smarty->assign('topic_authorPost',$topicAuthorPost);
		foreach($argSup as $key => $value) {
			$smarty->assign('topic_' . $key, $value);
		}
		$smarty->assign('topic_linkEdit',$topicLinkEdit);
		$smarty->assign('topic_linkDelete',$topicLinkDelete);
		$smarty->assign('btEdit',$btEdit);
		$smarty->assign('btDelete',$btDelete);
		$displayHtml = $smarty->fetch($topicStyle . '.tpl');

		$ws->pageTitleSet($topicLabel);
		$ws->pageDescriptionSet(mb_substr(LIB_content::cleanHTML($topicContent), 0, 120, 'UTF-8'));

		return $displayHtml;
	}
	
	function displayTopic() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$argSup = array();
		$topicId = "";
		$style = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "CODE" :
						$topicId = trim($atemp[1]);
						break;
					case "STYLE" :
						$style = trim($atemp[1]);
						break;
					default:
						$argSup[trim($atemp[0])] = trim($atemp[1]);
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$topicId = trim($argFunc[$temp]);
						break;
					case 2 :
						$style = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 

		if (empty($style)) {
			$topicStyle = 'topic';
		}
		else {
			$style = strtolower($style);
			$topicStyle = 'topic_' . $style;
		}
		$connect = new object_connect();
		$topicLink = $connect->constructHref($ws->paramGet('APP_CODE'), "topic", "module:" . $ws->paramGet('WFORUM_NAME'), 'id:' . $topicId, 'style:' . $topicStyle);

		$displayHtml = $this->fetchTopic($topicId, $topicStyle);
		
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('forum_link',$topicLink);
		$smarty->assign('displayHtml',$displayHtml);
		$displayHtml = $smarty->fetch('display.tpl');
		return $displayHtml;
	}

	/********************/
	/* Posts Management */
	/********************/
	function fetchListPost() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$topicId = '';
		$listStyle = '';
		$strMax = '';
		$strFlagHeader = '';
		$stylePost = '';

		$page = 1;
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'TOPIC' :
						$topicId = trim($atemp[1]);
						break;
					case 'STYLE' :
						$listStyle = trim($atemp[1]);
						break;
					case 'MAX' :
						$strMax = trim($atemp[1]);
						break;
					case 'HEADER' :
						$strFlagHeader = trim($atemp[1]);
						break;
					case 'STYLE-POST' :
						$stylePost = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$topicId = trim($argFunc[$temp]);
						break;
					case 2 :
						$listStyle = trim($argFunc[$temp]);
						break;
					case 3 :
						$strMax = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		$max = 0;
		if (!empty($strMax)) {
			$max = (int)$strMax;
		}
		$flagHeader = false;
		if (!empty($strFlagHeader)) {
			if (strtoupper(trim($strFlagHeader)) == 'TRUE') {
				$flagHeader = true;
			}
		}
		
		$status = 1;
		if (($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$status = 0;
		}
		$postArray = array();
		$displayHtml = '';
		$objForumPost = new object_forum_post();
		if (!empty($topicId)) {
			$fct_return = $objForumPost->findList($topicId, '', 'asc', $status);
		}
		else {
			$fct_return = $objForumPost->findList(0, '', 'asc', $status);
		}
		if ($fct_return->statusGet()) {
			$postArray = $fct_return->returnGet();
		}

		if (empty($listStyle)) {
			$listStyle = 'listpost';
		}
		if (empty($stylePost)) {
			$stylePost = 'post';
		}
		else {
			$stylePost = strtolower($stylePost);
			$stylePost = 'post_' . $stylePost;
		}

		$listPost = array();
		$nb = 0;
		$connect = new object_connect();
		$dateCurrent = new DateTime(date("Y-m-d"));
		foreach($postArray as $postItem) {
			if (($max == 0) or (($max > 0) and ($nb < $max))) {
				$postId = $postItem['id'];
				$postLink = $connect->constructHref($ws->paramGet('APP_CODE'), "post", "module:" . $ws->paramGet('WFORUM_NAME'), 'id:' . $postId, 'topic:' . $topicId);
				$postItem['href'] = $postLink;
				$displayHtml = $this->fetchPost($postId, $topicId, $stylePost);
				$postItem['html'] = $displayHtml;
				$listPost[] = $postItem;
				$nb++;
			}
		}

		$postLinkCreate = $connect->constructHref($ws->paramGet('APP_CODE'), "admpost", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:new', 'topic:' . $topicId);
		$btCreate = false;
		if ($ws->connected() and ($ws->connected_id() != $ws->paramGet('USER_GUEST'))) {
			$btCreate = true;
		}
		
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('listPost',$listPost);
		$smarty->assign('flagHeader', $flagHeader);
		$smarty->assign('post_linkCreate',$postLinkCreate);
		$smarty->assign('btCreate',$btCreate);
		$displayHtml = $smarty->fetch($listStyle . '.tpl');

		return $displayHtml;
	}
	
	function displayListPost() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$topicId = '';
		$style = '';
		$strMax = '';
		$strFlagHeader = '';
		$stylePost = '';

		$page = 1;
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'TOPIC' :
						$topicId = trim($atemp[1]);
						break;
					case 'STYLE' :
						$style = trim($atemp[1]);
						break;
					case 'MAX' :
						$strMax = trim($atemp[1]);
						break;
					case 'HEADER' :
						$strFlagHeader = trim($atemp[1]);
						break;
					case 'STYLE-POST' :
						$stylePost = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$topicId = trim($argFunc[$temp]);
						break;
					case 2 :
						$style = trim($argFunc[$temp]);
						break;
					case 3 :
						$strMax = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		$max = 0;
		if (!empty($strMax)) {
			$max = (int)$strMax;
		}
		$flagHeader = false;
		if (!empty($strFlagHeader)) {
			if (strtoupper(trim($strFlagHeader)) == 'TRUE') {
				$flagHeader = true;
			}
		}
		
		if (empty($style)) {
			$listStyle = 'listpost';
		}
		else {
			$style = strtolower($style);
			$listStyle = 'listpost_' . $style;
		}

		$connect = new object_connect();
		$postLinkList = $connect->constructHref($ws->paramGet('APP_CODE'), "listpost", "module:" . $ws->paramGet('WFORUM_NAME'), "p:" . $page, 'topic:' . $topicId, 'style:' . $listStyle, 'max:' . $max, 'header:' . $flagHeader, 'style-post:' . $stylePost);
		$displayHtml = $this->fetchListPost($topicId, $listStyle, $max, $flagHeader, $stylePost);
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('forum_linkList',$postLinkList);
		$smarty->assign('displayHtml',$displayHtml);
		$displayHtml = $smarty->fetch('listdisplay.tpl');

		return $displayHtml;
	}

	function fetchPost() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$argSup = array();
		$postId = "";
		$topicId = "";
		$postStyle = '';
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case "ID" :
						$postId = trim($atemp[1]);
						break;
					case 'TOPIC' :
						$topicId = trim($atemp[1]);
						break;
					case "STYLE" :
						$postStyle = trim($atemp[1]);
						break;
					default:
						$argSup[trim($atemp[0])] = trim($atemp[1]);
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$postId = trim($argFunc[$temp]);
						break;
					case 2 :
						$topicId = trim($argFunc[$temp]);
						break;
					case 3 :
						$postStyle = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 

		$dateRead = date('Y-m-d H:i:s');
		$objForumTopicHistory = new object_forum_topic_history();
		$fct_return = $objForumTopicHistory->findDate($ws->connected_id(), $topicId);
		if ($fct_return->statusGet()) {
			$dateRead = $fct_return->returnGet();
		}
		
		$post = array();
		$displayHtml = '';
		$objForumPost = new object_forum_post();
		$fct_return = $objForumPost->display($postId);
		if ($fct_return->statusGet()) {
			$post = $fct_return->returnGet();
		}

		$postDate = $this->initContent($post,'date_creation');
		$postAuthor = $this->initContent($post,'author');
		$postStatusId = $this->initContent($post,'status_id');
		$postContent = $this->initContent($post,'content');

		$btEdit = false;
		$btDelete = false;
		$btCreate = false;
		if (($ws->paramGet('FORUM_RIGHT_UPDATE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$btEdit = true;
		}
		if (($ws->paramGet('FORUM_RIGHT_DELETE') == 1) or  ($ws->connected_id() == $ws->paramGet('USER_SUPERADMIN'))) {
			$btDelete = true;
		}
		if ($ws->connected() and ($ws->connected_id() != $ws->paramGet('USER_GUEST'))) {
			$btCreate = true;
		}

		$displayHtml = '';
		$fileTop = 'posttop.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileTop;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileTop;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$postTop = $displayHtml;
		
		$displayHtml = '';
		$fileAdd = 'postadd.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileAdd;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileAdd;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$postAdd = $displayHtml;
		
		$displayHtml = '';
		$fileBottom = 'postbottom.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileBottom;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WFORUM_NAME') . '/' . $fileBottom;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$postBottom = $displayHtml;

		// Read flag
		$postRead = false;
		if ($postDate < $dateRead) {
			$postRead = true;
		}
		
		// Status
		$postStatus = $ws->getConfigVars("Lbl_status_0");
		if ($postStatusId == 1) {
			$postStatus = $ws->getConfigVars("Lbl_status_1");
		}

		// Creation date
		$postDateDay = dateFormat('EEEE dd MMMM YYYY', strtotime($postDate));
		$postDateDayTime = dateFormat('EEEE dd MMMM YYYY HH:mm', strtotime($postDate));
		$postDay = dateFormat('dd', strtotime($postDate));
		$postMonth = dateFormat('MMM', strtotime($postDate));
		$postDateTime = dateFormat('dd MMMM YYYY HH:mm', strtotime($postDate));
		$postDate = dateFormat('dd MMMM YYYY', strtotime($postDate));

		$postContext = '<p><strong>@' . $postAuthor . '</strong></p>';
		$postContext .= '<blockquote>';
		$postContext .= mb_substr(LIB_content::cleanHTML($postContent), 0, 240, 'UTF-8');
		$postContext .= '</blockquote>';
		$postContext .= '<p> </p>';
		
		$connect = new object_connect();
		$postLink = $connect->constructHref($ws->paramGet('APP_CODE'), "post", "module:" . $ws->paramGet('WFORUM_NAME'), 'id:' . $postId, 'topic:' . $topicId);
		$postLinkCreate = $connect->constructHref($ws->paramGet('APP_CODE'), "admpost", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:new', 'topic:' . $topicId, 'context:' . $postContext);
		$postLinkEdit = $connect->constructHref($ws->paramGet('APP_CODE'), "admpost", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:edit', 'id:' .  $postId);
		$postLinkDelete = $connect->constructHref($ws->paramGet('APP_CODE'), "admpost", "module:" . $ws->paramGet('WFORUM_NAME'), 'command:delete', 'id:' .  $postId);
		if (empty($postStyle)) {
			$postStyle = 'post';
		}

		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('post_author',$postAuthor);
		$smarty->assign('post_dateDay',$postDateDay);
		$smarty->assign('post_dateDayTime',$postDateDayTime);
		$smarty->assign('post_day',$postDay);
		$smarty->assign('post_month',$postMonth);
		$smarty->assign('post_dateTime',$postDateTime);
		$smarty->assign('post_date',$postDate);
		$smarty->assign('post_read',$postRead);
		$smarty->assign('post_statusId',$postStatusId);
		$smarty->assign('post_status',$postStatus);
		$smarty->assign('post_top',$postTop);
		$smarty->assign('post_add',$postAdd);
		$smarty->assign('post_bottom',$postBottom);
		$smarty->assign('post_content',$postContent);
		foreach($argSup as $key => $value) {
			$smarty->assign('post_' . $key, $value);
		}
		$smarty->assign('post_link',$postLink);
		$smarty->assign('post_linkEdit',$postLinkEdit);
		$smarty->assign('post_linkDelete',$postLinkDelete);
		$smarty->assign('post_linkCreate',$postLinkCreate);
		$smarty->assign('btEdit',$btEdit);
		$smarty->assign('btDelete',$btDelete);
		$smarty->assign('btCreate',$btCreate);
		$displayHtml = $smarty->fetch($postStyle . '.tpl');

		return $displayHtml;
	}
	
	function displayBreadCrumb() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$homeTitle = '';
		$homeLink = '';
		$subjectTitle = '';
		$subjectLink = '';
		$topicTitle = '';
		$topicLink = '';
		$level = 'home';
		$id = '';
		$style = '';

		$page = 1;
		$noident = 1;
		$argFunc = func_get_args();
		for($temp=0; $temp < count($argFunc); $temp++) {
			$atemp = explode(':', $argFunc[$temp]);
			if (count($atemp) > 1) {
				switch (strtoupper(trim($atemp[0]))) {
					case 'TITLE' :
						$homeTitle = trim($atemp[1]);
						break;
					case 'LINK' :
						$homeLink = trim($atemp[1]);
						break;
					case 'LEVEL' :
						$level = trim($atemp[1]);
						break;
					case 'ID' :
						$id = trim($atemp[1]);
						break;
					case 'STYLE' :
						$style = trim($atemp[1]);
						break;
				}
			}
			else {
				switch ($noident) {
					case 1 :
						$homeTitle = trim($argFunc[$temp]);
						break;
					case 2 :
						$homeLink = trim($argFunc[$temp]);
						break;
					case 3 :
						$level = trim($argFunc[$temp]);
						break;
					case 4 :
						$id = trim($argFunc[$temp]);
						break;
					case 5 :
						$style = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}

		if (empty($style)) {
			$style = 'breadcrumb';
		}
		else {
			$style = strtolower($style);
			$style = 'breadcrumb' . $style;
		}

		$topic = array();
		$subject = array();
		if ($level == 'topic') {
			$connect = new object_connect();
			$topicLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' . $id, 'type:topic');
			$objForumTopic = new object_forum_topic();
			$fct_return = $objForumTopic->display($id);
			if ($fct_return->statusGet()) {
				$topic = $fct_return->returnGet();
			}
			$topicTitle = $this->initContent($topic,'label');
			$subjectId = $this->initContent($topic,'subject_id');
			$subjectLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' . $subjectId, 'type:subject');
			$subjectTitle = $this->initContent($topic,'subject_name');
		}
		if ($level == 'subject') {
			$connect = new object_connect();
			$subjectLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' . $id, 'type:subject');
			$objForumSubject = new object_forum_subject();
			$fct_return = $objForumSubject->display($id);
			if ($fct_return->statusGet()) {
				$subject = $fct_return->returnGet();
			}
			$subjectTitle = $this->initContent($subject,'name');
		}
		
		$smarty = new workpage();
		$this->initSmarty($smarty);

		$smarty->assign('homeTitle', $homeTitle);
		$smarty->assign('homeLink', $homeLink);
		$smarty->assign('subjectTitle', $subjectTitle);
		$smarty->assign('subjectLink', $subjectLink);
		$smarty->assign('topicTitle', $topicTitle);
		$smarty->assign('topicLink', $topicLink);
		$displayHtml = $smarty->fetch($style . '.tpl');
		
		return $displayHtml;
	}
}

?>
