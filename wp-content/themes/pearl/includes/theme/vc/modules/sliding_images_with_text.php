<?php
add_action('init', 'pearl_moduleVC_sliding_image_with_text');

function pearl_moduleVC_sliding_image_with_text()
{
    vc_map(array(
        'name'   => esc_html__('Pearl Sliding Image with Text', 'pearl'),
        'base'   => 'stm_sliding_image_with_text',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Custom images block', 'pearl'),
		'params' => array(
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__('Image', 'pearl'),
				'param_name' => 'image_right'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Image Size', 'pearl'),
				'param_name' => 'img_size_right',
				'std' => '470x433',
				'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
			),
			array(
				'type'       => 'textarea_html',
				'heading'    => esc_html__('Text', 'pearl'),
				'holder'     => 'div',
				'param_name' => 'content'
			),
            //pearl_load_styles(1, 'style', true),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Sliding_Image_With_Text extends WPBakeryShortCode
    {
    }
}
