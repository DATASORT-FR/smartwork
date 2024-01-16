{if $Menu_style == 'main'}
	<nav id="topNav" class="navbar navbar-expand-lg {$Menu_classAdd}">
		<div class="container-fluid">
			{if $Menu_back==true}
				<a class="nav-link mnu_backward" title="" href="{$Menu_homepage}">
					<span class="fa fa-arrow-left"></span>
				</a>
			{/if}
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active mnu_home" aria-current="page" title="" href="{$Menu_apppage}">{#menu_home_text#}</a>
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
									<a id="dropdownMenuLink_{$index}" class="nav-link dropdown-toggle {$Menu_class[idx][0]}" role="button" title="{$Menu_title[idx][0]}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
										{if $Menu_icon[idx][0]!=''}
											<i class="{$Menu_icon[idx][0]}"></i>												
										{/if}
										{if $Menu_iconOnly[idx][0]==0}
											{$Menu_text[idx][0]}
										{/if}
									</a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink_{$index}">
										{$display=false} 
										{section name=idy loop=$Menu_text[idx]}
											{if $display==true }
												{if $Menu_text[idx][idy]=='divider' }
													<li class="menu_{$displayidx}_{$smarty.section.idy.index} {$Menu_class[idx][idy]}">
														{if $Menu_icon[idx][idy]!=''}
															<i class="{$Menu_icon[idx][idy]}"></i>												
														{/if}
														<hr class="dropdown-divider">
													</li>
												{else}
													<li class="menu_{$displayidx}_{$smarty.section.idy.index} {$Menu_class[idx][idy]}">
														{if $Menu_page[idx][idy]==1}
															{if $Menu_ref[idx][idy]==''}
																<a class="dropdown-item mnu_linkno" title="{$Menu_title[idx][idy]}" href="#" event="">
																	{if $Menu_icon[idx][idy]!=''}
																		<i class="{$Menu_icon[idx][idy]}"></i>												
																	{/if}
																	{if $Menu_iconOnly[idx][idy]==0}
																		{$Menu_text[idx][idy]}
																	{/if}
																</a>
															{else}
																<a class="dropdown-item mnu_linkline" title="{$Menu_title[idx][idy]}" href="#" event="{$Menu_ref[idx][idy]}">
																	{if $Menu_icon[idx][idy]!=''}
																		<i class="{$Menu_icon[idx][idy]}"></i>												
																	{/if}
																	{if $Menu_iconOnly[idx][idy]==0}
																		{$Menu_text[idx][idy]}
																	{/if}
																</a>
															{/if}
														{else}
															<a class="dropdown-item" title="{$Menu_title[idx][idy]}" href="{$Menu_ref[idx][idy]}">
																{if $Menu_icon[idx][idy]!=''}
																	<i class="{$Menu_icon[idx][idy]}"></i>												
																{/if}
																{if $Menu_iconOnly[idx][idy]==0}
																	{$Menu_text[idx][idy]}
																{/if}
															</a>
														{/if}
													</li>
												{/if}
											{/if}
											{$display=true} 
										{/section}
									</ul>	
								</li>
							{else}
								<li class="nav-item"> 
									{if $Menu_page[idx][0]==1}
										{if $Menu_ref[idx][0]==''}
											<a class="nav-link mnu_linkno {$Menu_class[idx][0]}" title="{$Menu_title[idx][0]}" href="#" event="">
												{if $Menu_icon[idx][0]!=''}
													<i class="{$Menu_icon[idx][0]}"></i>												
												{/if}
												{if $Menu_iconOnly[idx][0]==0}
													{$Menu_text[idx][0]}
												{/if}
											</a>
										{else}
											<a class="nav-link mnu_linkline {$Menu_class[idx][0]}" title="{$Menu_title[idx][0]}" href="#" event="{$Menu_ref[idx][0]}">
												{if $Menu_icon[idx][0]!=''}
													<i class="{$Menu_icon[idx][0]}"></i>												
												{/if}
												{if $Menu_iconOnly[idx][0]==0}
													{$Menu_text[idx][0]}
												{/if}
											</a>
										{/if}
									{else}
										<a class="nav-link {$Menu_class[idx][0]}" title="{$Menu_title[idx][0]}" href="{$Menu_ref[idx][0]}">
											{if $Menu_icon[idx][0]!=''}
												<i class="{$Menu_icon[idx][0]}"></i>												
											{/if}
											{if $Menu_iconOnly[idx][0]==0}
												{$Menu_text[idx][0]}
											{/if}
										</a>
									{/if}
								</li>
							{/if}
						{/if}
					{/section}	
				</ul>
			</div>
		</div>
	</nav>
{elseif $Menu_style == 'simple'}
	{section name=idx loop=$Menu_text}
		<a class="nav-link {$Menu_class[idx][0]}" title="{$Menu_title[idx][0]}" href="{$Menu_ref[idx][0]}">{$Menu_text[idx][0]}</a>
	{/section}
{else}
				<ul class="navbar-nav me-auto mb-lg-0">
					{$index = 0}
					{section name=idx loop=$Menu_text}
						{$index = $index + 1}
						{$displayidx=$smarty.section.idx.index + 1} 
						{if $Menu_text[idx][0]=='divider' }
							<li class="nav-item divider-vertical"></li>
						{else}
							{if isset($Menu_text[idx][1])}
								<li class="nav-item dropdown"> 
									<a id="dropdownMenuLink_{$index}" class="nav-link dropdown-toggle {$Menu_class[idx][0]}" role="button" title="{$Menu_title[idx][0]}" href="#" data-bs-toggle="dropdown" aria-expanded="false">
										{if $Menu_icon[idx][0]!=''}
											<i class="{$Menu_icon[idx][0]}"></i>												
										{/if}
										{if $Menu_iconOnly[idx][0]==0}
											{$Menu_text[idx][0]}
										{/if}
									</a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink_{$index}">
										{$display=false} 
										{section name=idy loop=$Menu_text[idx]}
											{if $display==true }
												{if $Menu_text[idx][idy]=='divider' }
													<li class="menu_{$displayidx}_{$smarty.section.idy.index} {$Menu_class[idx][idy]}">
														{if $Menu_icon[idx][idy]!=''}
															<i class="{$Menu_icon[idx][idy]}"></i>												
														{/if}
														<hr class="dropdown-divider">
													</li>
												{else}
													<li class="menu_{$displayidx}_{$smarty.section.idy.index} {$Menu_class[idx][idy]}">
														{if $Menu_page[idx][idy]==1}
															{if $Menu_ref[idx][idy]==''}
																<a class="dropdown-item mnu_linkno" title="{$Menu_title[idx][idy]}" href="#" event="">
																	{if $Menu_icon[idx][idy]!=''}
																		<i class="{$Menu_icon[idx][idy]}"></i>												
																	{/if}
																	{if $Menu_iconOnly[idx][idy]==0}
																		{$Menu_text[idx][idy]}
																	{/if}
																</a>
															{else}
																<a class="dropdown-item mnu_linkline" title="{$Menu_title[idx][idy]}" href="#" event="{$Menu_ref[idx][idy]}">
																	{if $Menu_icon[idx][idy]!=''}
																		<i class="{$Menu_icon[idx][idy]}"></i>												
																	{/if}
																	{if $Menu_iconOnly[idx][idy]==0}
																		{$Menu_text[idx][idy]}
																	{/if}
																</a>
															{/if}
														{else}
															<a class="dropdown-item" title="{$Menu_title[idx][idy]}" href="{$Menu_ref[idx][idy]}">
																{if $Menu_icon[idx][idy]!=''}
																	<i class="{$Menu_icon[idx][idy]}"></i>												
																{/if}
																{if $Menu_iconOnly[idx][idy]==0}
																	{$Menu_text[idx][idy]}
																{/if}
															</a>
														{/if}
													</li>
												{/if}
											{/if}
											{$display=true} 
										{/section}
									</ul>	
								</li>
							{else}
								<li class="nav-item"> 
									{if $Menu_page[idx][0]==1}
										{if $Menu_ref[idx][0]==''}
											<a class="nav-link mnu_linkno {$Menu_class[idx][0]}" title="{$Menu_title[idx][0]}" href="#" event="">
												{if $Menu_icon[idx][0]!=''}
													<i class="{$Menu_icon[idx][0]}"></i>												
												{/if}
												{if $Menu_iconOnly[idx][0]==0}
													{$Menu_text[idx][0]}
												{/if}
											</a>
										{else}
											<a class="nav-link mnu_linkline {$Menu_class[idx][0]}" title="{$Menu_title[idx][0]}" href="#" event="{$Menu_ref[idx][0]}">
												{if $Menu_icon[idx][0]!=''}
													<i class="{$Menu_icon[idx][0]}"></i>												
												{/if}
												{if $Menu_iconOnly[idx][0]==0}
													{$Menu_text[idx][0]}
												{/if}
											</a>
										{/if}
									{else}
										<a class="nav-link {$Menu_class[idx][0]}" title="{$Menu_title[idx][0]}" href="{$Menu_ref[idx][0]}">
											{if $Menu_icon[idx][0]!=''}
												<i class="{$Menu_icon[idx][0]}"></i>												
											{/if}
											{if $Menu_iconOnly[idx][0]==0}
												{$Menu_text[idx][0]}
											{/if}
										</a>
									{/if}
								</li>
							{/if}
						{/if}
					{/section}	
				</ul>
{/if}
