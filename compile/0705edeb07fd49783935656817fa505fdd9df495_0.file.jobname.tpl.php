<?php
/* Smarty version 4.1.1, created on 2022-12-09 17:11:25
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\content\templates\src\jobname.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63935e2d5e1aa1_54358812',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0705edeb07fd49783935656817fa505fdd9df495' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\content\\templates\\src\\jobname.tpl',
      1 => 1530815672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63935e2d5e1aa1_54358812 (Smarty_Internal_Template $_smarty_tpl) {
?><h1>
	<?php if ($_smarty_tpl->tpl_vars['Content_icon']->value != '') {?>
		<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['Content_icon']->value;?>
" aria-hidden="true"></i> 
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>

</h1>
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
<?php if ($_smarty_tpl->tpl_vars['Content_top']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['Content_top']->value;?>

<?php }?>
<div class="article_info">
	<small class="begin"><?php echo $_smarty_tpl->tpl_vars['Content_daypublication']->value;?>
</small>
	<?php if ($_smarty_tpl->tpl_vars['Content_status']->value != '') {?>
		<small class="end"><?php echo $_smarty_tpl->tpl_vars['Content_status']->value;?>
</small>
	<?php }?>
</div>
<div class="article_intro">
	<?php if ($_smarty_tpl->tpl_vars['Content_image']->value != '') {?>
		<div class="container_img col-md-6 col-lg-4">
			<div class="intro_img">
				<img alt="<?php echo $_smarty_tpl->tpl_vars['Content_imageAlt']->value;?>
" src="<?php echo $_smarty_tpl->tpl_vars['Content_image']->value;?>
" onerror="this.src = '';" title="<?php echo $_smarty_tpl->tpl_vars['Content_imageTitle']->value;?>
">
			</div>
		</div>
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>

</div>
<?php if ($_smarty_tpl->tpl_vars['Content_add']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['Content_add']->value;?>

<?php }?>
<div class="article_content">
	<?php echo $_smarty_tpl->tpl_vars['Content_content']->value;?>

</div>
<?php if ($_smarty_tpl->tpl_vars['Content_bottom']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['Content_bottom']->value;?>

<?php }
}
}
