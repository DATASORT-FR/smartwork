{extends file="standard.tpl"}

{block name=Main}
   <section>
		<div class="container mt-5 mb-5">
			{$contentBlock|default:''}
			<div class="row text-center">
				<a class="btn btn-tool col-sm-6 mx-auto text-center" href="{$LinkOutil|default:''}">
					<h2>Cliquez pour commencer</h2>
				</a>
			</div>
		</div>
    </section>
{/block}
