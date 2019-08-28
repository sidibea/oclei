<?php
add_action('init', 'pearl_moduleVc_recent_posts');


function pearl_moduleVc_recent_posts() {
	$post_formats = pearl_get_available_post_formats();
	vc_map(
		array(
			'name'   => esc_html__('Pearl Recent posts widget', 'pearl'),
			'base'   => 'stm_recent_posts',
			'icon'   => 'icon-wpb-wp',
			'category'    => esc_html__('Pearl Widgets', 'pearl'),
			'description' => esc_html__('Recent posts widget', 'pearl'),
			'category' =>array(
				esc_html__('Content', 'pearl'),
				esc_html__('Pearl', 'pearl')
			),
			'category' =>array(
				esc_html__('Content', 'pearl'),
				esc_html__('Pearl', 'pearl')
			),
			'params' => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'pearl'),
					'admin_label' => true,
					'param_name'  => 'title'
				),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Number of posts to show', 'pearl'),
                    'admin_label' => false,
                    'param_name'  => 'number'
                ),
				array(
					'type' => 'dropdown',
					'heading'     => esc_html__('Post format', 'pearl'),
					'param_name'  => 'post_format',
					'value' => $post_formats
				),
				array(
					'type' => 'dropdown',
					'heading'     => esc_html__('Display post date', 'pearl'),
					'param_name'  => 'show_date',
					'value' => array(
						esc_html__('Enable', 'pearl')  => true,
						esc_html__('Disable', 'pearl')  => false,
					)
				),
				array(
					'type' => 'dropdown',
					'heading'     => esc_html__('Display post image', 'pearl'),
					'param_name'  => 'show_image',
					'value' => array(
						esc_html__('Enable', 'pearl')  => true,
						esc_html__('Disable', 'pearl')  => false,
					)
				),
				pearl_load_styles(10),
                pearl_vc_add_css_editor()
			)
		)
	);
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Recent_Posts extends WPBakeryShortCode
	{
	}
}