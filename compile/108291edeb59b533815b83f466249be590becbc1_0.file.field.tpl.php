<?php
/* Smarty version 4.1.1, created on 2022-10-03 17:20:00
  from 'E:\xampp\htdocs\smartwork\modules\crud\templates\src\field.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633afda0820837_87739655',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '108291edeb59b533815b83f466249be590becbc1' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\crud\\templates\\src\\field.tpl',
      1 => 1622670608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633afda0820837_87739655 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_769563741633afda081c887_32764246', 'Main');
?>

<?php }
/* {block 'Main'} */
class Block_769563741633afda081c887_32764246 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_769563741633afda081c887_32764246',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php if ($_smarty_tpl->tpl_vars['field']->value['container']) {?> 
	<div id="<?php echo $_smarty_tpl->tpl_vars['field']->value['field_id'];?>
" class="input-<?php echo $_smarty_tpl->tpl_vars['field']->value['type'];?>
 div-control <?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['field']->value['class'];?>
">
<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['field']->value['collabelflag']) {?> 
		<?php if ($_smarty_tpl->tpl_vars['field']->value['collabel'] != '') {?>
			<label class="col-label"><?php echo $_smarty_tpl->tpl_vars['field']->value['collabel'];?>
</label>
		<?php }?>
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['display_html']->value;?>

<?php if ($_smarty_tpl->tpl_vars['field']->value['container']) {?> 
	</div>
<?php }
}
}
/* {/block 'Main'} */
}
