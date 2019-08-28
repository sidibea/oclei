<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $options
 * @var $el_class
 * @var $el_id
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Wp_Categories
 */
$title = $options = $el_class = $el_id = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$options = explode( ',', $options );
if ( in_array( 'dropdown', $options ) ) {
	$atts['dropdown'] = true;
}
if ( in_array( 'count', $options ) ) {
	$atts['count'] = true;
}
if ( in_array( 'hierarchical', $options ) ) {
	$atts['hierarchical'] = true;
}

$el_class = $this->getExtraClass( $el_class );
$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '<div ' . implode( ' ', $wrapper_attributes ) . ' class="vc_wp_categories wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'Pearl_Widget_Categories';
$args = array(
	'before_widget' => '<aside class="widget widget-default stm_widget_categories ' . $atts['style'] . ' mbdc">',
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
	echo html_entity_decode($this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_categories' ));
}
