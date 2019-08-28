<?php

vc_map(array(
	'name'        => esc_html__('Pearl Separator', 'pearl'),
	'description' => esc_html__('Divider line', 'pearl'),
	'category' =>array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl')
	),
	'base'        => 'stm_separator',
	'icon'        => 'pearl-pearl_separator',
	'category'    => esc_html__('Content', 'pearl'),
	'params'      => array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Color', 'pearl'),
			'param_name' => 'color',
			'value'      => pearl_vc_bg_colors(),
			'std'        => 'mbc',
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Custom color', 'pearl'),
			'param_name' => 'custom_color',
			'dependency' => array(
				'element' => 'color',
				'value'   => array('custom')
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Separator width', 'pearl'),
			'admin_label' => false,
			'param_name'  => 'sep_width'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Separator height', 'pearl'),
			'admin_label' => false,
			'param_name'  => 'sep_height'
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__('Align', 'pearl'),
			'param_name' => 'align',
			'value'      => pearl_vc_align(),
			'std'        => 'left',
			'dependency' => array(
				'element' => 'style',
				'value'   => 'style_1'
			)
		),
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__('Separator Design options', 'pearl'),
			'param_name' => 'sep_css',
			'group' => esc_html__('Separator Design', 'pearl')
		),
        pearl_load_styles(4),
		pearl_vc_add_css_editor(),
	)
));


if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Stm_Separator extends WPBakeryShortCode {
	}
}