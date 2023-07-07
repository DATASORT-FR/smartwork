<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:54:55
  from 'E:\xampp\htdocs\smartwork\modules\mediamanager\templates\src\listpath.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6345214f3dfb90_26084631',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d2a499106441cfb867e1fc4b98753a1288b3a07' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\mediamanager\\templates\\src\\listpath.tpl',
      1 => 1637774176,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6345214f3dfb90_26084631 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="thumbnails list-inline">
	<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['listFile']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<?php if ($_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['type'] == 'dir') {?>
			<li class="thumbnail-dir list-inline-item center" title="<?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['name'];?>
">
				<div class="height-60">
					<span class="fa fa-folder fa-3x"></span>
				</div>
				<div class="small"><?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];?>
</div>
			</li>
		<?php } elseif ($_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['type'] == 'image') {?>
			<li class="thumbnail-image list-inline-item center <?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['class'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['name'];?>
">
				<div class="height-60">
					<img src="<?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['file'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['name'];?>
" class="img_preview" width="60" height="60">
				</div>
				<div class="small"><?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];?>
</div>
			</li>
		<?php } elseif ($_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['type'] == 'file') {?>
			<li class="thumbnail-image list-inline-item center" title="<?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['name'];?>
">
				<div class="height-60">
					<span class="far fa-file fa-3x"></span>
				</div>
				<div class="small"><?php echo $_smarty_tpl->tpl_vars['listFile']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['label'];?>
</div>
			</li>
		<?php }?>
	<?php
}
}
?>
</ul>
<?php }
}
