<?php

$icon_sizes = range(8, 60);

vc_map(array(
	'name'        => esc_html__('Pearl Icon separator', 'pearl'),
	'description' => esc_html__('Divider line with icon', 'pearl'),
	'base'        => 'stm_icon_separator',
	'icon'        => 'pearl-icon_separator',
	'category' => array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl'),
	),
	'params'      => array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Border color', 'pearl'),
			'param_name' => 'border_color',
			'value'      => array(
				esc_html__('Primary', 'pearl')   => 'mbdc_a mbdc_b',
				esc_html__('Secondary', 'pearl') => 'sbdc_a sbdc_b',
				esc_html__('Third', 'pearl')     => 'tbdc_a tbdc_b',
				esc_html__('Custom', 'pearl')    => 'custom',
			),
			'std'        => 'mbdc_a mbdc_b',
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Custom border color', 'pearl'),
			'param_name' => 'border_custom_color',
			'dependency' => array(
				'element' => 'border_color',
				'value'   => 'custom'
			)
		),
		array(
			'type'       => 'iconpicker',
			'heading'    => esc_html__('Icon', 'pearl'),
			'param_name' => 'icon',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Icon color', 'pearl'),
			'param_name' => 'icon_color',
			'value'      => pearl_vc_colors(),
			'std'        => 'mbc',
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Custom icon color', 'pearl'),
			'param_name' => 'icon_custom_color',
			'dependency' => array(
				'element' => 'icon_color',
				'value'   => array('custom')
			)
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Icon size', 'pearl'),
			'param_name' => 'icon_size',
			'value' => array_combine($icon_sizes, $icon_sizes),
			'std'        => 16
		),
		pearl_load_styles(1),
		pearl_vc_add_css_editor(),
		vc_map_add_css_animation()
	)
));


if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Icon_Separator extends WPBakeryShortCode
	{
	}
}