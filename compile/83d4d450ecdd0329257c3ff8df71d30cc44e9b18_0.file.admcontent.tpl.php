<?php
/* Smarty version 4.1.1, created on 2022-12-17 00:13:36
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\admcontent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639cfba01987c7_55368575',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83d4d450ecdd0329257c3ff8df71d30cc44e9b18' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\admcontent.tpl',
      1 => 1511573506,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639cfba01987c7_55368575 (Smarty_Internal_Template $_smarty_tpl) {
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1784217521639cfba0195762_48292436', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_1784217521639cfba0195762_48292436 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1784217521639cfba0195762_48292436',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_contents", "<?php echo $_smarty_tpl->tpl_vars['pageRef']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_contents" class="box-header block-adm block-content_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_content');?>
" box-id="contents" box-model="box-model">
	</div>
		
<?php
}
}
/* {/block 'Main'} */
}
