<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:54
  from 'E:\xampp\htdocs\smartwork\plugins\textarea\templates\src\textarea.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d169e0cb5_26268831',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a33c6099d39eed6d8f831f42beff70bc76fa640e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\textarea\\templates\\src\\textarea.tpl',
      1 => 1616802921,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d169e0cb5_26268831 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
	<textarea id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" class="form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
><?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
</textarea>
<?php } else { ?>
	<textarea id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" class="form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
></textarea>
<?php }
}
}
