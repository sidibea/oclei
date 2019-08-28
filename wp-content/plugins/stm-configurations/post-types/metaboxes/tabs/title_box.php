<?php
function pearl_register_title_box_metabox($manager, $post_type)
{


	/**
	 * @var $manager ButterBean_Manager
	 */

    /*Register sections*/
    $manager->register_section(
        'stm_view_section',
        array(
            'label' => esc_html__('Title Box', 'stm_domain'),
            'icon' => 'fa fa-list-ul'
        )
    );

    /*Register controls*/
    $manager->register_control(
        'page_title_box',
        array(
            'type' => 'checkbox',
            'section' => 'stm_view_section',
            'label' => esc_html__('Enable title box', 'stm_domain'),
            'default_option' => true,
            'attr' => array()
        )
    );

	$manager->register_control(
		'page_title_box_category',
		array(
			'type' => 'checkbox',
			'section' => 'stm_view_section',
			'label' => __('Show category', 'stm_domain'),
			'default_option' => false,
			'attr' => array(
				'class' => 'widefat',
				'data-dep' => 'page_title_box',
				'data-value' => 'true'
			)
		)
	);

	$manager->register_control(
		'page_title_box_author',
		array(
			'type' => 'checkbox',
			'section' => 'stm_view_section',
			'label' => __('Show author', 'stm_domain'),
			'default_option' => false,
			'attr' => array(
				'class' => 'widefat',
				'data-dep' => 'page_title_box',
				'data-value' => 'true'
			)
		)
	);


	$manager->register_control(
        'page_title_box_align',
        array(
            'type' => 'select',
            'section' => 'stm_view_section',
            'label' => __('Text align', 'stm_domain'),
            'choices' => array(
                'left' => esc_html__('Left', 'stm_domain'),
                'center' => esc_html__('Center', 'stm_domain'),
                'right' => esc_html__('Right', 'stm_domain'),
            ),
            'default_option' => true,
            'attr' => array(
                'class' => 'widefat',
                'data-dep' => 'page_title_box',
                'data-value' => 'true'
            )
        )
    );

    $manager->register_control(
        'page_title_box_title',
        array(
            'type' => 'text',
            'section' => 'stm_view_section',
            'label' => esc_html__('Title', 'stm_domain'),
            'default_option' => true,
            'attr' => array(
                'class' => 'widefat',
                'data-dep' => 'page_title_box',
                'data-value' => 'true'
            )
        )
    );

	$manager->register_control(
		'page_title_box_title_line',
		array(
			'type' => 'checkbox',
			'section' => 'stm_view_section',
			'label' => esc_html__('Enable Title line', 'stm_domain'),
			'default_option' => true,
			'attr' => array()
		)
	);

	$manager->register_control(
		'page_title_box_title_size',
		array(
			'type' => 'select',
			'section' => 'stm_view_section',
			'label' => __('Select title size', 'stm_domain'),
			'choices' => array(
				'h1' => esc_html__('H1', 'stm_domain'),
				'h2' => esc_html__('H2', 'stm_domain'),
				'h3' => esc_html__('H3', 'stm_domain'),
				'h5' => esc_html__('H5', 'stm_domain'),
				'h6' => esc_html__('H6', 'stm_domain'),
			),
			'default_option' => true,
			'attr' => array(
				'class' => 'widefat'
			)
		)
	);

    $manager->register_control(
        'page_title_box_subtitle',
        array(
            'type' => 'text',
            'section' => 'stm_view_section',
            'label' => esc_html__('Subtitle text', 'stm_domain'),
            'default_option' => true,
            'attr' => array(
                'class' => 'widefat',
                'data-dep' => 'page_title_box',
                'data-value' => 'true'
            )
        )
    );

    $manager->register_control(
        'page_title_box_bg_color',
        array(
            'type' => 'color',
            'section' => 'stm_view_section',
            'label' => esc_html__('Background color', 'stm_domain'),
            'default_option' => true,
            'attr' => array(
                'class' => 'color-picker',
                'data-dep' => 'page_title_box',
                'data-value' => 'true',
            )
        )
    );

    $manager->register_control(
        'page_title_box_bg_image',
        array(
            'type' => 'image',
            'section' => 'stm_view_section',
            'label' => 'Title Box Background',
            'description' => esc_html__('Image for title box background', 'stm_theme_text_domain'),
            'size' => 'thumbnail',
            'default_option' => true,
            'attr' => array(
                'data-dep' => 'page_title_box',
                'data-value' => 'true'
            )
        )
    );

	$manager->register_control(
		'page_title_box_bg_pos',
		array(
			'type' => 'text',
			'section' => 'stm_view_section',
			'label' => esc_html__('Title Box Background Position', 'stm_domain'),
			'description' => esc_html__('Set background position. Ex. : 0 50% or 10px 130px'),
			'attr' => array(
				'data-dep' => 'page_title_box',
				'data-value' => 'true',
				'class' => 'wideflat',
			)
		)
	);


    $manager->register_control(
        'page_title_box_text_color',
        array(
            'type' => 'color',
            'section' => 'stm_view_section',
            'label' => esc_html__('Text color', 'stm_domain'),
            'default_option' => true,
            'attr' => array(
                'data-dep' => 'page_title_box',
                'data-value' => 'true'
            )
        )
    );

    $manager->register_control(
        'page_title_box_line_color',
        array(
            'type' => 'color',
            'section' => 'stm_view_section',
            'label' => esc_html__('Line color', 'stm_domain'),
            'default_option' => true,
            'attr' => array(
                'data-dep' => 'page_title_box',
                'data-value' => 'true'
            )
        )
    );

    $manager->register_control(
        'page_title_box_subtitle_color',
        array(
            'type' => 'color',
            'section' => 'stm_view_section',
            'label' => esc_html__('Subtitle color', 'stm_domain'),
            'default_option' => true,
            'attr' => array(
                'data-dep' => 'page_title_box',
                'data-value' => 'true'
            )
        )
    );

    /*Breadcrumbs*/
    $manager->register_control(
        'page_title_breadcrumbs',
        array(
            'type' => 'checkbox',
            'section' => 'stm_view_section',
            'label' => esc_html__('Enable breadcrumbs', 'stm_domain'),
            'default_option' => true,
            'attr' => array()
        )
    );

    /*Button title box*/
    $manager->register_control(
        'page_title_button',
        array(
            'type' => 'checkbox',
            'section' => 'stm_view_section',
            'label' => esc_html__('Enable title box button', 'stm_domain'),
            'default_option' => true,
            'attr' => array()
        )
    );

    $manager->register_control(
        'page_title_button_text',
        array(
            'type' => 'text',
            'section' => 'stm_view_section',
            'label' => esc_html__('Button text', 'stm_domain'),
            'default_option' => true,
            'attr' => array(
                'class' => 'widefat',
                'data-dep' => 'page_title_button',
                'data-value' => 'true'
            )
        )
    );

    $manager->register_control(
        'page_title_button_url',
        array(
            'type' => 'text',
            'section' => 'stm_view_section',
            'label' => esc_html__('Button url', 'stm_domain'),
            'default_option' => true,
            'attr' => array(
                'class' => 'widefat',
                'data-dep' => 'page_title_button',
                'data-value' => 'true'
            )
        )
    );

    /*Register settings*/
    $manager->register_setting(
        'page_title_breadcrumbs',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_box',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

	$manager->register_setting(
		'page_title_box_category',
		array (
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

	$manager->register_setting(
		'page_title_box_author',
		array (
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

    $manager->register_setting(
        'page_title_box_align',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_box_title',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

	$manager->register_setting(
		'page_title_box_title_line',
		array(
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

	$manager->register_setting(
		'page_title_box_title_size',
		array(
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

    $manager->register_setting(
        'page_title_box_subtitle',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_box_bg_color',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_box_bg_image',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

	$manager->register_setting(
		'page_title_box_bg_pos',
		array(
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

    $manager->register_setting(
        'page_title_box_text_color',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_box_line_color',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_box_subtitle_color',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_button',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_button_text',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'page_title_button_url',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    /*Enable prev/next*/
    $posts = array(
        'stm_projects'
    );

    if(!in_array($post_type, $posts)) return false;

    $manager->register_control(
        'page_title_prev_next',
        array(
            'type' => 'checkbox',
            'section' => 'stm_view_section',
            'label' => esc_html__('Show prev/next posts', 'stm_domain'),
            'default_option' => true,
            'attr' => array()
        )
    );

    $manager->register_setting(
        'page_title_prev_next',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );
}