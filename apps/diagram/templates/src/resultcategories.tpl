<?php 
/**
* This file contains template for "result categories" list screen.
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
				init_ws("#list-resultcategories", "{$pageRef}");
			}
		);
	</script>

	<div id="list-resultcategories" class="box-header block-adm block-diagram block-diagram-list" box-id="resultcategories" box-model="box-model">
	</div>
		
{/block}
