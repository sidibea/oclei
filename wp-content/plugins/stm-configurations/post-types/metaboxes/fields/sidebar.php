<?php
add_action('butterbean_register', 'stm_page_register_sidebar_manager', 10, 2);

function stm_page_register_sidebar_manager($butterbean, $post_type)
{
    $default = array(
        'stm_sidebars'
    );

    if(!in_array($post_type, $default)) return;

    $butterbean->register_manager(
        'stm_default_fields_sidebar',
        array(
            'label' => esc_html__('STM Sidebar settings', 'stm_domain'),
            'post_type' => $default,
            'context' => 'normal',
            'priority' => 'high'
        )
    );

    $manager = $butterbean->get_manager('stm_default_fields_sidebar');

    /*Register sections*/
    $manager->register_section(
        'stm_sidebar',
        array(
            'label' => esc_html__('General', 'stm_domain'),
            'icon' => 'fa fa-bookmark'
        )
    );

    /*Register controls*/
    $fields = array(
        'sticky_sidebar' => array(
            'type' => 'checkbox',
            'label' => esc_html__('Sticky Sidebar', 'stm_domain')
        ),
    );

    $fields = apply_filters('stm_sidebar_fields', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
        $manager->register_control(
            $field,
            array(
                'type' => $type,
                'section' => 'stm_sidebar',
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