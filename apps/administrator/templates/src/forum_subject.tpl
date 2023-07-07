<?php 
/**
* This file contains template for forum subjects list screen.
*
* @package    use_forum
* @subpackage view
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="index.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#list_subjects", "{$pageRef}");
			}
		);
	</script>

	<div id="list_subjects" class="box-header block-adm block-subject_list" title="{#Title_forum_subject#}" box-id="subjects" box-model="box-model">
	</div>
		
{/block}
