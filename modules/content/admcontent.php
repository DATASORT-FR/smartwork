<?php
/**
* Content administration
*
* @package    content_module
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$imagesPath = $ws->paramGet('APP_IMAGES_PATH');

// Main
$contentId = $ws->paramGet('ID');
if ($contentId != '') {
	$ws->sessionSet('object_content_id', $contentId);
}
else {
	$contentId = $ws->sessionGet('object_content_id');
}

$code = $ws->argGet('code');
if (!empty($code)) {
	$ws->sessionSet('object_content_code', $code);
}
else {
	$code = $ws->sessionGet('object_content_code');
}
$code = strtolower($code);

$content_page = $ws->argGet('content_page');
if (!empty($content_page)) {
	$ws->sessionSet('object_content_page', $content_page);
}
else {
	$content_page = $ws->sessionGet('object_content_page');
}
$content_page = strtolower($content_page);

$command = $ws->argGet('command');

$category = new object_content_category(); /* Open content category class */
$category_select = $category->displaySelect();

$author = new object_content_author(); /* Open content category class */
$author_select = $author->displaySelect();

if (!function_exists('dateInit')) {
	function dateInit() {
		$value = '';
		$value = date('d/m/Y');
		return $value;
	}
}

if (!function_exists('aliasInit')) {
	function aliasInit($title) {
		$title = mb_substr($title, 0, 60);
		if ((strlen($title) > 58)and (preg_match("# #iusU", $title))) {
			$title = mb_substr($title, 0, mb_strrpos($title, ' '));
		}
		$title = preg_replace("#[\#]+#iusU", '',$title);
		$title = preg_replace("#[-.,\?\:\\\/\s']+#iusU", '-',$title);
		$title = preg_replace("#-+#ius", '-',$title);
		$title = LIB_content::cleanSpecial($title);
	
		return $title;
	}
}

if (!function_exists('titlePageInit')) {
	function titlePageInit($title) {	
		return $title;
	}
}

if (!empty($code)) {
	$flagBlock = false;
	$flagImage = false;
	$labelBlock1 = $ws->getConfigVars("Lbl_admcontent_block1_".$code);
	$labelBlock2 = $ws->getConfigVars("Lbl_admcontent_block2_".$code);
	$labelBlock3 = $ws->getConfigVars("Lbl_admcontent_block3_".$code);
	$labelBlock4 = $ws->getConfigVars("Lbl_admcontent_block4_".$code);
	$labelBlock5 = $ws->getConfigVars("Lbl_admcontent_block5_".$code);
	$labelBlock6 = $ws->getConfigVars("Lbl_admcontent_block6_".$code);
	if (!empty($labelBlock1)) {
		$flagBlock = true;
	}
	if (!empty($labelBlock2)) {
		$flagBlock = true;
	}
	if (!empty($labelBlock3)) {
		$flagBlock = true;
	}
	if (!empty($labelBlock4)) {
		$flagBlock = true;
	}
	if (!empty($labelBlock5)) {
		$flagBlock = true;
	}
	if (!empty($labelBlock6)) {
		$flagBlock = true;
	}

	$labelImage1 = $ws->getConfigVars("Lbl_admcontent_image1_".$code);
	$labelImage2 = $ws->getConfigVars("Lbl_admcontent_image2_".$code);
	$labelImage3 = $ws->getConfigVars("Lbl_admcontent_image3_".$code);
	$labelImage4 = $ws->getConfigVars("Lbl_admcontent_image4_".$code);
	$labelImage5 = $ws->getConfigVars("Lbl_admcontent_image5_".$code);
	$labelImage6 = $ws->getConfigVars("Lbl_admcontent_image6_".$code);
	if (!empty($labelImage1)) {
		$flagImage = true;
	}
	if (!empty($labelImage2)) {
		$flagImage = true;
	}
	if (!empty($labelImage3)) {
		$flagImage = true;
	}
	if (!empty($labelImage4)) {
		$flagImage = true;
	}
	if (!empty($labelImage5)) {
		$flagImage = true;
	}
	if (!empty($labelImage6)) {
		$flagImage = true;
	}
}
else {
	$flagBlock = true;
	$flagImage = true;
	$labelBlock1 = $ws->getConfigVars("Lbl_admcontent_block1");
	$labelBlock2 = $ws->getConfigVars("Lbl_admcontent_block2");
	$labelBlock3 = $ws->getConfigVars("Lbl_admcontent_block3");
	$labelBlock4 = $ws->getConfigVars("Lbl_admcontent_block4");
	$labelBlock5 = $ws->getConfigVars("Lbl_admcontent_block5");
	$labelBlock6 = $ws->getConfigVars("Lbl_admcontent_block6");
	
	$labelImage1 = $ws->getConfigVars("Lbl_admcontent_image1");
	$labelImage2 = $ws->getConfigVars("Lbl_admcontent_image2");
	$labelImage3 = $ws->getConfigVars("Lbl_admcontent_image3");
	$labelImage4 = $ws->getConfigVars("Lbl_admcontent_image4");
	$labelImage5 = $ws->getConfigVars("Lbl_admcontent_image5");
	$labelImage6 = $ws->getConfigVars("Lbl_admcontent_image6");
}

