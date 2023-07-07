<?php 
/**
* This file contains template for "module" list screen.
*
* @package    use_user
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
				init_ws("#list_users", "{$page_ref}");
			}
		);
	</script>

	<div id="list_users" class="box-header block-adm block-user_list" title="{#Title_user#}" box-id="users" box-model="box-model">			
	</div>
	
{/block}
