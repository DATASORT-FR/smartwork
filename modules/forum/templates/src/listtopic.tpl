{if $btCreate|default:false}
	<div class="forum-btn">
		<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$topic_linkCreate}">
			<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_forum_topic_create#}
		</button>
	</div>
{/if}
<div class="table-responsive-sm">
	<table class="forum-list forum-list-topic table table-borderless table-striped table-hover text-start">
		{if $flagHeader|default:false}
			<thead class="">
				<tr>
					<th class="forum-topic" scope="col" width="50%">{#Txt_forum_subject#}</th>
					<th class="forum-topic-date" scope="col" width="20%">{#Txt_forum_date#}</th>
					<th class="forum-topic-nb" scope="col" width="15%">{#Txt_forum_nb#}</th>
				</tr>
			</thead>
		{/if}
		<tbody>
		{section name=idx loop=$listTopic}
			<tr>
				<td class="forum-topic" scope="row" date-label="{#Txt_forum_subject#}" width="50%">
					<a href="{$listTopic[idx].href}">
						<div class="forum-resume vignette">
							{if $listTopic[idx].vignette != ''}
								<figure class="center-icon">
									<img class="rotating" src="{$listTopic[idx].vignette}" alt="{$listTopic[idx].vignette_alt}" title="{$listTopic[idx].vignette_title}">
								</figure>
							{/if}
						</div>
						<div class="forum-resume">
							<div class="forum-topic-label">{$listTopic[idx].label}</div>
						</div>
					</a>
				</td>
				<td class="forum-topic-topic" scope="row" date-label="{#Txt_forum_date#}" width="30%">
					<a href="{$listTopic[idx].href}">
						<div class="forum-resume">
							{if $flagAdmin}
								<div class="forum-topic-status">{$listTopic[idx].status}</div>
							{/if}
							<div class="forum-topic-author">{#Txt_forum_author#} : {$listTopic[idx].author}</div>
							<div class="forum-topic-date-creation">{#Txt_forum_date#} : {$listTopic[idx].date_creation_time}</div>
						</div>
					</a>
				</td>
				<td class="forum-topic-post" scope="row" date-label="{#Txt_forum_nb#}" width="20%">
					<a href="{$listTopic[idx].href}">
						<div class="forum-resume">
							<div class="forum-topic-nbpost">{#Txt_forum_nbpost#} : {$listTopic[idx].nb_post}</div>
							{if $listTopic[idx].author_last_post != ''}
								<div class="forum-topic-author">{#Txt_forum_author#} : {$listTopic[idx].author_last_post}</div>
							{/if}
							{if $listTopic[idx].date_last_post_time != ''}
								<div class="forum-topic-date-creation">{#Txt_forum_date#} : {$listTopic[idx].date_last_post_time}</div>
							{/if}
						</div>
					</a>
				</td>
			</tr>
		{/section}
		</tbody>
		<tfoot class="">
		</tfoot>		
	</table>
</div>
