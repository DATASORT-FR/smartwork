<?php
/**
* Data administration file for Job freelance 
*
* @package    Data
* @subpackage controller
* @version    1.0
* @date       22 September 2018
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();
$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . 'init_templateMain.php';
require_once($filePath);

// Main
$connect = new object_connect();
$ws->assign('page_ref',$connect->constructHref($ws->paramGet('APP_CODE'), $ws->extractPage(__FILE__), 'command:list'));
$wcrud = new wcrud('object_data', 'data_admin', 'data_admin');
$wcrud->titleSet(true); /* use Title */
$wcrud->pageSet(true);
$wcrud->editcolumnnameSet('id'); 

$wlist = $wcrud->listGet();
$wlist->pagesizeSet(20); /* set number of lines for the list */
$wlist->pagesearchSet(false); /* show search input and button */
$wlist->pageorderSet(0); /* number of order type */
$wlist->columnidSet(true); /* show id column */
$wlist->displaysizeSet('large'); /* set list width */
$wlist->columnidpctSet(10); /* set percent size for id column */
$wlist->columnAdd('file_name',75); /* show application column */
$wlist->columnactionpctSet(15); /* set percent size for edit and delete column */

$wlist->eventSet('btnew', false); /* show new button */
$wlist->eventSet('btevent', false); /* show edit button */
$wlist->eventSet('btedit', true); /* show edit button */
$wlist->eventSet('btdelete', false); /* show delete button */

$wcrud->fieldSet('file_name');
$wcrud->sizeSet('file_name',150);
$wcrud->readonlySet('file_name');
$wcrud->fieldSet('content', 'editor');
$wcrud->rowsSet('content', 25);

$wcrud->displayCrud();
?>
