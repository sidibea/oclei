<?php
$path = 'partials/content/post/single/';
$layouts = 'partials/content/post/layouts/';

$post_layout = pearl_get_option('post_layout', '1');
$single_post_layout = get_post_meta(get_the_ID(), 'single_post_layout', true);

if(!empty($single_post_layout)) {
    $post_layout = $single_post_layout;

	$theme_info = pearl_get_assets_path();
	wp_enqueue_style('pearl-post-style-' . $post_layout, $theme_info['css'] . 'post/style_' . $post_layout . '.css', 'pearl-theme-styles', $theme_info['v']);
}
?>
<div class="stm_single_post stm_single_post_style_<?php echo intval($post_layout) ?>">

    <?php get_template_part($path . '_video'); ?>

	<?php get_template_part("{$layouts}/layout_{$post_layout}");?>
</div>