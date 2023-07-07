<?php
/* Smarty version 4.1.1, created on 2022-12-17 00:13:49
  from 'E:\xampp\htdocs\smartwork\templates\src\simple.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639cfbad9ee1e1_66541007',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7140e952276f4ce00ebd913837aed6665deb940b' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\templates\\src\\simple.tpl',
      1 => 1517353894,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639cfbad9ee1e1_66541007 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2077454062639cfbad9eab76_80561468', 'Main');
?>

		<div id="message-ws" class="box-message" message_code="<?php echo $_smarty_tpl->tpl_vars['MessageCode']->value;?>
" message_text="<?php echo $_smarty_tpl->tpl_vars['MessageText']->value;?>
">
		</div>
	</body>
</html> <?php }
/* {block 'Main'} */
class Block_2077454062639cfbad9eab76_80561468 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_2077454062639cfbad9eab76_80561468',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php echo $_smarty_tpl->tpl_vars['body']->value;?>

		<?php
}
}
/* {/block 'Main'} */
}
