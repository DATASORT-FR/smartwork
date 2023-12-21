{extends file="templateMain.tpl"}

{block name=Main}
   <section>
		<div class="container">
			{$contentBlock|default:''}
		</div>
		<div class="container">
			{$IncAccount}
		</div>
    </section>
{/block}
