<?php
/* Smarty version 4.1.1, created on 2022-10-03 17:20:01
  from 'E:\xampp\htdocs\smartwork\modules\crud\templates\src\group.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633afda1420302_18778443',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b63852740b1699a81e84af7e4912ce292f3ac19' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\crud\\templates\\src\\group.tpl',
      1 => 1619615377,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633afda1420302_18778443 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_471308443633afda141eb76_18898508', 'Main');
?>

<?php }
/* {block 'Main'} */
class Block_471308443633afda141eb76_18898508 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_471308443633afda141eb76_18898508',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


	<?php if ($_smarty_tpl->tpl_vars['group_id']->value != '') {?>
		<fieldset id ="<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
" class="form-group">
	<?php }?>
		<?php echo $_smarty_tpl->tpl_vars['display_html']->value;?>

	<?php if ($_smarty_tpl->tpl_vars['group_id']->value != '') {?>
		</fieldset>
	<?php }?>

<?php
}
}
/* {/block 'Main'} */
}
