<?php 
/**
* This file contains template for "tables management" screen.
*
* @package    use_field_table
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
				init_ws("#list-tables", "{$pageRef}");
			}
		);
	</script>

	<div id="list-tables" class="box-header block-adm block-diagram block-diagram-list" box-id="tables" box-model="box-model">
	</div>
		
{/block}
