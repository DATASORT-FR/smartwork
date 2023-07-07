<?php 
/**
* This file contains template for forum posts list screen.
*
* @package    use_forum
* @subpackage view
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_posts", "{$pageRef}");
			}
		);
	</script>

	<div id="list_posts" class="box-header block-adm block-post_list" title="{#Title_post#}" box-id="posts" box-model="box-model">
	</div>
		
{/block}
