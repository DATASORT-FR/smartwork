{block name=Main}

<script>
	$(document).ready(
		function() {
			init_form();
		}
	);
</script>

{if $titleflag}
	<header class="page-header">
		{if $titlecode != ''}
			<h1>{#Title_list#} {$titlecode}</h1>
		{else}
			<h1>{#Title_list#}</h1>
		{/if}
	</header>
{/if}

{if $displaysize==3}
	<div class="offset-xl-3 offset-lg-2 col-xl-6 col-lg-8 list-block">
{/if}
{if $displaysize==2}
	<div class="offset-xl-2 offset-lg-1 col-xl-8 col-lg-10 list-block">
{/if}
{if $displaysize==1}
	<div class="offset-xl-1 col-xl-10 col-lg-12 list-block">
{/if}
{if $displaysize==0}
	<div class="col-lg-12 list-block">
{/if}
	
	<div class="list-block-header">
		<div class="row param-container">
		
			{if $btheadernb == 0}
				<div class="col-lg-10">
			{elseif $btheadernb == 1}
				<div class="col-lg-8">
			{elseif $btheadernb == 2}
				<div class="col-lg-6">
			{/if}
				{if $searchflag}
					<div class="input-group search mb-2">
						<button class="btn btn-primary bt-search" event="{$btsearch.ref}" rel="nofollow"> 
							<span class="fa fa-{$btsearch.icon}" width="16" height="16" alt="{#Bt_list_search_txt#}" title="{#Bt_list_search_txt#}"></span>
						</button>
						<input type="text"   class="form-control txtsearch" value="{$search}" placeholder="{#Bt_list_search_txt#}">
						<input type="hidden" class="form-control txtfilter" value="{$filter}">
						<button class="btn btn-primary bt-clear" event="{$btsearch.ref}" rel="nofollow">
							<span class="fa fa-eraser" width="16" height="16"></span>
						</button>
						{if $filterflag}

							{literal}
							{/literal}
							<button class="btn btn-secondary bt_filter-toggle" data-bs-toggle="collapse" data-bs-target="#{$htmlid}_filter-container" aria-expanded="false">
								{#Bt_list_search_advanced#}
								<span class="fa fa-caret-down"></span>
							</button>
						{/if}					
					</div>
				{/if}
			</div>

			<div class="col-lg-2 dropdown-order "> 
				{if $ordercount > 0}
					<div class="input-group lc_listorder mb-2">
						<div class="dropdown">
							<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								{#Lbl_list_orderby#}
							</button>
							<ul class="dropdown-menu">
								{section name=idx loop=$ordercount}
									<li>
										<a class="dropdown-item lc_linkorder" event="{$btorder.ref}&order={$smarty.section.idx.index}" href="#" rel="nofollow">
											{if $order==$smarty.section.idx.index}
												<span class="fa fa-check" width="16" height="16"></span> 
											{else}
												<span class="fa fa-white" width="16" height="16"></span> 
											{/if}
											{if $smarty.section.idx.index==0}
												{#Lbl_list_orderby_0#}
											{/if}
											{if $smarty.section.idx.index==1}
												{#Lbl_list_orderby_1#}
											{/if}
											{if $smarty.section.idx.index==2}
												{#Lbl_list_orderby_2#}
											{/if}
											{if $smarty.section.idx.index==3}
												{#Lbl_list_orderby_3#}
											{/if}
											{if $smarty.section.idx.index==4}
												{#Lbl_list_orderby_4#}
											{/if}
											{if $smarty.section.idx.index==5}
												{#Lbl_list_orderby_5#}
											{/if}
											{if $smarty.section.idx.index==6}
												{#Lbl_list_orderby_6#}
											{/if}
											{if $smarty.section.idx.index==7}
												{#Lbl_list_orderby_7#}
											{/if}
											{if $smarty.section.idx.index==8}
												{#Lbl_list_orderby_8#}
											{/if}
											{if $smarty.section.idx.index==9}
												{#Lbl_list_orderby_9#}
											{/if}
										</a>
									</li>
								{/section}					
							</ul>
						</div>
					</div>
				{/if}
			</div>
			
			{if $btheadernb > 0}
				{if $btheadernb == 1}
					<div class="col-lg-2">
				{elseif $btheadernb == 2}
					<div class="col-lg-4">
				{/if}
					<div class="listbutton mb-2">
						{if $btnew.flag}
							{if $pageflag}
								<button type="button" class="btn btn-primary l_linknew" data-loadingtext="{#Txt_loading#}" event="{$btnew.ref}" rel="nofollow">
							{else}
								<button type="button" class="btn btn-primary lc_linknew" data-loadingtext="{#Txt_loading#}" event="{$btnew.ref}" rel="nofollow">
							{/if}
								{if $btnew.icon != ''}
									<span class="fa fa-{$btnew.icon}" width="16" height="16"></span> 
								{/if}
								{#Bt_list_new#}
							</button>
						{/if}
						{if $btlink.flag}
							{if $pageflag}
								<button type="button" class="btn btn-primary l_linknew" data-loadingtext="{#Txt_loading#}" event="{$btlink.ref}" rel="nofollow">
							{else}
								<button type="button" class="btn btn-primary lc_linknew" data-loadingtext="{#Txt_loading#}" event="{$btlink.ref}" rel="nofollow">
							{/if}
								{if $btlink.icon != ''}
									<span class="fa fa-{$btlink.icon}" width="16" height="16"></span> 
								{/if}
								{$btlink.text}
							</button>
						{/if}
					</div>
				</div>
			{/if}
		</div>
		
		<div id="{$htmlid}_filter-container" class="row filter-container collapse">
			<label class="group-label"></label>
			<div class="col-lg-9">

				{literal}
					<script>
						$(document).ready(
							function() {
						
								var filterTxt = '{/literal}{$filter}{literal}';
								var {/literal}{$htmlid}{literal}_showFlag = false;
								$(document).find(".{/literal}{$htmlid}{literal}_filter").each(
									function() {
										var atemp = filterTxt.split(',');
										var value = atemp[0];
										if ((atemp[0] != '') && (atemp[0] != '0')) {
											{/literal}{$htmlid}{literal}_showFlag = true;
										}
										filterTxt = '';
										for (i = 1; i < atemp.length; i++) {
											if (i > 1) {
												filterTxt = filterTxt + ',';
											}
											filterTxt = filterTxt + atemp[i];
										}
										$(this).val(value);
									}
								);
								if ({/literal}{$htmlid}{literal}_showFlag) {
									$("#{/literal}{$htmlid}{literal}_filter-container").collapse('show');
								}
								
								$(document).on("change", ".{/literal}{$htmlid}{literal}_filter",
									function(e) {
										e.preventDefault();
										if($(this).length) {
											$(this).parents(".list-block-header:first").find(".txtfilter:first").val('|');
											$(this).parents(".filter-container:first").find(".{/literal}{$htmlid}{literal}_filter").each(
												function() {
													var filterTxt = $(this).parents(".list-block-header:first").find(".txtfilter:first").val();
													if (filterTxt == '|') {
														filterTxt = '';
													}
													else {
														filterTxt = filterTxt + ',';
													}
													if (($(this).get(0).tagName.toLowerCase() == 'select') && ($(this).val() == null)) {
														filterTxt = filterTxt + '';
													}
													else {
														filterTxt = filterTxt + $(this).val();
													}
													$(this).parents(".list-block-header:first").find(".txtfilter:first").val(filterTxt);
												}
											);
										}
									}
								);
							
							}
						);
					</script>
				{/literal}
				
				{section name=idx loop=$filterview}
					<div class="row form-group">
						<label class="col-md-4 col-sm-5 form-label text-sm-end">{$filterview[idx].label}</label>					
						<div class="col-md-8 col-sm-7">
						{if $filterview[idx].type == 'list'}
							<select class="{$htmlid}_filter form-control form-select">
								{section name=idy loop=$filterview[idx].list}
									<option value="{$filterview[idx].list[idy].id}">{$filterview[idx].list[idy].description}</option>  
								{/section}
							</select>
						{else}
							<input class="{$htmlid}_filter form-control" type="text" value="">
						{/if}
						</div>
					</div>
				{/section}
			</div>
			<div class="col-lg-3">
				<div class="lc_listbutton mb-2">
					<button type="button" class="btn btn-primary bt-search" data-loadingtext="{#Txt_loading#}" event="{$btsearch.ref}" rel="nofollow">
						<span class="fa fa-search" width="16" height="16" alt="{#Bt_list_search#}" title="{#Bt_list_search#}"></span>
						{#Bt_list_search#}
					</button>
				</div>
			</div>	
		</div>
	</div>

	<div class="list-block-content">
		<div class="list-container">
				<table class="table table-responsive table-bordered table-striped table-sm text-start">

					{if $captionflag}
						<caption class="lc_list-header">
							<h4>{#txt_list_caption_count_begin#}{$count}{#txt_list_caption_count_end#}
								{if $search !=''}
									{#txt_list_caption_search_begin#}{$search}{#txt_list_caption_search_end#}
								{/if}
								{section name=idx loop=$filterview}
									{if $filterview[idx].display != '' and $filterview[idx].display != 0}
										{if $smarty.section.idx.index != 0 or $search !=''}
											,
										{/if}
										{if $filterview[idx].type == 'list'}
											{section name=idy loop=$filterview[idx].list}
												{if $filterview[idx].display == $filterview[idx].list[idy].id}
													{$filterview[idx].label}{$filterview[idx].list[idy].description}
												{/if}
											{/section}
										{else}
											{$filterview[idx].label}{$filterview[idx].display}
										{/if}
									{/if}
								{/section}
							</h4>
						</caption>
					{/if}

					<thead class="thead-default">
						<tr>
							{if $columnidflag}
								<th class="" width="{$columnidpct}%" max-width="{$columnidpct}%">{#header_list_id#}
									{if $sortflag}
										{if $sort == $name_list_id}
											{if $sort_order==0}
												<div class="lc_linksort right" event="{$btpage.ref}&sort={$name_list_id}&sortorder=1">
													<span class="fa fa-caret-down"></span>
												</div>
											{else}
												<div class="lc_linksort right" event="{$btpage.ref}&sort=&sortorder=0">
													<span class="fa fa-caret-up"></span>
												</div>
											{/if}
										{else}
											<div class="lc_linksort right" event="{$btpage.ref}&sort={$name_list_id}&sortorder=0">
												<span class="fa fa-sort"></span>
											</div>
										{/if}
									{/if}
								</th>
							{/if}
							{section name=idy loop=$columnname}
								{if $columnname[idy].display}
									<th class="" width="{$columnname[idy].pct}%" max-width="{$columnname[idy].pct}%" >{$columnname[idy].label}
										{if $sortflag}
											{if $sort==$columnname[idy].name}
												{if $sort_order==0}
													<div class="lc_linksort right" event="{$btpage.ref}&sort={$columnname[idy].name}&sortorder=1">
														<span class="fa fa-caret-down"></span>
													</div>
												{else}
													<div class="lc_linksort right" event="{$btpage.ref}&sort=&sortorder=0">
														<span class="fa fa-caret-up"></span>
													</div>
												{/if}
											{else}
												<div class="lc_linksort right" event="{$btpage.ref}&sort={$columnname[idy].name}&sortorder=0">
													<span class="fa fa-sort"></span>
												</div>
											{/if}
										{/if}
									</th>
								{/if}
							{/section}
							{if $btnb == 4}
								<th class="btn-list-action" colspan="4">{#header_list_action#}
							{elseif $btnb == 3}
								<th class="btn-list-action" colspan="3">{#header_list_action#}
							{elseif $btnb == 2}
								<th class="btn-list-action" colspan="2">{#header_list_action#}
							{elseif $btnb == 1}
								<th class="btn-list-action">{#header_list_action#}
							{/if}
							{if $btnb > 0}
								{if $viewflag}
									<div class="view-toggle dropdown-toggle right" data-bs-toggle="dropdown" aria-expanded="false">
										<span class="fa fa-cog" width="16" height="16"></span>
									</div>
									<div class="view-column dropdown-menu">
									{section name=idy loop=$columnname}
										<a class="dropdown-item lc_linkview" event="{$btpage.ref}&view={$columnname[idy].name}" href="#" rel="nofollow">
											{if $columnname[idy].display}
												<span class="fa fa-check" width="16" height="16"></span> 
											{else}
												<span class="fa fa-white" width="16" height="16"></span> 
											{/if}
											{$columnname[idy].label}
										</a>
									{/section}
									</div>
								{/if}
								</th>
							{/if}
						</tr>
					</thead>
					
					<tbody lbl_delete="{#Lbl_delete#}" lbl_tool="{#Lbl_tool#}" bt_cancel="{#Bt_cancel#}" bt_ok="{#Bt_ok#}">
						{section name=idx loop=$list}
							<tr id="tr_{$list[idx][$name_list_id]}">
								{if $columnidflag}
									{if $columnidpct<>0}
										{if $btedit.flag}
											{if $pageflag}
												<td class="lc_line l_linkline" width="{$columnidpct}%">{$list[idx][$name_list_id]}</td>
											{else}
												<td class="lc_line lc_linkline" width="{$columnidpct}%">{$list[idx][$name_list_id]}</td>
											{/if}
										{else}
											{if $pageflag}
												<td class="lc_line" width="{$columnidpct}%">{$list[idx][$name_list_id]}</td>
											{else}
												<td class="lc_line" width="{$columnidpct}%">{$list[idx][$name_list_id]}</td>
											{/if}
										{/if}
									{else}
										{if $btedit.flag}
											{if $pageflag}
												<td class="lc_line l_linkline">{$list[idx][$name_list_id]}</td>
											{else}
												<td class="lc_line lc_linkline">{$list[idx][$name_list_id]}</td>
											{/if}
										{else}
											{if $pageflag}
												<td class="lc_line">{$list[idx][$name_list_id]}</td>
											{else}
												<td class="lc_line">{$list[idx][$name_list_id]}</td>
											{/if}
										{/if}
									{/if}
								{/if}
								{section name=idy loop=$columnname}
									{if $columnname[idy].display}
										{if $columnname[idy].pct<>0}
											{if $btedit.flag}
												{if $pageflag}
													<td class="lc_line l_linkline" width="{$columnname[idy].pct}%" max-width="{$columnname[idy].pct}%">{$list[idx][$columnname[idy].name]}</td>
												{else}
													<td class="lc_line lc_linkline" width="{$columnname[idy].pct}%" max-width="{$columnname[idy].pct}%">{$list[idx][$columnname[idy].name]}</td>
												{/if}
											{else}
												{if $pageflag}
													<td class="lc_line" width="{$columnname[idy].pct}%" max-width="{$columnname[idy].pct}%">{$list[idx][$columnname[idy].name]}</td>
												{else}
													<td class="lc_line" width="{$columnname[idy].pct}%" max-width="{$columnname[idy].pct}%">{$list[idx][$columnname[idy].name]}</td>
												{/if}
											{/if}
										{else}
											{if $btedit.flag}
												{if $pageflag}
													<td class="lc_line l_linkline">{$list[idx][$columnname[idy].name]}</td>
												{else}
													<td class="lc_line lc_linkline">{$list[idx][$columnname[idy].name]}</td>
												{/if}
											{else}
												{if $pageflag}
													<td class="lc_line">{$list[idx][$columnname[idy].name]}</td>
												{else}
													<td class="lc_line">{$list[idx][$columnname[idy].name]}</td>
												{/if}
											{/if}
										{/if}
									{/if}
								{/section}
								{if $btevent.flag}
									{if $columnactionpct<>0}
										{if $btevent.box}
											<td class="lc_line lc_linkevent lc_box" align="center" width="{$columnactionpct}%" title="{#Bt_list_event#}">
										{else}
											<td class="lc_line lc_linkevent lc_nobox" align="center" width="{$columnactionpct}%" title="{#Bt_list_event#}">
										{/if}
									{else}
										{if $btevent.box}
											<td class="lc_line lc_linkevent lc_box" align="center" title="{#Bt_list_event#}">
										{else}
											<td class="lc_line lc_linkevent lc_nobox" align="center" title="{#Bt_list_event#}">
										{/if}
									{/if}
										<a class="btn-list" event="{$btevent.ref[idx]}" rel="nofollow">
											<span class="fa fa-{$btevent.icon} fa-lg" alt="{#Bt_list_event#}"></span> 
										</a>
									</td>
								{/if}
								{if $bttool.flag}
									{if $columnactionpct<>0}
										<td class="lc_line lc_linktool" align="center" width="{$columnactionpct}%" title="{#Bt_list_tool#}">
									{else}
										<td class="lc_line lc_linktool" align="center" title="{#Bt_list_tool#}">
									{/if}
										<a class="btn-list" event="{$bttool.ref[idx]}" title_tool="{#Title_tool#} {$list[idx][$name_delete]}" rel="nofollow">
											<span class="fa fa-{$bttool.icon} fa-lg" alt="{#Bt_list_tool#}"></span> 
										</a>
									</td>
								{/if}
								{if $btedit.flag}
									{if $columnactionpct<>0}
										{if $pageflag}
											<td class="lc_line l_linkline lc_linkedit" align="center" width="{$columnactionpct}%" title="{#Bt_list_edit#}">
										{else}
											<td class="lc_line lc_linkline lc_linkedit" align="center" width="{$columnactionpct}%" title="{#Bt_list_edit#}">
										{/if}
									{else}
										{if $pageflag}
											<td class="lc_line l_linkline lc_linkedit" align="center" title="{#Bt_list_edit#}">
										{else}
											<td class="lc_line lc_linkline lc_linkedit" align="center" title="{#Bt_list_edit#}">
										{/if}
									{/if}
										<a class="btn-list" event="{$btedit.ref[idx]}" rel="nofollow">
											<span class="fa fa-{$btedit.icon} fa-lg" alt="{#Bt_list_edit#}"></span> 
										</a>
									</td>
								{/if}
								{if $btdelete.flag}
									{if $columnactionpct<>0}
										<td class="lc_line lc_linkdelete" align="center" width="{$columnactionpct}%" title="{#Bt_list_delete#}">
									{else}
										<td class="lc_line lc_linkdelete" align="center" title="{#Bt_list_delete#}">
									{/if}
										<a class="btn-list" event="{$btdelete.ref[idx]}" title_delete="{#Title_delete#} {$list[idx][$name_delete]}" rel="nofollow">
											<span class="fa fa-{$btdelete.icon} fa-lg" alt="{#Bt_list_delete#}"></span> 
										</a>
									</td>
								{/if}
							</tr>   	
						{/section}
					</tbody>

				</table>
		</div>
	</div>

	<div class="list-block-footer">
	{if $pagecount > 1 or $pagesizeflag} 
		<div class="row list-container pagination-container">
			<div class="col-lg-12"> 
				{if $pagecount > 1} 
					<ul class="pagination">
						{section name=idx loop=$pagination}
							{if $pagination[idx]==0}
								<li class="page-item">
									<a class="lc_linkpage page-link" event="{$btpage.ref}&p=0" rel="nofollow"><<</a>
								</li>
							{elseif $pagination[idx]==-1}
								<li class="page-item">
									<a class="lc_linkpage page-link" event="{$btpage.ref}&p=-1" rel="nofollow">>></a>
								</li>
							{elseif $pagination[idx]>0}
								{if $pagination[idx]==$page}
									<li class="page-item active">
										<a class="page-link">{$pagination[idx]}</a>
									</li>
								{else}
									<li class="page-item">
										<a class="lc_linkpage page-link" event="{$btpage.ref}&p={$pagination[idx]}" rel="nofollow">{$pagination[idx]}</a>
									</li>
								{/if}
							{/if}
						{/section}
					</ul>
				{/if}
				{if $pagesizeflag} 
					<div class="size-selector">
						<label class="form-label text-sm-end">{#Lbl_list_orderby#}</label>					
						<select class="form-control form-select lc_linksize" event="{$btpage.ref}">
							{section name=idx loop=$pagesizearray}
								{if $pagesize == $pagesizearray[idx]}
									<option value="{$pagesizearray[idx]}" selected="">{$pagesizearray[idx]}</option>  
								{else}
									<option value="{$pagesizearray[idx]}">{$pagesizearray[idx]}</option>  
								{/if}
							{/section}
						</select>
					</div>
				{/if}
			</div>
		</div>
	{/if}

		<div class="row"> 
			<div class="col-lg-12">
			{if $btclose.flag}
				<button type="button" class="btn btn-primary bt-close mr-2" data-loadingtext="{#Txt_loading#}" rel="nofollow">
					<span class="fa fa-{$btclose.icon}" width="16" height="16"></span>  {#Bt_close#}
				</button>
			{/if}
			</div>
		</div>

	</div>
	
</div>

{/block}
	