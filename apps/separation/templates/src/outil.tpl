{extends file="standard.tpl"}

{block name=Main}
<section>
	<div class="main-zone block-ws begin"  diagramid="{$diagramId}" diagramname="{$diagramName}" diagramtype="{$diagramType}" nodeselected="{$nodeSelected}" hierarchy="{$pageHierarchy}" visu="{$pageVisu}" save="{$nodeSave}" variable="{$pageVariable}" result="{$pageResult}" diagnostic="{$pageDiagnostic}" dossier="{$pageDossier}" procedure="{$pageProcedure}" download="{$downloadDossier}">
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
{/block}

