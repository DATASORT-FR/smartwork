<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\statistics\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cde09211_27359625',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3ed1f42018e5a3b4db34c825683eb727c5565340' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\statistics\\templates\\src\\index.tpl',
      1 => 1646230764,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cde09211_27359625 (Smarty_Internal_Template $_smarty_tpl) {
?>	<div class="card card-statistics">
		<div class="card-header p-b-0">
			<h2 class="card-title"><i class="fa fa-tachometer fa-white" aria-hidden="true"></i><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_title_statistics');?>
</h2>
		</div>
		<a class="" href="<?php echo $_smarty_tpl->tpl_vars['statisticsHref']->value;?>
">
			<div class="card-body">
				<div class="text-sm-center"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_offers_number');?>
</div>
				<div class="text-sm-center"><strong><?php echo $_smarty_tpl->tpl_vars['numberOffers']->value;?>
</strong></div>
				<br>
				<div class="text-sm-center" id="progress-caption-1"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_actives_offers');?>
</div>
				<div class="progress">
					<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $_smarty_tpl->tpl_vars['pctActivesOffers']->value;?>
%;" aria-valuenow="<?php echo $_smarty_tpl->tpl_vars['pctActivesOffers']->value;?>
" aria-valuemin="0" aria-valuemax="100"><?php echo $_smarty_tpl->tpl_vars['pctActivesOffers']->value;?>
%</div>
				</div>
				<br>
				<div class="text-sm-center" id="progress-caption-2"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_consulted_offers');?>
</div>
				<div class="progress">
					<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $_smarty_tpl->tpl_vars['pctConsultedOffers']->value;?>
%;" aria-valuenow="<?php echo $_smarty_tpl->tpl_vars['pctConsultedOffers']->value;?>
" aria-valuemin="0" aria-valuemax="100"><?php echo $_smarty_tpl->tpl_vars['pctConsultedOffers']->value;?>
%</div>
				</div>
			</div>
		</a>
	</div>
<?php }
}
