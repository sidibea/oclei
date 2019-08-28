<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$unique_class = uniqid('stm_icon_separator_');

$classes = array('stm_icon_separator', $unique_class);
$classes[] = 'stm_icon_separator_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
pearl_add_element_style('stm_icon_separator', $style);


$icon_classes = array($icon);
$icon_inline_css = array(
	'font-size' => $icon_size . 'px'
);
$icon_before_css = array();
$icon_after_css = array();

$inline_css = '';

if ($border_color !== 'custom') {
	$classes[] = $border_color;
} else {
	$icon_before_css['border-color'] = $border_custom_color;
	$icon_after_css['border-color'] = $border_custom_color;
	$inline_css .= '.' . $unique_class .':before {'. pearl_array_to_style_string($icon_before_css, true)  .'}';
}

if ($icon_color !== 'custom') {
	$classes[] = $icon_color;
} else {
	$icon_inline_css['color'] = $icon_custom_color;
}

if (!empty($icon_inline_css)) {
	$inline_css .= '.' . $unique_class . '{'. pearl_array_to_style_string($icon_inline_css, true) .'}';
}



if (!empty($inline_css)) {
	wp_add_inline_style('pearl-row_style_1', $inline_css);
}





?>

<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
	<i class="<?php echo esc_attr($icon)?>"></i>
</div>

<?php

?>

