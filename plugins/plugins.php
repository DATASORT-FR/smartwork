<?php
/**
* plugin
*
* @package    administration_initialization
* @version    1.1
* @date       14 Août 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();


// Modules initialization
spl_autoload_register(
	function ($className) {
		$ws = workspace::ws_open();
		if (preg_match("#^plg_#iusU", $className)) {
			$class =  preg_replace('#^plg_#Usi', '', $className);
			switch ($class) {
				case 'accordioncontent':
					$class = 'accordion';
					break;
				case 'pagecontent':
					$class = 'page';
					break;
				case 'tabcontent':
					$class = 'tab';
					break;
			}
			$filePath = $ws->paramGet('PLUGINS_DIR') . '/' . $class . '/' . $class . '.php';
			if (file_exists($filePath)) {
				require_once($filePath);
			}
			else {
				require_once($ws->paramGet('PLUGINS_DIR') . $class . '/index.php');
			}
		}
	}
);

// Css & Js initialization
$list = array_diff(scandir($ws->paramGet('PLUGINS_DIR')), array('..', '.'));
foreach($list as $fileName) {
	$file = $ws->paramGet('PLUGINS_DIR') . $fileName;
	if(is_dir($file)) {
		$class = $fileName;
		$filePath = $ws->paramGet('PLUGINS_DIR') . '/' . $class . '/templates/css/' . $class . '.css';
		if (file_exists($filePath)) {
			$ws->addcss($ws->paramGet('RELA_PLUGINS_DIR') . '/' . $class . '/templates/css/' . $class . '.css');
		}
		$filePath = $ws->paramGet('PLUGINS_DIR') . '/' . $class . '/templates/js/' . $class . '.js';
		if (file_exists($filePath)) {
			$ws->addjs($ws->paramGet('RELA_PLUGINS_DIR') . '/' . $class . '/templates/js/' . $class . '.js');
		}
	}
}

?>