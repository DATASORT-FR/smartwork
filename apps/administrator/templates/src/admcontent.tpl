<?php 
/**
* This file contains template for "content" list screen.
*
* @package    use_content
* @subpackage view
* @version    1.0
* @date       25 November 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="index.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_contents", "{$pageRef}");
			}
		);
	</script>

	<div id="list_contents" class="box-header block-adm block-content_list" title="{#Title_content#}" box-id="contents" box-model="box-model">
	</div>
		
{/block}
