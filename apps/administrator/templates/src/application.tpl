<?php 
/**
* This file contains template for "application" list screen.
*
* @package    use_application
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
				init_ws("#list_applications", "{$page_ref}");
			}
		);
	</script>

	<div id="list_applications" class="box-header block-adm block-application_list" title="{#Title_application#}" box-id="applications" box-model="box-model">
	</div>
		
{/block}
