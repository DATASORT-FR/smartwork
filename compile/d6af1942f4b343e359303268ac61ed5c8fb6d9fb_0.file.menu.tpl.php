<?php
/* Smarty version 4.1.1, created on 2022-10-11 10:02:36
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6345231c5669e6_64661253',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd6af1942f4b343e359303268ac61ed5c8fb6d9fb' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\menu.tpl',
      1 => 1493825441,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6345231c5669e6_64661253 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for "menu" list screen.
*
* @package    use_menu
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14748237796345231c563af7_68124491', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_14748237796345231c563af7_68124491 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_14748237796345231c563af7_68124491',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_menus", "<?php echo $_smarty_tpl->tpl_vars['page_ref']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_menus" class="box-header block-adm block-menu_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_menu');?>
" box-id="menus" box-model="box-model">			
	</div>
	
<?php
}
}
/* {/block 'Main'} */
}
