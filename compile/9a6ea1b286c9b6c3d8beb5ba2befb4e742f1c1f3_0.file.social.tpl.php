<?php
/* Smarty version 4.1.1, created on 2022-12-10 13:07:25
  from 'E:\xampp\htdocs\smartwork\modules\social\templates\src\social.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6394767d1213d5_19266464',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a6ea1b286c9b6c3d8beb5ba2befb4e742f1c1f3' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\social\\templates\\src\\social.tpl',
      1 => 1516145969,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6394767d1213d5_19266464 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['displayFlag']->value) {?>
	<div class="social_list">
		<?php if ($_smarty_tpl->tpl_vars['facebookFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['facebookLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_facebook_follow');?>
" class="link_facebook square" target="_blank">
					<span class="fa fa-facebook-square fa-2x"></span>
				</a>
			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['facebookLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_facebook_follow');?>
" class="btn link_facebook no_square" target="_blank">
					<span class="fa fa-facebook"></span>
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_facebook_name');?>

				</a>
			<?php }?>
		<?php }?>
		
		<?php if ($_smarty_tpl->tpl_vars['twitterFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['twitterLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_twitter_follow');?>
" class="link_twitter square" target="_blank">
					<span class="fa fa-twitter-square fa-2x"></span>
				</a>
			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['twitterLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_twitter_follow');?>
" class="btn link_twitter no_square" target="_blank">
					<span class="fa fa-twitter"></span>
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_twitter_name');?>

				</a>
			<?php }?>
		<?php }?>
		
		<?php if ($_smarty_tpl->tpl_vars['googleFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['googleLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_google_follow');?>
" class="link_google square" target="_blank">
					<span class="fa fa-google-plus-square fa-2x"></span>
				</a>
			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['googleLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_google_follow');?>
" class="btn link_google no_square" target="_blank">
					<span class="fa fa-google-plus"></span>
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_google_name');?>

				</a>
			<?php }?>
		<?php }?>
				
		<?php if ($_smarty_tpl->tpl_vars['pinterestFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['pinterestLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_pinterest_follow');?>
" class="link_pinterest square" target="_blank">
					<span class="fa fa-pinterest-square fa-2x"></span>
				</a>
			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['pinterestLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_pinterest_follow');?>
" class="btn link_pinterest no_square" target="_blank">
					<span class="fa fa-pinterest"></span>
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_pinterest_name');?>

				</a>
			<?php }?>
		<?php }?>
		
		<?php if ($_smarty_tpl->tpl_vars['linkedinFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['linkedinLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_linkedin_follow');?>
" class="link_linkedin square" target="_blank">
					<span class="fa fa-linkedin-square fa-2x"></span>
				</a>
			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['linkedinLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_linkedin_follow');?>
" class="btn link_linkedin no_square" target="_blank">
					<span class="fa fa-linkedin"></span>
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_linkedin_name');?>

				</a>
			<?php }?>
		<?php }?>
		
		
		<?php if ($_smarty_tpl->tpl_vars['youtubeFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['youtubeLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_youtube_follow');?>
" class="link_youtube square" target="_blank">
					<span class="fa fa-youtube-square fa-2x"></span>
				</a>
			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['youtubeLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_youtube_follow');?>
" class="btn link_youtube no_square" target="_blank">
					<span class="fa fa-youtube"></span>
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_youtube_name');?>

				</a>
			<?php }?>
		<?php }?>
		
		
		<?php if ($_smarty_tpl->tpl_vars['feedburnerFlag']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['squareFlag']->value) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['feedburnerLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_feedburner_follow');?>
" class="link_feedburner square" target="_blank">
					<span class="fa fa-feedburner-square fa-2x"></span>
				</a>
			<?php } else { ?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['feedburnerLink']->value;?>
" title="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_feedburner_follow');?>
" class="btn link_feedburner no_square" target="_blank">
					<span class="fa fa-feedburner"></span>
					<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_feedburner_name');?>

				</a>
			<?php }?>
		<?php }?>
		
	</div>
<?php }
}
}
