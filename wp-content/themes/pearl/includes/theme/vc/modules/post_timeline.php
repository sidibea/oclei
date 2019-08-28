<?php
add_action('init', 'pearl_moduleVC_posttimeline');

function pearl_moduleVC_posttimeline()
{
	vc_map(array(
        'name'   => esc_html__('Pearl Timeline', 'pearl'),
        'base'   => 'stm_posttimeline',
        'icon'   => 'stmicon-marquee',
		'description' => esc_html__('Posts in timeline style', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
            array(
                'type' => 'autocomplete',
                'heading' => esc_html__( 'Check taxonomy to show posts', 'pearl' ),
                'param_name' => 'categories',
                'settings' => array(
                    'multiple' => true,
                    'min_length' => 1,
                    'groups' => true,
                    // In UI show results grouped by groups, default false
                    'unique_values' => true,
                    // In UI show results except selected. NB! You should manually check values in backend, default false
                    'display_inline' => true,
                    // In UI show results inline view, default false (each value in own line)
                    'delay' => 500,
                    // delay for search. default 500
                    'auto_focus' => true,
                    // auto focus input, default true
                ),
                'param_holder_class' => 'vc_not-for-custom',
                'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'pearl' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Title length', 'pearl'),
                'param_name'  => 'length',
                'std'         => '40'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Number of posts to show', 'pearl'),
                'param_name'  => 'posts_per_page',
                'std'         => '-1'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Show year', 'pearl'),
                'param_name' => 'show_year',
                'std' => 'true'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Show title', 'pearl'),
                'param_name' => 'show_title',
                'std' => 'true'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Image Size', 'pearl'),
                'param_name'  => 'image_size',
                'std'         => '255x255',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
            ),
			pearl_load_styles(4),
            vc_map_add_css_animation(),
            pearl_vc_add_css_editor(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Posttimeline extends WPBakeryShortCode
    {
    }
}


//Filter categories
add_filter('vc_autocomplete_stm_posttimeline_categories_callback', 'pearl_get_ajax_categories', 100, 1);

function pearl_get_ajax_categories($search_string) {
    $data = array();
    if(!empty($search_string) and is_admin()) {
        $vc_taxonomies_types = array_keys( vc_taxonomies_types() );
        $vc_taxonomies_types = (!empty($vc_taxonomies_types)) ? $vc_taxonomies_types : array();
        $vc_taxonomies = get_terms( $vc_taxonomies_types, array(
            'hide_empty' => false,
            'search' => $search_string,
        ) );

        if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
            foreach ( $vc_taxonomies as $t ) {
                if ( is_object( $t ) ) {
                    $data[] = vc_get_term_object( $t );
                }
            }
        }
    }

    return $data;
}