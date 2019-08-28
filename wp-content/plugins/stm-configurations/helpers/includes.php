<?php
/*CF7 Workaround*/
if (function_exists('wpcf7_add_form_tag')) {
	remove_action( 'wpcf7_init', 'wpcf7_add_shortcode_submit', 20 );
	add_action( 'after_setup_theme', 'wpcf7_add_shortcode_submit_button' );

	function wpcf7_add_shortcode_submit_button() {
		wpcf7_add_form_tag( 'submit', 'wpcf7_submit_button_shortcode_handler' );
	}

	function wpcf7_submit_button_shortcode_handler( $tag ) {
		$tag = new WPCF7_FormTag( $tag );

		$class = wpcf7_form_controls_class( $tag->type );

		$atts = array();

		$atts['class'] = $tag->get_class_option( $class );
		$atts['id'] = $tag->get_id_option();
		$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

		$value = isset( $tag->values[0] ) ? $tag->values[0] : '';

		if ( empty( $value ) )
			$value = __( 'Send', 'stm_theme_text_domain' );

		$atts['type'] = 'submit';

		$atts = wpcf7_format_atts( $atts );

		$html = sprintf( '<button %1$s>%2$s</button>', $atts, $value );

		return $html;
	}
}

function stm_conf_build_form($fields) {

	foreach ($fields as $key => $field) {
		$field['wrapper_class'] = isset($field['wrapper_class']) ? $field['wrapper_class'] : array();
		$field['class'] = isset($field['class']) ? $field['class'] : array();
		$field['placeholder'] = isset($field['placeholder']) ? $field['placeholder'] : '';
		$field['name'] = isset($field['name']) ? $field['name'] : '';
		$field['label'] = isset($field['label']) ? $field['label'] : '';
		$field['required'] = isset($field['required']) && $field['required'] ? 'required' : '';
		$field['label_position'] = isset($field['label_position']) ? $field['label_position'] : 'before';
		$is_label_before = !empty($field['label']) && $field['label_position'] === 'before';
		$is_label_after = !empty($field['label']) && $field['label_position'] === 'after';

		$key = uniqid();

		?>
		<div
			class="form-group <?php echo esc_attr(implode(' ', $field['wrapper_class'])); ?>">

			<?php if ($field['type'] === 'radio') :
				foreach ($field['value'] as $radio_key => $value) {
					?>
					<?php if ($is_label_before) : ?>
						<label
							for="donation_form_field_<?php echo esc_attr($radio_key) ?>"><?php echo esc_html($field['label'][$radio_key]) ?></label>
					<?php endif; ?>
					<input type="radio"
						   id="donation_form_field_<?php echo esc_attr($radio_key) ?>"
						   name="<?php echo esc_attr($field['name']) ?>"
						   class="form-control <?php echo esc_attr(implode(' ', $field['class'])) ?>"
						   value="<?php echo esc_attr($field['value'][$radio_key]); ?>">
					<?php if ($is_label_after) : ?>
						<label
							for="donation_form_field_<?php echo esc_attr($radio_key) ?>"><?php echo esc_html($field['label'][$radio_key]) ?></label>
					<?php endif; ?>
					<?php
				}
				?>
			<?php elseif ($field['type'] === 'textarea') : ?>
				<?php if ($is_label_before) : ?>
					<label
						for="donation_form_field_<?php echo esc_attr($key) ?>"><?php echo esc_html($field['label']) ?></label>
				<?php endif; ?>
				<textarea name="<?php echo esc_attr($field['name']) ?>"
						  class="form-control <?php echo esc_attr(implode(' ', $field['class'])) ?>"
						  id="donation_form_field_<?php echo esc_attr($key) ?>"></textarea>
				<?php if ($is_label_after) : ?>
					<label
						for="donation_form_field_<?php echo esc_attr($key) ?>"><?php echo esc_html($field['label']) ?></label>
				<?php endif; ?>

			<?php elseif ($field['type'] === 'submit') : ?>

				<?php if ($is_label_before) : ?>
					<label
						for="donation_form_field_<?php echo esc_attr($key) ?>"><?php echo esc_html($field['label']) ?></label>
				<?php endif; ?>
				<button type="<?php echo esc_attr($field['type']) ?>"
						id="donation_form_field_<?php echo esc_attr($key) ?>"
						class="<?php echo esc_attr(implode(' ', $field['class'])) ?>"
					<?php echo esc_attr($field['required']) ?>>

					<?php if (!empty($field['value'])) : ?>
						<?php echo esc_attr($field['value']) ?>
					<?php endif; ?>
					<span class="preloader"></span>
				</button>
				<?php if ($is_label_after) : ?>
					<label
						for="donation_form_field_<?php echo esc_attr($key) ?>"><?php echo esc_html($field['label']) ?></label>
				<?php endif; ?>

			<?php else : ?>

				<?php if ($is_label_before) : ?>
					<label
						for="donation_form_field_<?php echo esc_attr($key) ?>"><?php echo esc_html($field['label']) ?></label>
				<?php endif; ?>
				<input type="<?php echo esc_attr($field['type']) ?>"
					   id="donation_form_field_<?php echo esc_attr($key) ?>"
					   name="<?php echo esc_attr($field['name']) ?>"
					<?php if (!empty($field['value'])) : ?>
						value="<?php echo esc_attr($field['value']) ?>"
					<?php endif; ?>

					<?php if (!empty($field['placeholder'])) : ?>
						placeholder="<?php echo esc_attr($field['placeholder']) ?>"
					<?php endif; ?>
					   class="form-control <?php echo esc_attr(implode(' ', $field['class'])) ?>"
					<?php echo esc_attr($field['required']) ?>>
				<?php if ($is_label_after) : ?>
					<label
						for="donation_form_field_<?php echo esc_attr($key) ?>"><?php echo esc_html($field['label']) ?></label>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php
	}
}