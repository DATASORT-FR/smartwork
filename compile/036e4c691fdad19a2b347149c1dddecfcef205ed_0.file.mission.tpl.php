<?php
/* Smarty version 4.1.1, created on 2022-12-22 00:28:39
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\mission.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63a396a7af14e7_36710528',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '036e4c691fdad19a2b347149c1dddecfcef205ed' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\mission.tpl',
      1 => 1612202835,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:mission_detail.tpl' => 1,
  ),
),false)) {
function content_63a396a7af14e7_36710528 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
$_smarty_tpl->_assignInScope('LeftSideDisplay', 0);?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_55883992063a396a7ae2175_04132330', 'Main');
?>


     
<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "templateSearch.tpl");
}
/* {block 'Main'} */
class Block_55883992063a396a7ae2175_04132330 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_55883992063a396a7ae2175_04132330',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<article id="offer" class="row block-ws block-main" box-id="mission" box-model="box-model" link_href="<?php echo $_smarty_tpl->tpl_vars['MissionLink']->value;?>
" itemscope itemtype="http://schema.org/JobPosting">

		<?php $_smarty_tpl->_subTemplateRender('file:mission_detail.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
	</article>
<?php
}
}
/* {/block 'Main'} */
}
