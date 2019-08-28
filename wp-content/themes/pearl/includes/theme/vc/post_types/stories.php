<?php
add_action( 'init', 'pearl_stories_VC' );

function pearl_stories_VC()
{
    vc_map(array(
        'name'     => esc_html__('Stories Carousel', 'pearl'),
        'base'     => 'stm_stories_carousel',
		'description' => esc_html__('Testimonials with before/after image', 'pearl'),
		'icon'     => 'pearl-stories',
        'category' => esc_html__('Content', 'pearl'),
        'params'   => array(
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Title', 'pearl'),
                'param_name' => 'title',
                'holder' => 'div'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Number of posts', 'pearl'),
                'param_name' => 'posts_per_page'
            ),
            pearl_load_styles(2),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
        )
    ));

    vc_map(array(
        'name'     => esc_html__('Pearl Stories List', 'pearl'),
        'base'     => 'stm_stories_list',
		'description' => esc_html__('List of stories', 'pearl'),
		'icon'     => 'pearl-stories',
        'category' => esc_html__('Content', 'pearl'),
        'params'   => array(
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Number of posts', 'pearl'),
                'param_name' => 'posts_per_page'
            ),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Show pagination', 'pearl'),
				'param_name' => 'show_pagination',
				'std' => 'true'
			),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image size', 'pearl'),
                'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'pearl'),
                'param_name' => 'img_size',
                'value' => '350x215'
            ),
            pearl_load_styles(1),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Stories_Carousel extends WPBakeryShortCode{}
    class WPBakeryShortCode_Stm_Stories_List extends WPBakeryShortCode{}
}