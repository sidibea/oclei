<?php
add_action('init', 'pearl_moduleVC_iconbox');

function pearl_moduleVC_iconbox()
{
    vc_map(array(
        'name'   => esc_html__('Pearl Icon Box', 'pearl'),
        'base'   => 'stm_icon_box',
        'icon'   => 'stmicon-box2',
		'category' => array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl'),
		),
		'description' => esc_html__('Icon and text inside the box', 'pearl'),
		'params' => array(
            array(
                'type'       => 'textfield',
                'holder'     => 'div',
                'heading'    => esc_html__('Title', 'pearl'),
                'param_name' => 'title'
            ),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title font size', 'pearl'),
				'param_name' => 'title_fsz'
			),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Title Custom Color', 'pearl'),
                'param_name' => 'title_custom_color',
                'value'      => '',
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Enable heading divider', 'pearl'),
                'param_name' => 'h_divider'
            ),
            array(
                'type'       => 'iconpicker',
                'heading'    => esc_html__('Icon', 'pearl'),
                'param_name' => 'icon',
                'value'      => ''
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Content align', 'pearl'),
                'param_name' => 'content_pos',
                'value'      => array(
                    esc_html__('Left', 'pearl')   => 'left',
                    esc_html__('Center', 'pearl') => 'center',
                    esc_html__('Right', 'pearl')  => 'right',
                ),
                'std'        => 'left'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Icon position', 'pearl'),
                'param_name' => 'icon_pos',
                'value'      => array(
                    esc_html__('Left', 'pearl')   => 'left',
                    esc_html__('Top', 'pearl')    => 'top',
                    esc_html__('Center', 'pearl') => 'center',
                    esc_html__('Right', 'pearl')  => 'right',
                ),
                'std'        => 'left',
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Icon Color', 'pearl'),
                'param_name'  => 'icon_class',
                'value'       => array(
                    esc_html__('Main color', 'pearl')      => 'mtc',
                    esc_html__('Secondary color', 'pearl') => 'stc',
                    esc_html__('Third color', 'pearl')     => 'ttc',
                    esc_html__('Custom', 'pearl')          => 'custom'
                ),
                'description' => esc_html__('Select icon color', 'pearl')
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Icon Custom Color', 'pearl'),
                'param_name' => 'icon_color',
                'value'      => '',
                'dependency' => array(
                    'element' => 'icon_class',
                    'value'   => 'custom'
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Icon Size', 'pearl'),
                'param_name'  => 'icon_size',
                'value'       => '65',
                'description' => esc_html__('Enter icon size in px', 'pearl')
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Icon Height', 'pearl'),
                'param_name'  => 'icon_height',
                'value'       => '65',
                'description' => esc_html__('Enter icon height in px', 'pearl'),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Icon Width', 'pearl'),
                'param_name'  => 'icon_width',
                'value'       => '50',
                'description' => esc_html__('Enter icon width in px', 'pearl'),
            ),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Icon Weight', 'pearl'),
				'param_name' => 'icon_weight',
				'value'      => array(
					esc_html__('Normal', 'pearl')   => 'normal',
					esc_html__('Bold', 'pearl')    => 'bold',
				),
				'std'        => 'normal',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Minimal height', 'pearl'),
				'param_name' => 'min_height',
				'std' => 220
			),
            array(
                'type'       => 'textarea_html',
                'heading'    => esc_html__('Text', 'pearl'),
                'param_name' => 'content'
            ),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Link IconBox', 'pearl' ),
				'param_name' => 'box_link',
				'value'      => array(
					esc_html__( 'Enable', 'pearl' )  => 'enable',
					esc_html__( 'Disable', 'pearl' ) => 'disable',
				),
				'std'        => 'disable',
			),
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'Link url', 'pearl' ),
				'param_name'  => 'box_link_url',
				'value'       => '',
				'description' => esc_html__( 'Enter url for box', 'pearl' ),
				'dependency'  => array(
					'element' => 'box_link',
					'value'   => 'enable'
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Flip', 'pearl'),
				'param_name' => 'flip',
				'value'      => array(
					esc_html__('Disable', 'pearl')    => 'disable',
					esc_html__('Enable', 'pearl')   => 'enable',
				),
				'std'        => 'disable',
				'group' => esc_html__('Flip Icon Box', 'pearl'),
				'dependency'  => array(
					'element' => 'style',
					'value'   => array('style_1')
				)
			),
			array(
				'type'       => 'textarea',
				'heading'    => esc_html__('Flip Title', 'pearl'),
				'param_name' => 'flip_title',
				'group' => esc_html__('Flip Icon Box', 'pearl'),
				'dependency'  => array(
					'element' => 'flip',
					'value'   => array('enable')
				)
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Flip title color', 'pearl'),
				'param_name' => 'flip_title_color',
				'value'      => '',
				'group' => esc_html__('Flip Icon Box', 'pearl'),
				'dependency'  => array(
					'element' => 'flip',
					'value'   => array('enable')
				)
			),
			array(
				'type'       => 'textarea',
				'heading'    => esc_html__('Flip Content', 'pearl'),
				'param_name' => 'flip_content',
				'group' => esc_html__('Flip Icon Box', 'pearl'),
				'dependency'  => array(
					'element' => 'flip',
					'value'   => array('enable')
				)
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__('Flip content color', 'pearl'),
				'param_name' => 'flip_content_color',
				'value'      => '',
				'group' => esc_html__('Flip Icon Box', 'pearl'),
				'dependency'  => array(
					'element' => 'flip',
					'value'   => array('enable')
				)
			),
			pearl_load_styles(12, 'style', true),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode
    {
    }
}