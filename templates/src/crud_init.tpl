<?php 
/**
* This file contains default template screen.
*
* @package    crud
* @subpackage view
* @version    1.0
* @date       26 december 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list-{$pageName}", "{$pageRef}");
			}
		);
	</script>

	<div id="list-{$pageName}" class="box-header block-adm block-{$pageName}" title="{$pageTitle}" box-id="diagrams" box-model="box-model">
	</div>
		
{/block}
