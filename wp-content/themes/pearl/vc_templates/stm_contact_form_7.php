<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
pearl_add_element_style('cf7', $style);



$c_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$form_classes = array("stm_cf7", "stm_cf7_{$style}", $c_class);
$form_class_string = ''; //classes string for print



if (empty($form)) {
	return;
}


if (!empty($form_custom_class)) { //vc param
	$form_classes[] = $form_custom_class;
}

$form_class_string = 'html_class="' . implode(' ', $form_classes) . '"';

if (!empty($form_id)) { //vc param
	$form_id = "html_id=\"{$form_id}\"";
}

echo do_shortcode("[contact-form-7 id={$form} {$form_id} {$form_class_string}]");