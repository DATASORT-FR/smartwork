{extends file="standard.tpl"}

{block name=Main}
<script src="{$visuJs}"></script>
	<script>
		$(document).ready(
			function() {
				init_ws("#diagram", "{$pageRef}" + "?id=" + $("#select-diagram").val());
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
			<h1>{#Title_visualisation_diagrams#}</h1>
		</header>
		<div class="row crud form-group">
			<label for="select-diagram" class="col-md-1 col-sm-2 col-form-label">{#Label_visualisation_diagrams#}</label>
			<div class="col-md-11 col-sm-10">
				<select id="select-diagram" class="form-control form-select select-diagram">
					{section name=idy loop=$listDiagram}
						{if $listDiagram[idy].id == $diagramSelected}
							<option value="{$listDiagram[idy].id}" selected>{$listDiagram[idy].description}</option>  
						{else}
							<option value="{$listDiagram[idy].id}">{$listDiagram[idy].description}</option>  
						{/if}
					{/section}
				</select>
			</div>
		</div>
		<div id="diagram" class="box-header block-adm design block-diagram-visu">
		</div>	
	</div>	
{/block}
