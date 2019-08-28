<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_vacancies');
$classes[] = 'stm_vacancies_' . $style;
$classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$classes[] = $this->getCSSAnimation( $css_animation );

pearl_add_element_style('vacancies', $style);

$posts_per_page = (!empty(intval($text))) ? intval($text) : '10';

$args = array(
    'post_type' => 'stm_vacancies',
    'posts_per_page' => $posts_per_page
);

$atts['args'] = $args;
$atts['classes'] = $classes;

pearl_load_vc_element('vacancies', $atts, $style);