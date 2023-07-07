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

{extends file="standard.tpl"}

{block name=Main}
   <section>
		<div class="container">
			<h1>{#Title_parameters#}</h1>
				
			<div class="block-ws">
				<form class="crud" Method="POST">
					<div class="form-row">
						<label for="domain" class="form-label">{#Lbl_Domain#}</label>
						<input type="text" class="domain form-input" name="domain" value="{$DomainId}">
					</div>
					<div class="form-row">
						<label for="diagram" class="form-label">{#Lbl_Diagram#}</label>
						<input type="text" class="diagram form-input" name="diagram" value="{$DiagramId}">
					</div>
					<div class="form-row">
						<label class="form-label"></label>					
						<button type="button" class="btn btn-primary bt-async" event="{$LinkParamUpdate|default:''}">
							<i class="fas fa-sign-in-alt me-1" aria-hidden="true"></i>
							{#Bt_update#}
						</button>
					</div>
				</form>
			</div>

			<div class="mt-5">
				<div class="form-row">
					<label for="name" class="form-label">{#Lbl_clearcache#}</label>					
					<button type="button" class="btn btn-primary bt-proc-confirm" title="Action" label="Voulez-vous effacer le cache" event="{$linkClearCache|default:''}">
						{#Bt_clearcache#}
					</button>
				</div>
			</div>
		</div>
    </section>
{/block}