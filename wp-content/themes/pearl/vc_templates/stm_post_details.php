<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$offset = 0;

$classes = array();
$classes[] = 'stm_post_details_module stm_post_details_module_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

$id = get_the_ID();

pearl_add_element_style('post_details', $style);


$post_views = get_post_meta($id, 'stm_post_views', true);
if (empty($post_views)) {
	$post_views = 0;
}

?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
	<?php
	$categories = get_the_category();
	if (!is_wp_error($categories) && !empty($categories)) : ?>
		<div class="post_categories info__item">
			<?php foreach ($categories as $category) : ?>
				<div class="post_category">
					<?php echo wp_kses_post($category->name); ?>
				</div>
			<?php

			endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="date info__item">
		<i class="stmicon-magazine-calendar"></i>
		<span>
                <?php
				$posted = get_the_time('U');
				echo human_time_diff($posted, current_time('U')) . ' ago';
				?>
            </span>
	</div>

	<div class="author info__item">
		<i class="stmicon-magazine-user"></i>
		<span><?php the_author(); ?></span>
	</div>

	<div class="views_count info__item">
		<i class="stmicon-magazine-view"></i>
		<span><?php echo intval($post_views); ?></span>
	</div>
	<?php if (!empty(get_the_tags())) : ?>
		<div class="tags info__item">
			<i class="stmicon-magazine-tag"></i>
			<?php the_tags('', ',&nbsp;', ''); ?>
		</div>
	<?php endif; ?>
</div>

