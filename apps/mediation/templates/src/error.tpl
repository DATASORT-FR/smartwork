{extends file="templateMain.tpl"}

{block name=Main}
	<div class="alert alert-warning">
		<p><strong>Warning!</strong> {#Error_page#}</p>
	</div>
	<div class="card">
		<div class="card-header p-b-0">
			<h2 class="card-title"><i class="fa fa-briefcase fa-white" aria-hidden="true"></i>{#Txt_last_offers#}</h2>
		</div>
		<div class="card-body">
			{$line = 0}
			{section name=idx loop=$ArticleList}
				<div class="row">
					<article class="col-xs-12">
						<h3><a href="{$ArticleList[idx].href}">{$ArticleList[idx].title}</a></h3>
						<p>{$ArticleList[idx].intro}</p>
					</article>
				</div>
			{/section}
		</div>
	</div>
	
{/block}
