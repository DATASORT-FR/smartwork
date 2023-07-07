<?php
/* Smarty version 4.1.1, created on 2022-12-09 17:13:32
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63935eac3ac0a9_29843042',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfcc5a4599f5bf9ce7d6d6964cbc8b1ac851bb16' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\content.tpl',
      1 => 1523010217,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63935eac3ac0a9_29843042 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
$_smarty_tpl->_assignInScope('LeftSideDisplay', 0);?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_151532360363935eac3ab861_37498864', 'Main');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "templateMain.tpl");
}
/* {block 'Main'} */
class Block_151532360363935eac3ab861_37498864 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_151532360363935eac3ab861_37498864',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo $_smarty_tpl->tpl_vars['Content']->value;?>

<?php
}
}
/* {/block 'Main'} */
}
