<?php

$layout = intval(pearl_get_option('stm_services_layout', 1));
$layout = (empty($layout) or $layout > 2) ? 1 : $layout;

$style = 'partials/content/stm_services/layouts/layout_' . $layout;

pearl_load_element_style(
    'post_types',
    'services',
    'style_' . $layout
);

get_template_part($style);