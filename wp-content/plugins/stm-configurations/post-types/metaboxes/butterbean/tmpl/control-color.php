<label>
	<# if ( data.label ) { #>
		<span class="butterbean-label">{{ data.label }}</span>
	<# } #>

	<# if ( data.description ) { #>
		<span class="butterbean-description">{{{ data.description }}}</span>
	<# } #>

	<input {{{ data.attr }}} data-alpha=true value="<# if ( data.value ) { #>{{ data.value }}<# } #>" />
</label>
