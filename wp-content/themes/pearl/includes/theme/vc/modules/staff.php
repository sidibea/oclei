<?php

vc_map(
	array(
		'name'            => esc_html__('Pearl Staff', 'pearl'),
		'base'            => 'stm_staff_container',
		'icon'            => 'icon-wpb-wp',
		'as_parent'       => array('only' => 'stm_staff, stm_staff_cta'),
		'content_element' => true,
		'is_container'    => true,
		'description' => esc_html__('Team overview', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params'          => array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Layout', 'pearl'),
				'param_name' => 'layout',
				'value'      => array(
					esc_html__('List style', 'pearl') => 'list',
					esc_html__('Grid style', 'pearl') => 'grid'
				),
				'std'        => 'list',
				'admin_label' => true
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Enable Carousel', 'pearl'),
				'param_name' => 'carousel',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Enable arrows', 'pearl'),
				'param_name' => 'carousel_arrows',
				'dependency' => array(
					'element'   => 'carousel',
					'not_empty' => true
				),
				'std' => 'true'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Enable Autoplay', 'pearl'),
				'param_name' => 'autoplay',
				'dependency' => array(
					'element'   => 'carousel',
					'not_empty' => true
				)
			),
			pearl_load_styles(7, 'style', true),
			pearl_vc_per_row(
				'cols',
				array(
					'element' => 'layout',
					'value'   => 'grid'
				)
			),
			pearl_vc_add_css_editor(),
			vc_map_add_css_animation(),
		),
		'js_view'         => 'VcColumnView'
	)
);


vc_map(array(
	'name'            => esc_html__('Staff element', 'pearl'),
	'base'            => 'stm_staff',
	'icon'            => 'icon-wpb-wp',
	'content_element' => true,
	"as_child"        => array('only' => 'stm_staff_container'),
	'params'          => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Name', 'pearl'),
			'param_name' => 'name',
			'holder'     => 'div'
		),
		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__('Staff Image', 'pearl'),
			'param_name' => 'image'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Image Size', 'pearl'),
			'param_name'  => 'image_size',
			'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Job Title', 'pearl'),
			'param_name' => 'job'
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Email', 'pearl'),
			'param_name' => 'email',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Phone number', 'pearl'),
			'param_name' => 'phone',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Skype ID', 'pearl'),
			'param_name' => 'skype',
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__('Description', 'pearl'),
			'param_name' => 'description',
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__('Full Description', 'pearl'),
			'param_name' => 'full_description',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Facebook', 'pearl'),
			'param_name' => 'facebook',
			'group'      => esc_html__('Socials', 'pearl')
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Twitter', 'pearl'),
			'param_name' => 'twitter',
			'group'      => esc_html__('Socials', 'pearl')
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Linkedin', 'pearl'),
			'param_name' => 'linkedin',
			'group'      => esc_html__('Socials', 'pearl')
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Google plus', 'pearl'),
			'param_name' => 'gplus',
			'group'      => esc_html__('Socials', 'pearl')
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Instagram', 'pearl'),
			'param_name' => 'insta',
			'group'      => esc_html__('Socials', 'pearl')
		),
		vc_map_add_css_animation(),
		pearl_vc_add_css_editor()
	),
));

vc_map(array(
	'name'            => esc_html__('Staff Call to Action', 'pearl'),
	'base'            => 'stm_staff_cta',
	'icon'            => 'icon-wpb-wp',
	'content_element' => true,
	"as_child"        => array('only' => 'stm_staff_container'),
	'params'          => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__('Text', 'pearl'),
			'param_name' => 'text',
			'holder'     => 'div'
		),
		array(
			'type'       => 'vc_link',
			'heading'    => esc_html__('Link', 'pearl'),
			'param_name' => 'link',
		),
		vc_map_add_css_animation(),
		pearl_vc_add_css_editor()
	),
));



if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Staff extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_Staff_Cta extends WPBakeryShortCode
	{
	}
}

if (class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_Stm_Staff_Container extends WPBakeryShortCodesContainer
	{
	}
}