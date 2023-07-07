<?php
/* Smarty version 4.1.1, created on 2022-10-03 16:47:58
  from 'E:\xampp\htdocs\smartwork\apps\separation\modules\content\templates\src\intro_blog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633af61eccf322_34926172',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa951996f57a424fef2c2db564f1cbd0d2e3088d' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\modules\\content\\templates\\src\\intro_blog.tpl',
      1 => 1637082137,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633af61eccf322_34926172 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="col-md-6 col-lg-4">
	<div class="news-preview">
        <figure class="np-thumbnail">
            <a class="decoration-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_link']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
				<img alt="<?php echo $_smarty_tpl->tpl_vars['Content_imageAlt']->value;?>
" src="<?php echo $_smarty_tpl->tpl_vars['Content_image']->value;?>
" onerror="this.src='./images/separation/image-non-trouvee.webp';" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
			</a>
            <div class="post-date">
				<h3><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_day']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</h3>
				<p><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_month']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
            </div>
        </figure>
        <div class="np-caption box-shadow">
            <p class="categorie"><?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_code']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
            <h2><a class="decoration-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_link']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="<?php echo $_smarty_tpl->tpl_vars['Content_titlePage']->value;?>
" itemprop="title"><?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>
</a></h2>
            <?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_intro']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

        </div>
    </div>
</div>
 <?php }
}
