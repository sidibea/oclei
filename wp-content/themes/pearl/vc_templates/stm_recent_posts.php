<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $number
 * @var $show_date
 * @var $el_class
 * @var $el_id
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Wp_Posts
 */
$title = $number = $show_date = $el_class = $el_id = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$el_class = $this->getExtraClass( $el_class );
$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '<div ' . implode( ' ', $wrapper_attributes ) . ' class="vc_wp_posts wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'Pearl_Widget_Recent_Posts';
$args = array(
	'before_widget' => '<aside class="widget widget-default stm_widget_posts ' . $atts['style'] . ' ' . $css_class . ' mbdc">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="widgettitle"><h5>',
	'after_title'   => '</h5></div>'
);
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	echo html_entity_decode($output);
} else {
	echo html_entity_decode($this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_posts' ));
}
