<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:54:15
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa261735b611_45291632',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd89d872640ce2db6ae78530fdbbb85f91d6e50d3' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\index.tpl',
      1 => 1646066702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aa261735b611_45291632 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_174074926063aa261734fc56_34434003', 'Content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "templateMain.tpl");
}
/* {block 'Content'} */
class Block_174074926063aa261734fc56_34434003 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Content' => 
  array (
    0 => 'Block_174074926063aa261734fc56_34434003',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo $_smarty_tpl->tpl_vars['PageBlock']->value;?>

	<div class="card list_article">
		<div class="card-header p-b-0">
			<h2 class="card-title"><i class="fa fa-briefcase fa-white" aria-hidden="true"></i><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_last_offers');?>
</h2>
		</div>
		<div class="card-body">
			<?php $_smarty_tpl->_assignInScope('line', 0);?>
			<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['jobList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
				<div class="row">
					<article class="col-xs-12">
						<h3><a href="<?php echo $_smarty_tpl->tpl_vars['jobList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['href'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['jobList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['title_alt'];?>
"><?php echo $_smarty_tpl->tpl_vars['jobList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['title'];?>
</a></h3>
						<p><?php echo $_smarty_tpl->tpl_vars['jobList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)]['intro'];?>
</p>
					</article>
				</div>
			<?php
}
}
?>
		</div>
	</div>
<?php
}
}
/* {/block 'Content'} */
}
