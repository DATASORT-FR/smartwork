<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:40:17
  from 'E:\xampp\htdocs\smartwork\apps\separation\templates\src\data_statistics.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451de12ceaa8_89800766',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '20d0c64c96b72eaf746fb685cea3e0a85aa3b4fc' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\templates\\src\\data_statistics.tpl',
      1 => 1659524941,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451de12ceaa8_89800766 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_72066890663451de12c1322_33451538', 'Main');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_72066890663451de12c1322_33451538 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_72066890663451de12c1322_33451538',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="container">
		<div class="block-ws content-update block-main" box-id="content" box-model="box-model" link_href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['content_linkList']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
			<h2><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_visitors_by_day');?>
</h2>
			<form id="byday-form">
				<div class="row form-group">
					<div class="col-sm-6 form-group">
						<label id="explorationdays-label" class="col-lg-4 col-sm-6">
							<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations');?>

						</label>
						<div id="explorationdays-input" class="select-input col-lg-8 col-sm-6">
							<select id="explorationdays-type" class="select-type form-control form-select" name="exploration" rows="10">
								<option value="3" class="select-item explorationday-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_3days');?>
</option>
								<option value="7" class="select-item explorationday-item" selected><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_7days');?>
</option>
								<option value="14" class="select-item explorationday-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_14days');?>
</option>
								<option value="28" class="select-item explorationday-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_28days');?>
</option>
								<option value="60" class="select-item explorationsite-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_2months');?>
</option>
							</select>
						</div>
					</div>
				</div>
				<div class="text-center row form-group">
					<canvas id="graphic-days" ></canvas>
				</div>
			</form>
			<br>
			<h2><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_visitors_today');?>
</h2>
			<div class="row form-group">
				<div class="col-sm-12 form-group">
					<label><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_number_visitors_today');?>
 <strong id="number-today"></strong></label>
				</div>
			</div>
			<div class="text-center row form-group">
				<canvas id="graphic-today" ></canvas>
			</div>
			<br>
			<h2><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_urls_by_day');?>
</h2>
			<form id="urls-byday-form" action="<?php echo (($tmp = $_smarty_tpl->tpl_vars['exportLink']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" method="POST" target="_self">
				<div class="row form-group">
					<div class="col-sm-6 form-group">
						<label id="explorationdays-url-label" class="col-lg-4 col-sm-6">
							<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations');?>

						</label>
						<div id="explorationdays-url-input" class="select-input col-lg-8 col-sm-6">
							<select id="explorationdays-url-type" class="select-type form-control form-select" name="exploration" rows="10">
								<option value="1" class="select-item explorationday-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_1day');?>
</option>
								<option value="3" class="select-item explorationday-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_3days');?>
</option>
								<option value="7" class="select-item explorationday-item" selected><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_7days');?>
</option>
								<option value="14" class="select-item explorationday-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_14days');?>
</option>
								<option value="28" class="select-item explorationday-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_28days');?>
</option>
								<option value="60" class="select-item explorationsite-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_statistics_explorations_2months');?>
</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6 form-group">
						<input class="link-btn export" type="submit" value="Export Data">
					</diV>
				</div>
			</form>
			<div class="text-center row form-group">
				<table id="urls-days" class="table table-responsive table-bordered table-striped table-sm text-left">
					<thead class="thead-default">
						<tr>
							<th class="urls-page" width="20%"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_urls_page');?>
</th>
							<th class="urls-url" width="70%"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_urls_url');?>
</th>
							<th class="urls-count" width="10%"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_urls_count');?>
</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				
				var chartSite;
				var chartDay;
				var chartToday;
					
				function getStatByDay() {
					$.ajax({
						url: '<?php echo (($tmp = $_smarty_tpl->tpl_vars['StatByDayHref']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
',
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
						url: '<?php echo (($tmp = $_smarty_tpl->tpl_vars['StatTodayHref']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
',
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
						url: '<?php echo (($tmp = $_smarty_tpl->tpl_vars['UrlsByDayHref']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
',
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

		
	<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'Main'} */
}
