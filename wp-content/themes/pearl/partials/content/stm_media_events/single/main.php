<?php

$path = 'partials/content/stm_media_events';

$style = pearl_get_option('stm_media_events_layout', 1);
$layout = $path . '/layouts/layout_' . $style;

wp_enqueue_style('lightgallery');
wp_enqueue_script('lightgallery.js');
wp_enqueue_script('lg-video.js');
pearl_load_element_style(
	'post_types',
	'media_events',
	'style_' . $style
);

get_template_part($layout);

get_template_part($path . '/single/_actions');
get_template_part($path . '/single/_speaker');
get_template_part($path . '/single/_comments');