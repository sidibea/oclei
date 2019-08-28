<?php
add_action('init', 'pearl_moduleVC_icon_links');

function pearl_moduleVC_icon_links()
{
    vc_map(array(
        'name'        => esc_html__('Pearl Icon links', 'pearl'),
        'base'        => 'stm_icon_links',
        'icon'        => 'stmicon-users',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Icon with link', 'pearl'),
		'params'      => array(
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__('Icons', 'pearl'),
                'param_name' => 'icons',
                'value'      => urlencode(json_encode(array(
                    array(
                        'label'       => esc_html__('Icon', 'pearl'),
                        'admin_label' => false
                    ),
                    array(
                        'label'       => esc_html__('Icon Link', 'pearl'),
                        'admin_label' => true
                    ),
					array(
						'label'       => esc_html__('Subheading (not required)', 'pearl'),
						'admin_label' => true
					),
                ))),
                'params'     => array(
                    array(
                        'type'        => 'iconpicker',
                        'heading'     => esc_html__('Icon', 'pearl'),
                        'param_name'  => 'icon',
                        'admin_label' => false,
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Link', 'pearl'),
                        'param_name'  => 'url',
                        'admin_label' => true,
                    ),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Subheading (not required)', 'pearl'),
						'param_name'  => 'subheading',
						'admin_label' => true,
					),
                ),
            ),
            array(
            	'type' => 'dropdown',
				'heading'     => esc_html__('Align', 'pearl'),
				'param_name' => 'align',
				'value' => pearl_vc_align(),
				'std' => 'left',
			),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
            pearl_load_styles(6)
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Icon_Links extends WPBakeryShortCode
    {
    }
}

