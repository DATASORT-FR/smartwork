		<div class="col-md-12 block-header">
			<h1 itemprop="title">{$Mission.title}</h1>
		</div>
		<div class="col-md-12 content_btn">
			<div class="col-sm-6 text-left">
				<small itemprop="datePosted">{$Mission.date_publication}</small>
				{if $Mission.status != ''}
					<small class="status">{$Mission.status}</small>
				{/if}
			</div>
			{if $pageRightUpdate == 1}
				<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="Chargement..." event="{$AdminLink}">
					<span class="fa fa-edit" width="16" height="16"></span>
					{#Txt_Content_edit#}
				</button>
			{/if}
			<a class="btn btn-primary" title="{#Txt_list_return_page_title#}" href="{$ListLink}">
				<span class="fa fa-arrow-left"></span>
				{#Txt_list_return_page#}
			</a>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header p-b-0">
					<h2 class="card-title">
						<i class="fa fa-eye" aria-hidden="true"></i> 
						{#Lbl_mission_resume#}
					</h2>
				</div>
				<div class="card-body">
					{if $pageRightUpdate == 1}
						<div class="form-group">
							<label class="font-weight-bold">{#Lbl_mission_reference#}</label>
							<span class="job-reference">{$Mission.reference}</span>
						</div>
					{/if}
						
					<div class="form-group">
						<label class="font-weight-bold">{#Lbl_mission_job_name#}</label>
						<span class="job-name" itemprop="name">{$Mission.job_name}</span>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold">{#Lbl_mission_job_object#}</label>
						<span class="job-object">{$Mission.job_object}</span>
					</div>
					
					<div class="form-group">
						<label class="display-star font-weight-bold">{#Lbl_mission_score#}</label>
						<ul class='display-star'>
							{if $Mission.score > 0}
								<li class='light'>
							{else}
								<li class=''>
							{/if}
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
							{if $Mission.score > 1}
								<li class='light'>
							{else}
								<li class=''>
							{/if}
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
							{if $Mission.score > 2}
								<li class='light'>
							{else}
								<li class=''>
							{/if}
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
							{if $Mission.score > 3}
								<li class='light'>
							{else}
								<li class=''>
							{/if}
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
							{if $Mission.score > 4}
								<li class='light'>
							{else}
								<li class=''>
							{/if}
								<i class="fa fa-star" aria-hidden="true">
								</i>
							</li>
						</ul>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold">{#Lbl_mission_job_branch#}</label>
						<span class="job-branch" itemprop="industry">{$Mission.job_branch}</span>
					</div>
					
					<div class="form-group last-group">
						<label class="font-weight-bold">{#Lbl_mission_job_type#}</label>
						<span class="job-employment hidden" itemprop="employmentType">contract</span>
						<span class="job-type">{$Mission.job_type} {$Mission.job_style}</span>
					</div>
					
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header p-b-0">
					<h2 class="card-title">
						<i class="fa fa-info" aria-hidden="true"></i> 
						{#Lbl_mission_info#}
					</h2>
				</div>
				<div class="card-block">
					{if $pageRightUpdate == 1}
						<div class="form-group">
							<label class="font-weight-bold">{#Lbl_mission_status#}</label>
							<span class="job-status" itemprop="datePosted">{$Mission.statusName}</span>
						</div>
					{/if}
						
					<div class="form-group">
						<label class="font-weight-bold">{#Lbl_mission_location#}</label>
						<span class="job-location" itemprop="jobLocation">{$Mission.location}</span>
						<span class="job-location_address hidden" itemprop="jobLocation.address"">{$Mission.location}</span>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold">{#Lbl_mission_duration#}</label>
						<span class="job-duration">{$Mission.duration}</span>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold">{#Lbl_mission_start#}</label>
						<span class="job-start">{$Mission.start}</span>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold">{#Lbl_mission_rate#}</label>
						<span class="job-rate" itemprop="baseSalary">{$Mission.rate}</span>
					</div>
					
					<div class="form-group empty-group last-group">
					</div>
					
				</div>
			</div>
		</div>				
		<div class="col-md-12 block-content">
			{$socialShare}
			<div class="mission_description" itemprop="description">
				{$Mission.description}
			</div>
			<div class="mission_bottom">
				<p class="tag-list" itemprop="skills">
					{if $Tags|@count > 0}
						{section name=idy loop=$Tags}
							<a class="tag-default tag-link" href="{$Tags[idy].href}">{$Tags[idy].tag}</a>
						{/section}
					{/if}
				</p>
				<p class="return">
					{if $pageRightUpdate == 1}
						<button type="button" class="btn btn-primary bt-proc-page" data-loadingtext="Chargement..." event="{$AdminLink}">
							<span class="fa fa-edit" width="16" height="16"></span>
							{#Txt_Content_edit#}
						</button>
					{/if}
					<a class="btn btn-primary" title="{#Txt_list_return_page_title#}" href="{$ListLink}">
						<span class="fa fa-arrow-left"></span>
						{#Txt_list_return_page#}
					</a>
				</p>
			</div>
		</div>

		{if $Mission.original == 1}
			<div class="col-md-12 block-footer">
				<div class="card">
					<div class="card-header p-b-0">
						<h2 class="card-title">
							<i class="fa fa-info" aria-hidden="true"></i> 
							{#Lbl_mission_contact#}
						</h2>
					</div>
					<div class="card-block">
						<div class="row">
							{if !empty($Mission.company)}
								<div class="form-group col-md-4">
									<label class="font-weight-bold">{#Lbl_mission_company_name#}</label>
									<span class="company-name" itemprop="hiringOrganization">{$Mission.company}</span>
								</div>
							{/if}

							{if !empty($Mission.company_reference)}
								<div class="form-group col-md-4">
									<label class="font-weight-bold">{#Lbl_mission_company_reference#}</label>
									<span class="company-reference" itemprop="name">{$Mission.company_reference}</span>
								</div>
							{/if}
						</div>
						
						<div class="row">
							{if !empty($Mission.contact)}
								<div class="form-group col-md-4">
									<label class="font-weight-bold">{#Lbl_mission_contact_name#}</label>
									<span class="contact-name">{$Mission.contact}</span>
								</div>
							{/if}
					
							{if !empty($Mission.contact_mail)}
								<div class="form-group col-md-4">
									<label class="font-weight-bold">{#Lbl_mission_contact_mail#}</label>
									<span class="contact-mail">{$Mission.contact_mail}</span>
								</div>
							{/if}
					
							{if !empty($Mission.contact_phone)}
								<div class="form-group col-md-4">
									<label class="font-weight-bold">{#Lbl_mission_contact_phone#}</label>
									<span class="contact-phone">{$Mission.contact_phone}</span>
								</div>
							{/if}
						</div>
						
						<div class="col-md-12 text-right">
							<small>
								<a href="{$Mission.page}" target="_blank">{$Mission.site}</a>
							</small>
						</div>
					</div>
				</div>
			</div>
		{/if}
		
		{if !empty($Links) and $Mission.original != 1}
			<div class="col-md-12 block-footer">
				<h2>{#Lbl_mission_links#}</h2>
			</div>
			<div class="col-md-12 block-footer">
				<div class="table-responsive">
					<table class="site-link table table-striped">
						<thead>
							<tr>
								<th class="site-header">{#Lbl_mission_links_site#}</th>
								<th class="title-header">{#Lbl_mission_links_title#}</th>
								<th class="status-header hidden-sm-down">{#Lbl_mission_links_status#}</th>
								<th class="score-header hidden-xs-down">{#Lbl_mission_links_score#}</th>
								<th class="rate-header hidden-sm-down">{#Lbl_mission_links_rate#}</th>
							</tr>
						</thead>
						<tbody>
							{section name=idx loop=$Links}
								<tr>
									<th class="site-cell">{$Links[idx].site}</th>
									<td class="title-cell">
										<a href="{$Links[idx].url}" target="_blank">{$Links[idx].title}</a>
									</td>
									<td class="status-cell hidden-sm-down">{$Links[idx].status}</td>
									<td class="score-cell hidden-xs-down">
										<ul class="display-star hidden-sm-down">
											{if $Links[idx].score > 0}
												<li class='light'>
											{else}
												<li class=''>
											{/if}
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
											{if $Links[idx].score > 1}
												<li class='light'>
											{else}
												<li class=''>
											{/if}
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
											{if $Links[idx].score > 2}
												<li class='light'>
											{else}
												<li class=''>
											{/if}
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
											{if $Links[idx].score > 3}
												<li class='light'>
											{else}
												<li class=''>
											{/if}
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
											{if $Links[idx].score > 4}
												<li class='light'>
											{else}
												<li class=''>
											{/if}
												<i class="fa fa-star" aria-hidden="true">
												</i>
											</li>
										</ul>
										<div class="hidden-md-up">{$Links[idx].score}/5</div>
									</td>
									<td class="rate-cell hidden-sm-down">{$Links[idx].rate}</td>
								</tr>
							{/section}
						</tbody >
					</table>
				</div>
			</div>
		{/if}

     
