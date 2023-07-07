<?php
/* Smarty version 4.1.1, created on 2022-10-11 10:19:35
  from 'E:\xampp\htdocs\smartwork\plugins\listmultiple_order\templates\src\listmultiple_order.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63452717db2310_12353845',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fb1eb98924fa455ebcd4fc11bcd6ac10132091c1' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\listmultiple_order\\templates\\src\\listmultiple_order.tpl',
      1 => 1646211208,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63452717db2310_12353845 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('order', '');
if ($_smarty_tpl->tpl_vars['field_value']->value['readonly'] == true) {?>
	<select multiple class="form-control form-select <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
[]" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 size=4 disabled>  
		<?php
$__section_idy_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['list']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_4_total = $__section_idy_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_4_total !== 0) {
for ($__section_idy_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_4_iteration <= $__section_idy_4_total; $__section_idy_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
			<?php $_smarty_tpl->_assignInScope('selected', false);?>
			<?php
$__section_idz_5_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['value']) ? count($_loop) : max(0, (int) $_loop));
$__section_idz_5_total = $__section_idz_5_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idz'] = new Smarty_Variable(array());
if ($__section_idz_5_total !== 0) {
for ($__section_idz_5_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index'] = 0; $__section_idz_5_iteration <= $__section_idz_5_total; $__section_idz_5_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index']++){
?>
				<?php if ($_smarty_tpl->tpl_vars['field_value']->value['value'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index'] : null)]['listid'] == $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id']) {?>
					<?php $_smarty_tpl->_assignInScope('selected', true);?>
				<?php }?>
			<?php
}
}
?>
			<?php if ($_smarty_tpl->tpl_vars['selected']->value == true) {?>
				<?php if ($_smarty_tpl->tpl_vars['order']->value != $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['order']) {?>
					<optgroup label="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['order'];?>
">
					<?php $_smarty_tpl->_assignInScope('order', $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['order']);?>
				<?php }?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'];?>
" disabled>
					<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['description'];?>

				</option>  
			<?php }?>
		<?php
}
}
?>
	</select>
<?php } else { ?>
	<select multiple class="form-control form-select <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
[]" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 size=10>  
		<?php
$__section_idy_6_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['list']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_6_total = $__section_idy_6_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_6_total !== 0) {
for ($__section_idy_6_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_6_iteration <= $__section_idy_6_total; $__section_idy_6_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['order']->value != $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['order']) {?>
				<optgroup label="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['order'];?>
">
				<?php $_smarty_tpl->_assignInScope('order', $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['order']);?>
			<?php }?>
			<?php $_smarty_tpl->_assignInScope('selected', false);?>
			<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
				<?php
$__section_idz_7_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['value']) ? count($_loop) : max(0, (int) $_loop));
$__section_idz_7_total = $__section_idz_7_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idz'] = new Smarty_Variable(array());
if ($__section_idz_7_total !== 0) {
for ($__section_idz_7_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index'] = 0; $__section_idz_7_iteration <= $__section_idz_7_total; $__section_idz_7_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index']++){
?>
					<?php if ($_smarty_tpl->tpl_vars['field_value']->value['value'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index'] : null)]['listid'] == $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id']) {?>
						<?php $_smarty_tpl->_assignInScope('selected', true);?>
					<?php }?>
				<?php
}
}
?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['selected']->value == true) {?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'];?>
" selected>
			<?php } else { ?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'];?>
">
			<?php }?>
			<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['description'];?>
</option>  
		<?php
}
}
?>
	</select>  
<?php }
}
}
