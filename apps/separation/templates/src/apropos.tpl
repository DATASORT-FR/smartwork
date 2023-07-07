{extends file="standard.tpl"}

{block name=Main}
   <section>
		<div class="container mt-5">
			{$contentBlock|default:''}
		</div>
    </section>
{/block}