$wcrud = new wcrud('object_content', $ws->extractPage(__FILE__));
$wcrud->titleSet(false); /* use Title */
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */
$wcrud->writeSet(true); /* Forcer le crud en mode update */

$wcrud->fieldSet('title');
$wcrud->sizeSet('title',220);
$wcrud->fieldColSizeSet('title',12);
$wcrud->fieldSet('date_publication', 'date');
$wcrud->formatSet('date_publication', 'd/m/Y');
$wcrud->fieldLineSet('status_id', 'choice');
if (empty($code)) {	
	$wcrud->fieldSet('code', 'text');
	$wcrud->fieldLineSet('category_id', 'list', $category_select->returnGet());
}
else {
	$wcrud->fieldSet('category_id', 'list', $category_select->returnGet());
}

$wcrud->fieldSet('maintab', 'tab');

	$wcrud->fieldSet('tab1', 'tabcontent','maintab');
		$wcrud->fieldSet('image', 'image', $imagesPath);
		$wcrud->fieldSet('intro', 'textarea');
		$wcrud->rowsSet('intro', 6);
		$wcrud->colsSet('intro',100);
	$wcrud->fieldSet('tab1_end', 'tabcontentend');

	$wcrud->fieldSet('tab2', 'tabcontent','maintab');
		$wcrud->fieldSet('content', 'editor');
		$wcrud->rowsSet('content', 15);
	$wcrud->fieldSet('tab2_end', 'tabcontentend');

	$wcrud->fieldSet('tab3', 'tabcontent','maintab');
		$wcrud->fieldSet('author_id', 'list', $author_select->returnGet());
		$wcrud->fieldSet('author_id', 'number');
		$wcrud->fieldSet('alias', 'text');
		$wcrud->sizeSet('alias',60);
		$wcrud->fieldSet('description', 'textarea');
		$wcrud->rowsSet('description', 3);
		$wcrud->colsSet('description',100);
		$wcrud->fieldSet('keywords', 'textarea');
		$wcrud->rowsSet('keywords', 3);
		$wcrud->colsSet('keywords',50);
	$wcrud->fieldSet('tab3_end', 'tabcontentend');

	$wcrud->fieldSet('tab4', 'tabcontent','maintab');
		$wcrud->fieldSet('title_page');
		$wcrud->sizeSet('title_page',80);
		$wcrud->fieldSet('param1');
		$wcrud->sizeSet('param1',80);
		$wcrud->fieldSet('param2');
		$wcrud->sizeSet('param2',80);
		$wcrud->fieldSet('alt', 'text');
		$wcrud->sizeSet('alt',80);
		if (empty($code)) {
			$wcrud->fieldSet('style', 'text');
			$wcrud->sizeSet('style',10);
		}
		$wcrud->fieldSet('class', 'text');
		$wcrud->sizeSet('class',10);
		$wcrud->fieldSet('icon', 'text');
		$wcrud->sizeSet('icon',10);
		if (empty($code)) {
			$wcrud->fieldSet('path', 'text');
			$wcrud->sizeSet('path',20);
		}
		if (empty($content_page)) {
			$wcrud->fieldSet('content_page', 'text');
			$wcrud->sizeSet('content_page',40);
		}
	$wcrud->fieldSet('tab4_end', 'tabcontentend');
	
	if ($flagBlock) {
		$wcrud->fieldSet('tab5', 'tabcontent','maintab');
			if (!empty($labelBlock1)) {
				$wcrud->fieldSet('block1', 'textarea');
				$wcrud->rowsSet('block1', 6);
				$wcrud->colsSet('block1',100);
				$wcrud->labelSet('block1', $labelBlock1);
			}
			if (!empty($labelBlock2)) {
				$wcrud->fieldLineSet('block2', 'textarea');
				$wcrud->rowsSet('block2', 6);
				$wcrud->colsSet('block2',100);
				$wcrud->labelSet('block2', $labelBlock2);
			}

			if (!empty($labelBlock3)) {
				$wcrud->fieldSet('block3', 'textarea');
				$wcrud->rowsSet('block3', 6);
				$wcrud->colsSet('block3',100);
				$wcrud->labelSet('block3', $labelBlock3);
			}
			if (!empty($labelBlock4)) {
				$wcrud->fieldLineSet('block4', 'textarea');
				$wcrud->rowsSet('block4', 6);
				$wcrud->colsSet('block4',100);
				$wcrud->labelSet('block4', $labelBlock4);
			}

			if (!empty($labelBlock5)) {
				$wcrud->fieldSet('block5', 'textarea');
				$wcrud->rowsSet('block5', 6);
				$wcrud->colsSet('block5',100);
				$wcrud->labelSet('block5', $labelBlock5);
			}
			if (!empty($labelBlock6)) {
				$wcrud->fieldLineSet('block6', 'textarea');
				$wcrud->rowsSet('block6', 6);
				$wcrud->colsSet('block6',100);
				$wcrud->labelSet('block6', $labelBlock6);
			}
		$wcrud->fieldSet('tab5_end', 'tabcontentend');
	}
	if ($flagImage) {
		$wcrud->fieldSet('tab6', 'tabcontent','maintab');
			if (!empty($labelImage1)) {
				$wcrud->fieldSet('image1', 'image', $imagesPath);
				$wcrud->labelSet('image1', $labelImage1);
			}
			if (!empty($labelImage2)) {
				$wcrud->fieldSet('image2', 'image', $imagesPath);
				$wcrud->labelSet('image2', $labelImage2);
			}
			if (!empty($labelImage3)) {
				$wcrud->fieldSet('image3', 'image', $imagesPath);
				$wcrud->labelSet('image3', $labelImage3);
			}
			if (!empty($labelImage4)) {
				$wcrud->fieldSet('image4', 'image', $imagesPath);
				$wcrud->labelSet('image4', $labelImage4);
			}
			if (!empty($labelImage5)) {
				$wcrud->fieldSet('image5', 'image', $imagesPath);
				$wcrud->labelSet('image5', $labelImage5);
			}
			if (!empty($labelImage6)) {
				$wcrud->fieldSet('image6', 'image', $imagesPath);
				$wcrud->labelSet('image6', $labelImage6);
			}
		$wcrud->fieldSet('tab6_end', 'tabcontentend');
	}
	
$wcrud->fieldSet('maintab_end', 'tabend','maintab');

$wcrud->initValueSet('date_publication', 'dateInit', 'function');
$wcrud->initValueSet('alias', 'aliasInit', 'transform', 'title');
$wcrud->initValueSet('title_page', 'titlePageInit', 'transform', 'title');
$wcrud->initValueSet('keywords', $ws->keywordsGet());

if ($command == 'create') {	
	$wcrud->filterSet('application_id', $ws->paramGet('APP_ID_CONTENT'));
}
if ((!empty($code)) and ($command == 'create')) {	
	$wcrud->filterSet('code',strtoupper($code));
	$wcrud->filterSet('style',$code);
	$wcrud->filterSet('path',$code . '/');
}
if ((!empty($content_page)) and ($command == 'create')) {	
	$wcrud->filterSet('content_page',$content_page);
}

$wcrud->displayCrud();
?>
