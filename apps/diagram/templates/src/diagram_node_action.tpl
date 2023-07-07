<div class="crud box-header diagram-node-action" title="{$nodeFromTitle}" box-id="node-action">
	<div class="row form-group">	
		<div class="col-md-12 col-sm-12">
			<p>{#Title_to#} {$nodeToTitle}</p>
			<p>{#Title_action#}</p>
		</div>	
	</div>
	<div class="row form-group">	
		<div class="col-md-12 col-sm-12">
			<button type="button" class="btn btn-primary bt-event form-control" id="node_move" event="{$pageMove}">
				{#Bt_move#}
			</button>
			{if $pageOrder != ''} 
				<button type="button" class="btn btn-primary bt-event form-control" id="node_order" event="{$pageOrder}">
					{#Bt_order#}
				</button>
			{/if}
			<button type="button" class="btn btn-primary bt-event form-control" id="node_copy" event="{$pageCopy}">
				{#Bt_copy#}
			</button>
		</div>
	</div>
</div>
