<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:15:01
  from 'E:\xampp\htdocs\smartwork\apps\forum\modules\forum\templates\src\listpost.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930aa5c5b4e7_67050170',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dedfb6146ab215eee7fd7f3389ff5f0d2ae31c75' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\modules\\forum\\templates\\src\\listpost.tpl',
      1 => 1644876788,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930aa5c5b4e7_67050170 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="forum-btn">
	<button type="button" class="btn btn-primary bt-forum-proc-page bt-forum" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['post_linkCreate']->value;?>
" target="#block-response">
		<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_post_create');?>

	</button>
</div>
<table class="forum-list forum-list-post table table-borderless table-striped table-hover text-left">
	<tbody>
	<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['listPost']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<tr class="forum-post">
			<td class="forum-post block-ws block-main" scope="row" box-model="box-model" link_href="<?php echo $_smarty_tpl->tpl_vars['listPost']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" position="">
				<?php echo $_smarty_tpl->tpl_vars['listPost']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['html'];?>

			</td>
		</tr>
	<?php
}
}
?>
	</tbody>
</table>
<div id="block-response" class="block-ws block-main box-header block-create-post" title="">
</div>
<?php }
}
