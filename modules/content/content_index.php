<?php
/**
* Content class
*
* @package    content_module
* @version    2.0
* @date       17 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('WCONTENT_NAME', 'content');

// Page Path
$ws->paramSet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/' . TEMPLATES_SRC_PATH);
$ws->paramSet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/templates/css/');
$ws->paramSet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATES_JS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/templates/js/');

// Template css & js
$ws->paramSet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATE_STYLE', $ws->paramGet('WCONTENT_NAME') . '.css');
$ws->paramSet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATE_JS', $ws->paramGet('WCONTENT_NAME') . '.js');

$ws->addcss($ws->paramGet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATE_STYLE'));
//$ws->addjs($ws->paramGet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATES_JS_DIR') . $ws->paramGet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATE_JS'));

if (!$ws->ctrlParam('CONTENT_RIGHT_CREATE')) {
	$ws->paramSet('CONTENT_RIGHT_CREATE', 0);
}
if (!$ws->ctrlParam('CONTENT_RIGHT_READ')) {
	$ws->paramSet('CONTENT_RIGHT_READ', 1);
}
if (!$ws->ctrlParam('CONTENT_RIGHT_UPDATE')) {
	$ws->paramSet('CONTENT_RIGHT_UPDATE', 0);
}
if (!$ws->ctrlParam('CONTENT_RIGHT_DELETE')) {
	$ws->paramSet('CONTENT_RIGHT_DELETE', 0);
}
if (!$ws->ctrlParam('CONTENT_RIGHT_EVENT')) {
	$ws->paramSet('CONTENT_RIGHT_EVENT', 0);
}

/**
* Classes for content module.
*/
class Wcontent
{

	private $_contentArray = array();
	
	private function initContent($content, $index) {
		$return = '';
		
		if (isset($content[$index])) {
			$return = $content[$index];
		}
		else {
			if (($index == 'intro') or ($index == 'description')) {
				$return = 'Error Content';
			}
		}
		return $return;
	}
	
	function initSmarty($smarty) {
		$ws = workspace::ws_open();
		
		// template directories load
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('WCONTENT_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('WCONTENT_NAME') . '_TEMPLATES_SRC_DIR'));	
	}

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

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
	
	function fetch($content, $argSup = array()) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_contentArray = $content;
		$contentId = $this->initContent($content,'id');
		$code = $this->initContent($content,'code');
		$contentTitle = $this->initContent($content,'title');
		$contentTitlePage = $this->initContent($content,'title_page');
		if (empty($contentTitlePage)) {
			$contentTitlePage = $contentTitle;
		}
		$contentImage = $this->initContent($content,'image');
		$contentIntro = $this->initContent($content,'intro');
		$contentBlock1 = $this->initContent($content,'block1');
		$contentBlock2 = $this->initContent($content,'block2');
		$contentBlock3 = $this->initContent($content,'block3');
		$contentBlock4 = $this->initContent($content,'block4');
		$contentBlock5 = $this->initContent($content,'block5');
		$contentBlock6 = $this->initContent($content,'block6');
		$contentImage1 = $this->initContent($content,'image1');
		$contentImage2 = $this->initContent($content,'image2');
		$contentImage3 = $this->initContent($content,'image3');
		$contentImage4 = $this->initContent($content,'image4');
		$contentImage5 = $this->initContent($content,'image5');
		$contentImage6 = $this->initContent($content,'image6');
		$contentContent = $this->initContent($content,'content');
		$contentStatus = $this->initContent($content,'status');
		$contentCategory = $this->initContent($content,'category');
		$contentCategoryId = $this->initContent($content,'category_id');
		$contentAuthor = $this->initContent($content,'author');
		$contentDate = $this->initContent($content,'date_publication');
		$contentDescription = $this->initContent($content,'description');
		$contentKeywords = $this->initContent($content,'keywords');
		$classAdd = $this->initContent($content,'class');
		$icon = $this->initContent($content,'icon');
		$style = $this->initContent($content,'style');
		if (empty($style)) {
			$style = 'default';
		}
		$currentStyle = $this->initContent($content,'current_style');
		if (empty($currentStyle)) {
			$currentStyle = $style;
		}
		$currentStyle = strtolower($currentStyle);
		$pos = strpos($currentStyle, 'intro');
		$flagIntro = false;
		if (($pos !== false) and ($pos == 0)) {
			$flagIntro = true;
		}
		$connect = new object_connect();
		preg_match_all('#\[href:(.*)\]#isU', $contentIntro, $matches);
		if (isset($matches[1])) {
			foreach($matches[1] as $key => $match) {
				$hrefArray= array();
				$hrefArray = explode(',', $match);
				if (empty($hrefArray[0])) {
					$hrefArray[0] = $ws->paramGet('APP_CODE');
				}
				$href = call_user_func_array(array($connect, 'constructHref'), $hrefArray);
				$contentIntro = preg_replace('#\[href:' . $match . '\]#isU', $href, $contentIntro);
			}
		}

		preg_match_all('#\[href:(.*)\]#isU', $contentContent, $matches);
		if (isset($matches[1])) {
			foreach($matches[1] as $key => $match) {
				$hrefArray= array();
				$hrefArray = explode(',', $match);
				if (empty($hrefArray[0])) {
					$hrefArray[0] = $ws->paramGet('APP_CODE');
				}
				$href = call_user_func_array(array($connect, 'constructHref'), $hrefArray);
				$contentContent = preg_replace('#\[href:' . $match . '\]#isU', $href, $contentContent);
			}
		}

		$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'id:' .  $contentId);
		$contentLinkEdit = $connect->constructHref($ws->paramGet('APP_CODE'), "admcontent", "module:" . $ws->paramGet('WCONTENT_NAME'), 'command:edit', 'id:' .  $contentId, 'code:' .  $code);
		$contentLinkDelete = $connect->constructHref($ws->paramGet('APP_CODE'), "admcontent", "module:" . $ws->paramGet('WCONTENT_NAME'), 'command:delete', 'id:' .  $contentId);
		
