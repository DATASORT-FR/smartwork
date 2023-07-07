<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:54:18
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\offres-missions-freelance.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa261af00753_23336805',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57cfe5757dbb88c38ca307d611514cd4861b125f' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\offres-missions-freelance.tpl',
      1 => 1646228807,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aa261af00753_23336805 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
$_smarty_tpl->_assignInScope('LeftSideDisplay', 0);?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_57985193863aa261aef91c3_07657441', 'Main');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "templateSearch.tpl");
}
/* {block 'Main'} */
class Block_57985193863aa261aef91c3_07657441 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_57985193863aa261aef91c3_07657441',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-8 order-lg-2">
		<?php echo $_smarty_tpl->tpl_vars['PageBlock']->value;?>

		<div class="row ">
			<form id="search-form" class="col-sm-8 form-inline" method="post" action="<?php echo $_smarty_tpl->tpl_vars['OffersHref']->value;?>
">
				<input  id="tags-id" name="tags" class="form-control" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['TagsValue']->value;?>
">
				<input  id="jobnames-id" name="jobnames" class="form-control" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['JobNamesValue']->value;?>
">
				<input  id="scores-id" name="scores" class="form-control" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ScoresValue']->value;?>
">
				<input  id="prices-id" name="prices" class="form-control" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['PricesValue']->value;?>
">
				<input  id="countries-id" name="countries" class="form-control" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['CountriesValue']->value;?>
">
				<input  id="locations-id" name="locations" class="form-control" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['LocationsValue']->value;?>
">
				<div class="input-group">
					<input  id="search-id" name="search" class="form-control" type="text" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_offers_search_placeholder');?>
" size="50" value="<?php echo $_smarty_tpl->tpl_vars['SearchValue']->value;?>
">
					<span class="input-group-btn">
						<button id="resetBtnSmall-id" class="btn btn-primary input-group-addon btn-reset btn-small hidden-md-up" type="submit">
							<span class="fa fa-eraser" aria-hidden="true"></span>
						</button>
						<button id="searchBtn-id" class="btn btn-primary input-group-addon btn-search" type="submit">
							<span class="fa fa-search" aria-hidden="true"></span>
						</button>						
					</span>
				</div>
			</form>
			<div class="col-sm-4">
				<button id="resetBtn-id" class="btn btn-primary btn-reset pull-right hidden-md-down" type="submit">
					<span class="fa fa-eraser" aria-hidden="true"></span>Reset
				</button>
			</div>
		</div>
			
		<div id="offers-list" class="block-main">
		</div>
	</div>
	<div class="col-sm-12 col-md-12 col-lg-4 order-lg-1 left-zone">
		<div class="card tags-choice">
			<div class="card-header p-b-0">
				<h2 class="card-title">
					<i class="fa fa-filter" aria-hidden="true"></i> 
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_offers_tags');?>

				</h2>
			</div>
			<div class="card-block">
				<div id="tags-type-loading" class="bootstrap-tagsinput">
				</div>
				<input id="tags-type" class="" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['TagsValue']->value;?>
">
				<small class="secondary u-db u-mt1 u-mb2">
					<span><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_offers_tags_help');?>
