<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<base href="{$baseUrl|default:''}" >
	<link rel="icon" type="image/x-icon" href="{$favicon|default:''}" />
</head>
<body class="separation pdf">
	<style type="text/css">
		.pdfbar {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
		}
		.pdfbar .pdfbar-logo {
		}
		.pdfbar .pdfbar-logo img {
			width: auto;
		}
		.pdfcontent {
			margin: 2rem;
			margin-top: 0rem;
		}
	</style>
    <div>
		<div class="pdfbar">
			<div class="pdfbar-logo">
				<img src="{$imgLogo}" alt="">
			</div>
		</div>
    </div>
	<div class="pdfcontent" id="content">
		{block name=Main}
		{/block}
	</div>	

</body>

</html>
