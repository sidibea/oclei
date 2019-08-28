<?php

add_action('wp_enqueue_scripts', 'pearl_error_page_style');

function pearl_error_page_style()
{
    if(is_404()) {
		pearl_load_element_style('404', '', pearl_404_style());
    }

    if(is_page_template('coming-soon.php')) {
        pearl_load_element_style('coming_soon', '', pearl_coming_soon_style());
    }
}


/*CF7 DATEPICKER*/
add_filter('wpcf7_form_action_url', 'pearl_wpcf7_form_action_url');

function pearl_wpcf7_form_action_url($url) {
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('jquery.timepicker');
    wp_enqueue_style('stm_datepicker');
    wp_enqueue_style('stm_timepicker');
    return $url;
}


remove_action('wp_head', 'rest_output_link_wp_head');


//Due to theme changing default WP plugins, replacing them with theme custom widgets
add_filter('monster-widget-config', 'pearl_monster_widget_config');

function pearl_monster_widget_config($widgets) {
	$changeable_widgets = array(
		'WP_Widget_Categories' => 'Pearl_Widget_Categories'
	);

	foreach($widgets as $widget_key => $widget_data) {
		if(!empty($widget_data[0])) {
			$widget_instance = $widget_data[0];
			if(!empty($changeable_widgets[$widget_instance])) {
				$widgets[$widget_key][0] = $changeable_widgets[$widget_instance];
			}
		}
	}

	return $widgets;
}
