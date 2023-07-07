<?php
/* Smarty version 4.1.1, created on 2022-10-11 14:17:02
  from 'E:\xampp\htdocs\smartwork\apps\separation_v1\modules\content\templates\src\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63455ebe39cf09_45413200',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fcbe3f6496854bd3b0e66e2c6f62344fa1ade20c' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v1\\modules\\content\\templates\\src\\header.tpl',
      1 => 1633340951,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63455ebe39cf09_45413200 (Smarty_Internal_Template $_smarty_tpl) {
?><h1><?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>
</h1>
<?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>

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
<?php }
echo $_smarty_tpl->tpl_vars['Content_content']->value;?>

<?php }
}
