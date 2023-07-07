<?php
/* Smarty version 4.1.1, created on 2022-10-07 02:01:44
  from 'E:\xampp\htdocs\smartwork\apps\separation\modules\content\templates\src\list_homelist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633f6c6815c136_02110063',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f049841cc0d17f3a200aa70474e3704d1d540c7' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\modules\\content\\templates\\src\\list_homelist.tpl',
      1 => 1633735131,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633f6c6815c136_02110063 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('line', 0);?>
<div class="blog-news-carousel">
	<div class="owl-carousel owl-theme">
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
	<div class="owl-theme">
		<div class="owl-controls">
			<div class="custom-nav owl-nav">
			</div>
		</div>
	</div>
</div>
<?php }
}
