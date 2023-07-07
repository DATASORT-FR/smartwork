{extends file="standard.tpl"}

{block name=Main}
   <section>
		<div class="container mt-5 mb-4">
			{$contentBlock|default:''}
		</div>
		<div class="container mb-5">
 			{$listBlock|default:''}
		</div>
    </section>
 {/block}
