<?php 
/**
* This file contains template for forum topics list screen.
*
* @package    use_forum
* @subpackage view
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="index.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_topics", "{$pageRef}");
			}
		);
	</script>

	<div id="list_topics" class="box-header block-adm block-topic_list" title="{#Title_forum_topic#}" box-id="topics" box-model="box-model">
	</div>
		
{/block}
