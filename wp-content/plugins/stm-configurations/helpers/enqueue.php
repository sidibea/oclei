<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function stm_config_admin_enqueue($hook)
{
    wp_enqueue_style('stm_admin_butterbean_datepicker',
        STM_CONFIGURATIONS_URL . 'assets/css/jquery-ui.min.css',
        false,
        1,
        false);

    wp_enqueue_script('jquery-ui-datepicker');

    wp_enqueue_style('stm_admin_butterbean_timepicker',
        '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css',
        false,
        1,
        false);

    wp_enqueue_script('stm_admin_butterbean_timepicker_js',
        '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js',
        array('jquery'),
        1,
        false
    );

}

if(function_exists('vc_add_shortcode_param')) {
    add_action('admin_enqueue_scripts', 'stm_config_admin_enqueue');

    vc_add_shortcode_param('stm_datepicker_vc', 'stm_datepicker_vc_st', get_template_directory_uri() . '/includes/theme/vc/admin_js/datepicker.js');
    function stm_datepicker_vc_st($settings, $value)
    {
        return '<div class="stm_datepicker_vc_field">'
        . '<input type="text" name="' . esc_attr($settings['param_name']) . '" class="stm_datepicker_vc wpb_vc_param_value wpb-textinput ' .
        esc_attr($settings['param_name']) . ' ' .
        esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '" />' .
        '</div>';
    }

    vc_add_shortcode_param('stm_timepicker_vc', 'stm_timepicker_vc_st', get_template_directory_uri() . '/includes/theme/vc/admin_js/timepicker.js');
    function stm_timepicker_vc_st($settings, $value)
    {
        return '<div class="stm_timepicker_vc_field">'
        . '<input type="text" name="' . esc_attr($settings['param_name']) . '" class="stm_timepicker_vc wpb_vc_param_value wpb-textinput ' .
        esc_attr($settings['param_name']) . ' ' .
        esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '" />' .
        '</div>';
    }

	//vc_add_shortcode_param('stm_autocomplete_vc', 'stm_autocomplete_vc_st', get_template_directory_uri() . '/includes/theme/vc/admin_js/autocomplete.js');
	function stm_autocomplete_vc_st($settings, $value)
	{
		return '<div class="stm_autocomplete_vc_field">'
			. '<input type="text" name="' . esc_attr($settings['param_name']) . '" class="stm_autocomplete_vc wpb_vc_param_value wpb-textinput ' .
			esc_attr($settings['param_name']) . ' ' .
			esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '" />' .
			'</div>';
	}
}