<?php 
/**
* This file contains template for administration action.
*
* @package    
* @subpackage view
* @version    1.0
* @date       23 May 2021
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>

{extends file="index.tpl"}

{block name=Main}
	<div id="adm_actions" class="box-header block-adm block-actions block-ws block-main" box-model="box-model">
		<header class="page-header">
			<h1>{#admactionTitle#}</h1>
		</header>
		<div class="row form-group">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 text-md-right">
				<label class="col-form-label">{#Lbl_clearcache#}</label>				
			</div>
			<div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
				<button type="button" class="btn btn-primary bt-async" event="{$pageClearCache}">
					{#Bt_clearcache#}
				</button>
			</div>
		</div>
	</div>
{/block}