<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:15:01
  from 'E:\xampp\htdocs\smartwork\apps\forum\modules\forum\templates\src\topic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930aa5bc6252_64205185',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '29531ef97b844bae3a7469fae0169deeffbe0f35' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\modules\\forum\\templates\\src\\topic.tpl',
      1 => 1644232779,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930aa5bc6252_64205185 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['topic_top']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['topic_top']->value;?>

<?php }?>
<div class="header-image" itemprop="title">
	<?php echo $_smarty_tpl->tpl_vars['topic_subject']->value;?>

</div>
<?php if ($_smarty_tpl->tpl_vars['topic_add']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['topic_add']->value;?>

<?php }?>
<div class="header-topic">
	<div class="forum-topic-author">Par <?php echo $_smarty_tpl->tpl_vars['topic_author']->value;?>
</div>
	<h1 class="" itemprop="title">
		<?php echo $_smarty_tpl->tpl_vars['topic_label']->value;?>

	</h1>
	<div class="post-date">
		<h3><?php echo (($tmp = $_smarty_tpl->tpl_vars['topic_day']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</h3>
		<p><?php echo (($tmp = $_smarty_tpl->tpl_vars['topic_month']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
	</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['btEdit']->value || $_smarty_tpl->tpl_vars['btDelete']->value) {?>
	<div class="forum-btn topic">
		<?php if ($_smarty_tpl->tpl_vars['btEdit']->value) {?>
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['topic_linkEdit']->value;?>
">
				<span class="fa fa-edit" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_edit');?>

			</button>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['btDelete']->value) {?>
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['topic_linkDelete']->value;?>
">
				<span class="fa fa-trash" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_delete');?>

			</button>
		<?php }?>
	</div>
<?php }?>
<div class="forum-description topic">
	<?php echo $_smarty_tpl->tpl_vars['topic_content']->value;?>

</div>
<?php if ($_smarty_tpl->tpl_vars['topic_bottom']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['topic_bottom']->value;?>

<?php }
}
}
