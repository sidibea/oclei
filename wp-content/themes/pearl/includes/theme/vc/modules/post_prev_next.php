<?php

add_action( 'init', 'pearl_prev_next_VC' );

function pearl_prev_next_VC () {
	vc_map(array(
		'name'   => esc_html__('Pearl Posts Prev and Next Thumbnails', 'pearl'),
		'base'   => 'stm_post_prev_next',
		'icon'   => 'stmicon-bookmark',
		'description' => esc_html__('Displays post prev and next links with thumbnails', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
			pearl_load_styles(2),
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Post_Prev_Next extends WPBakeryShortCode{}
}