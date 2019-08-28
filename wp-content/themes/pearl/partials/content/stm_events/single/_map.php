<?php

$id = get_the_ID();
$lat = get_post_meta($id, 'latitude', true);
$lng = get_post_meta($id, 'longitude', true);

$pin_color = array(
	2 => 'main_color',
	3 => 'secondary_color'
);


$pin_color = pearl_get_option($pin_color[pearl_get_option('stm_events_layout', 2)]);


$include_map = '';
if (!empty($lat) and !empty($lng)) $include_map = 'included'; ?>

<?php if (!empty($include_map)):
	wp_enqueue_script('gmap');
	$url = get_template_directory_uri() . '/assets/img/markers/';

	$pearl_event_map = array(
		'lat' => $lat,
		'lng' => $lng,
	);
	wp_localize_script(
		'pearl_event_map',
		'pearl_event_map',
		$pearl_event_map);
	wp_enqueue_script('pearl_event_map');
	?>
    <div id="gmap"></div>

<?php endif; ?>
