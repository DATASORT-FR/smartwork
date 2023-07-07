<?php 
/**
* This file contains template for "group" list screen.
*
* @package    use_group
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
				init_ws("#list_groups", "{$page_ref}");
			}
		);
	</script>

	<div id="list_groups" class="box-header block-adm block-group_list" title="{#Title_group#}" box-id="groups" box-model="box-model">			
	</div>
	
{/block}
