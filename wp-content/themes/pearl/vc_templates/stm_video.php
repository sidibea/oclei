<?php

/**
 *
 * @var $url
 * @var $height
 * @var $style
 * @var $css
 * @var $image
 * @var $css_animation
 */

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_video');
$classes[] = 'stm_video_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
pearl_add_element_style('video', $style);

$view = 'popup';

if (!empty($view_type) and $view_type == 'window') {
	$classes[] = 'stm_embed_iframe';
	wp_enqueue_script('pearl_video_frame');
} else {
	$classes[] = 'stm_lightgallery__iframe';
}
if (!empty($image)) {
	$classes[] = 'has_cover';
}
$atts['classes'] = $classes;


wp_enqueue_style('lightgallery');
wp_enqueue_script('lightgallery.js');



pearl_load_vc_element('video_single', $atts, $style);

