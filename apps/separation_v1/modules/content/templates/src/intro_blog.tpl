<div class="col-md-6 col-lg-4">
	<div class="news-preview">
        <figure class="np-thumbnail">
            <a class="decoration-none" href="{$Content_link|default:''}">
				<img alt="{$Content_imageAlt}" src="{$Content_image}" onerror="this.src='./images/separation/image-non-trouvee.webp';" title="{$Content_imageTitle|default:''}">
			</a>
            <div class="post-date">
				<h3>{$Content_day|default:''}</h3>
				<p>{$Content_month|default:''}</p>
            </div>
        </figure>
        <div class="np-caption box-shadow">
            <p class="categorie">{$Content_code|default:''}</p>
            <h2><a class="decoration-none" href="{$Content_link|default:''}" title="{$Content_titlePage}" itemprop="title">{$Content_title}</a></h2>
            {$Content_intro|default:''}
        </div>
    </div>
</div>
 