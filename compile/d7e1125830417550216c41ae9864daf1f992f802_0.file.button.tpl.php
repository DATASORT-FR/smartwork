<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:54
  from 'E:\xampp\htdocs\smartwork\plugins\button\templates\src\button.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d167503e3_81057695',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7e1125830417550216c41ae9864daf1f992f802' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\button\\templates\\src\\button.tpl',
      1 => 1493954439,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d167503e3_81057695 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['field_value']->value['pageflag']) {?>
	<button type="button" class="btn btn-primary bt-proc-page form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 event="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['ref'];?>
">
		<?php echo $_smarty_tpl->tpl_vars['field_value']->value['text'];?>

	</button>
<?php } else { ?>
	<button type="button" class="btn btn-primary bt-proc form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 event="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['ref'];?>
">
		<?php echo $_smarty_tpl->tpl_vars['field_value']->value['text'];?>

	</button>
<?php }
}
}
