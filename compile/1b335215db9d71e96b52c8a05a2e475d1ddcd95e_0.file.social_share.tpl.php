<?php
/* Smarty version 4.1.1, created on 2022-12-10 13:07:25
  from 'E:\xampp\htdocs\smartwork\modules\social\templates\src\social_share.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6394767d2ee1a0_63700459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b335215db9d71e96b52c8a05a2e475d1ddcd95e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\social\\templates\\src\\social_share.tpl',
      1 => 1516063957,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6394767d2ee1a0_63700459 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['displayFlag']->value) {?>
	<ul class="social_share_list">
		<?php if ($_smarty_tpl->tpl_vars['facebookFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<li class="social_share_item link_facebook square">
					<a href="<?php echo $_smarty_tpl->tpl_vars['facebookLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_facebook_share');?>
" class="" target="_blank" rel="nofollow">
						<span class="fa fa-facebook-square fa-2x"></span>
					</a>
				</li>
			<?php } else { ?>
				<li class="social_share_item link_facebook no_square">
					<a href="<?php echo $_smarty_tpl->tpl_vars['facebookLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_facebook_share');?>
" class="btn" target="_blank" rel="nofollow">
						<span class="fa fa-facebook"></span>
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_facebook_name');?>

					</a>
				</li>
			<?php }?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['twitterFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<li class="social_share_item link_twitter square"> 
					<a href="<?php echo $_smarty_tpl->tpl_vars['twitterLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_twitter_share');?>
" class="" target="_blank" rel="nofollow">
						<span class="fa fa-twitter-square fa-2x"></span>
					</a>
				</li>
			<?php } else { ?>
				<li class="social_share_item link_twitter no_square"> 
					<a href="<?php echo $_smarty_tpl->tpl_vars['twitterLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_twitter_share');?>
" class="btn" target="_blank" rel="nofollow">
						<span class="fa fa-twitter"></span>
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_twitter_name');?>

					</a>
				</li>
			<?php }?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['googleFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<li class="social_share_item link_google square"> 
					<a href="<?php echo $_smarty_tpl->tpl_vars['googleLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_google_share');?>
" class="" target="_blank" rel="nofollow">
						<span class="fa fa-google-plus-square fa-2x"></span>
					</a>
				</li>
			<?php } else { ?>
				<li class="social_share_item link_google no_square"> 
					<a href="<?php echo $_smarty_tpl->tpl_vars['googleLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_google_share');?>
" class="btn" target="_blank" rel="nofollow">
						<span class="fa fa-google-plus"></span>
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_google_name');?>

					</a>
				</li>
			<?php }?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['linkedinFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<li class="social_share_item link_linkedin square"> 
					<a href="<?php echo $_smarty_tpl->tpl_vars['linkedinLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_linkedin_share');?>
" class="" target="_blank" rel="nofollow">
						<span class="fa fa-linkedin-square fa-2x"></span>
					</a>
				</li>
			<?php } else { ?>
				<li class="social_share_item link_linkedin no_square"> 
					<a href="<?php echo $_smarty_tpl->tpl_vars['linkedinLinkShare']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_linkedin_share');?>
" class="btn" target="_blank" rel="nofollow">
						<span class="fa fa-linkedin"></span>
						<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_linkedin_name');?>

					</a>
				</li>
			<?php }?>
		<?php }?>
	</ul>
<?php }?>
	<?php }
}
