<?php
/* Smarty version 4.1.1, created on 2022-12-17 00:13:36
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639cfba01a3173_10948743',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f366ab69c2b58aa9aa161ee25f43f16074841269' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\index.tpl',
      1 => 1586745552,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639cfba01a3173_10948743 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for home page
*
* @package    global
* @subpackage view
* @version    1.2
* @date       25 November 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1653004643639cfba01a1b78_96799550', 'Header_Right');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1517986550639cfba01a21c3_89169577', 'Nav_Block');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1397769765639cfba01a2ad2_93588422', 'Right');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard_apps.tpl");
}
/* {block 'Header_Right'} */
class Block_1653004643639cfba01a1b78_96799550 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Header_Right' => 
  array (
    0 => 'Block_1653004643639cfba01a1b78_96799550',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php
}
}
/* {/block 'Header_Right'} */
/* {block 'Nav_Block'} */
class Block_1517986550639cfba01a21c3_89169577 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Nav_Block' => 
  array (
    0 => 'Block_1517986550639cfba01a21c3_89169577',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="nav-bar col-md-8">
		<?php echo $_smarty_tpl->tpl_vars['IncNav']->value;?>

	</div>
	<div class="nav-login col-md-4">	
		<?php echo $_smarty_tpl->tpl_vars['IncConnect']->value;?>

	</div>
<?php
}
}
/* {/block 'Nav_Block'} */
/* {block 'Right'} */
class Block_1397769765639cfba01a2ad2_93588422 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Right' => 
  array (
    0 => 'Block_1397769765639cfba01a2ad2_93588422',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo $_smarty_tpl->tpl_vars['IncHistory']->value;?>

<?php
}
}
/* {/block 'Right'} */
}
