<?php
/* Smarty version 4.1.1, created on 2022-10-07 02:01:51
  from 'E:\xampp\htdocs\smartwork\apps\separation\templates\src\diagnostic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633f6c6f46fa78_09191763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52f01e9e8bf2e93966af11df7f9f58c90f6c95d3' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\templates\\src\\diagnostic.tpl',
      1 => 1661764282,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633f6c6f46fa78_09191763 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_745032275633f6c6f45d221_78846746', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_745032275633f6c6f45d221_78846746 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_745032275633f6c6f45d221_78846746',
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
