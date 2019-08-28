<?php
vc_map(array(
    'name'                    => esc_html__('Pearl Opening Hours', 'pearl'),
    'base'                    => 'stm_opening_hours',
    'icon'                    => 'pearl-opening_hours',
    'as_parent'               => array('only' => 'stm_opening_hours_item'),
    'show_settings_on_create' => false,
    'js_view'                 => 'VcColumnView',
	'category' =>array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl')
	),
	'description' => esc_html__('Working days with hours', 'pearl'),
	'params'                  => array(
        array(
            'type'       => 'css_editor',
            'heading'    => esc_html__('Css', 'pearl'),
            'param_name' => 'css'
        )
    )
));

vc_map(array(
    'name'     => esc_html__('Item', 'pearl'),
    'base'     => 'stm_opening_hours_item',
    'as_child' => array('only' => 'stm_opening_hours'),
    'params'   => array(
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Day', 'pearl'),
            'param_name' => 'day',
            'value'      => array(
                esc_html__('Sunday', 'pearl')    => 'sunday',
                esc_html__('Monday', 'pearl')    => 'monday',
                esc_html__('Tuesday', 'pearl')   => 'tuesday',
                esc_html__('Wednesday', 'pearl') => 'wednesday',
                esc_html__('Thursday', 'pearl')  => 'thursday',
                esc_html__('Friday', 'pearl')    => 'friday',
                esc_html__('Saturday', 'pearl')  => 'saturday'
            )
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Output', 'pearl'),
            'param_name' => 'output',
            'value'      => array(
                esc_html__('Enable', 'pearl') => 'enable'
            )
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Text 1', 'pearl'),
            'param_name' => 'text_1',
            'value'      => esc_html__('Output', 'pearl'),
            'dependency' => array(
                'element' => 'output',
                'value'   => array('enable')
            )
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Text 2', 'pearl'),
            'param_name' => 'text_2',
            'value'      => esc_html__('On this day we rest', 'pearl'),
            'dependency' => array(
                'element' => 'output',
                'value'   => array('enable')
            )
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Time Format', 'pearl'),
            'param_name' => 'time_format',
            'value'      => 'g.ia'
        ),
        array(
            'type'       => 'stm_timepicker_vc',
            'heading'    => esc_html__('Opening Time', 'pearl'),
            'param_name' => 'opening_time',
            'value'      => '8:00',
            'group'      => esc_html__('Working Time', 'pearl')
        ),
        array(
            'type'       => 'stm_timepicker_vc',
            'heading'    => esc_html__('Closing Time', 'pearl'),
            'param_name' => 'closing_time',
            'value'      => '19:00',
            'group'      => esc_html__('Working Time', 'pearl')
        ),
        array(
            'type'       => 'stm_timepicker_vc',
            'heading'    => esc_html__('Start Lunch', 'pearl'),
            'param_name' => 'start_lunch',
            'value'      => '13:00',
            'group'      => esc_html__('Lunch Time', 'pearl')
        ),
        array(
            'type'       => 'stm_timepicker_vc',
            'heading'    => esc_html__('End Lunch', 'pearl'),
            'param_name' => 'end_lunch',
            'value'      => '14:00',
            'group'      => esc_html__('Lunch Time', 'pearl')
        )
    )
));

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Stm_Opening_Hours extends WPBakeryShortCodesContainer
    {
    }
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Opening_Hours_Item extends WPBakeryShortCode
    {
    }
}