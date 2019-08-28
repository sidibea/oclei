<?php

add_action( 'init', 'pearl_cf7_VC' );


function pearl_cf7_VC () {

    $cf7_forms_ids = pearl_vc_post_type('wpcf7_contact_form');

    vc_map(array(
        'name'   => esc_html__('Pearl Contact form 7', 'pearl'),
        'base'   => 'stm_contact_form_7',
        'icon'   => 'stmicon-bookmark',
		'description' => esc_html__('All contact forms', 'pearl'),
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'params' => array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Select form', 'pearl'),
                'param_name' => 'form',
                'value'      => $cf7_forms_ids
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Form id', 'pearl'),
                'param_name' => 'form_id',
                'value'      => ''
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Form class', 'pearl'),
                'param_name' => 'form_custom_class',
                'value'      => ''
            ),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
            pearl_load_styles(3)
        )
    ));

}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Contact_Form_7 extends WPBakeryShortCode{}
}