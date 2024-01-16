<?php
/**
* Users administration
*
* @package    administration_user
* @version    1.1
* @date       27 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$partner = new object_partner(); /* Open partner class */
$partner_select = $partner->displaySelect();

$group = new object_group(); /* Open group class */
$group_list = $group->displayList(0);

$application = new object_application(); /* Open application class */
$application_select = $application->displaySelect(0, '');

$object = new BUS_object();
$status_select = $object->initSelect();
$status_select = $object->addSelect($status_select, "", "");
$status_select = $object->addSelect($status_select, "0", $ws->getConfigVars("Lbl_status_0"));
$status_select = $object->addSelect($status_select, "1", $ws->getConfigVars("Lbl_status_1"));

/* display processing */
$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));
$wcrud = new wcrud('object_user', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pageSet(true);
$wlist->pagesizeSet(15, 25, 50); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(4); /* number of order type */
//$wlist->displaysizeSet('large'); /* set list width */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(false); /* show id column */

$wlist->sortSet(true); /* show or not the sort of columns. False by default */
$wlist->viewSet(true); /* show or not the columns selector. False by default */
$wlist->filterViewSet('status_id', 'list', $status_select); /* display a filter field */
$wlist->filterViewSet('source_id', 'list',  $application_select->returnGet()); /* display a filter field */

$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('id',10, false); /* show status_description column */
$wlist->columnAdd('login',10); /* show status_description column */
$wlist->columnAdd('status',10); /* show status_description column */
$wlist->columnAdd('lastname',20); /* show lastname column */
$wlist->columnAdd('firstname',20); /* show firstname column */
$wlist->columnAdd('email',25, false); /* show email column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */
	
/* Line 1 */
$wcrud->fieldSet('lastname');
$wcrud->fieldLineSet('login');

/* Line 2 */
$wcrud->fieldSet('firstname');

/* Line 2 column 2 : create mode */
$wcrud->fieldLineSet('password');
//	$wcrud->fieldAppendSet('bt_add_pwd', 'button', 'user_pwd', 'id');
$wcrud->fieldDisplaySet('password', 'new');
//	$wcrud->fieldDisplaySet('bt_add_pwd', 'new');

/* Line 2 column 2 : edit mode */
$wcrud->fieldUpdateSet('bt_pwd', 'button', 'admuser_pwd', 'id');
$wcrud->fieldLabelSet('bt_pwd', true);
$wcrud->fieldDisplaySet('bt_pwd', 'edit');
//	$wcrud->fieldRightSet('bt_pwd', 'update');
$wcrud->alignSet('bt_pwd', 'right');

/* Line 3 */
$wcrud->fieldSet('surname');
$wcrud->fieldLineSet('source_id', 'list', $application_select->returnGet());

/* Line 4 */
$wcrud->fieldSet('email');
$wcrud->fieldLineSet('status_id', 'choice');

/* Line 5 : empty */
$wcrud->fieldSet('clear');

/* Line 6 */
$wcrud->fieldSet('partner_list', 'listmultiple', 'partner_id', $partner_select->returnGet());
$wcrud->fieldLineSet('group_list', 'listmultiple_order', 'group_id', $group_list->returnGet());

$wcrud->displayCrud();
?>
