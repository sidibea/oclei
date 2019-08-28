<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_id
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$el_class = $el_id = $width = $css = $offset = $css_animation = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
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

$wrapper_attributes = array();

//STM ADDS
$col_styles = '';
$col_styles_array = array();

if(!empty($stretch)) {
    $wrapper_attributes[] = 'data-stretch="' . $stretch . '"';
    if (!empty($content_stretch) && $content_stretch === 'true') {
        $wrapper_attributes[] = 'data-stretch-content="true"';
    }
}



if (!empty($bg_pos)) {
    $col_styles_array['background-position'] = sanitize_text_field($bg_pos);
}

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

if (!empty($col_styles_array)) {
	$col_styles .= "." . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . " {". pearl_array_to_style_string($col_styles_array, true)."}";
}


wp_add_inline_style('pearl-row_style_1', $col_styles);


//STM ADDS

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
} ?>
<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<div class="vc_column-inner <?php echo esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) ?>">
		<div class="wpb_wrapper">
			<?php echo wpb_js_remove_wpautop( $content ); ?>
		</div>
	</div>
</div>