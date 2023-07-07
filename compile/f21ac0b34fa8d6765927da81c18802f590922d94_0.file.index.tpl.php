<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:46
  from 'E:\xampp\htdocs\smartwork\modules\listcomp\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d0e8dcb49_60565451',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f21ac0b34fa8d6765927da81c18802f590922d94' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\listcomp\\templates\\src\\index.tpl',
      1 => 1656417458,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d0e8dcb49_60565451 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_58860267763451d0e7a7393_27423421', 'Main');
?>

	<?php }
/* {block 'Main'} */
class Block_58860267763451d0e7a7393_27423421 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_58860267763451d0e7a7393_27423421',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php echo '<script'; ?>
>
	$(document).ready(
		function() {
			init_form();
		}
	);
<?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['titleflag']->value) {?>
	<header class="page-header">
		<?php if ($_smarty_tpl->tpl_vars['titlecode']->value != '') {?>
			<h1><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_list');?>
 <?php echo $_smarty_tpl->tpl_vars['titlecode']->value;?>
</h1>
		<?php } else { ?>
			<h1><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_list');?>
</h1>
		<?php }?>
	</header>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['displaysize']->value == 3) {?>
	<div class="offset-xl-3 offset-lg-2 col-xl-6 col-lg-8 list-block">
<?php }
if ($_smarty_tpl->tpl_vars['displaysize']->value == 2) {?>
	<div class="offset-xl-2 offset-lg-1 col-xl-8 col-lg-10 list-block">
<?php }
if ($_smarty_tpl->tpl_vars['displaysize']->value == 1) {?>
	<div class="offset-xl-1 col-xl-10 col-lg-12 list-block">
<?php }
if ($_smarty_tpl->tpl_vars['displaysize']->value == 0) {?>
	<div class="col-lg-12 list-block">
<?php }?>
	
	<div class="list-block-header">
		<div class="row param-container">
		
			<div class="col-lg-8">
				<?php if ($_smarty_tpl->tpl_vars['searchflag']->value) {?>
					<div class="input-group search mb-2">
						<button class="btn btn-primary bt-search" event="<?php echo $_smarty_tpl->tpl_vars['btsearch']->value['ref'];?>
" rel="nofollow"> 
							<span class="fa fa-<?php echo $_smarty_tpl->tpl_vars['btsearch']->value['icon'];?>
" width="16" height="16" alt="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_search_txt');?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_search_txt');?>
"></span>
						</button>
						<input type="text"   class="form-control txtsearch" value="<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
" placeholder="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_search_txt');?>
">
						<input type="hidden" class="form-control txtfilter" value="<?php echo $_smarty_tpl->tpl_vars['filter']->value;?>
">
						<button class="btn btn-primary bt-clear" event="<?php echo $_smarty_tpl->tpl_vars['btsearch']->value['ref'];?>
" rel="nofollow">
							<span class="fa fa-eraser" width="16" height="16"></span>
						</button>
						<?php if ($_smarty_tpl->tpl_vars['filterflag']->value) {?>

							
							
							<button class="btn btn-secondary bt_filter-toggle" data-bs-toggle="collapse" data-bs-target="#<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_filter-container" aria-expanded="false">
								<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_search_advanced');?>

								<span class="fa fa-caret-down"></span>
							</button>
						<?php }?>					
					</div>
				<?php }?>
			</div>

			<div class="col-lg-2 dropdown-order "> 
				<?php if ($_smarty_tpl->tpl_vars['ordercount']->value > 0) {?>
					<div class="input-group lc_listorder mb-2">
						<div class="dropdown">
							<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby');?>

							</button>
							<ul class="dropdown-menu">
								<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ordercount']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
									<li>
										<a class="dropdown-item lc_linkorder" event="<?php echo $_smarty_tpl->tpl_vars['btorder']->value['ref'];?>
&order=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null);?>
" href="#" rel="nofollow">
											<?php if ($_smarty_tpl->tpl_vars['order']->value == (isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)) {?>
												<span class="fa fa-check" width="16" height="16"></span> 
											<?php } else { ?>
												<span class="fa fa-white" width="16" height="16"></span> 
											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 0) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_0');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 1) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_1');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 2) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_2');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 3) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_3');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 4) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_4');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 5) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_5');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 6) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_6');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 7) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_7');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 8) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_8');?>

											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) == 9) {?>
												<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby_9');?>

											<?php }?>
										</a>
									</li>
								<?php
}
}
?>					
							</ul>
						</div>
					</div>
				<?php }?>
			</div>
			
			<div class="col-lg-2">
				<?php if ($_smarty_tpl->tpl_vars['btnew']->value['flag']) {?>
					<div class="listbutton mb-2">
						<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
							<button type="button" class="btn btn-primary l_linknew" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['btnew']->value['ref'];?>
" rel="nofollow">
						<?php } else { ?>
							<button type="button" class="btn btn-primary lc_linknew" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['btnew']->value['ref'];?>
" rel="nofollow">
						<?php }?>
							<span class="fa fa-<?php echo $_smarty_tpl->tpl_vars['btnew']->value['icon'];?>
