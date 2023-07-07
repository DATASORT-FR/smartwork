<?php 
/**
* This file contains template for forum categories list screen.
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
				init_ws("#list_categories", "{$pageRef}");
			}
		);
	</script>

	<div id="list_categories" class="box-header block-adm block-subject_list" title="{#Title_forum_category#}" box-id="categories" box-model="box-model">
	</div>
		
{/block}
