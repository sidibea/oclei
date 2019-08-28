<?php
add_action('init', 'pearl_moduleVC_breadcrumbs');

function pearl_moduleVC_breadcrumbs()
{
	vc_map(array(
		'name'   => esc_html__('Breadcrumbs NavXT', 'pearl'),
		'base'   => 'stm_breadcrumbs',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Display breadcrumbs', 'pearl'),
		'params' => array(
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Text color', 'pearl'),
				'param_name' => 'text_color'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Align', 'pearl'),
				'value' => array(
					esc_html__('Left', 'pearl') => 'left',
					esc_html__('Center', 'pearl') => 'center',
					esc_html__('Right', 'pearl') => 'right',
				),
				'std' => 'left',
				'param_name' => 'align'
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode') && function_exists('bcn_display')) {
	class WPBakeryShortCode_Stm_Breadcrumbs extends WPBakeryShortCode
	{
	}
}
