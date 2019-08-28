<?php
add_action('init', 'pearl_moduleVC_services_carousel');

function pearl_moduleVC_services_carousel()
{
	vc_map( array(
		'name'     => esc_html__( 'Pearl Services Carousel', 'pearl' ),
		'base'     => 'stm_services_carousel',
		'icon'     => 'stmicon-flag',
		'category' => esc_html__( 'Content', 'pearl' ),
		'description' => esc_html__('Carousel with services', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'   => array(
			array(
				'type'       => 'textarea_html',
				'heading'    => esc_html__( 'Text', 'pearl' ),
				'param_name' => 'content'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Number Posts', 'pearl' ),
				'param_name' => 'posts_per_page',
				'value'      => 12
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Styles', 'pearl'),
                'param_name' => 'carousel_style',
                'value'      => array(
                    esc_html__('Style 1', 'pearl')   => 'style_1',
                    esc_html__('Style 2', 'pearl')   => 'style_2',
                    esc_html__('Style 3', 'pearl')   => 'style_3',
                ),
                'group'       => esc_html__( 'Carousel', 'pearl' )
            ),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Image Size', 'pearl'),
				'param_name'  => 'image_size',
				'std' => '265x170',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl'),
				'group'       => esc_html__( 'Carousel', 'pearl' )
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Slider autoplay', 'pearl' ),
				'param_name'  => 'autoplay',
				'description' => esc_html__( 'Enable autoplay mode.', 'pearl' ),
				'value'       => array(
					esc_html__( 'Yes', 'pearl' ) => 'yes'
				),
				'group'       => esc_html__( 'Carousel', 'pearl' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Autoplay Timeout', 'pearl' ),
				'param_name'  => 'timeout',
				'value'       => '5000',
				'description' => esc_html__( 'Autoplay interval timeout (in ms).', 'pearl' ),
				'dependency'  => array(
					'element' => 'autoplay',
					'value'   => array( 'yes' ),
				),
				'group'       => esc_html__( 'Carousel', 'pearl' ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Hide pagination control', 'pearl' ),
				'param_name'  => 'hide_pagination_control',
				'description' => esc_html__( 'If checked, pagination controls will be hidden.', 'pearl' ),
				'value'       => array(
					esc_html__( 'Yes', 'pearl' ) => 'yes'
				),
				'group'       => esc_html__( 'Carousel', 'pearl' ),
			),
            array(
                'type'        => 'checkbox',
                'heading'     => esc_html__( 'Enable arrows control', 'pearl' ),
                'param_name'  => 'show_arrows_control',
                'description' => esc_html__( 'If checked, arrows controls will be show.', 'pearl' ),
                'value'       => array(
                    esc_html__( 'Yes', 'pearl' ) => 'yes'
                ),
                'group'       => esc_html__( 'Carousel', 'pearl' ),
            ),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Slider loop', 'pearl' ),
				'param_name'  => 'loop',
				'description' => esc_html__( 'Enable slider loop mode.', 'pearl' ),
				'value'       => array(
					esc_html__( 'Yes', 'pearl' ) => 'yes'
				),
				'group'       => esc_html__( 'Carousel', 'pearl' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Smart Speed', 'pearl' ),
				'param_name' => 'smart_speed',
				'value'      => '250',
				'group'      => esc_html__( 'Carousel', 'pearl' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Items', 'pearl' ),
				'param_name'  => 'items',
				'value'       => '3',
				'description' => esc_html__( 'The number of items you want to see on the screen.', 'pearl' ),
				'group'       => esc_html__( 'Carousel', 'pearl' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Items (Small Desktop)', 'pearl' ),
				'param_name'  => 'items_small_desktop',
				'value'       => '3',
				'description' => esc_html__( 'Number of items the carousel will display. Default: at <980px - 3 items.', 'pearl' ),
				'group'       => esc_html__( 'Carousel', 'pearl' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Items (Tablet)', 'pearl' ),
				'param_name'  => 'items_tablet',
				'value'       => '2',
				'description' => esc_html__( 'Number of items the carousel will display. Default: at <768px - 2 items.', 'pearl' ),
				'group'       => esc_html__( 'Carousel', 'pearl' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Items (Mobile)', 'pearl' ),
				'param_name'  => 'items_mobile',
				'value'       => '1',
				'description' => esc_html__( 'Number of items the carousel will display. Default: at <479px - 1 item.', 'pearl' ),
				'group'       => esc_html__( 'Carousel', 'pearl' ),
			),
			pearl_vc_add_css_editor(),
			vc_map_add_css_animation(),
		)
	) );
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Services_Carousel extends WPBakeryShortCode
	{
	}
}