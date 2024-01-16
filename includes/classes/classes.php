<?php
/**
* This file contains classes and models initialization
*
* @package    administration_initialization
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

// ====================================
// Database Intialization
// ====================================
	$ws->paramSet('DB_DSN', DB_DSN);
	$ws->paramSet('DB_USERNAME', DB_USERNAME);
	$ws->paramSet('DB_PASSWORD', DB_PASSWORD);
	$ws->paramSet('DB_MODEL_FILE', DB_MODEL_FILE);
	$ws->paramSet('DB_SCHEMA_FILE', DB_SCHEMA_FILE);

	try {
		$db = PDO_extend::ws_open();
	}
	catch (Exception $msg) {
		displayMsg($msg, 'Error DB', 1, false);
		die;
	}
	
// ====================================
// Business Intialization
// ====================================

	spl_autoload_register(
		function ($className) {
			$ws = workspace::ws_open();
			if (preg_match("#^object_#iusU", $className)) {
				$class =  preg_replace('#^object_#Usi', '', $className);

				$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_CLASSES_DIR') . 'use_' . $class . '.php';
				if (!file_exists($filePath)) {
					$filePath = $ws->paramGet('CLASSES_DIR') . 'use_' . $class . '.php';
				}
				require_once($filePath);
			}
		}
	);

?>