<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:54
  from 'E:\xampp\htdocs\smartwork\plugins\choice\templates\src\choice.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d168b4861_14599103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff8a1be57f4363ec5437d452b3b3ca65bc1ec897' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\choice\\templates\\src\\choice.tpl',
      1 => 1619732057,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d168b4861_14599103 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['field_value']->value['readonly'] == true) {?>
	<div id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" class="form-control check-container" <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
		<div class="form-check-inline">
			<label for="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" class="form-check-label <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
				<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
					<?php if ($_smarty_tpl->tpl_vars['field_value']->value['value'] == 1) {?>
						<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="0" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" disabled>
					<?php } else { ?>
						<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="0" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" checked disabled>
					<?php }?>
				<?php } else { ?>
					<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="0" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" checked disabled>
				<?php }?>
				<?php echo $_smarty_tpl->tpl_vars['field_value']->value['label1'];?>

			</label>
		</div>
		<div class="form-check-inline">
			<label for="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_2" class="form-check-label control-label <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
				<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
					<?php if ($_smarty_tpl->tpl_vars['field_value']->value['value'] == 1) {?>
						<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="1" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_2" checked disabled>
					<?php } else { ?>
						<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="1" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_2" disabled>
					<?php }?>
				<?php } else { ?>
					<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="1" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_2" disabled>
				<?php }?>
				<?php echo $_smarty_tpl->tpl_vars['field_value']->value['label2'];?>

			</label>
		</div>
	</div>
<?php } else { ?>
	<div id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" class="form-inline">
		<div class="form-check-inline">
			<label for="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" class="form-check-label <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
				<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
					<?php if ($_smarty_tpl->tpl_vars['field_value']->value['value'] == 1) {?>
						<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="0" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1">
					<?php } else { ?>
						<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="0" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" checked>
					<?php }?>
				<?php } else { ?>
					<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="0" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1" checked>
				<?php }?>
				<?php echo $_smarty_tpl->tpl_vars['field_value']->value['label1'];?>

			</label>
		</div>
		<div class="form-check-inline">
			<label for="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_2" class="form-check-label control-label <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
				<?php if ($_smarty_tpl->tpl_vars['display']->value == 'edit') {?>
					<?php if ($_smarty_tpl->tpl_vars['field_value']->value['value'] == 1) {?>
						<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="1" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_2" checked>
					<?php } else { ?>
						<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="1" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_2">
					<?php }?>
				<?php } else { ?>
					<input class="form-check-input" type="radio" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="1" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_2">
				<?php }?>
				<?php echo $_smarty_tpl->tpl_vars['field_value']->value['label2'];?>

			</label>
		</div>
	</div>
<?php }
}
}
