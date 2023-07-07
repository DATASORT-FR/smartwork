<?php 
/**
* This file contains template for "variables" list screen.
*
* @package    use_field_variable
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
				init_ws("#list-variables", "{$pageRef}");
			}
		);
	</script>

	<div id="list-variables" class="box-header block-adm block-diagram block-diagram-list" box-id="variables" box-model="box-model">
	</div>
		
{/block}
