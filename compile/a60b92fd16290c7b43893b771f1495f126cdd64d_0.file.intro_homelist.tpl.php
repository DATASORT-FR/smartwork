<?php
/* Smarty version 4.1.1, created on 2022-10-11 15:04:58
  from 'E:\xampp\htdocs\smartwork\apps\separation_v1\modules\content\templates\src\intro_homelist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634569fa4797a1_00097031',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a60b92fd16290c7b43893b771f1495f126cdd64d' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v1\\modules\\content\\templates\\src\\intro_homelist.tpl',
      1 => 1637704257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634569fa4797a1_00097031 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="item">
    <div class="news-preview">
        <figure class="np-thumbnail">
			<a class="decoration-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_link']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_titlePage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
				<img alt="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_imageAlt']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" src="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_image']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
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
            <p class="categorie"><?php echo $_smarty_tpl->tpl_vars['Content_code']->value;?>
</p>
            <h4>
				<a class="decoration-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_link']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="<?php echo (($tmp = $_smarty_tpl->tpl_vars['Content_titlePage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" itemprop="title"><?php echo $_smarty_tpl->tpl_vars['Content_title']->value;?>
</a>
			</h4>
            <p><?php echo $_smarty_tpl->tpl_vars['Content_intro']->value;?>
</p>
        </div>
    </div>
</div>
 <?php }
}
