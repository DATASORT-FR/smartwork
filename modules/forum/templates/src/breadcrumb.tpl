<div class="forum-breadcrumb">
	<a href="{$homeLink}">
		{$homeTitle}
	</a>
	{if $subjectTitle != ''}
		<span>></span>
		<a href="{$subjectLink}">
			{$subjectTitle}
		</a>
		{if $topicTitle != ''}
			<span>></span>
			<a href="{$topicLink}">
				{$topicTitle}
			</a>
		{/if}
	{/if}
</div>
