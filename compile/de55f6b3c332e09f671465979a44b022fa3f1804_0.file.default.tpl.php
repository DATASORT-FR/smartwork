<?php
/* Smarty version 4.1.1, created on 2022-12-09 16:13:25
  from 'E:\xampp\htdocs\smartwork\modules\content\templates\src\default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6393509551c033_42820453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'de55f6b3c332e09f671465979a44b022fa3f1804' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\content\\templates\\src\\default.tpl',
      1 => 1546039604,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6393509551c033_42820453 (Smarty_Internal_Template $_smarty_tpl) {
?><h1 class="<?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
" itemprop="title">
	<?php if ($_smarty_tpl->tpl_vars['Content_icon']->value != '') {?>
		<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['Content_icon']->value;?>
" aria-hidden="true"></i> 
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>

</h1>
<?php if ($_smarty_tpl->tpl_vars['btEdit']->value || $_smarty_tpl->tpl_vars['btDelete']->value) {?>
	<div class="content_btn <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
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
<?php }?>
<div class="article_intro <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
	<?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>

</div>
<div class="article_content <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
	<?php echo $_smarty_tpl->tpl_vars['Content_content']->value;?>

</div>
<?php }
}
