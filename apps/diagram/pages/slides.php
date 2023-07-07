<?php
/**
* @package    use_slide
* @subpackage controller
* @version    1.0
* @date       15 June 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

if (!function_exists('titleInit')) {
	function titleInit($label) {	
		return $label;
	}
}

if ($domainId != '') {
	$slideType = new object_slide_type();
	$slideTypeSelect = $slideType->displaySelect()->returnGet();

	$notice = new object_notice();
	$notice->filterSet('domain_id', $domainId);
	$noticeSelect = $notice->displaySelect('0', '')->returnGet();

	$contentVariables = new object_content_variables();
	$contentVariables->filterSet('domain_id', $domainId);
	$contentVariablesSelect = $contentVariables->displaySelect('0', '', 'order:1')->returnGet();

	$contentResults = new object_content_results();
	$contentResults->filterSet('domain_id', $domainId);
	$contentResultsSelect = $contentResults->displaySelect('0', '', 'order:1')->returnGet();

	$connect = new object_connect();
	$noticeUrl = $connect->constructHref($ws->paramGet('APP_CODE'), 'notices', 'mode:api');
	$contentVariablesUrl = $connect->constructHref($ws->paramGet('APP_CODE'), 'contents_variables', 'mode:api');
	$contentResultsUrl = $connect->constructHref($ws->paramGet('APP_CODE'), 'contents_results', 'mode:api');

	$variable = new object_field_variable();
	$variable->filterSet('domain_id',$domainId);
	$variableList = $variable->displaySelect('order:1')->returnGet();

	$result = new object_field_result();
	$result->filterSet('domain_id',$domainId);
	$resultList = $result->displaySelect('order:1')->returnGet();

	$process = new object_diagram();
	$process->filterSet('domain_id', $domainId);
	$process->filterSet('type_id', 2);
	$processSelect = $process->displaySelect('0', '')->returnGet();

	$link = new object_slide();
	$link->filterSet('domain_id', $domainId);
	$link->filterSet('type_id', 2);
	$linkList = $link->displaySelect('order:0')->returnGet();

	$wcrud = new wcrud('object_slide', $ws->extractPage(__FILE__));
	$wcrud->titleSet(true); /* use Title */
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

	$wlist = $wcrud->listGet();
	$wlist->pageSet(true);
	$wlist->pagesizeSet(10, 20, 50); /* set number of lines for the list */
	$wlist->pagesearchSet(true); /* show search input and button */
	$wlist->pageorderSet(0); /* number of order type */
	$wlist->displaysizeSet('small'); /* set list width */
	$wlist->columnidSet(false); /* show id column */

