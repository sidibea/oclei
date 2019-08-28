<?php

add_action( 'init', 'pearl_color_presentation_VC' );

function pearl_color_presentation_VC () {
	vc_map(array(
		'name'   => esc_html__('Pearl Color Presentation', 'pearl'),
		'base'   => 'stm_color_presentation',
		'icon'   => 'pearl-color',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Color presenation', 'pearl'),
		'params' => array(
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Color', 'pearl'),
				'param_name' => 'color',
				'value'      => ''
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Text 1', 'pearl'),
				'param_name' => 'text_1',
				'value'      => ''
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Text 2', 'pearl'),
				'param_name' => 'text_2',
				'value'      => ''
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Color_Presentation extends WPBakeryShortCode{}
}