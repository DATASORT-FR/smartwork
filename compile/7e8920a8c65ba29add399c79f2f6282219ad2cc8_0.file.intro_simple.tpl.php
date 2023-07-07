<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:38
  from 'E:\xampp\htdocs\smartwork\modules\content\templates\src\intro_simple.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8ce1d0319_22632894',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e8920a8c65ba29add399c79f2f6282219ad2cc8' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\content\\templates\\src\\intro_simple.tpl',
      1 => 1524695287,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8ce1d0319_22632894 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row article_row">
	<article class="col-xs-12 article" itemscope itemtype="http://schema.org/Article">
		<h2>
			<?php if ($_smarty_tpl->tpl_vars['Content_icon']->value != '') {?>
				<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['Content_icon']->value;?>
" aria-hidden="true"></i> 
			<?php }?>
			<?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>

		</h2>
		<div class="article_intro" itemprop="description">
			<?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>

		</div>
	</article>
</div>
<?php }
}
