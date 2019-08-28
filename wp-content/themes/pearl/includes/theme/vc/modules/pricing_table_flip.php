<?php

add_action('init', 'pearl_moduleVC_pricing_table_flip');

function pearl_moduleVC_pricing_table_flip()
{
	vc_map(array(
		'name'   => esc_html__('Pearl Pricing Tables With Flip Effect', 'pearl'),
		'base'   => 'stm_pricing_tables_flip',
		'icon'   => 'stm_icon_box',
		'description' => esc_html__('Table with prices', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__('Image', 'pearl'),
				'param_name' => 'image'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title', 'pearl'),
				'param_name' => 'title'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Price', 'pearl'),
				'param_name' => 'price'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Subtitle', 'pearl'),
				'param_name' => 'subtitle'
			),
			array(
				'type'       => 'textarea_html',
				'heading'    => esc_html__('Text', 'pearl'),
				'param_name' => 'content'
			),
			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('Button', 'pearl'),
				'param_name' => 'button'
			),
			array(
				'type'       => 'iconpicker',
				'heading'    => esc_html__('Icon', 'pearl'),
				'param_name' => 'icon',
			),
            pearl_load_styles(2, 'style', true),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Pricing_Tables_Flip extends WPBakeryShortCode
	{
	}
}