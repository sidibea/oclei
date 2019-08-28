<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $source
 * @var $text
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $css
 * @var $css_animation
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$source = $text = $link = $google_fonts = $font_container = $el_class = $css = $css_animation = $font_container_data = $google_fonts_data = '';
// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


/**
 * @var $css_class
 */
extract( $this->getStyles( $el_class . $this->getCSSAnimation( $css_animation ), $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}


if ( ( ! isset( $atts['use_theme_fonts'] ) || 'yes' !== $atts['use_theme_fonts'] ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

if ( ! empty( $styles ) ) {
	$style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
} else {
	$style = '';
}

if ( 'post_title' === $source ) {
	$text = get_the_title( get_the_ID() );
}

if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$text = '<a href="' . esc_attr( $link['url'] ) . '"' . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' ) . ( $link['rel'] ? ' rel="' . esc_attr( $link['rel'] ) . '"' : '' ) . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' ) . '>' . $text . '</a>';
}


/*STM Heading*/
$css_class .= (!empty($heading_line)) ? " {$heading_line}" : "";
/*STM Transform*/
$css_class .= ' ' . sanitize_text_field($text_transform) . ' ';
/*STM heading icon*/
$icon = '';
$icon_style = '';
if (!empty($heading_icon)) {
    $pos = (empty($heading_icon_pos)) ? 'top' : $heading_icon_pos;
	$icon_classes = array($heading_icon, 'position_' . $pos);

	if ($heading_icon_color !== 'custom') {
		$icon_classes[] = $heading_icon_color;
	} else {
		$icon_custom_color = "color: {$heading_icon_custom_color} !important;";
		$icon_style .= $icon_custom_color;
	}

	if (!empty($icon_style)) {
		$icon_style = 'style="' . $icon_style . '"';
	}


    $heading_icon .= ' position_' . $pos;

	$css_class .= ' stm_custom_heading__icon';
	$icon = '<i class="' . esc_attr(implode(' ', $icon_classes)) . '" ' . $icon_style . '></i>';
}

//stm get text align
$text_align = 'left';
if (!empty($font_container)) {
	$stm_font_container = explode('|', $font_container);

	foreach ($stm_font_container as $param) {
		if (strpos($param, 'text_align') !== false) {
			$text_align = explode(':', $param);
			$text_align = $text_align[1];
			break;
		}
	}
}


$css_class .= ' text-' . $text_align;

//stm side lines
$side_line_html = '<div class="stm_custom_heading__side_line"></div>';
$left_side_line = $right_side_line = '';
$side_lined = false;

if (!empty($heading_side_line) && $heading_side_line === 'enable') {
	$side_lined = true;
	$open = '<div class="stm_custom_heading__side">';
	$close = '</div>';

	$search = 'stm_custom_heading__side_line';
	$right_replace = $search . ' ' . $search . '_right';
	$left_replace = $search . ' ' . $search . '_left';

	switch ($text_align) {
		case 'left' :
			$left_side_line = $open;
			$right_side_line = str_replace($search, $right_replace, $side_line_html) . $close;
			break;
		case 'right' :
			$left_side_line = $open . str_replace($search, $left_replace, $side_line_html);
			$right_side_line = $close;
			break;
		case 'center' :
			$left_side_line = $open . str_replace($search, $left_replace, $side_line_html);
			$right_side_line  = str_replace($search, $right_replace, $side_line_html) . $close;
			break;
		default :
			$left_side_line = $right_side_line = '';
	}
}

$output = '';


if ( apply_filters( 'vc_custom_heading_template_use_wrapper', false ) or $side_lined ) {
	$output .= '<div class="' . esc_attr( $css_class ) . '" >';
	$output .= $left_side_line;
	$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
	$output .= $text;
	$output .= '</' . $font_container_data['values']['tag'] . '>';
	$output .= $right_side_line;
	$output .= '</div>';
} else {
	$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' class="' . esc_attr( $css_class ) . '">';
	$output .= $icon;
	$output .= $text;
	$output .= '</' . $font_container_data['values']['tag'] . '>';
}

echo html_entity_decode($output);
