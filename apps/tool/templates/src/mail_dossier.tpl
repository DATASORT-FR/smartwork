{extends file="mail_standard.tpl"}

{block name=Main}
	{#Mail_dossier_html#}
	<p>
	{#Lbl_dossier_name#} {$Name}
	</p>
	<p>
	{#Lbl_dossier_surname#} {$Surname}
	</p>
	<p>
	{#Lbl_dossier_email#} {$Email}
	</p>
{/block}
