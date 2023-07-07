{extends file="standard.tpl"}

{block name=Main}
   <section>
		<div class="container forum-content">
			{$contentBlock|default:''}
		</div>
		<div class="container mb-5">
			{$IncAccount}
		</div>
    </section>
{/block}