		$btEdit = false;
		$btDelete = false;
		if ($ws->paramGet('CONTENT_RIGHT_UPDATE') == 1) {
			$btEdit = true;
		}
		if ($ws->paramGet('CONTENT_RIGHT_DELETE') == 1) {
			if ($contentCategoryId != 0) {
				$btDelete = true;
			}
		}
		
		// Image
		$atemp = explode(';',$contentImage);
		$contentImage = '';
		$contentImageAlt = '';
		$contentImageTitle = '';
		if (isset($atemp[0])) {
			$contentImage = $atemp[0];
		}
		if (isset($atemp[1])) {
			$contentImageAlt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$contentImageTitle = $atemp[2];
		}
		if (!file_exists($contentImage)) {
			$contentImage = '';
		}
		
		// Image1
		$atemp = explode(';',$contentImage1);
		$contentImage1 = '';
		$contentImage1Alt = '';
		$contentImage1Title = '';
		if (isset($atemp[0])) {
			$contentImage1 = $atemp[0];
		}
		if (isset($atemp[1])) {
			$contentImage1Alt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$contentImage1Title = $atemp[2];
		}
		if (!file_exists($contentImage1)) {
			$contentImage1 = '';
		}
		
		// Image2
		$atemp = explode(';',$contentImage2);
		$contentImage2 = '';
		$contentImage2Alt = '';
		$contentImage2Title = '';
		if (isset($atemp[0])) {
			$contentImage2 = $atemp[0];
		}
		if (isset($atemp[1])) {
			$contentImage2Alt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$contentImage2Title = $atemp[2];
		}
		if (!file_exists($contentImage2)) {
			$contentImage2 = '';
		}
		
		// Image3
		$atemp = explode(';',$contentImage3);
		$contentImage3 = '';
		$contentImage3Alt = '';
		$contentImage3Title = '';
		if (isset($atemp[0])) {
			$contentImage3 = $atemp[0];
		}
		if (isset($atemp[1])) {
			$contentImage3Alt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$contentImage3Title = $atemp[2];
		}
		if (!file_exists($contentImage3)) {
			$contentImage3 = '';
		}
		
