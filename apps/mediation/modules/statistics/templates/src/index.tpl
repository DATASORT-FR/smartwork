	<div class="card">
		<div class="card-header p-b-0">
			<h2 class="card-title"><i class="fa fa-tachometer fa-white" aria-hidden="true"></i>{#Txt_title_statistics#}</h2>
		</div>
		<div class="card-body">
            <div class="text-xs-center">{#Txt_articles_number#} <strong>{$numberArticles}</strong></div>
			<br>
			
			<div class="text-xs-center" id="progress-caption-1">{#Txt_actives_articles#} {$pctActivesArticles}%</div>
            <progress class="progress progress-success" value="{$pctActivesArticles}" max="100" aria-describedby="progress-caption-1"></progress>
			
            <div class="text-xs-center" id="progress-caption-2">{#Txt_consulted_articles#} {$pctConsultedArticles}%</div>
            <progress class="progress progress-info" value="{$pctConsultedArticles}" max="100" aria-describedby="progress-caption-2"></progress>
			
<!--
            <div class="text-xs-center" id="progress-caption-3">Portalled &hellip; 45%</div>
            <progress class="progress progress-warning" value="45" max="100" aria-describedby="progress-caption-3"></progress>
			
            <div class="text-xs-center" id="progress-caption-4">Done &hellip; 35%</div>
            <progress class="progress progress-danger" value="35" max="100" aria-describedby="progress-caption-4"></progress>
-->			
		</div>
	</div>

