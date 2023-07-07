{if $displayFlag}
	<div class="social_list">
		{if $facebookFlag}
			{if $squareFlag}
				<a href="{$facebookLink}" title="{#Txt_facebook_follow#}" class="link_facebook square" target="_blank">
					<span class="fa fa-facebook-square fa-2x"></span>
				</a>
			{else}
				<a href="{$facebookLink}" title="{#Txt_facebook_follow#}" class="btn link_facebook no_square" target="_blank">
					<span class="fa fa-facebook"></span>
					{#Txt_facebook_name#}
				</a>
			{/if}
		{/if}
		
		{if $twitterFlag}
			{if $squareFlag}
				<a href="{$twitterLink}" title="{#Txt_twitter_follow#}" class="link_twitter square" target="_blank">
					<span class="fa fa-twitter-square fa-2x"></span>
				</a>
			{else}
				<a href="{$twitterLink}" title="{#Txt_twitter_follow#}" class="btn link_twitter no_square" target="_blank">
					<span class="fa fa-twitter"></span>
					{#Txt_twitter_name#}
				</a>
			{/if}
		{/if}
		
		{if $googleFlag}
			{if $squareFlag}
				<a href="{$googleLink}" title="{#Txt_google_follow#}" class="link_google square" target="_blank">
					<span class="fa fa-google-plus-square fa-2x"></span>
				</a>
			{else}
				<a href="{$googleLink}" title="{#Txt_google_follow#}" class="btn link_google no_square" target="_blank">
					<span class="fa fa-google-plus"></span>
					{#Txt_google_name#}
				</a>
			{/if}
		{/if}
				
		{if $pinterestFlag}
			{if $squareFlag}
				<a href="{$pinterestLink}" title="{#Txt_pinterest_follow#}" class="link_pinterest square" target="_blank">
					<span class="fa fa-pinterest-square fa-2x"></span>
				</a>
			{else}
				<a href="{$pinterestLink}" title="{#Txt_pinterest_follow#}" class="btn link_pinterest no_square" target="_blank">
					<span class="fa fa-pinterest"></span>
					{#Txt_pinterest_name#}
				</a>
			{/if}
		{/if}
		
		{if $linkedinFlag}
			{if $squareFlag}
				<a href="{$linkedinLink}" title="{#Txt_linkedin_follow#}" class="link_linkedin square" target="_blank">
					<span class="fa fa-linkedin-square fa-2x"></span>
				</a>
			{else}
				<a href="{$linkedinLink}" title="{#Txt_linkedin_follow#}" class="btn link_linkedin no_square" target="_blank">
					<span class="fa fa-linkedin"></span>
					{#Txt_linkedin_name#}
				</a>
			{/if}
		{/if}
		
		
		{if $youtubeFlag}
			{if $squareFlag}
				<a href="{$youtubeLink}" title="{#Txt_youtube_follow#}" class="link_youtube square" target="_blank">
					<span class="fa fa-youtube-square fa-2x"></span>
				</a>
			{else}
				<a href="{$youtubeLink}" title="{#Txt_youtube_follow#}" class="btn link_youtube no_square" target="_blank">
					<span class="fa fa-youtube"></span>
					{#Txt_youtube_name#}
				</a>
			{/if}
		{/if}
		
		
		{if $feedburnerFlag}
			{if $squareFlag}
				<a href="{$feedburnerLink}" title="{#Txt_feedburner_follow#}" class="link_feedburner square" target="_blank">
					<span class="fa fa-feedburner-square fa-2x"></span>
				</a>
			{else}
				<a href="{$feedburnerLink}" title="{#Txt_feedburner_follow#}" class="btn link_feedburner no_square" target="_blank">
					<span class="fa fa-feedburner"></span>
					{#Txt_feedburner_name#}
				</a>
			{/if}
		{/if}
		
	</div>
{/if}
