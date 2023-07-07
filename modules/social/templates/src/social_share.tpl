{if $displayFlag}
	<ul class="social_share_list">
		{if $facebookFlag}
			{if $squareFlag}
				<li class="social_share_item link_facebook square">
					<a href="{$facebookLinkShare}" title="{#Txt_facebook_share#}" class="" target="_blank" rel="nofollow">
						<span class="fa fa-facebook-square fa-2x"></span>
					</a>
				</li>
			{else}
				<li class="social_share_item link_facebook no_square">
					<a href="{$facebookLinkShare}" title="{#Txt_facebook_share#}" class="btn" target="_blank" rel="nofollow">
						<span class="fa fa-facebook"></span>
						{#Txt_facebook_name#}
					</a>
				</li>
			{/if}
		{/if}
		{if $twitterFlag}
			{if $squareFlag}
				<li class="social_share_item link_twitter square"> 
					<a href="{$twitterLinkShare}" title="{#Txt_twitter_share#}" class="" target="_blank" rel="nofollow">
						<span class="fa fa-twitter-square fa-2x"></span>
					</a>
				</li>
			{else}
				<li class="social_share_item link_twitter no_square"> 
					<a href="{$twitterLinkShare}" title="{#Txt_twitter_share#}" class="btn" target="_blank" rel="nofollow">
						<span class="fa fa-twitter"></span>
						{#Txt_twitter_name#}
					</a>
				</li>
			{/if}
		{/if}
		{if $googleFlag}
			{if $squareFlag}
				<li class="social_share_item link_google square"> 
					<a href="{$googleLinkShare}" title="{#Txt_google_share#}" class="" target="_blank" rel="nofollow">
						<span class="fa fa-google-plus-square fa-2x"></span>
					</a>
				</li>
			{else}
				<li class="social_share_item link_google no_square"> 
					<a href="{$googleLinkShare}" title="{#Txt_google_share#}" class="btn" target="_blank" rel="nofollow">
						<span class="fa fa-google-plus"></span>
						{#Txt_google_name#}
					</a>
				</li>
			{/if}
		{/if}
		{if $linkedinFlag}
			{if $squareFlag}
				<li class="social_share_item link_linkedin square"> 
					<a href="{$linkedinLinkShare}" title="{#Txt_linkedin_share#}" class="" target="_blank" rel="nofollow">
						<span class="fa fa-linkedin-square fa-2x"></span>
					</a>
				</li>
			{else}
				<li class="social_share_item link_linkedin no_square"> 
					<a href="{$linkedinLinkShare}" title="{#Txt_linkedin_share#}" class="btn" target="_blank" rel="nofollow">
						<span class="fa fa-linkedin"></span>
						{#Txt_linkedin_name#}
					</a>
				</li>
			{/if}
		{/if}
	</ul>
{/if}
	