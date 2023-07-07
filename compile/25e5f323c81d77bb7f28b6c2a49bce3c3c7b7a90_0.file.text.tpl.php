<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:54
  from 'E:\xampp\htdocs\smartwork\plugins\text\templates\src\text.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d161c2860_02788239',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25e5f323c81d77bb7f28b6c2a49bce3c3c7b7a90' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\text\\templates\\src\\text.tpl',
      1 => 1616802900,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d161c2860_02788239 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
	<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="text" class="form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
">
<?php } else { ?>
	<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="text" class="form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
">
<?php }
}
}
