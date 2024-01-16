{$LeftSideDisplay = 1}
{$RightSideDisplay = 1}
{extends file="standard.tpl"}

{block name=LeftSide}
	{$ArticleSideBlock}
	{$FilesSideBlock}
{/block}

{block name=Main}
	{block name=Content}
	{/block}
{/block}

{block name=RightSide}
	{$ContentsSideBlock}
<!--	
	{$CarousselBlock}
-->
{/block}


