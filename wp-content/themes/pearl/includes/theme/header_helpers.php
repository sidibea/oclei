<?php
/**
 * Get rows and cells
 *
 * @return array
 */
function pearl_header_parts() {
    return array(
        'rows' => array('top', 'center', 'bottom'),
        'cells' => array('left', 'center', 'right')
    );
}

/**
 * Locate template in builder
 *
 * @param string|array $templates Single or array of template files
 *
 * @return string
 */
function pearl_locate_builder_element($templates, $template_name = '')
{
    $located = false;

    foreach ((array)$templates as $template) {

        $folder = $template;

        if(!empty($template_name)) {
            $template = $template_name;
        }

        if (substr($template, -4) !== '.php') {
            $template .= '.php';
        }

        if (!($located = locate_template('partials/header/elements/' . $folder . '/' . $template))) {
            $located = get_template_directory() . '/partials/header/elements/' . $folder . '/' . $template;
        }

        if (file_exists($located)) {
            break;
        }

    }

    return apply_filters('stm_listings_locate_template', $located, $templates);
}

/**
 * Load template
 *
 * @param $__template
 * @param array $__vars
 */
function pearl_load_element($__template, $__vars = array(), $__template_name = '')
{
    extract($__vars);
    include pearl_locate_builder_element($__template, $__template_name);
}

function pearl_get_wpml_langs() {

	if(defined('ICL_LANGUAGE_CODE')) {
		$current_language_code = ICL_LANGUAGE_CODE;
		$langs = icl_get_languages('skip_missing=0');
		$wpml = array();

		if(!empty($langs)) {
			if(!empty($langs[$current_language_code])) {
				$current_language = $langs[$current_language_code];
				$wpml[] = array(
					'label' => $current_language['native_name'],
					'url' => $current_language['url'],
				);
			}

			foreach($langs as $lang_key => $lang_info) {
				if($lang_key !== $current_language_code) {
					$wpml[] = array(
						'label' => $lang_info['native_name'],
						'url' => $lang_info['url'],
					);
				}
			}
		}
	}

	if(empty($langs)) {
		$wpml = [
			array(
				'label' => esc_html__('English', 'pearl'),
				'url' => '/'
			),
		];
	}

    return apply_filters('pearl_get_wpml_langs', $wpml);
}

function pearl_get_dropdown($dropdown) {
    $choices = array(
        'first' => [],
        'others' => []
    );

    if(!empty($dropdown[0]) and !empty($dropdown[0]['label'])) {
        $choices['first'] = $dropdown[0];
    }

    array_shift($dropdown);

    if(!empty($dropdown)) {
        $choices['others'] = $dropdown;
    }

    return $choices;
}

function pearl_get_filter($filter) {
    if(!empty($filter)) {
        $choices['others'] = $filter;
    }
    return $choices;
}

function pearl_element_style($element) {
    $style_class = '';
    if(!empty($element['data']) and !empty($element['data']['style'])) {
        $style_class = $element['data']['style'];
    }

    return " stm-header__element_{$style_class}";
}
?>