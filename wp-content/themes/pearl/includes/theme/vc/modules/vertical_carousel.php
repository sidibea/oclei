<?php
vc_map(array(
    'name'        => esc_html__('Pearl Vertical carousel', 'pearl'),
    'base'        => 'stm_vertical_carousel',
	'icon'   => 'stmicon-film',
	'description' => esc_html__('Vertical carousel with images', 'pearl'),
	'category' =>array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl')
	),
	'category'    => esc_html__('Content', 'pearl'),
    'params'      => array(
        array(
            'type'        => 'attach_images',
            'heading'     => esc_html__('Select images', 'pearl'),
            'param_name'  => 'images',
            'admin_label' => false,
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Image Size', 'pearl'),
            'param_name'  => 'image_size',
            'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl'),
            'std' => '205x154'
        ),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Tablet images number', 'pearl'),
			'param_name'  => 'tablet_number',
			'std' => '4'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Mobile images number', 'pearl'),
			'param_name'  => 'mobile_number',
			'std' => '3'
		),
        vc_map_add_css_animation(),
        pearl_vc_add_css_editor(),
    )
));

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Vertical_Carousel extends WPBakeryShortCode
    {
    }
}

