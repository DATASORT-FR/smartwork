<?php
/* Smarty version 4.1.1, created on 2022-12-09 16:22:37
  from 'E:\xampp\htdocs\smartwork\apps\separation\templates\src\apropos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639352bd160d10_28338770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd4ddd05ef3b91521a1d7b056d34e25f985456fd' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\templates\\src\\apropos.tpl',
      1 => 1639530918,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639352bd160d10_28338770 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_98923782639352bd15ac17_70281196', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_98923782639352bd15ac17_70281196 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_98923782639352bd15ac17_70281196',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

   <section>
		<div class="container mt-5">
			<?php echo (($tmp = $_smarty_tpl->tpl_vars['contentBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

		</div>
    </section>
<?php
}
}
/* {/block 'Main'} */
}
