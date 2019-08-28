<?php

vc_map(array(
	'name'        => esc_html__('Pearl Call to action', 'pearl'),
	'base'        => 'stm_cta',
	'icon'        => 'pearl-call2action',
	'category'    => array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl'),
	),
	'description' => esc_html__('Text and button', 'pearl'),
	'params'      => array(
		array(
			'type'       => 'textarea_html',
			'heading'    => esc_html__('Text', 'pearl'),
			'holder'     => 'div',
			'param_name' => 'content'
		),
		array(
			'type'       => 'vc_link',
			'heading'    => esc_html__('Button link', 'pearl'),
			'param_name' => 'link',
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Button color scheme', 'pearl'),
			'param_name' => 'button_color',
			'value'      => array(
				esc_html__('Primary', 'pearl')   => 'primary',
				esc_html__('Secondary', 'pearl') => 'secondary',
				esc_html__('White', 'pearl')     => 'white',
				esc_html__('Custom', 'pearl')    => 'custom',
			),
			'std'        => 'primary',
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Button size', 'pearl'),
			'param_name' => 'button_size',
			'value'      => array(
				esc_html__('Normal', 'pearl') => '',
				esc_html__('Small', 'pearl')  => 'btn_sm',
				esc_html__('Large', 'pearl')  => 'btn_lg',
			),
			'std'        => '',
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		/*Choose button custom color*/
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Button Custom Color', 'pearl'),
			'param_name' => 'button_custom_color',
			'value'      => '',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => 'custom'
			),
			'group'      => esc_html__('CTA Button', 'pearl')

		),
		/*Choose button custom color hover*/
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Button Custom Color on hover', 'pearl'),
			'param_name' => 'button_custom_color_hover',
			'value'      => '',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => 'custom'
			),
			'group'      => esc_html__('CTA Button', 'pearl')

		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Button Custom Border Color', 'pearl'),
			'param_name' => 'button_custom_border_color',
			'value'      => '',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => 'custom'
			),
			'group'      => esc_html__('CTA Button', 'pearl')

		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Button Custom Border Color on hover', 'pearl'),
			'param_name' => 'button_custom_border_color_hover',
			'value'      => '',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => 'custom'
			),
			'group'      => esc_html__('CTA Button', 'pearl')

		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Button Custom Text Color', 'pearl'),
			'param_name' => 'button_custom_text_color',
			'value'      => '#ffffff',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => 'custom'
			),
			'group'      => esc_html__('CTA Button', 'pearl')

		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Button Custom Text Color on hover', 'pearl'),
			'param_name' => 'button_custom_text_color_hover',
			'value'      => '',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => 'custom'
			),
			'group'      => esc_html__('CTA Button', 'pearl')

		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Icon Custom Color', 'pearl'),
			'param_name' => 'icon_custom_color',
			'value'      => '',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => 'custom'
			),
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Icon Custom Color on hover', 'pearl'),
			'param_name' => 'icon_custom_color_hover',
			'value'      => '',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => 'custom'
			),
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Button style', 'pearl'),
			'param_name' => 'button_style',
			'value'      => array(
				esc_html__('Solid', 'pearl')   => 'solid',
				esc_html__('Outline', 'pearl') => 'outline'
			),
			'std'        => 'solid',
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Button icon position', 'pearl'),
			'param_name' => 'button_icon_pos',
			'value'      => array(
				esc_html__('None', 'pearl')  => '',
				esc_html__('Left', 'pearl')  => 'left',
				esc_html__('Right', 'pearl') => 'right',
			),
			'std'        => 'none',
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		array(
			'type'       => 'iconpicker',
			'heading'    => esc_html__('Button icon', 'pearl'),
			'param_name' => 'button_icon',
			'value'      => '',
			'dependency' => array(
				'element'   => 'button_icon_pos',
				'not_empty' => true
			),
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Icon size', 'pearl'),
			'param_name' => 'button_icon_size',
			'value'      => '20',
			'std'        => '20',
			'dependency' => array(
				'element'   => 'button_icon_pos',
				'not_empty' => true
			),
			'group'      => esc_html__('CTA Button', 'pearl')
		),
		vc_map_add_css_animation(),
		pearl_vc_add_css_editor(),
		pearl_load_styles(6)
	)
));

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Cta extends WPBakeryShortCode
	{
	}
}