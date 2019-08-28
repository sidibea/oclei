<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_contact');
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );

$classes = implode(' ', $classes);

wp_enqueue_style('lightgallery');
wp_enqueue_script('lightgallery.js');

$type = 'STM_WP_Widget_Post_Gallery';
$args = array(
    'before_widget' => '<aside class="widget widget-default stm_wp_widget_post_gallery' . $classes . '">',
    'after_widget'  => '</aside>',
    'before_title'  => '<div class="widgettitle"><h5 class="no_line">',
    'after_title'   => '</h5></div>'
);

the_widget( $type, $atts, $args ); ?>