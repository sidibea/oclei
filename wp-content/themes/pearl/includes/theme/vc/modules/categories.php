<?php
add_action('init', 'pearl_moduleVC_categories');

function pearl_moduleVC_categories()
{
    vc_map(array(
        'name'   => esc_html__('Pearl Categories', 'pearl'),
        'base'   => 'stm_categories',
        'icon'   => 'pearl-contact',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Display Post Categories', 'pearl'),
		'params' => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Image Size', 'pearl'),
                'param_name'  => 'image_size',
                'std' => '255x120',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Number of categories', 'pearl'),
                'param_name'  => 'categories_number',
                'std' => '5',
                'description' => esc_html__('Enter number of categories', 'pearl')
            ),
            //pearl_load_styles(1, 'style', true),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Categories extends WPBakeryShortCode
    {
    }
}
