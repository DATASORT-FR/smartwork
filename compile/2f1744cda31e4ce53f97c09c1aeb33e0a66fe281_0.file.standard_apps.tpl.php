<?php
/* Smarty version 4.1.1, created on 2022-12-17 00:13:36
  from 'E:\xampp\htdocs\smartwork\templates\src\standard_apps.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639cfba01b33d9_89073203',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f1744cda31e4ce53f97c09c1aeb33e0a66fe281' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\templates\\src\\standard_apps.tpl',
      1 => 1586744449,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639cfba01b33d9_89073203 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
" >

	<title><?php echo $_smarty_tpl->tpl_vars['urlTitle']->value;?>
</title>
	<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['urlDescription']->value;?>
">
	<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['urlKeywords']->value;?>
">	
	<meta name="news_keywords" content="<?php echo $_smarty_tpl->tpl_vars['urlNewsKeywords']->value;?>
">

	<meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['siteTitle']->value;?>
">
	<meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
">	
	<meta property="og:type" content="website">
	<meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['pageDescription']->value;?>
">
	<meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['urlLink']->value;?>
">
	<meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['pageImage']->value;?>
">

	<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filecss']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<link href="<?php echo $_smarty_tpl->tpl_vars['filecss']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" rel="stylesheet" type="text/css">
	<?php
}
}
?>
	
	<?php
$__section_idx_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filejs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_1_total = $__section_idx_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_1_total !== 0) {
for ($__section_idx_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_1_iteration <= $__section_idx_1_total; $__section_idx_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['filejs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
"><?php echo '</script'; ?>
>
	<?php
}
}
?>

</head>
<body>

	<!-- Conteneur principal -->
	<header class="container-fluid header-zone">
		<div class="row">
			<div class="col-lg-12">			
				<div class="header_left pull-left">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1472637498639cfba01b0dc1_03901546', 'Header_Left');
?>

				</div>

				<div class="header_right pull-right">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_815895805639cfba01b13e9_08344587', 'Header_Right');
?>

				</div>
			</div>
		</div>
	</header>

	<div class="container-fluid navigation-zone">
		<div class="row">
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_557136520639cfba01b1982_06496434', 'Nav_Block');
?>

		</div>
	</div>

	<div id="message-box" class="container-fluid">
		<div class="row">
			<div class="message-txt">
			</div>
		</div>
	</div>
	
	<div class="container-fluid main-zone">
		<article class="work-zone row">
			<div class="col-lg-12">			
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1733754516639cfba01b1ef3_92032293', 'Main');
?>

			</div>
		</article>
	</div>

	<footer class="container-fluid footer-zone minus-zone">
		<div class="row">
			<div class="col-lg-12">			
				<div class="nav_left pull-left">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_911992318639cfba01b2458_72034851', 'Footer_Left');
?>

				</div>

				<div class="nav_right pull-right">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1892596162639cfba01b2a22_02561433', 'Footer_Right');
?>

				</div>
			</div>
		</div>
	</footer>
			
	<div class="box-model display-none">
	</div>
	<div class="subbox-model display-none">
	</div>
	<div class="box-confirm display-none">
	</div>
	<div id="message-ws" class="box-message" message_code="<?php echo $_smarty_tpl->tpl_vars['MessageCode']->value;?>
" message_text="<?php echo $_smarty_tpl->tpl_vars['MessageText']->value;?>
">
	</div>

</body>

</html> <?php }
/* {block 'Header_Left'} */
class Block_1472637498639cfba01b0dc1_03901546 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Header_Left' => 
  array (
    0 => 'Block_1472637498639cfba01b0dc1_03901546',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Header_Left'} */
/* {block 'Header_Right'} */
class Block_815895805639cfba01b13e9_08344587 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Header_Right' => 
  array (
    0 => 'Block_815895805639cfba01b13e9_08344587',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Header_Right'} */
/* {block 'Nav_Block'} */
class Block_557136520639cfba01b1982_06496434 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Nav_Block' => 
  array (
    0 => 'Block_557136520639cfba01b1982_06496434',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php
}
}
/* {/block 'Nav_Block'} */
/* {block 'Main'} */
class Block_1733754516639cfba01b1ef3_92032293 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1733754516639cfba01b1ef3_92032293',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php
}
}
/* {/block 'Main'} */
/* {block 'Footer_Left'} */
class Block_911992318639cfba01b2458_72034851 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Footer_Left' => 
  array (
    0 => 'Block_911992318639cfba01b2458_72034851',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Footer_Left'} */
/* {block 'Footer_Right'} */
class Block_1892596162639cfba01b2a22_02561433 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Footer_Right' => 
  array (
    0 => 'Block_1892596162639cfba01b2a22_02561433',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Footer_Right'} */
}
