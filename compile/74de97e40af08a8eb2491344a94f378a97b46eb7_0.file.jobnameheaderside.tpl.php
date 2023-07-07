<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\content\templates\src\jobnameheaderside.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cd962eb6_10966851',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74de97e40af08a8eb2491344a94f378a97b46eb7' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\content\\templates\\src\\jobnameheaderside.tpl',
      1 => 1525953549,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cd962eb6_10966851 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['Content_image']->value != '') {?>
	<div class="container_img">
		<div class="intro_img">
			<img alt="<?php echo $_smarty_tpl->tpl_vars['Content_imageAlt']->value;?>
" src="<?php echo $_smarty_tpl->tpl_vars['Content_image']->value;?>
" onerror="this.src = '';" title="<?php echo $_smarty_tpl->tpl_vars['Content_imageTitle']->value;?>
">
		</div>
	</div>
<?php }
}
}
