<?php 
/**
* This file contains template for "diagram management" screen.
*
* @package    use_diagram
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list-diagrams", "{$pageRef}");
			}
		);
	</script>

	<div id="list-diagrams" class="box-header block-adm block-diagram block-diagram-list" title="{#Title_diagram#}" box-id="diagrams" box-model="box-model">
	</div>
		
{/block}
