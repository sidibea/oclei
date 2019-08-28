<?php
add_action('init', 'pearl_moduleVC_button');

function pearl_moduleVC_button()
{
    vc_map(array(
        'name'     => esc_html__('Pearl Action Button', 'pearl'),
        'base'     => 'stm_button',
        'icon'     => 'stmicon-plus',
        'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
        'description' => esc_html__('Button with custom styles', 'pearl'),
        'params'   => array(
            /*Button Link and Label*/
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__('Button link', 'pearl'),
                'param_name' => 'link',
            ),
            /*Button Style*/
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Button style', 'pearl'),
                'param_name' => 'button_style',
                'value'      => array(
                    esc_html__('Solid', 'pearl')   => 'solid',
                    esc_html__('Outline', 'pearl') => 'outline'
                ),
                'std'        => 'solid',
            ),
            /*Button size*/
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Button size', 'pearl'),
                'param_name' => 'button_size',
                'value'      => array(
                    esc_html__('Default', 'pearl')   => '',
                    esc_html__('Large', 'pearl') => 'lg',
                    esc_html__('Small', 'pearl')     => 'sm',
                    esc_html__('Extra small', 'pearl')     => 'xs',
                ),
                'std'        => '',
            ),
            /*Button position in container*/
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Button Position', 'pearl'),
                'param_name' => 'button_pos',
                'value'      => array(
                    esc_html__('Left', 'pearl')  => 'left',
                    esc_html__('Right', 'pearl')  => 'right',
                    esc_html__('Center', 'pearl')  => 'center',
                    esc_html__('Fullwidth', 'pearl') => 'fullwidth'
                ),
                'std'        => '_left',
            ),
            /*Enable icon*/
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Button icon position', 'pearl'),
                'param_name' => 'button_icon_pos',
                'value'      => array(
                    esc_html__('None', 'pearl')  => '',
                    esc_html__('Left', 'pearl')  => 'left',
                    esc_html__('Right', 'pearl') => 'right',
                ),
                'std'        => '',
                'group' => esc_html__('Icon', 'pearl')
            ),
            /*Choose icon*/
            array(
                'type'       => 'iconpicker',
                'heading'    => esc_html__('Button icon', 'pearl'),
                'param_name' => 'button_icon',
                'value'      => '',
                'dependency' => array(
                    'element'   => 'button_icon_pos',
                    'not_empty' => true
                ),
                'group' => esc_html__('Icon', 'pearl')
            ),
            /*Choose icon color*/
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Icon color', 'pearl'),
                'param_name'  => 'button_icon_class',
                'value'       => array(
                    esc_html__('Default', 'pearl')      => 'wtc',
                    esc_html__('Custom', 'pearl')          => 'custom'
                ),
                'description' => esc_html__('Select icon color', 'pearl'),
                'std'         => 'wtc',
                'dependency'  => array(
                    'element'   => 'button_icon_pos',
                    'not_empty' => true
                ),
                'group' => esc_html__('Icon', 'pearl')
            ),
            /*Choose icon custom color*/
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Icon Custom Color', 'pearl'),
                'param_name' => 'button_icon_color',
                'value'      => '',
                'dependency' => array(
                    'element' => 'button_icon_class',
                    'value'   => 'custom'
                ),
                'group' => esc_html__('Icon', 'pearl')
            ),
            /*Choose icon custom color hover*/
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Icon Custom Color on hover', 'pearl'),
                'param_name' => 'button_icon_color_hover',
                'value'      => '',
                'dependency' => array(
                    'element' => 'button_icon_class',
                    'value'   => 'custom'
                ),
                'group' => esc_html__('Icon', 'pearl')
            ),
            /*Choose icon bg*/
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Button icon background', 'pearl'),
                'param_name' => 'button_icon_bg',
                'value'      => '',
                'dependency' => array(
                    'element'   => 'button_icon_pos',
                    'not_empty' => true
                ),
                'group' => esc_html__('Icon', 'pearl'),
            ),
            /*Choose icon bg hover*/
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Button icon background on hover', 'pearl'),
                'param_name' => 'button_icon_bg_hover',
                'value'      => '',
                'dependency' => array(
                    'element'   => 'button_icon_pos',
                    'not_empty' => true
                ),
                'group' => esc_html__('Icon', 'pearl'),
            ),
            /*Choose icon size*/
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Button icon size', 'pearl'),
                'param_name' => 'button_icon_size',
                'dependency' => array(
                    'element'   => 'button_icon_pos',
                    'not_empty' => true
                ),
                'std'        => 20,
                'group' => esc_html__('Icon', 'pearl')
            ),
            /*Subtitle*/
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Subtitle', 'pearl'),
                'param_name'  => 'subtitle',
                'description' => esc_html__('Button subtitle', 'pearl'),
                'group' => esc_html__('Advanced', 'pearl'),
            ),
            /*Divider*/
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Divider', 'pearl'),
                'param_name' => 'button_divider',
                'value'      => array(
                    esc_html__('Disable', 'pearl') => '',
                    esc_html__('Enable', 'pearl')  => 'divider'
                ),
                'dependency' => array(
                    'element'   => 'button_icon_pos',
                    'not_empty' => true
                ),
                'std'        => '',
                'group' => esc_html__('Advanced', 'pearl'),
            ),
            /*Custom Class*/
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Custom class', 'pearl'),
                'param_name' => 'c_class',
                'group' => esc_html__('Advanced', 'pearl'),
            ),



			/*Custom colors*/
            /*Button color scheme*/
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Button color scheme', 'pearl'),
                'param_name' => 'button_color_scheme',
                'value'      => array(
                    esc_html__('Default', 'pearl')   => 'default',
                    esc_html__('With gradient', 'pearl') => 'gradient',
                ),
                'std'        => 'default',
                'group' => esc_html__('Colors', 'pearl'),
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'button_color',
                'value'      => array(
                    esc_html__('Primary', 'pearl')   => 'primary',
                    esc_html__('Secondary', 'pearl') => 'secondary',
                    esc_html__('Third', 'pearl')     => 'third',
                    esc_html__('White', 'pearl')     => 'white',
                    esc_html__('Custom', 'pearl')     => 'custom',
                ),
                'std'        => 'primary',
                'group' => esc_html__('Colors', 'pearl'),
            ),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Button border color', 'pearl'),
				'param_name' => 'button_border_color',
				'value'      => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value'   => 'default'
                ),
				'group' => esc_html__('Colors', 'pearl'),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Button border color on hover', 'pearl'),
				'param_name' => 'button_border_color_hover',
				'value'      => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value'   => 'default'
                ),
				'group' => esc_html__('Colors', 'pearl'),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Button background color', 'pearl'),
				'param_name' => 'button_bg_color',
				'value'      => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value'   => 'default'
                ),
				'group' => esc_html__('Colors', 'pearl'),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Button background color on hover', 'pearl'),
				'param_name' => 'button_bg_color_hover',
				'value'      => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value'   => 'default'
                ),
				'group' => esc_html__('Colors', 'pearl'),
			),
            /*Button color with gradient*/
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Button border first color', 'pearl'),
                'param_name' => 'button_border_color_gradient_first',
                'value'      => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value'   => 'gradient'
                ),
                'group' => esc_html__('Colors', 'pearl'),
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Button border second color', 'pearl'),
                'param_name' => 'button_border_color_gradient_second',
                'value'      => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value'   => 'gradient'
                ),
                'group' => esc_html__('Colors', 'pearl'),
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Button background first color', 'pearl'),
                'param_name' => 'button_background_color_gradient_first',
                'value'      => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value'   => 'gradient'
                ),
                'group' => esc_html__('Colors', 'pearl'),
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Button background second color', 'pearl'),
                'param_name' => 'button_background_color_gradient_second',
                'value'      => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value'   => 'gradient'
                ),
                'group' => esc_html__('Colors', 'pearl'),
            ),
            /*Button color with gradient end*/
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Button text color', 'pearl'),
				'param_name' => 'button_text_color',
				'value'      => '',
				'group' => esc_html__('Colors', 'pearl'),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Button text color on hover', 'pearl'),
				'param_name' => 'button_text_color_hover',
				'value'      => '',
				'group' => esc_html__('Colors', 'pearl'),
			),
            /*Colors*/
            vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Button extends WPBakeryShortCode
    {
    }
}