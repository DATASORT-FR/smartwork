<?php
/* Smarty version 4.1.1, created on 2022-12-09 16:12:19
  from 'E:\xampp\htdocs\smartwork\apps\separation\modules\content\templates\src\dossiers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63935053b6c6f5_67699256',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f490758777750114f484ebb1e34efb50c2fa955' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\modules\\content\\templates\\src\\dossiers.tpl',
      1 => 1646235433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63935053b6c6f5_67699256 (Smarty_Internal_Template $_smarty_tpl) {
?><h1 class="article <?php echo $_smarty_tpl->tpl_vars['Content_class']->value;?>
" itemprop="title">
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_block1']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
		<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_block1']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

	<?php } else { ?>
		<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_title']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

	<?php }?>
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
			<?php if ($_smarty_tpl->tpl_vars['btDelete']->value) {?>
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['Content_linkDelete']->value;?>
">
					<span class="fa fa-trash" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_Content_delete');?>

				</button>
			<?php }?>
		</div>
	</div>
<?php }?>
<div class="blog-content">
	<figure class="post-image">
		<img alt="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageAlt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" src="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" onerror="this.src='./images/separation/image-non-trouvee.webp';" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        <div class="post-date">
			<h3><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_day']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</h3>
			<p><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_month']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
        </div>
    </figure>
	<div class="post-content">
		<div class="article-info">
			<div class="article-duration">
			<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_block2']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
				<p>
					<span class="icon">
						<i class="fa fa-clock"></i> 
					</span>
					<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_block2']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

				</p>
			<?php }?>
			</div>
			<div class="article-author"> 
				<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_block5']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
					<p class="author"><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_block5']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
				<?php }?>
				<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_block6']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
					<p class="profession"><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_block6']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
				<?php }?>
			</div>
		</div>
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_block3']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
			<p class="article-resume">
				<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_block3']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

			</p>
		<?php }?>
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_block4']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
            <blockquote class="ludwig article-encart">
				<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_block4']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

            </blockquote>
		<?php }?>
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['Content_add']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != '') {?>
			<div class="row">
				<div class="col-lg-12">
					<?php echo $_smarty_tpl->tpl_vars['Content_add']->value;?>

				</div>
			</div>
		<?php }?>
		<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_content']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

	</div>
</div>
<?php }
}
