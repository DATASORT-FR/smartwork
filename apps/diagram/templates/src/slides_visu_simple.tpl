<link href="{$visuCss}" rel="stylesheet" type="text/css">
<script src="{$visuJs}"></script>

<script>
	$(document).ready(
		function() {
			initSlidesSimple();
		}
	);
</script>
<div class="slide-simple"  domainid="{$domainId}" domainname="{$domainName}" selected="" save="{$pageSave}" visu="{$pageVisu}" hierarchy="{$pageHierarchy}" dossier="{$pageDossier}" download="{$downloadDossier}">
	<div class="container header">
		<div class="icon">
			<img src="./images/separation/icon-node-visu-v2.svg">
		</div>
	</div>
	<div class="container title-zone">
		<div class="text">
		</div>
		<div class="level">
		</div>
	</div>
	<div class="container info-zone">
		<div class="image">
			<img src="">
		</div>
		<div class="content">
			<div class="text">
			</div>
		</div>
	</div>
	<div class="container link-zone">
	</div>
	<div class="container variable-zone">
		<div class="text">
		</div>
		<div class="content">
			<div class="image">
				<img src="">
			</div>
			<div class="form">
			</div>
		</div>
	</div>
	<div class="container result-zone">
		<div class="text">
		</div>
		<div class="content">
			<div class="image">
				<img src="">
			</div>
			<div class="form">
			</div>
		</div>
	</div>
	<div class="container btn-zone">
		<button class="btn border-btn btn-previous" type="button">Revenir</button>
		<button class="btn border-btn btn-next" type="button">Continuer</button>
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
	<div class="tool">
		<div class="block">
			<h1 class="title">
			</h1>
			<button class="bt-exit" type="button">
				<i class="fa fa-times"></i>
			</button>
			<div class="box">
				<div class="container info-zone">
				</div>
				<div class="container variable-zone">
				</div>
				<div class="container result-zone">
				</div>
			</div>
		</div>
	</div>
</div>
