<?php
/**
* Content side feature
*
* @package    Content side app
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('JOBNAMESIDE_NAME', 'jobnameside');

// Menu Path
$ws->paramSet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('JOBNAMESIDE_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('JOBNAMESIDE_NAME') . '/' . TEMPLATES_SRC_PATH);

class JF_JobnameSide
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
    }

    function display() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('JOBNAMESIDE_NAME') . '_TEMPLATES_SRC_DIR') ;
		
		$content = new Wcontent();
		$smarty->assign('pageBlock', $content->display('jobnameheader','style:jobnameheaderside'));
		$smarty->assign('listBlock', $content->displayList('jobname','style:jobnameside', 'order:alpha'));
		$connect = new object_connect();
		$smarty->assign('Jobname_titlePage', "");
		$smarty->assign('JobnameHref', $connect->constructHref($ws->paramGet('APP_CODE'), $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGE_JOBNAMES')));		
		
		return $smarty->fetch('index.tpl');
	}

}

?>
