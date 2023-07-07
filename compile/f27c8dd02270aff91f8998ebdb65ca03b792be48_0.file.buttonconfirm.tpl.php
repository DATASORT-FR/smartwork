<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:36:54
  from 'E:\xampp\htdocs\smartwork\plugins\buttonconfirm\templates\src\buttonconfirm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451d1666fa49_24854031',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f27c8dd02270aff91f8998ebdb65ca03b792be48' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\buttonconfirm\\templates\\src\\buttonconfirm.tpl',
      1 => 1588949752,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451d1666fa49_24854031 (Smarty_Internal_Template $_smarty_tpl) {
?><button type="button" class="btn btn-primary bt-proc-confirm form-control <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['field_style']->value;?>
 event="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['ref'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['title'];?>
 <?php echo $_smarty_tpl->tpl_vars['field_value']->value['code'];?>
" label="<?php echo $_smarty_tpl->tpl_vars['field_value']->value['message'];?>
">
	<?php echo $_smarty_tpl->tpl_vars['field_value']->value['text'];?>

</button>
<?php }
}
