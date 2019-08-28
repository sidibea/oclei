<?php
add_action('init', 'pearl_init_posts_video');

function pearl_init_posts_video()
{

	vc_map(array(
		'name'   => esc_html__('Pearl Posts Video', 'pearl'),
		'base'   => 'stm_posts_video',
		'icon'   => 'stmicon-bookmark',
		'description' => esc_html__('Widget with video of posts', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
            pearl_load_styles(1),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_Stm_Posts_Video extends WPBakeryShortCode
		{
		}
	}
}