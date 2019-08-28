<?php
function pearl_register_video_metabox($manager)
{
	/*Register sections*/
	$manager->register_section(
		'stm_video_details',
		array(
			'label' => esc_html__('Video details', 'stm_domain'),
			'icon' => 'fa fa-film'
		)
	);

	/*Register controls*/
	$fields = array(
		'video_url' => array(
			'label' => esc_html__('Video url', 'stm_domain'),
		),
		'video_label' => array(
			'label' => esc_html__('Video label', 'stm_domain'),
		),
	);

	$fields = apply_filters('stm_video_details', $fields);

	foreach($fields as $field => $field_info) {
		/*Register control*/
		$type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
		$validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
		$manager->register_control(
			$field,
			array(
				'type' => $type,
				'section' => 'stm_video_details',
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