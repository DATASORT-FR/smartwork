<!DOCTYPE html>
<html lang="fr">
	<head>
		<base href="{$baseUrl|default:''}" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<link type="text/css" rel="stylesheet" href="https://use.typekit.net/szf4wfs.css"/>
	</head>
	<body>
		<style type="text/css">	
			.mail {
				max-width:1100px;
				margin:auto;
			}
			.mail a,
			.mail a:focus,
			.mail a:hover {
				text-decoration: none;
			}
			.mail h1 {
				background-color: transparent;
				color: #033b4a;
				font-family: Poppins', sans-serif;
				font-size: 2.7rem;
				font-weight: 700;
				font-style: normal;
				letter-spacing: 0;
				line-height: 3.5rem;
				margin-top: 0;
				margin-bottom: 1rem;
				border: none;
				text-align: center;
			}
			.mail .form-row {
				display: flex;
				flex-wrap: wrap;
				margin-bottom: 1rem;
				width: 100%;
			}
			
			.mail .form-row .center, 
			.mail .form-row .center:focus {
				margin: auto;
			}
			.mail .content_1 {
				padding-left: 1rem;
				padding-right: 1rem;
			}
			.mail .content_2 {
				padding-left: 1.5rem;
			}
			.mail .btn {
				color: #fff;
				background-color: #01b3e4;
				border-color: #01b3e4;
				line-height: 1.25;
				padding: .5rem 1rem;
				border-radius: .25rem;
			}
		</style>
	
		<div class ="mail">
			{block name=Main}
			{/block}
		</div>
	</body>
</html>
