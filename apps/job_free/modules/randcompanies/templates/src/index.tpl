<div class="card">
	<div class="card-header p-b-0">
		<h2 class="card-title"><i class="fa fa-random fa-white" aria-hidden="true"></i>{#Txt_title_random_companies#}</h2>
	</div>
	<div class="list-group list-group-flush">
		{section name=idx loop=$CompaniesList}
			<a href="{$CompaniesList[idx].href}" class="list-group-item list-group-item-action">{$CompaniesList[idx].name}</a>
		{/section}
	</div>
	<div class="card-body">
		<div class="content_btn">
			<a class="btn btn-secondary" href="{$CompaniesHref}">{#Txt_bt_random_companies#}</a>
		</div>
	</div>
</div>
