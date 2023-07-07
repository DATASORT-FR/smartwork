<?php
/* Smarty version 4.1.1, created on 2022-12-17 00:10:16
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\partner.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639cfad897fe15_86234328',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4966e9e303b8201a7425457ecd2ec2491bd9ffc9' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\partner.tpl',
      1 => 1493825477,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639cfad897fe15_86234328 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for "module" list screen.
*
* @package    use_company
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_997541353639cfad897c657_47856970', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_997541353639cfad897c657_47856970 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_997541353639cfad897c657_47856970',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_partners", "<?php echo $_smarty_tpl->tpl_vars['page_ref']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_partners" class="box-header block-adm block-partner_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_partner');?>
" box-id="partners" box-model="box-model">			
	</div>
	
<?php
}
}
/* {/block 'Main'} */
}
