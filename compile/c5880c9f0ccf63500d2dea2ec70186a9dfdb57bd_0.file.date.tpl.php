<?php
/* Smarty version 4.1.1, created on 2022-10-15 12:08:48
  from 'E:\xampp\htdocs\smartwork\plugins\date\templates\src\date.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634a86b03ae6c3_90042412',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c5880c9f0ccf63500d2dea2ec70186a9dfdb57bd' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\date\\templates\\src\\date.tpl',
      1 => 1617145402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634a86b03ae6c3_90042412 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['field_value']->value['readonly'] == true) {?>
		<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="text" class="form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" maxlength="10" size="10" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
">
<?php } else { ?>
	<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
		<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="text" class="hasDatepicker form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" maxlength="10" size="10" data-date-format="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['format'];?>
" placeholder="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['format'];?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
">
	<?php } else { ?>
		<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="text" class="hasDatepicker form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" maxlength="10" size="10" data-date-format="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['format'];?>
" placeholder="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['format'];?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 value="">
	<?php }
}
}
}
