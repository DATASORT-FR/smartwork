<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:54
  from 'E:\xampp\htdocs\smartwork\plugins\list\templates\src\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d16581476_12675418',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d012a28359c56b85d54955f67b75e195008b0c4' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\list\\templates\\src\\list.tpl',
      1 => 1652743052,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d16581476_12675418 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['field_value']->value['readonly'] == true) {?>
	<?php
$__section_idy_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['list']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_0_total = $__section_idy_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_0_total !== 0) {
for ($__section_idy_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_0_iteration <= $__section_idy_0_total; $__section_idy_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
		<?php if ($_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['field_value']->value['value']) {?>
			<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" type="text" class="form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
 value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['description'];?>
">
		<?php }?>
	<?php
}
}
} else { ?>
	<?php if ($_smarty_tpl->tpl_vars['field_value']->value['display'] != '') {?>
		<?php echo '<script'; ?>
>
			$(document).ready(
				function() {
					$("#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1").change(function() {
						var code= $("#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1").val();
						if (code != '0') {
							var theHREF = '<?php echo $_smarty_tpl->tpl_vars['field_value']->value['display'];?>
' + '/' + code;
							$.ajax({
								url: theHREF,
								success: function(data) {
									console.log(data);
									<?php
$__section_idy_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['link']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_1_total = $__section_idy_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_1_total !== 0) {
for ($__section_idy_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_1_iteration <= $__section_idy_1_total; $__section_idy_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
										$('[name="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
"]').val(data['<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['data'];?>
']);
										if ($('[name="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
"]').hasClass("input-editor")) {
											editors['<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
'].setData(data['<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['data'];?>
']);
										}
										if ($('[name="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
"]').hasClass("img_input")) {
											init_image($('[name="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
"]'));
										}
									<?php
}
}
?>
								}
							});
						}
						else {
							<?php
$__section_idy_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['link']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_2_total = $__section_idy_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_2_total !== 0) {
for ($__section_idy_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_2_iteration <= $__section_idy_2_total; $__section_idy_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
								$('[name="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
"]').val('');
								if ($('[name="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
"]').hasClass("input-editor")) {
									editors['<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
'].setData('');
								}
								if ($('[name="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
"]').hasClass("img_input")) {
									init_image($('[name="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['link'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['field'];?>
"]'));
								}
							<?php
}
}
?>
						}
					});
				}
			);
		<?php echo '</script'; ?>
>
	<?php }?>

	<select id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" class="form-control form-select <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
		<?php
$__section_idy_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['list']) ? count($_loop) : max(0, (int) $_loop));
$__section_idy_3_total = $__section_idy_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idy'] = new Smarty_Variable(array());
if ($__section_idy_3_total !== 0) {
for ($__section_idy_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] = 0; $__section_idy_3_iteration <= $__section_idy_3_total; $__section_idy_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
				<?php if ($_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['field_value']->value['value']) {?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['description'];?>
</option>  
				<?php } else { ?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['description'];?>
</option>  
				<?php }?>
			<?php } else { ?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['field_value']->value['list'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idy']->value['index'] : null)]['description'];?>
</option>  
			<?php }?>
		<?php
}
}
?>
	</select>
<?php }?>
	<?php }
}
