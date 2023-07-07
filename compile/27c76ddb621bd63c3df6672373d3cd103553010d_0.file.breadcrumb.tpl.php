<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:14:46
  from 'E:\xampp\htdocs\smartwork\modules\forum\templates\src\breadcrumb.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930a96bf7263_79797389',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '27c76ddb621bd63c3df6672373d3cd103553010d' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\modules\\forum\\templates\\src\\breadcrumb.tpl',
      1 => 1643417547,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930a96bf7263_79797389 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="forum-breadcrumb">
	<a href="<?php echo $_smarty_tpl->tpl_vars['homeLink']->value;?>
">
		<?php echo $_smarty_tpl->tpl_vars['homeTitle']->value;?>

	</a>
	<?php if ($_smarty_tpl->tpl_vars['subjectTitle']->value != '') {?>
		<span>></span>
		<a href="<?php echo $_smarty_tpl->tpl_vars['subjectLink']->value;?>
">
			<?php echo $_smarty_tpl->tpl_vars['subjectTitle']->value;?>

		</a>
		<?php if ($_smarty_tpl->tpl_vars['topicTitle']->value != '') {?>
			<span>></span>
			<a href="<?php echo $_smarty_tpl->tpl_vars['topicLink']->value;?>
">
				<?php echo $_smarty_tpl->tpl_vars['topicTitle']->value;?>

			</a>
		<?php }?>
	<?php }?>
</div>
<?php }
}
