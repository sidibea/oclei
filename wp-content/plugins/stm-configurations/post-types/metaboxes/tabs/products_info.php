<?php
function pearl_register_products_info_metabox($manager)
{


    /*Register sections*/
    $manager->register_section(
        'stm_products_info',
        array(
            'label' => esc_html__('Product Info', 'stm_domain'),
            'icon' => 'fa fa-info-circle'
        )
    );

    /*Register controls*/
    $fields = array(
		'product_short_description' => array(
			'type' => 'textarea',
			'label' => esc_html__('Short Description', 'stm_domain'),
		),
        'product_id1' => array(
            'type' => 'text',
            'label' => esc_html__('Id 1', 'stm_domain'),
        ),
        'product_id2' => array(
            'type' => 'text',
            'label' => esc_html__('Id 2', 'stm_domain'),
        ),
        'product_id3' => array(
            'type' => 'text',
            'label' => esc_html__('Id 3', 'stm_domain'),
        ),
        'product_id4' => array(
            'type' => 'text',
            'label' => esc_html__('Id 4', 'stm_domain'),
        ),
        'product_id5' => array(
            'type' => 'text',
            'label' => esc_html__('Id 5', 'stm_domain'),
        ),
    );

    $fields = apply_filters('stm_products_fields', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';

        $fields = array(
            'type' => $type,
            'section' => 'stm_products_info',
            'label' => $field_info['label'],
            'attr' => array(
                'class' => 'widefat',
            )
        );

        if(!empty($field_info['choices'])) $fields['choices'] = $field_info['choices'];
        if(!empty($field_info['attr'])) $fields['attr'] = $field_info['attr'];

        $manager->register_control(
            $field,
            $fields
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