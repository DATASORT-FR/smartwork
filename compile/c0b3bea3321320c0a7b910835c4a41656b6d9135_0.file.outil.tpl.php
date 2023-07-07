<?php
/* Smarty version 4.1.1, created on 2022-10-15 12:08:41
  from 'E:\xampp\htdocs\smartwork\apps\tool_v0\templates\src\outil.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_634a86a95c1a25_96543178',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0b3bea3321320c0a7b910835c4a41656b6d9135' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\tool_v0\\templates\\src\\outil.tpl',
      1 => 1664521703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_634a86a95c1a25_96543178 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_679419687634a86a95bed22_45563786', 'Main');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "standard.tpl");
}
/* {block 'Main'} */
class Block_679419687634a86a95bed22_45563786 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'Main' => 
  array (
    0 => 'Block_679419687634a86a95bed22_45563786',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<section>
	<div class="main-zone"  diagramid="<?php echo $_smarty_tpl->tpl_vars['diagramId']->value;?>
" diagramname="<?php echo $_smarty_tpl->tpl_vars['diagramName']->value;?>
" diagramtype="<?php echo $_smarty_tpl->tpl_vars['diagramType']->value;?>
" nodeselected="<?php echo $_smarty_tpl->tpl_vars['nodeSelected']->value;?>
" hierarchy="<?php echo $_smarty_tpl->tpl_vars['pageHierarchy']->value;?>
" visu="<?php echo $_smarty_tpl->tpl_vars['pageVisu']->value;?>
" save="<?php echo $_smarty_tpl->tpl_vars['nodeSave']->value;?>
" variable="<?php echo $_smarty_tpl->tpl_vars['pageVariable']->value;?>
" result="<?php echo $_smarty_tpl->tpl_vars['pageResult']->value;?>
" diagnostic="<?php echo $_smarty_tpl->tpl_vars['pageDiagnostic']->value;?>
" dossier="<?php echo $_smarty_tpl->tpl_vars['pageDossier']->value;?>
" procedure="<?php echo $_smarty_tpl->tpl_vars['pageProcedure']->value;?>
" download="<?php echo $_smarty_tpl->tpl_vars['downloadDossier']->value;?>
">
		<div class="container title-zone">
		</div>
		<div class="container question-zone">
		</div>
		<div class="container question-description-zone">
		</div>
		<div class="container perso-zone">
		</div>
		<div class="container node-zone">
		</div>
		<div class="container variable-zone">
			<div class="content">
				<div class="text">
				</div>
				<div class="form">
				</div>
			</div>
			<div class="image">
				<img src="">
			</div>
		</div>
		<div class="container result-zone">
			<div class="content">
				<div class="text">
				</div>
				<div class="form">
				</div>
			</div>
			<div class="image">
				<img src="">
			</div>
		</div>
		<div class="container btn-zone">
			<button class="btn border-btn btn-previous" type="button">Revenir</button>
			<button class="btn border-btn btn-next" type="button">Continuer</button>
		</div>
	</div>
	<div class="visu">
		<div class="block">
			<h1 class="title">
			</h1>
			<button class="bt-exit" type="button">
				<i class="fa fa-times"></i>
			</button>
			<div class="box">
				<div class="main-content">
					<h3 class="intro">
					</h3>
					<div class="content">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
<?php
}
}
/* {/block 'Main'} */
}
