<?php 
/**
* This file contains template for "content management" screen.
*
* @package    use_content
* @subpackage view
* @version    1.0
* @date       26 May 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list-contents", "{$pageRef}");
			}
		);
	</script>

	<div id="list-contents" class="box-header block-adm block-diagram block-content-list" title="{#Title_content#}" box-id="contents" box-model="box-model">
	</div>
		
{/block}