		// Image4
		$atemp = explode(';',$contentImage4);
		$contentImage4 = '';
		$contentImage4Alt = '';
		$contentImage4Title = '';
		if (isset($atemp[0])) {
			$contentImage4 = $atemp[0];
		}
		if (isset($atemp[1])) {
			$contentImage4Alt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$contentImage4Title = $atemp[2];
		}
		if (!file_exists($contentImage4)) {
			$contentImage4 = '';
		}
		
		// Image5
		$atemp = explode(';',$contentImage5);
		$contentImage5 = '';
		$contentImage5Alt = '';
		$contentImage5Title = '';
		if (isset($atemp[0])) {
			$contentImage5 = $atemp[0];
		}
		if (isset($atemp[1])) {
			$contentImage5Alt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$contentImage5Title = $atemp[2];
		}
		if (!file_exists($contentImage5)) {
			$contentImage5 = '';
		}
		
		// Image6
		$atemp = explode(';',$contentImage6);
		$contentImage6 = '';
		$contentImage6Alt = '';
		$contentImage6Title = '';
		if (isset($atemp[0])) {
			$contentImage6 = $atemp[0];
		}
		if (isset($atemp[1])) {
			$contentImage6Alt = $atemp[1];
		}
		if (isset($atemp[2])) {
			$contentImage6Title = $atemp[2];
		}
		if (!file_exists($contentImage6)) {
			$contentImage6 = '';
		}
		
//		$contentDayPublication = dateFormat('%A %d %B %Y', strtotime($contentDate));
		$contentDayPublication = dateFormat('EEEE dd MMMM YYYY', strtotime($contentDate));
		$contentDatePublication = dateFormat('dd MMMM YYYY', strtotime($contentDate));
		$contentDay = dateFormat('dd', strtotime($contentDate));
		$contentMonth = dateFormat('MMM', strtotime($contentDate));
		
		$displayHtml = '';
		$fileTop = 'contenttop.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/' . $fileTop;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/' . $fileTop;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$contentTop = $displayHtml;
		
		$displayHtml = '';
		$fileAdd = 'contentadd.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/' . $fileAdd;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/' . $fileAdd;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$contentAdd = $displayHtml;
		
		$displayHtml = '';
		$fileBottom = 'contentbottom.php';
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/' . $fileBottom;
		if (file_exists($filePath)) {
			include $filePath;
		}
		else {
			$filePath = $ws->paramGet('MODULES_DIR') . $ws->paramGet('WCONTENT_NAME') . '/' . $fileBottom;
			if (file_exists($filePath)) {
				include $filePath;
			}
			else {
			}
		}
		$contentBottom = $displayHtml;
		
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('Content_class',$classAdd);
		$smarty->assign('Content_icon',$icon);
		$smarty->assign('Content_code',$code);
		$smarty->assign('Content_title',$contentTitle);
		$smarty->assign('Content_titlePage',$contentTitlePage);
		$smarty->assign('Content_image',$contentImage);
		$smarty->assign('Content_imageAlt',$contentImageAlt);
		$smarty->assign('Content_imageTitle',$contentImageTitle);
		$smarty->assign('Content_image1',$contentImage1);
		$smarty->assign('Content_image1Alt',$contentImage1Alt);
		$smarty->assign('Content_image1Title',$contentImage1Title);
		$smarty->assign('Content_image2',$contentImage2);
		$smarty->assign('Content_image2Alt',$contentImage2Alt);
		$smarty->assign('Content_image2Title',$contentImage2Title);
		$smarty->assign('Content_image3',$contentImage3);
		$smarty->assign('Content_image3Alt',$contentImage3Alt);
		$smarty->assign('Content_image3Title',$contentImage3Title);
		$smarty->assign('Content_image4',$contentImage4);
		$smarty->assign('Content_image4Alt',$contentImage4Alt);
		$smarty->assign('Content_image4Title',$contentImage4Title);
		$smarty->assign('Content_image5',$contentImage5);
		$smarty->assign('Content_image5Alt',$contentImage5Alt);
		$smarty->assign('Content_image5Title',$contentImage5Title);
		$smarty->assign('Content_image6',$contentImage6);
		$smarty->assign('Content_image6Alt',$contentImage6Alt);
		$smarty->assign('Content_image6Title',$contentImage6Title);
		$smarty->assign('Content_intro',$contentIntro);
		$smarty->assign('Content_block1',$contentBlock1);
		$smarty->assign('Content_block2',$contentBlock2);
		$smarty->assign('Content_block3',$contentBlock3);
		$smarty->assign('Content_block4',$contentBlock4);
		$smarty->assign('Content_block5',$contentBlock5);
		$smarty->assign('Content_block6',$contentBlock6);
		$smarty->assign('Content_top',$contentTop);
		$smarty->assign('Content_add',$contentAdd);
		$smarty->assign('Content_bottom',$contentBottom);
		$smarty->assign('Content_content',$contentContent);
		$smarty->assign('Content_status',$contentStatus);
		$smarty->assign('Content_category',$contentCategory);
		$smarty->assign('Content_author',$contentAuthor);
		if ($ws->paramGet('CONTENT_RIGHT_UPDATE') == 1) {
			$smarty->assign('Content_status', $contentStatus);
		}
		else {
			$smarty->assign('Content_status', '');
		}
		$smarty->assign('Content_datepublication',$contentDatePublication);		
		$smarty->assign('Content_daypublication',$contentDayPublication);
		$smarty->assign('Content_day',$contentDay);
		$smarty->assign('Content_month',$contentMonth);
		$smarty->assign('Content_link',$contentLink);
		$smarty->assign('Content_linkEdit',$contentLinkEdit);
		$smarty->assign('Content_linkDelete',$contentLinkDelete);
		foreach($argSup as $key => $value) {
			$smarty->assign('Content_' . $key, $value);
		}
		$smarty->assign('btEdit',$btEdit);
		$smarty->assign('btDelete',$btDelete);
		
