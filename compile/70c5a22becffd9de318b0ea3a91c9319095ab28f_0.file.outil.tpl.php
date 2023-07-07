<?php
/* Smarty version 4.1.1, created on 2022-11-26 04:21:14
  from 'E:\xampp\htdocs\smartwork\apps\separation_v1\templates\src\outil.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6381862ad1f9d0_03800635',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70c5a22becffd9de318b0ea3a91c9319095ab28f' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\separation_v1\\templates\\src\\outil.tpl',
      1 => 1666129987,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6381862ad1f9d0_03800635 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4562650556381862ad185f1_30171317', 'Main');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_4562650556381862ad185f1_30171317 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_4562650556381862ad185f1_30171317',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<link href="<?php echo $_smarty_tpl->tpl_vars['cssTool']->value;?>
" rel="stylesheet" type="text/css">
<section>
	<div id="main-zone" class="main-zone block-ws begin"  diagramid="<?php echo $_smarty_tpl->tpl_vars['diagramId']->value;?>
" diagramname="<?php echo $_smarty_tpl->tpl_vars['diagramName']->value;?>
" diagramtype="<?php echo $_smarty_tpl->tpl_vars['diagramType']->value;?>
" nodeselected="<?php echo $_smarty_tpl->tpl_vars['nodeSelected']->value;?>
" hierarchy="<?php echo $_smarty_tpl->tpl_vars['pageHierarchy']->value;?>
" visu="<?php echo $_smarty_tpl->tpl_vars['pageVisu']->value;?>
" save="<?php echo $_smarty_tpl->tpl_vars['nodeSave']->value;?>
" control="<?php echo $_smarty_tpl->tpl_vars['pageControl']->value;?>
" variable="<?php echo $_smarty_tpl->tpl_vars['pageVariable']->value;?>
" result="<?php echo $_smarty_tpl->tpl_vars['pageResult']->value;?>
" diagnostic="<?php echo $_smarty_tpl->tpl_vars['pageDiagnostic']->value;?>
" dossier="<?php echo $_smarty_tpl->tpl_vars['pageDossier']->value;?>
" procedure="<?php echo $_smarty_tpl->tpl_vars['pageProcedure']->value;?>
" download="<?php echo $_smarty_tpl->tpl_vars['downloadDossier']->value;?>
">
		<div class="wrap">
			<div class="container zone show">
				<div class="title-zone">
					<div class="content">
					</div>
				</div>
				<div class="question-zone">
					<div class="content">
					</div>
				</div>
				<div class="question-description-zone">
					<div class="content">
					</div>
				</div>
				<div class="perso-zone">
					<div class="content">
					</div>
				</div>
				<div class="node-zone">
				</div>
				<div class="variable-zone">
					<div class="content">
						<div class="text">
						</div>
						<div class="form">
						</div>
					</div>
					<div class="image">
						<img class="" src="">
					</div>
				</div>
				<div class="result-zone">
					<div class="content">
						<div class="text">
						</div>
						<div class="form">
						</div>
					</div>
					<div class="image">
						<img class="" src="">
					</div>
				</div>
			</div>
		</div>
		<div class="btn-zone display-none">
			<button class="btn border-btn btn-previous display-none" type="button">Revenir</button>
			<button class="btn border-btn aside btn-previous display-none" type="button">
				<img src="./images/separation/btn_precedent_mobile.svg" title="Revenir">
			</button>
			<button class="btn border-btn btn-next display-none" type="button">Continuer</button>
			<button class="btn border-btn aside btn-next display-none" type="button">
				<img src="./images/separation/btn_continuer_mobile.svg" title="Continuer">
			</button>
				
			<button class="btn border-btn btn-reset display-none" type="button">Reset</button>
		</div>
	</div>
	<div class="visu">
		<div class="block">
			<div class="title-main">
			</div>
			<button class="bt-exit" type="button">
				<i class="fa fa-times"></i>
			</button>
			<div class="box">
				<div class="main-content">
					<h1 class="title">
					</h1>
					<h3 class="intro">
					</h3>
					<div class="content">
					</div>
				</div>
			</div>
			<div class="end">
			</div>
		</div>
	</div>
</section>	
<?php
}
}
/* {/block 'Main'} */
}
