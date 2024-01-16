<?php
/**
* This file contains classes and models extension
*
* @package    administration_initialization
* @version    1.0
* @date       09 December 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

// ====================================
// Database Intialization
// ====================================

	if (defined('CONTENT_DSN')) {
		$ws->paramSet('CONTENT_DSN', CONTENT_DSN);
		$ws->paramSet('CONTENT_USERNAME', CONTENT_USERNAME);
		$ws->paramSet('CONTENT_PASSWORD', CONTENT_PASSWORD);
		$ws->paramSet('CONTENT_MODEL_FILE', CONTENT_MODEL_FILE);
		$ws->paramSet('CONTENT_SCHEMA_FILE', CONTENT_SCHEMA_FILE);
	}
	else {
		$ws->paramSet('CONTENT_DSN', DB_DSN);
		$ws->paramSet('CONTENT_USERNAME', DB_USERNAME);
		$ws->paramSet('CONTENT_PASSWORD', DB_PASSWORD);
		$ws->paramSet('CONTENT_MODEL_FILE', DB_MODEL_FILE);
		$ws->paramSet('CONTENT_SCHEMA_FILE', DB_SCHEMA_FILE);
	}

	if (defined('FORUM_DSN')) {
		$ws->paramSet('FORUM_DSN', FORUM_DSN);
		$ws->paramSet('FORUM_USERNAME', FORUM_USERNAME);
		$ws->paramSet('FORUM_PASSWORD', FORUM_PASSWORD);
		$ws->paramSet('FORUM_MODEL_FILE', FORUM_MODEL_FILE);
		$ws->paramSet('FORUM_SCHEMA_FILE', FORUM_SCHEMA_FILE);
	}
	else {
		$ws->paramSet('FORUM_DSN', DB_DSN);
		$ws->paramSet('FORUM_USERNAME', DB_USERNAME);
		$ws->paramSet('FORUM_PASSWORD', DB_PASSWORD);
		$ws->paramSet('FORUM_MODEL_FILE', DB_MODEL_FILE);
		$ws->paramSet('FORUM_SCHEMA_FILE', DB_SCHEMA_FILE);
	}

	if (defined('TASK_DSN')) {
		$ws->paramSet('TASK_DSN', TASK_DSN);
		$ws->paramSet('TASK_USERNAME', TASK_USERNAME);
		$ws->paramSet('TASK_PASSWORD', TASK_PASSWORD);
		$ws->paramSet('TASK_MODEL_FILE', TASK_MODEL_FILE);
		$ws->paramSet('TASK_SCHEMA_FILE', TASK_SCHEMA_FILE);
	}
	else {
		$ws->paramSet('TASK_DSN', DB_DSN);
		$ws->paramSet('TASK_USERNAME', DB_USERNAME);
		$ws->paramSet('TASK_PASSWORD', DB_PASSWORD);
		$ws->paramSet('TASK_MODEL_FILE', DB_MODEL_FILE);
		$ws->paramSet('TASK_SCHEMA_FILE', DB_SCHEMA_FILE);
	}

?>