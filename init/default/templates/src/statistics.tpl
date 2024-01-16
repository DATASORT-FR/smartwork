{$LeftSideDisplay = 0}
{extends file="templateMain.tpl"}

{block name=Content}
	{$PageBlock|default:''}
	<div class="block-ws content-update block-main" box-id="content" box-model="box-model" link_href="">
		<h2>{#Lbl_visitors_by_day#}</h2>
		<form id="byday-form" >
			<div class="row form-group">
				<div class="col-sm-6 form-group">
					<label id="explorationdays-label" class="col-lg-4 col-sm-6">
						{#Lbl_statistics_explorations#}
					</label>
					<div id="explorationdays-input" class="select-input col-lg-8 col-sm-6">
						<select id="explorationdays-type" class="select-type form-control form-select" name="exploration" rows="10">
							<option value="3" class="select-item explorationday-item">{#Lbl_statistics_explorations_3days#}</option>
							<option value="7" class="select-item explorationday-item" selected>{#Lbl_statistics_explorations_7days#}</option>
							<option value="14" class="select-item explorationday-item">{#Lbl_statistics_explorations_14days#}</option>
							<option value="28" class="select-item explorationday-item">{#Lbl_statistics_explorations_28days#}</option>
							<option value="60" class="select-item explorationsite-item">{#Lbl_statistics_explorations_2months#}</option>
						</select>
					</div>
				</div>
			</div>
			<div class="text-center">
				<canvas id="graphic-days" ></canvas>
			</div>
		</form>
		<br>
		<h2>{#Lbl_visitors_today#}</h2>
		<div class="row form-group">
			<div class="col-sm-12 form-group">
				<label>{#Lbl_number_visitors_today#} <strong id="number-today"></strong></label>
			</div>
		</div>
		<div class="text-center row form-group">
			<canvas id="graphic-today" ></canvas>
		</div>

		<br>
		<h2>{#Lbl_urls_by_day#}</h2>
		<form id="urls-byday-form" action="{$exportLink|default:''}" method="POST" target="_self">
			<div class="row form-group">
				<div class="col-sm-6 form-group">
					<label id="explorationdays-url-label" class="col-lg-4 col-sm-6">
						{#Lbl_statistics_explorations#}
					</label>
					<div id="explorationdays-url-input" class="select-input col-lg-8 col-sm-6">
						<select id="explorationdays-url-type" class="select-type form-control form-select" name="exploration" rows="10">
							<option value="1" class="select-item explorationday-item">{#Lbl_statistics_explorations_1day#}</option>
							<option value="3" class="select-item explorationday-item">{#Lbl_statistics_explorations_3days#}</option>
							<option value="7" class="select-item explorationday-item" selected>{#Lbl_statistics_explorations_7days#}</option>
							<option value="14" class="select-item explorationday-item">{#Lbl_statistics_explorations_14days#}</option>
							<option value="28" class="select-item explorationday-item">{#Lbl_statistics_explorations_28days#}</option>
							<option value="60" class="select-item explorationsite-item">{#Lbl_statistics_explorations_2months#}</option>
						</select>
					</div>
				</div>
				<div class="col-sm-6 form-group">
					<input class="btn btn-primary export" type="submit" value="Export Data">
				</diV>
			</div>
		</form>
		<div class="text-center row form-group">
			<table id="urls-days" class="table table-responsive table-bordered table-striped table-sm text-left">
				<thead class="thead-default">
					<tr>
						<th class="urls-page" width="20%">{#Lbl_urls_page#}</th>
						<th class="urls-url" width="70%">{#Lbl_urls_url#}</th>
						<th class="urls-count" width="10%">{#Lbl_urls_count#}</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
	<script>
		$(document).ready(
			function() {
				
					var chartSite;
					var chartDay;
					var chartToday;
					
					function getStatByDay() {
						$.ajax({
							url: '{$StatByDayHref}',
							type : 'POST',
							data : $("#byday-form").serialize(),
							success: function(chartData) {
								var chartCanvas = $('#graphic-days');
								var chartTitle = '';
								if (chartDay !== undefined) {
									chartDay.destroy();
								}
								chartDay=graphicLine(chartCanvas, chartTitle, chartData, window.chartColors.gossamer, 'date', 'count');
							}
						});
					}
				
					function getStatToday() {
						$.ajax({
							url: '{$StatTodayHref}',
							type : 'POST',
							success: function(chartData) {
								var blockNbToday = $('#number-today');
								var nbItems = chartData.length;
								var chartCanvas = $('#graphic-today');
								var chartTitle = '';
								var nbToday = 0;
								if (chartToday !== undefined) {
									chartToday.destroy();
								}
								chartToday=graphicLine(chartCanvas, chartTitle, chartData, window.chartColors.gossamer, 'date', 'count');
								for(var i=0; i<nbItems; i++) {
									nbToday = nbToday + chartData[i]['count'];
								}
								blockNbToday.html(nbToday);
							}
						});
					}
					
					function getUrlsByDay() {
						$.ajax({
							url: '{$UrlsByDayHref|default:''}',
							type : 'POST',
							data : $("#urls-byday-form").serialize(),
							success: function(chartData) {
								var nbItems = chartData.length;
								var blockTable = $('#urls-days');
								var blockTbody = $('#urls-days tbody');
								var line = '';
								blockTbody.html('');
								
								for(var i=0; i<nbItems; i++) {
									line_txt = "<td class='urls-page' width='20%'>"
										+ chartData[i]['page']
										+ "</td>"
										+ "<td class='urls-url' width='70%'>"
										+ chartData[i]['url']
										+ "</td>"
										+ "<td class='urls-count' width='10%'>"
										+ chartData[i]['count']
										+ "</td>";

									line = $("<tr>").html(line_txt);
									blockTbody.append(line);
								}
							}
						});
					}
				
					getStatByDay();
					getStatToday();
					getUrlsByDay();
					
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
					
					$("#explorationdays-url-type").on({
						change : function(e) {
								e.preventDefault();
								getUrlsByDay();
							},
						keypress : function(e) {
								if (e.key == 'Enter') {
									e.preventDefault();
									getUrlsByDay();
								}
							}
						}
					);
				
			}
		);
	</script>
{/block}


