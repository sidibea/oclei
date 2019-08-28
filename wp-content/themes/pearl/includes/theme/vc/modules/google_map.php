<?php
add_action('init', 'pearl_moduleVC_google_map');

function pearl_moduleVC_google_map()
{
    /*Stm google maps*/
    vc_map(array(
        'name'      => esc_html__('Pearl Google maps', 'pearl'),
        'base'      => 'stm_google_map',
        'as_parent' => array('only' => 'stm_google_map_address'),
        'is_container' => true,
        'content_element' => true,
        'icon'      => 'pearl-google-maps',
        'js_view' => 'VcColumnView',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Office location with pin on map', 'pearl'),
		'params'    => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Map Height', 'pearl'),
                'param_name'  => 'map_height',
                'value'       => '688px',
                'description' => esc_html__('Enter map height in px', 'pearl')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Map Zoom', 'pearl'),
                'param_name' => 'map_zoom',
                'value'      => 18
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Marker Image', 'pearl'),
                'param_name' => 'marker'
            ),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Marker size', 'pearl'),
				'param_name' => 'img_size',
				'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Disable carousel', 'pearl' ),
                'param_name' => 'disable_carousel',
                'value' => array(
                    esc_html__('Disable carousel', 'pearl') => 'disable',
                    esc_html__('Enable carousel', 'pearl') => 'enable',
                ),
                'std' => 'enable'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Visible items', 'pearl'),
                'param_name'  => 'images_qty',
                'dependency'  => array(
                    'element' => 'disable_carousel',
                    'value'   => 'enable'
                ),
                'std'        => '3'
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'disable_mouse_whell',
                'value'      => array(
                    esc_html__('Disable map zoom on mouse wheel scroll', 'pearl') => 'disable'
                )
            ),
            array(
                'type'       => 'textarea_raw_html',
                'heading'    => esc_html__('Map style', 'pearl'),
                'param_name' => 'map_custom_style',
                'value'      => '',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Extra class name', 'pearl'),
                'param_name'  => 'el_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'pearl')
            ),
            pearl_load_styles(3),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
        )
    ));


    vc_map(array(
        'name'     => esc_html__('Address', 'pearl'),
        'base'     => 'stm_google_map_address',
        'icon'     => 'stmicon_map',
        'content_element' => true,
        'as_child' => array('only' => 'stm_google_map'),
        'params'   => array(
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Title', 'pearl'),
                'admin_label' => true,
                'param_name'  => 'title'
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Address', 'pearl'),
                'param_name' => 'address'
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
                'type'       => 'textarea',
                'heading'    => esc_html__('Open Hours', 'pearl'),
                'param_name' => 'open_hours'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Latitude', 'pearl'),
                'param_name'  => 'lat',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Longitude', 'pearl'),
                'param_name'  => 'lng',
            ),
        )
    ));
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Stm_Google_Map extends WPBakeryShortCodesContainer
    {
    }
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Google_Map_Address extends WPBakeryShortCode
    {
    }
}