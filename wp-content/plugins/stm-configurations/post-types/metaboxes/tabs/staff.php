<?php
function pearl_register_staff_metabox($manager)
{
	/*Register sections*/
	$manager->register_section(
		'stm_staff_details',
		array(
			'label' => esc_html__('Staff details', 'stm_domain'),
			'icon' => 'fa fa-user'
		)
	);

	/*Register controls*/
	$fields = array(
		'staff_name' => array(
			'label' => esc_html__('Name', 'stm_domain'),
			'attr' => array(
				'class' => 'widefat stm_default_title',
			)
		),
		'staff_photo' => array(
			'label' => esc_html__('Photo', 'stm_domain'),
			'type' => 'image'
		),
		'staff_position' => array(
			'label' => esc_html__('Position', 'stm_domain'),
		),
		'staff_info' => array(
			'label' => esc_html__('Info', 'stm_domain'),
			'type' => 'textarea'
		),
		'staff_description' => array(
			'label' => esc_html__('Description', 'stm_domain'),
			'type' => 'textarea'
		),
	);

	$fields = apply_filters('stm_staff_details', $fields);

	foreach($fields as $field => $field_info) {
		/*Register control*/
		$type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
		$validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
		$attrs = (!empty($field_info['attr'])) ? $field_info['attr'] : array('class' => 'widefat');
		$manager->register_control(
			$field,
			array(
				'type' => $type,
				'section' => 'stm_staff_details',
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