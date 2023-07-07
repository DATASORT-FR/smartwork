{extends file="standard.tpl"}

{block name=Main}
   <section>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					{$contentBlock|default:''}
				</div>
			</div>
		</div>
   </section>
{/block}
