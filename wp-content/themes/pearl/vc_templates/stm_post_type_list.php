<?php
$output = $title = $el_class = $sortby = $exclude = $css = '';
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$classes = 'widget stm_widget_post_type_list';

$type = 'STM_WP_Widget_Post_Type_List';
$args = array(
    'before_widget' => '<aside class="' . $classes . $css_class .'">',
    'after_widget'  => '</aside>',
    'before_title'  => '<div class="widgettitle"><h5>',
    'after_title'   => '</h5></div>'
);


the_widget( $type, $atts, $args );