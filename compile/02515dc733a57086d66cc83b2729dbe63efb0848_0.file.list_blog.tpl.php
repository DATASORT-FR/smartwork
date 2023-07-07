<?php
/* Smarty version 4.1.1, created on 2022-10-11 14:56:53
  from 'E:\xampp\htdocs\smartwork\apps\separation_v1\modules\content\templates\src\list_blog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634568159187d6_90666473',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02515dc733a57086d66cc83b2729dbe63efb0848' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v1\\modules\\content\\templates\\src\\list_blog.tpl',
      1 => 1632831976,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634568159187d6_90666473 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['btCreate']->value) {?>
	<div class="content_btn">
		<?php if ($_smarty_tpl->tpl_vars['btCreate']->value) {?>
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['content_linkCreate']->value;?>
">
				<span class="fa fa-edit" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_create');?>

			</button>
		<?php }?>
	</div>
<?php }?>
<div class="row blog-grid">
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
