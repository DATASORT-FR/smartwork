	<div class="card card-statistics">
		<div class="card-header p-b-0">
			<h2 class="card-title"><i class="fa fa-tachometer fa-white" aria-hidden="true"></i>{#Txt_title_statistics#}</h2>
		</div>
		<a class="" href="{$statisticsHref}">
			<div class="card-body">
				<div class="text-sm-center">{#Txt_offers_number#}</div>
				<div class="text-sm-center"><strong>{$numberOffers}</strong></div>
				<br>
				<div class="text-sm-center" id="progress-caption-1">{#Txt_actives_offers#}</div>
				<div class="progress">
					<div class="progress-bar bg-success" role="progressbar" style="width: {$pctActivesOffers}%;" aria-valuenow="{$pctActivesOffers}" aria-valuemin="0" aria-valuemax="100">{$pctActivesOffers}%</div>
				</div>
				<br>
				<div class="text-sm-center" id="progress-caption-2">{#Txt_consulted_offers#}</div>
				<div class="progress">
					<div class="progress-bar bg-success" role="progressbar" style="width: {$pctConsultedOffers}%;" aria-valuenow="{$pctConsultedOffers}" aria-valuemin="0" aria-valuemax="100">{$pctConsultedOffers}%</div>
				</div>
			</div>
		</a>
	</div>
