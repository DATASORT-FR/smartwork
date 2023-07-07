{$LeftSideDisplay = 0}
{$RightSideDisplay = 0}
{extends file="templateHome.tpl"}

{block name=Main}
	<script>
		$(document).ready(
			function() {
				init_ws("#diagram", "{$pageRef}");
			}
		);
	</script>

	<div id="diagram" class="design block-ws" edit="{$pageEdit}" delete="{$pageDelete}" title="{$titleDelete}" label="{$labelDelete}">
	</div>	
{/block}

