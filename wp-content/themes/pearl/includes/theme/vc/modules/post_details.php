<?php
add_action('init', 'pearl_moduleVC_post_details');

function pearl_moduleVC_post_details()
{
	vc_map(array(
		'name'        => esc_html__('Single post details', 'pearl'),
		'base'        => 'stm_post_details',
		'icon'        => 'pearl-proj_det',
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'      => array(
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
			pearl_load_styles(1, 'style', true)
		),

	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Post_Details extends WPBakeryShortCode
	{
	}
}

