<?php 
/**
* This file contains template for home page
*
* @package    global
* @subpackage view
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard_apps.tpl"}

{block name=Header_Right}
	{$IncConnect}
{/block}
{block name=Nav_Block}
	{$IncNav}
{/block}
{block name=Right}
	{$IncHistory}
{/block}
