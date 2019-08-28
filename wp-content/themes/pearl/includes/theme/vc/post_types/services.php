<?php
add_action('init', 'pearl_services_VC');

function pearl_services_VC()
{

	$taxes = pearl_autocomplete_terms('service_category', false, true);

	vc_map(array(
		'name'     => esc_html__('Pearl Services Grid', 'pearl'),
		'base'     => 'stm_services',
		'description' => esc_html__('List of services posts', 'pearl'),
		'icon'     => 'pearl-service_grid',
		'category' => esc_html__('Content', 'pearl'),
		'params'   => array(
			array(
				'type' => 'autocomplete',
				'heading' => esc_html__( 'Select taxonomy', 'pearl' ),
				'param_name' => 'taxonomy',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'min_length' => 1,
					'no_hide' => true,
					'unique_values' => true,
					'display_inline' => true,
					'values' => $taxes
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Number of services to display', 'pearl'),
				'param_name' => 'number',
				'std'        => '9'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable Pagination', 'pearl'),
				'param_name' => 'pagination',
				'value'      => array(
					esc_html__('Enable', 'pearl')  => 'on',
					esc_html__('Disable', 'pearl') => 'off',
				),
				'std'        => 'on'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Excerpt length', 'pearl'),
				'param_name' => 'excerpt',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Image Size', 'pearl'),
				'param_name'  => 'img_size',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
			),
			pearl_vc_per_row(),
			pearl_load_styles(11, 'style', true),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor()
		)
	));

	vc_map(array(
		'name'     => esc_html__('Pearl Services Price List', 'pearl'),
		'base'     => 'stm_price_list',
		'icon'     => 'pearl-price_list',
		'description' => esc_html__('Pricing list', 'pearl'),
		'category' => esc_html__('Pearl', 'pearl'),
		'params'   => array(
			array(
				'type' => 'autocomplete',
				'heading' => esc_html__( 'Select taxonomy', 'pearl' ),
				'param_name' => 'taxonomy',
				'settings' => array(
					'multiple' => true,
					'sortable' => true,
					'min_length' => 1,
					'no_hide' => true,
					'unique_values' => true,
					'display_inline' => true,
					'values' => $taxes
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title', 'pearl'),
				'param_name' => 'title',
				'std'        => ''
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Show image', 'pearl'),
				'param_name' => 'show_image',
				'value'      => array(
					esc_html__('Show', 'pearl') => 'show',
					esc_html__('Hide', 'pearl') => 'hide',
				),
				'std'        => 'hide'
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Image size', 'pearl'),
				'param_name' => 'img_size',
				'std'        => 'thumbnail',
				'dependency' => array(
					'element'  => 'show_image',
					'value' => 'show'
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Excerpt length', 'pearl'),
				'param_name' => 'excerpt_length',
				'std'        => ''
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Enable post link', 'pearl'),
				'param_name' => 'post_link',
				'std'        => 'true'

			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Enable lightbox', 'pearl'),
				'param_name' => 'lightbox',
				'value'      => array(
					esc_html__('Enable', 'pearl')  => 'enable',
					esc_html__('Disable', 'pearl') => 'disable',
				),
				'std'        => 'disable'
			),
			array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('Button', 'pearl'),
				'param_name' => 'link',
				'std'        => ''
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Extra class name', 'pearl'),
				'param_name'  => 'el_class',
				'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Layout', 'pearl'),
				'param_name' => 'layout',
				'value'      => array(
					esc_html__('Tabs', 'pearl') => 'tabs',
					esc_html__('List', 'pearl') => 'list',
				),
				'std'        => 'tabs'
			),
			pearl_load_styles(3, 'style', true),
			pearl_vc_add_css_editor()
		)
	));
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Services extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_Price_List extends WPBakeryShortCode
	{
	}
}