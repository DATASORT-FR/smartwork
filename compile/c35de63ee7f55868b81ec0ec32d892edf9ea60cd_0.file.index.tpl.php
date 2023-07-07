<?php
/* Smarty version 4.1.1, created on 2022-11-30 20:02:37
  from 'E:\xampp\htdocs\smartwork\apps\job_free\modules\caroussel\templates\src\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6387a8cdf14017_69438966',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c35de63ee7f55868b81ec0ec32d892edf9ea60cd' => 
    array (
      0 => 'E:\\xampp\\htdocs\\smartwork\\apps\\job_free\\modules\\caroussel\\templates\\src\\index.tpl',
      1 => 1496013874,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6387a8cdf14017_69438966 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><i class="fa fa-language fa-white" aria-hidden="true"></i><?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'Txt_title_caroussel');?>
</h2>
<div id="side-carousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#side-carousel" data-slide-to="0" class="active"></li>
		<li data-target="#side-carousel" data-slide-to="1"></li>
		<li data-target="#side-carousel" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="carousel-item active">
			<a href="#">			
				<img class="img-responsive" src="holder.js/400x300?bg=FF8C00&text=Image%201" alt="">
			</a>
			<div class="carousel-caption">
				<h3>Dramatically Engage</h3>
				<p>Objectively innovate empowered manufactured products whereas parallel platforms.</p>
			</div>
		</div>
		<div class="carousel-item">
			<a href="#">
				<img class="img-responsive" src="holder.js/400x300?bg=FF8C00&text=Image%202" alt="">
			</a>
			<div class="carousel-caption">
				<h3>Efficiently Unleash</h3>
				<p>Dramatically maintain clicks-and-mortar solutions without functional solutions.</p>
			</div>
		</div>
		<div class="carousel-item">
			<a href="#">
				<img class="img-responsive" src="holder.js/400x300?bg=FF8C00&text=Image%203" alt="">
			</a>
			<div class="carousel-caption">
				<h3>Proactively Pontificate</h3>
				<p>Holistically pontificate installed base portals after maintainable products.</p>
			</div>
		</div>			  
	</div>
	<a class="left carousel-control" href="#side-carousel" role="button" data-slide="prev">
		<span class="fa fa-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#side-carousel" role="button" data-slide="next">
		<span class="fa fa-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<?php }
}
