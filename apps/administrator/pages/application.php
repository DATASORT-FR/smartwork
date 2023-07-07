<?php
/**
* @package    use_application
* @subpackage controller
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

$object = new BUS_object();
$status_select = $object->initSelect();
$status_select = $object->addSelect($status_select, "0", $ws->getConfigVars("Lbl_status_0"));
$status_select = $object->addSelect($status_select, "1", $ws->getConfigVars("Lbl_status_1"));

$apptype = new object_apptype(); /* Open apptype class */
$apptype_select = $apptype->displaySelect("0", "")->returnGet();

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
$wlist->eventSet('btevent', true); /* show edit button */
$wlist->eventfileSet('btevent', 'application_ref'); /* php event file */
$wlist->eventboxSet('btevent', false);
$wlist->eventcommandSet('btevent', 'list');
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', false); /* show delete button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */
	
// line 1
$wcrud->fieldSet('code');
$wcrud->fieldColSizeSet('code',3);
$wcrud->fieldLabelSizeSet('code', 2);

$wcrud->fieldLineSet('label');
$wcrud->fieldColSizeSet('label',9);
$wcrud->fieldLabelSizeSet('label', 2);

$wcrud->fieldSet('flag_archive', 'hidden');

// line 2
$wcrud->fieldSet('name');

$wcrud->fieldLineSet('status_id', 'list', $status_select);

$wcrud->fieldLineSet('bt_archive', 'buttonconfirm', 'application_archive', 'id','code');
$wcrud->fieldLabelSet('bt_archive', false);
$wcrud->alignSet('bt_archive', 'right');
$wcrud->fieldDisplaySet('bt_archive', 'edit');
$wcrud->fieldDisplayOnlySet('bt_archive', 'flag_archive', 0);

$wcrud->fieldAppendSet('bt_delete', 'buttonconfirm', 'application_delete', 'id','code');
$wcrud->fieldLabelSet('bt_delete', false);
$wcrud->alignSet('bt_delete', 'right');
$wcrud->fieldDisplaySet('bt_delete', 'edit');
$wcrud->fieldDisplayOnlySet('bt_delete', 'flag_archive', 0);

$wcrud->fieldAppendSet('bt_copy', 'button', 'application_copy', 'id');
$wcrud->fieldLabelSet('bt_copy', false);
$wcrud->alignSet('bt_copy', 'right');
$wcrud->fieldDisplaySet('bt_copy', 'edit');
$wcrud->fieldDisplayOnlySet('bt_copy', 'flag_archive', 0);

// line 3
$wcrud->fieldSet('apptype_id', 'list', $apptype_select);

$wcrud->fieldLineSet('public', 'choice');

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
$wcrud->initValueSet('flag_archive', 0);

$wcrud->displayCrud();
?>
