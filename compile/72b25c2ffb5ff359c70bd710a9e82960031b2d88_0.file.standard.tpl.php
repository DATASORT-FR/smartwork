<?php
/* Smarty version 4.1.1, created on 2022-12-26 23:54:19
  from 'E:\xampp\htdocs\smartwork\apps\job_free\templates\src\standard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63aa261b006525_15701214',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72b25c2ffb5ff359c70bd710a9e82960031b2d88' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\templates\\src\\standard.tpl',
      1 => 1646239426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63aa261b006525_15701214 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'E:\\xampp\\htdocs\\smartwork\\libs\\smarty-4.1.1\\libs\\plugins\\function.combine.php','function'=>'smarty_function_combine',),));
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo '<script'; ?>
 async src="https://www.googletagmanager.com/gtag/js?id=UA-113168914-1"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
		window.dataLayer = window.dataLayer || [];
		function gtag() {
			dataLayer.push(arguments);
		}
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieParam']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
			gtag('js', new Date());
			gtag('config', 'UA-113168914-1');
		<?php }?>
	<?php echo '</script'; ?>
>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<title><?php echo (($tmp = $_smarty_tpl->tpl_vars['urlTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</title>
	<?php } else { ?>
		<title><?php echo (($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</title>
	<?php }?>
	<base href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['baseUrl']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" >
	<meta name="google-site-verification" content="G87DX9ApoNpAjGI9r-Lyd4T4IkblanS6G-QK_FKmCSU" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<link rel="alternate" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['baseUrl']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" hreflang="fr-FR"/>
	<link rel="icon" type="image/x-icon" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['favicon']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
    <link rel="canonical" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlLink']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta name="description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta name="description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageNewsKeywords']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta name="news_keywords" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlNewsKeywords']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta name="news_keywords" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageNewsKeywords']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageKeywords']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta name="keywords" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlKeywords']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta name="keywords" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageKeywords']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>

    <!-- Open Graph data -->
	<meta property="og:site_name" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['siteTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta property="og:title" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta property="og:title" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>		
	<meta property="og:type" content="website">
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta property="og:description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta property="og:description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>
	<meta property="og:url" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlLink']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta property="og:image" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta property="og:image" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>

    <!-- Twitter Card data -->
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:site" content="@<?php echo (($tmp = $_smarty_tpl->tpl_vars['siteTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta name="twitter:title" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>    
	<?php } else { ?>
		<meta name="twitter:title" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>    
	<?php }?>		
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta name="twitter:description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
	<?php } else { ?>
		<meta name="twitter:description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
	<?php }?>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pzgeImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta name="twitter:image" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
	<?php } else { ?>
		<meta name="twitter:image" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['combineFlag']->value) {?>
		<?php
$__section_idx_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['fileOnecss']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_0_total = $__section_idx_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_0_total !== 0) {
for ($__section_idx_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_0_iteration <= $__section_idx_0_total; $__section_idx_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
			<link href="<?php echo $_smarty_tpl->tpl_vars['fileOnecss']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" rel="stylesheet" type="text/css">
		<?php
}
}
?>
		<?php
$__section_idx_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['fileOnejs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_1_total = $__section_idx_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_1_total !== 0) {
for ($__section_idx_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_1_iteration <= $__section_idx_1_total; $__section_idx_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['fileOnejs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
"><?php echo '</script'; ?>
>
		<?php
}
}
?>

		<?php if (!empty($_smarty_tpl->tpl_vars['fileCombinecss']->value)) {?>
			<?php echo smarty_function_combine(array('input'=>$_smarty_tpl->tpl_vars['fileCombinecss']->value,'output'=>$_smarty_tpl->tpl_vars['outputCombinecss']->value,'use_true_path'=>false,'age'=>'30','debug'=>false),$_smarty_tpl);?>

		<?php }?>
	
		<?php if (!empty($_smarty_tpl->tpl_vars['fileCombinejs']->value)) {?>
			<?php echo smarty_function_combine(array('input'=>$_smarty_tpl->tpl_vars['fileCombinejs']->value,'output'=>$_smarty_tpl->tpl_vars['outputCombinejs']->value,'use_true_path'=>false,'age'=>'30','debug'=>false),$_smarty_tpl);?>

		<?php }?>
	<?php } else { ?>
		<?php
$__section_idx_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filecss']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_2_total = $__section_idx_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_2_total !== 0) {
for ($__section_idx_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_2_iteration <= $__section_idx_2_total; $__section_idx_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
			<link href="<?php echo $_smarty_tpl->tpl_vars['filecss']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" rel="stylesheet" type="text/css">
		<?php
}
}
?>
	
		<?php
$__section_idx_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filejs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_3_total = $__section_idx_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_3_total !== 0) {
for ($__section_idx_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_3_iteration <= $__section_idx_3_total; $__section_idx_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['filejs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
"><?php echo '</script'; ?>
>
		<?php
}
}
?>
	<?php }?>
	
</head>
<body>
<noscript>
	<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N4LC7NZ" height="0" width="0" style="display:none;visibility:hidden">
	</iframe>
</noscript>
<?php echo (($tmp = $_smarty_tpl->tpl_vars['MenuNav']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

<div class="social-header-zone d-none d-lg-block">
	<?php echo (($tmp = $_smarty_tpl->tpl_vars['socialBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

</div>

<div class="container-fluid main-zone">
<div class="row">

	<?php if ((($tmp = $_smarty_tpl->tpl_vars['RightSideDisplay']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 1) {?>
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['LeftSideDisplay']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 1) {?>
			<div class="col-sm-12 col-md-12 col-lg-6 order-lg-2 content-zone">
		<?php } else { ?>
			<div class="col-sm-12 col-md-12 col-lg-9 order-lg-1 content-zone">
		<?php }?>
			<div class="row">			
				<div id="message-box" class="col-sm-12">
					<div class="">
					</div>
				</div>
			</div>				
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_170823837363aa261af41eb7_28032304', 'Main');
?>

		</div>

		<?php if ((($tmp = $_smarty_tpl->tpl_vars['LeftSideDisplay']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 1) {?>
			<div class="col-sm-12 col-md-12 col-lg-3 order-lg-1 left-zone">
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_71123885463aa261b000886_23779335', 'LeftSide');
?>

			</div>
		<?php }?>
	
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['LeftSideDisplay']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 1) {?>
			<div class="col-sm-12 col-md-12 col-lg-3 order-lg-3 right-zone"> 
		<?php } else { ?>
			<div class="col-sm-12 col-md-12 col-lg-3 order-lg-2 right-zone"> 
		<?php }?>
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_45991035363aa261b001946_22949986', 'RightSide');
?>

		</div>
	<?php } else { ?>
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['LeftSideDisplay']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 1) {?>
			<div class="col-sm-12 col-md-12 col-lg-9 order-lg-2 content-zone">
		<?php } else { ?>
			<div class="col-sm-12 col-md-12 col-lg-12 order-lg-1 content-zone">
		<?php }?>
			<div class="row">			
				<div id="message-box" class="col-sm-12">
					<div class="">
					</div>
				</div>
			</div>				
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14935440563aa261b0029c0_05796348', 'Main');
?>

		</div>

		<?php if ((($tmp = $_smarty_tpl->tpl_vars['LeftSideDisplay']->value ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 1) {?>
			<div class="col-sm-12 col-md-12 col-lg-3 order-lg-1 left-zone">
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44798491063aa261b003668_01275999', 'LeftSide');
?>

			</div>
		<?php }?>	
	<?php }?>
	
</div>
</div>
	
<footer>
	<div class="footer-blurb">
		<div class="container">
			<div class="row">
				<div class="col-md-4 footer-blurb-item">
					<?php echo (($tmp = $_smarty_tpl->tpl_vars['Footer1Block']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

				</div>
				<div class="col-md-4 footer-blurb-item">
					<?php echo (($tmp = $_smarty_tpl->tpl_vars['Footer2Block']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

				</div>
				<div class="col-md-4 footer-blurb-item">
					<?php echo (($tmp = $_smarty_tpl->tpl_vars['Footer3Block']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

				</div>
			</div>
			<div class="row social-footer-zone d-lg-none">
				<?php echo (($tmp = $_smarty_tpl->tpl_vars['socialBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

			</div>
		</div>
    </div>
        
    <div class="menu-footer small-print">
      	<div class="container">
       		<p><?php echo (($tmp = $_smarty_tpl->tpl_vars['MenuFooter']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

       	</div>
    </div>
</footer>

</body>

</html>
<?php }
/* {block 'Main'} */
class Block_170823837363aa261af41eb7_28032304 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_170823837363aa261af41eb7_28032304',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php
}
}
/* {/block 'Main'} */
/* {block 'LeftSide'} */
class Block_71123885463aa261b000886_23779335 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'LeftSide' => 
  array (
    0 => 'Block_71123885463aa261b000886_23779335',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php
}
}
/* {/block 'LeftSide'} */
/* {block 'RightSide'} */
class Block_45991035363aa261b001946_22949986 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'RightSide' => 
  array (
    0 => 'Block_45991035363aa261b001946_22949986',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php
}
}
/* {/block 'RightSide'} */
/* {block 'Main'} */
class Block_14935440563aa261b0029c0_05796348 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_14935440563aa261b0029c0_05796348',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php
}
}
/* {/block 'Main'} */
/* {block 'LeftSide'} */
class Block_44798491063aa261b003668_01275999 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'LeftSide' => 
  array (
    0 => 'Block_44798491063aa261b003668_01275999',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php
}
}
/* {/block 'LeftSide'} */
}
