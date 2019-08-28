<?php

$layout = pearl_get_option('stm_projects_layout', 1);
$layout = (empty(intval($layout))) ? 1 : $layout;

$style = 'partials/content/stm_projects/layouts/layout_' . $layout;

pearl_load_element_style(
	'post_types',
	'projects',
	'style_' . $layout
);

get_template_part($style);