<?php
function pearl_register_products_metabox($manager)
{


    /*Register sections*/
    $manager->register_section(
        'stm_products_details',
        array(
            'label' => esc_html__('Product tabs', 'stm_domain'),
            'icon' => 'fa fa-list-alt'
        )
    );

    /*Register controls*/
    $fields = array(
        'product_tab_1' => array(
            'type' => 'text',
            'label' => esc_html__('Details', 'stm_domain'),
        ),
        'product_tab_2' => array(
            'type' => 'text',
            'label' => esc_html__('Gallery', 'stm_domain'),
        ),
        'product_tab_3' => array(
            'type' => 'text',
            'label' => esc_html__('Certificates', 'stm_domain'),
        ),
        'product_tab_4' => array(
            'type' => 'text',
            'label' => esc_html__('Trim Products', 'stm_domain'),
        ),
        'product_tab_5' => array(
            'type' => 'text',
            'label' => esc_html__('Enquiry', 'stm_domain'),
        ),

        'product_tab_content_1_1' => array(
            'type' => 'checkbox',
            'label' => esc_html__('Show Tab', 'stm_domain'),
            'default_option' => true,
        ),
        'product_tab_content_1_2' => array(
            'type' => 'tinymce',
            'label' => esc_html__('Details', 'stm_domain'),
            'editor_params' => array('media_buttons' => true, 'textarea_rows' => 5),
        ),
        'product_tab_content_1_3' => array(
            'type' => 'repeater-double',
            'label' => esc_html__('Data table', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        ),
		'product_tab_content_1_4' => array(
			'type' => 'text',
			'label' => esc_html__('Data table title', 'stm_domain'),
			'attr' => array(
				'class' => 'widefat',
			)
		),
        'product_tab_content_2_1' => array(
            'type' => 'checkbox',
            'label' => esc_html__('Show Tab', 'stm_domain'),
            'default_option' => true,
        ),
        'product_tab_content_2_2' => array(
            'type' => 'text',
            'label' => esc_html__('Gallery title', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        ),
        'product_tab_content_2_3' => array(
            'type' => 'repeater-gallery',
            'label' => esc_html__('Gallery image', 'stm_domain'),
        ),

        'product_tab_content_3_1' => array(
            'type' => 'checkbox',
            'label' => esc_html__('Show Tab', 'stm_domain'),
            'default_option' => true,
        ),
        'product_tab_content_3_2' => array(
            'type' => 'text',
            'label' => esc_html__('Certification title', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        ),
        'product_tab_content_3_3' => array(
            'type' => 'textarea',
            'label' => esc_html__('Certification description', 'stm_domain'),
        ),
        'product_tab_content_3_5' => array(
            'type' => 'image',
            'label' => esc_html__('Certification icons in title box', 'stm_domain'),
        ),
        'product_tab_content_3_4' => array(
            'type' => 'repeater-certificate',
            'label' => esc_html__('Certification info', 'stm_domain'),
        ),

        'product_tab_content_4_1' => array(
            'type' => 'checkbox',
            'label' => esc_html__('Show Tab', 'stm_domain'),
            'default_option' => true,
        ),

        'product_tab_content_5_1' => array(
            'type' => 'checkbox',
            'label' => esc_html__('Show Tab', 'stm_domain'),
            'default_option' => true,
        ),
        'product_tab_content_5_2' => array(
            'type' => 'text',
            'label' => esc_html__('Put shortcode Contact Form7', 'stm_domain'),
            'attr' => array(
                'class' => 'widefat',
            )
        ),
    );

    $fields = apply_filters('stm_products_fields', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';

        $fields = array(
            'type' => $type,
            'section' => 'stm_products_details',
            'label' => $field_info['label'],
            'attr' => array(
                'class' => 'products_tab',
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