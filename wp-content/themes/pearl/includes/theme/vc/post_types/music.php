<?php
add_action('init', 'pearl_music_map');

function pearl_music_map()
{
    $category = pearl_get_terms_vc('album_category');
	$music = pearl_vc_post_type('stm_albums');

	vc_map(array(
		'name'     => esc_html__('Pearl Album List', 'pearl'),
		'base'     => 'stm_album_list',
		'icon'     => 'pearl-album-list',
		'description' => esc_html__('List of albums', 'pearl'),
		'category' => esc_html__('Content', 'pearl'),
		'params'   => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title', 'pearl'),
				'param_name' => 'title'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__('Title color', 'pearl'),
				'param_name'  => 'text_class',
				'value'       => array(
					esc_html__('Default', 'pearl')         => 'default',
					esc_html__('Primary color', 'pearl')   => 'mtc',
					esc_html__('Secondary color', 'pearl') => 'stc',
					esc_html__('Third color', 'pearl')     => 'ttc',
					esc_html__('White color', 'pearl')     => 'wtc',
				),
				'description' => esc_html__('Select text color', 'pearl'),
				'std'         => 'default',
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Category', 'pearl'),
				'param_name' => 'category',
				'value'      => $category,
				'std'        => 'all',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Number of posts', 'pearl'),
				'param_name' => 'posts_per_page'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__('Images size', 'pearl'),
				'param_name'  => 'img_size',
				'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'pearl')
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Carousel', 'pearl'),
				'param_name' => 'carousel',
				'value'      => array(
					esc_html__('Enable', 'pearl')  => 'enable',
					esc_html__('Disable', 'pearl') => 'disable',
				),
				'std'        => 'enable'
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
		)
	));

	vc_map(array(
		'name'     => esc_html__('Pearl Album Info', 'pearl'),
		'base'     => 'stm_album_info',
		'icon'     => 'album-info',
		'description' => esc_html__('List of tracks', 'pearl'),
		'category' => esc_html__('Content', 'pearl'),
		'params'   => array(
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Title', 'pearl'),
				'param_name' => 'title'
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__('Choose Album', 'pearl'),
				'param_name' => 'album',
				'value'      => $music,
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__('Inversed', 'pearl'),
				'param_name' => 'inversed'
			),
			vc_map_add_css_animation(),
			pearl_vc_add_css_editor(),
		)
	));

	class WPBakeryShortCode_Stm_Album_List extends WPBakeryShortCode
	{
	}

	class WPBakeryShortCode_Stm_Album_Info extends WPBakeryShortCode
	{
	}
}