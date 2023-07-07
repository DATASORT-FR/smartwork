<?php 
/**
* This file contains template for "slides" list screen.
*
* @package    use_slides
* @subpackage view
* @version    1.0
* @date       11 octobre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_slides", "{$pageRef}");
			}
		);
	</script>

	<div id="list_slides" class="box-header block-adm block-diagram block-slide_list" title="{#Title_node#}" box-id="slides" box-model="box-model">
	</div>
		
{/block}
