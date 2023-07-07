<?php
/**
* Statistics feature
*
* @package    Statistics app
* @subpackage controller
* @version    1.5
* @date       17 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('STATISTICS_NAME', 'statistics');

// Menu Path
$ws->paramSet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('STATISTICS_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('STATISTICS_NAME') . '/' . TEMPLATES_SRC_PATH);

class JF_Statistics
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
    }

    function display() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('STATISTICS_NAME') . '_TEMPLATES_SRC_DIR') ;
		
		$job = new object_job();
		$statistics = $job->getCountJob();
		$numberOffers = $statistics['all'];
		$numberActives = $statistics['actives'];

		if ($numberOffers != 0) {
			$pctActivesOffers = (int) (($numberActives/$numberOffers)*100);
		}
		else {
			$pctActivesOffers = 0;			
		}
		$pctConsultedOffers = 34;
		
		$connect = new object_connect();
		$smarty->assign('statisticsHref', $connect->constructHref($ws->paramGet('APP_CODE'), 'statistics'));
		$smarty->assign('numberOffers',$numberOffers);
		$smarty->assign('numberActives',$numberActives);
		$smarty->assign('pctActivesOffers',$pctActivesOffers);
		$smarty->assign('pctConsultedOffers',$pctConsultedOffers);

		return $smarty->fetch('index.tpl');
	}

}

?>
