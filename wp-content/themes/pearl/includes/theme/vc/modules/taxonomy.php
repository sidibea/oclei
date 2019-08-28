<?php
add_action('init', 'pearl_moduleVC_taxonomy');

function pearl_moduleVC_taxonomy()
{

    $taxes = pearl_get_taxonomies_list(true);

    vc_map(array(
        'name'     => esc_html__('Pearl Post taxonomy', 'pearl'),
        'base'     => 'stm_taxonomy',
        'category' => esc_html__('Content', 'pearl'),
		'description' => esc_html__('Shows terms of current post in selected taxonomy', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'   => array(
            array(
                'type' => 'autocomplete',
                'heading' => esc_html__( 'Select taxonomy', 'pearl' ),
                'param_name' => 'taxonomy',
                'settings' => array(
                    'multiple' => true,
                    'sortable' => true,
                    'min_length' => 1,
                    'no_hide' => true,
                    'unique_values' => true,
                    'display_inline' => true,
                    'values' => $taxes
                )
            ),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text color', 'pearl' ),
				'param_name' => 'color',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background color', 'pearl' ),
				'param_name' => 'background_color',
			),
            array(
            	'type' => 'dropdown',
				'heading' => esc_html__('Text align', 'pearl'),
				'param_name' => 'align',
				'value' => pearl_vc_align()
			),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Taxonomy extends WPBakeryShortCode
    {
    }
}