<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:57:32
  from 'E:\xampp\htdocs\smartwork\templates\src\standard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa26dc81bed3_87532907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7efab3e137e32e0e201dc8f4f22edbcf3549e535' => 
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
function content_63aa26dc81bed3_87532907 (Smarty_Internal_Template $_smarty_tpl) {
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_110313886163aa26dc819877_36822946', 'Header_Left');
?>

				</div>

				<div class="header_right pull-right">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_113479509463aa26dc819eb4_36968014', 'Header_Right');
?>

				</div>
			</div>
		</div>
	</header>

	<nav class="navigation-zone">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_100944767663aa26dc81a456_75251120', 'Nav_Block');
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_90373373563aa26dc81a9e4_69053231', 'Main');
?>

			</div>
		</article>
	</div>

	<footer class="container-fluid footer-zone minus-zone">
		<div class="row">
			<div class="col-lg-12">			
				<div class="nav_left pull-left">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_87470070763aa26dc81af68_91977328', 'Footer_Left');
?>

				</div>

				<div class="nav_right pull-right">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_183307632563aa26dc81b4c0_90064012', 'Footer_Right');
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
class Block_110313886163aa26dc819877_36822946 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Header_Left' => 
  array (
    0 => 'Block_110313886163aa26dc819877_36822946',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Header_Left'} */
/* {block 'Header_Right'} */
class Block_113479509463aa26dc819eb4_36968014 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Header_Right' => 
  array (
    0 => 'Block_113479509463aa26dc819eb4_36968014',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Header_Right'} */
/* {block 'Nav_Block'} */
class Block_100944767663aa26dc81a456_75251120 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Nav_Block' => 
  array (
    0 => 'Block_100944767663aa26dc81a456_75251120',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php
}
}
/* {/block 'Nav_Block'} */
/* {block 'Main'} */
class Block_90373373563aa26dc81a9e4_69053231 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_90373373563aa26dc81a9e4_69053231',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php
}
}
/* {/block 'Main'} */
/* {block 'Footer_Left'} */
class Block_87470070763aa26dc81af68_91977328 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Footer_Left' => 
  array (
    0 => 'Block_87470070763aa26dc81af68_91977328',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Footer_Left'} */
/* {block 'Footer_Right'} */
class Block_183307632563aa26dc81b4c0_90064012 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Footer_Right' => 
  array (
    0 => 'Block_183307632563aa26dc81b4c0_90064012',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php
}
}
/* {/block 'Footer_Right'} */
}
