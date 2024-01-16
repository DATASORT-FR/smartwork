{extends file="standard.tpl"}

{block name=Main}
   <section>
		<div class="container mt-5">
			{$contentBlock|default:''}
		</div>
		{if $cookieResponse|default:false}
			<div class="container">
				{if $cookieFlag|default:true}
					<p>Vous avez autorisé les cookies. Vous pouvez modifier votre choix.</p>
				{else}
					<p>Vous avez décidé de continuer sans autoriser les cookies. Vous pouvez modifier votre choix.</p>
				{/if}
			</div>
		{/if}
		<div class="container cookie-container mb-5">
			<div class="cookie-btn">
				<a class="btn border-btn cookie-accept" href="#" event="{$LinkCookieAccept|default:''}">AUTORISER LES COOKIES</a>
			</div>
			<div class="cookie-btn">
				<a class="btn border-btn cookie-dismiss" href="#" event="{$LinkCookieDismiss|default:''}">CONTINUER SANS AUTORISER LES COOKIES</a>
			</div>
		</div>
    </section>
{/block}
