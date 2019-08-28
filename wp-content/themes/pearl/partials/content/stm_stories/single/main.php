<?php
$layout = pearl_get_option('stm_stories_layout', 1);

$style = 'partials/content/stm_stories/layouts/layout_' . $layout;

pearl_load_element_style(
    'post_types',
    'stories',
    'style_' . $layout
);


get_template_part($style);
?>