" width="16" height="16"></span> 
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_new');?>
</button>
					</div>
				<?php }?>
			</div>
		</div>
		
		<div id="<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_filter-container" class="row filter-container collapse">
			<label class="group-label"></label>
			<div class="col-lg-9">

				
					<?php echo '<script'; ?>
>
						$(document).ready(
							function() {
						
								var filterTxt = '<?php echo $_smarty_tpl->tpl_vars['filter']->value;?>
';
								var <?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_showFlag = false;
								$(document).find(".<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_filter").each(
									function() {
										var atemp = filterTxt.split(',');
										var value = atemp[0];
										if ((atemp[0] != '') && (atemp[0] != '0')) {
											<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_showFlag = true;
										}
										filterTxt = '';
										for (i = 1; i < atemp.length; i++) {
											if (i > 1) {
												filterTxt = filterTxt + ',';
											}
											filterTxt = filterTxt + atemp[i];
										}
										$(this).val(value);
									}
								);
								if (<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_showFlag) {
									$("#<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_filter-container").collapse('show');
								}
								
								$(document).on("change", ".<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_filter",
									function(e) {
										e.preventDefault();
										if($(this).length) {
											$(this).parents(".list-block-header:first").find(".txtfilter:first").val('|');
											$(this).parents(".filter-container:first").find(".<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_filter").each(
												function() {
													var filterTxt = $(this).parents(".list-block-header:first").find(".txtfilter:first").val();
													if (filterTxt == '|') {
														filterTxt = '';
													}
													else {
														filterTxt = filterTxt + ',';
													}
													if (($(this).get(0).tagName.toLowerCase() == 'select') && ($(this).val() == null)) {
														filterTxt = filterTxt + '';
													}
													else {
														filterTxt = filterTxt + $(this).val();
													}
													$(this).parents(".list-block-header:first").find(".txtfilter:first").val(filterTxt);
												}
											);
										}
									}
								);
							
							}
						);
					<?php echo '</script'; ?>
>
				
				
				<?php
$__section_idx_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filterview']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_1_total = $__section_idx_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_1_total !== 0) {
for ($__section_idx_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_1_iteration <= $__section_idx_1_total; $__section_idx_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
					<div class="row form-group">
						<label class="col-md-4 col-sm-5 form-label text-sm-end"><?php echo $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];?>
</label>					
						<div class="col-md-8 col-sm-7">
						<?php if ($_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['type'] == 'list') {?>
							<select class="<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_filter form-control form-select">
								<?php
$__section_idy_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['list']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_2_total = $__section_idy_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_2_total !== 0) {
for ($__section_idy_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_2_iteration <= $__section_idy_2_total; $__section_idy_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['description'];?>
</option>  
								<?php
}
}
?>
							</select>
						<?php } else { ?>
							<input class="<?php echo $_smarty_tpl->tpl_vars['htmlid']->value;?>
_filter form-control" type="text" value="">
						<?php }?>
						</div>
					</div>
				<?php
}
}
?>
			</div>
			<div class="col-lg-3">
				<div class="lc_listbutton mb-2">
					<button type="button" class="btn btn-primary bt-search" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['btsearch']->value['ref'];?>
" rel="nofollow">
						<span class="fa fa-search" width="16" height="16" alt="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_search');?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_search');?>
"></span>
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_search');?>

					</button>
				</div>
			</div>	
		</div>
	</div>

	<div class="list-block-content">
		<div class="list-container">
				<table class="table table-responsive table-bordered table-striped table-sm text-start">

					<?php if ($_smarty_tpl->tpl_vars['captionflag']->value) {?>
						<caption class="lc_list-header">
							<h4><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'txt_list_caption_count_begin');
