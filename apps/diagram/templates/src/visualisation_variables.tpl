{extends file="standard.tpl"}

{block name=Main}
	<script src="{$visuJs}"></script>
	<script>
		$(document).ready(
			function() {
				init_ws("#diagram", "{$pageRef}" + "?id=" + {$domainId});
			}
		);
	</script>

	<div id="visu-diagrams" class="box-header block-adm block-diagram" box-id="diagrams" box-model="box-model">
			<header class="page-header">
				<h1>{#Title_visualisation_variables#}</h1>
			</header>
		<div id="diagram" class="box-header block-adm design block-diagram-variable">
		</div>
	</div>
{/block}
