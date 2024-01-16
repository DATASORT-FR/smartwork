<?php
/**
* Content side feature
*
* @package    default_initialization
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('FILESIDE_NAME', 'fileside');

// Menu Path
$ws->paramSet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('FILESIDE_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('FILESIDE_NAME') . '/' . TEMPLATES_SRC_PATH);

/**
* Classes for fileside article module in default app
*/
class JF_FileSide
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
    }

    function display() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('FILESIDE_NAME') . '_TEMPLATES_SRC_DIR') ;
		
		$content = new Wcontent();
		$smarty->assign('pageBlock', $content->display('fileheader','style:fileheaderside'));
		$smarty->assign('listBlock', $content->displayList('file','style:fileside', 'order:alpha'));
		$connect = new object_connect();
		$smarty->assign('Files_titlePage', "");
		$smarty->assign('FilesHref', $connect->constructHref($ws->paramGet('APP_CODE'), $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGE_FILES')));		
		
		return $smarty->fetch('index.tpl');
	}

}

?>
