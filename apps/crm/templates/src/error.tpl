<?php 
/**
* This file contains error template model 
*
* @package    global
* @subpackage view
* @version    1.2
* @date       24 April 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>
{extends file="standard.tpl"}

{block name=Header_Right}
	{$IncConnect}
{/block}
{block name=Main}
	<div class="alert alert-warning">
		<p><strong>Warning!</strong> {#Error_page2#}</p>
	</div>
	{$IncApps}
{/block}
