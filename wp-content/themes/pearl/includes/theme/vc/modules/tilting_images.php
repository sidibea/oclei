<?php
add_action('init', 'pearl_moduleVC_tilting_image');

function pearl_moduleVC_tilting_image()
{
    vc_map(array(
        'name'   => esc_html__('Pearl Tilting Images', 'pearl'),
        'base'   => 'stm_tilting_image',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Custom images block', 'pearl'),
		'params' => array(
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Image Top', 'pearl'),
                'param_name' => 'image_top'
            ),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Top Image Size', 'pearl'),
				'param_name' => 'img_size_top',
				'std' => '531x354',
				'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
			),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__('Image Bottom', 'pearl'),
				'param_name' => 'image_bottom'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Bottom Image Size', 'pearl'),
				'param_name' => 'img_size_bottom',
				'std' => '405x249',
				'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
			),
            //pearl_load_styles(1, 'style', true),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Tilting_Image extends WPBakeryShortCode
    {
    }
}
