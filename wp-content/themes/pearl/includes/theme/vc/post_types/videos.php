<?php
add_action('init', 'pearl_video_map');

function pearl_video_map()
{
	vc_map(array(
		'name'     => esc_html__('Pearl Videos List', 'pearl'),
		'base'     => 'stm_video_list',
		'description' => esc_html__('List of videos', 'pearl'),
		'icon'     => 'stmicon-flag',
		'category' => esc_html__('Content', 'pearl'),
		'params'   => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title', 'pearl'),
				'param_name' => 'title'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Video poster size', 'pearl'),
				'description' => esc_html__('Ex.: 1280x768', 'pearl'),
				'param_name' => 'img_size'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Show number', 'pearl'),
				'param_name' => 'number'
			),
			pearl_load_styles(2),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
		)
	));

	class WPBakeryShortCode_Stm_Video_List extends WPBakeryShortCode
	{
	}
}