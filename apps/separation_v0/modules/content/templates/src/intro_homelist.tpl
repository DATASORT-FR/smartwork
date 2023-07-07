<div class="item">
    <div class="news-preview">
        <figure class="np-thumbnail">
			<a class="decoration-none" href="{$Content_link|default:''}" title="{$Content_titlePage|default:''}">
				<img alt="{$Content_imageAlt|default:''}" src="{$Content_image|default:''}" onerror="this.src='./images/separation/image-non-trouvee.webp';" title="{$Content_imageTitle|default:''}">
			</a>
            <div class="post-date">
				<h3>{$Content_day|default:''}</h3>
				<p>{$Content_month|default:''}</p>
            </div>
        </figure>
        <div class="np-caption box-shadow">
            <p class="categorie">{$Content_code}</p>
            <h4>
				<a class="decoration-none" href="{$Content_link|default:''}" title="{$Content_titlePage|default:''}" itemprop="title">{$Content_title}</a>
			</h4>
            <p>{$Content_intro}</p>
        </div>
    </div>
</div>
 