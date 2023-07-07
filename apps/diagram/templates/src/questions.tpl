<?php 
/**
* This file contains template for "question management" screen.
*
* @package    use_question
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list-questions", "{$pageRef}");
			}
		);
	</script>

	<div id="list-questions" class="box-header block-adm block-diagram block-question-list" title="{#Title_question#}" box-id="questions" box-model="box-model">
	</div>
		
{/block}
