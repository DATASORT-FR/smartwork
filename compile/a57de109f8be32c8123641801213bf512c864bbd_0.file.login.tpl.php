<?php
/* Smarty version 4.1.1, created on 2022-10-11 15:54:54
  from 'E:\xampp\htdocs\smartwork\apps\separation_v1\templates\src\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634575ae963618_05378235',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a57de109f8be32c8123641801213bf512c864bbd' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v1\\templates\\src\\login.tpl',
      1 => 1633701252,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634575ae963618_05378235 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1905181495634575ae95d0f5_68795978', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_1905181495634575ae95d0f5_68795978 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1905181495634575ae95d0f5_68795978',
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
