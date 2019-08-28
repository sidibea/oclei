<?php


vc_map(array(
	'name'        => esc_html__('Pearl Icon list', 'pearl'),
	'description' => esc_html__('Place an <ul> list with custom icons', 'pearl'),
	'base'        => 'stm_iconlist',
	'icon'        => 'pearl-icon_list',
	'category' => array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl'),
	),
	'params'      => array(
		array(
			'type'       => 'textarea_html',
			'heading'    => esc_html__('Text', 'pearl'),
			'holder'     => 'div',
			'param_name' => 'content'
		),
		array(
			'type'       => 'iconpicker',
			'heading'    => esc_html__('Text icon', 'pearl'),
			'param_name' => 'icon',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Icon size (px)', 'pearl'),
			'param_name' => 'iconsize',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Line-height (px)', 'pearl'),
			'param_name' => 'line_height',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Select icon color', 'pearl'),
			'param_name' => 'icon_color',
			'value'      => array(
				esc_html__('Primary', 'pearl') => 'mtc',
				esc_html__('Secondary', 'pearl') => 'stc',
				esc_html__('Third', 'pearl') => 'ttc',
				esc_html__('White', 'pearl') => 'wtc',
			),
			'std'        => 'mtc'
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Margins between', 'pearl'),
			'param_name' => 'margins',
		),
		vc_map_add_css_animation(),
		pearl_vc_add_css_editor()
	)
));


if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Iconlist extends WPBakeryShortCode
	{
	}
}