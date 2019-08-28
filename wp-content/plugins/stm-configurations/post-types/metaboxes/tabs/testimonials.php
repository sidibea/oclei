<?php
function pearl_register_testimonials_metabox($manager)
{
    /*Register sections*/
    $manager->register_section(
        'stm_info',
        array(
            'label' => esc_html__('Author Info', 'stm_domain'),
            'icon' => 'fa fa-reply'
        )
    );

    /*Register controls*/

    $manager->register_control(
        'stm_default_title',
        array(
            'type' => 'text',
            'section' => 'stm_info',
            'label' => esc_html__('Author name', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat stm_default_title',
            )
        )
    );

    $manager->register_control(
        'company',
        array(
            'type' => 'text',
            'section' => 'stm_info',
            'label' => esc_html__('Author position', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

    $manager->register_control(
        'review',
        array(
            'type' => 'textarea',
            'section' => 'stm_info',
            'label' => 'Review text',
            'description' => esc_html__('Review text', 'stm_domain'),
        )
    );

    $manager->register_control(
        'avatar',
        array(
            'type' => 'featured',
            'section' => 'stm_info',
            'label' => 'Author image',
            'description' => esc_html__('Attach author image', 'stm_domain'),
            'size' => 'thumbnail',
        )
    );

    $manager->register_setting(
        'stm_default_title',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'company',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'review',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'avatar',
        array('sanitize_callback' => 'stm_listings_validate_image')
    );



}