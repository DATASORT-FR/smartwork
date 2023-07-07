{extends file="templateMain.tpl"}

{block name=Content}
	{$PageBlock}
	<div class="row content_btn">
		<a class="btn btn-primary" href="{$ListLink}">
			{#Txt_Offers_Link#}
		</a>
	</div>
	<div class="card list_article">
		<div class="card-header p-b-0">
			<h2 class="card-title"><i class="fa fa-briefcase fa-white" aria-hidden="true"></i>{#Txt_last_offers#} : {$Param1}</h2>
		</div>
		<div class="card-body">
			{$line = 0}
			{section name=idx loop=$jobList}
				<div class="row">
					<article class="col-xs-12">
						<h3><a href="{$jobList[idx].href}">{$jobList[idx].title}</a></h3>
						<p>{$jobList[idx].intro}</p>
					</article>
				</div>
			{/section}
		</div>
	</div>
{/block}
