<?php
/* Smarty version 4.1.1, created on 2022-10-03 17:20:01
  from 'E:\xampp\htdocs\smartwork\modules\crud\templates\src\line.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633afda1213881_80510138',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b37fefc39e80465298b7e22eaf8f9f5016f6f1b4' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\crud\\templates\\src\\line.tpl',
      1 => 1651504011,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633afda1213881_80510138 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_235420694633afda120f320_04356864', 'Main');
?>

<?php }
/* {block 'Main'} */
class Block_235420694633afda120f320_04356864 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_235420694633afda120f320_04356864',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['field']->value['rowflag']) {?>
		<div  id ="<?php echo $_smarty_tpl->tpl_vars['line_id']->value;?>
" class="row form-row form-group">
			<?php echo $_smarty_tpl->tpl_vars['display_html']->value;?>

		</div>
	<?php } else { ?>
		<?php echo $_smarty_tpl->tpl_vars['display_html']->value;?>

	<?php }
}
}
/* {/block 'Main'} */
}
