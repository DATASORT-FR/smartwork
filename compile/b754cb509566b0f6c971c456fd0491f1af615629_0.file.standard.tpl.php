<?php
/* Smarty version 4.1.1, created on 2022-10-15 12:08:41
  from 'E:\xampp\htdocs\smartwork\apps\tool_v0\templates\src\standard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634a86a9714837_86570609',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b754cb509566b0f6c971c456fd0491f1af615629' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\tool_v0\\templates\\src\\standard.tpl',
      1 => 1648595770,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634a86a9714837_86570609 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'E:\\xampp\\htdocs\\smartwork\\libs\\smarty-4.1.1\\libs\\plugins\\function.combine.php','function'=>'smarty_function_combine',),));
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieParam']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
		<?php echo '<script'; ?>
 type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=G-LKS36WLSEH"><?php echo '</script'; ?>
>
	<?php }?>
	<?php echo '<script'; ?>
>
		window.dataLayer = window.dataLayer || [];
		function gtag() {
			dataLayer.push(arguments);
		}
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieParam']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
			<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieFlag']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
				function gtag_report_conversion(url) {
					var callback = function () {
						if (typeof(url) != 'undefined') {
						}
					};
					gtag('event', 'conversion', {
						'send_to': 'AW-10797084116/7J91CNr31v4CENTbuZwo',
						'event_callback': callback
					});
					return false;
				}
				function gtag_report_conversion2(url) {
					var callback = function () {
						if (typeof(url) != 'undefined') {
						}
					};
					gtag('event', 'conversion', {
						'send_to': 'AW-10797084116/QWSPCJ2hq4IDENTbuZwo',
						'event_callback': callback
					});
					return false;
				}
				gtag('js', new Date());
				gtag('config', 'G-LKS36WLSEH');
				gtag('config', 'AW-10797084116');
			<?php }?>
		<?php }?>
	<?php echo '</script'; ?>
>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieParam']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
		<meta name="google-site-verification" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['appGoogleVerif']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
	<?php }?>

	<?php if (!(($tmp = $_smarty_tpl->tpl_vars['browserCache']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
	<?php }?>

    <!-- Main data -->
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<title><?php echo (($tmp = $_smarty_tpl->tpl_vars['urlTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</title>
	<?php } else { ?>
		<title><?php echo (($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</title>
	<?php }?>
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

    <!-- Twitter Card data -->
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:site" content="@<?php echo (($tmp = $_smarty_tpl->tpl_vars['twitterTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
	<meta name="twitter:creator" content="@<?php echo (($tmp = $_smarty_tpl->tpl_vars['twitterTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>

    <!-- Open Graph data -->
	<meta property="og:site_name" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['siteTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlLink']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta property="og:title" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta property="og:title" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageTitle']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>		
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta property="og:description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta property="og:description" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageDescription']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['pageImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == '') {?>
		<meta property="og:image" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php } else { ?>
		<meta property="og:image" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['pageImage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php }?>

	<!-- base ref -->
	<base href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['baseUrl']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" >
	<link rel="alternate" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['baseUrl']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" hreflang="fr-FR"/>
    <link rel="canonical" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['urlLink']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"/>
	<link rel="icon" type="image/x-icon" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['favicon']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />

	<?php if ($_smarty_tpl->tpl_vars['combineFlag']->value) {?>
		<?php
$__section_idx_5_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['fileOnecss']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_5_total = $__section_idx_5_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_5_total !== 0) {
for ($__section_idx_5_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_5_iteration <= $__section_idx_5_total; $__section_idx_5_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
			<link href="<?php echo $_smarty_tpl->tpl_vars['fileOnecss']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" rel="stylesheet" type="text/css">
		<?php
}
}
?>

		<?php if (!empty($_smarty_tpl->tpl_vars['fileCombinecss']->value)) {?>
			<?php echo smarty_function_combine(array('input'=>$_smarty_tpl->tpl_vars['fileCombinecss']->value,'output'=>$_smarty_tpl->tpl_vars['outputCombinecss']->value,'use_true_path'=>false,'age'=>'30','debug'=>false),$_smarty_tpl);?>

		<?php }?>
	<?php } else { ?>
		<?php
$__section_idx_6_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filecss']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_6_total = $__section_idx_6_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_6_total !== 0) {
for ($__section_idx_6_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_6_iteration <= $__section_idx_6_total; $__section_idx_6_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
			<link href="<?php echo $_smarty_tpl->tpl_vars['filecss']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
" rel="stylesheet" type="text/css">
		<?php
}
}
?>
	<?php }?>
	<?php echo '<script'; ?>
 src="./libs/jquery-3.6.0/js/jquery.min.js"><?php echo '</script'; ?>
>
	<?php if ($_smarty_tpl->tpl_vars['flagAdmin']->value) {?>
		<?php echo '<script'; ?>
 src="./libs/ckeditor-5/ckeditor.js"><?php echo '</script'; ?>
>
	<?php }?>

</head>
<body class="separation <?php echo (($tmp = $_smarty_tpl->tpl_vars['classPage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieParam']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieFlag']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
			<noscript>
				<iframe src="https://www.googletagmanager.com/ns.html?id=G-LKS36WLSEH" height="0" width="0" style="display:none;visibility:hidden">
				</iframe>
			</noscript>
		<?php }?>
	<?php }?>
	<header>

        <!-- NAV START -->
		<nav class="navbar navbar-expand-lg top">
			<div class="container">
				<figure class="navbar-logo">
					<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkHome']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
						<img class="top" src="./images/separation/icon-planete_separation_blanc.svg" alt="Tout savoir sur ma séparation, mon divorce" title="Divorcer ou se séparer, un diagnostic complet">
					</a>
				</figure>
				<button type="button" class="navbar-toggler collapsed" data-bs-toggle="collapse" data-bs-target="#main-nav">
                    <span class="menu-icon-bar"></span>
                    <span class="menu-icon-bar"></span>
                    <span class="menu-icon-bar"></span>
                </button>
                <div id="main-nav" class="collapse navbar-collapse">
					<ul class="navbar-nav ml-auto">
						<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkAPropos']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="nav-item nav-link"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_apropos');?>
</a></li>
						<li class="dropdown">
							<a href="#" class="nav-item nav-link" data-bs-toggle="dropdown"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_articles');?>
</a>
							<div class="dropdown-menu">
								<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkDossiers']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="dropdown-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_files');?>
</a>
								<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkBonPlans']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="dropdown-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_tips');?>
</a>
								<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkActualites']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="dropdown-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_news');?>
</a>
							</div>
						</li>
						<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkForum']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="nav-item nav-link"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_forum');?>
</a></li>
						<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkContact']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="nav-item nav-link"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_contact');?>
</a></li>
						<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkDiagnostic']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="nav-item nav-link"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_diagnostic');?>
</a></li>
						<?php if ($_smarty_tpl->tpl_vars['flagAdmin']->value) {?>
							<li class="dropdown">
								<a href="#" class="nav-item nav-link" data-bs-toggle="dropdown"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_admin');?>
</a>
								<div class="dropdown-menu">
									<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkParameters']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="dropdown-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_parameters');?>
</a>
								</div>
							</li>
						<?php }?>
						<li class="nav-connect">
							<?php if ((($tmp = $_smarty_tpl->tpl_vars['flagConnect']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
								<a class="nav-item nav-link mnu-connected" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkMonCompte']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_account');?>
</a>
							<?php } else { ?>
								<a class="nav-item nav-link mnu-connected display-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkMonCompte']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_account');?>
</a>
							<?php }?>
							<?php if ((($tmp = $_smarty_tpl->tpl_vars['flagConnect']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
								<a class="nav-item nav-link mnu-connection display-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkLogin']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_registration');?>
</a>
							<?php } else { ?>
								<a class="nav-item nav-link mnu-connection" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkLogin']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_registration');?>
</a>
							<?php }?>
						</li>
					</ul>
				</div>
			</div>
		</nav>
        <!-- NAV END -->

	</header>

	<div id="content" loginRef="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkLoginBox']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1674958328634a86a96f0529_89943550', 'Main');
?>

	</div>	

    <!--COOKIES-->
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['classPage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != 'cookies') {?>
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieParam']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
			<?php if (!(($tmp = $_smarty_tpl->tpl_vars['cookieResponse']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
				<div class="cookie-tool cookie-choice">
					<div class="container">
						<div class="cookie-info">
							<p>
								<span>Nous utilisons nos propres cookies de session pour vous offrir une meilleure expérience d’utilisation de nos services et pour améliorer votre expérience de navigation.</span>
								<a class="cookie-more" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkCookies']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">Cliquez-ici</a>
								<span> pour en savoir plus.</span>
							</p>
							<p>
								<a class="cookie-dismiss" href="#" event="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkCookieDismiss']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">Cliquez-ici</a>
								<span> pour continuer sans accepter les cookiies de navigation.</span>
							</p>
						</div>
						<div class="cookie-btn">
							<a class="btn border-btn cookie-accept" href="#" event="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkCookieAccept']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">AUTORISER LES COOKIES</a>
						</div>
					</div>
				</div>
			<?php }?>
		<?php }?>
	<?php }?>
	
	<div class="extra display-none">
		<div class="box">
			<button class="bt-exit" type="button">
				<i class="fa fa-times"></i>
			</button>
			<div class="main-content">
			</div>
		</div>
	</div>

	<div class="box-model display-none">
	</div>

	<div class="box-confirm display-none">
	</div>

<?php if ($_smarty_tpl->tpl_vars['combineFlag']->value) {?>
	<?php if (!empty($_smarty_tpl->tpl_vars['fileCombinejs']->value)) {?>
		<?php echo smarty_function_combine(array('input'=>$_smarty_tpl->tpl_vars['fileCombinejs']->value,'output'=>$_smarty_tpl->tpl_vars['outputCombinejs']->value,'use_true_path'=>false,'age'=>'30','debug'=>false),$_smarty_tpl);?>

	<?php }?>
	<?php
$__section_idx_7_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['fileOnejs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_7_total = $__section_idx_7_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_7_total !== 0) {
for ($__section_idx_7_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_7_iteration <= $__section_idx_7_total; $__section_idx_7_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['fileOnejs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
"><?php echo '</script'; ?>
>
	<?php
}
}
} else { ?>
	<?php
$__section_idx_8_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filejs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_8_total = $__section_idx_8_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_8_total !== 0) {
for ($__section_idx_8_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_8_iteration <= $__section_idx_8_total; $__section_idx_8_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
?>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['filejs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] : null)];?>
"><?php echo '</script'; ?>
>
	<?php
}
}
}?>
</body>

</html>
<?php }
/* {block 'Main'} */
class Block_1674958328634a86a96f0529_89943550 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_1674958328634a86a96f0529_89943550',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php
}
}
/* {/block 'Main'} */
}
