<?php
add_action('init', 'pearl_moduleVC_sliding_image');

function pearl_moduleVC_sliding_image()
{
	vc_map(array(
		'name' => esc_html__('Pearl Sliding Images', 'pearl'),
		'base' => 'stm_sliding_image',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Custom images block', 'pearl'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image Left', 'pearl'),
				'param_name' => 'image_left'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Left Image Size', 'pearl'),
				'param_name' => 'img_size_left',
				'std' => '257x555',
				'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image Right', 'pearl'),
				'param_name' => 'image_right'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Right Image Size', 'pearl'),
				'param_name' => 'img_size_right',
				'std' => '273x546',
				'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
			),
			pearl_load_styles(2, 'style', true),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Sliding_Image extends WPBakeryShortCode
	{
	}
}
