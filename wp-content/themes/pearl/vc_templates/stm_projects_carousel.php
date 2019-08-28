<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

if (empty($style_carousel)) {
	$style_carousel = 'style_1';
}

$classes = array('stm_projects_carousel', 'stm_projects_carousel_dark');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = $fullwidth;
if (!empty($css_class)) {
	$classes[] = $css_class;
}
pearl_add_element_style('projects_carousel', $style_carousel);

wp_enqueue_script('pearl-owl-filter');
wp_enqueue_style('owl-carousel2');

if($style_carousel == 'simple') {
    $classes = array('stm_projects_carousel', 'stm_projects_carousel__simple');
}

$atts['classes'] = $classes;

pearl_load_vc_element('projects', $atts, $style_carousel . '_carousel'); ?>