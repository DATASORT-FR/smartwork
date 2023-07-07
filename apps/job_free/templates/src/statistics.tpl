{$LeftSideDisplay = 0}
{extends file="templateMain.tpl"}

{block name=Content}
	{$PageBlock}
	<div class="block-ws content-update block-main" box-id="content" box-model="box-model" link_href="">

		<h2>{#Lbl_statistics_job_name#}</h2>
		<div class="text-center">
			<canvas id="graphic-jobname" ></canvas>
		</div>
		
		<h2>{#Lbl_statistics_job_object#}</h2>
		<div class="text-center">
			<canvas id="graphic-jobobject" ></canvas>
		</div>
		
		{if $pageRightUpdate == 1}
			<h2>{#Lbl_statistics_by_site_source#}</h2>
			<form id="bysite-form" >
				<div class="row form-group">
					<label id="explorationsites-label" class="col-lg-2 col-sm-6">
						{#Lbl_statistics_explorations#}
					</label>
					<div id="explorationsites-input" class="select-input col-lg-4 col-sm-6">
						<select id="explorationsites-type" class="select-type form-control" name="exploration" rows="10">
							<option value="7" class="select-item explorationsite-item">{#Lbl_statistics_explorations_7days#}</option>
							<option value="14" class="select-item explorationsite-item" selected>{#Lbl_statistics_explorations_14days#}</option>
							<option value="28" class="select-item explorationsite-item">{#Lbl_statistics_explorations_28days#}</option>
							<option value="60" class="select-item explorationsite-item">{#Lbl_statistics_explorations_2months#}</option>
						</select>
					</div>
				</div>
				<div class="text-center">
					<canvas id="graphic-sitesource" ></canvas>
				</div>
			</form>
			
			<h2>{#Lbl_statistics_by_day#}</h2>
			<form id="byday-form" >
				<div class="row form-group">
					<label id="sitesources-label" class="col-lg-2 col-sm-4">
						{#Lbl_statistics_site_source#}
					</label>
					<div id="sitesources-input" class="select-input col-lg-4 col-sm-8">
						<select id="sitesources-type" class="select-type form-control" name="sitesource" rows="10">
							<option value="" class="select-item sitesource-item"> </option>
						</select>
					</div>
					<label id="explorationdays-label" class="col-lg-2 col-sm-4">
						{#Lbl_statistics_explorations#}
					</label>
					<div id="explorationdays-input" class="select-input col-lg-4 col-sm-8">
						<select id="explorationdays-type" class="select-type form-control" name="exploration" rows="10">
							<option value="3" class="select-item explorationday-item">{#Lbl_statistics_explorations_3days#}</option>
							<option value="7" class="select-item explorationday-item" selected>{#Lbl_statistics_explorations_7days#}</option>
							<option value="14" class="select-item explorationday-item">{#Lbl_statistics_explorations_14days#}</option>
							<option value="28" class="select-item explorationday-item">{#Lbl_statistics_explorations_28days#}</option>
							<option value="60" class="select-item explorationsite-item">{#Lbl_statistics_explorations_2months#}</option>
						</select>
					</div>
				</div>
				<div class="text-center">
					<canvas id="graphic-day" ></canvas>
				</div>
			</form>
		{/if}
	</div>
	<script>
		$(document).ready(
			function() {

				function getStatByJobNames() {
					$.ajax({
						url: '{$StatByJobNamesHref}',
						success: function(chartData) {
							var chartCanvas = $('#graphic-jobname');
							var chartTitle = '';
							graphicBarHorizontal(chartCanvas, chartTitle, chartData, 20, window.chartColors.gossamer, 'group', 'count')
						}
					});
				}
				
				getStatByJobNames();
				
				function getStatByJobObjects() {
					$.ajax({
						url: '{$StatByJobObjectsHref}',
						success: function(chartData) {
							var chartCanvas = $('#graphic-jobobject');
							var chartTitle = '';
							graphicBarHorizontal(chartCanvas, chartTitle, chartData, 20, window.chartColors.gossamer, 'group', 'count')
						}
					});
				}
				
				getStatByJobObjects();
				
				{if $pageRightUpdate == 1}
				
					var chartSite;
					var chartDay;
					
					// Update siteSource list
					function getSiteSources() {
						$.ajax({
							url: '{$SiteSourcesHref}',
							success: function(data) {
								siteSources = data;
								var $selectSiteSources = $('#sitesources-type');
								for(var key in siteSources) {
									$selectSiteSources.append('<option value="' + siteSources[key] + '" class="sitesource-item">' + siteSources[key] + '</option>');
								}
							}
						});
					}
				
					function getStatBySiteSources() {
						$.ajax({
							url: '{$StatBySiteSourcesHref}',
							type : 'POST',
							data : $("#bysite-form").serialize(),
							success: function(chartData) {
								var chartCanvas = $('#graphic-sitesource');
								var chartTitle = '';
								if (chartSite !== undefined) {
									chartSite.destroy();
								}
								chartSite=graphicBarHorizontal(chartCanvas, chartTitle, chartData, 0, window.chartColors.gossamer, 'group', 'count')
							}
						});
					}
					
					function getStatByDay() {
						$.ajax({
							url: '{$StatByDayHref}',
							type : 'POST',
							data : $("#byday-form").serialize(),
							success: function(chartData) {
								var chartCanvas = $('#graphic-day');
								var chartTitle = '';
								if (chartDay !== undefined) {
									chartDay.destroy();
								}
								chartDay=graphicLine(chartCanvas, chartTitle, chartData, window.chartColors.gossamer, 'date', 'count');
							}
						});
					}
										
					getSiteSources();
				
					getStatBySiteSources();
					getStatByDay();
					
					$("#explorationsites-type").on({
						change : function(e) {
								e.preventDefault();
								getStatBySiteSources();
							},
						keypress : function(e) {
								if (e.key == 'Enter') {
									e.preventDefault();
									getStatBySiteSources();
								}
							}
						}
					);

					$("#sitesources-type").on({
						change : function(e) {
								e.preventDefault();
								getStatByDay();
							},
						keypress : function(e) {
								if (e.key == 'Enter') {
									e.preventDefault();
									getStatByDay();
								}
							}
						}
					);
					
					$("#explorationdays-type").on({
						change : function(e) {
								e.preventDefault();
								getStatByDay();
							},
						keypress : function(e) {
								if (e.key == 'Enter') {
									e.preventDefault();
									getStatByDay();
								}
							}
						}
					);
					
				{/if}
				
			}
		);

		
	</script>
{/block}


