<?php

vc_map(array(
	'name'        => esc_html__('Pearl Icon', 'pearl'),
	'description' => esc_html__('Shows single icon', 'pearl'),
	'base'        => 'stm_icon',
	'icon'        => 'pearl-pearl_icon',
	'category' => array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl'),
	),
	'params'      => array(
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Icon link', 'pearl'),
            'param_name' => 'link',
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
			'std'        => 'mtc',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Enable icon gradient', 'pearl'),
			'param_name' => 'icon_gradient',
			'value'      => array(
				esc_html__('Enable', 'pearl') => 'enable',
				esc_html__('Disable', 'pearl') => 'disable'
			),
			'dependency' => array(
				'element' => 'icon_color',
				'value'   => array('custom')
			),
			'std'        => 'disable',
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Icon gradient first color', 'pearl'),
			'param_name' => 'icon_gradient_first_color',
			'dependency' => array(
				'element' => 'icon_gradient',
				'value'   => array('enable')
			)
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Icon gradient second color', 'pearl'),
			'param_name' => 'icon_gradient_second_color',
			'dependency' => array(
				'element' => 'icon_gradient',
				'value'   => array('enable')
			)
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Icon custom color', 'pearl'),
			'param_name' => 'icon_custom_color',
			'dependency' => array(
				'element' => 'icon_gradient',
				'value'   => array('disable')
			)
		),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Icon color on hover', 'pearl'),
            'param_name' => 'icon_custom_color_hover',
            'dependency' => array(
                'element' => 'icon_gradient',
                'value'   => array('disable')
            )
        ),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Icon align', 'pearl'),
			'param_name' => 'icon_align',
			'value'      => pearl_vc_align(),
			'std'        => 'left',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Icon size(px)', 'pearl'),
			'param_name' => 'height',
			'std'        => '40'
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Enable styled background', 'pearl'),
			'param_name' => 'icon_styled_bg',
			'value'      => array(
				esc_html__('Disable', 'pearl') => 'disable',
				esc_html__('Rounded shadow', 'pearl') => 'enable',
				esc_html__('Icon Round Background', 'pearl') => 'icon_round_bg',
			),
			'std'        => 'disable',
		),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Icon Background color', 'pearl'),
            'param_name' => 'icon_round_bg',
            'dependency' => array(
                'element' => 'icon_styled_bg',
                'value'   => array('icon_round_bg')
            )
        ),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Rounded background size(px)', 'pearl'),
			'param_name' => 'circle_height',
			'std'        => '100',
			'dependency' => array(
				'element' => 'icon_styled_bg',
				'value' => 'icon_round_bg'
			)
		),
		vc_map_add_css_animation(),
		pearl_vc_add_css_editor(),
	)
));

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Icon extends WPBakeryShortCode
	{
	}
}