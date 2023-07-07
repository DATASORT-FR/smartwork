<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\contentside\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cdf04c38_96519110',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0600ddcbc531cd4ea5b80e8e15a54e973c353194' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\contentside\\templates\\src\\index.tpl',
      1 => 1646066246,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cdf04c38_96519110 (Smarty_Internal_Template $_smarty_tpl) {
?>	<div class="card card-contentside">
		<div class="card-header p-b-0">
			<h2 class="card-title"><i class="fa fa-quote-left fa-white" aria-hidden="true"></i><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_title_contentside');?>
</h2>
		</div>
		<div class="card-body">
			<?php echo $_smarty_tpl->tpl_vars['listBlock']->value;?>

		</div>
	</div>

<?php }
}