echo $_smarty_tpl->tpl_vars['count']->value;
echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'txt_list_caption_count_end');?>

								<?php if ($_smarty_tpl->tpl_vars['search']->value != '') {?>
									<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'txt_list_caption_search_begin');
echo $_smarty_tpl->tpl_vars['search']->value;
echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'txt_list_caption_search_end');?>

								<?php }?>
								<?php
$__section_idx_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filterview']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_3_total = $__section_idx_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_3_total !== 0) {
for ($__section_idx_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_3_iteration <= $__section_idx_3_total; $__section_idx_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
									<?php if ($_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['display'] != '' && $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['display'] != 0) {?>
										<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null) != 0 || $_smarty_tpl->tpl_vars['search']->value != '') {?>
											,
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['type'] == 'list') {?>
											<?php
$__section_idy_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['list']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_4_total = $__section_idy_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_4_total !== 0) {
for ($__section_idy_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_4_iteration <= $__section_idy_4_total; $__section_idy_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
												<?php if ($_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['display'] == $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id']) {?>
													<?php echo $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];
echo $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['description'];?>

												<?php }?>
											<?php
}
}
?>
										<?php } else { ?>
											<?php echo $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];
echo $_smarty_tpl->tpl_vars['filterview']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['display'];?>

										<?php }?>
									<?php }?>
								<?php
}
}
?>
							</h4>
						</caption>
					<?php }?>

					<thead class="thead-default">
						<tr>
							<?php if ($_smarty_tpl->tpl_vars['columnidflag']->value) {?>
								<th class="" width="<?php echo $_smarty_tpl->tpl_vars['columnidpct']->value;?>
%" max-width="<?php echo $_smarty_tpl->tpl_vars['columnidpct']->value;?>
%"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'header_list_id');?>

									<?php if ($_smarty_tpl->tpl_vars['sortflag']->value) {?>
										<?php if ($_smarty_tpl->tpl_vars['sort']->value == $_smarty_tpl->tpl_vars['name_list_id']->value) {?>
											<?php if ($_smarty_tpl->tpl_vars['sort_order']->value == 0) {?>
												<div class="lc_linksort right" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&sort=<?php echo $_smarty_tpl->tpl_vars['name_list_id']->value;?>
&sortorder=1">
													<span class="fa fa-caret-down"></span>
												</div>
											<?php } else { ?>
												<div class="lc_linksort right" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&sort=&sortorder=0">
													<span class="fa fa-caret-up"></span>
												</div>
											<?php }?>
										<?php } else { ?>
											<div class="lc_linksort right" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&sort=<?php echo $_smarty_tpl->tpl_vars['name_list_id']->value;?>
&sortorder=0">
												<span class="fa fa-sort"></span>
											</div>
										<?php }?>
									<?php }?>
								</th>
							<?php }?>
							<?php
