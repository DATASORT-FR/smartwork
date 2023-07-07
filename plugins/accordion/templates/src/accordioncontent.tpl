<div class="card" id="{$field_id}">
	<div id="{$field_id}_header" class="card-header">
		<button type="button" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#{$field_id}_collapse">
			<i class="fa fa-plus"></i>{$field_value.label}
		</button>									
    </div>
	<div id="{$field_id}_collapse" class="collapse" aria-labelledby="{$field_id}_header" data-parent="">
		<div class="card-body">
			{$field_value.html}
		</div>
	</div>
</div>