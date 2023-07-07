<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:54:18
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\templateSearch.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa261af0c483_64892222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e72f651c75c65073a12c981e496fc6f96331a6b' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\templateSearch.tpl',
      1 => 1646228772,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aa261af0c483_64892222 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
$_smarty_tpl->_assignInScope('RightSideDisplay', 1);?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129170071463aa261af0ae90_65025363', 'Main');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_184014513663aa261af0bac6_45196468', 'RightSide');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Content'} */
class Block_104132500563aa261af0b219_63800140 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php
}
}
/* {/block 'Content'} */
/* {block 'Main'} */
class Block_129170071463aa261af0ae90_65025363 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_129170071463aa261af0ae90_65025363',
  ),
  'Content' => 
  array (
    0 => 'Block_104132500563aa261af0b219_63800140',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_104132500563aa261af0b219_63800140', 'Content', $this->tplIndex);
?>

<?php
}
}
/* {/block 'Main'} */
/* {block 'RightSide'} */
class Block_184014513663aa261af0bac6_45196468 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'RightSide' => 
  array (
    0 => 'Block_184014513663aa261af0bac6_45196468',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo $_smarty_tpl->tpl_vars['LoginBlock']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['StatisticsBlock']->value;?>

<!--	
	<?php echo $_smarty_tpl->tpl_vars['CarousselBlock']->value;?>

-->
<?php
}
}
/* {/block 'RightSide'} */
}
