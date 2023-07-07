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
				init_ws("#list_content_categories", "{$pageRef}");
			}
		);
	</script>

	<div id="list_content_categories" class="box-header block-adm block-content_category_list" title="{#Title_admcontent_category#}" box-id="contents" box-model="box-model">
	</div>
		
{/block}
