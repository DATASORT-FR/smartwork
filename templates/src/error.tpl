{extends file="standard.tpl"}

{block name=Header_Right}
	{$IncConnect}
{/block}
{block name=Main}
	<div class="alert alert-warning">
		<p><strong>Warning!</strong> {#Error_page#}</p>
	</div>
	{$IncApps}
{/block}
