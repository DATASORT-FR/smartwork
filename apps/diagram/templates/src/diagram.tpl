{extends file="alone.tpl"}

{block name=Main}
	<script src="{$visuJs}"></script>
	<div id="diagram" class="box-header block-adm design block-diagram-visu">
		<svg class="node-doc" width="100%" viewbox="0 0 1050 650" diagramid="{$diagramId}" visu="{$pageVisu}" xmlns="http://www.w3.org/2000/svg" version="1.1">
			<defs>
				<filter id="shadow">
					<feGaussianBlur in="SourceAlpha" stdDeviation="1.5" result="flou"/>
					<feOffset in="flou" dx="3" dy="3" result="flouDecale"/>
					<feMerge>
						<feMergeNode in="flouDecale"/>
						<feMergeNode in="SourceGraphic"/>
					</feMerge>
				</filter>
			</defs>
		</svg>
		<div class="node-visu block-ws block-main col-md-12 col-sm-12">
		</div>
	</div>	
		<script>	
			$(document).ready(
				function() {
					getNodesVisu("{$pageHierarchy}");
				}
			);			
		</script> 
{/block}
