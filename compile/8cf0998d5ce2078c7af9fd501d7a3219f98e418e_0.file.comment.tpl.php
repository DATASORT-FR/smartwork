<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:16:16
  from 'E:\xampp\htdocs\smartwork\plugins\comment\templates\src\comment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930af0e4fee6_21238750',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cf0998d5ce2078c7af9fd501d7a3219f98e418e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\comment\\templates\\src\\comment.tpl',
      1 => 1652794788,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930af0e4fee6_21238750 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['field_value']->value['readonly'] == true) {?>
	<div class="input-editor" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
><?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
</div>
<?php } else { ?>
	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				var <?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_size = (<?php echo $_smarty_tpl->tpl_vars['field_param']->value['rows'];?>
*(parseInt($('#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
').css('font-size'))*4/3)) - 159;
				var <?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_editor;
				
				ClassicEditor
					.create(document.querySelector('#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
'),{
						toolbar: {
							items: [
								'fontColor', 'fontBackgroundColor', 'bold', 'italic', 'underline', 'blockquote', 'bulletedList', 'numberedList'
							],
							viewportTopOffset: 30,
							shouldNotGroupWhenFull: true
						}
					})
					.then( editor => {
						<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_editor = editor;
						editors['<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
'] = editor;
						
						editor.model.document.on('change:data', () => {
							document.getElementById('<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
').innerHTML = editor.getData();
							$("#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
").val(editor.getData());
						});
					})
					.catch( error => {
						console.error(error);
					});
				
			}
		);
	<?php echo '</script'; ?>
>
	<textarea class="form-control input-editor <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['field_attr']->value;?>
><?php echo $_smarty_tpl->tpl_vars['field_value']->value['value'];?>
</textarea>
<?php }?>
	<?php }
}
