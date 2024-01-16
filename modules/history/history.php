<?php
/**
* History module
*
* @package    module_history
* @version    1.0
* @date       15 September 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('HISTORY_NAME', 'history');

// History Path
$ws->paramSet('HISTORY_CONFS_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('HISTORY_NAME') . '/confs/');
$ws->paramSet('HISTORY_IMAGES_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('HISTORY_NAME') . '/images/');
$ws->paramSet('HISTORY_INCLUDES_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('HISTORY_NAME') . '/includes/');
$ws->paramSet('HISTORY_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('HISTORY_NAME') . '/templates/src/');
$ws->paramSet('HISTORY_TEMPLATES_CSS_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('HISTORY_NAME') . '/templates/css/');

/**
* Classes for history module.
*/
class whistory
{

    public function __construct() {

    }

    public function displayHistory() {
		$ws = workspace::ws_open();

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet('HISTORY_TEMPLATES_SRC_DIR') ;

		return $smarty->fetch('index.tpl');
	}

    public function displayFlaghistory() {
		$ws = workspace::ws_open();

		if ($ws->connected()) {
			return 1;
		}
		else {
			return 0;
		}
	}

}
	
?>
