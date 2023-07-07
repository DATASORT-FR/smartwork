<?php
/* Smarty version 4.1.1, created on 2022-12-09 18:39:19
  from 'E:\xampp\htdocs\smartwork\apps\forum\templates\src\topic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639372c736c475_35284241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e7d2a00c540779b03a816b9a5ca3921062692e4' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\templates\\src\\topic.tpl',
      1 => 1644875549,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639372c736c475_35284241 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1003300376639372c7368fa8_14668469', 'Main');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_1003300376639372c7368fa8_14668469 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1003300376639372c7368fa8_14668469',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section>
		<div class="container forum-content" href="<?php echo $_smarty_tpl->tpl_vars['pageConnect']->value;?>
">
			<?php echo $_smarty_tpl->tpl_vars['topicBlock']->value;?>

			<?php echo $_smarty_tpl->tpl_vars['postBlock']->value;?>

		</div>
    </section>
<?php
}
}
/* {/block 'Main'} */
}
