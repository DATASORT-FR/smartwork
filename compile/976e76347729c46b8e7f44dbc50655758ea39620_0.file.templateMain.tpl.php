<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:54:15
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\templateMain.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa261736a041_47776275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '976e76347729c46b8e7f44dbc50655758ea39620' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\templateMain.tpl',
      1 => 1646092777,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aa261736a041_47776275 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
$_smarty_tpl->_assignInScope('LeftSideDisplay', 1);
$_smarty_tpl->_assignInScope('RightSideDisplay', 1);?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20457764863aa2617367101_86591213', 'LeftSide');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_45744043863aa26173687e3_27286260', 'Main');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_166496794463aa2617369338_46766333', 'RightSide');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'LeftSide'} */
class Block_20457764863aa2617367101_86591213 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'LeftSide' => 
  array (
    0 => 'Block_20457764863aa2617367101_86591213',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo $_smarty_tpl->tpl_vars['EngageBlock']->value;?>

<!--	
	<?php echo $_smarty_tpl->tpl_vars['CompaniesBlock']->value;?>

-->
	<?php echo $_smarty_tpl->tpl_vars['JobnameSideBlock']->value;?>

<?php
}
}
/* {/block 'LeftSide'} */
/* {block 'Content'} */
class Block_148652831863aa2617368b47_17914769 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php
}
}
/* {/block 'Content'} */
/* {block 'Main'} */
class Block_45744043863aa26173687e3_27286260 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_45744043863aa26173687e3_27286260',
  ),
  'Content' => 
  array (
    0 => 'Block_148652831863aa2617368b47_17914769',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_148652831863aa2617368b47_17914769', 'Content', $this->tplIndex);
?>

<?php
}
}
/* {/block 'Main'} */
/* {block 'RightSide'} */
class Block_166496794463aa2617369338_46766333 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'RightSide' => 
  array (
    0 => 'Block_166496794463aa2617369338_46766333',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo $_smarty_tpl->tpl_vars['LoginBlock']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['StatisticsBlock']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['ContentSideBlock']->value;?>

<!--	
	<?php echo $_smarty_tpl->tpl_vars['CarousselBlock']->value;?>

-->
<?php
}
}
/* {/block 'RightSide'} */
}
