<?php
/* Smarty version 4.1.1, created on 2022-10-03 16:48:01
  from 'E:\xampp\htdocs\smartwork\apps\separation\modules\content\templates\src\diagnostic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633af621e33bf0_97005950',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'efc39bdd2710834cf2bd4a64fbd472cea16ab296' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\modules\\content\\templates\\src\\diagnostic.tpl',
      1 => 1637796957,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633af621e33bf0_97005950 (Smarty_Internal_Template $_smarty_tpl) {
?><h1 class="<?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
	<?php if ($_smarty_tpl->tpl_vars['Content_icon']->value != '') {?>
		<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['Content_icon']->value;?>
" aria-hidden="true"></i> 
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>

</h1>
<?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>

<?php if ($_smarty_tpl->tpl_vars['btEdit']->value || $_smarty_tpl->tpl_vars['btDelete']->value) {?>
	<div class="content_btn <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
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
<?php }
if ((($tmp = $_smarty_tpl->tpl_vars['Content_image']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
	<figure class="post-image">
		<img alt="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageAlt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" src="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	</figure>
<?php }?>
<div class="article_content <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
">
	<?php echo $_smarty_tpl->tpl_vars['Content_content']->value;?>

</div>
<div class="list-etapes">
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_image1']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
		<div class="etape">
			<figure class="image">
				<img alt="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image1Alt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" src="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image1']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image1Title']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
			</figure>
			<div class="label">
				<p><strong><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image1Alt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</strong></p>
				<p><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image1Title']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
<p>
			</div>
		</div>
	<?php }?>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_image2']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
		<div class="etape">
			<figure class="image">
				<img alt="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image2Alt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" src="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image2']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image2Title']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
			</figure>
			<div class="label">
				<p><strong><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image2Alt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</strong></p>
				<p><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image2Title']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
<p>
			</div>
		</div>
	<?php }?>
</div>

<?php }
}
