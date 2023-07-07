{extends file="simple.tpl"}

{block name=Main}
	<div class="parent-visu">
		<div class="box node-parent">
		</div>
		<div class="arrow">
			<svg class="" viewBox="0 0 20 10">
				<polygon points="0 0, 20 0,10 10" width="20" height="20" class="background"></polygon>
			</svg>
		</div>
	</div>
	<div class="select-visu">
		<div class="box node-select">
		</div>
		<div class="arrow">
			<svg class="" viewBox="0 0 20 10">
				<polygon points="0 0, 20 0,10 10" width="20" height="20" class="background"></polygon>
			</svg>
		</div>
	</div>
	<div class="question-visu">
		<div class="box">
		</div>
	</div>
	<svg id="node-svg" class="node-doc" width="100%" viewbox="0 0 1100 350" diagramid="{$diagramId}" diagramname="{$diagramName}" diagramtype="{$diagramType}" nodeselected="{$nodeSelected}" hierarchy="{$pageHierarchy}" visu="{$pageVisu}" save="{$nodeSave}" xmlns="http://www.w3.org/2000/svg" version="1.1">
		<defs>
			<filter id="shadow">
				<feGaussianBlur in="SourceAlpha" stdDeviation="1.5" result="flou"/>
				<feOffset in="flou" dx="3" dy="3" result="flouDecale"/>
				<feMerge>
					<feMergeNode in="flouDecale"/>
					<feMergeNode in="SourceGraphic"/>
				</feMerge>
			</filter>
		</defs>
	</svg>
	<div class="process-visu">
		<div class="box node-process">
			<div class="image">
				<img src="" style="width:100%">
			</div>
			<div class="body">
				<div class="header">
				</div>
				<div class="first">
				</div>
				<div class="second">
					Pour accéder aux conséquences financières et à la procédure de ce divorce, remplissez quelques informations. Cliquez maintenant sur le bouton ci-dessous :			
				</div>		
				<div class="link-btn variable-link">
					<img src="./images/separation/btn_informations.svg" title="Renseigner mes informations">
					Renseigner mes informations
				</div>
			</div>
			<div class="icon">
				<img src="./images/separation/icon-node-visu.svg">
			</div>
		</div>
	</div>
	<style>
		.espace-block.situation .content .main-zone {
			position: relative;
		}
		.first-visu {
			position: absolute;
		}
	</style>
	<script>
		$(document).ready(
			function() {
			}
		);
	</script>
	<div class="first-visu">
		<div class="box node-first">
			<div class="image">
				<img src="" style="width:100%">
			</div>
			<div class="body">
				<div class="header">
				</div>
				<div class="body">
				</div>
				<div class="first">
				</div>
				<div class="second">
				</div>
			</div>
		</div>
	</div>
	
{/block}

