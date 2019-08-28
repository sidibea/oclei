<?php
vc_map(array(
    'name'     => esc_html__('Pearl Contacts', 'pearl'),
    'base'     => 'stm_contacts_widget',
    'icon'     => 'icon-wpb-wp',
	'category' => array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl'),
	),
	'description' => esc_html__('Contact info in footer area', 'pearl'),
	'params'   => array(
        array(
            'type'       => 'textfield',
            'holder'     => 'div',
            'heading'    => esc_html__('Title', 'pearl'),
            'param_name' => 'title'
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Address', 'pearl'),
            'param_name' => 'address'
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Phone', 'pearl'),
            'param_name' => 'phone'
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Fax', 'pearl'),
            'param_name' => 'fax'
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Email', 'pearl'),
            'param_name' => 'email'
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Open hours', 'pearl'),
            'param_name' => 'open_hours'
        ),
        vc_map_add_css_animation(),
        pearl_vc_add_css_editor(),
        pearl_load_styles(10, 'style', true)
    )
));


if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Contacts_Widget extends WPBakeryShortCode
    {
    }
}