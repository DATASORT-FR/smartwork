<script>
	$(document).ready(
		function() {		
			if (typeof(crudTab['{$field_id}']) == 'undefined' ) {
				crudTab['{$field_id}'] = '{$field_id}_1';
			}
			$('#'+crudTab['{$field_id}']).tab('show');		
		}
	);
</script>

<div class="tab-content" id="{$field_id}Content">
	{$field_value.html}
</div>
<div class="page nav-tabs" id="{$field_id}">
	<ul class="page nav pull-right">
	{$line = 0}
	{section name=idx loop=$field_value.content}
		{$field_content = $field_value.content[idx]}
		<li class="nav-item">
			<a id="{$field_id}_{$line+1}" class="nav-link" data-bs-toggle="tab" href="#{$field_content.href}">{$line+1}</a>
		</li>			
		{$line = $line+1}
	{/section}
	</ul>
</div>
