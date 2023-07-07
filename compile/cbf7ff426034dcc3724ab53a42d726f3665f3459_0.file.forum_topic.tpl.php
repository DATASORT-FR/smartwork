<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:33:04
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\forum_topic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930ee0d48bd5_33634999',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cbf7ff426034dcc3724ab53a42d726f3665f3459' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\forum_topic.tpl',
      1 => 1640999935,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930ee0d48bd5_33634999 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for forum topics list screen.
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_68126180963930ee0d45c40_83519312', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_68126180963930ee0d45c40_83519312 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_68126180963930ee0d45c40_83519312',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_topics", "<?php echo $_smarty_tpl->tpl_vars['pageRef']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_topics" class="box-header block-adm block-topic_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_forum_topic');?>
" box-id="topics" box-model="box-model">
	</div>
		
<?php
}
}
/* {/block 'Main'} */
}
