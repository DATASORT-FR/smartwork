<?php
/**
* This file contains template "Main" initialization code
*
* @package    global
* @subpackage initialization
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/

defined('_WSEXEC') or die();

// Left Side zone
$content = new Wcontent();
$ws->assign('EngageBlock', $content->display('engage','style:intro_card','icon:cog'));

// Right Side zone
$statistics = new JF_Statistics();
$statisticsBlock = $statistics->display();
$ws->assign('StatisticsBlock', $statisticsBlock);

