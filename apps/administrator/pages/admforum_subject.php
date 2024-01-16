<?php
/**
* Forum subjects administration
*
* @package    forum_subject
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

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

$object = new BUS_object();
$status_select = $object->initSelect();
$status_select = $object->addSelect($status_select, "0", $ws->getConfigVars("Lbl_status_0"));
$status_select = $object->addSelect($status_select, "1", $ws->getConfigVars("Lbl_status_1"));

$category = new object_forum_category();
$category_select = $category->displaySelect('', '');

$wcrud = new wcrud('object_forum_subject', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pageSet(true);
$wlist->pagesizeSet(14); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(false); /* show id column */
$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('category_name',10); /* show catzegory column */
$wlist->columnAdd('name',20); /* show name column */
$wlist->columnAdd('status',15); /* show status column */
$wlist->columnAdd('label',50); /* show label column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btevent', true); /* show edit button */
$wlist->eventboxSet('btevent', false);
$wlist->eventiconSet('btevent', 'arrow-up');
$wlist->eventcommandSet('btevent', 'levelUp');
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('name'); /* column used in the delete confirmation window for the title */
	
// line 1
$wcrud->commandSet('levelUp', 'levelUp');
$wcrud->fieldSet('name');
$wcrud->fieldLineSet('category_id', 'list', $category_select->returnGet());
$wcrud->fieldLineSet('status_id', 'list', $status_select);
$wcrud->fieldSet('label');
$wcrud->fieldSet('maintab', 'tab');
	$wcrud->fieldSet('tab1', 'tabcontent','maintab');
		$wcrud->fieldSet('vignette','image');
		$wcrud->fieldSet('image','image');
	$wcrud->fieldSet('tab1_end', 'tabcontentend');
	$wcrud->fieldSet('tab2', 'tabcontent','maintab');
		$wcrud->fieldSet('content', 'editor');
		$wcrud->rowsSet('content', 10);
	$wcrud->fieldSet('tab2_end', 'tabcontentend');
	$wcrud->fieldSet('tab3', 'tabcontent','maintab');
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
		$wcrud->fieldSet('alt', 'text');
		$wcrud->sizeSet('alt',80);
		$wcrud->fieldSet('class', 'text');
		$wcrud->sizeSet('class',10);
		$wcrud->fieldSet('icon', 'text');
		$wcrud->sizeSet('icon',10);
	$wcrud->fieldSet('tab4_end', 'tabcontentend');
$wcrud->fieldSet('maintab_end', 'tabend','maintab');

$wcrud->initValueSet('alias', 'aliasInit', 'transform', 'name');
$wcrud->initValueSet('keywords', $ws->keywordsGet());

$wcrud->displayCrud();

?>
