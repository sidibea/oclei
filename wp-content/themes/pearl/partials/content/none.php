<?php
$current_object = get_queried_object();

$post_type = 'post';
if (!is_wp_error($current_object) and !empty($current_object) and !empty($current_object->name)) {
	$post_type = $current_object->name;
}

if (!is_wp_error($current_object) and !empty($current_object) and !empty($current_object->term_id)) {
	$post_type = get_post_type();
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

if (pearl_check_string($settings['breadcrumbs'])): ?>
    <div class="stm_page_bc container">
		<?php get_template_part('partials/global/breadcrumbs'); ?>
    </div>
<?php endif; ?>


<div class="<?php echo esc_attr(implode(' ', $wrapper_classes)) ?>">

    <div class="stm_markup__content stm_markup__<?php echo esc_attr($post_type); ?>">
        <div class="stm_loop stm_loop__<?php echo esc_attr($settings['view_type']); ?>">
            <h3>
				<?php if (!empty($_GET['s'])): ?>
					<?php esc_html_e('Your search', 'pearl'); ?>
                    <span class="stc">"<?php echo sanitize_text_field($_GET['s']); ?>"</span> :
					<?php esc_html_e('0 results', 'pearl'); ?>
				<?php else: ?>
					<?php esc_html_e('Nothing found', 'pearl'); ?>
				<?php endif; ?>
            </h3>
        </div>
    </div>

	<?php if ('full' !== $sidebar_position): ?>
        <div class="stm_markup__sidebar stm_markup__sidebar_divider">
            <div class="sidebar_inner">
				<?php pearl_sidebar(); ?>
            </div>
        </div>
	<?php endif; ?>

</div>