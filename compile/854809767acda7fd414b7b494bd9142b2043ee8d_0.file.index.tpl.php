<?php
/* Smarty version 4.1.1, created on 2022-10-03 17:20:00
  from 'E:\xampp\htdocs\smartwork\plugins\formfield\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633afda08112f4_97882690',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '854809767acda7fd414b7b494bd9142b2043ee8d' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\formfield\\templates\\src\\index.tpl',
      1 => 1619824156,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633afda08112f4_97882690 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('line', 0);
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['displayonly']) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
	<?php if ($_smarty_tpl->tpl_vars['line']->value == 0) {?>
		<?php echo '<script'; ?>
>
			$(document).ready(
				function() {
	<?php }?>
				<?php $_smarty_tpl->_assignInScope('field_displayonly', $_smarty_tpl->tpl_vars['field_value']->value['displayonly'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]);?>
				<?php $_smarty_tpl->_assignInScope('field_id_displayonly', $_smarty_tpl->tpl_vars['field_displayonly']->value['field_id']);?>
				<?php $_smarty_tpl->_assignInScope('ope_displayonly', $_smarty_tpl->tpl_vars['field_displayonly']->value['ope']);?>
				<?php $_smarty_tpl->_assignInScope('value_displayonly', $_smarty_tpl->tpl_vars['field_displayonly']->value['value']);?>
			

				$("#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1, input[name=<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
]").change(function() {
					<?php $_smarty_tpl->_assignInScope('line1', 0);?>
					if (
						<?php
$__section_idy_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['value_displayonly']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_1_total = $__section_idy_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_1_total !== 0) {
for ($__section_idy_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_1_iteration <= $__section_idy_1_total; $__section_idy_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
							<?php if ($_smarty_tpl->tpl_vars['line1']->value == 1) {?>
								&&
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['ope_displayonly']->value == '!=') {?>
								(this.value == '<?php echo $_smarty_tpl->tpl_vars['value_displayonly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
') 
							<?php } else { ?>
								(this.value != '<?php echo $_smarty_tpl->tpl_vars['value_displayonly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
') 
							<?php }?>
							<?php $_smarty_tpl->_assignInScope('line1', 1);?>
						<?php
}
}
?>
					) {
						$("a[href='#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
']").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
						$("label[for='<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
']").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
						$("#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
						$("#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
_list").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
						$(".<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
_class").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
					}
					else {
						$("a[href='#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
']").removeClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
						$("label[for='<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
']").removeClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
						$("#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
").removeClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');			
						$("#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
_list").removeClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');			
						$(".<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
_class").removeClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
					}
				});
				
				<?php $_smarty_tpl->_assignInScope('line1', 0);?>
				if (
					<?php
$__section_idy_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['value_displayonly']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_2_total = $__section_idy_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_2_total !== 0) {
for ($__section_idy_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_2_iteration <= $__section_idy_2_total; $__section_idy_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
						<?php if ($_smarty_tpl->tpl_vars['line1']->value == 1) {?>
							&&
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['field_type']->value == 'choice') {?>
							<?php if ($_smarty_tpl->tpl_vars['ope_displayonly']->value == '!=') {?>
								($("input[name=<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
]:checked").val() == '<?php echo $_smarty_tpl->tpl_vars['value_displayonly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
') 
							<?php } else { ?>
								($("input[name=<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
]:checked").val() != '<?php echo $_smarty_tpl->tpl_vars['value_displayonly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
') 
							<?php }?>
						<?php } else { ?>
							<?php if ($_smarty_tpl->tpl_vars['ope_displayonly']->value == '!=') {?>
								($("#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1").val() == '<?php echo $_smarty_tpl->tpl_vars['value_displayonly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
') 
							<?php } else { ?>
								($("#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1").val() != '<?php echo $_smarty_tpl->tpl_vars['value_displayonly']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)];?>
') 
							<?php }?>
						<?php }?>
						<?php $_smarty_tpl->_assignInScope('line1', 1);?>
					<?php
}
}
?>
				) {
					$("a[href='#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
']").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
					$("label[for='<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
']").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
					$("#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
					$("#<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
_list").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
					$(".<?php echo $_smarty_tpl->tpl_vars['field_id_displayonly']->value;?>
_class").addClass('display-none-<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
');
				}
				
	<?php $_smarty_tpl->_assignInScope('line', 1);
}
}
?>
	<?php if ($_smarty_tpl->tpl_vars['line']->value == 1) {?>
				}
			);
		<?php echo '</script'; ?>
>
	<?php }
echo $_smarty_tpl->tpl_vars['field_html']->value;?>

<?php }
}
