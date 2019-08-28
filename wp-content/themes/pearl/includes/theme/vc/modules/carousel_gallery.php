<?php


add_action('init', 'pearl_moduleVC_carousel_gallery');


function pearl_moduleVC_carousel_gallery()
{
	vc_map(array(
		'name' => esc_html__('Pearl Carousel Gallery', 'pearl'),
		'base' => 'stm_carousel_gallery',
		'icon' => 'stmicon-film',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Animated carousel with images', 'pearl'),
		'params' => array(
			array(
				'type' => 'attach_images',
				'heading' => esc_html__('Images', 'pearl'),
				'param_name' => 'images'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Image effect', 'pearl'),
				'param_name' => 'images_effect',
				'value' => array(
					esc_html__('None', 'pearl') => 0,
					esc_html__('Grayscale', 'pearl') => 'grayscale',
					esc_html__('Opacity', 'pearl') => 'opacity',
				)
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Image Size', 'pearl'),
				'param_name' => 'image_size',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Carousel width', 'pearl'),
				'param_name' => 'carousel_width',
				'description' => esc_html__('Enter carousel width. Ex. : 500px or 70%', 'pearl')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable LightGallery', 'pearl'),
				'param_name' => 'lightgallery',
				'value' => array(
					esc_html__('Enable', 'pearl') => 'enable',
					esc_html__('Disable', 'pearl') => 'disable'
				),
				'std' => 'enable',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable Border', 'pearl'),
				'param_name' => 'bordered',
				'value' => array(
					esc_html__('Disable', 'pearl') => 'disable',
					esc_html__('Enable', 'pearl') => 'enable',
				),
				'std' => 'disable',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable Retina', 'pearl'),
				'param_name' => 'retina',
				'value' => array(
					esc_html__('Disable', 'pearl') => 'disable',
					esc_html__('Enable', 'pearl') => 'enable',
				),
				'std' => 'disable',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Visible images', 'pearl'),
				'param_name' => 'images_qty',
				'description' => esc_html__('Images to show', 'pearl'),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => '1'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Margin between images', 'pearl'),
				'param_name' => 'images_margin',
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => '0'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable Autoscroll', 'pearl'),
				'param_name' => 'autoscroll',
				'value' => array(
					esc_html__('Enable', 'pearl') => 'enable',
					esc_html__('Disable', 'pearl') => 'disable'
				),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => 'enable',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable Navigation', 'pearl'),
				'param_name' => 'navigation',
				'value' => array(
					esc_html__('Enable', 'pearl') => 'enable',
					esc_html__('Disable', 'pearl') => 'disable'
				),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => 'enable',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable thumbnails', 'pearl'),
				'param_name' => 'thumbnails',
				'value' => array(
					esc_html__('Enable', 'pearl') => 'enable',
					esc_html__('Disable', 'pearl') => 'disable'
				),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => 'enable',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Number of thumbnail in a row', 'pearl'),
				'param_name' => 'thumbnails_num',
				'description' => esc_html__('Enter number of visible thumbnails', 'pearl'),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'dependency' => array(
					'element' => 'thumbnails',
					'value' => 'enable'
				)
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Image Size', 'pearl'),
				'param_name' => 'image_size_small',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl'),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'dependency' => array(
					'element' => 'thumbnails',
					'value' => 'enable'
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable image description', 'pearl'),
				'param_name' => 'description',
				'value' => array(
					esc_html__('Enable', 'pearl') => 'enable',
					esc_html__('Disable', 'pearl') => 'disable'
				),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => 'enable',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable pagination', 'pearl'),
				'param_name' => 'pagination',
				'value' => array(
					esc_html__('Enable', 'pearl') => 'enable',
					esc_html__('Disable', 'pearl') => 'disable'
				),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => 'enable',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable dots', 'pearl'),
				'param_name' => 'dots',
				'value' => array(
					esc_html__('Enable', 'pearl') => 'enable',
					esc_html__('Disable', 'pearl') => 'disable'
				),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => 'disable',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Dots position', 'pearl'),
				'param_name' => 'dots_pos',
				'value' => array(
					esc_html__('Bottom', 'pearl') => 'bottom',
					esc_html__('Right', 'pearl') => 'right'
				),
				'dependency' => array(
					'element' => 'dots',
					'value' => 'enable'
				),
				'group' => esc_html__('Carousel Settings', 'pearl'),
				'std' => 'bottom',
			),
			vc_map_add_css_animation(),
			pearl_load_styles(10),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Carousel_Gallery extends WPBakeryShortCode
	{
	}
}

