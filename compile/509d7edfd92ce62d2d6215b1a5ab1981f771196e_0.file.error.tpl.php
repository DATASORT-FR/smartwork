<?php
/* Smarty version 4.1.1, created on 2022-12-09 17:03:49
  from 'E:\xampp\htdocs\smartwork\apps\separation\templates\src\error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63935c655dd244_91167890',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '509d7edfd92ce62d2d6215b1a5ab1981f771196e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\templates\\src\\error.tpl',
      1 => 1633388064,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63935c655dd244_91167890 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_211930441863935c655db393_37196084', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_211930441863935c655db393_37196084 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_211930441863935c655db393_37196084',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

   <section>
		<div class="container mt-5 mb-5">
			<article class="block-ws content-update block-main">
				<div class="alert alert-warning">
					<p><strong>Warning!</strong> <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Error_page');?>
</p>
				</div>
			</article>
		</div>
    </section>
<?php
}
}
/* {/block 'Main'} */
}
