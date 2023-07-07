	{if $item.video != '' and $type != 'image'}
		{if $item.videoType == 'youtube'}
			<div class="div-youtube">
				<iframe class="video-player" alt="{$item.videoAlt}" src="{$item.video}?autoplay=1" onerror="this.src = '';" title="{$item.videoTitle}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
				</iframe>
			</div>
		{else}
			<div class="div-video">
				<video class="video-player" poster="{$item.image}" controls autoplay>
					<source src="{$item.video}" type="video/mp4" />
					Your browser does not support the video tag.
				</video>
			</div>
		{/if}
	{else}
		{if $item.image != ''}
			<div class="div-img">
				<img class="img-player" alt="{$item.imageAlt}" src="{$item.image}" onerror="this.src = '';" title="{$item.imageTitle}" style="max-width:{$item.imageWidth}">
			</div>
		{/if}
	{/if}
