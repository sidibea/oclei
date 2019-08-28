<?php
add_action('init', 'stm_slider_register_vc_tpl');
function stm_slider_register_vc_tpl()
{

	$args = array(
		'post_type'      => STM_SLIDER_POST_TYPE,
		'posts_per_page' => -1,
		'post_status'    => ['draft', 'publish'],
		'orderBy'        => 'id',
		'order'          => 'ASC',
		'post_parent'    => 0,
	);

	if (is_admin()) {
		$sliders = get_posts($args);
	} else {
		$sliders = array();
	}


	$slider_ids = array();

	$i = 0;
	foreach ($sliders as $slider) {

		$k = empty($slider->post_title) ? $slider->ID : $slider->post_title;

		$slider_ids[$k] = $slider->ID;
		$i++;
	}


	$theme_vc_template = !empty(locate_template('vc_templates/stm_slider.php'));

	$vc_template_path = STM_SLIDER_ROOT_PATH . '/vc_templates/stm_slider.php';

	if (!empty($theme_vc_template)) {
		$vc_template_path = $theme_vc_template;
	}

	$slider_option = array(
		'name'          => __('Pearl Slider', 'stm_domain'),
		'base'          => 'stm_slider',
		'icon'          => 'stmicon-flag',
		'category'      => __('Pearl', 'stm_domain'),
		'html_template' => $vc_template_path,
		'params'        => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __('Select slider', 'motors'),
				'param_name' => 'slider_id',
				'value'      => $slider_ids,
				'weight'     => 1
			)
		)
	);

	if (function_exists('vc_map')) {
		vc_map($slider_option);
	}
}

if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_Stm_Slider extends WPBakeryShortCode
	{
	}
}