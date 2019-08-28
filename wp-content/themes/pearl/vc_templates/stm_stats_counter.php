<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm-counter', 'clearfix');
$classes[] = 'stm-counter_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

$classes[] = (!empty($icon)) ? 'has_icon' : 'no_icon';

pearl_add_element_style('counter', $style);
wp_enqueue_script('countUp.js');

$duration = (!isset($duration)) ? '2.5' : $duration;
$separator = (empty($separator)) ? '' : $separator;
$decimals = 0;

if (!empty($counter_value)) {
	$decimals = strlen(substr(strrchr($counter_value, "."), 1));
}

$id = 'counter_' . pearl_random();


/*icon settings*/
$icon_classes = array();
$icon_styles = array();
$icon_style_string = '';

$icon_classes[] = $icon;

if ($icon_class === 'custom') {
	$icon_styles[] = "color: {$icon_color}";
} else {
	$icon_classes[] = $icon_class;
}

if (!empty($icon_styles)) {
	$icon_style_string = 'style = " ' . implode(' !important;', $icon_styles) . ' !important;"';
}

if (!empty($icon_gradient) && $icon_gradient === 'enable') {
	$classes[] = 'stm_icon_gradient';
	$icon_gradient_first_color = !empty($icon_gradient_first_color) ? $icon_gradient_first_color : '#000';
	$icon_gradient_second_color = !empty($icon_gradient_second_color) ? $icon_gradient_second_color : '#000';

	$stm_custom_css[] = "background: -webkit-linear-gradient(45deg, {$icon_gradient_first_color} 0%, {$icon_gradient_second_color} 100%)";
}

if (!empty($stm_custom_css)) {

	$stm_custom_css = ".stm-counter > i {
        " . implode(';', $stm_custom_css) . "
    }";

	wp_add_inline_style('pearl-row_style_1', $stm_custom_css);
}

/*text settings*/

$text_styles = array();
$text_style_string = '';

if ($text_class === 'custom') {
	$text_styles[] = "color: {$text_color}";
} else {
	$classes[] = $text_class;
}

if (!empty($text_styles)) {
	$text_style_string = 'style = " ' . implode(' !important;', $text_styles) . ' !important"';
}

$text_color_style = (!empty($text_color)) ? 'style="color: ' . $text_color . '"' : '';

$value = ($duration === '0') ? $counter_value : '';
?>


<?php if (!empty($counter_value)): ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo sanitize_text_field($text_style_string); ?>>

		<?php if (!empty($icon)): ?>
            <i class="stm-counter__icon <?php echo esc_attr(implode(' ', $icon_classes)) ?>" <?php echo sanitize_text_field($text_color_style); ?>
				<?php echo sanitize_text_field($icon_style_string) ?>></i>
		<?php endif; ?>
		<?php if (!empty($affix)): ?>
            <span class="stm-counter__affix stm_mf" <?php echo sanitize_text_field($text_color_style); ?>><?php echo esc_attr($affix); ?></span>
		<?php endif; ?>

        <span class="stm-counter__value stm_mf mtc_a" <?php echo sanitize_text_field($text_color_style); ?>
              data-value="<?php echo esc_js($counter_value); ?>"
              data-duration="<?php echo esc_js($duration); ?>"
              data-separator="<?php echo esc_js($separator); ?>"
              data-decimals="<?php echo intval($decimals) ?>"
              id="<?php echo esc_attr($id); ?>"><?php echo esc_attr($value); ?></span>

		<?php if (!empty($prefix)): ?>
            <span class="stm-counter__prefix stm_mf" <?php echo sanitize_text_field($text_color_style); ?>><?php echo esc_attr($prefix); ?></span>
		<?php endif; ?>

		<?php if (!empty($title)): ?>
            <div class="stm-counter__label" <?php echo sanitize_text_field($text_color_style); ?>><?php echo esc_attr($title); ?></div>
		<?php endif; ?>
    </div>

	<?php if ($duration !== '0') {
		wp_enqueue_script('pearl_stats_counter');
	} ?>

<?php endif; ?>


