<?php
/**
* @package    use_diagram
* @subpackage controller
* @version    1.0
* @date       24 Februar 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

$connect = new object_connect();
$ws->assign('pageRef',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));

if ($domainId != '') {
	$wcrud = new wcrud('object_variable_category', $ws->extractPage(__FILE__));
	$wcrud->titleSet(true); /* use Title */
	$wcrud->pageSet(false); /* set processing type : true = in one box; false = force open new box */

	$wlist = $wcrud->listGet();
	$wlist->pageSet(true);
	$wlist->pagesizeSet(10, 20); /* set number of lines for the list */
	$wlist->pagesearchSet(true); /* show search input and button */
	$wlist->pageorderSet(0); /* number of order type */
	$wlist->displaysizeSet('small'); /* set list width */

	$wlist->sortSet(true); /* show or not the sort of columns. False by default */

	$wlist->columnidSet(false); /* show id column */
	$wlist->columnidpctSet(5); /* set percent size for id column */
	$wlist->columnAdd('name',30); /* show code column */
	$wlist->columnAdd('label',60); /* show label column */
	$wlist->columnactionpctSet(5); /* set percent size for edit and delete column */

	$wlist->eventSet('btnew', true); /* show new button */
	$wlist->eventSet('btevent', true);
	$wlist->eventboxSet('btevent', false);
	$wlist->eventiconSet('btevent', 'arrow-up');
	$wlist->eventcommandSet('btevent', 'levelUp');
	$wlist->eventSet('bttool', true); /* show tool button */
	$wlist->eventfileSet('bttool', 'variablecategories_copy'); /* php tool file */
	$wlist->eventiconSet('bttool', 'clone'); /* php event icon */
	$wlist->eventboxSet('bttool', true);
	$wlist->eventSet('btedit', true); /* show edit button */
	$wlist->eventSet('btdelete', true); /* show delete button */

	$wcrud->commandSet('levelUp', 'levelUp');
	$wcrud->fieldSet('name');
	$wcrud->fieldSet('label');
	$wcrud->fieldSet('description', 'editor');
	$wcrud->fieldLabelSet('description', true);
	$wcrud->rowsSet('description', 23);

	$wcrud->filterSet('domain_id',$domainId);
	$wcrud->displayCrud();
}
else {
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
	require_once($filePath);
}

?>
