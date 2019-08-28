<?php
add_action('butterbean_register', 'stm_participant_register_manager', 10, 2);

function stm_participant_register_manager($butterbean, $post_type)
{
    $default = array(
        'stm_participants',
    );

    if(!in_array($post_type, $default)) return;

    $butterbean->register_manager(
        'stm_participant',
        array(
            'label' => esc_html__('STM Participant', 'stm_domain'),
            'post_type' => $default,
            'context' => 'normal',
            'priority' => 'high'
        )
    );

    $manager = $butterbean->get_manager('stm_participant');

    pearl_register_participant_metabox($manager);
}

function pearl_register_participant_metabox($manager)
{
    /*Register sections*/
    $manager->register_section(
        'stm_participant_info',
        array(
            'label' => esc_html__('Participant', 'stm_domain'),
            'icon' => 'fa fa-bookmark'
        )
    );

    /*Register controls*/
    $fields = array(
        'email' => array(
            'label' => esc_html__('Email', 'stm_domain')
        ),
        'phone' => array(
            'label' => esc_html__('Phone', 'stm_domain')
        ),
        'company' => array(
            'label' => esc_html__('Company', 'stm_domain')
        ),
    );

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
        $manager->register_control(
            $field,
            array(
                'type' => $type,
                'section' => 'stm_participant_info',
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