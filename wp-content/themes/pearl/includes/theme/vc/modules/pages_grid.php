<?php

$pages_data = array();
if(is_admin()) {
	$pages = get_pages();
	foreach ($pages as $page) {
		$pages_data[] = array(
			'label' => $page->post_title,
			'value' => $page->ID
		);
	}
}


vc_map(array(
	'name'        => esc_html__('Pearl Pages Grid', 'pearl'),
	'base'        => 'stm_pages_grid',
	'icon'        => 'icon-wpb-wp',
	'category' =>array(
		esc_html__('Content', 'pearl'),
		esc_html__('Pearl', 'pearl')
	),
	'class'       => 'wpb_vc_stm_widget',
	'weight'      => -50,
	'params'      => array(
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Widget title', 'pearl'),
			'param_name'  => 'title',
			'description' => esc_html__('What text use as a widget title. Leave blank to use default widget title.', 'pearl')
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__('Order by', 'pearl'),
			'param_name'  => 'sortby',
			'value'       => array(
				esc_html__('Page title', 'pearl') => 'post_title',
				esc_html__('Page order', 'pearl') => 'menu_order',
				esc_html__('Page ID', 'pearl')    => 'ID'
			),
			'description' => esc_html__('Select how to sort pages.', 'pearl'),
			'admin_label' => true
		),
		array(
			'type'        => 'autocomplete',
			'heading'     => esc_html__('Include', 'pearl'),
			'param_name'  => 'include',
			'description' => esc_html__('Enter page IDs to be included (Note: separate values by commas (,)).', 'pearl'),
			'admin_label' => true,
			'settings' => array(
				'multiple' => true,
				'sortable' => true,
				'min_length' => 1,
				'no_hide' => true,
				'unique_values' => true,
				'display_inline' => true,
				'values' => $pages_data
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Image size', 'pearl'),
			'param_name'  => 'img_size',
			'description' => esc_html__('Enter image size. Ex.: 300x200', 'pearl')
		),
		pearl_load_styles(1)
	)
));

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Pages_Grid extends WPBakeryShortCode
	{
	}
}