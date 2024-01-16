{extends file="mail_standard.tpl"}

{block name=Main}
	{#Mail_contact_html#}
	<p>
	{#Lbl_contact_name#} {$Name}
	</p>
	<p>
	{#Lbl_contact_email#} {$Email}
	</p>
	<p>
	{#Lbl_contact_phone#} {$Phone}
	</p>
	<p>
	{#Lbl_contact_message#} 
	</p>
	<p>
	{$Message}
	</p>
{/block}
