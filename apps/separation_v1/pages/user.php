<?php
/**
* Main file for users management
*
* @package    use_user
* @subpackage controller
* @version    1.1
* @date       27 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$application = new object_application(); /* Open application class */
$application_select = $application->displaySelect(0, '');

$object = new BUS_object();
$status_select = $object->initSelect();
$status_select = $object->addSelect($status_select, "0", $ws->getConfigVars("Lbl_status_0"));
$status_select = $object->addSelect($status_select, "1", $ws->getConfigVars("Lbl_status_1"));

/* display processing */
$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));
$wcrud = new wcrud('object_user', 'user', 'user');
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pageSet(true);
$wlist->pagesizeSet(10, 20, 50); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->displaysizeSet('large'); /* set list width */
$wlist->columnidSet(false); /* show id column */

$wlist->sortSet(true); /* show or not the sort of columns. False by default */
$wlist->viewSet(true); /* show or not the columns selector. False by default */
$wlist->filterViewSet('status_id', 'list', $status_select); /* display a filter field */

$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('id',10, false); /* show status_description column */
$wlist->columnAdd('date_creation',10); /* show creation date column */
$wlist->columnFormat('date_creation', 'date'); 
$wlist->columnAdd('login',25); /* show status_description column */
$wlist->columnAdd('status',10); /* show status_description column */
$wlist->columnAdd('lastname',25); /* show lastname column */
$wlist->columnAdd('firstname',25); /* show firstname column */
$wlist->columnAdd('email',25, false); /* show email column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */

$wlist->eventSet('btevent', true); /* show event button */
$wlist->eventfileSet('btevent', 'user_result'); /* php event file */
$wlist->eventiconSet('btevent', 'folder'); /* php event icon */
$wlist->eventboxSet('btevent', true);
//$wlist->eventSet('bttool', true); /* show tool button */
//$wlist->eventfileSet('bttool', 'diagrams_copy'); /* php tool file */
//$wlist->eventiconSet('bttool', 'clone'); /* php event icon */
//$wlist->eventboxSet('bttool', true);
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */

$wlist->deletecolumnnameSet('code'); /* column used in the delete confirmation window for the title */
	
/* Line 0 */
$wcrud->fieldSet('date_creation', 'date');
$wcrud->readonlySet('date_creation');
$wcrud->formatSet('date_creation', 'd/m/Y');
$wcrud->fieldDisplaySet('date_creation', 'edit');
$wcrud->fieldLineSet('date_update', 'date');
$wcrud->readonlySet('date_update');
$wcrud->formatSet('date_update', 'd/m/Y');
$wcrud->fieldDisplaySet('date_update', 'edit');

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
$wcrud->fieldUpdateSet('bt_pwd', 'button', 'user_pwd', 'id');
$wcrud->fieldLabelSet('bt_pwd', true);
$wcrud->fieldDisplaySet('bt_pwd', 'edit');
//	$wcrud->fieldRightSet('bt_pwd', 'update');
$wcrud->alignSet('bt_pwd', 'right');

/* Line 3 */
$wcrud->fieldSet('surname');

/* Line 4 */
$wcrud->fieldSet('email');
$wcrud->fieldLineSet('status_id', 'choice');

$wcrud->filterSet('source_id', $ws->paramGet('APP_ID'));

$wcrud->displayCrud();
?>
