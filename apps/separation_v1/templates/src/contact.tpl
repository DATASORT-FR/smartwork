{extends file="standard.tpl"}

{block name=Main}
   <section>
		<div class="container mt-5">
			{$contentBlock|default:''}
		</div>
		<div class="container mb-5">
			<div id="content-form" class="contact-block main-zone">
				<form id="contact-form" class="form-contact" method="POST">
					<div class="form-row message msg-error display-none">
						{#Txt_contact_error#}
					</div>	
					<div class="form-row">
						<label for="name" class="form-label">{#Lbl_contact_name#}</label>					
						<input type="text" class="contact_name form-input" name="name" size="50" maxlength="50" value="">
						<div class="message msg-name display-none">
							{#Txt_control_name#}
						</div>	
					</div>
					<div class="form-row">
						<label for="email" class="form-label">{#Lbl_contact_email#}</label>					
						<input type="text" class="contact_email form-input" name="email" size="50" maxlength="50" value="">
						<div class="message msg-email display-none">
							{#Txt_control_email#}
						</div>	
					</div>
					<div class="form-row">
						<label for="phone" class="form-label">{#Lbl_contact_phone#}</label>					
						<input type="text" class="contact_phone form-input" name="phone" size="10" maxlength="10" value="">
						<div class="message msg-phone display-none">
							{#Txt_control_phone#}
						</div>	
					</div>

					<div class="form-row">
						<label for="message" class="form-label">{#Lbl_contact_message#}</label>					
						<textarea class="contact_message form-input" name="message" rows="8" cols="120"></textarea>
						<div class="message msg-message display-none">
							{#Txt_control_message#}
						</div>	
					</div>

					<div class="form-row">
						<div class="link-btn contact_button center" event="{$ContactAction|default:''}">
							{#Bt_contact_valider#}
						</div>
					</div>
				</form>
				<div class="validation display-none">
					<h2>{#Title_contact_validation#}</h2>
					</br>
					<div class="form-row msg-validation">
						{#Msg_contact_validation#}
					</div>
				</div>
			</div>
		</div>
    </section>
{/block}
