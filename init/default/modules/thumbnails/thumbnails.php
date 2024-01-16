<?php
/**
* Thumbnails feature
*
* @package    default_initialization
* @version    1.5
* @date       17 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('THUMBNAILS_NAME', 'thumbnails');

// Menu Path
$ws->paramSet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('THUMBNAILS_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . $ws->paramGet('THUMBNAILS_NAME') . '/' . TEMPLATES_SRC_PATH);

/**
* Classes for thumbnails module in default app
*/
class JF_Thumbnails
{

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');
    }

    function display() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$smarty = new workpage();
		$smarty->template_dir = $ws->paramGet($ws->paramGet('APP_NAME'). '_' . $ws->paramGet('THUMBNAILS_NAME') . '_TEMPLATES_SRC_DIR') ;

		return $smarty->fetch('index.tpl');
	}

}

?>
