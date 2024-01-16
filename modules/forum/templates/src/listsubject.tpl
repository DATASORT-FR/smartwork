{if $btCreate|default:false}
	<div class="forum-btn">
		<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$subject_linkCreate}">
			<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_forum_subject_create#}
		</button>
	</div>
{/if}
<div class="table-responsive-sm">
	{$subjectCategory = ''}
	{section name=idx loop=$listSubject}
		{if $listSubject[idx].category_name != $subjectCategory}
			{if $subjectCategory != ''}
					</tbody>
					<tfoot class="">
					</tfoot>		
				</table>
			{/if}
			{$subjectCategory = $listSubject[idx].category_name}
			<table class="forum-list forum-list-subject table table-borderless table-striped table-hover text-start">
				{if $flagCaption}
					<caption><h2>{$subjectCategory}</h2></caption>
				{/if}
				{if $flagHeader}
					<thead class="">
						<tr>
							<th class="forum-subject" scope="col" width="50%">{#Txt_forum_subject#}</th>
							<th class="forum-subject-nb" scope="col" width="15%">{#Txt_forum_nb#}</th>
							<th class="forum-subject-date" scope="col" width="20%">{#Txt_forum_date#}</th>
						</tr>
					</thead>
				{/if}
				<tbody>
		{/if}
		<tr>
			<td class="forum-subject" scope="row" date-label="{#Txt_forum_subject#}" width="60%">
				<a href="{$listSubject[idx].href}">
					<div class="forum-resume vignette">
						{if $listSubject[idx].vignette != ''}
							<figure class="">
								<img class="rotating" src="{$listSubject[idx].vignette}" alt="{$listSubject[idx].vignette_alt}" title="{$listSubject[idx].vignette_title}">
							</figure>
						{/if}
					</div>
					<div class="forum-resume">
						<div class="forum-subject-name"><h3>{$listSubject[idx].name}</h3></div>
						<div class="forum-subject-label">{$listSubject[idx].label}</div>
					</div>
				</a>
			</td>
			<td class="forum-subject-nb" scope="row" date-label="{#Txt_forum_nb#}" width="15%">
				<a href="{$listSubject[idx].href}">
					<div class="forum-resume">
						{if $flagAdmin}
							<div class="forum-subject-status">{$listSubject[idx].status}</div>
						{/if}
						<div class="forum-subject-date-creation">{#Txt_forum_date_creation#}: {$listSubject[idx].date_creation_time}</div>
						<div class="forum-subject-nbtopic">{#Txt_forum_nbtopic#}: {$listSubject[idx].nb_topic}</div>
						<div class="forum-subject-nbpost">{#Txt_forum_nbpost#}: {$listSubject[idx].nb_post}</div>
					</div>
				</a>
			</td>
			<td class="forum-subject-date" scope="row" date-label="{#Txt_forum_date#}" width="20%">
				<a href="{$listSubject[idx].href}">
					<div class="forum-resume">
						<div class="forum-subject-post-author">{$listSubject[idx].author_last_post}</div>
						<div class="forum-subject-date-update">{$listSubject[idx].date_last_post}</div>
					</div>
				</a>
			</td>
		</tr>
	{/section}
	{if $subjectCategory != ''}
			</tbody>
			<tfoot class="">
			</tfoot>		
		</table>
	{/if}
</div>
