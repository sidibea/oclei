<?php
function pearl_register_music_metabox($manager)
{
	/*Register sections*/
	$manager->register_section(
		'stm_music_details',
		array(
			'label' => esc_html__('Album details', 'stm_domain'),
			'icon' => 'fa fa-music'
		)
	);

	/*Register controls*/
	$fields = array(
		'new_album' => array(
			'label' => esc_html__('Show this album in popup', 'stm_domain'),
			'type' => 'select',
			'choices' => array(
				'hide' => esc_html__('Hide', 'stm_domain'),
				'show' => esc_html__('Show', 'stm_domain'),
			),
		),
		'new_album_label' => array(
			'label' => esc_html__('New Album label', 'stm_domain'),
			'attr' => array(
				'class' => 'widefat',
				'data-dep' => 'new_album',
				'data-value' => 'show'
			)
		),
		'album_desc' => array(
			'label' => esc_html__('Album label', 'stm_domain'),
		),
		'song_info' => array(
			'type' => 'repeater-music',
			'label' => esc_html__('Songs', 'stm_domain'),
			'validate' => 'stm_sanitize_music',
		),
		'album_links' => array(
			'type' => 'repeater-image',
			'label' => esc_html__('Album links', 'stm_domain'),
		),
	);

	$fields = apply_filters('stm_music_fields', $fields);

	foreach($fields as $field => $field_info) {
		/*Register control*/
		$type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
		$validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';

		$fields = array(
			'type' => $type,
			'section' => 'stm_music_details',
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