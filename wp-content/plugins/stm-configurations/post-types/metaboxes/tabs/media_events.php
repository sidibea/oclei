<?php
/**
 * @var $manager ButterBean_Manager
 */
function pearl_register_media_event_metabox($manager)
{
	/*Register sections*/
	$manager->register_section(
		'stm_media_event_details',
		array(
			'label' => esc_html__('Media Event details', 'stm_domain'),
			'icon' => 'fa fa-film'
		)
	);

	/*Register controls*/
	$fields = array(
		'video_url' => array(
			'label' => esc_html__('Video url', 'stm_domain'),
		),
		'music_url' => array(
			'label' => esc_html__('Music url', 'stm_domain'),
		),
		'download_url' => array(
			'label' => esc_html__('Download url', 'stm_domain'),
		)
	);

	$fields = apply_filters('stm_media_event_details', $fields);

	foreach($fields as $field => $field_info) {
		/*Register control*/
		$type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
		$validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
		$manager->register_control(
			$field,
			array(
				'type' => $type,
				'section' => 'stm_media_event_details',
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


	$speakers = array(
		'0' => esc_html__('No Speaker', 'stm_domain')
	);
	$speakers_query_args = array(
		'post_type' => 'stm_staff',
		'posts_per_page' => -1,
	);

	$speakers_posts = get_posts($speakers_query_args);

	/**
	 * @var $speakers_post WP_Post
	 */
	foreach ($speakers_posts as $speakers_post) {
		$speakers[$speakers_post->ID] = $speakers_post->post_title;
	}

	$manager->register_control(
		'speaker',
		array(
			'type' => 'select',
			'choices' => $speakers,
			'section' => 'stm_media_event_details',
			'label' => esc_html__('Select speaker', 'stm_domain'),
			'attr' => array(
				'class' => 'widefat'
			)
		)
	);




	$manager->register_setting(
		'speaker',
		array(
			'sanitize_callback' => 'stm_listings_no_validate'
		)
	);




}