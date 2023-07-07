<header class="page-header">
	<h1>{#Title_crud_edit#} {$diagramCode}</h1>
</header>
<svg class="node-doc" width="100%" viewbox="0 0 1450 650" diagramid="{$diagramId}" hierarchy="{$pageHierarchy}" create="{$pageCreate}" edit="{$pageEdit}" edit-link="{$pageEditLink}" delete="{$pageDelete}" action="{$pageAction}" titledelete="{$titleDelete}" labeldelete="{$labelDelete}" xmlns="http://www.w3.org/2000/svg" version="1.1">
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
	<script>	
		$(document).ready(
			function() {
				getNodesAdmin();
			}
		);
				
	</script> 
