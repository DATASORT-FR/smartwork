<h3 class="subject-header">
	Les thèmes du forum
</h3>
{if $btCreate|default:false}
	<div class="forum-btn">
		<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="{#Txt_loading#}" event="{$subject_linkCreate}">
			<span class="fa fa-edit" width="16" height="16"></span>  {#Txt_forum_subject_create#}
		</button>
	</div>
{/if}
<table class="forum-list forum-list-subject table table-borderless table-striped table-hover text-left">
	<tbody>
	{section name=idx loop=$listSubject}
		<tr class="forum-subject">
			<td class="forum-subject" width="80%">
				<a href="{$listSubject[idx].href}">
					<div class="forum-resume">
						<div class="forum-subject-name">
							<h3>{$listSubject[idx].name}</h3>
							{if $flagAdmin}
								<div class="forum-subject-status">{$listSubject[idx].status}</div>
							{/if}
						</div>
						<div class="forum-subject-label">{$listSubject[idx].label}</div>
					</div>
				</a>
			</td>
			<td class="forum-subject-topic" width="20%">
				<a href="{$listSubject[idx].href}">
					<div class="forum-resume">
						<figure class="topic-image">
							<img src="./images/separation/forum/bulles-filet-bleu.svg" alt="" title="">
						</figure>
						<p class="forum-subject-topic-nb">{$listSubject[idx].nb_topic}</p>
						<p class="forum-subject-topic-message">{#Txt_forum_nbtopic#}</p>
					</div>
				</a>
			</td>
		</tr>
	{/section}
	</tbody>
</table>
