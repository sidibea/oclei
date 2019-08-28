<?php
function pearl_register_stories_metabox($manager)
{
    /*Register sections*/
    $manager->register_section(
        'stm_stories_details',
        array(
            'label' => esc_html__('Story details', 'stm_domain'),
            'icon' => 'fa fa-bookmark'
        )
    );

    /*Register controls*/
    $fields = array(
        'stm_before' => array(
            'type' => 'image',
            'label' => esc_html__('Before Image', 'stm_domain'),
        ),
        'stm_after' => array(
            'type' => 'image',
            'label' => esc_html__('After Image', 'stm_domain'),
        ),
        'stm_intro' => array(
            'type' => 'text',
            'label' => esc_html__('Story intro', 'stm_domain'),
        ),
        'stm_info' => array(
            'type' => 'repeater-double',
            'label' => esc_html__('Person Data', 'stm_domain'),
        ),
    );

    $fields = apply_filters('stm_services_fields', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
        $manager->register_control(
            $field,
            array(
                'type' => $type,
                'section' => 'stm_stories_details',
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