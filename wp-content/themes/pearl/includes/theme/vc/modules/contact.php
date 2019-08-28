<?php
add_action('init', 'pearl_moduleVC_contact');

function pearl_moduleVC_contact()
{
    vc_map(array(
        'name'   => esc_html__('Pearl Contact', 'pearl'),
        'base'   => 'stm_contact',
        'icon'   => 'pearl-contact',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Custom contact block', 'pearl'),
		'params' => array(
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Name', 'pearl'),
                'param_name' => 'name'
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Image', 'pearl'),
                'param_name' => 'image'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Image Size', 'pearl'),
                'param_name'  => 'image_size',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Job', 'pearl'),
                'param_name' => 'job'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Phone', 'pearl'),
                'param_name' => 'phone'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Email', 'pearl'),
                'param_name' => 'email'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Skype', 'pearl'),
                'param_name' => 'skype'
            ),
            pearl_load_styles(5, 'style', true),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Contact extends WPBakeryShortCode
    {
    }
}
