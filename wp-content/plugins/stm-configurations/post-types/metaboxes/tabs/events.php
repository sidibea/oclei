<?php
function pearl_register_events_metabox($manager)
{
    /*Register sections*/
    $manager->register_section(
        'stm_event_details',
        array(
            'label' => esc_html__('Event details', 'stm_domain'),
            'icon' => 'fa fa-bookmark'
        )
    );

    /*Register controls*/
    $fields = array(
		'desc' => array(
			'label' => esc_html__('Short description', 'stm_domain')
		),
		'link' => array(
			'label' => esc_html__('Custom link', 'stm_domain')
		),
		'link_text' => array(
			'label' => esc_html__('Custom link text', 'stm_domain')
		),
        'participants_num' => array(
            'label' => esc_html__('Max Participants', 'stm_domain')
        ),
        'cur_participants' => array(
            'label' => esc_html__('Signed up participants', 'stm_domain')
        ),
        'address' => array(
            'label' => esc_html__('Event address', 'stm_domain')
        ),
        'latitude' => array(
            'label' => esc_html__('Latitude', 'stm_domain')
        ),
        'longitude' => array(
            'label' => esc_html__('Longitude', 'stm_domain')
        ),
        'date_start' => array(
            'type' => 'datepicker',
            'label' => esc_html__('Event date start', 'stm_domain'),
            'validate' => 'stm_listings_date'
        ),
        'date_start_time' => array(
            'type' => 'timepicker',
            'label' => esc_html__('Event date start time', 'stm_domain'),
			'validate' => 'stm_event_start_timestamp'
        ),
        'date_end' => array(
            'type' => 'datepicker',
            'label' => esc_html__('Event date end', 'stm_domain'),
            'validate' => 'stm_listings_date'
        ),
        'date_end_time' => array(
            'type' => 'timepicker',
            'label' => esc_html__('Event date end time', 'stm_domain')
        ),
    );

    $fields = apply_filters('stm_projects_fields', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
        $manager->register_control(
            $field,
            array(
                'type' => $type,
                'section' => 'stm_event_details',
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