<script>
	$(document).ready(
		function() {		
			if (typeof(crudTab['{$field_id}']) == 'undefined' ) {
				crudTab['{$field_id}'] = '{$field_id}_1';
			}
			$('#'+crudTab['{$field_id}']).tab('show');
			
//			var {$field_id}_maxHeight = -1;
//			$("#{$field_id}Content div.tab-pane").each(function() {
//				var h = $(this).height(); 
//				{$field_id}_maxHeight = h > {$field_id}_maxHeight ? h : {$field_id}_maxHeight;
//			});
//			$('#{$field_id}Content').height({$field_id}_maxHeight);
		}
	);
</script>

<ul id="{$field_id}" class="nav nav-tabs">
	{$line = 0}
	{section name=idx loop=$field_value.content}
		{$field_content = $field_value.content[idx]}
		<li class="nav-item">
			<a id="{$field_id}_{$line+1}" class="nav-link" data-bs-toggle="tab" href="#{$field_content.href}">{$field_content.label}</a>
		</li>			
		{$line = $line+1}
	{/section}
</ul>
<div id="{$field_id}Content" class="tab-content">
	{$field_value.html}
</div>