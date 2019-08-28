<?php
function pearl_register_stats_metabox($manager)
{
	/*Register sections*/
	$manager->register_section(
		'stm_stats_details',
		array(
			'label' => esc_html__('Stats details', 'stm_domain'),
			'icon' => 'fa fa-user'
		)
	);

	/*Register controls*/
	$fields = array(
		'stm_post_views' => array(
			'label' => esc_html__('Total Views', 'stm_domain'),
			'attr' => array(
				'class' => 'widefat',
			)
		),
	);


	for ($i = 0; $i <= 2; $i++) {
		$month_time = strtotime( date( 'Y-m-01' )." -$i months");
		$date_key = 'stm_month_' . date("m", $month_time);
		$fields[$date_key] = array(
			'label' => date_i18n("F Y", $month_time),
			'attr' => array(
				'class' => 'widefat',
			)
		);
	}

	for($i = 0; $i < 9; $i++) {
		$day_time = strtotime('-' . $i . ' days');
		$date_key = 'stm_day_' . date("j", $day_time);

		$fields[$date_key] = array(
			'label' => date_i18n("F j", $day_time),
			'attr' => array(
				'class' => 'widefat',
			)
		);
	}

	$fields = apply_filters('stm_stats_details', $fields);

	foreach($fields as $field => $field_info) {
		/*Register control*/
		$type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
		$validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_listings_no_validate';
		$attrs = (!empty($field_info['attr'])) ? $field_info['attr'] : array('class' => 'widefat');
		$manager->register_control(
			$field,
			array(
				'type' => $type,
				'section' => 'stm_stats_details',
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