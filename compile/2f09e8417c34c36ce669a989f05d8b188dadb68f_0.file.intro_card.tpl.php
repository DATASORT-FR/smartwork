<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\content\templates\src\intro_card.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cdafe212_00443039',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f09e8417c34c36ce669a989f05d8b188dadb68f' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\content\\templates\\src\\intro_card.tpl',
      1 => 1646067229,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cdafe212_00443039 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="card intro_card">
	<div class="card-header p-b-0">
		<h2 class="card-title">
			<?php if ($_smarty_tpl->tpl_vars['Content_icon']->value != '') {?>
				<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['Content_icon']->value;?>
" aria-hidden="true"></i> 
			<?php }?>
			<?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>

		</h2>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['Content_image']->value != '') {?>
		<a class="" title="<?php echo $_smarty_tpl->tpl_vars['Content_titlePage']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['Content_link']->value;?>
">
			<img class="card-img-top" alt="<?php echo $_smarty_tpl->tpl_vars['Content_imageAlt']->value;?>
" src="<?php echo $_smarty_tpl->tpl_vars['Content_image']->value;?>
" onerror="this.src = '';" title="<?php echo $_smarty_tpl->tpl_vars['Content_imageTitle']->value;?>
">
		</a>
	<?php }?>
	<div class="card-body">
		<div class="card-text">
			<?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>

		</div>
		<div class="content_btn">
			<a class="btn btn-secondary" title="<?php echo $_smarty_tpl->tpl_vars['Content_titlePage']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['Content_link']->value;?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_read_more');?>
</a>
		</div>
	</div>
</div>
<?php }
}
