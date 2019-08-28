<?php

$layout = pearl_get_option('stm_products_layout', 1);
$layout = (empty($layout)) ? 1 : intval($layout);

$style = 'partials/content/stm_products/layouts/layout_' . $layout;

pearl_load_element_style(
	'post_types',
	'products',
	'style_' . $layout
);

get_template_part($style);