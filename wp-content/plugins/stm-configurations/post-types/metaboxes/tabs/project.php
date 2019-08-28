<?php
/* Register Page sidebar*/
function pearl_register_projects_box($manager)
{

    /*Register sections*/
    $manager->register_section(
        'stm_project_info',
        array(
            'label' => esc_html__('Details', 'stm_domain'),
            'icon' => 'fa fa-file-text'
        )
    );

    $fields = array(
        'client' => esc_html__('Client name', 'stm_domain'),
        'location'=> esc_html__('Location', 'stm_domain'),
        'surface'=> esc_html__('Surface Area', 'stm_domain'),
        'started'=> esc_html__('Started', 'stm_domain'),
        'completed'=> esc_html__('Completed', 'stm_domain'),
        'date'=> esc_html__('Date', 'stm_domain'),
        'value'=> esc_html__('Value', 'stm_domain'),
        'category'=> esc_html__('Category', 'stm_domain'),
        'architect'=> esc_html__('Architect', 'stm_domain')
    );

    $fields = apply_filters('stm_projects_fields', $fields);

    foreach($fields as $field => $field_name) {
        /*Register control*/
        $manager->register_control(
            $field,
            array(
                'type' => 'text',
                'section' => 'stm_project_info',
                'label' => $field_name,
                'attr' => array(
                    'class' => 'widefat',
                )
            )
        );

        /*Register setting*/
        $manager->register_setting(
            $field,
            array(
                'sanitize_callback' => 'stm_listings_no_validate',
            )
        );
    }
}