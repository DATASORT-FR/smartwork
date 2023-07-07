<?php
/* Smarty version 4.1.1, created on 2022-10-11 09:47:18
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\module.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63451f86ec5ee8_49705363',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3bb2c2c0b9e5ff020e5742c604b003b57a6c9cec' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\module.tpl',
      1 => 1511812395,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63451f86ec5ee8_49705363 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for "feature" list screen.
*
* @package    use_module
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_84138403463451f86ec1ce4_62340176', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_84138403463451f86ec1ce4_62340176 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_84138403463451f86ec1ce4_62340176',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_modules", "<?php echo $_smarty_tpl->tpl_vars['pageRef']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_modules" class="box-header block-adm block-modules" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_module');?>
" box-id="modules" box-model="box-model">			
	</div>
	
<?php
}
}
/* {/block 'Main'} */
}
