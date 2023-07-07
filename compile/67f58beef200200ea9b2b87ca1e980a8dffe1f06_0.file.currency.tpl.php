<?php
/* Smarty version 4.1.1, created on 2022-10-15 12:08:47
  from 'E:\xampp\htdocs\smartwork\plugins\currency\templates\src\currency.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634a86afa76545_94985797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '67f58beef200200ea9b2b87ca1e980a8dffe1f06' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\currency\\templates\\src\\currency.tpl',
      1 => 1663244947,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634a86afa76545_94985797 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['field_value']->value['readonly'] == true) {?>
	<span id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="text" class="currency form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
		<?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>

		<i class="fa <?php echo $_smarty_tpl->tpl_vars['field_value']->value['currency'];?>
" aria-hidden="true"></i>
	</span>
<?php } else { ?>
	<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
		<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="number" class="currency form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" step="0.01" style ="appearance: textfield;" pattern="" min="-9999999" max="9999999" size="9" maxlength="9" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
">
		<i class="fa <?php echo $_smarty_tpl->tpl_vars['field_value']->value['currency'];?>
" aria-hidden="true"></i>
	<?php } else { ?>
		<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="number" class="currency form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" step="0.01" style ="appearance: textfield;" pattern="" min="-9999999" max="9999999" size="9" maxlength="9" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
		<i class="fa <?php echo $_smarty_tpl->tpl_vars['field_value']->value['currency'];?>
" aria-hidden="true"></i>
	<?php }
}?>	
<?php }
}
