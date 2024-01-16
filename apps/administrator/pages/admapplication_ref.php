<?php
/**
* Application reference administration
*
* @package    administration_application
* @version    1.0
* @date       09 September 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$application_id = '';	
if ($ws->argGet('command') == 'list') {
	$application_id = $ws->paramGet('ID');
}
if ($application_id != '') {
	$_SESSION['object_application_id'] = $application_id;
}
else {
	$application_id = $_SESSION['object_application_id'];
}

$application = new object_application();
$application_select = $application->display($application_id);
$application_code = $application_select->returnGet()['code'];
$feature = new object_feature();
$feature->filterSet('application_id',$application_id);
$feature_select = $feature->displaySelect("0", "")->returnGet();

/* display processing */
$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));
$wcrud = new wcrud('object_application_ref', $ws->extractPage(__FILE__));
$wcrud->titleSet(true); /* use Title */
$wcrud->titleCodeSet($application_code);
$wcrud->pageSet(true); /* set processing type : true = in one box; false = force open new box */

$wlist = $wcrud->listGet();
$wlist->pagesizeSet(15, 25, 50); /* set number of lines for the list */
$wlist->pagesearchSet(true); /* show search input and button */
$wlist->pageorderSet(2); /* number of order type */
$wlist->displaysizeSet('small'); /* set list width */
$wlist->columnidSet(true); /* show id column */

$wlist->sortSet(true); /* show or not the sort of columns. False by default */

$wlist->columnidpctSet(5); /* set percent size for id column */
$wlist->columnAdd('application',25); /* show application column */
$wlist->columnAdd('feature',20); /* show code column */
$wlist->columnAdd('ref',40); /* show description column */
$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', true); /* show new button */
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', true); /* show delete button */
$wlist->eventSet('btclose', true); /* show close button */

$wcrud->editcolumnnameSet('ref'); /* column used in the delete confirmation window for the title */	
$wcrud->fieldSet('ref');
$wcrud->fieldSet('feature_id', 'list', $feature_select);	
$wcrud->fieldSet('alias');	
$wcrud->filterSet('application_id',$application_id);

$wcrud->displayCrud();
?>
