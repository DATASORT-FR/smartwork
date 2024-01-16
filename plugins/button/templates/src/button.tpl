{if $field_value.pageflag}
	<button type="button" class="btn btn-primary bt-proc-page form-control {$field_class}" id="{$field_id}" {$field_style} event="{$field_value.ref}">
		{$field_value.text}
	</button>
{else}
	<button type="button" class="btn btn-primary bt-proc form-control {$field_class}" id="{$field_id}" {$field_style} event="{$field_value.ref}">
		{$field_value.text}
	</button>
{/if}
