<?php
/* Smarty version 4.1.1, created on 2022-10-11 15:54:48
  from 'E:\xampp\htdocs\smartwork\apps\separation_v1\templates\src\moncompte.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634575a8ef0e09_23296607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '644c26250f6540db35090a467d13cdf5f86df583' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v1\\templates\\src\\moncompte.tpl',
      1 => 1633701355,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634575a8ef0e09_23296607 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1670264556634575a8ee8a02_18188259', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_1670264556634575a8ee8a02_18188259 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1670264556634575a8ee8a02_18188259',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

   <section>
		<div class="container mt-5">
			<?php echo (($tmp = $_smarty_tpl->tpl_vars['contentBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

		</div>
		<div class="container mb-5">
			<?php echo $_smarty_tpl->tpl_vars['IncAccount']->value;?>

		</div>
    </section>
<?php
}
}
/* {/block 'Main'} */
}
