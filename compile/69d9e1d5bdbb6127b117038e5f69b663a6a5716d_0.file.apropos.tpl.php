<?php
/* Smarty version 4.1.1, created on 2022-12-09 16:12:35
  from 'E:\xampp\htdocs\smartwork\apps\separation\modules\content\templates\src\apropos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639350632e03c0_85839567',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69d9e1d5bdbb6127b117038e5f69b663a6a5716d' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\modules\\content\\templates\\src\\apropos.tpl',
      1 => 1645562478,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639350632e03c0_85839567 (Smarty_Internal_Template $_smarty_tpl) {
?><h1 itemprop="title">
	<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_title']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

</h1>
<div class="blog-intro">
	<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_intro']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

</div>
<?php if ($_smarty_tpl->tpl_vars['btEdit']->value || $_smarty_tpl->tpl_vars['btDelete']->value) {?>
	<div class="container mt-2 mb-2">
		<div class="content_btn <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
			<?php if ($_smarty_tpl->tpl_vars['btEdit']->value) {?>
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['Content_linkEdit']->value;?>
">
					<span class="fa fa-edit" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_edit');?>

				</button>
			<?php }?>
		</div>
	</div>
<?php }?>
<div class="blog-content">
	<?php if ($_smarty_tpl->tpl_vars['Content_image']->value != '') {?>
		<figure class="post-image">
			<img alt="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageAlt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" src="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" onerror="this.src='./images/separation/image-non-trouvee.webp';" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
		</figure>
	<?php }?>
	<div class="post-content">
		<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_content']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

	</div>
</div>
<?php }
}
