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
		<div class="container mt-5 mb-5">
			<article class="block-ws block-main" box-id="content" link_block="#first_block" box-model="box-model" itemscope="" itemtype="http://schema.org/Article">
				<h1>{#Title_parameters#}</h1>
				
				<div class="form-row">
						<label for="name" class="form-label">{#Lbl_phone_toggle#}</label>
						{if !$flagPhone}
							<button type="button" class="btn btn-primary bt-event" event="{$LinkPhoneEnable|default:''}">
								{#Bt_phone_enable#}
							</button>
						{else}
							<button type="button" class="btn btn-primary bt-event" event="{$LinkPhoneDisable|default:''}">
								{#Bt_phone_disable#}
							</button>
						{/if}
				</div>

				<div class="form-row">
						<label for="name" class="form-label">{#Lbl_clearcache#}</label>					
						<button type="button" class="btn btn-primary bt-proc-confirm" title="Action" label="Voulez-vous effacer le cache" event="{$linkClearCache|default:''}">
							{#Bt_clearcache#}
						</button>
				</div>
			</article>
		</div>
    </section>
{/block}