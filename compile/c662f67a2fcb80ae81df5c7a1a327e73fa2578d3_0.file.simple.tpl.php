<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:54:19
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\simple.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa261bf23521_83767002',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c662f67a2fcb80ae81df5c7a1a327e73fa2578d3' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\simple.tpl',
      1 => 1517353546,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aa261bf23521_83767002 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
		<meta http-equiv="Expires" content="0" />
	</head>
	<body>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_140735416863aa261bf22660_21651120', 'Main');
?>

		<div id="message-ws" class="box-message" message_code="<?php echo $_smarty_tpl->tpl_vars['MessageCode']->value;?>
" message_text="<?php echo $_smarty_tpl->tpl_vars['MessageText']->value;?>
">
		</div>
	</body>
</html> <?php }
/* {block 'Main'} */
class Block_140735416863aa261bf22660_21651120 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_140735416863aa261bf22660_21651120',
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
