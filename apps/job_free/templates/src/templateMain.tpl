{$LeftSideDisplay = 1}
{$RightSideDisplay = 1}
{extends file="standard.tpl"}

{block name=LeftSide}
	{$EngageBlock}
<!--	
	{$CompaniesBlock}
-->
	{$JobnameSideBlock}
{/block}

{block name=Main}
	{block name=Content}
	{/block}
{/block}

{block name=RightSide}
	{$LoginBlock}
	{$StatisticsBlock}
	{$ContentSideBlock}
<!--	
	{$CarousselBlock}
-->
{/block}


