<# if ( data.label ) { #>
	<span class="butterbean-label">{{ data.label }}</span>
<# } #>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<p>
	<button type="button" class="button button-primary butterbean-add-field">{{data.l10n.add}}</button>
</p>

<div class="stm_repeater_inputs stm_repeater_inputs__double_music">
	<# _.each( data.values, function( value, key) { #>
		<div class="like_p">
			<div class="doubled">
				<input type="text"
					   name="{{ data.field_name }}[{{key}}][label]"
					   data-label="label"
					   value="{{value.label}}"
					   data-key="{{key}}"
					   placeholder="{{data.l10n.url}}"
					   {{{ data.attr }}} />
			</div>
			<div class="doubled">
				<input type="text"
					   name="{{ data.field_name }}[{{key}}][name]"
					   value="{{value.name}}"
					   data-label="name"
					   data-key="{{key}}"
					   {{{ data.attr }}} />
				<div class="song-actions">
					<# if ( !value.name ) { #>
						<button type="button" class="button button-primary butterbean-add-song">{{data.l10n.add}}</button>
					<# } else { #>
						<button type="button" class="button button-primary butterbean-change-song">{{data.l10n.change}}</button>
						<button type="button" class="button button-primary butterbean-remove-song">{{data.l10n.remove}}</button>
					<# } #>
				</div>
				<div class="song-filename"><h5>
					<# if ( !value.filename ) { #>
						{{data.l10n.nothing}}
					<# } else { #>
						{{value.filename}}
					<# } #>
				</h5></div>
			</div>
			<div class="doubled">
				<p>
					<button type="button" class="button button-primary butterbean-add-url" data-key="{{key}}">
						{{data.l10n.add_url}}
					</button>
				</p>

				<# _.each( value.urls, function( url_value, url_key) { #>
					<div class="stm_audio_input__urls" data-key="{{key}}" data-subkey="{{url_key}}">
						<input type="text"
							   value="{{url_value.icon}}"
							   name="{{ data.field_name }}[{{key}}][urls][{{url_key}}][icon]"
							   data-label="icon"
							   class="butterbean-iconpicker butterbean_urls"
							   placeholder="{{data.l10n.enter_url}}" />
						<input type="text"
							   value="{{url_value.url}}"
							   name="{{ data.field_name }}[{{key}}][urls][{{url_key}}][url]"
							   data-label="url"
							   class="butterbean_urls"
							   placeholder="{{data.l10n.enter_url}}" />
						<i class="remove-audio-link" data-key="{{key}}" data-subkey="{{url_key}}"></i>
					</div>
				<# } ) #>
			</div>
			<i class="fa fa-remove butterbean-delete-field" data-delete="{{key}}"></i>
		</div>
	<# } ) #>
</div>