<?php
add_action('init', 'pearl_moduleVC_post_list');

function pearl_moduleVC_post_list()
{
	$post_types = pearl_get_post_types();

	$params = array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Title', 'pearl'),
			'param_name' => 'title',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Post Source', 'pearl'),
			'param_name' => 'post_type',
			'value'      => $post_types,
			'std'        => 'post'
		),
	);

	foreach ($post_types as $post_type_name => $post_type) {
		$taxonomy = pearl_get_post_type_taxonomy($post_type);
		$terms = pearl_get_terms_vc($taxonomy);
		$params[] = array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Select category', 'pearl'),
			'param_name' => 'post_category_' . $post_type,
			'value'      => $terms,
			'dependency' => array(
				'element' => 'post_type',
				'value'   => array($post_type)
			)
		);
	}

	$params_end = array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Number of posts', 'pearl'),
			'param_name' => 'num',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Image Size', 'pearl'),
			'param_name'  => 'size',
			'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
		),
		pearl_load_styles(4),
		vc_map_add_css_animation(),
		pearl_vc_add_css_editor()
	);

	$params = array_merge($params, $params_end);


	vc_map(array(
		'name'        => esc_html__('Pearl Post Type List', 'pearl'),
		'base'        => 'stm_post_type_list',
		'icon'        => 'icon-wpb-wp',
		'description' => esc_html__('Widget with list of posts', 'pearl'),
		'category'    => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'      => $params
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Post_Type_List extends WPBakeryShortCode
	{
	}
}