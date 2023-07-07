<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:38
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\content\templates\src\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8ce270838_56943736',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5a62c7dadaacdb11ecbbd372d0f678a3aca6bcc' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\content\\templates\\src\\home.tpl',
      1 => 1530654204,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8ce270838_56943736 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="article_intro">
	<h1>
		<?php if ($_smarty_tpl->tpl_vars['Content_icon']->value != '') {?>
			<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['Content_icon']->value;?>
" aria-hidden="true"></i> 
		<?php }?>
		<?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>

	</h1>
	<?php if ($_smarty_tpl->tpl_vars['btEdit']->value || $_smarty_tpl->tpl_vars['btDelete']->value) {?>
		<div class="content_btn">
			<?php if ($_smarty_tpl->tpl_vars['btEdit']->value) {?>
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['Content_linkEdit']->value;?>
">
					<span class="fa fa-edit" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_edit');?>

				</button>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['btDelete']->value) {?>
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['Content_linkDelete']->value;?>
">
					<span class="fa fa-trash" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_delete');?>

				</button>
			<?php }?>
		</div>
	<?php }?>
	<div class="">
		<?php echo $_smarty_tpl->tpl_vars['Content_content']->value;?>

	</div>
	<?php if ($_smarty_tpl->tpl_vars['Content_image']->value != '') {?>
		<div class="container_img">
			<div class="home_img">
				<a class="" href="<?php echo $_smarty_tpl->tpl_vars['Content_offersHref']->value;?>
">
					<div class="home_link">
						<img alt="<?php echo $_smarty_tpl->tpl_vars['Content_imageAlt']->value;?>
" src="<?php echo $_smarty_tpl->tpl_vars['Content_image']->value;?>
" onerror="this.src = '';" title="<?php echo $_smarty_tpl->tpl_vars['Content_imageTitle']->value;?>
">
						<div class="home_text title">
							<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Offers_Link');?>

						</div>
					</div>
				</a>
			</div>
		</div>
	<?php }?>
</div>
<br>
<?php }
}
