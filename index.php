<?php
/**
* This file contains home page processing.
*
* Variables declaration 
*      $ws object workspace 
*
* @package   administration_initialization
* @version   1.1
* @date      20 November 2013
* @author    Alain VANDEPUTTE
* @copyright datasort.fr
*/

/* intialization */
require_once('includes/init.php'); /* basic include */
//displayParams(1, false);

function initAppFile($type) {
	$ws = workspace::ws_open();
	
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . $type . '.php';
	if (!file_exists($filePath)) {
		if ($type == 'init') {
			$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . $ws->paramGet('APP_NAME') . '.php';
		}
		if ($type == 'init_template') {
			$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_INCLUDES_DIR') . $ws->paramGet('APP_NAME') . '_template.php';
		}
		if (!file_exists($filePath)) {
			$filePath = $ws->paramGet('INCLUDES_DIR') . $type . '_apps.php';
		}
	}
	return $filePath;
}

function tplAppFile($type) {
	$ws = workspace::ws_open();
	
	$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_TEMPLATES_SRC_DIR') . $type . '.tpl';
	if (!file_exists($filePath)) {
		$filePath = $type . '_apps.tpl';
	}
	return $filePath;
}

function buildApp($type) {
	$ws = workspace::ws_open();
	
	if ($ws->paramGet('APP_NAME') == '') {
		require_once($ws->paramGet('INCLUDES_DIR').'init_template.php');
		$ws->build($type . '.tpl');
	}
	else {
		require_once(initAppFile('init'));
		require_once(initAppFile('init_template'));
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_DIR') . $type . '.php';
		if (file_exists($filePath)) {
			require_once($filePath);
		}
		else {		
			$ws->build(tplAppFile($type));
		}
	}
}

function displayAppPage() {
	$ws = workspace::ws_open();
	
	if ($ws->paramGet('APP_NAME') == '') {
		$filePath = $ws->paramGet('PAGES_DIR') . $ws->paramGet('PAGE_NAME') . '.php';
		if (file_exists($filePath)) {
			require_once($filePath);
		}
		else {
			$ws->paramSet('PAGE_NAME', 'error');
		}
	}
	else {
		require_once(initAppFile('init'));
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . $ws->paramGet('PAGE_NAME') . '.php';
		if (file_exists($filePath)) {
			require_once(initAppFile('init_template'));
			$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . $ws->paramGet('PAGE_NAME') . '.php';
			require_once($filePath);
		}
		else {
			header('Location: ' . $ws->paramGet('ROOT_URL') . $ws->errorPageGet());
			exit();
		}
	}
}

function modeAppPage() {
	$ws = workspace::ws_open();

	if ($ws->paramGet('APP_NAME') == '') {
		$filePath = $ws->paramGet($ws->paramGet('MODE_NAME') . '_DIR') . $ws->paramGet('PAGE_NAME') . '.php';
		if (file_exists($filePath)) {
			require_once($filePath);
		}
		else {
			$ws->paramSet('PAGE_NAME', 'error');
		}
	}
	else {
		require_once(initAppFile('init'));
		$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_' . $ws->paramGet('MODE_NAME') . '_DIR') . $ws->paramGet('PAGE_NAME') . '.php';
		if (file_exists($filePath)) {
			require_once($filePath);
		}
		else {
			$filePath = $ws->paramGet($ws->paramGet('MODE_NAME') . '_DIR') . $ws->paramGet('PAGE_NAME') . '.php';
			if (file_exists($filePath)) {
				require_once($filePath);
			}
			else {
				header('Location: ' . $ws->paramGet('ROOT_URL') . $ws->errorPageGet());
				exit();
			}
		}
	}
}
if (!$ws->connected() and ($ws->paramGet('PAGE_NAME') <> 'connect') and ($ws->paramGet('PAGE_NAME') <> 'error')) {
	require_once($ws->paramGet('INCLUDES_DIR').'init_template.php');
	require_once($ws->paramGet('PAGES_DIR') . 'login.php');
}
else {
	if ($ws->paramGet('MODE_NAME') == '') {		
		if ($ws->paramGet('PAGE_NAME') == '') {
			buildApp('index');
		}
		else {
			if ($ws->paramGet('MODULE_NAME') == '') {
				if ($ws->paramGet('PAGE_NAME') != 'error') {
					displayAppPage();
				}
			}
			else {
				if ($ws->paramGet('APP_NAME') != '') {
					require_once(initAppFile('init'));
				}
				require_once($ws->paramGet('MODULES_DIR') . $ws->paramGet('MODULE_NAME') . '/' . $ws->paramGet('PAGE_NAME') . '.php');
			}
		}
	}
	else {
		if ($ws->paramGet('PAGE_NAME') == '') {
			$ws->paramSet('PAGE_NAME', 'error');
		}
		else {
			modeAppPage();
		}
	}
	if ($ws->paramGet('PAGE_NAME') == 'error') {
		buildApp('error');
	}
}
?>
