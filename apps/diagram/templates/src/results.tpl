<?php 
/**
* This file contains template for "results" list screen.
*
* @package    use_field
* @subpackage view
* @version    1.0
* @date       25 Februar 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list-results", "{$pageRef}");
			}
		);
	</script>

	<div id="list-results" class="box-header block-adm block-diagram block-diagram-list" box-id="results" box-model="box-model">
	</div>
		
{/block}
