{if $Menu_style == 'main'}
    <nav id="topNav" class="navbar navbar-full m-b-1 {$Menu_class}" >
        <button class="navbar-toggler hidden-md-up pull-right" type="button" data-bs-toggle="collapse" data-target="#navbar">
            &#9776;
        </button>
		{if $Menu_back==true}
			<a class="navbar-brand nav-link mnu_backward" href="{$Menu_homepage}">
				<span class="fa fa-arrow-left"></span>
			</a>
		{/if}
		<a class="navbar-brand nav-link hidden-sm-down mnu_home" href="{$Menu_apppage}">{#menu_home_text#}</a>
        <div id="navbar" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">	
				<li class="nav-item hidden-md-up"> 
					<a class="nav-link" href="{$Menu_apppage}">{#menu_home_text#}</a>
				</li>
				{$index = 0}
				{section name=idx loop=$Menu_text}
					{$index = $index + 1}
					{$displayidx=$smarty.section.idx.index + 1} 
					{if $Menu_text[idx][0]=='divider' }
						<li class="nav-item divider-vertical"></li>
					{else}
						{if isset($Menu_text[idx][1])}
							<li class="nav-item dropdown"> 
								<a id="dropdownMenuLink_{$index}" class="nav-link dropdown-toggle" href="{$Menu_ref[idx][0]}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{$Menu_text[idx][0]}</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink_{$index}">
									{$display=false} 
									{section name=idy loop=$Menu_text[idx]}
										{if $display==true }
											{if $Menu_text[idx][idy]=='divider' }
												<a class="dropdown-item menu_{$displayidx}_{$smarty.section.idy.index}" href="#"></a>
											{else}
												{if $Menu_page[idx][idy]==1}
													{if $Menu_ref[idx][idy]==''}
														<a class="dropdown-item menu_{$displayidx}_{$smarty.section.idy.index} mnu_linkno" href="#" event="">{$Menu_text[idx][idy]}</a>
													{else}
														<a class="dropdown-item menu_{$displayidx}_{$smarty.section.idy.index} mnu_linkline" href="#" event="{$Menu_ref[idx][idy]}">{$Menu_text[idx][idy]}</a>
													{/if}
												{else}
													<a class="dropdown-item menu_{$displayidx}_{$smarty.section.idy.index}" href="{$Menu_ref[idx][idy]}">{$Menu_text[idx][idy]}</a>
												{/if}
											{/if}
										{/if}
										{$display=true} 
									{/section}
								</div>	
							</li>
						{else}
							<li class="nav-item"> 
								{if $Menu_page[idx][0]==1}
									{if $Menu_ref[idx][0]==''}
										<a class="nav-link mnu_linkno" href="#" event="">{$Menu_text[idx][0]}</a>
									{else}
										<a class="nav-link mnu_linkline" href="#" event="{$Menu_ref[idx][0]}">{$Menu_text[idx][0]}</a>
									{/if}
								{else}
									<a class="nav-link" href="{$Menu_ref[idx][0]}">{$Menu_text[idx][0]}</a>
								{/if}
							</li>
						{/if}
					{/if}
				{/section}	
            </ul>

        </div>
    </nav>
{elseif $Menu_style == 'simple'}
	{section name=idx loop=$Menu_text}
		<a class="nav-link" href="{$Menu_ref[idx][0]}">{$Menu_text[idx][0]}</a>
	{/section}
{else}
	<nav id="topNav" class="navbar navbar-full m-b-1">
		<button class="navbar-toggler hidden-sm-up" type="button" data-bs-toggle="collapse" data-target="#nav-content">&#9776;</button>
		{if $Menu_back==true}
			<a class="nav-link mnu_backward" href="{$Menu_homepage}"></a>
		{/if}
		<a class="nav-link mnu_home" href="{$Menu_apppage}">{#menu_home_text#}</a>
		<div class="collapse  navbar-toggleable-sm" id="nav-content">   
			<ul class="nav navbar-nav">

				{section name=idx loop=$Menu_text}
					{$displayidx=$smarty.section.idx.index + 1} 
					{if $Menu_text[idx][0]=='divider' }
						<li class="nav-item divider-vertical"></li>
					{else}
						<li class="nav-item dropdown"> 
							{if isset($Menu_text[idx][1])}
								<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="{$Menu_ref[idx][0]}">{$Menu_text[idx][0]}<b class="caret"></b></a>
								<div class="dropdown-menu">
									{$display=false} 
									{section name=idy loop=$Menu_text[idx]}
										{if $display==true }
											{if $Menu_text[idx][idy]=='divider' }
												<a class="dropdown-item menu_{$displayidx}_{$smarty.section.idy.index}" href="#"></a>
											{else}
												{if $Menu_page[idx][idy]==1}
													{if $Menu_ref[idx][idy]==''}
														<a class="dropdown-item menu_{$displayidx}_{$smarty.section.idy.index} mnu_linkno" href="#" event="">{$Menu_text[idx][idy]}</a>
													{else}
														<a class="dropdown-item menu_{$displayidx}_{$smarty.section.idy.index} mnu_linkline" href="#" event="{$Menu_ref[idx][idy]}">{$Menu_text[idx][idy]}</a>
													{/if}
												{else}
													<a class="dropdown-item menu_{$displayidx}_{$smarty.section.idy.index}" href="{$Menu_ref[idx][idy]}">{$Menu_text[idx][idy]}</a>
												{/if}
											{/if}
										{/if}
										{$display=true} 
									{/section}
								</div>	
							{else}
								{if $Menu_page[idx][0]==1}
									{if $Menu_ref[idx][0]==''}
										<a class="nav-link mnu_linkno" href="#" event="">{$Menu_text[idx][0]}</a>
									{else}
										<a class="nav-link mnu_linkline" href="#" event="{$Menu_ref[idx][0]}">{$Menu_text[idx][0]}</a>
									{/if}
								{else}
									<a class="nav-link" href="{$Menu_ref[idx][0]}">{$Menu_text[idx][0]}</a>
								{/if}
							{/if}
						</li>
					{/if}
				{/section}
			</ul>
		</div>
	</nav>
{/if}
