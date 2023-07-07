<?php
/* Smarty version 4.1.1, created on 2022-12-09 17:13:32
  from 'E:\xampp\htdocs\smartwork\modules\content\templates\src\blog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63935eac394573_10919396',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d8c8bcd179873676dccc55a7555660c7191a4a7' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\content\\templates\\src\\blog.tpl',
      1 => 1646234518,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63935eac394573_10919396 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
	<h1 class="<?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
" itemprop="title">
		<?php if ($_smarty_tpl->tpl_vars['Content_icon']->value != '') {?>
			<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['Content_icon']->value;?>
" aria-hidden="true"></i> 
		<?php }?>
		<?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>

	</h1>
</div>
<div class="row">
	<div class="content_btn">
		<a class="btn btn-primary" href="javascript:history.go(-1)">
			<span class="fa fa-arrow-left"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_return_page');?>

		</a>
		<?php if ($_smarty_tpl->tpl_vars['btEdit']->value) {?>
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['Content_linkEdit']->value;?>
">
				<span class="fa fa-edit" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_edit');?>

			</button>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['btDelete']->value) {?>
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['Content_linkDelete']->value;?>
">
				<span class="fa fa-trash" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_delete');?>

			</button>
		<?php }?>
	</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['Content_top']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['Content_top']->value;?>

<?php }?>
<div class="row article_info <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
	<div class="col-lg-12">
		<small class="begin"><?php echo $_smarty_tpl->tpl_vars['Content_daypublication']->value;?>
</small>
		<?php if ($_smarty_tpl->tpl_vars['Content_status']->value != '') {?>
			<small class="end"><?php echo $_smarty_tpl->tpl_vars['Content_status']->value;?>
</small>
		<?php }?>
	</div>
</div>
<div class="row article_intro <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
	<?php if ($_smarty_tpl->tpl_vars['Content_image']->value != '') {?>
		<div class="container_img col-md-6 col-lg-4">
			<div class="intro_img">
				<img alt="<?php echo $_smarty_tpl->tpl_vars['Content_imageAlt']->value;?>
" src="<?php echo $_smarty_tpl->tpl_vars['Content_image']->value;?>
" onerror="this.src = '';" title="<?php echo $_smarty_tpl->tpl_vars['Content_imageTitle']->value;?>
">
			</div>
		</div>
		<div class="container_txt col-md-6 col-lg-8">
	<?php } else { ?>
		<div class="container_txt col-lg-12">
	<?php }?>
		<?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>

	</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['Content_add']->value != '') {?>
	<div class="row">
		<div class="col-lg-12">
			<?php echo $_smarty_tpl->tpl_vars['Content_add']->value;?>

		</div>
	</div>
<?php }?>
<div class="row article_content <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
" itemprop="articleBody">
	<div class="col-lg-12">
		<?php echo $_smarty_tpl->tpl_vars['Content_content']->value;?>

	</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['Content_bottom']->value != '') {?>
	<div class="row">
		<div class="col-lg-12">
			<?php echo $_smarty_tpl->tpl_vars['Content_bottom']->value;?>

		</div>
	</div>
<?php }
}
}
