<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:14:26
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\forum_subject.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930a820b2d56_80340461',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d14f5daeda4be1f454a9fc57ab253f78e6ac5e2' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\forum_subject.tpl',
      1 => 1640999923,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930a820b2d56_80340461 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for forum subjects list screen.
*
* @package    use_forum
* @subpackage view
* @version    1.0
* @date       29 December 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_195225474363930a820afcd7_57304535', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_195225474363930a820afcd7_57304535 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_195225474363930a820afcd7_57304535',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_subjects", "<?php echo $_smarty_tpl->tpl_vars['pageRef']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_subjects" class="box-header block-adm block-subject_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_forum_subject');?>
" box-id="subjects" box-model="box-model">
	</div>
		
<?php
}
}
/* {/block 'Main'} */
}
