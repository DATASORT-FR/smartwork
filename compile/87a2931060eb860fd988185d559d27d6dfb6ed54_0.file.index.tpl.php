<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\jobnameside\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cdad1391_85760871',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87a2931060eb860fd988185d559d27d6dfb6ed54' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\jobnameside\\templates\\src\\index.tpl',
      1 => 1646066229,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cdad1391_85760871 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card card_jobnameside intro_card">
	<div class="card-header p-b-0">
		<h2 class="card-title"><i class="fa fa-random fa-white" aria-hidden="true"></i><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_title_jobnameside');?>
</h2>
	</div>
	<div class="card-body">
		<div class="card-text">
			<a class="" title="<?php echo $_smarty_tpl->tpl_vars['Jobname_titlePage']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['JobnameHref']->value;?>
">
				<?php echo $_smarty_tpl->tpl_vars['pageBlock']->value;?>

			</a>
			<ul>
				<?php echo $_smarty_tpl->tpl_vars['listBlock']->value;?>

			</ul>
		</div>
		<div class="content_btn">
			<a class="btn btn-secondary" title="<?php echo $_smarty_tpl->tpl_vars['Jobname_titlePage']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['JobnameHref']->value;?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_bt_jobnameside');?>
</a>
		</div>
	</div>
</div>
<?php }
}
