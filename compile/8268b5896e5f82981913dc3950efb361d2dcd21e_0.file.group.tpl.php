<?php
/* Smarty version 4.1.1, created on 2022-10-11 10:19:57
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\group.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6345272d61eff8_51010268',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8268b5896e5f82981913dc3950efb361d2dcd21e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\group.tpl',
      1 => 1493825394,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6345272d61eff8_51010268 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for "group" list screen.
*
* @package    use_group
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15092609896345272d61c1f9_87372781', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_15092609896345272d61c1f9_87372781 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_15092609896345272d61c1f9_87372781',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_groups", "<?php echo $_smarty_tpl->tpl_vars['page_ref']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_groups" class="box-header block-adm block-group_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_group');?>
" box-id="groups" box-model="box-model">			
	</div>
	
<?php
}
}
/* {/block 'Main'} */
}
