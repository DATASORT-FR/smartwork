<?php
/* Smarty version 4.1.1, created on 2022-10-11 15:02:03
  from 'E:\xampp\htdocs\smartwork\apps\separation_v1\templates\src\dossiers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6345694b5ed824_24071506',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9feed13d230ad4db7cef0778d6398430adb6a0c' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v1\\templates\\src\\dossiers.tpl',
      1 => 1633703510,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6345694b5ed824_24071506 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16253993636345694b5e71a4_87559617', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_16253993636345694b5e71a4_87559617 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_16253993636345694b5e71a4_87559617',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

   <section>
		<div class="container mt-5 mb-4">
			<?php echo (($tmp = $_smarty_tpl->tpl_vars['contentBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

		</div>
		<div class="container mb-5">
 			<?php echo (($tmp = $_smarty_tpl->tpl_vars['listBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

		</div>
    </section>
 <?php
}
}
/* {/block 'Main'} */
}
