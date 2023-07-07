<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:15:01
  from 'E:\xampp\htdocs\smartwork\apps\forum\modules\forum\templates\src\post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930aa5c441a3_24797628',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '66d18348a857253caa4939dcfffd3901b7fe7668' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\modules\\forum\\templates\\src\\post.tpl',
      1 => 1644876748,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930aa5c441a3_24797628 (Smarty_Internal_Template $_smarty_tpl) {
?>	<?php if ($_smarty_tpl->tpl_vars['btEdit']->value || $_smarty_tpl->tpl_vars['btDelete']->value) {?>
		<div class="forum-btn post">
			<span><?php echo $_smarty_tpl->tpl_vars['post_status']->value;?>
</span>
			<?php if ($_smarty_tpl->tpl_vars['btEdit']->value) {?>
				<button type="button" class="btn btn-primary bt-proc-page bt-forum-post-edit" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['post_linkEdit']->value;?>
">
					<span class="fa fa-edit" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_edit');?>

				</button>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['btDelete']->value) {?>
				<button type="button" class="btn btn-primary bt-proc-page bt-forum-post-delete" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['post_linkDelete']->value;?>
" position="">
					<span class="fa fa-trash" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_delete');?>

				</button>
			<?php }?>
		</div>
	<?php }?>

	<div class="header-post">
		<div class="forum-post-author">Par <span><?php echo $_smarty_tpl->tpl_vars['post_author']->value;?>
</span></div>
		<div class="forum-post-date-time"><?php echo $_smarty_tpl->tpl_vars['post_dateDayTime']->value;?>
</div>
			<?php if ($_smarty_tpl->tpl_vars['post_read']->value) {?>
				<div class="post-date read">
			<?php } else { ?>
				<div class="post-date no-read">
			<?php }?>
			<h3><?php echo $_smarty_tpl->tpl_vars['post_day']->value;?>
</h3>
			<p><?php echo $_smarty_tpl->tpl_vars['post_month']->value;?>
</p>
		</div>
	</div>
	<div class="forum-resume">
		<div class="forum-post-label"><?php echo $_smarty_tpl->tpl_vars['post_content']->value;?>
</div>
	</div>
	<div class="forum-resume">
		<?php if ($_smarty_tpl->tpl_vars['post_read']->value) {?>
			<button type="button" class="btn btn-primary bt-forum-proc-page bt-forum-post read" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['post_linkCreate']->value;?>
" target="#block-response">
		<?php } else { ?>
			<button type="button" class="btn btn-primary bt-forum-proc-page bt-forum-post no-read" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['post_linkCreate']->value;?>
" target="#block-response">
		<?php }?>
			<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_post_create');?>

		</button>
	</div>
<?php }
}
