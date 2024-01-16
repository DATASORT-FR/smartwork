<?php
/**
* Applications administration
*
* @package    administration_application
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

function analyzeFlagAdmin($argArray) {
	$flagAdmin = $argArray['flag_admin'];
	$appName = $argArray['name'];
	$appDir = $argArray['dir'];
	
    if (($flagAdmin == 0) and ($appName != $appDir)) {
		$flagAdmin = 3;
	}
	return $flagAdmin;
}

$command = $ws->argGet('command');

$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

$object = new BUS_object();
$status_select = $object->initSelect();
$status_select = $object->addSelect($status_select, "0", $ws->getConfigVars("Lbl_status_0"));
$status_select = $object->addSelect($status_select, "1", $ws->getConfigVars("Lbl_status_1"));

$apptype = new object_apptype(); /* Open apptype class */
$apptype_select = $apptype->displaySelect("", " ", "code")->returnGet();

$wcrud = new wcrud('object_application', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pageSet(true);
$wlist->pagesizeSet(15, 25, 50); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(2); /* number of order type */
$wlist->filterSet('status_id', 0, '>='); /* filter activ and inactiv items*/
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(false); /* show id column */

$wlist->sortSet(true); /* show or not the sort of columns. False by default */

$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('code',15); /* show code column */
$wlist->columnAdd('status',10); /* show code column */
$wlist->columnAdd('label',50); /* show label column */
$wlist->columnAdd('public_label',10); /* show label column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btlink', true); /* show edit button */
$wlist->eventfileSet('btlink', 'admapplication_import'); /* php event file */
$wlist->eventboxSet('btlink', false);
$wlist->eventiconSet('btlink', '');
$wlist->eventtextSet('btlink', 'Importer');

$wlist->eventSet('btevent', true); /* show edit button */
$wlist->eventfileSet('btevent', 'admapplication_ref'); /* php event file */
$wlist->eventboxSet('btevent', false);
$wlist->eventcommandSet('btevent', 'list');
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', false); /* show delete button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */
	
// line 1
$wcrud->fieldSet('code');
$wcrud->fieldColSizeSet('code',4);
$wcrud->fieldLabelSizeSet('code', 2);
if (($command == 'edit') or ($command == 'update')) {
	$wcrud->readonlySet('code');
}

$wcrud->fieldLineSet('label');
$wcrud->fieldColSizeSet('label',8);
$wcrud->fieldLabelSizeSet('label', 2);

$wcrud->fieldSet('flag_admin', 'hidden');
$wcrud->fieldSet('dir', 'hidden');

// line 2
$wcrud->fieldSet('name');
$wcrud->fieldColSizeSet('name',4);
$wcrud->fieldLabelSizeSet('name', 2);

if (($command == 'edit') or ($command == 'update')) {	
	$wcrud->readonlySet('name');

	$wcrud->fieldLineSet('status_id', 'list', $status_select);
	$wcrud->fieldColSizeSet('status_id',8);
	$wcrud->fieldLabelSizeSet('status_id', 2);
	$wcrud->fieldDisplayOnlySet('status_id', 'flag_admin', 0);

	$wcrud->fieldSet('bt_export', 'buttonconfirm', 'admapplication_export', 'id','code');
	$wcrud->fieldColSizeSet('bt_export',12);
	$wcrud->fieldLabelSizeSet('bt_export', 2);
	$wcrud->fieldLabelSet('bt_export', true);
	$wcrud->alignSet('bt_export', 'right');
	$wcrud->fieldDisplaySet('bt_export', 'edit');
	$wcrud->fieldDisplayOnlySet('bt_export', 'flag_admin', 0);
	$wcrud->fieldDisplayOnlySet('bt_export', 'name', 'administrator', '!=');

	$wcrud->fieldAppendSet('bt_delete', 'buttonconfirm', 'admapplication_delete', 'id','code');
	$wcrud->fieldLabelSet('bt_delete', false);
	$wcrud->alignSet('bt_delete', 'right');
	$wcrud->fieldDisplaySet('bt_delete', 'edit');
	$wcrud->fieldDisplayOnlySet('bt_delete', 'flag_admin', 0);
	$wcrud->fieldDisplayOnlySet('bt_delete', 'name', 'administrator', '!=');

	$wcrud->fieldAppendSet('bt_copy', 'button', 'admapplication_copy', 'id');
	$wcrud->fieldLabelSet('bt_copy', false);
	$wcrud->alignSet('bt_copy', 'right');
	$wcrud->fieldDisplaySet('bt_copy', 'edit');
	$wcrud->fieldDisplayOnlySet('bt_copy', 'flag_admin', 0);
	$wcrud->fieldDisplayOnlySet('bt_copy', 'name', 'administrator', '!=');

	$wcrud->fieldAppendSet('bt_rename', 'button', 'admapplication_rename', 'id');
	$wcrud->fieldLabelSet('bt_rename', false);
	$wcrud->alignSet('bt_rename', 'right');
	$wcrud->fieldDisplaySet('bt_rename', 'edit');
	$wcrud->fieldDisplayOnlySet('bt_rename', 'flag_admin', 0);
	$wcrud->fieldDisplayOnlySet('bt_rename', 'name', 'administrator', '!=');
}

// line 3
$wcrud->fieldSet('apptype', 'list', $apptype_select);

$wcrud->fieldLineSet('public', 'choice');

$wcrud->fieldLineSet('version');
$wcrud->fieldColSizeSet('version',3);
$wcrud->fieldLabelSizeSet('version', 2);

// line 4
$wcrud->fieldSet('canonical');

// line 5
$wcrud->fieldSet('url_root');

// line 6
$wcrud->fieldSet('content_page');
$wcrud->fieldLineSet('forum_subject_page');
$wcrud->fieldLineSet('forum_topic_page');

// line 7
$wcrud->fieldSet('description');
$wcrud->rowsSet('description', 3);
$wcrud->colsSet('description',50);

$wcrud->fieldLineSet('keywords', 'textarea');
$wcrud->rowsSet('keywords', 3);
$wcrud->colsSet('keywords',50);

// line 8
$wcrud->fieldSet('image','image');
$wcrud->fieldColSizeSet('image',8);
//$wcrud->fieldLineSet('clear');

$wcrud->initValueSet('content_page', 'content');
if ($command == 'create') {	
	$wcrud->valueSet('flag_admin', 2);
}

if ($command == 'update') {	
	$wcrud->valueSet('flag_admin', 'analyzeFlagAdmin', 'transform');
}

$wcrud->displayCrud();
?>
