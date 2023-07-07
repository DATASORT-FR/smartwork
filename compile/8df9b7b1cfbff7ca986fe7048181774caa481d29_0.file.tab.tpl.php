<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:06:54
  from 'E:\xampp\htdocs\smartwork\plugins\tab\templates\src\tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639308beddada2_66409753',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8df9b7b1cfbff7ca986fe7048181774caa481d29' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\plugins\\tab\\templates\\src\\tab.tpl',
      1 => 1646216851,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639308beddada2_66409753 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
	$(document).ready(
		function() {		
			if (typeof(crudTab['<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
']) == 'undefined' ) {
				crudTab['<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
'] = '<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_1';
			}
			$('#'+crudTab['<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
']).tab('show');
			
//			var <?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_maxHeight = -1;
//			$("#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
Content div.tab-pane").each(function() {
//				var h = $(this).height(); 
//				<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_maxHeight = h > <?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_maxHeight ? h : <?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_maxHeight;
//			});
//			$('#<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
Content').height(<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_maxHeight);
		}
	);
<?php echo '</script'; ?>
>

<ul id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
" class="nav nav-tabs">
	<?php $_smarty_tpl->_assignInScope('line', 0);?>
	<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['field_value']->value['content']) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<?php $_smarty_tpl->_assignInScope('field_content', $_smarty_tpl->tpl_vars['field_value']->value['content'][(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]);?>
		<li class="nav-item">
			<a id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['line']->value+1;?>
" class="nav-link" data-bs-toggle="tab" href="#<?php echo $_smarty_tpl->tpl_vars['field_content']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['field_content']->value['label'];?>
</a>
		</li>			
		<?php $_smarty_tpl->_assignInScope('line', $_smarty_tpl->tpl_vars['line']->value+1);?>
	<?php
}
}
?>
</ul>
<div id="<?php echo $_smarty_tpl->tpl_vars['field_id']->value;?>
Content" class="tab-content">
	<?php echo $_smarty_tpl->tpl_vars['field_value']->value['html'];?>

</div><?php }
}
