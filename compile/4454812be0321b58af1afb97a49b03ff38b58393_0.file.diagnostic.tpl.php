<?php
/* Smarty version 4.1.1, created on 2022-11-26 04:21:08
  from 'E:\xampp\htdocs\smartwork\apps\separation_v1\templates\src\diagnostic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63818624d544c9_13169451',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4454812be0321b58af1afb97a49b03ff38b58393' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v1\\templates\\src\\diagnostic.tpl',
      1 => 1661764282,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63818624d544c9_13169451 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_27571287363818624d4d868_71256538', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_27571287363818624d4d868_71256538 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_27571287363818624d4d868_71256538',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

   <section>
		<div class="container mt-5 mb-5">
			<?php echo (($tmp = $_smarty_tpl->tpl_vars['contentBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

			<div class="row text-center">
				<a class="btn btn-tool col-sm-6 mx-auto text-center" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkOutil']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
					<h2>Cliquez pour commencer</h2>
				</a>
			</div>
		</div>
    </section>
<?php
}
}
/* {/block 'Main'} */
}