		$displayHtml = $smarty->fetch($currentStyle . '.tpl');
		if (!$flagIntro) {
			$ws->pageTitleSet($contentTitlePage);
			$ws->pageDescriptionSet($contentDescription);
			$ws->pageKeywordsSet($contentKeywords);
			$pageImage= preg_replace('#^\./#Usi', $ws->baseUrlGet() , $contentImage);
			$ws->pageImageSet($pageImage);
		}
		return $displayHtml;
	}

	function displayGet($key) {
		$return = '';

		if (isset($this->_contentArray[$key])) {
			$return = $this->_contentArray[$key];
		}		
		return $return;
	}
	
	function display() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$argSup = array();
		$code = "";
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
						$code = trim($argFunc[$temp]);
						break;
					case 2 :
						$style = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		} 
				
		$content = array();
		$displayHtml = '';
		$contentId = 0;
		$code = strtoupper($code);
		$objContent = new object_content();
		$fct_return = $objContent->find($ws->paramGet('APP_CODE_CONTENT'), $code);
		if ($fct_return->statusGet()) {
			$content = $fct_return->returnGet();
			$contentId = $content['id'];
			if (empty($style)) {
				$content['current_style'] = $content['style'];
			}
			else {
				$content['current_style'] = $style;				
			}
			$displayHtml = $this->fetch($content, $argSup);
		}
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$connect = new object_connect();
		$contentLink = $connect->constructHref($ws->paramGet('APP_CODE'), 'page:content', 'module:content', 'id:' .  $contentId);
		$smarty->assign('Content_link',$contentLink);
		$smarty->assign('displayHtml',$displayHtml);
		$displayHtml= $smarty->fetch('display.tpl');
		return $displayHtml;
	}

	function fetchList($list) {
		$ws = workspace::ws_open();

		$page = 1;
		$code = '';
		$category = '';
		$style = '';
		$introStyle = '';
		$content_page = '';
		$max = 0;
		$random = false;
		$contentArray = array();

		if (isset($list['page'])) {
			$page = $list['page'];
		}
		if (isset($list['code'])) {
			$code = $list['code'];
		}
		if (isset($list['content_page'])) {
			$content_page = $list['content_page'];
		}
		if (isset($list['category'])) {
			$category = $list['category'];
		}
		if (isset($list['style'])) {
			$style = $list['style'];
		}
		if (isset($list['max'])) {
			$max = $list['max'];
		}
		if (isset($list['random'])) {
			$random = $list['random'];
		}
		if (isset($list['list'])) {
			$contentArray = $list['list'];
		}
		$connect = new object_connect();
		$contentLinkCreate = $connect->constructHref($ws->paramGet('APP_CODE'), "admcontent", "module:" . $ws->paramGet('WCONTENT_NAME'), 'command:new', 'code:' . $code, 'content_page:' . $content_page, 'category:' . $category, 'style:' . $style, 'max:' . $max);
		$btCreate = false;
		if ($ws->paramGet('CONTENT_RIGHT_CREATE') == 1) {
			$btCreate = true;
		}

		if (empty($style)) {
			$style = 'default';
		}
		$style = strtolower($style);
		$introStyle = 'intro_' . $style;
		$listStyle = 'list_' . $style;
		
		if ($random) {
			shuffle($contentArray);
		}
		
		$listIntro = array();
		$nb = 0;
		$dateCurrent = new DateTime(date("Y-m-d"));
		foreach($contentArray as $key=>$content) {
			if (($max == 0) or (($max > 0) and ($nb < $max))) {
				$content['current_style'] = $introStyle;
				$listDisplayflag = false;
				if ($ws->paramGet('CONTENT_RIGHT_UPDATE') == 1) {
					$listDisplayflag = true;
				}
				else {
					$datePublication = new DateTime($content['date_publication']);
					if (($content['status_id'] == 1) and ($datePublication <= $dateCurrent)) {
						$listDisplayflag = true;
					}
				}
				if ($listDisplayflag) {
					$listIntro[] = $this->fetch($content);
					$nb++;
				}
			}
		}

		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('listIntro',$listIntro);
		$smarty->assign('content_linkCreate',$contentLinkCreate);
		$smarty->assign('btCreate',$btCreate);
		$displayHtml = $smarty->fetch($listStyle . '.tpl');

		return $displayHtml;
	}
	
	function displayList() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$code = "";
		$content_page = "";
		$category = "";
		$style = 'default';
		$max = 0;
		$random = false;
		$order='';

		$page = 1;
		$introstyle = '';
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
					case "STYLE" :
						$style = trim($atemp[1]);
						break;
					case "CONTENT_PAGE" :
						$content_page = trim($atemp[1]);
						break;
					case "MAX" :
						$max = trim($atemp[1]);
						break;
					case "RANDOM" :
						if (strtoupper(trim($atemp[1])) == 'TRUE') {
							$random = true;
						}
						break;
					case "ORDER" :
						$order = trim($atemp[1]);
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
						$style = trim($argFunc[$temp]);
						break;
					case 4 :
						$content_page = trim($argFunc[$temp]);
						break;
					case 5 :
						$max = trim($argFunc[$temp]);
						break;
					case 6 :
						$order = trim($argFunc[$temp]);
						break;
				}
				$noident++;
			}
		}
		$contentArray = array();
		$displayHtml = '';
		$code = strtoupper($code);
		$objContent = new object_content();
		$fct_return = $objContent->findList($ws->paramGet('APP_CODE_CONTENT'), $code, $category, $order);
		if ($fct_return->statusGet()) {
			$contentArray = $fct_return->returnGet();
		}
		
		$list = array();
		$list['page'] = $page;
		$list['code'] = $code;
		$list['content_page'] = $content_page;
		$list['category'] = $category;
		$list['style'] = $style;
		$list['max'] = $max;
		$list['random'] = $random;
		$list['list'] = $contentArray;
		$displayHtml = $this->fetchList($list);
		$connect = new object_connect();
		$contentLinkList = $connect->constructHref($ws->paramGet('APP_CODE'), "listcontent", "module:" . $ws->paramGet('WCONTENT_NAME'), "p:" . $page, "code:" . $code, 'content_page:' . $content_page, "category:" . $category, 'style:' . $style, 'max:' . $max);
		
		$smarty = new workpage();
		$this->initSmarty($smarty);
		$smarty->assign('content_linkList',$contentLinkList);
		$smarty->assign('displayHtml',$displayHtml);
		$displayHtml= $smarty->fetch('listdisplay.tpl');
		return $displayHtml;
	}
	
}

?>
