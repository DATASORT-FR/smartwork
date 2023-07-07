<?php
/* Smarty version 4.1.1, created on 2022-10-11 10:19:27
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\user.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6345270f31e5b6_00534600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77906f0f09e1fcd665d8b8471cc9b374e34d04a9' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\user.tpl',
      1 => 1493825488,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6345270f31e5b6_00534600 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for "module" list screen.
*
* @package    use_user
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14088248516345270f31b020_96101290', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_14088248516345270f31b020_96101290 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_14088248516345270f31b020_96101290',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_users", "<?php echo $_smarty_tpl->tpl_vars['page_ref']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_users" class="box-header block-adm block-user_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_user');?>
" box-id="users" box-model="box-model">			
	</div>
	
<?php
}
}
/* {/block 'Main'} */
}