$__section_idy_5_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['columnname']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_5_total = $__section_idy_5_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_5_total !== 0) {
for ($__section_idy_5_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_5_iteration <= $__section_idy_5_total; $__section_idy_5_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
								<?php if ($_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['display']) {?>
									<th class="" width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%" max-width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%" ><?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['label'];?>

										<?php if ($_smarty_tpl->tpl_vars['sortflag']->value) {?>
											<?php if ($_smarty_tpl->tpl_vars['sort']->value == $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']) {?>
												<?php if ($_smarty_tpl->tpl_vars['sort_order']->value == 0) {?>
													<div class="lc_linksort right" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&sort=<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name'];?>
&sortorder=1">
														<span class="fa fa-caret-down"></span>
													</div>
												<?php } else { ?>
													<div class="lc_linksort right" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&sort=&sortorder=0">
														<span class="fa fa-caret-up"></span>
													</div>
												<?php }?>
											<?php } else { ?>
												<div class="lc_linksort right" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&sort=<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name'];?>
&sortorder=0">
													<span class="fa fa-sort"></span>
												</div>
											<?php }?>
										<?php }?>
									</th>
								<?php }?>
							<?php
}
}
?>
							<?php if ($_smarty_tpl->tpl_vars['btnb']->value == 4) {?>
								<th class="btn-list-action" colspan="4"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'header_list_action');?>

							<?php } elseif ($_smarty_tpl->tpl_vars['btnb']->value == 3) {?>
								<th class="btn-list-action" colspan="3"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'header_list_action');?>

							<?php } elseif ($_smarty_tpl->tpl_vars['btnb']->value == 2) {?>
								<th class="btn-list-action" colspan="2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'header_list_action');?>

							<?php } elseif ($_smarty_tpl->tpl_vars['btnb']->value == 1) {?>
								<th class="btn-list-action"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'header_list_action');?>

							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['btnb']->value > 0) {?>
								<?php if ($_smarty_tpl->tpl_vars['viewflag']->value) {?>
									<div class="view-toggle dropdown-toggle right" data-bs-toggle="dropdown" aria-expanded="false">
										<span class="fa fa-cog" width="16" height="16"></span>
									</div>
									<div class="view-column dropdown-menu">
									<?php
$__section_idy_6_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['columnname']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_6_total = $__section_idy_6_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_6_total !== 0) {
for ($__section_idy_6_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_6_iteration <= $__section_idy_6_total; $__section_idy_6_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
										<a class="dropdown-item lc_linkview" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&view=<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name'];?>
" href="#" rel="nofollow">
											<?php if ($_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['display']) {?>
												<span class="fa fa-check" width="16" height="16"></span> 
											<?php } else { ?>
												<span class="fa fa-white" width="16" height="16"></span> 
											<?php }?>
											<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['label'];?>

										</a>
									<?php
}
}
?>
									</div>
								<?php }?>
								</th>
							<?php }?>
						</tr>
					</thead>
					
					<tbody lbl_delete="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_delete');?>
" lbl_tool="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_tool');?>
" bt_cancel="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_cancel');?>
" bt_ok="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_ok');?>
">
						<?php
$__section_idx_7_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['list']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_7_total = $__section_idx_7_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_7_total !== 0) {
for ($__section_idx_7_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_7_iteration <= $__section_idx_7_total; $__section_idx_7_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
							<tr id="tr_<?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
">
								<?php if ($_smarty_tpl->tpl_vars['columnidflag']->value) {?>
									<?php if ($_smarty_tpl->tpl_vars['columnidpct']->value <> 0) {?>
										<?php if ($_smarty_tpl->tpl_vars['btedit']->value['flag']) {?>
											<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
												<td class="lc_line l_linkline" width="<?php echo $_smarty_tpl->tpl_vars['columnidpct']->value;?>
%"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
</td>
											<?php } else { ?>
												<td class="lc_line lc_linkline" width="<?php echo $_smarty_tpl->tpl_vars['columnidpct']->value;?>
%"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
</td>
											<?php }?>
										<?php } else { ?>
											<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
												<td class="lc_line" width="<?php echo $_smarty_tpl->tpl_vars['columnidpct']->value;?>
%"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
</td>
											<?php } else { ?>
												<td class="lc_line" width="<?php echo $_smarty_tpl->tpl_vars['columnidpct']->value;?>
%"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
</td>
											<?php }?>
										<?php }?>
									<?php } else { ?>
										<?php if ($_smarty_tpl->tpl_vars['btedit']->value['flag']) {?>
											<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
												<td class="lc_line l_linkline"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
</td>
											<?php } else { ?>
												<td class="lc_line lc_linkline"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
</td>
											<?php }?>
										<?php } else { ?>
											<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
												<td class="lc_line"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
</td>
											<?php } else { ?>
												<td class="lc_line"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_list_id']->value];?>
</td>
											<?php }?>
										<?php }?>
									<?php }?>
								<?php }?>
								<?php
