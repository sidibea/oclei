<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

if (!empty($style)) {
	$style_path = get_template_directory_uri() . '/assets/css/vendors/slider_styles/' . $style . '.css';
	$theme_info = pearl_get_assets_path();

	wp_enqueue_style('stm_slider_style', $style_path, array('stm_slider'), $theme_info['v']);
}


if (empty($atts['slider_id'])) {
	echo 'Select slider';
	return;
}
$slide_id = $atts['slider_id'];

$slider_args = array(
	'slider_style' => $style
);

$slider = new Stm_Slider($slide_id, $slider_args);

$slides = $slider->print_slider();