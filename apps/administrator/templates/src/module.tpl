<?php 
/**
* This file contains template for "feature" list screen.
*
* @package    use_module
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="index.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_modules", "{$pageRef}");
			}
		);
	</script>

	<div id="list_modules" class="box-header block-adm block-modules" title="{#Title_module#}" box-id="modules" box-model="box-model">			
	</div>
	
{/block}
