<?php
add_action('init', 'pearl_moduleVC_partners');

function pearl_moduleVC_partners()
{
    vc_map(array(
        'name'        => esc_html__('Pearl Partners', 'pearl'),
        'description' => esc_html__('Logos of partners', 'pearl'),
        'base'        => 'stm_partners',
        'icon'        => 'stmicon-users',
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
        'params'      => array(
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__('Partners', 'pearl'),
                'param_name' => 'partners',
                'value'      => urlencode(json_encode(array(
                    array(
                        'label'       => esc_html__('Partner Logo', 'pearl'),
                        'admin_label' => false
                    ),
                    array(
                        'label'       => esc_html__('Partner Link', 'pearl'),
                        'admin_label' => true
                    ),
                    array(
                        'label'       => esc_html__('Partner Title', 'pearl'),
                        'admin_label' => true
                    ),
                    array(
                        'label'       => esc_html__('Partner Description', 'pearl'),
                        'admin_label' => false
                    ),
                ))),
                'params'     => array(
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__('Partner Logo', 'pearl'),
                        'param_name'  => 'logo',
                        'admin_label' => false,
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Partner link', 'pearl'),
                        'param_name'  => 'url',
                        'admin_label' => true,
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Partner Title', 'pearl'),
                        'param_name'  => 'title',
                        'admin_label' => true,
                    ),
                    array(
                        'type'        => 'textarea',
                        'heading'     => esc_html__('Partner Description', 'pearl'),
                        'param_name'  => 'description',
                        'admin_label' => false,
                    ),
                ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Image Size', 'pearl'),
                'param_name'  => 'image_size',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl'),
                'std' => ''
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Grayscale effect', 'pearl'),
                'param_name' => 'grayscale',
                'value'      => array(
                    esc_html__('Disable', 'pearl') => '',
                    esc_html__('Enable', 'pearl') => 'stm_partners_grayscale'
                ),
                'std' => ''
            ),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
            pearl_load_styles(4, 'style', true)
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Partners extends WPBakeryShortCode
    {
    }
}

