<?php
if (defined('OTW_PLUGIN_VERSION')) {
	vc_map(array(
		'name'   => esc_html__('Pearl Open Table Widget', 'pearl'),
		'base'   => 'stm_open_table',
		'icon'   => 'pearl-open_table',
		'description' => esc_html__('Table reservation module', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Title', 'pearl'),
				'param_name'  => 'title',
				'value'       => 'MAKE ONLINE RESERVATION',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Your Restaurant ID', 'pearl'),
				'param_name'  => 'restaurant_id',
				'value'       => '',
				'admin_label' => true
			),
			pearl_vc_add_css_editor(),
			vc_map_add_css_animation(),
		)
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_Stm_Open_Table extends WPBakeryShortCode
		{
		}
	}
}