//	$wlist->sortSet(true); /* show or not the sort of columns. False by default */
	$wlist->viewSet(false); /* show or not the columns selector. False by default */
	$wlist->filterViewSet('reference'); /* display a filter field */
	$wlist->filterViewSet('label'); /* display a filter field */
	$wlist->filterViewSet('type_id', 'list', $slideType->displaySelect('0', '')->returnGet()); /* display a filter field */
	
	$wlist->columnidpctSet(10); /* set percent size for id column */
	$wlist->columnAdd('reference',10); /* show title column */
	$wlist->columnAdd('type',10); /* show title column */
	$wlist->columnAdd('label',55); /* show label column */
	$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */

	$wlist->eventSet('btevent', true);
	$wlist->eventboxSet('btevent', false);
	$wlist->eventiconSet('btevent', 'arrow-up');
	$wlist->eventcommandSet('btevent', 'levelUp');
	
	$wlist->eventSet('bttool', true); /* show tool button */
	$wlist->eventboxSet('bttool', true);
	$wlist->eventiconSet('bttool', 'clone'); /* php event icon */
	$wlist->eventfileSet('bttool', 'slides_copy'); /* php tool file */
	
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wlist->deletecolumnnameSet('title'); /* column used in the delete confirmation window for the title */
	$wcrud->commandSet('levelUp', 'levelUp');
	
	// line 1
	$wcrud->fieldSet('label');
	$wcrud->sizeSet('label',50);
	$wcrud->fieldColSizeSet('label',6);
	$wcrud->fieldLineSet('type_id', 'list', $slideTypeSelect);
	$wcrud->fieldLineSet('reference');
	$wcrud->sizeSet('reference',6);
	$wcrud->fieldColSizeSet('reference',3);
	$wcrud->readonlySet('reference');
	$wcrud->fieldDisplaySet('reference', 'edit');

	$wcrud->fieldSet('maintab', 'tab');
		$wcrud->fieldSet('contentInfo', 'tabcontent','maintab');
			$wcrud->fieldSet('title');
			$wcrud->sizeSet('title',50);
			$wcrud->fieldColSizeSet('title',6);
			$wcrud->fieldSet('image', 'image');
			$wcrud->fieldSet('image_display', 'choice');
			$wcrud->fieldSet('description', 'textarea');
			$wcrud->rowsSet('description', 7);
			$wcrud->colsSet('description',100);
		$wcrud->fieldSet('contentInfo_end', 'tabcontentend');
	
		$wcrud->fieldSet('contentNotice', 'tabcontent','maintab');
			$wcrud->fieldSet('notice_id', 'list', $noticeSelect, $noticeUrl);
			$wcrud->fieldSet('notice_label');
			$wcrud->sizeSet('notice_label',50);
			$wcrud->fieldSet('notice_title');
			$wcrud->sizeSet('notice_title',50);
			$wcrud->fieldSet('notice_image', 'image');
			$wcrud->fieldSet('notice_description', 'editor');
			$wcrud->rowsSet('notice_description', 12);

			$wcrud->fieldLinkSet('notice_label', 'notice_id', 'label');
			$wcrud->fieldLinkSet('notice_title', 'notice_id', 'title');
			$wcrud->fieldLinkSet('notice_image', 'notice_id', 'image');
			$wcrud->fieldLinkSet('notice_description', 'notice_id', 'description');
		$wcrud->fieldSet('contentNotice_end', 'tabcontentend');
		
		$wcrud->fieldSet('contentVariable', 'tabcontent','maintab');
			$wcrud->fieldSet('variable_list', 'listmultiple_order', 'field_id', $variableList);
			$wcrud->fieldLineSet('variable_1_list', 'listmultiple_order', 'field_id', $variableList);
			$wcrud->fieldSet('variable_contentid', 'list', $contentVariablesSelect, $contentVariablesUrl);
			$wcrud->fieldSet('variable_label');
			$wcrud->sizeSet('variable_label',50);
			$wcrud->fieldSet('variable_title');
			$wcrud->sizeSet('variable_title',50);
			$wcrud->fieldSet('variable_image', 'image');
			$wcrud->fieldSet('variable_description', 'textarea');
			$wcrud->rowsSet('variable_description', 7);
			$wcrud->colsSet('variable_description',100);
			
			$wcrud->fieldLinkSet('variable_label', 'variable_contentid', 'label');
			$wcrud->fieldLinkSet('variable_title', 'variable_contentid', 'title');
			$wcrud->fieldLinkSet('variable_image', 'variable_contentid', 'image');
			$wcrud->fieldLinkSet('variable_description', 'variable_contentid', 'description');
		$wcrud->fieldSet('contentVariable_end', 'tabcontentend');
		
		$wcrud->fieldSet('contentResult', 'tabcontent','maintab');
			$wcrud->fieldSet('result_list', 'listmultiple_order', 'field_id', $resultList);
			$wcrud->fieldLineSet('result_1_list', 'listmultiple_order', 'field_id', $resultList);
			$wcrud->fieldSet('result_contentid', 'list', $contentResultsSelect, $contentResultsUrl);
			$wcrud->fieldSet('result_label');
			$wcrud->sizeSet('result_label',50);
			$wcrud->fieldSet('result_title');
			$wcrud->sizeSet('result_title',50);
			$wcrud->fieldSet('result_image', 'image');
			$wcrud->fieldSet('result_description', 'textarea');
			$wcrud->rowsSet('result_description', 7);
			$wcrud->colsSet('result_description',100);
			
			$wcrud->fieldLinkSet('result_label', 'result_contentid', 'label');
			$wcrud->fieldLinkSet('result_title', 'result_contentid', 'title');
			$wcrud->fieldLinkSet('result_image', 'result_contentid', 'image');
			$wcrud->fieldLinkSet('result_description', 'result_contentid', 'description');
		$wcrud->fieldSet('contentResult_end', 'tabcontentend');

		$wcrud->fieldSet('contentLink', 'tabcontent','maintab');
			$wcrud->fieldSet('process_id', 'list', $processSelect);
			$wcrud->fieldSet('link_list', 'listmultiple_order', 'link_id', $linkList);
		$wcrud->fieldSet('contentLink_end', 'tabcontentend');
		
	$wcrud->fieldSet('maintab_end', 'tabend','maintab');

	$wcrud->initValueSet('title', 'titleInit', 'transform', 'label');
	
	$wcrud->filterSet('domain_id', $domainId);
	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}
?>
