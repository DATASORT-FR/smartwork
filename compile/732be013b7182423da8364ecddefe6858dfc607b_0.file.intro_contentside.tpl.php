<?php
/* Smarty version 4.1.1, created on 2022-12-09 16:12:19
  from 'E:\xampp\htdocs\smartwork\apps\separation\modules\content\templates\src\intro_contentside.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63935053c368d1_78604503',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '732be013b7182423da8364ecddefe6858dfc607b' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\modules\\content\\templates\\src\\intro_contentside.tpl',
      1 => 1637082152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63935053c368d1_78604503 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="recent-post-thumb">
	<figure class="rp-feature">
		<a class="decoration-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_link']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_titlePage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
			<img alt="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageAlt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" src="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" onerror="this.src='./images/separation/image-non-trouvee.webp';" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
		</a>
	</figure>
	<div class="rpt-caption">
		<h5>
			<a class="decoration-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_link']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_titlePage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" itemprop="title"><?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>
</a>
		</h5>
		<p><?php echo $_smarty_tpl->tpl_vars['Content_datepublication']->value;?>
</p>
	</div>
</div>
<?php }
}
