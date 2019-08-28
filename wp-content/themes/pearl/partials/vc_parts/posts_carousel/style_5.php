<?php
$classes = array();
$offset = 0;
$unique_id = uniqid();
$classes[] = 'stm_posts_carousel stm_posts_carousel_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $unique_id;
pearl_add_element_style('posts_carousel', $style);
$img_size = !empty($img_size) ? $img_size : '255x145';

$args = array(
	'post_type'           => 'post',
	'posts_per_page'      => 8,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'tax_query'           => array()
);

if ($order === 'custom') {
	if (!empty($include)) {
		$include = explode(',', $include);
		$args['post__in'] = $include;
	}
} else {
	$args['orderby'] = $order;
}

if (!empty($post_format) and $post_format !== 'all') {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => $post_format,
		)
	);
}


if (is_single()) {
	$args['post__not_in'] = array(get_the_ID());
}

$current_id = get_the_ID();

$q = new WP_Query($args);


if ($q->have_posts()): ?>

    <div class="<?php if (!empty($filter) and $filter !== 'all') : ?>has_filter<?php endif; ?> <?php echo esc_attr(implode(' ', $classes)) ?>">
		<?php if (!empty($filter) and $filter !== 'all') : ?>
			<?php
			$term = get_term($filter, 'filter');
			$filter_name = $term->name;
			$icon_size = '24x24';
			$filter_icon = get_term_meta($filter, 'pearl_filter_image', true);
			$filter_icon_bg = get_term_meta($filter, 'pearl_filter_image_bg', true);
			?>
            <div class="filter_box filter_box_<?php echo $style ?>"
				 <?php if (!empty($filter_icon_bg)): ?>style="background-color: #<?php echo $filter_icon_bg ?><?php endif; ?>">
                <div class="filter-icon"><?php echo pearl_get_VC_attachment_img_safe($filter_icon, $icon_size); ?></div>
                <div class="filter-title"><?php echo $filter_name; ?></div>
            </div>
		<?php endif; ?>
        <div class="owl-carousel"
             data-number-row-tablet="<?php echo esc_attr($number_row_tablet); ?>"
             data-number-row-laptop="<?php echo esc_attr($number_row_laptop); ?>"
             data-number-row-desktop="<?php echo esc_attr($number_row_desktop); ?>"
             data-dots="<?php echo esc_attr($bullets); ?>"
             data-autoplay="<?php echo esc_attr($autoscroll); ?>"
             data-loop="<?php echo esc_attr($loop); ?>"
             data-nav="<?php echo esc_attr($arrows); ?>">

			<?php while ($q->have_posts()): $q->the_post(); ?>

				<?php
				$video_label = esc_html('Video', 'pearl');
				if ($video_duration = get_post_meta(get_the_ID(), 'single_post_video_duration', true)) {
					if ($video_duration && $video_duration !== 0) {
						$video_duration = new DateInterval($video_duration);
						if ($video_duration->format('%H') > 0) {
							$video_label = $video_duration->format('%H:%I:%S');
						} else {
							$video_label = $video_duration->format('%I:%S');
						}
					}
				}
				$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
				if (empty($post_views)) {
					$post_views = 0;
				}
				?>

                <div class="stm_posts_carousel_single">
                    <div class="stm_posts_carousel_single__container">
						<?php if (has_post_thumbnail()): ?>

                            <div class="stm_posts_carousel_single__image">
                                <a href="<?php the_permalink(); ?>"
                                   title="<?php the_title() ?>" class="no_deco">
									<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large') ?>
                                </a>

								<?php
								$video_link = get_post_meta(get_the_ID(), 'single_post_video', true);
								if ($post_format === 'post-format-video') : ?>
                                    <div class="video_label mbc_b">
										<?php
										echo wp_kses_post($video_label);
										?>
                                    </div>
								<?php endif; ?>
                            </div>

						<?php endif; ?>
                        <div class="stm_posts_carousel_single__body <?php if (has_post_thumbnail()): ?>has_single__image<?php endif; ?>">

							<?php if (!empty($show_title)): ?>
                                <h5>
                                    <a href="<?php the_permalink(); ?>"
                                       title="<?php the_title() ?>" class="no_deco">
										<?php the_title() ?>
                                    </a>
                                </h5>
							<?php endif; ?>

							<?php if (!empty($show_excerpt)): ?>
                                <div class="stm_posts_carousel_single__excerpt">
									<?php the_excerpt(); ?>
                                </div>
							<?php endif; ?>

                            <div class="stm_posts_carousel_single__info">

								<?php
								$categories = get_the_category();
								if (!empty($show_category) && !empty($categories)) :
									?>
                                    <div class="post_categories info__item">
										<?php foreach ($categories as $category) : ?>
                                            <a class="ttc_h" href="<?php echo esc_attr(get_category_link($category->term_id)); ?>">
                                                <div class="post_category mbc">
													<?php echo wp_kses_post($category->name); ?>
                                                </div>
                                            </a>
										<?php endforeach; ?>
                                    </div>
								<?php endif; ?>

								<?php if (!empty($show_date)): ?>
                                    <div class="date info__item">
                                        <span class="stmicon-magazine-calendar"></span>
										<?php
										$posted = get_the_time('U');
										echo human_time_diff($posted, current_time('U')) . ' ago';
										?>
                                    </div>
								<?php endif; ?>

								<?php if (!empty($show_comments)) : ?>
                                    <div class="comments_count info__item">
                                        <i class="stmicon-magazine-comment"></i>
                                        <span>
									<?php echo comments_number(0, 1, '%'); ?>
                                    </span>
                                    </div>
								<?php endif; ?>

								<?php if (!empty($show_views)) : ?>
                                    <div class="views_count info__item">
                                        <span class="stmicon-magazine-view"></span>
										<?php echo intval($post_views); ?>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
        </div>
    </div>

	<?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php
wp_enqueue_style('owl-carousel2');
wp_enqueue_script('pearl-owl-carousel2');
wp_enqueue_script('pearl_post_carousel/style_5');
?>