<?php
/**
* Global login page
*
* @package    administration_initialization
* @version    1.1
* @date       27 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();

$wlogin = new wlogin();
$ws->assign('IncConnect',$wlogin->displayConnect('inline', true, false, './'));
$ws->build('login.tpl');

?>
