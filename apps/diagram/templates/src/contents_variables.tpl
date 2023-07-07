<?php 
/**
* This file contains template for "variables contents management" screen.
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
				init_ws("#list-contents-variables", "{$pageRef}");
			}
		);
	</script>

	<div id="list-contents-variables" class="box-header block-adm block-diagram block-content-variables-list" title="{#Title_content_variables#}" box-id="contents-variables" box-model="box-model">
	</div>
		
{/block}