$__section_idy_8_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['columnname']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_8_total = $__section_idy_8_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_8_total !== 0) {
for ($__section_idy_8_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_8_iteration <= $__section_idy_8_total; $__section_idy_8_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
									<?php if ($_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['display']) {?>
										<?php if ($_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'] <> 0) {?>
											<?php if ($_smarty_tpl->tpl_vars['btedit']->value['flag']) {?>
												<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
													<td class="lc_line l_linkline" width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%" max-width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']];?>
</td>
												<?php } else { ?>
													<td class="lc_line lc_linkline" width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%" max-width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']];?>
</td>
												<?php }?>
											<?php } else { ?>
												<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
													<td class="lc_line" width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%" max-width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']];?>
</td>
												<?php } else { ?>
													<td class="lc_line" width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%" max-width="<?php echo $_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['pct'];?>
%"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']];?>
</td>
												<?php }?>
											<?php }?>
										<?php } else { ?>
											<?php if ($_smarty_tpl->tpl_vars['btedit']->value['flag']) {?>
												<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
													<td class="lc_line l_linkline"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']];?>
</td>
												<?php } else { ?>
													<td class="lc_line lc_linkline"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']];?>
</td>
												<?php }?>
											<?php } else { ?>
												<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
													<td class="lc_line"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']];?>
</td>
												<?php } else { ?>
													<td class="lc_line"><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['columnname']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['name']];?>
</td>
												<?php }?>
											<?php }?>
										<?php }?>
									<?php }?>
								<?php
}
}
?>
								<?php if ($_smarty_tpl->tpl_vars['btevent']->value['flag']) {?>
									<?php if ($_smarty_tpl->tpl_vars['columnactionpct']->value <> 0) {?>
										<?php if ($_smarty_tpl->tpl_vars['btevent']->value['box']) {?>
											<td class="lc_line lc_linkevent lc_box" align="center" width="<?php echo $_smarty_tpl->tpl_vars['columnactionpct']->value;?>
%" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_event');?>
">
										<?php } else { ?>
											<td class="lc_line lc_linkevent lc_nobox" align="center" width="<?php echo $_smarty_tpl->tpl_vars['columnactionpct']->value;?>
%" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_event');?>
">
										<?php }?>
									<?php } else { ?>
										<?php if ($_smarty_tpl->tpl_vars['btevent']->value['box']) {?>
											<td class="lc_line lc_linkevent lc_box" align="center" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_event');?>
">
										<?php } else { ?>
											<td class="lc_line lc_linkevent lc_nobox" align="center" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_event');?>
">
										<?php }?>
									<?php }?>
										<a class="btn-list" event="<?php echo $_smarty_tpl->tpl_vars['btevent']->value['ref'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" rel="nofollow">
											<span class="fa fa-<?php echo $_smarty_tpl->tpl_vars['btevent']->value['icon'];?>
 fa-lg" alt="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_event');?>
"></span> 
										</a>
									</td>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['bttool']->value['flag']) {?>
									<?php if ($_smarty_tpl->tpl_vars['columnactionpct']->value <> 0) {?>
										<td class="lc_line lc_linktool" align="center" width="<?php echo $_smarty_tpl->tpl_vars['columnactionpct']->value;?>
%" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_tool');?>
">
									<?php } else { ?>
										<td class="lc_line lc_linktool" align="center" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_tool');?>
">
									<?php }?>
										<a class="btn-list" event="<?php echo $_smarty_tpl->tpl_vars['bttool']->value['ref'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" title_tool="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_tool');?>
 <?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_delete']->value];?>
" rel="nofollow">
											<span class="fa fa-<?php echo $_smarty_tpl->tpl_vars['bttool']->value['icon'];?>
 fa-lg" alt="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_tool');?>
"></span> 
										</a>
									</td>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['btedit']->value['flag']) {?>
									<?php if ($_smarty_tpl->tpl_vars['columnactionpct']->value <> 0) {?>
										<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
											<td class="lc_line l_linkline lc_linkedit" align="center" width="<?php echo $_smarty_tpl->tpl_vars['columnactionpct']->value;?>
%" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_edit');?>
">
										<?php } else { ?>
											<td class="lc_line lc_linkline lc_linkedit" align="center" width="<?php echo $_smarty_tpl->tpl_vars['columnactionpct']->value;?>
%" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_edit');?>
">
										<?php }?>
									<?php } else { ?>
										<?php if ($_smarty_tpl->tpl_vars['pageflag']->value) {?>
											<td class="lc_line l_linkline lc_linkedit" align="center" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_edit');?>
">
										<?php } else { ?>
											<td class="lc_line lc_linkline lc_linkedit" align="center" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_edit');?>
">
										<?php }?>
									<?php }?>
										<a class="btn-list" event="<?php echo $_smarty_tpl->tpl_vars['btedit']->value['ref'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" rel="nofollow">
											<span class="fa fa-<?php echo $_smarty_tpl->tpl_vars['btedit']->value['icon'];?>
 fa-lg" alt="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_edit');?>