</span>
				</small>	
			</div>
			<div class="card-footer _hidden-md-up">
				<button id="tagsBtn-id" class="btn btn-primary btn-search" type="submit">
					<span class="fa fa-search"></span><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_offers_search_placeholder');?>

				</button>
			</div>
		</div>
		
		<div class="card infos-choice">
			<div class="card-header p-b-0">
				<h2 class="card-title">
					<i class="fa fa-filter" aria-hidden="true"></i> 
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_offers_infos');?>

				</h2>
			</div>
			<div class="card-body">
				<div class="row form-group">
					<label id="jobnames-label" class="col-lg-2 col-sm-5">
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_offers_jobnames');?>

					</label>
					<div id="jobnames-input" class="select-input col-lg-10 col-sm-7">
						<select id="jobnames-type" class="select-type form-control" rows="10">
							<option value="" class="select-item jobname-item"> </option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<label id="scores-label" class="col-lg-2 col-sm-5">
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_offers_scores');?>

					</label>
					<div id="scores-input" class="select-input col-lg-10 col-sm-7">
						<select id="scores-type" class="select-type form-control" rows="10">
							<option value="" class="select-item score-item"></option>			
							<option value="2" class="select-item score-item">2</option>
							<option value="3" class="select-item score-item">3</option>					
							<option value="4" class="select-item score-item">4</option>					
							<option value="5" class="select-item score-item">5</option>					
						</select>
					</div>
				</div>
				<div class="row form-group">
					<label id="prices-label" class="col-lg-2 col-sm-5">
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_offers_prices');?>

					</label>
					<div id="prices-input" class="col-lg-10 col-sm-7 input-group">
						<input id="prices-type" class="integer form-control" type="number" step="1" style ="appearance: textfield;" pattern="\d*" min="0" max="9999" size="4" maxlength="4" value="<?php echo $_smarty_tpl->tpl_vars['PricesValue']->value;?>
" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_offers_prices_placeholder');?>
">
						<span class="input-group-addon"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_offers_prices_addon');?>
</span>
					</div>
					
				</div>
			</div>
			<div class="card-footer _hidden-md-up">
				<button id="tagsBtn-id" class="btn btn-primary btn-search" type="submit">
					<span class="fa fa-search"></span><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_offers_search_placeholder');?>

				</button>
			</div>
		</div>
		
		<div class="card location-choice">
			<div class="card-header p-b-0">
				<h2 class="card-title">
					<i class="fa fa-filter" aria-hidden="true"></i> 
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_offers_location');?>

				</h2>
			</div>
			<div class="card-body">
				<div class="row form-group">
					<label id="countries-label" class="col-lg-2 col-sm-5">
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_offers_countries');?>

					</label>
					<div id="countries-input" class="select-input col-lg-10 col-sm-7">
						<select id="countries-type" class="select-type form-control" rows="10">
							<option value="" class="select-item country-item"></option>			
							<option value="Allemagne" class="select-item country-item">Allemagne</option>
							<option value="Belgique" class="select-item country-item">Belgique</option>					
							<option value="Espagne" class="select-item country-item">Espagne</option>					
							<option value="France" class="select-item country-item">France</option>					
							<option value="Italie" class="select-item country-item">Italie</option>					
							<option value="Luxembourg" class="select-item country-item">Luxembourg</option>					
							<option value="Pays-Bas" class="select-item country-item">Pays-Bas</option>					
							<option value="Royaume-uni" class="select-item country-item">Royaume-Uni</option>
							<option value="Suisse" class="select-item country-item">Suisse</option>
						</select>
					</div>
				</div>
				<div class="tree-block row">
					<div id="tree">
					</div>
				</div>
			</div>
			<div class="card-footer _hidden-md-up">
				<button id="treeBtn-id" class="btn btn-primary btn-search" type="submit">
					<span class="fa fa-search"></span><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_offers_search_placeholder');?>

				</button>
			</div>
		</div>
	</div>
