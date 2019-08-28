<?php
add_action('init', 'pearl_moduleVC_icontext');

function pearl_moduleVC_icontext()
{
	$align = pearl_vc_align();
    vc_map(array(
        'name'        => esc_html__('Pearl Text with icon', 'pearl'),
        'description' => esc_html__('Place a text with custom icon', 'pearl'),
        'base'        => 'stm_icontext',
        'icon'        => 'stmicon-write',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Pearl - icon with text', 'pearl'),
		'params'      => array(
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Text', 'pearl'),
                'param_name' => 'text',
                'holder'     => 'div'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Font size', 'pearl'),
                'param_name' => 'font_size',
                'dependency' => array(
                    'element'   => 'text',
                    'not_empty' => true
                ),
                'std'        => 14,
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Line height', 'pearl'),
                'param_name' => 'line_height',
                'dependency' => array(
                    'element'   => 'text',
                    'not_empty' => true
                ),
                'std'        => 24,
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Font-family', 'pearl'),
                'param_name'  => 'font_family',
                'value'       => array(
                    esc_html__('Primary font', 'pearl') => 'default_font',
                    esc_html__('Secondary font', 'pearl') => 'stm_mf',
                ),
                'std'         => 'default_font',
                'dependency'  => array(
                    'element'   => 'text',
                    'not_empty' => true
                ),
            ),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Text color', 'pearl'),
				'param_name'  => 'text_class',
				'value'       => array(
					esc_html__('Default', 'pearl')      => 'default',
					esc_html__('Primary color', 'pearl') => 'mtc',
					esc_html__('Secondary color', 'pearl') => 'stc',
					esc_html__('Third color', 'pearl') => 'ttc',
					esc_html__('Custom', 'pearl')          => 'custom'
				),
				'description' => esc_html__('Select text color', 'pearl'),
				'std'         => 'default',
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Text Custom Color', 'pearl'),
				'param_name' => 'text_color',
				'value'      => '',
				'dependency' => array(
					'element' => 'text_class',
					'value'   => 'custom'
				),
			),
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__('Text link', 'pearl'),
                'param_name' => 'link',
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => esc_html__('Text icon', 'pearl'),
                'param_name' => 'icon',
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Icon size', 'pearl'),
                'param_name' => 'icon_size',
                'dependency' => array(
                    'element'   => 'icon',
                    'not_empty' => true
                ),
                'std'        => 16,
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Icon margin', 'pearl'),
                'param_name' => 'icon_margin',
                'dependency' => array(
                    'element'   => 'icon',
                    'not_empty' => true
                ),
                'std'        => 3,
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Icon color', 'pearl'),
                'param_name'  => 'icon_class',
                'value'       => array(
                    esc_html__('Default', 'pearl')      => 'default',
                    esc_html__('Primary color', 'pearl') => 'mtc',
                    esc_html__('Secondary color', 'pearl') => 'stc',
                    esc_html__('Third color', 'pearl') => 'ttc',
                    esc_html__('Custom', 'pearl')          => 'custom'
                ),
                'description' => esc_html__('Select icon color', 'pearl'),
                'std'         => 'default',
                'dependency'  => array(
                    'element'   => 'icon',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Icon Custom Color', 'pearl'),
                'param_name' => 'icon_color',
                'value'      => '',
                'dependency' => array(
                    'element' => 'icon',
                    'value'   => 'custom'
                ),
            ),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Text align', 'pearl'),
				'param_name'  => 'align',
				'value'       => $align,
				'std'         => 'left',
			),
            pearl_load_styles(6),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Icontext extends WPBakeryShortCode
    {
    }
}