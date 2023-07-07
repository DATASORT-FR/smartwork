<?php
/* Smarty version 4.1.1, created on 2022-12-17 00:13:14
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\admcontent_category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639cfb8ab54646_27548522',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8bd851399476cf206942576c54056d585c57f20a' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\admcontent_category.tpl',
      1 => 1511908615,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639cfb8ab54646_27548522 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for "content" list screen.
*
* @package    use_content
* @subpackage view
* @version    1.0
* @date       25 November 2017
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1485659343639cfb8ab51570_62642922', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_1485659343639cfb8ab51570_62642922 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1485659343639cfb8ab51570_62642922',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_content_categories", "<?php echo $_smarty_tpl->tpl_vars['pageRef']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_content_categories" class="box-header block-adm block-content_category_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_admcontent_category');?>
" box-id="contents" box-model="box-model">
	</div>
		
<?php
}
}
/* {/block 'Main'} */
}
