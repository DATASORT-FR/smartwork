{extends file="standard.tpl"}

{block name=Main}
<section>
	<div class="container">
		<div class="row">
			<div class="blog col-lg-9">
				{$contentBlock|default:''}
			</div>
			<div class="col-lg-3">
				<aside class="article">
					<div class="aside-block">
						<div class="form-group blog-search">
							<span class="fa fa-search form-control-feedback"></span>
							<input type="text" class="form-control" placeholder="Recherche">
						</div>
						<div class="headline-banner">
							{if $contentCode|default:'' == 'ACTUALITES'}
								<h4>Autres actualités</h4>
							{/if}
							{if $contentCode|default:'' == 'BONPLANS'}
								<h4>Autres bons plans</h4>
							{/if}
							{if $contentCode|default:'' == 'DOSSIERS'}
								<h4>Autres dossiers</h4>
							{/if}
						</div>
						<div class="recent-post-thumb diagnostic">
							<a class="decoration-none" href="{$LinkDiagnostic|default:''}">
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
								<h5><a class="decoration-none" href="{$LinkDiagnostic|default:''}">Cliquez-ici</a></h5>
							</div>
						</div>
						{$contentSideBlock|default:''}
					</div>	
				</aside>
			</div>
		</div>
	</div>
</section>

{/block}
