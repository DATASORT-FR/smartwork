<?php
/* Smarty version 4.1.1, created on 2022-12-09 15:42:20
  from 'E:\xampp\htdocs\smartwork\apps\forum\templates\src\subject.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6393494c3fc156_82234465',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e99b95e582f1345123c9a7f37d9172b5c1a9a6f' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\templates\\src\\subject.tpl',
      1 => 1644875552,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6393494c3fc156_82234465 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6745768496393494c3f92b7_67988059', 'Main');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_6745768496393494c3f92b7_67988059 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_6745768496393494c3f92b7_67988059',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section>
		<div class="container forum-content" href="<?php echo $_smarty_tpl->tpl_vars['pageConnect']->value;?>
">
			<?php echo $_smarty_tpl->tpl_vars['subjectBlock']->value;?>

			<?php echo $_smarty_tpl->tpl_vars['topicBlock']->value;?>

		</div>
    </section>
<?php
}
}
/* {/block 'Main'} */
}
