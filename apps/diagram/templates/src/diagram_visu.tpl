<svg class="node-doc" width="100%" viewbox="0 0 1500 650" diagramid="{$diagramId}" diagramname="{$diagramName}" diagramtype="{$diagramType}" nodeselected="{$nodeSelected}" hierarchy="{$pageHierarchy}" visu="{$pageVisu}" save="{$pageSave}" xmlns="http://www.w3.org/2000/svg" version="1.1">
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
<script>	
	$(document).ready(
		function() {
			getNodesVisu();
		}
	);
</script> 
