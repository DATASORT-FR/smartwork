<ul class="thumbnails list-inline">
	{section name=idx loop=$listFile}
		{if $listFile[idx].type=='dir'}
			<li class="thumbnail-dir list-inline-item center" title="{$listFile[idx].name}">
				<div class="height-60">
					<span class="fa fa-folder fa-3x"></span>
				</div>
				<div class="small">{$listFile[idx].label}</div>
			</li>
		{elseif $listFile[idx].type=='image'}
			<li class="thumbnail-image list-inline-item center {$listFile[idx].class}" title="{$listFile[idx].name}">
				<div class="height-60">
					<img src="{$listFile[idx].file}" alt="{$listFile[idx].name}" class="img_preview" width="60" height="60">
				</div>
				<div class="small">{$listFile[idx].label}</div>
			</li>
		{elseif $listFile[idx].type=='file'}
			<li class="thumbnail-image list-inline-item center" title="{$listFile[idx].name}">
				<div class="height-60">
					<span class="far fa-file fa-3x"></span>
				</div>
				<div class="small">{$listFile[idx].label}</div>
			</li>
		{/if}
	{/section}
</ul>
