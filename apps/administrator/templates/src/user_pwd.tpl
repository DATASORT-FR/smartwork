<?php 
/**
* This file contains template for "module" list screen.
*
* @package    use_user
* @subpackage view
* @version    1.0
* @date       19 Juillet 2016
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="index.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#user_pwd", "{$page_ref}");
			}
		);
	</script>

	<div id="user_pwd" class="box-header block-adm block-user_pwd" title="{#Title_user_pwd#}" box-id="user_pwd" box-model="box-model">			
	</div>
{/block}
