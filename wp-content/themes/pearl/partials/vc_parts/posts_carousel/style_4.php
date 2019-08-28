<?php
$classes = array();
$offset = 0;
$unique_id = uniqid();
$classes[] = 'stm_posts_carousel stm_posts_carousel_' . $style;
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $unique_id;
pearl_add_element_style('posts_carousel', $style);
wp_enqueue_script('pearl_post_carousel/style_4');
$img_size = !empty($img_size) ? $img_size : '1110x600';
$link = vc_build_link($link);


$args = array(
	'post_type'           => 'post',
	'posts_per_page'      => 3,
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

if ($q->have_posts()) : ?>

    <div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
        <div class="stm_posts_carousel__content">
			<?php $i = 0;
			while ($q->have_posts()) : $q->the_post();
				$i++; ?>

				<?php
				$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
				if (empty($post_views)) {
					$post_views = 0;
				}

				$active_class = ($i === 1) ? 'active' : '';
				?>

                <div class="stm_posts_carousel_single <?php echo esc_attr($active_class); ?>">
                    <div class="stm_posts_carousel_single__container">
                        <div class="stm_posts_carousel_single__body">


                            <a href="<?php the_permalink(); ?>"
                               title="<?php the_title() ?>" class="no_deco title">
                                <h5 class="h1">
									<?php the_title() ?>
                                </h5>
                            </a>


                            <div class="stm_posts_carousel_single__info">

                                <div class="post_categories info__item">
									<?php
									$categories = wp_get_post_categories(get_the_ID(), array('fields' => 'all'));
									foreach ($categories as $category) : ?>
                                        <a class="ttc_h"
                                           href="<?php echo esc_attr(get_category_link($category->term_id)); ?>">
                                            <div class="post_category mbc">
												<?php echo wp_kses_post($category->name); ?>
                                            </div>
                                        </a>
									<?php endforeach; ?>
                                </div>

                                <div class="date info__item">
                                    <span class="stmicon-magazine-calendar"></span>
									<?php
									$posted = get_the_time('U');
									echo human_time_diff($posted, current_time('U')) . ' ago';
									?>
                                </div>

                                <div class="comments_count info__item">
                                    <span class="stmicon-magazine-comment"></span>
									<?php echo comments_number(0, 1, '%'); ?>
                                </div>

                                <div class="views_count info__item">
                                    <span class="stmicon-magazine-view"></span>
									<?php echo intval($post_views); ?>
                                </div>
                            </div>

                            <div class="stm_posts_carousel_single__excerpt">
								<?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="no_deco stm_posts_carousel_single__read_more">
                                <span class="stmicon-angle-right tbdc"></span>

                                <span>
								<?php echo esc_html__('Read More', 'pearl'); ?>
                                </span>
                            </a>
                        </div>
						<?php if (has_post_thumbnail()) : ?>

                            <div class="stm_posts_carousel_single__image">
                                <a href="<?php the_permalink(); ?>"
                                   title="<?php the_title() ?>" class="no_deco">
									<?php echo pearl_get_VC_post_img_safe(get_the_ID(), $img_size, 'large'); ?>
                                </a>
                            </div>

						<?php endif; ?>

                    </div>
                </div>
			<?php endwhile; ?>
        </div>
        <div class="stm_posts_carousel__list">
            <ul>
				<?php $i = 0;
				while ($q->have_posts()) : $q->the_post();
					$i++; ?>
					<?php
					$post_views = get_post_meta(get_the_ID(), 'stm_post_views', true);
					if (empty($post_views)) {
						$post_views = 0;
					}

					$active_class = ($i === 1) ? 'active' : '';
					?>

                    <li class="<?php echo esc_attr($active_class); ?>">
                        <a class="no_deco title" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
                        </a>
						<?php if (!empty($show_excerpt)) : ?>
                            <div class="post_excerpt">
								<?php the_excerpt(); ?>
                            </div>
						<?php endif; ?>
                        <div class="stm_posts_carousel__info">

							<?php
							$categories = get_the_category();
							if (!empty($show_category) && !empty($categories)) :
								?>
                                <div class="post_categories info__item">
									<?php foreach ($categories as $category) {
										?>
                                        <a class="ttc_h" href="<?php echo get_category_link($category->term_id); ?>">
                                            <div class="post_category">
												<?php echo wp_kses_post($category->name); ?>
                                            </div>
                                        </a>
										<?php

									} ?>
                                </div>
							<?php endif; ?>

							<?php if (!empty($show_date)) : ?>
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
                    </li>
				<?php endwhile; ?>
            </ul>
			<?php if (!empty($link)) : ?>
                <div class="stm_posts_carousel__all_news_link">
                    <a class="no_deco" href="<?php echo esc_url($link['url']); ?>"
                       target="<?php echo empty($link['target']) ? '_self' : esc_attr($link['target']) ?>"
                       title="<?php esc_attr($link['title']); ?>">
                        <span>
						<?php echo wp_kses_post($link['title']) ?>
                        </span>
                        <i class="stmicon-angle-right"></i>
                    </a>
                </div>
			<?php endif; ?>
        </div>
    </div>

	<?php wp_reset_postdata(); ?>
<?php endif; ?>