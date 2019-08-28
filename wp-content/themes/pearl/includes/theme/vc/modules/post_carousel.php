<?php
add_action('init', 'pearl_init_posts_carousel');

function pearl_init_posts_carousel()
{

	$pages_data = array();
	if (is_admin()) {
		$pages = get_posts();
		foreach ($pages as $page) {
			$pages_data[] = array(
				'label' => $page->post_title,
				'value' => $page->ID
			);
		}
	}

	$post_formats = array(
		esc_html__('All') => 'all'
	);
	$available_post_formats = get_terms(array('taxonomy' => 'post_format'));
	if (!empty($available_post_formats)) {
		foreach ($available_post_formats as $post_format) {
			$post_formats[$post_format->name] = $post_format->slug;
		}
	}


	vc_map(array(
		'name'        => esc_html__('Pearl Posts Carousel', 'pearl'),
		'base'        => 'stm_posts_carousel',
		'icon'        => 'stmicon-bookmark',
		'description' => esc_html__('Widget with carousel of posts', 'pearl'),
		'category'    => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Image size', 'pearl'),
				'param_name' => 'img_size',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Title', 'pearl'),
				'param_name' => 'show_title',
				'std'        => 'true',
				'group'      => esc_html__('Content options', 'pearl'),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Post format', 'pearl'),
				'param_name' => 'post_format',
				'value'      => $post_formats,
				'std'        => 'all',
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Post filter', 'pearl'),
                'param_name' => 'post_filter',
                'value'      => array(
                    esc_html__('None', 'pearl')     => 'none',
                    esc_html__('Popular', 'pearl')  => 'top',
                    esc_html__('Hot', 'pearl')      => 'month',
                    esc_html__('Trending', 'pearl') => 'day',
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value'   => 'style_1'
                )
            ),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Select order', 'pearl'),
				'param_name' => 'order',
				'value'      => array(
					esc_html__('Last', 'pearl')          => 'date',
					esc_html__('Random', 'pearl')        => 'rand',
					esc_html__('Custom select', 'pearl') => 'custom',
				),
				'std'        => 'last',
			),
			array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__('Include', 'pearl'),
				'param_name'  => 'include',
				'description' => esc_html__('Enter posts titles to include', 'pearl'),
				'admin_label' => true,
				'settings'    => array(
					'multiple'       => true,
					'sortable'       => true,
					'min_length'     => 1,
					'no_hide'        => true,
					'unique_values'  => true,
					'display_inline' => true,
					'values'         => $pages_data
				),
				'dependency'  => array(
					'element' => 'order',
					'value'   => 'custom'
				)
			),
			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('All news page link', 'pearl'),
				'param_name' => 'link',
				'dependency' => array(
					'element' => 'style',
					'value'   => 'style_4'
				)
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Category', 'pearl'),
				'param_name' => 'show_category',
				'std'        => 'true',
				'group'      => esc_html__('Content options', 'pearl'),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Excerpt', 'pearl'),
				'param_name' => 'show_excerpt',
				'std'        => 'true',
				'group'      => esc_html__('Content options', 'pearl'),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Views', 'pearl'),
				'param_name' => 'show_views',
				'std'        => 'true',
				'group'      => esc_html__('Content options', 'pearl'),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Comments', 'pearl'),
				'param_name' => 'show_comments',
				'std'        => 'true',
				'group'      => esc_html__('Content options', 'pearl'),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Date', 'pearl'),
				'param_name' => 'show_date',
				'std'        => 'true',
				'group'      => esc_html__('Content options', 'pearl'),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Colums number in Desktop', 'pearl'),
				'param_name' => 'number_row_desktop',
				'std'        => 4,
				'dependency' => array(
					'element' => 'style',
					'value'   => array('style_1', 'style_5', 'style_6')
				),
				'group'      => esc_html__('Carousel Settings', 'pearl')
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Columns number in Laptop', 'pearl'),
				'param_name' => 'number_row_laptop',
				'std'        => 3,
				'dependency' => array(
					'element' => 'style',
					'value'   => array('style_1', 'style_5', 'style_6')
				),
				'group'      => esc_html__('Carousel Settings', 'pearl')
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Columns number in Tablet', 'pearl'),
				'param_name' => 'number_row_tablet',
				'std'        => 2,
				'dependency' => array(
					'element' => 'style',
					'value'   => array('style_1', 'style_5', 'style_6')
				),
				'group'      => esc_html__('Carousel Settings', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Arrows', 'pearl'),
				'param_name' => 'arrows',
				'value'      => array(
					esc_html__('Yes', 'pearl') => 'true',
					esc_html__('No', 'pearl')  => 'false',
				),
				'std'        => 'false',
				'dependency' => array(
					'element' => 'style',
					'value'   => array('style_5')
				),
				'group'      => esc_html__('Carousel Settings', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Bullets', 'pearl'),
				'param_name' => 'bullets',
				'value'      => array(
					esc_html__('Yes', 'pearl') => 'true',
					esc_html__('No', 'pearl')  => 'false',
				),
				'std'        => 'true',
				'dependency' => array(
					'element' => 'style',
					'value'   => array('style_1', 'style_5', 'style_6')
				),
				'group'      => esc_html__('Carousel Settings', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Autoplay', 'pearl'),
				'param_name' => 'autoscroll',
				'value'      => array(
					esc_html__('Yes', 'pearl') => 'true',
					esc_html__('No', 'pearl')  => 'false',
				),
				'std'        => 'true',
				'dependency' => array(
					'element' => 'style',
					'value'   => array('style_1', 'style_5', 'style_6')
				),
				'group'      => esc_html__('Carousel Settings', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Loop', 'pearl'),
				'param_name' => 'loop',
				'value'      => array(
					esc_html__('Yes', 'pearl') => 'true',
					esc_html__('No', 'pearl')  => 'false',
				),
				'std'        => 'true',
				'dependency' => array(
					'element' => 'style',
					'value'   => array('style_1', 'style_5', 'style_6')
				),
				'group'      => esc_html__('Carousel Settings', 'pearl')
			),
			pearl_load_styles(6),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_Stm_Posts_Carousel extends WPBakeryShortCode
		{
		}
	}
}