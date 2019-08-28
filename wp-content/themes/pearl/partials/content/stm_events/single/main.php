<?php
$layout = pearl_get_option('stm_events_layout', 1);

$style = 'partials/content/stm_events/layouts/layout_' . $layout;

pearl_load_element_style(
    'post_types',
    'events',
    'style_' . $layout
);

get_template_part($style);