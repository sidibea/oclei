<?php
add_action('init', 'pearl_moduleVC_charts');

function pearl_moduleVC_charts()
{
    vc_map( array(
        'name'     => esc_html__( 'Pearl Charts', 'pearl' ),
        'base'     => 'stm_charts',
        'icon'     => 'stm_charts',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Animated charts', 'pearl'),
		'params'   => array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Design', 'pearl' ),
                'param_name' => 'design',
                'value'      => array(
                    esc_html__( 'Line', 'pearl' )   => 'line',
                    esc_html__( 'Bar', 'pearl' )    => 'bar',
                    esc_html__( 'Circle', 'pearl' ) => 'circle',
                    esc_html__( 'Pie', 'pearl' )    => 'pie',
                ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => esc_html__( 'Show legend?', 'pearl' ),
                'param_name'  => 'legend',
                'description' => esc_html__( 'If checked, chart will have legend.', 'pearl' ),
                'value'       => array( esc_html__( 'Yes', 'pearl' ) => 'yes' ),
                'std'         => 'yes',
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Legend Position', 'pearl' ),
                'param_name' => 'legend_position',
                'value'      => array(
                    esc_html__( 'Bottom', 'pearl' ) => 'bottom',
                    esc_html__( 'Right', 'pearl' )  => 'right',
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__( 'Width (px)', 'pearl' ),
                'param_name' => 'width',
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__( 'Height (px)', 'pearl' ),
                'param_name' => 'height',
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__( 'X-axis values', 'pearl' ),
                'param_name' => 'x_values',
                'value'      => 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG',
                'dependency' => array(
                    'element' => 'design',
                    'value'   => array( 'line', 'bar' )
                ),
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Values', 'pearl' ),
                'param_name' => 'values',
                'dependency' => array(
                    'element' => 'design',
                    'value'   => array( 'line', 'bar' )
                ),
                'value'      => urlencode( json_encode( array(
                    array(
                        'title' => esc_html__( 'One', 'pearl' ),
                        'y_values' => '10; 15; 20; 25; 27; 25; 23; 25',
                        'color' => '#fe6c61',
                    ),
                    array(
                        'title' => esc_html__( 'Two', 'pearl' ),
                        'y_values' => '25; 18; 16; 17; 20; 25; 30; 35',
                        'color' => '#5472d2'
                    )
                ) ) ),
                'params'     => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__( 'Title', 'pearl' ),
                        'param_name'  => 'title',
                        'description' => esc_html__( 'Enter title for chart dataset.', 'pearl' ),
                        'admin_label' => true,
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Y-axis values', 'pearl' ),
                        'param_name' => 'y_values'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color', 'pearl' ),
                        'param_name' => 'color'
                    )
                ),
                'callbacks'  => array(
                    'after_add' => 'vcChartParamAfterAddCallback',
                ),
            ),
            array(
                'type'       => 'param_group',
                'heading'    => esc_html__( 'Values', 'pearl' ),
                'param_name' => 'values_circle',
                'dependency' => array(
                    'element' => 'design',
                    'value'   => array( 'circle', 'pie' )
                ),
                'value'      => urlencode( json_encode( array(
                    array(
                        'title' => esc_html__( 'One', 'pearl' ),
                        'value' => '40',
                        'color' => '#fe6c61',
                    ),
                    array(
                        'title' => esc_html__( 'Two', 'pearl' ),
                        'value' => '30',
                        'color' => '#5472d2'
                    ),
                    array(
                        'title' => esc_html__( 'Three', 'pearl' ),
                        'value' => '40',
                        'color' => '#8d6dc4'
                    )
                ) ) ),
                'params'     => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__( 'Title', 'pearl' ),
                        'param_name'  => 'title',
                        'description' => esc_html__( 'Enter title for chart dataset.', 'pearl' ),
                        'admin_label' => true,
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => esc_html__( 'Value', 'pearl' ),
                        'param_name' => 'value'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => esc_html__( 'Color', 'pearl' ),
                        'param_name' => 'color'
                    )
                ),
                'callbacks'  => array(
                    'after_add' => 'vcChartParamAfterAddCallback',
                ),
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => esc_html__( 'Css', 'pearl' ),
                'param_name' => 'css',
                'group'      => esc_html__( 'Design options', 'pearl' )
            )
        )
    ) );
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Charts extends WPBakeryShortCode
    {
    }
}