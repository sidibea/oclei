<?php
add_action('init', 'pearl_moduleVC_stats_counter');

function pearl_moduleVC_stats_counter()
{
	vc_map(array(
		'name' => esc_html__('Pearl Stats Counter', 'pearl'),
		'description' => esc_html__('Counters with statistics', 'pearl'),
		'base' => 'stm_stats_counter',
		'icon' => 'stmicon-dashboard',
		'category' => esc_html__('Content', 'pearl'),
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => esc_html__('Title', 'pearl'),
				'param_name' => 'title'
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__('Icon', 'pearl'),
				'param_name' => 'icon',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Icon Color', 'pearl'),
				'param_name' => 'icon_class',
				'value' => array(
					esc_html__('Main color', 'pearl') => 'mtc',
					esc_html__('Secondary color', 'pearl') => 'stc',
					esc_html__('Third color', 'pearl') => 'ttc',
					esc_html__('Custom', 'pearl') => 'custom'
				),
				'description' => esc_html__('Select icon color', 'pearl'),
				'std' => 'mtc'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable icon gradient', 'pearl'),
				'param_name' => 'icon_gradient',
				'value' => array(
					esc_html__('Enable', 'pearl') => 'enable',
					esc_html__('Disable', 'pearl') => 'disable'
				),
				'dependency' => array(
					'element' => 'icon_class',
					'value' => array('custom')
				),
				'std' => 'disable',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Icon gradient first color', 'pearl'),
				'param_name' => 'icon_gradient_first_color',
				'dependency' => array(
					'element' => 'icon_gradient',
					'value' => array('enable')
				)
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Icon gradient second color', 'pearl'),
				'param_name' => 'icon_gradient_second_color',
				'dependency' => array(
					'element' => 'icon_gradient',
					'value' => array('enable')
				)
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Icon Custom Color', 'pearl'),
				'param_name' => 'icon_color',
				'value' => '',
				'dependency' => array(
					'element' => 'icon_gradient',
					'value' => array('disable')
				)
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => esc_html__('Counter Value', 'pearl'),
				'param_name' => 'counter_value',
				'value' => '1000'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Value prefix', 'pearl'),
				'param_name' => 'affix'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Value affix', 'pearl'),
				'param_name' => 'prefix'
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Thousandth separator', 'pearl'),
				'param_name' => 'separator'
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Text Color', 'pearl'),
				'param_name' => 'text_class',
				'value' => array(
					esc_html__('Main color', 'pearl') => 'mtc',
					esc_html__('Secondary color', 'pearl') => 'stc',
					esc_html__('Third color', 'pearl') => 'ttc',
					esc_html__('Custom', 'pearl') => 'custom'
				),
				'description' => esc_html__('Select text color', 'pearl'),
				'std' => 'mtc'
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Text Custom Color', 'pearl'),
				'param_name' => 'text_color',
				'value' => '',
				'dependency' => array(
					'element' => 'text_class',
					'value' => 'custom'
				)
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Duration', 'pearl'),
				'param_name' => 'duration',
				'value' => '2.5'
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
			pearl_load_styles(10)
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Stats_Counter extends WPBakeryShortCode
	{
	}
}