<?php
add_action('init', 'pearl_moduleVc_schedule');

function pearl_moduleVc_schedule() {
    vc_map( array(
        'name' => esc_html__( 'Pearl Schedule Tabs', 'pearl' ),
        'base' => 'stm_schedule',
        'category' => esc_html__( 'Content', 'pearl' ),
        "as_parent" => array( 'only' => 'stm_schedule_item' ),
        "is_container" => true,
        "content_element" => true,
        "show_settings_on_create" => true,
		'description' => esc_html__('Events schedule', 'pearl'),
		'category' =>array(
			esc_html__('Content', 'pearl'),
			esc_html__('Pearl', 'pearl')
		),
		'params' => array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Date Format', 'pearl' ),
                'param_name' => 'stm_event_lesson_date_format',
                'value' => array(
                    date_i18n('D, F j, Y')  => 'D, F j, Y',
                    date_i18n('F j, Y')  => 'F j, Y',
                    date_i18n('Y-m-d')  => 'Y-m-d',
                    date_i18n('m/d/Y')  => 'm/d/Y',
                    date_i18n('d/m/Y')  => 'd/m/Y',
                )
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Time Format', 'pearl' ),
                'param_name' => 'stm_event_lesson_time_format',
                'value' => array(
                    date_i18n('g:i A')  => 'g:i A',
                    date_i18n('g:i a')  => 'g:i a',
                    date_i18n('H:i')  => 'H:i',
                )
            ),
            array(
                'type'       => 'css_editor',
                'heading'    => esc_html__( 'Css', 'pearl' ),
                'param_name' => 'css',
                'group'       => esc_html__( 'Design Options', 'pearl' ),
            )
        ),
        "js_view" => 'VcColumnView'
    ) );

    $speakers = pearl_vc_post_type('stm_speakers');
    $speakers_data = array();
    foreach($speakers as $speaker_name => $speaker_id) {
        $speakers_data[] = array( 'label' => $speaker_name, 'value' => $speaker_id);
    }

    vc_map( array(
        "name" => esc_html__('Schedule Item', 'pearl'),
        "base" => "stm_schedule_item",
        "content_element" => true,
        "as_child" => array('only' => 'stm_schedule'),
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'pearl' ),
                'param_name' => 'stm_event_lesson_title',
                'holder'        => 'div'
            ),
            array(
                'type'        => 'stm_datepicker_vc',
                'heading'     => esc_html__( 'Date', 'pearl' ),
                'param_name'  => 'datepicker',
                'holder'        => 'div'
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Lessons Info', 'pearl' ),
                'param_name' => 'heading',
                'value'      => urlencode(json_encode(array(
                    array(
                        'label'       => esc_html__('Title', 'pearl'),
                        'admin_label' => true
                    ),
                ))),
                'params' => array(
                    array(
                        'type'        => 'stm_timepicker_vc',
                        'heading'     => esc_html__( 'Time start', 'pearl' ),
                        'param_name'  => 'timepicker_start',
                    ),
                    array(
                        'type'        => 'stm_timepicker_vc',
                        'heading'     => esc_html__( 'Time end', 'pearl' ),
                        'param_name'  => 'timepicker_end',
                    ),
                    array(
                        'type'         => 'textfield',
                        'heading'      => esc_html__( 'Location', 'pearl' ),
                        'param_name'   => 'location'
                    ),
                    array(
                        'type'         => 'textfield',
                        'heading'      => esc_html__( 'Title', 'pearl' ),
                        'param_name'   => 'title',
                        'admin_label' => true,
                    ),
                    array(
                        'type'       => 'textarea',
                        'heading'    => esc_html__( 'Description', 'pearl' ),
                        'param_name' => 'description'
                    ),
                    array(
                        'type' => 'autocomplete',
                        'heading' => esc_html__( 'Select speakers', 'pearl' ),
                        'param_name' => 'lesson_speakers',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'min_length' => 1,
							'no_hide' => true,
							'unique_values' => true,
							'display_inline' => true,
							'values' => $speakers_data
						)
                    ),
                )
            )
        )
    ) );


}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Stm_Schedule extends WPBakeryShortCodesContainer {
    }
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Schedule_Item extends WPBakeryShortCode
    {
    }
}