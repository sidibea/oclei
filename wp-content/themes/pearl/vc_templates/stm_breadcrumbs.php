<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$unique_class = uniqid('pearl_vc_breadcrumbs_');

$classes = array('pearl_vc_breadcrumbs');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );
$classes[] = $unique_class;
$classes[] = 'text-' . $align;

$text_color = !empty($text_color) ? $text_color : pearl_get_option('third_color');

$style = '.' . $unique_class . ', .' . $unique_class . ' a, .'. $unique_class .' span{ color:' . $text_color . ' !important;}';
wp_add_inline_style('pearl-row_style_1', $style);
?>

<div class="<?php echo esc_attr(implode(' ', $classes)) ?>" style="color: <?php echo esc_attr($text_color); ?> !important;">
	<?php bcn_display() ?>
</div>
