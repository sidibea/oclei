<?php
add_action( 'init', 'pearl_events_VC' );

function pearl_events_VC()
{
    vc_map(array(
        'name'     => esc_html__('Events List', 'pearl'),
        'base'     => 'stm_events_list',
        'icon'     => 'stmicon-flag',
        'category' => esc_html__('Content', 'pearl'),
		'description' => esc_html__('List of events posts', 'pearl'),
		'params'   => array(
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Number of posts', 'pearl'),
                'param_name' => 'posts_per_page',
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Show past events', 'pearl'),
                'param_name' => 'show_past',
                'std' => 'true'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Show upcoming events', 'pearl'),
                'param_name' => 'show_upcoming',
                'std' => 'true'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Enable Load more button', 'pearl'),
                'param_name' => 'load_more',
				'value' => array(
					esc_html__('Enable', 'pearl')  => 'true',
					esc_html__('Disable', 'pearl')  => 'false'
				),
                'std' => 'true'
            ),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Enable Pagination', 'pearl'),
				'param_name' => 'pagination',
				'dependency' => array(
					'element' => 'load_more',
					'value' =>  'false'
				),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Inverted', 'pearl'),
				'param_name' => 'inverted',
			),
			pearl_load_styles(8),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
        )
    ));

	vc_map(array(
		'name'     => esc_html__('Upcoming event', 'pearl'),
		'base'     => 'stm_upcoming_event',
		'icon'     => 'stmicon-flag',
		'category' => esc_html__('Content', 'pearl'),
		'params' => array(
			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('Button link', 'pearl'),
				'param_name' => 'link',
			),
			pearl_vc_add_css_editor()
		)
	));

	vc_map(array(
		'name'     => esc_html__('Upcoming events', 'pearl'),
		'base'     => 'stm_upcoming_events',
		'icon'     => 'stmicon-flag',
		'category' => esc_html__('Content', 'pearl'),
		'params' => array(
			pearl_vc_add_css_editor()
		)
	));

}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Events_List extends WPBakeryShortCode{}
    class WPBakeryShortCode_Stm_Upcoming_Event extends WPBakeryShortCode{}
    class WPBakeryShortCode_Stm_Upcoming_Events extends WPBakeryShortCode{}
}