</div>

   <?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				
				// locations tree management
				var tree = [];
				var $treeBox = $("#tree");
				initTree = function() {
					$treeBox.treeview({
						data: tree,
						levels:1,
						showCheckbox: false,
						multiSelect: true,
						searchResultColor:  '#FFF', 
						expandIcon: "fa fa-chevron-right fa-lg",
						collapseIcon: "fa fa-chevron-down fa-lg",
						onNodeSelected: function(e, node) {
							selectedNodes = $treeBox.treeview('getSelected');
							var stemp = '';
							for(var i=0; i<selectedNodes.length; i++) {
								if (i > 0) stemp = stemp + ',';
								stemp = stemp + selectedNodes[i].text;
							}
							$("#locations-id").val(stemp);
						},
						onNodeUnselected: function(e, node) {
							selectedNodes = $treeBox.treeview('getSelected');
							var stemp = '';
							for(var i=0; i<selectedNodes.length; i++) {
								if (i > 0) stemp = stemp + ',';
								stemp = stemp + selectedNodes[i].text;
							}
							$("#locations-id").val(stemp);
						},
					});
				};

				// Offers list display
				function displayOffersList() {
					post_data = $("#search-form").serialize();
					box = $("#offers-list");
					theHREF = '<?php echo $_smarty_tpl->tpl_vars['SearchHref']->value;?>
';
					ajax_postload(theHREF, box, post_data, false, true);
					$("html, body").animate({ scrollTop: 0 }, 500);
				};

				// Offers "id" field values with "type" field values
				function majId() {
					$("#tags-id").val($("#tags-type").val());
					$("#jobnames-id").val($("#jobnames-type").val());
					$("#scores-id").val($("#scores-type").val());
					$("#prices-id").val($("#prices-type").val());
					$("#countries-id").val($("#countries-type").val());
				};

				// Update tags list
				function getTags() {
					$.ajax({
						url: '<?php echo $_smarty_tpl->tpl_vars['TagsHref']->value;?>
',
						success: function(data) {
							tags = data;
							$('#tags-type-loading').remove();
							$("#tags-type").tagsinput({
								typeahead: {
									source: tags,
									minLength: 2,
									autoSelect: true,
								},
								trimValue: true,
								freeInput: false,
								maxTags: 6,
								maxChars: 20
							});
						}
					});
				}
				
				// Update jobNames list
				function getJobNames() {
					$.ajax({
						url: '<?php echo $_smarty_tpl->tpl_vars['JobNamesHref']->value;?>
',
						success: function(data) {
							jobnames = data;
							var $selectJobNames = $('#jobnames-type');
							for(var key in jobnames) {
								if (jobnames[key] == $("#jobnames-id").val()) {
									$selectJobNames.append('<option value="' + jobnames[key] + '" class="jobname-item"  selected>' + jobnames[key] + '</option>');
								} 
								else {
									$selectJobNames.append('<option value="' + jobnames[key] + '" class="jobname-item">' + jobnames[key] + '</option>');
								}
							}
						}
					});
				}
				
				// Update score value
				function getScores() {
					$("#scores-type").val($("#scores-id").val());
				}

				// Update price value
				function getPrices() {
					$("#prices-type").val($("#prices-id").val());
				}
				
				// Update countries list
				function getCountries() {
					$("#countries-type").val($("#countries-id").val());
					country = $("#countries-type").val();
					if ((country != '') && (country != 'France')) {
						$(".tree-block").addClass("display-none");
					}
				}
				
				// Update locations list
				function getTree() {
					$.ajax({
						url: '<?php echo $_smarty_tpl->tpl_vars['LocationsHref']->value;?>
',
						success: function(data) {
							tree = data;
							initTree();
							var options = {
								ignoreCase: true,
								exactMatch: true,
								revealResults: true,
							};
							treeValues = $("#locations-id").val().split(",");
							for(i=0; i<treeValues.length; i++) {
								selectedNodes = $treeBox.treeview('search', [treeValues[i], options]);
								$treeBox.treeview('selectNode', [selectedNodes]);
								$treeBox.treeview('clearSearch');
							}
						}
					});
				}
		
				displayOffersList();
				getTags();
				getJobNames();				
				getScores();
				getPrices();
				getCountries();
				getTree();
				
				// buttons managemnt
				$(".btn-search").on("click",
					function(e) {
						e.preventDefault();
						if($(this).length) {
							majId();
							displayOffersList();
						}
					}
				);
				
				$(".btn-reset").on("click", 
					function(e) {
						e.preventDefault();
						if($(this).length) {
							$("#search-id").val('');
							$("#tags-type").tagsinput('removeAll');
							$("#tags-type").val('');
							$("#jobnames-type").val('');
							$("#scores-type").val('');
							$("#prices-type").val('');
							$("#countries-type").val('');
							$(".tree-block").removeClass("display-none");							
							selectedNodes = $("#tree").treeview('getSelected');
							var nodesId = [];
							for(var i=0; i<selectedNodes.length; i++) {
								nodesId[i] = selectedNodes[i]['nodeId'];
							}
							for(var i=0; i < nodesId.length; i++) {
								nodeId = nodesId[i];
								$("#tree").treeview('unselectNode', nodeId);
							}
							$("#tree").treeview('clearSearch');
							majId();
							$("#locations-id").val('');
							if (navigator.userAgent.search("Chrome") >= 0) {
								$("#search-form").submit();
							}
							else {
								displayOffersList();
								$("html, body").animate({ scrollTop: 0 }, 500);
							}
						}
					}
				);
				
				// Search managemnt
				$("#search-id").on("keypress",
					function(e) {
						if (e.key == 'Enter') {
							e.preventDefault();
							majId();
							displayOffersList();
						}
					}
				);
				
				// Tags managemnt
				$(".tag-link").on("click",
					function(e) {
						e.preventDefault();
						if($(this).length) {
							$("#tags-type").tagsinput('removeAll');
							$("#tags-type").tagsinput('add', $(this).text());
							$("#tags-id").val($(this).text());
							displayOffersList();
						}
					}
				);
				
				$("#tags-type").on({
					change : function(e) {
							e.preventDefault();
							$("#tags-id").val($("#tags-type").val());
						},
					keypress : function(e) {
							if (e.key == 'Enter') {
								e.preventDefault();
								majId();
								displayOffersList();
							}
						}
					}
				);
				
				// JobName managemnt
				$("#jobnames-id").change(
					function(e) {
						e.preventDefault();
						$("#jobnames-type").val($("#jobnames-id").val());
					}
				);

				$("#jobnames-type").on({
					change : function(e) {
							e.preventDefault();
							$("#jobnames-id").val($("#jobnames-type").val());
						},
					keypress : function(e) {
							if (e.key == 'Enter') {
								e.preventDefault();
								majId();
								displayOffersList();
							}
						}
					}
				);
				
				// Score managemnt
				$("#scores-id").change(
					function(e) {
						e.preventDefault();
						$("#scores-type").val($("#scores-id").val());
					}
				);

				$("#scores-type").on({				
					change : function(e) {
							e.preventDefault();
							$("#scores-id").val($("#scores-type").val());
						},
					keypress : function(e) {
							if (e.key == 'Enter') {
								e.preventDefault();
								majId();
								displayOffersList();
							}
						}
					}
				);
				
				// Price managemnt
				$("#prices-id").change(
					function(e) {
						e.preventDefault();
						$("#prices-type").val($("#prices-id").val());
					}
				);

				
				$("#prices-type").on({				
					change : function(e) {
							e.preventDefault();
							$("#prices-id").val($("#prices-type").val());
						},
					keypress : function(e) {
							if (e.key == 'Enter') {
								e.preventDefault();
								majId();
								displayOffersList();
							}
						}
					}
				);
				
				// Country managemnt
				$("#countries-id").change(
					function(e) {
						e.preventDefault();
						$("#countries-type").val($("#countries-id").val());
					}
				);
				
				$("#countries-type").on({				
					change : function(e) {
							e.preventDefault();
							country = $("#countries-type").val();
							if ((country != '') && (country != 'France')) {
								$(".tree-block").addClass("display-none");
								$("#countries-id").val($("#countries-type").val());
							}
							else {
								$(".tree-block").removeClass("display-none");
								$("#countries-id").val('');
							}
						},
					keypress : function(e) {
							if (e.key == 'Enter') {
								e.preventDefault();
								majId();
								displayOffersList();
							}
						}
					}
				);

				// Pagination management
				$(document).on("click", ".pagination-link",
					function(e) {
						e.preventDefault();
						if($(this).length) {
							post_data = $("#search-form").serialize();
							box = $("#offers-list");
							theHREF = $(this).attr("event");
							ajax_postload(theHREF, box, post_data, false, false);
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
