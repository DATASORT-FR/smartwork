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
				init_ws("#list_nodes", "{$pageRef}");
			}
		);
	</script>

	<div id="list_nodes" class="box-header block-adm block-node_list" title="{#Title_node#}" box-id="nodes" box-model="box-model">
	</div>
		
{/block}
