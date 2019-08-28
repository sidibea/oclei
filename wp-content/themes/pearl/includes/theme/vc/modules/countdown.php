<?php

add_action( 'init', 'pearl_countdown_VC_module' );


function pearl_countdown_VC_module () {

    vc_map(array(
        'name'   => esc_html__('Pearl Countdown', 'pearl'),
        'base'   => 'stm_countdown',
        'icon'   => 'stmicon-bookmark',
		'description' => esc_html__('Count to date module', 'pearl'),
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'params' => array(
            array(
                'type'       => 'stm_datepicker_vc',
                'heading'    => esc_html__('Count to date', 'pearl'),
                'param_name' => 'count_date',
                'value'      => ''
            ),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Text color', 'pearl'),
				'param_name' => 'text_color',
				'value'      => ''
			),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
            //pearl_load_styles(3)
        )
    ));

}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Countdown extends WPBakeryShortCode{}
}