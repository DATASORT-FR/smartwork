<?php
/* Smarty version 4.1.1, created on 2022-12-10 13:07:25
  from 'E:\xampp\htdocs\smartwork\modules\menu\templates\src\menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6394767d2012b4_18341965',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d3d04e55f3078beeb73457bc399c5db11e3bda6' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\menu\\templates\\src\\menu.tpl',
      1 => 1646322261,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6394767d2012b4_18341965 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['Menu_style']->value == 'main') {?>
	<nav id="topNav" class="navbar navbar-expand-lg <?php echo $_smarty_tpl->tpl_vars['Menu_classAdd']->value;?>
">
		<div class="container-fluid">
			<?php if ($_smarty_tpl->tpl_vars['Menu_back']->value == true) {?>
				<a class="navbar-brand nav-link mnu_backward" title="" href="<?php echo $_smarty_tpl->tpl_vars['Menu_homepage']->value;?>
">
					<span class="fa fa-arrow-left"></span>
				</a>
			<?php }?>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active mnu_home" aria-current="page" title="" href="<?php echo $_smarty_tpl->tpl_vars['Menu_apppage']->value;?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'menu_home_text');?>
</a>
					</li>
					<?php $_smarty_tpl->_assignInScope('index', 0);?>
					<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['Menu_text']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
						<?php $_smarty_tpl->_assignInScope('index', $_smarty_tpl->tpl_vars['index']->value+1);?>
						<?php $_smarty_tpl->_assignInScope('displayidx', (isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)+1);?> 
						<?php if ($_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 'divider') {?>
							<li class="nav-item divider-vertical"></li>
						<?php } else { ?>
							<?php if ((isset($_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][1]))) {?>
								<li class="nav-item dropdown"> 
									<a id="dropdownMenuLink_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="nav-link dropdown-toggle <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" role="button" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="#" data-bs-toggle="dropdown" aria-expanded="false">
										<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] != '') {?>
											<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"></i>												
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 0) {?>
											<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>

										<?php }?>
									</a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
">
										<?php $_smarty_tpl->_assignInScope('display', false);?> 
										<?php
$__section_idy_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_1_total = $__section_idy_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_1_total !== 0) {
for ($__section_idy_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_1_iteration <= $__section_idy_1_total; $__section_idy_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
											<?php if ($_smarty_tpl->tpl_vars['display']->value == true) {?>
												<?php if ($_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 'divider') {?>
													<li class="menu_<?php echo $_smarty_tpl->tpl_vars['displayidx']->value;?>
_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null);?>
 <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
">
														<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] != '') {?>
															<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
"></i>												
														<?php }?>
														<hr class="dropdown-divider">
													</li>
												<?php } else { ?>
													<li class="menu_<?php echo $_smarty_tpl->tpl_vars['displayidx']->value;?>
_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null);?>
 <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
">
														<?php if ($_smarty_tpl->tpl_vars['Menu_page']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 1) {?>
															<?php if ($_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == '') {?>
																<a class="dropdown-item mnu_linkno" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
" href="#" event="">
																	<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] != '') {?>
																		<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
"></i>												
																	<?php }?>
																	<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 0) {?>
																		<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>

																	<?php }?>
																</a>
															<?php } else { ?>
																<a class="dropdown-item mnu_linkline" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
" href="#" event="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
">
																	<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] != '') {?>
																		<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
"></i>												
																	<?php }?>
																	<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 0) {?>
																		<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>

																	<?php }?>
																</a>
															<?php }?>
														<?php } else { ?>
															<a class="dropdown-item" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
" href="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
">
																<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] != '') {?>
																	<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
"></i>												
																<?php }?>
																<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 0) {?>
																	<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>

																<?php }?>
															</a>
														<?php }?>
													</li>
												<?php }?>
											<?php }?>
											<?php $_smarty_tpl->_assignInScope('display', true);?> 
										<?php
}
}
?>
									</ul>	
								</li>
							<?php } else { ?>
								<li class="nav-item"> 
									<?php if ($_smarty_tpl->tpl_vars['Menu_page']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 1) {?>
										<?php if ($_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == '') {?>
											<a class="nav-link mnu_linkno <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="#" event="">
												<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] != '') {?>
													<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"></i>												
												<?php }?>
												<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 0) {?>
													<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>

												<?php }?>
											</a>
										<?php } else { ?>
											<a class="nav-link mnu_linkline <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="#" event="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
">
												<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] != '') {?>
													<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"></i>												
												<?php }?>
												<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 0) {?>
													<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>

												<?php }?>
											</a>
										<?php }?>
									<?php } else { ?>
										<a class="nav-link <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
">
											<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] != '') {?>
												<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"></i>												
											<?php }?>
											<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 0) {?>
												<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>

											<?php }?>
										</a>
									<?php }?>
								</li>
							<?php }?>
						<?php }?>
					<?php
}
}
?>	
				</ul>
			</div>
		</div>
	</nav>
<?php } elseif ($_smarty_tpl->tpl_vars['Menu_style']->value == 'simple') {?>
	<?php
$__section_idx_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['Menu_text']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_2_total = $__section_idx_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_2_total !== 0) {
for ($__section_idx_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_2_iteration <= $__section_idx_2_total; $__section_idx_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<a class="nav-link <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"><?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
</a>
	<?php
}
}
} else { ?>
				<ul class="navbar-nav me-auto mb-lg-0">
					<?php $_smarty_tpl->_assignInScope('index', 0);?>
					<?php
$__section_idx_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['Menu_text']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_3_total = $__section_idx_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_3_total !== 0) {
for ($__section_idx_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_3_iteration <= $__section_idx_3_total; $__section_idx_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
						<?php $_smarty_tpl->_assignInScope('index', $_smarty_tpl->tpl_vars['index']->value+1);?>
						<?php $_smarty_tpl->_assignInScope('displayidx', (isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)+1);?> 
						<?php if ($_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 'divider') {?>
							<li class="nav-item divider-vertical"></li>
						<?php } else { ?>
							<?php if ((isset($_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][1]))) {?>
								<li class="nav-item dropdown"> 
									<a id="dropdownMenuLink_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="nav-link dropdown-toggle <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" role="button" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="#" data-bs-toggle="dropdown" aria-expanded="false">
										<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] != '') {?>
											<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"></i>												
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 0) {?>
											<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>

										<?php }?>
									</a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink_<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
">
										<?php $_smarty_tpl->_assignInScope('display', false);?> 
										<?php
$__section_idy_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_4_total = $__section_idy_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_4_total !== 0) {
for ($__section_idy_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_4_iteration <= $__section_idy_4_total; $__section_idy_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
											<?php if ($_smarty_tpl->tpl_vars['display']->value == true) {?>
												<?php if ($_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 'divider') {?>
													<li class="menu_<?php echo $_smarty_tpl->tpl_vars['displayidx']->value;?>
_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null);?>
 <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
">
														<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] != '') {?>
															<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
"></i>												
														<?php }?>
														<hr class="dropdown-divider">
													</li>
												<?php } else { ?>
													<li class="menu_<?php echo $_smarty_tpl->tpl_vars['displayidx']->value;?>
_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null);?>
 <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
">
														<?php if ($_smarty_tpl->tpl_vars['Menu_page']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 1) {?>
															<?php if ($_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == '') {?>
																<a class="dropdown-item mnu_linkno" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
" href="#" event="">
																	<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] != '') {?>
																		<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
"></i>												
																	<?php }?>
																	<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 0) {?>
																		<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>

																	<?php }?>
																</a>
															<?php } else { ?>
																<a class="dropdown-item mnu_linkline" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
" href="#" event="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
">
																	<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] != '') {?>
																		<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
"></i>												
																	<?php }?>
																	<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 0) {?>
																		<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>

																	<?php }?>
																</a>
															<?php }?>
														<?php } else { ?>
															<a class="dropdown-item" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
" href="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
">
																<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] != '') {?>
																	<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
"></i>												
																<?php }?>
																<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)] == 0) {?>
																	<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>

																<?php }?>
															</a>
														<?php }?>
													</li>
												<?php }?>
											<?php }?>
											<?php $_smarty_tpl->_assignInScope('display', true);?> 
										<?php
}
}
?>
									</ul>	
								</li>
							<?php } else { ?>
								<li class="nav-item"> 
									<?php if ($_smarty_tpl->tpl_vars['Menu_page']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 1) {?>
										<?php if ($_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == '') {?>
											<a class="nav-link mnu_linkno <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="#" event="">
												<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] != '') {?>
													<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"></i>												
												<?php }?>
												<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 0) {?>
													<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>

												<?php }?>
											</a>
										<?php } else { ?>
											<a class="nav-link mnu_linkline <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="#" event="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
">
												<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] != '') {?>
													<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"></i>												
												<?php }?>
												<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 0) {?>
													<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>

												<?php }?>
											</a>
										<?php }?>
									<?php } else { ?>
										<a class="nav-link <?php echo $_smarty_tpl->tpl_vars['Menu_class']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" title="<?php echo $_smarty_tpl->tpl_vars['Menu_title']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
" href="<?php echo $_smarty_tpl->tpl_vars['Menu_ref']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
">
											<?php if ($_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] != '') {?>
												<i class="<?php echo $_smarty_tpl->tpl_vars['Menu_icon']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>
"></i>												
											<?php }?>
											<?php if ($_smarty_tpl->tpl_vars['Menu_iconOnly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0] == 0) {?>
												<?php echo $_smarty_tpl->tpl_vars['Menu_text']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)][0];?>

											<?php }?>
										</a>
									<?php }?>
								</li>
							<?php }?>
						<?php }?>
					<?php
}
}
?>	
				</ul>
<?php }
}
}
