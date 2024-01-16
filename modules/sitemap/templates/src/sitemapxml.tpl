{strip}
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	{section name=idx loop=$Sitemap}
		<url>
			<loc>{$Sitemap[idx].loc}</loc>
			{if $Sitemap[idx].lastmod != ''}
				<lastmod>{$Sitemap[idx].lastmod}</lastmod>
			{/if}
			{if $Sitemap[idx].changefreq != ''}
				<changefreq>{$Sitemap[idx].changefreq}</changefreq>
			{/if}
			{if $Sitemap[idx].priority != ''}
				<priority>{$Sitemap[idx].priority}</priority>
			{/if}
		</url>
	{/section}	
</urlset>
{/strip}
