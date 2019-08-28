<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
if(!empty($atts['css_animation'])) {
	$atts['anim'] = pearl_vpb_animate_style($atts['css_animation']);
} else {
	$atts['anim'] = '';
}

$style = $atts['style'] = !empty($atts['carousel_style']) ? sanitize_text_field($atts['carousel_style']) : 'style_1';
$atts['content'] = !empty($content) ? $content : '';

pearl_add_element_style('services_carousel', $style);

pearl_load_vc_element('services_carousel', $atts, $style);