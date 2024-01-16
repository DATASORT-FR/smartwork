<?php
/**
* MediaManager class
*
* @package    module_mediamanager
* @version    2.0
* @date       17 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

// Workspace initialization
defined('_WSEXEC') or die();

$ws->paramSet('WMEDIA_NAME', 'mediamanager');

// Page Path
$ws->paramSet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATES_SRC_DIR', $ws->paramGet('MODULES_DIR') . $ws->paramGet('WMEDIA_NAME') . '/' . TEMPLATES_SRC_PATH);
$ws->paramSet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATES_CSS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('WMEDIA_NAME') . '/templates/css/');
$ws->paramSet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATES_JS_DIR', $ws->paramGet('RELA_MODULES_DIR') . $ws->paramGet('WMEDIA_NAME') . '/templates/js/');

// Template css & js
$ws->paramSet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATE_STYLE', $ws->paramGet('WMEDIA_NAME') . '.css');
$ws->paramSet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATE_JS', $ws->paramGet('WMEDIA_NAME') . '.js');

$ws->addcss($ws->paramGet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATES_CSS_DIR') . $ws->paramGet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATE_STYLE'));
$ws->addjs($ws->paramGet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATES_JS_DIR') . $ws->paramGet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATE_JS'));

if (!$ws->ctrlParam('MEDIA_RIGHT_CREATE')) {
	$ws->paramSet('MEDIA_RIGHT_CREATE', 0);
}
if (!$ws->ctrlParam('MEDIA_RIGHT_READ')) {
	$ws->paramSet('MEDIA_RIGHT_READ', 0);
}
if (!$ws->ctrlParam('MEDIA_RIGHT_UPDATE')) {
	$ws->paramSet('MEDIA_RIGHT_UPDATE', 0);
}
if (!$ws->ctrlParam('MEDIA_RIGHT_DELETE')) {
	$ws->paramSet('MEDIA_RIGHT_DELETE', 0);
}
if (!$ws->ctrlParam('MEDIA_RIGHT_EVENT')) {
	$ws->paramSet('MEDIA_RIGHT_EVENT', 0);
}

/**
* Classes for media-manager module.
*/
class Wmedia
{

	private static $_fileType = array(
		'image/png' => 'image',
		'image/jpeg' => 'image',
		'image/jpeg' => 'image',
		'image/jpeg' => 'image',
		'image/gif' => 'image',
		'image/bmp' => 'image',
		'image/vnd.microsoft.icon' => 'image',
		'image/tiff' => 'image',
		'image/svg' => 'image',
		'image/svg+xml' => 'image',
		'image/webp' => 'image',
		'video/x-flv' => 'video',
		'video/quicktime' => 'video',
	);

	function initSmarty($smarty) {
		$ws = workspace::ws_open();
		
		// template directories load
		$smarty->setTemplateDir(array());
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('APP_NAME') . '_MODULES_DIR') . '/' . $ws->paramGet('WMEDIA_NAME') . '/' . TEMPLATES_SRC_PATH);
		$smarty->addTemplateDir($ws->paramGet($ws->paramGet('WMEDIA_NAME') . '_TEMPLATES_SRC_DIR'));
	}

    public function __construct() {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

    }
	
	function fileList($path) {
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$list = array_diff(scandir($path), array('..', '.'));
		$fileList = array();
		$typeArray = array();
		$nameArray = array();
		foreach($list as $fileName) {
			$fileItem = array();
			$file = $path . $fileName;
			$type = 'file';
			$classType = '';
			if(is_dir($file)) {
				$type = 'dir';
			}
			else {
				if (isset(self::$_fileType[mime_content_type($file)])) {
					$type = self::$_fileType[mime_content_type($file)];
					if (mime_content_type($file) == 'image/svg') {
						$classType = 'svg';
					}
					if (mime_content_type($file) == 'image/png') {
						$classType = 'png';
					}
				}
			}
			$fileItem['name'] = $fileName;
			$fileItem['label'] = substr($fileName, 0, 18);
			$fileItem['file'] = $file;
			$fileItem['class'] = $classType;
			$fileItem['type'] = $type;
			$fileList[] = $fileItem;
			$typeArray[] = $type;
			$nameArray[] = $fileName;
		}
		array_multisort($typeArray, SORT_ASC, $nameArray, SORT_ASC, $fileList);
		return $fileList;
	}

	function createDir($path) {	
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$path = str_replace('\/','/',$path);
		$return = true;

		xmkdir($path);

		return $return;
	}

	function uploadFile($path, $fileIndex) {	
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$path = str_replace('\/','/',$path);
		$return = true;

		$ws->logSys('debug', 'File Name : ' . $_FILES[$fileIndex]['name'], __CLASS__, $_FILES);

		move_uploaded_file($_FILES[$fileIndex]['tmp_name'],$path . $_FILES[$fileIndex]['name']);

		return $return;
	}

	function renameFile($oldFileName, $newFileName) {	
		$ws = workspace::ws_open();
		$ws->logSys('debug', 'call function ' . __FUNCTION__, __CLASS__, func_get_args(), 'arguments');

		$oldFileName = str_replace('\/','/',$oldFileName);
		$newFileName = str_replace('\/','/',$newFileName);
		$return = true;
		rename($oldFileName, $newFileName);		
		return $return;
	}
	
}

?>
