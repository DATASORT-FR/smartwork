<?php
/* Smarty version 4.1.1, created on 2022-12-09 18:39:21
  from 'E:\xampp\htdocs\smartwork\apps\forum\templates\src\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639372c9c40895_60832068',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c049bf1ec414f6af08e5ffa118cf4e98fcac41b1' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\templates\\src\\home.tpl',
      1 => 1644406201,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639372c9c40895_60832068 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1369401798639372c9c3da52_70157410', 'Main');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_1369401798639372c9c3da52_70157410 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1369401798639372c9c3da52_70157410',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section>
		<div class="container forum-content">
			<h1 class="header-image" itemprop="title">
				Forum
			</h1>
			<?php echo $_smarty_tpl->tpl_vars['breadCrumbBlock']->value;?>

			<div class="forum">
				<h3 class="last-topic-header">
					Les dernières discussions
				</h3>
				<?php echo $_smarty_tpl->tpl_vars['lastBlock']->value;?>

			</diV>
			<?php echo $_smarty_tpl->tpl_vars['subjectBlock']->value;?>

		</div>
    </section>
<?php
}
}
/* {/block 'Main'} */
}
