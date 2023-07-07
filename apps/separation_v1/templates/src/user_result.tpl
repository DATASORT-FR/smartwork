<?php 
/**
* This file contains template for user result (diagnostic, procedure and dossier)
*
* @package    use_user
* @subpackage view
* @version    1.0
* @date       18 August 2022
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>


{block name=Main}
	<div id="user_result_box" class="box-header block-adm block-user_result" title="{#Title_user_result#} {$userCode}" box-id="user_result" box-model="box-model">

		<ul id="user_result_maintab" class="nav nav-tabs">
			<li class="nav-item">
				<a id="user_result_maintab_1" class="nav-link active" data-bs-toggle="tab" href="#user_result_tab_diagnostic">Diagnostic</a>
			</li>
			<li class="nav-item">
				<a id="user_result_maintab_2" class="nav-link" data-bs-toggle="tab" href="#user_result_tab_procedure">Procédure</a>
			</li>
			<li class="nav-item">
				<a id="user_result_maintab_3" class="nav-link" data-bs-toggle="tab" href="#user_result_tab_dossier">Dossier</a>
			</li>
		</ul>
		<div id="user_result_tabs" class="tab-content">
			<div id="user_result_tab_diagnostic" class="tab-pane active">
				<div class="diagnostic-visu">
					<div class="main-content">
						{$diagnostic}
					</div>
				</div>	
			</div>
			<div id="user_result_tab_procedure" class="tab-pane">
				<div class="procedure-visu">
					<div class="main-content">
						{$procedure}
					</div>
				</div>	
			</div>
			<div id="user_result_tab_dossier" class="tab-pane">
				<div class="dossier-visu">
					<div class="main-content">
						{$dossier}
					</div>
					<div class="button">
						<a class="link-btn dossier-download-link" href="{$downloadDossier}" target="_blank">
							<img src="./images/separation/btn_telecharger.svg" title="Télécharger le dossier">
							Télécharger le dossier
						</a>
					</div>
				</div>	
			</div>
		</div>
		


		
	</div>
{/block}
