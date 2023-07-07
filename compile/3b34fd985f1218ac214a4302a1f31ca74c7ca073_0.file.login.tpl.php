<?php
/* Smarty version 4.1.1, created on 2022-10-11 13:45:29
  from 'E:\xampp\htdocs\smartwork\apps\separation\templates\src\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63455759966004_24959243',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b34fd985f1218ac214a4302a1f31ca74c7ca073' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\templates\\src\\login.tpl',
      1 => 1633701252,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63455759966004_24959243 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_61683770663455759955846_95981356', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_61683770663455759955846_95981356 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_61683770663455759955846_95981356',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

   <section>
		<div class="container mt-5">
			<?php echo (($tmp = $_smarty_tpl->tpl_vars['contentBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

		</div>
		<div class="container mb-5">
			<?php echo $_smarty_tpl->tpl_vars['loginBox']->value;?>

		</div>
    </section>
<?php
}
}
/* {/block 'Main'} */
}
