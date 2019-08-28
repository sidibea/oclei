<?php
/*Register fields for vacancies*/
function pearl_register_vacancies_metabox($manager) {
    /*Register sections*/
    $manager->register_section(
        'stm_vacancy_section',
        array(
            'label' => esc_html__('Vacancy Info', 'stm_domain'),
            'icon' => 'fa fa-user'
        )
    );

    /*Register controls*/
    $manager->register_control(
        'vacancy_icon',
        array(
            'type' => 'iconpicker',
            'section' => 'stm_vacancy_section',
            'label' => esc_html__('Icon', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

    $manager->register_control(
        'location',
        array(
            'type' => 'text',
            'section' => 'stm_vacancy_section',
            'label' => esc_html__('Location', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

    $manager->register_control(
        'department',
        array(
            'type' => 'text',
            'section' => 'stm_vacancy_section',
            'label' => esc_html__('Department', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

    $manager->register_control(
        'job_type',
        array(
            'type' => 'text',
            'section' => 'stm_vacancy_section',
            'label' => esc_html__('Job type', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

    $manager->register_control(
        'education',
        array(
            'type' => 'text',
            'section' => 'stm_vacancy_section',
            'label' => esc_html__('Education', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

    $manager->register_control(
        'compensation',
        array(
            'type' => 'text',
            'section' => 'stm_vacancy_section',
            'label' => esc_html__('Compensation', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );

    /*Register settings*/
    $manager->register_setting(
        'vacancy_icon',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'location',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'department',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'job_type',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'education',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

    $manager->register_setting(
        'compensation',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );
}