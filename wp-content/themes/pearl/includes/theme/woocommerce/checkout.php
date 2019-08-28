<?php

add_filter('woocommerce_checkout_fields','pearl_wc_checkout_fields_no_label');
function pearl_wc_checkout_fields_no_label($fields) {
	foreach ($fields as $category => $value) {
		foreach ($fields[$category] as $field => $property) {
			if(empty($fields[$category][$field]['placeholder']) and !empty($fields[$category][$field]['label'])) {
				$fields[$category][$field]['placeholder'] = $fields[$category][$field]['label'];
			}
		}
	}
	return $fields;
}