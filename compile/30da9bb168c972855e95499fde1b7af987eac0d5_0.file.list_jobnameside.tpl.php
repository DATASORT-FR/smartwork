<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\content\templates\src\list_jobnameside.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cdabb8c8_26623034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30da9bb168c972855e95499fde1b7af987eac0d5' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\content\\templates\\src\\list_jobnameside.tpl',
      1 => 1525945327,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cdabb8c8_26623034 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="list_article list_contentside">
	<?php $_smarty_tpl->_assignInScope('line', 0);?>
	<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['listIntro']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<?php echo $_smarty_tpl->tpl_vars['listIntro']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>

		<?php $_smarty_tpl->_assignInScope('line', $_smarty_tpl->tpl_vars['line']->value+1);?>
	<?php
}
}
?>
</div>
<?php }
}
