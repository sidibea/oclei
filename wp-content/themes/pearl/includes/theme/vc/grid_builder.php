<?php
add_action( 'vc_grid_item_shortcodes', 'pearl_grid_builder_VC' );

function pearl_grid_builder_VC($shortcodes) {
    /*Separator*/
    $shortcodes['stm_divider'] = array(
        'name' => esc_html__( 'Divider', 'pearl' ),
        'base' => 'stm_separator',
        'category' => esc_html__( 'Content', 'pearl' ),
        'description' => esc_html__( 'Simple separator', 'pearl' ),
        'post_type' => Vc_Grid_Item_Editor::postType(),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Color', 'pearl'),
                'param_name' => 'color',
                'value' => pearl_vc_bg_colors(),
                'std' => 'mbc',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Custom color', 'pearl'),
                'param_name' => 'custom_color',
                'dependency' => array(
                    'element' => 'color',
                    'value' => array('custom')
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Align', 'pearl'),
                'param_name' => 'Align',
                'value' => pearl_vc_align(),
                'std' => 'left',
            ),
            pearl_vc_add_css_editor()
        )
    );

    /*Button*/
    $shortcodes['stm_button'] = array(
        'name' => esc_html__( 'Action Button', 'pearl' ),
        'base' => 'stm_button',
        'icon' => 'stmicon-plus',
        'category' => esc_html__( 'Content', 'pearl'),
        'post_type' => Vc_Grid_Item_Editor::postType(),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Add link', 'pearl'),
                'param_name' => 'button_link',
                'value' => array(
                    esc_html__('Post link', 'pearl') => 'post_link',
                    esc_html__('Custom', 'pearl') => 'custom',
                ),
                'std' => 'post_link',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button text', 'pearl'),
                'param_name' => 'button_text',
                'dependency' => array(
                    'element' => 'button_link',
                    'value' => array('post_link')
                )
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Button link', 'pearl'),
                'param_name' => 'link',
                'dependency' => array(
                    'element' => 'button_link',
                    'value' => array('custom')
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button color scheme', 'pearl'),
                'param_name' => 'button_color',
                'value' => array(
                    esc_html__('Primary', 'pearl') => 'primary',
                    esc_html__('Secondary', 'pearl') => 'secondary',
                    esc_html__('White', 'pearl') => 'white',
                ),
                'std' => 'primary',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button style', 'pearl'),
                'param_name' => 'button_style',
                'value' => array(
                    esc_html__('Solid', 'pearl') => 'solid',
                    esc_html__('Outline', 'pearl') => 'outline'
                ),
                'std' => 'solid',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button icon position', 'pearl'),
                'param_name' => 'button_icon_pos',
                'value' => array(
                    esc_html__('None', 'pearl') => '',
                    esc_html__('Left', 'pearl') => 'left',
                    esc_html__('Right', 'pearl') => 'right',
                ),
                'std' => 'none',
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Button icon', 'pearl'),
                'param_name' => 'button_icon',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_icon_pos',
                    'not_empty' => true
                ),
            ),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor()
        )
    );

	$shortcodes['stm_post_read_more'] = array(
		'name' => esc_html__( 'Read more link', 'pearl' ),
		'base' => 'stm_post_read_more',
		'category' => esc_html__( 'Content', 'pearl' ),
		'description' => esc_html__( 'Read more link', 'pearl' ),
		'post_type' => Vc_Grid_Item_Editor::postType(),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Text', 'pearl'),
				'param_name' => 'text',
				'value' => esc_html__('Read more', 'pearl')
			),
			pearl_load_styles(1)
		)
	);

    return $shortcodes;
}

class WPBakeryShortCode_Stm_Post_Read_More extends WPBakeryShortCode
{
}

