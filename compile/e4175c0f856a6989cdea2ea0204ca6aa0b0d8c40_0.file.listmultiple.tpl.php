<?php
/* Smarty version 4.1.1, created on 2022-10-11 10:19:35
  from 'E:\xampp\htdocs\smartwork\plugins\listmultiple\templates\src\listmultiple.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63452717d67171_90913216',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4175c0f856a6989cdea2ea0204ca6aa0b0d8c40' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\listmultiple\\templates\\src\\listmultiple.tpl',
      1 => 1646211195,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63452717d67171_90913216 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['field_value']->value['readonly'] == true) {?>
	<select multiple class="form-control form-select <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
[]" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 size=4 disabled>  
		<?php
$__section_idy_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['list']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_0_total = $__section_idy_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_0_total !== 0) {
for ($__section_idy_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_0_iteration <= $__section_idy_0_total; $__section_idy_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
			<?php $_smarty_tpl->_assignInScope('selected', false);?>
			<?php
$__section_idz_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['value']) ? count($_loop) : max(0, (int) $_loop));
$__section_idz_1_total = $__section_idz_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idz'] = new Smarty_Variable(array());
if ($__section_idz_1_total !== 0) {
for ($__section_idz_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index'] = 0; $__section_idz_1_iteration <= $__section_idz_1_total; $__section_idz_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index']++){
?>
				<?php if ($_smarty_tpl->tpl_vars['field_value']->value['value'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index'] : null)]['listid'] == $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id']) {?>
					<?php $_smarty_tpl->_assignInScope('selected', true);?>
				<?php }?>
			<?php
}
}
?>
			<?php if ($_smarty_tpl->tpl_vars['selected']->value == true) {?>
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
 size=4>  
		<?php
$__section_idy_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['list']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_2_total = $__section_idy_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_2_total !== 0) {
for ($__section_idy_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_2_iteration <= $__section_idy_2_total; $__section_idy_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
			<?php $_smarty_tpl->_assignInScope('selected', false);?>
			<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
				<?php
$__section_idz_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['value']) ? count($_loop) : max(0, (int) $_loop));
$__section_idz_3_total = $__section_idz_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idz'] = new Smarty_Variable(array());
if ($__section_idz_3_total !== 0) {
for ($__section_idz_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index'] = 0; $__section_idz_3_iteration <= $__section_idz_3_total; $__section_idz_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idz']->value['index']++){
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
