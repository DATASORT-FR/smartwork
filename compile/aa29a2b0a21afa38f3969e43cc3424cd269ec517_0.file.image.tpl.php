<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:54
  from 'E:\xampp\htdocs\smartwork\plugins\image\templates\src\image.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d16a42922_47388492',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa29a2b0a21afa38f3969e43cc3424cd269ec517' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\image\\templates\\src\\image.tpl',
      1 => 1646221820,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d16a42922_47388492 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['readonly']->value == false) {?>
	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_image($("#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
"));
			}
		);
	<?php echo '</script'; ?>
>
	
	<div id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_Container" class="img_container row form-group <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
">
		<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" type="hidden" class="img_input" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
">
		<div class="img_container_preview col-sm-3 col-xs-12">
			<img id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_Image" class="img_preview" alt="" src="" onerror="this.src = './plugins/image/images/notfound.png';">
		</div>
		<div class="img_container_all col-sm-9 col-xs-12">
			<div class="img_container_img">
				<div class="input-group">
					<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_img" type="text" class="img_input_img form-control">
					<button id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_Button_empty" type="button" class="btn btn-primary bt-empty form-control">
						<span class="fa fa-remove"></span>
					</button>
					<button id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_Button_media" type="button" class="btn btn-primary bt-media form-control" event="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['ref'];?>
" default="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['path'];?>
">
						<span class="fa fa-picture-o"></span>
					</button>
				</div>
			</div>
			<div class="img_container_alt row">
				<label for="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_alt" class="form-label text-sm-end col-sm-3"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_image_alt');?>
</label>
				<div class="col-sm-9">
					<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_alt" type="text" class="img_input_alt form-control">
				</div>
			</div>
			<div class="img_container_title row">
				<label for="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_title" class="form-label text-sm-end col-sm-3"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_image_title');?>
</label>
				<div class="col-sm-9">
					<input id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_title" type="text" class="img_input_title form-control">
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
	<img id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_Image" class="img_preview" alt="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['alt'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['image'];?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
>
<?php }?>
	
	<?php }
}
