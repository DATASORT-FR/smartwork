<?php 
/**
* This file contains template for "feature" list screen.
*
* @package    use_feature
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
				init_ws("#list_features", "{$pageRef}");
			}
		);
	</script>

	<div id="list_features" class="box-header block-adm block-features" title="{#Title_feature#}" box-id="features" box-model="box-model">			
	</div>
	
{/block}
