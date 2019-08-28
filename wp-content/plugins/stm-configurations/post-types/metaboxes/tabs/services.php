<?php
function pearl_register_services_metabox($manager)
{

    $theme_options = get_option('stm_theme_options');
    if( $theme_options['stm_services_layout'] == '2' ) {
        /*Register sections*/
        $manager->register_section(
            'stm_service_rental_details',
            array(
                'label' => esc_html__('Service rental', 'stm_domain'),
                'icon' => 'fa fa-life-ring'
            )
        );

        /*Register controls*/
        $fields = array(
            'service_rental_prices' => array(
                'type' => 'repeater-double',
                'label' => esc_html__('Item prices', 'stm_domain'),
            ),
            'service_rental_badge' => array(
                'type' => 'text',
                'label' => esc_html__('Badge text', 'stm_domain'),
            ),
            'service_rental_details' => array(
                'type' => 'repeater-double',
                'label' => esc_html__('Item details', 'stm_domain'),
            ),
            'service_rental_features' => array(
                'type' => 'repeater',
                'label' => esc_html__('Features', 'stm_domain'),
            )
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
                    'section' => 'stm_service_rental_details',
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


    /*Register sections*/
    $manager->register_section(
        'stm_service_details',
        array(
            'label' => esc_html__('Service details', 'stm_domain'),
            'icon' => 'fa fa-bookmark'
        )
    );

    /*Register controls*/
    $fields = array(
        'service_icon' => array(
            'type' => 'iconpicker',
            'label' => esc_html__('Icon', 'stm_domain'),
        ),
        'service_price' => array(
            'type' => 'text',
            'label' => esc_html__('Price', 'stm_domain'),
        ),
        'service_badge' => array(
            'type' => 'text',
            'label' => esc_html__('Badge text', 'stm_domain'),
        )
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
                'section' => 'stm_service_details',
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


