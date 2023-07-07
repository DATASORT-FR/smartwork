<?php
/* Smarty version 4.1.1, created on 2022-12-09 16:12:19
  from 'E:\xampp\htdocs\smartwork\apps\separation\modules\content\templates\src\list_contentside.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63935053c9ea24_40607174',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f24b59b507483b50d7f9a01073ac380a013f7eba' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\modules\\content\\templates\\src\\list_contentside.tpl',
      1 => 1633735384,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63935053c9ea24_40607174 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('line', 0);
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['listIntro']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
	<?php echo $_smarty_tpl->tpl_vars['listIntro']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>

	<?php $_smarty_tpl->_assignInScope('line', $_smarty_tpl->tpl_vars['line']->value+1);
}
}
}
}
