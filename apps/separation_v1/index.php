<?php
/**
* Main file for test
*
* @package    Test
* @subpackage controller
* @version    1.0
* @date       13 december 2019
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$filePath = $ws->paramGet($ws->paramGet('APP_NAME') . '_PAGES_DIR') . 'home.php';
require_once($filePath);
?>