<?php
/* Smarty version 4.1.1, created on 2022-10-03 16:47:58
  from 'E:\xampp\htdocs\smartwork\apps\separation\modules\social\templates\src\social_share.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_633af61ec71bc1_78205317',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9dd63ef34e789e31e0d0c9877eace8860a28f899' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\modules\\social\\templates\\src\\social_share.tpl',
      1 => 1646362022,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_633af61ec71bc1_78205317 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['displayFlag']->value) {?>
	<ul class="social_share_list">
		<li class="social_share_item"></li>
		<li class="social_share_item link_facebook">
			<a href="<?php echo $_smarty_tpl->tpl_vars['facebookLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_facebook_share');?>
" class="" target="_blank" rel="nofollow">
				<span class="fab fa-facebook fa-lg"></span>
			</a>
		</li>
		<li class="social_share_item link_twitter"> 
			<a href="<?php echo $_smarty_tpl->tpl_vars['twitterLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_twitter_share');?>
" class="" target="_blank" rel="nofollow">
				<span class="fab fa-twitter-square fa-lg"></span>
			</a>
		</li>
		<li class="social_share_item link_linkedin"> 
			<a href="<?php echo $_smarty_tpl->tpl_vars['linkedinLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_linkedin_share');?>
" class="" target="_blank" rel="nofollow">
				<span class="fab fa-linkedin fa-lg"></span>
			</a>
		</li>
	</ul>
<?php }?>
	<?php }
}
