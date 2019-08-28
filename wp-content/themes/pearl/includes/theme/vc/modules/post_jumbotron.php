<?php
add_action('init', 'pearl_moduleVC_post_jumbotron');

function pearl_moduleVC_post_jumbotron()
{
	$posts = array();
	$args = array(
		'posts_per_page' => -1,
	);

	$query = get_posts($args);

	/**
	 * @var $post WP_Post
	 */
	foreach ($query as $post) {
		$posts[$post->post_title] = $post->ID;
	}

	vc_map(array(
		'name'        => esc_html__('Single post jumbotron', 'pearl'),
		'base'        => 'stm_post_jumbotron',
		'icon'        => 'pearl-proj_det',
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Select post', 'pearl'),
				'param_name' => 'post',
				'value'      => $posts,
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Background color', 'pearl'),
				'param_name' => 'bgc',
				'value' => 'rgba(34,34,34,.5)'
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
			pearl_load_styles(1, 'style', true)
		),

	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Post_Jumbotron extends WPBakeryShortCode
	{
	}
}

