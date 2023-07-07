<?php 
/**
* This file contains template for "nodes" list screen.
*
* @package    use_nodes
* @subpackage view
* @version    1.0
* @date       11 octobre 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_links", "{$pageRef}");
			}
		);
	</script>

	<div id="list_links" class="box-header block-adm block-link_list" title="{#Title_link#}" box-id="links" box-model="box-model">
	</div>
		
{/block}
