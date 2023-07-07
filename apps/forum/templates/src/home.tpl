{extends file="standard.tpl"}
{block name=Main}
    <section>
		<div class="container forum-content">
			<h1 class="header-image" itemprop="title">
				Forum
			</h1>
			{$breadCrumbBlock}
			<div class="forum">
				<h3 class="last-topic-header">
					Les dernières discussions
				</h3>
				{$lastBlock}
			</diV>
			{$subjectBlock}
		</div>
    </section>
{/block}

