<?php
/**
* Login page
*
* @package    Mediation app
* @subpackage controller
* @version    1.5
* @date       17 May 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

/*  intialization */
defined('_WSEXEC') or die();
$ws->logSys("debug", "Page : " . __FILE__, $ws->paramGet('APP_CODE'));
$ws->control('login.tpl');

$wlogin = new wlogin();
$ws->assign('IncConnect',$wlogin->displayConnect('vertical', false));

$ws->logTrace($ws->paramGet('APP_CODE'), $ws->paramGet('PAGE_NAME'), $ws->paramGet('ID'), $ws->urlTitleGet());
$ws->build('login.tpl');

?>
