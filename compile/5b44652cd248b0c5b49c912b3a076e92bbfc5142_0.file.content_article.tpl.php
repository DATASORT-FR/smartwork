<?php
/* Smarty version 4.1.1, created on 2022-12-09 18:00:44
  from 'E:\xampp\htdocs\smartwork\apps\separation\templates\src\content_article.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_639369bc1e5e32_82913434',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b44652cd248b0c5b49c912b3a076e92bbfc5142' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation\\templates\\src\\content_article.tpl',
      1 => 1647272106,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_639369bc1e5e32_82913434 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_991031260639369bc1d4ff6_87271092', 'Main');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_991031260639369bc1d4ff6_87271092 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_991031260639369bc1d4ff6_87271092',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<section>
	<div class="container">
		<div class="row">
			<div class="blog col-lg-9">
				<?php echo (($tmp = $_smarty_tpl->tpl_vars['contentBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

			</div>
			<div class="col-lg-3">
				<aside class="article">
					<div class="aside-block">
						<div class="form-group blog-search">
							<span class="fa fa-search form-control-feedback"></span>
							<input type="text" class="form-control" placeholder="Recherche">
						</div>
						<div class="headline-banner">
							<?php if ((($tmp = $_smarty_tpl->tpl_vars['contentCode']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 'ACTUALITES') {?>
								<h4>Autres actualités</h4>
							<?php }?>
							<?php if ((($tmp = $_smarty_tpl->tpl_vars['contentCode']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 'BONPLANS') {?>
								<h4>Autres bons plans</h4>
							<?php }?>
							<?php if ((($tmp = $_smarty_tpl->tpl_vars['contentCode']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp) == 'DOSSIERS') {?>
								<h4>Autres dossiers</h4>
							<?php }?>
						</div>
						<div class="recent-post-thumb diagnostic">
							<a class="decoration-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkDiagnostic']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
								<figure class="rp-feature">
									<img src="./images/separation/diagnostic.gif" alt="">
									<div class="text">
										<h5>Diagnostic 
										<br>Personnalisé 
										<br>100% en ligne</h5>
									</div>
								</figure>
							</a>
							<div class="rpt-caption">
								<h5><a class="decoration-none" href="<?php echo (($tmp = $_smarty_tpl->tpl_vars['LinkDiagnostic']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">Cliquez-ici</a></h5>
							</div>
						</div>
						<?php echo (($tmp = $_smarty_tpl->tpl_vars['contentSideBlock']->value ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>

					</div>	
				</aside>
			</div>
		</div>
	</div>
</section>

<?php
}
}
/* {/block 'Main'} */
}
