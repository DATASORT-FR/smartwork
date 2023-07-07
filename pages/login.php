<?php
/**
* Main file for users management
*
* @package    use_user
* @subpackage controller
* @version    1.1
* @date       27 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$wlogin = new wlogin();
$ws->assign('IncConnect',$wlogin->displayConnect('vertical', false));
$ws->build('login.tpl');

?>
