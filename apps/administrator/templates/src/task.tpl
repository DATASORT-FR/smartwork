<?php 
/**
* This file contains template for "application import" list screen.
*
* @package    use_application_import
* @subpackage view
* @version    1.0
* @date       27 July 2023
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="index.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_imports", "{$page_ref}");
			}
		);
	</script>

	<div id="list_imports" class="box-header block-adm block-import_list" title="{#Title_import#}" box-id="imports" box-model="box-model">
	</div>
		
{/block}
