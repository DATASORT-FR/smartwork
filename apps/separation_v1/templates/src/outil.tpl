{extends file="standard.tpl"}

{block name=Main}
<link href="{$cssTool}" rel="stylesheet" type="text/css">
<section>
	<div id="main-zone" class="main-zone block-ws begin"  diagramid="{$diagramId}" diagramname="{$diagramName}" diagramtype="{$diagramType}" nodeselected="{$nodeSelected}" hierarchy="{$pageHierarchy}" visu="{$pageVisu}" save="{$nodeSave}" control="{$pageControl}" variable="{$pageVariable}" result="{$pageResult}" diagnostic="{$pageDiagnostic}" dossier="{$pageDossier}" procedure="{$pageProcedure}" download="{$downloadDossier}">
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
{/block}

