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
{/block}
{block name=Nav_Block}
	<div class="col-lg-12">			
		<div class="nav_left pull-left">
			{$IncNav}
		</div>
		<div class="nav_right pull-right">
			{$IncConnect}
		</div>
	</div>
{/block}
{block name=Right}
	{$IncHistory}
{/block}
