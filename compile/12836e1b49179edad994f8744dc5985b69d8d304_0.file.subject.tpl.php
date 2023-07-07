<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:15:08
  from 'E:\xampp\htdocs\smartwork\apps\forum\modules\forum\templates\src\subject.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930aac4aea13_19869726',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12836e1b49179edad994f8744dc5985b69d8d304' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\forum\\modules\\forum\\templates\\src\\subject.tpl',
      1 => 1644228943,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930aac4aea13_19869726 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['subject_top']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['subject_top']->value;?>

<?php }?>
<h1 class="header-image" itemprop="title">
	<?php echo $_smarty_tpl->tpl_vars['subject_name']->value;?>

</h1>
<?php if ($_smarty_tpl->tpl_vars['subject_add']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['subject_add']->value;?>

<?php }
if ($_smarty_tpl->tpl_vars['btEdit']->value || $_smarty_tpl->tpl_vars['btDelete']->value) {?>
	<div class="forum-btn <?php echo $_smarty_tpl->tpl_vars['subject_class']->value;?>
">
		<?php if ($_smarty_tpl->tpl_vars['btEdit']->value) {?>
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['subject_linkEdit']->value;?>
">
				<span class="fa fa-edit" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_edit');?>

			</button>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['btDelete']->value) {?>
			<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="<?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_loading');?>
" event="<?php echo $_smarty_tpl->tpl_vars['subject_linkDelete']->value;?>
">
				<span class="fa fa-trash" width="16" height="16"></span>  <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_forum_delete');?>

			</button>
		<?php }?>
	</div>
<?php }?>
<div class="forum-description <?php echo $_smarty_tpl->tpl_vars['subject_class']->value;?>
">
	<?php echo $_smarty_tpl->tpl_vars['subject_label']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['subject_content']->value;?>

</div>
<?php if ($_smarty_tpl->tpl_vars['subject_bottom']->value != '') {?>
	<?php echo $_smarty_tpl->tpl_vars['subject_bottom']->value;?>

<?php }
}
}
