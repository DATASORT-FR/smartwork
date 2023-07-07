<?php 
/**
* This file contains template for "results contents management" screen.
*
* @package    use_content_results
* @subpackage view
* @version    1.0
* @date       31 May 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list-contents-results", "{$pageRef}");
			}
		);
	</script>

	<div id="list-contents-results" class="box-header block-adm block-diagram block-content-results-list" title="{#Title_content_results#}" box-id="contents-results" box-model="box-model">
	</div>
		
{/block}
