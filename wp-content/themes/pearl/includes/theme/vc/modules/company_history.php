<?php


vc_map(array(
	'name'                    => esc_html__('Pearl Company History', 'pearl'),
	'base'                    => 'stm_company_history',
	'as_parent'               => array('only' => 'stm_company_history_item'),
	'show_settings_on_create' => false,
	'icon' => 'pearl-company_history',
	'category' => array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl'),
	),
	'description' => esc_html__('Historical year and description', 'pearl'),
	'params'                  => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Title', 'pearl'),
			'param_name' => 'title',
			'holder'     => 'div'
		),
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__('Css', 'pearl'),
			'param_name' => 'css',
			'group'      => esc_html__('Design options', 'pearl')
		),
		pearl_load_styles(3)
	),
	'js_view'                 => 'VcColumnView'
));

vc_map(array(
	'name'     => esc_html__('Item', 'pearl'),
	'base'     => 'stm_company_history_item',
	'as_child' => array('only' => 'stm_company_history'),
	'params'   => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Year', 'pearl'),
			'param_name' => 'year'
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Title', 'pearl'),
			'param_name' => 'title',
			'holder'     => 'div'
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__('Description', 'pearl'),
			'param_name' => 'description'
		)
	)
));

if (class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_Stm_Company_History extends WPBakeryShortCodesContainer
	{
	}
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Company_History_Item extends WPBakeryShortCode
	{
	}
}
