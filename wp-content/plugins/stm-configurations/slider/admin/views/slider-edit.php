<?php
$id = $_GET['slider_id'];
$meta = get_post_meta($id, 'stm_slider_settings', true);
?>

	<script>
		<?php pearl_icons_set(); ?>
        var stm_google_fonts = '<?php echo wp_json_encode(stm_slider_get_google_fonts_array()); ?>';
        var stm_host = '<?php echo esc_js(get_site_url()); ?>';
    </script>

	<div class="wrap" ng-app="app">
		<app-root></app-root>
	</div>

<?php
$args = array(
	'post_type'   => 'stm_slider',
	'post_parent' => $id,
);

$slides_posts = get_posts($args);

$slider_data = array();
foreach ($slides_posts as $slides_post) {
	$slider_data[$slides_post->ID] = get_post_meta($slides_post->ID, 'stm_slider_slide_settings', true);
}

?>