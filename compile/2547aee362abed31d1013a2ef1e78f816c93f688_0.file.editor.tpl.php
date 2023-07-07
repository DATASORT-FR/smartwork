<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:06:54
  from 'E:\xampp\htdocs\smartwork\plugins\editor\templates\src\editor.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639308bec47599_65462111',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2547aee362abed31d1013a2ef1e78f816c93f688' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\editor\\templates\\src\\editor.tpl',
      1 => 1652794890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639308bec47599_65462111 (Smarty_Internal_Template $_smarty_tpl) {
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
								'undo', 'redo', '|',
								'heading', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
								'bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', '|',
								'alignment', 'outdent', 'indent', '-',
								'insertImage', 'blockQuote', 'insertTable', 'codeBlock', '|',
								'sourceEditing'
							],
							viewportTopOffset: 30,
							shouldNotGroupWhenFull: true
						},
						image: {
							toolbar: [
								'toggleImageCaption',
								'imageTextAlternative',
								'|',
								'linkImage'
							],
							styles: {
								options: [ 'alignLeft', 'alignRight' ]
							}
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
