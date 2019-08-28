<?php

add_action('init', 'pearl_moduleVC_pricing_table');

function pearl_moduleVC_pricing_table()
{
	vc_map(array(
		'name'   => esc_html__('Pearl Pricing Tables', 'pearl'),
		'base'   => 'stm_pricing_tables',
		'icon'   => 'stm_icon_box',
		'description' => esc_html__('Table with prices', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title', 'pearl'),
				'param_name' => 'title'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Prefix', 'pearl'),
				'param_name' => 'price_prefix'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Price', 'pearl'),
				'param_name' => 'price'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Separator', 'pearl'),
				'param_name' => 'price_separator'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Postfix', 'pearl'),
				'param_name' => 'price_postfix'
			),
			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('Button', 'pearl'),
				'param_name' => 'button'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Label Text', 'pearl'),
				'param_name' => 'label_text'
			),
			array(
				'type'       => 'textarea_html',
				'heading'    => esc_html__('Text', 'pearl'),
				'param_name' => 'content'
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
			pearl_load_styles(4, 'style', true)
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Pricing_Tables extends WPBakeryShortCode
	{
	}
}