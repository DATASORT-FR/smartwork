<?php 
/**
* This file contains template for "module" list screen.
*
* @package    use_application
* @subpackage view
* @version    1.0
* @date       4 April 2020
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="index.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#application_copy", "{$page_ref}");
			}
		);
	</script>

	<div id="application_copy" class="box-header block-adm block-application_copy" title="{#Title_user_pwd#}" box-id="application_copy" box-model="box-model">			
	</div>
{/block}
