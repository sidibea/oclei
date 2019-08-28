<?php
add_action('init', 'pearl_moduleVC_waves');

function pearl_moduleVC_waves()
{
	vc_map(array(
		'name'        => esc_html__('Waves', 'pearl'),
		'base'        => 'stm_waves',
		'icon'        => 'pearl-proj_det',
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'      => array(
            array(
                'type'        => 'attach_images',
                'heading'     => esc_html__('Select first wave', 'pearl'),
                'param_name'  => 'wave_1',
                'settings'   => array(
                    'multiple'       => false
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Container height', 'pearl'),
                'param_name' => 'container_height',
                'value'      => '220'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Position vertical', 'pearl'),
                'param_name' => 'wave_1_top_indent',
                'value'      => '0'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Opacity', 'pearl'),
                'param_name' => 'wave_1_opacity',
                'value'      => '0.5'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Animation speed', 'pearl'),
                'param_name' => 'wave_1_animation_speed',
                'value'      => '10',
                'dependency' => array(
                    'element' => 'animation',
                    'value'   => 'true'
                )
            ),
            array(
                'type'        => 'attach_images',
                'heading'     => esc_html__('Select second wave', 'pearl'),
                'param_name'  => 'wave_2',
                'settings'   => array(
                    'multiple'       => false
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Position vertical', 'pearl'),
                'param_name' => 'wave_2_top_indent',
                'value'      => '20'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Opacity', 'pearl'),
                'param_name' => 'wave_2_opacity',
                'value'      => '0.8'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Animation speed', 'pearl'),
                'param_name' => 'wave_2_animation_speed',
                'value'      => '15',
                'dependency' => array(
                    'element' => 'animation',
                    'value'   => 'true'
                )
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Enable "animation"', 'pearl'),
                'param_name' => 'animation',
                'std'        => 'true'
            ),
			pearl_vc_add_css_editor(),
			pearl_load_styles(1, 'style', true)
		),

	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Waves extends WPBakeryShortCode
	{
	}
}

