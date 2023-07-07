<?php
/* Smarty version 4.1.1, created on 2022-12-10 13:07:43
  from 'E:\xampp\htdocs\smartwork\apps\separation_v0\templates\src\standard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6394768f06ec99_67731238',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '63c3787ca2e2e63158a31adcfa05e26cca229335' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v0\\templates\\src\\standard.tpl',
      1 => 1660427955,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6394768f06ec99_67731238 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'E:\\xampp\\htdocs\\smartwork\\libs\\smarty-4.1.1\\libs\\plugins\\function.combine.php','function'=>'smarty_function_combine',),));
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
	<?php echo '<script'; ?>
 type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=G-LKS36WLSEH"><?php echo '</script'; ?>
>
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
	<meta name="google-site-verification" content="<?php echo (($tmp = $_smarty_tpl->tpl_vars['appGoogleVerif']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />

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
$__section_idx_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['fileOnecss']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_1_total = $__section_idx_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_1_total !== 0) {
for ($__section_idx_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_1_iteration <= $__section_idx_1_total; $__section_idx_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
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
	<?php }?>

	<?php echo '<script'; ?>
 src="./libs/jquery-3.6.0/js/jquery.min.js"><?php echo '</script'; ?>
>
	<?php if ($_smarty_tpl->tpl_vars['flagAdmin']->value) {?>
		<?php echo '<script'; ?>
 src="./libs/workspace-1.0.3/js/workspace.js"><?php echo '</script'; ?>
>
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
        <!-- TOP HEADER START -->
        <div class="top-header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <ul class="top-contact text-left">
                            <li class="email">
								<a href="mailto:info@planete-separation.fr">
									<span class="fa fa-envelope"></span>
									info@planete-separation.fr
								</a>
							</li>
                        </ul>
                    </div>
                    <div class="col-md-7 text-right">
                        <div class="top-social">
                            <ul class="social-list">
                                <li><a href="https://www.facebook.com/Planète-Séparation-100342455791967/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/PlanetSep"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/planete-separation/"><i class="fab fa-linkedin-in"></i></a></li>
                                <li class="m-0">
									<?php if ((($tmp = $_smarty_tpl->tpl_vars['flagConnect']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
										<a class="btn user-btn border-btn mnu-connected" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkMonCompte']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" role="button"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_account');?>
</a>
									<?php } else { ?>
										<a class="btn user-btn border-btn mnu-connected display-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkMonCompte']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" role="button"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_account');?>
</a>
									<?php }?>
									<?php if ((($tmp = $_smarty_tpl->tpl_vars['flagConnect']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
										<a class="btn user-btn border-btn mnu-connection display-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkLogin']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" role="button"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_registration');?>
</a>
									<?php } else { ?>
										<a class="btn user-btn border-btn mnu-connection" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkLogin']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" role="button"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_registration');?>
</a>
									<?php }?>
								</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TOP HEADER END -->
        
        <!-- NAV START -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container ">
				<figure class="navbar-logo">
					<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkHome']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="home-link">
						<img class="standard" src="./images/separation/icon-planete_separation_blanc.svg" alt="Tout savoir sur ma séparation, mon divorce" title="Divorcer ou se séparer, un diagnostic complet">
						<img class="home" src="./images/separation/icon-planete_separation.svg" alt="Tout savoir sur ma séparation, mon divorce" title="Divorcer ou se séparer, un diagnostic complet">
					</a>
				</figure>
                <a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkHome']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="navbar-brand">
					<div class="first">Planète</div>
					<div>Séparation</div>
				</a>
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
									<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkUsers']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="dropdown-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_users');?>
</a>
									<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkStatistics']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="dropdown-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_statistic');?>
</a>
									<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkLandings']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="dropdown-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_landings');?>
</a>
									<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkParameters']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="dropdown-item"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_parameters');?>
</a>
								</div>
							</li>
						<?php }?>
						<li class="nav-connect">
							<?php if ((($tmp = $_smarty_tpl->tpl_vars['flagConnect']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
								<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkMonCompte']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="nav-item nav-link mnu-connected"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_account');?>
</a>
							<?php } else { ?>
								<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkMonCompte']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="nav-item nav-link mnu-connected display-none"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_account');?>
</a>
							<?php }?>
							<?php if ((($tmp = $_smarty_tpl->tpl_vars['flagConnect']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
								<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkLogin']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="nav-item nav-link mnu-connection display-none"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_registration');?>
</a>
							<?php } else { ?>
								<a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkLogin']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" class="nav-item nav-link mnu-connection"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_registration');?>
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17881044266394768f063b14_77387435', 'Main');
?>

	</div>	

    <!-- FOOTER START -->
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['classPage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != 'diagnostic') {?>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-footer">
						<figure class="footer-logo">
							<img src="./images/separation/icon-planete_separation.svg" alt="Tout savoir sur ma séparation, mon divorce" title="Divorcer ou se séparer, un diagnostic complet">
						</figure>
						<p class="footer-logo-text">En quelques clics, vous accédez à une analyse complète.</p>
					</div>
					<div class="col-lg-4 col-footer">
						<h5>Liens</h5>
						<ul class="quick-links left-layer">
							<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkHome']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_home2');?>
</a></li>
							<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkContact']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_contact2');?>
</a></li>
							<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkPartenaires']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_partners');?>
</a></li>
							<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkCookies']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_cookies');?>
</a></li>
						</ul>
						<ul class="quick-links right-layer">
							<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkCGU']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_cgu');?>
</a></li>
							<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkConfidentialite']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_confidentiality');?>
</a></li>
							<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkMentionsLegales']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_legal_notice');?>
</a></li>
							<li><a href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkSiteMap']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" target="_newtab"><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Mnu_sitemap');?>
</a></li>
						</ul>
					</div>
					<div class="col-lg-4 col-footer">
						<h5>Notre Newsletter</h5>
						<p>Souscrivez à notre Newsletter pour recevoir des informations sur nos services.</p>
						<div class="newsletter mt-2">
							<form action="#" method="post" name="sign-up">
								<input type="email" class="input" id="email" name="email" placeholder="Votre adresse mail" required>
								<input type="submit" class="button" id="submit" value="S'inscrire">
							</form>
						</div>
					</div>
				</div>
				<hr class="footer">
				<div class="bottom-footer">
					<div class="row">
						<div class="col-lg-6">
							<p class="right">© 2021 MVSP tous droits réservés.</p>
						</div>
						<div class="col-lg-6">
							<ul class="footer-social">
								<li><a href="https://www.facebook.com/Planète-Séparation-100342455791967/"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/PlanetSep"><i class="fab fa-twitter"></i></a></li>
								<li><a href="https://www.linkedin.com/company/planete-separation/"><i class="fab fa-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
	<?php }?>
    <!-- FOOTER END -->

    <!--SCROLL TOP START-->
<!--
    <a href="#0" class="cd-top">Top</a>
-->

    <!--PHONE BOX-->
	<?php if ($_smarty_tpl->tpl_vars['flagPhone']->value) {?>
		<div class="phone-ask init-display">
			<figure class="icon ab-box-icon">
				<img src="./images/separation/icon_phone_box.svg" alt="N° de téléphone 01.45.03.13.45" title="Notre N° de téléphone">
			</figure>
		</div>
		<div class="phone-nb init-display-none display-none">
			<p>Besoin d'aide ?</p>
			<p>Appelez-nous au</p>
			<p class="number">01 45 03 13 45</p>
			<p class="small">(Appel non surtaxé)</p>
			<figure class="icon">
				<img src="./images/separation/icon_phone_box_blue.svg" alt="N° de téléphone 01.45.03.13.45" title="Notre N° de téléphone">
			</figure>
		</div>
	<?php }?>

    <!--COOKIES-->
	<?php if ((($tmp = $_smarty_tpl->tpl_vars['classPage']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) != 'cookies') {?>
		<?php if ((($tmp = $_smarty_tpl->tpl_vars['cookieParam']->value ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>
			<?php if (!(($tmp = $_smarty_tpl->tpl_vars['cookieResponse']->value ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>
				<div class="cookie-choice">
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
$__section_idx_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['fileOnejs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_3_total = $__section_idx_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_3_total !== 0) {
for ($__section_idx_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_3_iteration <= $__section_idx_3_total; $__section_idx_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
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
$__section_idx_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['filejs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_idx_4_total = $__section_idx_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_idx'] = new Smarty_Variable(array());
if ($__section_idx_4_total !== 0) {
for ($__section_idx_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index'] = 0; $__section_idx_4_iteration <= $__section_idx_4_total; $__section_idx_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_idx']->value['index']++){
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
class Block_17881044266394768f063b14_77387435 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_17881044266394768f063b14_77387435',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php
}
}
/* {/block 'Main'} */
}
