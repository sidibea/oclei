<?php
add_action('init', 'pearl_moduleVC_categories_tabs');

function pearl_moduleVC_categories_tabs()
{

	$args = array(
		'taxonomy' => 'category'
	);
	$categories =  pearl_autocomplete_terms();
	$post_types = pearl_get_post_types();
	$categories_data= array();


	/** @var  $category WP_Term */
	/*foreach ($categories as $category) {
		$categories_data[] = array(
			'label' => $category->name,
			'value' => $category->term_id
		);
	}*/

vc_map(array(
		'name'   => esc_html__('Pearl Categories Tabs', 'pearl'),
		'base'   => 'stm_categories_tabs',
		'icon'   => 'pearl-contact',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'params' => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Title', 'pearl'),
				'param_name'  => 'title',
				'value' => 'JUST POSTED',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Image Size', 'pearl'),
				'param_name'  => 'image_size',
				'std' => '255x162 ',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Post Type', 'pearl'),
				'param_name' => 'post_type',
				'value'      => $post_types,
				'std' => 'posts'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Posts per tab', 'pearl'),
				'param_name'  => 'posts_number',
				'std' => 4,
				'value' => 4
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show "All" tab', 'pearl'),
				'param_name' => 'all_tab',
				'value'      => 'true',
				'std' => 'true'
			),
			array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__('Select Categories', 'pearl'),
				'param_name'  => 'categories',
				'description' => esc_html__('Enter categoires names', 'pearl'),
				'admin_label' => true,
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'min_length' => 1,
					'no_hide' => true,
					'unique_values' => true,
					'display_inline' => true,
					'values' => $categories
				)
			),
			pearl_load_styles(2, 'style', true),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Categories_Tabs extends WPBakeryShortCode
	{
	}
}
