<?php

function pearl_register_product_metabox($manager)
{
    /*Register sections*/
    $manager->register_section(
        'product',
        array(
            'label' => esc_html__('360 degree', 'stm_domain'),
            'icon' => 'fa fa-user'
        )
    );

    /*Register controls*/
    $fields = array(
        'three_hundred_sixty' => array(
            'type' => 'checkbox',
            'label' => esc_html__('Show 360 degree', 'stm_domain'),
            'default_option' => true,
            'attr' => array()
        ),
    );

    $fields = apply_filters('product_details', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
        $attrs = (!empty($field_info['attr'])) ? $field_info['attr'] : array('class' => 'widefat');
        $manager->register_control(
            $field,
            array(
                'type' => $type,
                'section' => 'product',
                'label' => $field_info['label'],
                'attr' => $attrs
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