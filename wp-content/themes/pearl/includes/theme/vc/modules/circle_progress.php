<?php

add_action( 'init', 'pearl_circle_progress_VC' );


function pearl_circle_progress_VC ()
{
	vc_map( array(
		'name'     => esc_html__( 'Pearl Circle Progress', 'pearl' ),
		'base'     => 'stm_circle_progress',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Animated charts', 'pearl'),
		'params'   => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'pearl' ),
				'param_name'  => 'title',
				'value'       => esc_html__( 'WordPress', 'pearl' ),
				'admin_label' => true,
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Value (in %)', 'pearl' ),
				'param_name' => 'value',
				'value'      => '50'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Circle Width / Height (in px)', 'pearl' ),
				'param_name' => 'size',
				'value'      => '125'
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Fill Color', 'pearl' ),
				'param_name' => 'fill_color'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'Css', 'pearl' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design options', 'pearl' )
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
		)
	) );
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Circle_Progress extends WPBakeryShortCode{}
}