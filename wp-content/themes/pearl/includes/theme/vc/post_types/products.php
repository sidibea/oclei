<?php
add_action('init', 'pearl_products_VC');

function pearl_products_VC()
{

	$taxes = pearl_autocomplete_terms('products_category', false, true);

	vc_map(array(
		'name'     => esc_html__('Pearl Products Grid', 'pearl'),
		'base'     => 'stm_products',
		'description' => esc_html__('List of Products posts', 'pearl'),
		'icon'     => 'pearl-products_grid',
		'category' => esc_html__('Content', 'pearl'),
		'params'   => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Number of Products to display', 'pearl'),
				'param_name' => 'number',
				'std'        => '9'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Image Size', 'pearl'),
				'param_name'  => 'img_size',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__('Show Categories', 'pearl'),
				'param_name'  => 'show_categories',
				'value' => 'true'
			),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items per row', 'pearl'),
                'param_name' => 'per_row',
                'value' => array(
                    esc_html__('1', 'pearl') => '1',
                    esc_html__('2', 'pearl') => '2',
                    esc_html__('3', 'pearl') => '3',
                    esc_html__('4', 'pearl') => '4',
                ),
                'std' => '3',
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Enable Load more button', 'pearl'),
                'param_name' => 'load_more',
                'value' => array(
                    esc_html__('Enable', 'pearl')  => 'true',
                    esc_html__('Disable', 'pearl')  => 'false'
                ),
                'std' => 'true'
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Enable Pagination', 'pearl'),
                'param_name' => 'pagination',
                'dependency' => array(
                    'element' => 'load_more',
                    'value' =>  'false'
                ),
            ),
			pearl_load_styles(3, 'style', true),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Products extends WPBakeryShortCode
	{
	}
}