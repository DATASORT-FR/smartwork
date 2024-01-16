<?php
/**
* Mediamanager page
*
* @package    module_mediamanager
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control();

// Main
$defaultPath = $ws->argGet('default');
if (empty($defaultPath)) {
	$defaultPath = $ws->paramGet('RELA_IMAGES_DIR');
}
$file = $ws->argGet('file');
$path = '';
$fileName = '';
if (is_file($file)) {
	$path = dirname($file);
	if (!is_dir($path)) {
		$path = $defaultPath;
	}
	else {
		$path = $path . '/';		
	}
	$fileName = basename($file);
}
else {
	if (is_dir($file)) {
		$path = $file;
	}
	else {
		$path = $defaultPath;		
	}
}
$fileListRef = $connect->constructHref($ws->paramGet('APP_CODE'), "listpath", "module:mediamanager");
$newDirRef = $connect->constructHref($ws->paramGet('APP_CODE'), "medianewdir", "module:mediamanager");
$uploadRef = $connect->constructHref($ws->paramGet('APP_CODE'), "mediaupload", "module:mediamanager");
$renameRef = $connect->constructHref($ws->paramGet('APP_CODE'), "mediarename", "module:mediamanager");

$btNewDir = false;
$btUpload = false;
$btRead = false;
$btRename = false;
$btDelete = false;
if ($ws->paramGet('MEDIA_RIGHT_CREATE') == 1) {
	$btNewDir = true;
	$btUpload =true;
}
if ($ws->paramGet('MEDIA_RIGHT_READ') == 1) {
	$btRead = true;
}
if ($ws->paramGet('MEDIA_RIGHT_UPDATE') == 1) {
	$btRename = true;
}
if ($ws->paramGet('MEDIA_RIGHT_DELETE') == 1) {
	$btDelete = true;
}

$moduleMedia = new Wmedia();
$smarty = new workpage();
$moduleMedia->initSmarty($smarty);
$smarty->assign('file', $file);
$smarty->assign('path', $path);
$smarty->assign('fileName', $fileName);
$smarty->assign('fileListRef', $fileListRef);
$smarty->assign('newDirRef', $newDirRef);
$smarty->assign('uploadRef', $uploadRef);
$smarty->assign('renameRef', $renameRef);
$smarty->assign('btNewDir',$btNewDir);
$smarty->assign('btUpload',$btUpload);
$smarty->assign('btRead',$btRead);
$smarty->assign('btRename',$btRename);
$smarty->assign('btDelete',$btDelete);
$smarty->display('mediamanager.tpl');
?>
