<?php
add_action('init', 'pearl_init_posts_list');

function pearl_init_posts_list()
{
	$post_types = pearl_get_post_types();
	$post_formats = pearl_get_available_post_formats();



	vc_map(array(
		'name'   => esc_html__('Pearl Posts List', 'pearl'),
		'base'   => 'stm_posts_list',
		'icon'   => 'stmicon-bookmark',
		'description' => esc_html__('Widget with list of posts', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title', 'pearl'),
				'param_name' => 'title',
				'weight' => '3',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Posts Source', 'pearl'),
				'param_name' => 'post_type',
				'value'      => $post_types,
				'std'        => 'post',
                'weight' => '2',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Posts Format', 'pearl'),
				'param_name' => 'post_format',
				'value'      => $post_formats,
				'std'        => 'all',
				'weight' => '2',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Category ID', 'pearl'),
				'param_name' => 'category',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Image size', 'pearl'),
				'param_name' => 'img_size',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Number of posts', 'pearl'),
				'param_name' => 'num',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Image', 'pearl'),
				'param_name' => 'show_image',
				'std'        => 'true',
                'group'       => esc_html__( 'Content options', 'pearl' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Title', 'pearl'),
				'param_name' => 'show_title',
				'std'        => 'true',
                'group'       => esc_html__( 'Content options', 'pearl' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Excerpt', 'pearl'),
				'param_name' => 'show_excerpt',
				'std'        => 'true',
                'group'       => esc_html__( 'Content options', 'pearl' ),
			),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Show Views', 'pearl'),
                'param_name' => 'show_views',
                'std'        => 'true',
                'dependency' => array(
                    'element' => 'style',
                    'value'   => array('style_10', 'style_11')
                ),
                'group'       => esc_html__( 'Content options', 'pearl' ),
            ),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Comments', 'pearl'),
				'param_name' => 'show_comments',
				'std'        => 'true',
                'group'       => esc_html__( 'Content options', 'pearl' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Order by', 'pearl'),
				'param_name' => 'orderby',
				'std'        => 'true',
				'group'       => esc_html__( 'Content options', 'pearl' ),
				'value'      => array(
					esc_html__('Date', 'pearl')   => '',
					esc_html__('Random', 'pearl')   => 'rand',
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show Date', 'pearl'),
				'param_name' => 'show_date',
				'std'        => 'true',
                'group'       => esc_html__( 'Content options', 'pearl' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Enable pagination', 'pearl'),
				'param_name' => 'pagination',
                'group'       => esc_html__( 'Content options', 'pearl' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Pagination style', 'pearl'),
				'param_name' => 'pagination_style',
				'value'      => array(
					esc_html__('Default', 'pearl')   => 'default',
					esc_html__('Ajax', 'pearl')   => 'ajax',
				),
				'std' => 'default',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Columns', 'pearl'),
				'param_name' => 'cols',
				'value'      => array(
					esc_html__('1', 'pearl')   => '1',
					esc_html__('2', 'pearl')   => '2',
					esc_html__('3', 'pearl')   => '3',
					esc_html__('4', 'pearl')   => '4'
				),
				'std' => '1',
				'dependency' => array(
					'element' => 'style',
					'value' => array('style_12', 'style_17', 'style_18')
				)
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Offset', 'pearl'),
				'param_name' => 'posts_offset',
				'value' => '',
				'dependency' => array(
					'element' => 'style',
					'value' => array('style_17')
				)
			),

			pearl_load_styles(18),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_Stm_Posts_List extends WPBakeryShortCode
		{
		}
	}
}