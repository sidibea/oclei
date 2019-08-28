<?php
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
	extract( $atts );


	if (empty($atts['slider_id'])) {
		echo 'Select slider';
		return;
	}

	$slide_id = $atts['slider_id'];

	$slider = new Stm_Slider($slide_id);

	$slides = $slider->print_slider();