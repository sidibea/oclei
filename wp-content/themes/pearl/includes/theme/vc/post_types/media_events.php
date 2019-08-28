<?php


add_action('init', 'pearl_moduleVC_media_events');

function pearl_moduleVC_media_events()
{
	if (post_type_exists('stm_media_events')) {


		vc_map(array(
			'name'        => esc_html__('Pearl Media Events List', 'pearl'),
			'base'        => 'stm_media_events_list',
			'icon'        => 'stmicon-flag',
			'category'    => esc_html__('Content', 'pearl'),
			'description' => esc_html__('Text information', 'pearl'),
			'params'      => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Title', 'pearl'),
					'param_name' => 'title',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Posts number', 'pearl'),
					'description' => esc_html__('0 for all posts', 'pearl'),
					'param_name' => 'posts_per_page',
				),
				pearl_load_styles(1),
				vc_map_add_css_animation(),
				pearl_vc_add_css_editor()
			)
		));

		vc_map(array(
			'name'        => esc_html__('Pearl Media Events', 'pearl'),
			'base'        => 'stm_media_events',
			'icon'        => 'stmicon-flag',
			'category'    => esc_html__('Content', 'pearl'),
			'description' => esc_html__('Text information', 'pearl'),
			'params'      => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Number of posts', 'pearl'),
					'param_name' => 'posts_per_page'
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__('Show pagination', 'pearl'),
					'param_name' => 'pagination',
					'std' => 'true'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Image size', 'pearl'),
					'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
					'param_name' => 'img_size',
					'value' => '350x215'
				),
				pearl_load_styles(2),
				vc_map_add_css_animation(),
				pearl_vc_add_css_editor()
			)
		));


		if (class_exists('WPBakeryShortCode') && post_type_exists('stm_media_events')) {
			class WPBakeryShortCode_Stm_Media_Events_List extends WPBakeryShortCode
			{
			}
			class WPBakeryShortCode_Stm_Media_Events extends WPBakeryShortCode
			{
			}
		}
	}
}

