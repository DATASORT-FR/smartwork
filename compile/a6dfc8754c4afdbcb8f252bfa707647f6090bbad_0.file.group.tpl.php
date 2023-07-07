<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:48:59
  from 'E:\xampp\htdocs\smartwork\plugins\group\templates\src\group.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451febf170a4_82173533',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a6dfc8754c4afdbcb8f252bfa707647f6090bbad' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\group\\templates\\src\\group.tpl',
      1 => 1493943464,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451febf170a4_82173533 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="group-content  <?php echo $_smarty_tpl->tpl_vars['field_class']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
">
<?php if ($_smarty_tpl->tpl_vars['field_value']->value['label'] != '') {?>
	<label class="group-label"><?php echo $_smarty_tpl->tpl_vars['field_value']->value['label'];?>
</label>
<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['field_value']->value['html'];?>

</div><?php }
}
