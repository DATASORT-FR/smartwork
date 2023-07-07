<table class="forum-list forum-list-topic table table-borderless table-striped table-hover text-left">
	<tbody>
	{section name=idx loop=$listTopic}
		<tr class="forum-topic">
			<td class="forum-topic" scope="row" date-label="{#Txt_forum_subject#}" width="60%">
				<a href="{$listTopic[idx].href}">
					</div>
					<div class="forum-resume">
						<div class="forum-topic-label">
							<h3>{$listTopic[idx].label}</h3>
						</div>
						{if $flagAdmin}
							<div class="forum-topic-status">{$listTopic[idx].status}</div>
						{/if}
						<div class="forum-topic-author">Par {$listTopic[idx].author}<span class="forum-topic-author2"> » {$listTopic[idx].date_creation_time}</span></div>
					</div>
				</a>
			</td>
			<td class="forum-topic-post" width="40%">
				<a href="{$listTopic[idx].href}">
					<div class="forum-resume forum-topic-nb">
						<figure class="post-image">
							{if $listTopic[idx].read}
								<img src="./images/separation/forum/bulle-filet-gris.svg" alt="" title="">
							{else}
								<img src="./images/separation/forum/bulle-filet-bleu.svg" alt="" title="">
							{/if}
						</figure>
							{if $listTopic[idx].read}
								<div class="forum-topic-nb-text read">
							{else}
								<div class="forum-topic-nb-text no-read">
							{/if}
								<p class="forum-topic-post-nb">{$listTopic[idx].nb_post}</p>
								<p class="forum-topic-post-message">{#Txt_forum_nbpost#}</p>
						</div>
					</div>
					<div class="forum-resume">
						{if $listTopic[idx].author_last_post != ''}
							<div class="forum-topic-lastpost">Par {$listTopic[idx].author_last_post}</div>
						{/if}
						{if $listTopic[idx].date_last_post_time != ''}
							<div class="forum-topic-lastpost">{$listTopic[idx].date_last_post_time}</div>
						{/if}
					</div>
				</a>
			</td>
		</tr>
	{/section}
	</tbody>
</table>
<div class="forum-btn-topic">
	<div>
		<div>Vous ne trouvez pas le sujet</div>
		<div>qui vous intéresse ?</div>
		<button type="button" class="btn btn-primary bt-forum-proc-page bt-forum" data-loadingtext="{#Txt_loading#}" event="{$topic_linkCreate}">
			{#Txt_forum_topic_create#}
		</button>
	</div>
</div>
