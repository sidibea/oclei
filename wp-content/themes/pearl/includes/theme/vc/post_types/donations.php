<?php
vc_map(array(
		'name'                    => esc_html__('Pearl Donations', 'pearl'),
		'base'                    => 'stm_donations',
		'icon'                    => 'pearl-donation',
		'category'                => esc_html__('Content', 'pearl'),
		'description' => esc_html__('List of donation posts', 'pearl'),
		'show_settings_on_create' => false,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Number of services to display', 'pearl'),
				'param_name' => 'number',
				'std' => '9'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Enable Pagination', 'pearl'),
				'param_name'  => 'pagination',
				'value'       => array(
					esc_html__('Enable', 'pearl')      => 'on',
					esc_html__('Disable', 'pearl') => 'off',
				),
				'std' => 'on'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Image Size', 'pearl'),
				'param_name'  => 'img_size',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
			),
			pearl_load_styles(2),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		),
	)
);

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Donations extends WPBakeryShortCode{}
}