<?php 
/**
* This file contains template for "menu" list screen.
*
* @package    use_menu
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
				init_ws("#list_menus", "{$page_ref}");
			}
		);
	</script>

	<div id="list_menus" class="box-header block-adm block-menu_list" title="{#Title_menu#}" box-id="menus" box-model="box-model">			
	</div>
	
{/block}
