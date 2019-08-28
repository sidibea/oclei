<?php

$current_object = get_queried_object();

$post_type = 'post';
if (!is_wp_error($current_object) and !empty($current_object) and !empty($current_object->name)) {
	$post_type = $current_object->name;
}
if (!is_wp_error($current_object) and !empty($current_object) and !empty($current_object->term_id)) {
	$post_type = pearl_get_post_type_by_taxonomy($current_object->taxonomy);
	$post_type = $post_type[0];
	$settings = pearl_get_post_settings($post_type);
	$style_path = '/assets/css/post_types/' . str_replace('stm_', '', $post_type) . '/' . $settings['style'] . '.css';
	$theme_info = pearl_get_assets_path();


	if (file_exists(get_template_directory() . $style_path)) {
		wp_enqueue_style($post_type . '_archive', get_template_directory_uri() . $style_path, null, $theme_info['v']);
	} else {
	    $post_type = 'post';
    }

}


$settings = pearl_get_post_settings($post_type);

$sidebar_position = pearl_get_sidebar_setting($post_type);
$sidebar_mobile = pearl_get_sidebar_mobile($post_type, 'archive');


$wrapper_classes = array('stm_markup', 'stm_markup_' . esc_attr($sidebar_position));

if ($sidebar_mobile === 'hidden') {
	$wrapper_classes[] = 'stm_sidebar_hidden';
}
if (!empty($current_object->ID)) {
	$breadcrumbs = get_post_meta($current_object->ID, 'page_bc', true);
	$settings['breadcrumbs'] = $breadcrumbs;
}

if (pearl_check_string($settings['breadcrumbs'])) : ?>
    <div class="stm_page_bc container">
		<?php get_template_part('partials/global/breadcrumbs'); ?>
    </div>
<?php endif; ?>

<?php
if (!file_exists(get_template_directory() . $settings['tpl'] . '.php')) {
	$settings['tpl'] = '/partials/content/post/archive_layouts/list/style_1';
}; ?>

<div class="<?php echo esc_attr(implode(' ', $wrapper_classes)) ?>">

    <div class="stm_markup__content stm_markup__<?php echo esc_attr($post_type); ?>">
        <div class="stm_loop stm_loop__<?php echo esc_attr($settings['view_type']); ?>">
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part($settings['tpl']); ?>
			<?php endwhile; ?>
        </div>
		<?php
		echo pearl_pagination(array('type' => 'list'));
		?>
    </div>

	<?php if ('full' !== $sidebar_position) : ?>
        <div class="stm_markup__sidebar stm_markup__sidebar_divider stm_markup__sidebar_archive">
            <div class="sidebar_inner">
				<?php pearl_sidebar(); ?>
            </div>
        </div>
	<?php endif; ?>

</div>