"></span> 
										</a>
									</td>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['btdelete']->value['flag']) {?>
									<?php if ($_smarty_tpl->tpl_vars['columnactionpct']->value <> 0) {?>
										<td class="lc_line lc_linkdelete" align="center" width="<?php echo $_smarty_tpl->tpl_vars['columnactionpct']->value;?>
%" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_delete');?>
">
									<?php } else { ?>
										<td class="lc_line lc_linkdelete" align="center" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_delete');?>
">
									<?php }?>
										<a class="btn-list" event="<?php echo $_smarty_tpl->tpl_vars['btdelete']->value['ref'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" title_delete="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_delete');?>
 <?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][$_smarty_tpl->tpl_vars['name_delete']->value];?>
" rel="nofollow">
											<span class="fa fa-<?php echo $_smarty_tpl->tpl_vars['btdelete']->value['icon'];?>
 fa-lg" alt="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_list_delete');?>
"></span> 
										</a>
									</td>
								<?php }?>
							</tr>   	
						<?php
}
}
?>
					</tbody>

				</table>
		</div>
	</div>

	<div class="list-block-footer">
	<?php if ($_smarty_tpl->tpl_vars['pagecount']->value > 1 || $_smarty_tpl->tpl_vars['pagesizeflag']->value) {?> 
		<div class="row list-container pagination-container">
			<div class="col-lg-12"> 
				<?php if ($_smarty_tpl->tpl_vars['pagecount']->value > 1) {?> 
					<ul class="pagination">
						<?php
$__section_idx_9_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['pagination']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_9_total = $__section_idx_9_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_9_total !== 0) {
for ($__section_idx_9_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_9_iteration <= $__section_idx_9_total; $__section_idx_9_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
							<?php if ($_smarty_tpl->tpl_vars['pagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)] == 0) {?>
								<li class="page-item">
									<a class="lc_linkpage page-link" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&p=0" rel="nofollow"><<</a>
								</li>
							<?php } elseif ($_smarty_tpl->tpl_vars['pagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)] == -1) {?>
								<li class="page-item">
									<a class="lc_linkpage page-link" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&p=-1" rel="nofollow">>></a>
								</li>
							<?php } elseif ($_smarty_tpl->tpl_vars['pagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)] > 0) {?>
								<?php if ($_smarty_tpl->tpl_vars['pagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)] == $_smarty_tpl->tpl_vars['page']->value) {?>
									<li class="page-item active">
										<a class="page-link"><?php echo $_smarty_tpl->tpl_vars['pagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
</a>
									</li>
								<?php } else { ?>
									<li class="page-item">
										<a class="lc_linkpage page-link" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
&p=<?php echo $_smarty_tpl->tpl_vars['pagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" rel="nofollow"><?php echo $_smarty_tpl->tpl_vars['pagination']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
</a>
									</li>
								<?php }?>
							<?php }?>
						<?php
}
}
?>
					</ul>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['pagesizeflag']->value) {?> 
					<div class="size-selector">
						<label class="form-label text-sm-end"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_list_orderby');?>
</label>					
						<select class="form-control form-select lc_linksize" event="<?php echo $_smarty_tpl->tpl_vars['btpage']->value['ref'];?>
">
							<?php
$__section_idx_10_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['pagesizearray']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_10_total = $__section_idx_10_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_10_total !== 0) {
for ($__section_idx_10_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_10_iteration <= $__section_idx_10_total; $__section_idx_10_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
								<?php if ($_smarty_tpl->tpl_vars['pagesize']->value == $_smarty_tpl->tpl_vars['pagesizearray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]) {?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['pagesizearray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" selected=""><?php echo $_smarty_tpl->tpl_vars['pagesizearray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
</option>  
								<?php } else { ?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['pagesizearray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
"><?php echo $_smarty_tpl->tpl_vars['pagesizearray']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
</option>  
								<?php }?>
							<?php
}
}
?>
						</select>
					</div>
				<?php }?>
			</div>
		</div>
	<?php }?>

		<div class="row"> 
			<div class="col-lg-12">
			<?php if ($_smarty_tpl->tpl_vars['btclose']->value['flag']) {?>
				<button type="button" class="btn btn-primary bt-close mr-2" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" rel="nofollow">
					<span class="fa fa-<?php echo $_smarty_tpl->tpl_vars['btclose']->value['icon'];?>
" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Bt_close');?>

				</button>
			<?php }?>
			</div>
		</div>

	</div>
	
</div>

<?php
}
}
/* {/block 'Main'} */
}
