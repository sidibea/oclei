<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_posttimeline');
$classes[] = 'stm_posttimeline_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
pearl_add_element_style('posttimeline', $style);

$atts['classes'] = $classes;

pearl_load_vc_element('timeline', $atts, $style);