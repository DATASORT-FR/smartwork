<?php
/* Smarty version 4.1.1, created on 2022-12-09 17:13:46
  from 'E:\xampp\htdocs\smartwork\apps\separation\templates\src\dossiers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63935eba615775_54096131',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd8ef29e9399d4fde05304993a019fb90abd55548' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\templates\\src\\dossiers.tpl',
      1 => 1633703510,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63935eba615775_54096131 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_114349908663935eba60f065_01220524', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_114349908663935eba60f065_01220524 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_114349908663935eba60f065_01220524',
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
