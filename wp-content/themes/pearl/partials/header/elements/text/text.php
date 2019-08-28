<?php if (!empty($element['value'])):
	$fwn = (!empty($element['data']['fwn'])) ? $element['data']['fwn'] : 'fwn';
	$fsz = (!empty($element['data']['fsz'])) ? intval($element['data']['fsz']) : '';

	$text_styles = [];
	if (!empty($fsz)) {
        $text_styles['font-size'] = $fsz . 'px';
	}
	$text_styles = pearl_array_to_style_string($text_styles, true, true);
	?>
    <div class="stm-text <?php echo esc_attr($fwn); ?>" <?php echo sanitize_text_field($text_styles) ?>>
		<?php esc_html_e($element['value'], 'pearl'); ?>
    </div>
<?php endif; ?>