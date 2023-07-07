<?php 
/**
* This file contains template for "diagram visualisation' screen.
*
* @package    use_diagram
* @subpackage view
* @version    1.0
* @date       25 Februar 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="standard.tpl"}

{block name=Main}
	<script src="{$visuJs}"></script>
	<script>
		$(document).ready(
			function() {
				init_ws("#diagram", "{$pageRef}");
				$("#select-diagram").on({				
					change : function(e) {
						e.preventDefault();
						windowSize = 0;
						init_ws("#diagram", "{$pageRef}" + "?id=" + $("#select-diagram").val());
					}
				});
			}
		);
						
	</script>

	<div id="visu-diagrams" class="box-header block-adm block-diagram" box-id="diagrams" box-model="box-model">
			<header class="page-header">
				<h1>{#Title_diagram#}</h1>
			</header>
		<div class="row crud form-group">
			<label for="select-diagram" class="col-md-1 col-sm-2 col-form-label">{#Label_diagram#}</label>
			<div class="col-md-11 col-sm-10">
				<select id="select-diagram" class="form-control select-diagram">
					{section name=idy loop=$listDiagram}
						<option value="{$listDiagram[idy].id}">{$listDiagram[idy].description}</option>  
					{/section}
				</select>
			</div>
		</div>
		<div id="diagram" class="box-header block-adm design block-diagram-visu">
		</div>	
	</div>	
{/block}
