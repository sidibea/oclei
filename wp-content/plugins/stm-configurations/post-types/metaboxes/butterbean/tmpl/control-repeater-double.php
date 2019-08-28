<# if ( data.label ) { #>
	<span class="butterbean-label">{{ data.label }}</span>
<# } #>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<p>
	<button type="button" class="button button-primary butterbean-add-field">{{data.l10n.add}}</button>
</p>

<div class="stm_repeater_inputs stm_repeater_inputs__double">
	<# _.each( data.values, function( value, key) { #>
		<p>
			<input type="text"
                   name="{{ data.field_name }}[{{key}}][label]"
                   data-label="label"
                   value="{{value.label}}"
                   data-key="{{key}}"
                   {{{ data.attr }}} />
			<input type="text"
                   name="{{ data.field_name }}[{{key}}][name]"
                   value="{{value.name}}"
                   data-label="name"
                   data-key="{{key}}"
                   {{{ data.attr }}} />
			<i class="fa fa-remove butterbean-delete-field" data-delete="{{key}}"></i>
		</p>
	<# } ) #>
</div>