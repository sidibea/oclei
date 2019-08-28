<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$el_class = $width = $el_id = $css = $offset = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_col-has-fill';
}

//STM start
$stm_custom_css = '';
if (empty($css)) {
	$stm_custom_css = 'pearl_column_inner_' . md5(serialize($atts));
	$css_classes[] = $stm_custom_css;
} else {
	$stm_custom_css = vc_shortcode_custom_css_class( $css );
}

$col_styles = '';
$col_styles_array = array();

$box_shadow = array(
	'x'      => intval($shadow_x_offset) . 'px',
	'y'      => intval($shadow_y_offset) . 'px',
	'blur'   => intval($shadow_blur) . 'px',
	'spread' => intval($shadow_spread) . 'px',
	'color'  => $shadow_color
);

if (!empty($box_shadow) && $box_shadow['color'] !== 'transparent') {
	$col_styles_array['box-shadow'] = $box_shadow['x'] . ' ' . $box_shadow['y'] . ' ' . $box_shadow['blur'] . ' ' . $box_shadow['spread'] . ' ' . $box_shadow['color'];
}
if (!empty($bg_pos)) {
	$col_styles_array['background-position'] = $bg_pos;
}


if (!empty($col_styles_array)) {
	$col_styles .= "." . esc_attr( trim( $stm_custom_css ) ) . " {". pearl_array_to_style_string($col_styles_array, true)."}";
}






wp_add_inline_style('pearl-row_style_1', $col_styles);

//STM end
$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;