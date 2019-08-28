<?php
add_action( 'init', 'pearl_vacancies_VC' );

function pearl_vacancies_VC()
{
    vc_map(array(
        'name' => esc_html__('Pearl Vacancies', 'pearl'),
        'base' => 'stm_vacancies',
		'description' => esc_html__('Career opportunities', 'pearl'),
		'icon' => 'stmicon-write',
        'category' => esc_html__('Content', 'pearl'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Number of vacancies to display', 'pearl'),
                'param_name' => 'text',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show Department', 'pearl'),
                'param_name' => 'show_department',
                'value' => array(
                    esc_html__('Show', 'pearl') => '',
                    esc_html__('Hide', 'pearl') => 'hide'
                ),
                'std' => '',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show Location', 'pearl'),
                'param_name' => 'show_location',
                'value' => array(
                    esc_html__('Show', 'pearl') => '',
                    esc_html__('Hide', 'pearl') => 'hide'
                ),
                'std' => '',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show Date', 'pearl'),
                'param_name' => 'show_date',
                'value' => array(
                    esc_html__('Show', 'pearl') => '',
                    esc_html__('Hide', 'pearl') => 'hide'
                ),
                'std' => '',
            ),
            pearl_load_styles(2),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Vacancies extends WPBakeryShortCode{}
}