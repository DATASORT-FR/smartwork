{$LeftSideDisplay = 0}
{$RightSideDisplay = 0}
{extends file="standard.tpl"}

{block name=Main}
	<article id="article" class="article row block-ws block-main" box-id="article" box-model="box-model" link_href="{$ArticleLink}" itemscope itemtype="http://schema.org/ArticlePosting">

		{include file='article_detail.tpl'}

	</article>
{/block}

     
