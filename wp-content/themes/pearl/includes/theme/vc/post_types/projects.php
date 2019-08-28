<?php
add_action( 'init', 'pearl_projects_VC' );

function pearl_projects_VC()
{
	$projects_categories = (is_admin()) ? pearl_get_terms_vc('project_category') : array();

    vc_map(
    	array(
        'name' => esc_html__('Pearl Projects carousel', 'pearl'),
        'base' => 'stm_projects_carousel',
		'description' => esc_html__('Images carousel for a project', 'pearl'),
		'icon' => 'pearl-proj_car',
        'category' => esc_html__('Carousels', 'pearl'),
        'params' => array(
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link', 'pearl'),
                'param_name' => 'link',
                'dependency' => array(
                    'element' => 'style_carousel',
                    'value' => array('style_1', 'style_3')
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Full width', 'pearl'),
                'param_name' => 'fullwidth',
                'value' => array(
                    esc_html__('Disable', 'pearl') => '',
                    esc_html__('Enable', 'pearl') => 'stm_fullwidth',
                ),
                'dependency' => array(
                    'element' => 'style_carousel',
                    'value' => array('style_1', 'style_3')
                ),
                'std' => '',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable filter', 'pearl'),
                'param_name' => 'filter',
                'value' => array(
                    esc_html__('Enable', 'pearl') => '',
                    esc_html__('Disable', 'pearl') => 'disable',
                ),
                'dependency' => array(
                    'element' => 'style_carousel',
                    'value' => array('style_1', 'style_3')
                ),
                'std' => '',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show category', 'pearl'),
                'param_name' => 'category',
                'value' => $projects_categories,
                'std' => 'all',
                'dependency' => array(
                    'element' => 'filter',
                    'value' => 'disable'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Show number', 'pearl'),
                'param_name' => 'number'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image size', 'pearl'),
                'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
                'param_name' => 'img_size',
                'value' => '360x240',
                'group' => esc_html__('Carousel settings', 'pearl')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Autoscroll', 'pearl'),
                'param_name' => 'autoscroll',
                'value' => array(
                    esc_html__('Enable', 'pearl') => 'true',
                    esc_html__('Disable', 'pearl') => 'false',
                ),
                'std' => 'false',
                'group' => esc_html__('Carousel settings', 'pearl')
            ),
            array(
				'type' => 'textfield',
				'heading' => esc_html__('Margin', 'pearl'),
				'description' => esc_html__('Margin between images', 'pearl'),
				'param_name' => 'margin',
				'value' => '0',
				'std' => 0,
				'group' => esc_html__('Carousel settings', 'pearl'),
				'dependency' => array(
					'element' => 'style_carousel',
					'value' => 'style_3'
				)
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Extra class', 'pearl'),
				'param_name' => 'css_class',
				'value' => '',
			),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
			pearl_load_styles(3, 'style_carousel'),
		)
    ));

    vc_map(array(
        'name' => esc_html__('Pearl Projects Details', 'pearl'),
        'base' => 'stm_project_details',
		'description' => esc_html__('Project with description elements', 'pearl'),
		'icon' => 'pearl-proj_det',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'pearl'),
                'param_name' => 'title',
                'dependency' => array(
                    'element' => 'style',
                    'value' => 'style_3'
                )
            ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Site URL', 'pearl'),
				'param_name' => 'site_url',
				'dependency' => array(
					'element' => 'style',
					'value' => array('style_5', 'style_7')
				)
			),
            pearl_load_styles(7),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    ));

	vc_map(array(
		'name' => esc_html__('Pearl Projects Cards', 'pearl'),
		'base' => 'stm_projects_cards',
		'icon' => 'pearl-proj_card',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Carousel hint text', 'pearl'),
				'param_name' => 'hint',
				'dependency' => array(
					'element' => 'style',
					'value' => 'style_1'
				)
			),
			pearl_load_styles(4),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Projects_Carousel extends WPBakeryShortCode{}
    class WPBakeryShortCode_Stm_Projects_Cards extends WPBakeryShortCode{}
    class WPBakeryShortCode_Stm_Project_Details extends WPBakeryShortCode{}
}