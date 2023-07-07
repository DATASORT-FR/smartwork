<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		{block name=Main}
			{$body}
		{/block}
		<div id="message-ws" class="box-message" message_code="{$MessageCode}" message_text="{$MessageText}">
		</div>
	</body>
</html> 