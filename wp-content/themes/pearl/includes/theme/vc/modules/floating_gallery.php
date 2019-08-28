<?php
add_action('init', 'pearl_moduleVC_floating_gallery');


function pearl_moduleVC_floating_gallery() {
	vc_map(array(
		'name'   => esc_html__('Floating gallery', 'pearl'),
		'base'   => 'stm_floating_gallery',
		'icon'   => 'stmicon-film',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Floating carousel with images', 'pearl'),
		'params' => array(
			array(
				'type'       => 'attach_images',
				'heading'    => esc_html__('Images', 'pearl'),
				'param_name' => 'images'
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Floating_Gallery extends WPBakeryShortCode
	{
	}
}

