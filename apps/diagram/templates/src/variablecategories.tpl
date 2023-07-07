<?php 
/**
* This file contains template for "result types" list screen.
*
* @package    use_diagram
* @subpackage view
* @version    1.0
* @date       24 Februar 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list-variablecategories", "{$pageRef}");
			}
		);
	</script>

	<div id="list-variablecategories" class="box-header block-adm block-diagram block-diagram-list" box-id="variablecategories" box-model="box-model">
	</div>
		
{/block}
