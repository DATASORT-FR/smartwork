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
		
		$article = new object_article();
		$statistics = $article->getCountArticle();
		$numberArticles = $statistics['all'];
		$numberActives = $statistics['actifs'];
		if ($numberArticles != 0) {
			$pctActivesArticles = (int) (($numberActives/$numberArticles)*100);
		}
		else {
			$pctActivesArticles = 0;			
		}
		$pctConsultedArticles = 34;
		
		$smarty->assign('numberArticles',$numberArticles);
		$smarty->assign('pctActivesArticles',$pctActivesArticles);
		$smarty->assign('pctConsultedArticles',$pctConsultedArticles);

		return $smarty->fetch('index.tpl');
	}

}

?>
