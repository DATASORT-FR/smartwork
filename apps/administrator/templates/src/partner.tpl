<?php 
/**
* This file contains template for "module" list screen.
*
* @package    use_company
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
				init_ws("#list_partners", "{$page_ref}");
			}
		);
	</script>

	<div id="list_partners" class="box-header block-adm block-partner_list" title="{#Title_partner#}" box-id="partners" box-model="box-model">			
	</div>
	
{/block}
