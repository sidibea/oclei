<?php
add_action('init', 'pearl_image_posts_slider');

function pearl_image_posts_slider()
{
	$args = array(
		'name'   => esc_html__('Pearl Image Posts Slider', 'pearl'),
		'base'   => 'stm_image_posts_slider',
		'icon'   => 'stmicon-post',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Image Posts Slider', 'pearl'),
		'params' => array(
			array(
				'type'       => 'param_group',
				'heading'    => esc_html__('Images', 'pearl'),
				'param_name' => 'images',
				'value'      => urlencode(json_encode(array(
					array(
						'label'       => esc_html__('Image Title', 'pearl'),
						'admin_label' => true
					),
					array(
						'label'       => esc_html__('Image Content', 'pearl'),
						'admin_label' => false
					),
					array(
						'label'       => esc_html__('Select image', 'pearl'),
						'admin_label' => false
					),
				))),
				'params'     => array(
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__('Image title', 'pearl'),
						'param_name'  => 'title',
						'admin_label' => true,
					),
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__('Image content', 'pearl'),
						'param_name'  => 'content',
						'admin_label' => false,
					),
					array(
						'type'        => 'attach_images',
						'heading'     => esc_html__('Select image', 'pearl'),
						'param_name'  => 'image',
						'admin_label' => false,
					),
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Image size', 'pearl'),
				'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
				'param_name'  => 'img_size',
				'value'       => '350x240',
				'std'         => '350x240'
			),
			array(
				'type' => 'dropdown',
				'heading'     => esc_html__('Accent color', 'pearl'),
				'param_name'  => 'color',
				'value' => pearl_vc_colors(),
				'std' => 'mtc'
			),
			array(
				'type' => 'colorpicker',
				'heading'     => esc_html__('Custom accent color', 'pearl'),
				'param_name'  => 'custom_color',
				'value' => '#222222',
				'std' => '#222222',
				'dependency' => array(
					'element' => 'color',
					'value' => 'custom'
				)
			),
			pearl_load_styles(1, 'style', true),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
		)
	);
	vc_map($args);
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Image_Posts_Slider extends WPBakeryShortCode{}
}