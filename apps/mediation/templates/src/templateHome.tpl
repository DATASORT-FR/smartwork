{$RightSideDisplay = 1}
{extends file="standard.tpl"}

{block name=Main}
	{block name=Content}
	{/block}
{/block}

{block name=RightSide}
	{$EngageBlock}
	{if $pageRightUpdate == 1}
		{$StatisticsBlock}
	{/if}
{/block}


