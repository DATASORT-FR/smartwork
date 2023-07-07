<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:57:32
  from 'E:\xampp\htdocs\smartwork\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa26dc805a96_80633001',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3ad7ba4380399c00ec37dc46956dbb3fa73732ef' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\templates\\src\\index.tpl',
      1 => 1494854027,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aa26dc805a96_80633001 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_196839835463aa26dc8026c4_43319371', 'Header_Right');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_135821773763aa26dc805365_48564162', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Header_Right'} */
class Block_196839835463aa26dc8026c4_43319371 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Header_Right' => 
  array (
    0 => 'Block_196839835463aa26dc8026c4_43319371',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo $_smarty_tpl->tpl_vars['IncConnect']->value;?>

<?php
}
}
/* {/block 'Header_Right'} */
/* {block 'Main'} */
class Block_135821773763aa26dc805365_48564162 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_135821773763aa26dc805365_48564162',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo $_smarty_tpl->tpl_vars['IncApps']->value;?>

<?php
}
}
/* {/block 'Main'} */
}
