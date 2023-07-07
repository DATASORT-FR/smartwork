<link href="{$visuCss}" rel="stylesheet" type="text/css">
<script src="{$visuJs}"></script>

<script>
	$(document).ready(
		function() {
			initSlidesSheet();
		}
	);
</script>
<div class="slide-sheet"  domainid="{$domainId}" domainname="{$domainName}" selected="" save="{$pageSave}" visu="{$pageVisu}" trace="{$traceId}" reference="{$reference}">

	<div id="slide_tab" class="tab-header">
		<ul class="nav nav-tabs">
			{section name=idx loop=$slideList}
				{$slide = $slideList[idx]}
				<li class="nav-item">
					<a id="tab_{$slide.reference}" class="nav-link" data-bs-toggle="tab" href="#content_{$slide.reference}" code="{$slide.code}">{$slide.title}</a>
				</li>			
			{/section}
		</ul>
	</div>
	
	<div id="slide_content" class="tab-content">

		{section name=idx loop=$slideList}
			{$slide = $slideList[idx]}

			<div id="content_{$slide.reference}" class="tab-pane">

				<div class="container header">
					<div class="icon">
						<img src="./images/separation/icon-node-visu-v2.svg">
					</div>
				</div>
				<div class="container info-zone">
					<div class="content">
						<div class="image">
							<img src="{$slide.image}">
						</div>
						<div class="text">
							{$slide.description}
						</div>
					</div>
					<div class="form">
					</div>
				</div>
				<div class="container link-zone">
				</div>
				<div class="container variable-zone">
					<div class="text">
						{$slide.variable_description}
					</div>
					<div class="content">
						<div class="image">
							<img src="{$slide.variable_image}">
						</div>
						<div class="form">
						</div>
					</div>
					<div class="form1">
					</div>
				</div>
				<div class="container result-zone">
					<div class="text">
						{$slide.result_description}
					</div>
					<div class="content">
						<div class="image">
							<img src="{$slide.result_image}">
						</div>
						<div class="form">
						</div>
					</div>
				</div>
			</div>
		{/section}

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
