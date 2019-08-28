<?php
/* Register Page sidebar*/
function pearl_register_page_sidebar_metabox($manager)
{
    /*Get sidebars*/
    $sidebars = stm_get_post_type('stm_sidebars');
    $all_sidebars = array(
        '' => esc_html__('None', 'stm_domain'),
        'default' => esc_html__('Default', 'stm_domain')
    );
    $all_sidebars += $sidebars;


    /*Register sections*/
    $manager->register_section(
        'stm_sidebar_section',
        array(
            'label' => esc_html__('Sidebar', 'stm_domain'),
            'icon' => 'fa fa-columns'
        )
    );

    /*Register controls*/

    $manager->register_control(
        'stm_sidebar',
        array(
            'type' => 'select',
            'section' => 'stm_sidebar_section',
            'label' => __('Choose sidebar', 'stm_domain'),
            'choices' => $all_sidebars,
            'default_option' => true,
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

    $manager->register_control(
        'stm_sidebar_position',
        array(
            'type' => 'select',
            'section' => 'stm_sidebar_section',
            'label' => __('Sidebar position', 'stm_domain'),
            'choices' => array(
                'left' => esc_html__('Left', 'stm_domain'),
                'right' => esc_html__('Right', 'stm_domain'),
            ),
            'default_option' => true,
            'attr' => array(
                'class' => 'widefat',
                'data-dep' => 'stm_sidebar',
                'data-value' => 'not_empty'
            )
        )
    );
    /*Register settings*/
    $manager->register_setting(
        'stm_sidebar',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'stm_sidebar_position',
        array(
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );
}