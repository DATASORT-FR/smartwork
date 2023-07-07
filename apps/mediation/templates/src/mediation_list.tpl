{$LeftSideDisplay = 0}
{extends file="templateMain.tpl"}

{block name=Main}
	{$PageBlock}
	<div id="articles-list" class="articles-list block-ws content-update block-main" box-id="content" box-model="box-model" link_href="{$articlesLink}">
		{include file='list_detail.tpl'}
	</div>
{/block}

{block name=Content}
{/block}

