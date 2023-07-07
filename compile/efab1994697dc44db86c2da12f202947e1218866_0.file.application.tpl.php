<?php
/* Smarty version 4.1.1, created on 2022-10-11 15:03:59
  from 'E:\xampp\htdocs\smartwork\apps\administrator\templates\src\application.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634569bf51f972_90285983',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'efab1994697dc44db86c2da12f202947e1218866' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\administrator\\templates\\src\\application.tpl',
      1 => 1493825355,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634569bf51f972_90285983 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
echo '<?php'; ?>
 
/**
* This file contains template for "application" list screen.
*
* @package    use_application
* @subpackage view
* @version    1.0
* @date       19 Juillet 2015
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
<?php echo '?>'; ?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1555727906634569bf51c915_03794853', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "index.tpl");
}
/* {block 'Main'} */
class Block_1555727906634569bf51c915_03794853 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1555727906634569bf51c915_03794853',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
>
		$(document).ready(
			function() {
				init_ws("#list_applications", "<?php echo $_smarty_tpl->tpl_vars['page_ref']->value;?>
");
			}
		);
	<?php echo '</script'; ?>
>

	<div id="list_applications" class="box-header block-adm block-application_list" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Title_application');?>
" box-id="applications" box-model="box-model">
	</div>
		
<?php
}
}
/* {/block 'Main'} */
}
