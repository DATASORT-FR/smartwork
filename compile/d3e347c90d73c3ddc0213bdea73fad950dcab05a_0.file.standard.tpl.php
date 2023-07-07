<?php
/* Smarty version 4.1.1, created on 2022-12-09 11:32:10
  from 'E:\xampp\htdocs\smartwork\templates\src\standard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63930eaa2f6610_17247634',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3e347c90d73c3ddc0213bdea73fad950dcab05a' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\templates\\src\\standard.tpl',
      1 => 1516667966,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63930eaa2f6610_17247634 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<link rel="icon" type="image/x-icon" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['favicon']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
    <link rel="canonical" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlLink']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_137364490963930eaa2f1e96_24103518', 'Header_Left');
?>

				</div>

				<div class="header_right pull-right">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16116879763930eaa2f2a09_76013077', 'Header_Right');
?>

				</div>
			</div>
		</div>
	</header>

	<nav class="navigation-zone">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20704323663930eaa2f3458_71492238', 'Nav_Block');
?>

	</nav>

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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_155033619263930eaa2f3e92_73606032', 'Main');
?>

			</div>
		</article>
	</div>

	<footer class="container-fluid footer-zone minus-zone">
		<div class="row">
			<div class="col-lg-12">			
				<div class="nav_left pull-left">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_212250508063930eaa2f48b8_32779846', 'Footer_Left');
?>

				</div>

				<div class="nav_right pull-right">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17142244663930eaa2f5325_15695657', 'Footer_Right');
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
class Block_137364490963930eaa2f1e96_24103518 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Header_Left' => 
  array (
    0 => 'Block_137364490963930eaa2f1e96_24103518',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Header_Left'} */
/* {block 'Header_Right'} */
class Block_16116879763930eaa2f2a09_76013077 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Header_Right' => 
  array (
    0 => 'Block_16116879763930eaa2f2a09_76013077',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Header_Right'} */
/* {block 'Nav_Block'} */
class Block_20704323663930eaa2f3458_71492238 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Nav_Block' => 
  array (
    0 => 'Block_20704323663930eaa2f3458_71492238',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php
}
}
/* {/block 'Nav_Block'} */
/* {block 'Main'} */
class Block_155033619263930eaa2f3e92_73606032 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_155033619263930eaa2f3e92_73606032',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php
}
}
/* {/block 'Main'} */
/* {block 'Footer_Left'} */
class Block_212250508063930eaa2f48b8_32779846 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Footer_Left' => 
  array (
    0 => 'Block_212250508063930eaa2f48b8_32779846',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Footer_Left'} */
/* {block 'Footer_Right'} */
class Block_17142244663930eaa2f5325_15695657 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Footer_Right' => 
  array (
    0 => 'Block_17142244663930eaa2f5325_15695657',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Footer_Right'} */
}
