<?php
add_action('init', 'pearl_moduleVC_video');

function pearl_moduleVC_video()
{
    vc_map(array(
        'name'   => esc_html__('Pearl Video Popup', 'pearl'),
        'base'   => 'stm_video',
		'description' => esc_html__('Video element', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'icon'   => 'stmicon-film',
        'params' => array(
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Video URL', 'pearl'),
                'param_name' => 'url',
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Video Poster', 'pearl'),
                'param_name' => 'image',
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'style_1',
						'style_2',
						'style_3',
						'style_4',
						'style_5',
						'style_6',
						'style_7',
						'style_8',
						'style_9',
						'style_10',
					)
				)
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Poster height', 'pearl'),
                'param_name' => 'height',
            ),
            array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Video view type', 'pearl'),
				'param_name' => 'view_type',
				'value'      => array(
					esc_html__('View in popup', 'pearl') => 'popup',
					esc_html__('View in window', 'pearl') => 'window',
				),
				'std'        => 'popup',
			),
            pearl_load_styles(10, 'style', true),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Video extends WPBakeryShortCode
    {
    }
}