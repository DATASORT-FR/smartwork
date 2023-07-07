<?php
/**
* Main file for mediation
*
* @package    Mediation
* @subpackage controller
* @version    1.0
* @date       15 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'mediation-home.php';
require_once($filePath);
?>