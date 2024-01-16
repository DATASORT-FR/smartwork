<?php
/**
* module class
*
* @package    administration_module
* @version    1.1
* @date       14 September 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

/**
* Classes for global module.
*/
class Wmodule
{

	private $_name;

/* Public functions */
	
	/**
	* Init smarty Object
	*
	* @param object - smarty object
	*
    * @access private
	*/

	public function initSmarty($smarty) {
		$ws = workspace::ws_open();
		
		// template directories load
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $this->_name . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($this->_name . '_TEMPLATES_SRC_DIR'));	
	}
	
	/**
	* constructor plg_Tab
    *
    * @access public
	*/
    public function __construct($module_name) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$this->_name = $module_name;
	}
	
}

// Modules initialization
spl_autoload_register(
	function ($className) {
		$ws = workspace::ws_open();
		if (preg_match("#^W#iusU", $className)) {
			$class =  preg_replace('#^W#Usi', '', $className);
			switch ($class) {
				case 'media':
					$class = 'mediamanager';
					break;
			}
			$filePath = $ws->paramGet('MODULES_DIR') . '/' . $class . '/' . $class . '_index.php';
			if (file_exists($filePath)) {
				require_once($filePath);
			}
			else {
				require_once($ws->paramGet('MODULES_DIR') . $class . '/' . $class . '.php');
			}
		}
	}
);

// Css & Js initialization
$list = array_diff(scandir($ws->paramGet('MODULES_DIR')), array('..', '.'));
foreach($list as $fileName) {
	$file = $ws->paramGet('MODULES_DIR') . $fileName;
	if(is_dir($file)) {
		$class = $fileName;
		$filePath = $ws->paramGet('MODULES_DIR') . '/' . $class . '/templates/css/' . $class . '.css';
		if (file_exists($filePath)) {
			$ws->addcss($ws->paramGet('RELA_MODULES_DIR') . $class . '/templates/css/' . $class . '.css');
		}
		$filePath = $ws->paramGet('MODULES_DIR') . '/' . $class . '/templates/js/' . $class . '.js';
		if (file_exists($filePath)) {
			$ws->addjs($ws->paramGet('RELA_MODULES_DIR') . $class . '/templates/js/' . $class . '.js');
		}
	}
}

?>