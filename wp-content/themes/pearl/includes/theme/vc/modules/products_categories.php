<?php
add_action('init', 'pearl_products_categories_VC');

function pearl_products_categories_VC()
{
	vc_map(array(
		'name'     => esc_html__('Pearl Products Categories', 'pearl'),
		'base'     => 'stm_products_categories',
		'icon'     => 'pearl-products_grid',
        'category' => array(
            esc_html__('Content', 'pearl'),
            esc_html__('Pearl', 'pearl'),
        ),
        'description' => esc_html__('Display Products Categories', 'pearl'),
		'params'   => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Number of Categories to display', 'pearl'),
				'param_name' => 'number',
				'std'        => '4'
			),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Image Size', 'pearl'),
                'param_name'  => 'image_size',
                'std' => '540x255',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items per row', 'pearl'),
                'param_name' => 'per_row',
                'value' => array(
                    esc_html__('1', 'pearl') => '1',
                    esc_html__('2', 'pearl') => '2'
                ),
                'std' => '2',
            ),
			pearl_load_styles(2, 'style', true),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Products_Categories extends WPBakeryShortCode
	{
	}
}