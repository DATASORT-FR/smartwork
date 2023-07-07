<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\login\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cdb1be51_81696967',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59319cae0d6d48e5eceed6efd5af49e0e3b5d1c2' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\login\\templates\\src\\index.tpl',
      1 => 1646066702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cdb1be51_81696967 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card">
	<div class="card-header p-b-0">
		<h2 class="card-title">
			<i class="fa fa-sign-in" aria-hidden="true"></i> 
			<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Lbl_login_login');?>

		</h2>
	</div>
	<div class="card-body">
		<?php echo $_smarty_tpl->tpl_vars['IncConnect']->value;?>

	</div>
</div>	
<?php }
}
