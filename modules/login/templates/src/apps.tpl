<?php 
/**
* Login module : login box template
*
* @package    module_login
* @subpackage view
* @version    1.0
* @date       15 September 2013
* @author     Alain VANDEPUTTE
* @copyright  datasort.fr
*/
?>
{section name=idx loop=$app_array}
	<div class="card block-apps block"  onclick="location.href='{$app_array[idx]['href']}';"> 
		<header class="card-header header-apps page-header">
			{$app_array[idx]['label']} {$app_array[idx]['version']}
		</header>
		<div class="card-title">
				{$app_array[idx]['app']}
		</div>
		<div class="card-body body-apps page-body">
			<div class="card-title image">
				<img src="{$app_array[idx]['image']}" alt="{$app_array[idx]['description']}" />
			</div>
			<div class="card-text description">
				{$app_array[idx]['description']}
			</div>
		</div>
	</div>
{/section}
