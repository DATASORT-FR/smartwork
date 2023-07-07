<?php 
/**
* This file contains template for "domain management" screen.
*
* @package    use_domain
* @subpackage view
* @version    1.0
* @date       20 februar 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list-domains", "{$pageRef}");
			}
		);
	</script>

	<div id="list-domains" class="box-header block-adm block-diagram block-domain-list" title="{#Title_domain#}" box-id="domains" box-model="box-model">
	</div>
		
{/block}
