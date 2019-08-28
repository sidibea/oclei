<?php

function pearl_register_post_box($manager)
{
	$section = 'stm_page_options_section';
	$video_section = 'stm_post_video_settings';

	/*Register sections*/
	$manager->register_section(
		$video_section,
		array(
			'label' => esc_html__('Video', 'stm_domain'),
			'icon' => 'fa fa-film'
		)
	);

	$manager->register_control(
		'single_post_layout',
		array(
			'type' => 'select',
			'section' => $section,
			'label' => esc_html__('Single post layout', 'stm_domain'),
			'choices' => array(
				'' => esc_html__('Global Settings', 'stm_domain'),
				'1'  => esc_html__('Layout 1', 'stm_domain'),
				'2'  => esc_html__('Layout 2', 'stm_domain'),
				'3'  => esc_html__('Layout 3', 'stm_domain'),
				'4'  => esc_html__('Layout 4', 'stm_domain'),
				'5'  => esc_html__('Layout 5', 'stm_domain'),
				'6'  => esc_html__('Layout 6', 'stm_domain'),
				'7'  => esc_html__('Layout 7', 'stm_domain'),
				'8'  => esc_html__('Layout 8', 'stm_domain'),
				'9'  => esc_html__('Layout 9', 'stm_domain'),  //BA
				'10' => esc_html__('Layout 10', 'stm_domain'), //Rental
				'11' => esc_html__('Layout 11', 'stm_domain'), //Portfolio
				'12' => esc_html__('Layout 12', 'stm_domain'), //Personal blog
				'13' => esc_html__('Layout 13', 'stm_domain'), //Store
				'14' => esc_html__('Layout 14', 'stm_domain'), //Personal Blog
				'15' => esc_html__('Layout 15', 'stm_domain'), //Personal Blog
				'16' => esc_html__('Layout 16', 'stm_domain'), //Personal Blog
				'17' => esc_html__('Layout 17', 'stm_domain'), //Viral
				'18' => esc_html__('Layout 18', 'stm_domain'), //Viral
				'19' => esc_html__('Layout 19', 'stm_domain'), //Viral
				'20' => esc_html__('Layout 20', 'stm_domain'), //Viral
			),
			'attr' => array(
				'class' => 'widefat',
			)
		)
	);

	$manager->register_control(
		'single_post_video',
		array(
			'type' => 'text',
			'section' => $video_section,
			'label' => esc_html__('Post video URL', 'stm_domain'),
			'attr' => array(
				'class' => 'widefat',
			)
		)
	);

	$manager->register_control(
		'single_post_video_preview',
		array(
			'type' => 'image',
			'section' => $video_section,
			'label' => 'Post video preview image',
			'description' => esc_html__('Image preview for post video', 'stm_theme_text_domain'),
			'size' => 'thumbnail',
			'default_option' => true,
		)
	);

    $manager->register_control(
        'single_post_banner',
        array(
            'type' => 'text',
            'section' => $section,
            'label' => esc_html__('Banner in content', 'stm_domain'),
            'default_option' => false,
            'description' => esc_html__('Add AdRotate shortcode', 'stm_theme_text_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

	$manager->register_control(
		'disable_post_sidebar',
		array(
			'type' => 'checkbox',
			'section' => $section,
			'label' => esc_html__('Disable post sidebar', 'stm_domain'),
			'default_option' => true,
		)
	);


	$manager->register_setting(
		'single_post_layout',
		array (
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

	$manager->register_setting(
		'single_post_video',
		array (
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

	$manager->register_setting(
		'single_post_video_preview',
		array (
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

    $manager->register_setting(
        'single_post_banner',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

	$manager->register_setting(
		'disable_post_sidebar',
		array (
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);





	/*Register controls*/
	$fields = array(
		'stm_post_icon' => array(
			'type' => 'iconpicker',
			'label' => esc_html__('Icon', 'stm_domain'),
		),
	);

	$fields = apply_filters('stm_post_butterbean_fields', $fields);

	foreach($fields as $field => $field_info) {
		/*Register control*/
		$type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
		$validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
		$manager->register_control(
			$field,
			array(
				'type' => $type,
				'section' => $section,
				'label' => $field_info['label'],
				'attr' => array(
					'class' => 'widefat',
				)
			)
		);

		/*Register setting*/
		$manager->register_setting(
			$field,
			array(
				'sanitize_callback' => $validate,
			)
		);
	}
}