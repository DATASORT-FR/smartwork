<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\content\templates\src\intro_contentside.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cdec6876_11012240',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf6761521927ba055a4bd8f54182ea47af0bf09c' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\content\\templates\\src\\intro_contentside.tpl',
      1 => 1525953183,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cdec6876_11012240 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row article_row intro_contentside">
	<article class="col-xs-12 article" itemscope itemtype="http://schema.org/Article">
		<h2>
			<a href="<?php echo $_smarty_tpl->tpl_vars['Content_link']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['Content_titlePage']->value;?>
" itemprop="title"><?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>
</a>
		</h2>
		<div class="article_intro">
			<?php if ($_smarty_tpl->tpl_vars['Content_image']->value != '') {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['Content_link']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['Content_titlePage']->value;?>
">
					<div class="container_img">
						<div class="intro_img">
							<img alt="<?php echo $_smarty_tpl->tpl_vars['Content_imageAlt']->value;?>
" src="<?php echo $_smarty_tpl->tpl_vars['Content_image']->value;?>
" onerror="this.src = '';" title="<?php echo $_smarty_tpl->tpl_vars['Content_imageTitle']->value;?>
">
						</div>
					</div>
				</a>
			<?php }?>
			<?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>

		</div>
	</article>
</div>
<?php }
}
