<?php

function pearl_register_donations_metabox($manager)
{
	/*Register sections*/
	$manager->register_section(
		'stm_donation_details',
		array(
			'label' => esc_html__('Donations details', 'stm_domain'),
			'icon'  => 'fa fa-bookmark'
		)
	);

	/*Register controls*/
	$fields = array(
		'target_amount' => array(
			'label' => esc_html__('Target amount', 'stm_theme_text_domain')
		),
		'raised_amount' => array(
			'label' => esc_html__('Raised amount', 'stm_theme_text_domain')
		),
		'donors_count' => array(
			'label' => esc_html__('Donors count', 'stm_theme_text_domain')
		),
		'date_end' => array(
			'type' => 'datepicker',
			'label' => esc_html__('Donation date end', 'stm_domain'),
			'validate' => 'stm_listings_date'
		),
	);

	$fields = apply_filters('stm_donations_fields', $fields);

	foreach($fields as $field => $field_info) {
		/*Register control*/
		$type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
		$validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
		$manager->register_control(
			$field,
			array(
				'type' => $type,
				'section' => 'stm_donation_details',
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